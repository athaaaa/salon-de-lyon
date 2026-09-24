<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Stylist;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * 1. Beranda salon
     */
    public function welcome()
    {
        return view('customer.welcome');
    }

    /**
     * 2. Daftar treatment (bisa difilter kategori)
     */
    public function treatments(Request $request)
    {
        $treatments = Treatment::active()
            ->when($request->q, fn ($q) => $q->where('name', 'like', "%{$request->q}%"))
            ->when($request->category, fn ($q) => $q->where('category', $request->category))
            ->orderBy('category')->orderBy('name')
            ->get()
            ->groupBy('category');

        $categories = Treatment::active()->distinct()->pluck('category');

        return view('customer.treatments.index', compact('treatments', 'categories'));
    }

    /**
     * 3. Detail treatment -> pilih treatment ini
     */
    public function treatmentShow(Treatment $treatment)
    {
        return view('customer.treatments.show', compact('treatment'));
    }

    /**
     * 4. Daftar stylist yang bisa menangani treatment ini
     */
    public function stylists(Treatment $treatment)
    {
        $stylists = $treatment->stylists()->active()->get();

        return view('customer.stylists.index', compact('treatment', 'stylists'));
    }

    /**
     * 5. Pilih tanggal -> lanjut pilih jam
     */
    public function bookingDate(Treatment $treatment, Stylist $stylist)
    {
        return view('customer.booking.date', compact('treatment', 'stylist'));
    }

    /**
     * 6. Pilih jam yang tersedia (jam yang sudah bentrok otomatis disembunyikan)
     */
    public function bookingTime(Request $request, Treatment $treatment, Stylist $stylist)
    {
        $date = $request->query('date', now()->toDateString());

        // Slot jam operasional baru: 10:00 - 19:00
        $operationalSlots = [];
        for ($hour = 10; $hour <= 19; $hour++) {
            $operationalSlots[] = sprintf('%02d:00', $hour);
        }

        $availableSlots = [];
        foreach ($operationalSlots as $slot) {
            $end = Reservation::calculateEndTime($slot, $treatment->duration_minutes);
            $taken = Reservation::isScheduleTaken($stylist->id, $date, $slot, $end);
            $availableSlots[$slot] = ! $taken;
        }

        return view('customer.booking.time', compact('treatment', 'stylist', 'date', 'availableSlots'));
    }

    /**
     * 7. Form data customer
     */
    public function bookingForm(Request $request, Treatment $treatment, Stylist $stylist)
    {
        $request->validate([
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
        ]);

        return view('customer.booking.form', [
            'treatment' => $treatment,
            'stylist' => $stylist,
            'date' => $request->date,
            'time' => $request->time,
        ]);
    }

    /**
     * 8. Simpan reservasi setelah customer konfirmasi
     */
    public function bookingStore(Request $request, Treatment $treatment, Stylist $stylist)
    {
        $data = $request->validate([
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:100'],
            'notes' => ['nullable', 'string'],
            'agree' => ['accepted'],
        ]);

        $endTime = Reservation::calculateEndTime($data['time'], $treatment->duration_minutes);

        // Validasi bentrok jadwal sekali lagi di server (inti sistem, jangan cuma percaya input klien)
        if (Reservation::isScheduleTaken($stylist->id, $data['date'], $data['time'], $endTime)) {
            return back()->withInput()->withErrors(['time' => 'Maaf, jam ini baru saja dibooking orang lain. Silakan pilih jam lain.']);
        }

        $reservation = DB::transaction(function () use ($data, $treatment, $stylist, $endTime) {
            $customer = Customer::firstOrCreate(
                ['phone' => $data['phone']],
                ['name' => $data['name'], 'email' => $data['email'] ?? null]
            );

            // Kalau customer lama booking pakai nama baru, sinkronkan nama terbaru
            if ($customer->name !== $data['name']) {
                $customer->update(['name' => $data['name'], 'email' => $data['email'] ?? $customer->email]);
            }

            $reservation = Reservation::create([
                'reservation_code' => Reservation::generateCode(),
                'customer_id' => $customer->id,
                'stylist_id' => $stylist->id,
                'treatment_id' => $treatment->id,
                'reservation_date' => $data['date'],
                'start_time' => $data['time'],
                'end_time' => $endTime,
                'source' => 'Web/App Customer',
                'status' => 'Menunggu Konfirmasi',
                'notes' => $data['notes'] ?? null,
                'created_by' => null,
            ]);

            $reservation->statusLogs()->create([
                'old_status' => null,
                'new_status' => 'Menunggu Konfirmasi',
                'note' => 'Booking mandiri oleh customer lewat web.',
                'changed_at' => now(),
            ]);

            session(['customer_phone' => $customer->phone]);

            return $reservation;
        });

        return redirect()->route('booking.success', $reservation->reservation_code);
    }

    /**
     * 9. Halaman "Booking Berhasil" + kode reservasi
     */
    public function bookingSuccess(string $code)
    {
        $reservation = Reservation::with(['treatment', 'stylist'])->where('reservation_code', $code)->firstOrFail();

        return view('customer.booking.success', compact('reservation'));
    }

    /**
     * 10. Cek status reservasi pakai kode reservasi
     */
    public function statusForm()
    {
        return view('customer.reservations.status-form');
    }

    public function statusShow(Request $request)
    {
        $request->validate(['code' => ['required', 'string']]);

        $reservation = Reservation::with(['treatment', 'stylist'])
            ->where('reservation_code', $request->code)
            ->first();

        if (! $reservation) {
            return back()->withErrors(['code' => 'Kode reservasi tidak ditemukan.']);
        }

        return view('customer.reservations.status', compact('reservation'));
    }

    public function statusByCode(string $code)
    {
        $reservation = Reservation::with(['treatment', 'stylist'])
            ->where('reservation_code', $code)
            ->firstOrFail();

        return view('customer.reservations.status', compact('reservation'));
    }

    /**
     * Customer membatalkan reservasi sendiri lewat halaman status
     */
    public function cancel(Request $request, Reservation $reservation)
    {
        if ($reservation->status === 'Selesai') {
            return back()->withErrors(['status' => 'Reservasi yang sudah selesai tidak bisa dibatalkan.']);
        }

        $reservation->cancelled_reason = 'Dibatalkan oleh customer.';
        $reservation->save();
        $reservation->changeStatus('Dibatalkan', null, 'Dibatalkan mandiri oleh customer.');

        return redirect()->route('booking.status.show.code', $reservation->reservation_code)
            ->with('success', 'Reservasi berhasil dibatalkan.');
    }

    /**
     * 11. Riwayat reservasi customer (berdasarkan nomor HP yang tersimpan di session)
     */
    public function history(Request $request)
    {
        $phone = $request->input('phone', session('customer_phone'));

        $reservations = collect();
        if ($phone) {
            $customer = Customer::where('phone', $phone)->first();
            if ($customer) {
                $reservations = Reservation::with(['treatment', 'stylist'])
                    ->where('customer_id', $customer->id)
                    ->orderByDesc('reservation_date')
                    ->get();
            }
        }

        return view('customer.reservations.history', compact('reservations', 'phone'));
    }
    /**
     * Tampilkan katalog seluruh stylist aktif
     */
    public function allStylists()
    {
        $stylists = \App\Models\Stylist::active()->get();
        return view('customer.stylists.all', compact('stylists'));
    }
}