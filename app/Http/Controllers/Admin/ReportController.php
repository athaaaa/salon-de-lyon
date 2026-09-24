<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    /**
     * Laporan akhir bulan: jumlah pelanggan, jumlah reservasi, treatment paling
     * sering dipesan, laporan per stylist, laporan per layanan, penghasilan stylist.
     * Semua dihitung langsung dari tabel reservations & transactions (bukan tabel baru).
     */
    public function monthly(Request $request)
    {
        $month = (int) $request->input('month', now()->month);
        $year = (int) $request->input('year', now()->year);
        $start = Carbon::create($year, $month, 1)->startOfMonth();
        $end = $start->copy()->endOfMonth();

        $jumlahPelangganBaru = Customer::whereBetween('created_at', [$start, $end])->count();

        $jumlahReservasi = Reservation::betweenDates($start, $end)->count();

        $reservasiPerStatus = Reservation::betweenDates($start, $end)
            ->selectRaw('status, COUNT(*) as jumlah')
            ->groupBy('status')
            ->pluck('jumlah', 'status');

        $treatmentTerlaris = Reservation::betweenDates($start, $end)
            ->where('reservations.status', 'Selesai') // Tambahkan nama tabel 'reservations.'
            ->join('treatments', 'treatments.id', '=', 'reservations.treatment_id')
            ->selectRaw('treatments.name, COUNT(*) as jumlah')
            ->groupBy('treatments.id', 'treatments.name')
            ->get();

        $laporanPerStylist = Reservation::betweenDates($start, $end)
            ->where('reservations.status', 'Selesai')
            ->join('stylists', 'stylists.id', '=', 'reservations.stylist_id')
            ->leftJoin('transactions', 'transactions.reservation_id', '=', 'reservations.id')
            ->selectRaw('stylists.name, COUNT(reservations.id) as jumlah_treatment, COALESCE(SUM(transactions.total_amount), 0) as total_transaksi')
            ->groupBy('stylists.id', 'stylists.name')
            ->orderByDesc('total_transaksi')
            ->get();

        $totalPenghasilan = Transaction::whereBetween('transaction_date', [$start, $end])
            ->where('payment_status', 'Lunas')
            ->sum('total_amount');

        $data = compact(
            'start', 'end', 'jumlahPelangganBaru', 'jumlahReservasi', 'reservasiPerStatus',
            'treatmentTerlaris', 'laporanPerStylist', 'totalPenghasilan'
        );

        if ($request->boolean('print')) {
            return view('admin.reports.monthly', $data);
        }

        return view('admin.reports.monthly', $data + ['embed' => true]);
    }

    /**
     * Modul "Riwayat Treatment": daftar semua treatment yang sudah Selesai,
     * bisa dicari per nama customer. Data ini murni query, bukan tabel baru.
     */
    public function history(Request $request)
    {
        $riwayat = Reservation::with(['customer', 'treatment', 'stylist'])
            ->where('reservations.status', 'Selesai')
            ->when($request->q, fn ($q) => $q->whereHas('customer', fn ($c) => $c->where('name', 'like', "%{$request->q}%")))
            ->orderByDesc('reservation_date')
            ->paginate(15)
            ->withQueryString();

        return view('admin.reports.history', compact('riwayat'));
    }

    /**
     * Riwayat treatment seorang customer (dipakai juga oleh halaman detail customer).
     */
    public function customerHistory(Customer $customer)
    {
        $riwayat = Reservation::with(['treatment', 'stylist', 'transaction'])
            ->where('customer_id', $customer->id)
            ->where('status', 'Selesai')
            ->orderByDesc('reservation_date')
            ->get();

        return view('admin.reports.customer-history', compact('customer', 'riwayat'));
    }
}
