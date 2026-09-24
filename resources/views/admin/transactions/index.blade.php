@extends('layouts.admin')
@section('title', 'Transaksi')

@section('content')
<form method="GET" class="mb-4">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari kode transaksi atau nama customer..."
           class="w-full max-w-sm rounded-lg border border-stone-300 px-4 py-2 text-sm">
</form>

<div class="bg-white rounded-xl shadow-sm border border-stone-100 overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-stone-50 text-stone-500 text-left">
            <tr>
                <th class="px-4 py-3">Kode Transaksi</th>
                <th class="px-4 py-3">Tanggal</th>
                <th class="px-4 py-3">Customer</th>
                <th class="px-4 py-3">Total</th>
                <th class="px-4 py-3">Metode</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-stone-100">
            @forelse ($transactions as $t)
                <tr>
                    <td class="px-4 py-3 font-mono text-xs">{{ $t->transaction_code }}</td>
                    <td class="px-4 py-3">
                        {{ $t->transaction_date ? \Carbon\Carbon::parse($t->transaction_date)->translatedFormat('d M Y') : '-' }}
                    </td>
                    <td class="px-4 py-3">{{ $t->reservation->customer->name ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $t->formatted_total }}</td>
                    <td class="px-4 py-3">{{ $t->payment_method ?: '-' }}</td>
                    <td class="px-4 py-3">
                        <form method="POST" action="{{ route('admin.transactions.status', $t) }}" onchange="this.submit()">
                            @csrf @method('PUT')
                            <select name="payment_status" class="text-xs rounded-full px-2 py-1 border
                                {{ $t->payment_status === 'Lunas' ? 'bg-green-50 text-green-700 border-green-200' : 'bg-amber-50 text-amber-700 border-amber-200' }}">
                                <option value="Lunas" @selected($t->payment_status === 'Lunas')>Lunas</option>
                                <option value="Belum Lunas" @selected($t->payment_status === 'Belum Lunas')>Belum Lunas</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-4 py-3">
                        @if($t->reservation)
                            <a href="{{ route('admin.reservations.show', $t->reservation) }}" class="text-gold-700 hover:underline">Detail</a>
                        @else
                            <span class="text-stone-400">-</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="px-4 py-6 text-center text-stone-400">Belum ada transaksi.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $transactions->links() }}</div>
@endsection