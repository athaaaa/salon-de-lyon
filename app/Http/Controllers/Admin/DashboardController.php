<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $start = $request->date('start', null) ?? Carbon::now()->subDays(7)->startOfDay();
        $end = $request->date('end', null) ?? Carbon::now()->endOfDay();

        $totalReservasi = Reservation::betweenDates($start, $end)->count();
        $totalCustomer = Customer::count();
        $totalTransaksi = Transaction::whereBetween('transaction_date', [$start, $end])->sum('total_amount');
        $pendapatanStylist = Transaction::whereBetween('transaction_date', [$start, $end])
            ->where('payment_status', 'Lunas')
            ->sum('total_amount');

        $reservasiPerHari = Reservation::betweenDates($start, $end)
            ->selectRaw('reservation_date, COUNT(*) as jumlah')
            ->groupBy('reservation_date')
            ->orderBy('reservation_date')
            ->get();

        $treatmentTerlaris = Reservation::betweenDates($start, $end)
            ->join('treatments', 'treatments.id', '=', 'reservations.treatment_id')
            ->selectRaw('treatments.name, COUNT(*) as jumlah')
            ->groupBy('treatments.id', 'treatments.name')
            ->orderByDesc('jumlah')
            ->limit(5)
            ->get();

        $reservasiPerStatus = Reservation::betweenDates($start, $end)
            ->selectRaw('status, COUNT(*) as jumlah')
            ->groupBy('status')
            ->get();

        $pendapatanPerStylist = Transaction::join('reservations', 'reservations.id', '=', 'transactions.reservation_id')
            ->join('stylists', 'stylists.id', '=', 'reservations.stylist_id')
            ->whereBetween('transactions.transaction_date', [$start, $end])
            ->selectRaw('stylists.name, SUM(transactions.total_amount) as total')
            ->groupBy('stylists.id', 'stylists.name')
            ->orderByDesc('total')
            ->get();

        return view('admin.dashboard', compact(
            'start', 'end', 'totalReservasi', 'totalCustomer', 'totalTransaksi', 'pendapatanStylist',
            'reservasiPerHari', 'treatmentTerlaris', 'reservasiPerStatus', 'pendapatanPerStylist'
        ));
    }
}
