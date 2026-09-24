<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Stylist;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $reservations = Reservation::with(['customer', 'stylist', 'treatment'])
            ->when($request->status, fn ($q) => $q->where('status', $request->status))
            ->when($request->q, function ($q) use ($request) {
                $q->where('reservation_code', 'like', "%{$request->q}%")
                    ->orWhereHas('customer', fn ($c) => $c->where('name', 'like', "%{$request->q}%")
                        ->orWhere('phone', 'like', "%{$request->q}%"));
            })
            ->orderByDesc('reservation_date')
            ->orderByDesc('start_time')
            ->paginate(15)
            ->withQueryString();

        $statusCounts = Reservation::selectRaw('status, COUNT(*) as jumlah')->groupBy('status')->pluck('jumlah', 'status');

        return view('admin.reservations.index', compact('reservations', 'statusCounts'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $treatments = Treatment::active()->orderBy('category')->orderBy('name')->get();
        $stylists = Stylist::active()->orderBy('name')->get();

        return view('admin.reservations.create', compact('customers', 'treatments', 'stylists'));
    }

    /**
     * Cek ketersediaan jadwal via AJAX sebelum submit (dipakai di form create/customer booking).
     */
    public function checkAvailability(Request $request)
    {
        $request->validate([
            'stylist_id' => ['required', 'exists:stylists,id'],
            'treatment_id' => ['required', 'exists:treatments,id'],
            'reservation_date' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i'],
        ]);

        $treatment = Treatment::findOrFail($request->treatment_id);
        $endTime = Reservation::calculateEndTime($request->start_time, $treatment->duration_minutes);

        $taken = Reservation::isScheduleTaken(
            $request->stylist_id,
            $request->reservation_date,
            $request->start_time,
            $endTime
        );

        return response()->json([
            'available' => ! $taken,
            'end_time' => $endTime,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => ['nullable', 'exists:customers,id'],
            'customer_name' => ['required_without:customer_id', 'nullable', 'string', 'max:100'],
            'customer_phone' => ['required_without:customer_id', 'nullable', 'string', 'max:20'],
            'customer_email' => ['nullable', 'email', 'max:100'],
            'stylist_id' => ['required', 'exists:stylists,id'],
            'treatment_id' => ['required', 'exists:treatments,id'],
            'reservation_date' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i'],
            'source' => ['required', 'in:Web/App Customer,WhatsApp,Telepon,Instagram,Admin'],
            'notes' => ['nullable', 'string'],
        ]);

        $treatment = Treatment::findOrFail($data['treatment_id']);
        $endTime = Reservation::calculateEndTime($data['start_time'], $treatment->duration_minutes);

        if (Reservation::isScheduleTaken($data['stylist_id'], $data['reservation_date'], $data['start_time'], $endTime)) {
            return back()->withInput()->withErrors(['start_time' => 'Jadwal stylist pada jam tersebut sudah terisi. Silakan pilih jam lain.']);
        }

        $reservation = DB::transaction(function () use ($data, $endTime) {
            // Cari atau buat customer baru berdasarkan nomor HP
            if (empty($data['customer_id'])) {
                $customer = Customer::firstOrCreate(
                    ['phone' => $data['customer_phone']],
                    ['name' => $data['customer_name'], 'email' => $data['customer_email'] ?? null]
                );
            } else {
                $customer = Customer::findOrFail($data['customer_id']);
            }

            $reservation = Reservation::create([
                'reservation_code' => Reservation::generateCode(),
                'customer_id' => $customer->id,
                'stylist_id' => $data['stylist_id'],
                'treatment_id' => $data['treatment_id'],
                'reservation_date' => $data['reservation_date'],
                'start_time' => $data['start_time'],
                'end_time' => $endTime,
                'source' => $data['source'],
                'status' => 'Menunggu Konfirmasi',
                'notes' => $data['notes'] ?? null,
                'created_by' => Auth::id(),
            ]);

            $reservation->statusLogs()->create([
                'old_status' => null,
                'new_status' => 'Menunggu Konfirmasi',
                'changed_by' => Auth::id(),
                'note' => 'Reservasi dibuat oleh admin/kasir.',
                'changed_at' => now(),
            ]);

            return $reservation;
        });

        return redirect()->route('admin.reservations.show', $reservation)
            ->with('success', 'Reservasi ' . $reservation->reservation_code . ' berhasil dibuat.');
    }

    public function show(Reservation $reservation)
    {
        $reservation->load(['customer', 'stylist', 'treatment', 'statusLogs.changedBy', 'transaction']);

        return view('admin.reservations.show', compact('reservation'));
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        $data = $request->validate([
            'status' => ['required', 'in:Menunggu Konfirmasi,Dikonfirmasi,Selesai,Dibatalkan'],
            'cancelled_reason' => ['nullable', 'string', 'max:255'],
        ]);

        if ($data['status'] === 'Dibatalkan') {
            $reservation->cancelled_reason = $data['cancelled_reason'] ?? null;
            $reservation->save();
        }

        $reservation->changeStatus($data['status'], Auth::id(), $data['cancelled_reason'] ?? null);

        return back()->with('success', 'Status reservasi berhasil diubah menjadi "' . $data['status'] . '".');
    }
}
