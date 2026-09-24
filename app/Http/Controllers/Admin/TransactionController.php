<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $transactions = Transaction::with(['reservation.customer', 'reservation.treatment', 'reservation.stylist'])
            ->when($request->q, function ($q) use ($request) {
                $q->where('transaction_code', 'like', "%{$request->q}%")
                    ->orWhereHas('reservation.customer', fn ($c) => $c->where('name', 'like', "%{$request->q}%"));
            })
            ->orderByDesc('transaction_date')
            ->paginate(15)
            ->withQueryString();

        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * Buat transaksi baru dari reservasi yang statusnya "Selesai".
     */
    public function store(Request $request, Reservation $reservation)
    {
        if ($reservation->transaction) {
            return back()->withErrors(['transaction' => 'Reservasi ini sudah memiliki transaksi.']);
        }

        $data = $request->validate([
            'total_amount' => ['required', 'numeric', 'min:0'],
            'payment_status' => ['required', 'in:Lunas,Belum Lunas'],
            'payment_method' => ['nullable', 'string', 'max:50'],
        ]);

        DB::transaction(function () use ($reservation, $data) {
            Transaction::create([
                'transaction_code' => Transaction::generateCode(),
                'reservation_id' => $reservation->id,
                'total_amount' => $data['total_amount'],
                'payment_status' => $data['payment_status'],
                'payment_method' => $data['payment_method'] ?? null,
                'transaction_date' => now(),
                'processed_by' => Auth::id(),
            ]);

            if ($reservation->status !== 'Selesai') {
                $reservation->changeStatus('Selesai', Auth::id(), 'Transaksi dicatat.');
            }
        });

        return redirect()->route('admin.reservations.show', $reservation)
            ->with('success', 'Transaksi berhasil dicatat.');
    }

    public function updateStatus(Request $request, Transaction $transaction)
    {
        $data = $request->validate([
            'payment_status' => ['required', 'in:Lunas,Belum Lunas'],
        ]);

        $transaction->update($data);

        return back()->with('success', 'Status pembayaran berhasil diperbarui.');
    }
}
