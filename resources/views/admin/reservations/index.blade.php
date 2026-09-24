@extends('layouts.admin')
@section('title', 'Reservasi')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-3 mb-4">
    <form method="GET" class="flex flex-wrap gap-2 flex-1">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama, no. HP, atau kode reservasi..."
               class="rounded-lg border border-stone-300 px-4 py-2 text-sm flex-1 min-w-[220px]">
        <select name="status" onchange="this.form.submit()" class="rounded-lg border border-stone-300 px-3 py-2 text-sm">
            <option value="">Semua Status ({{ $statusCounts->sum() }})</option>
            @foreach (['Menunggu Konfirmasi','Dikonfirmasi','Selesai','Dibatalkan'] as $s)
                <option value="{{ $s }}" @selected(request('status') === $s)>{{ $s }} ({{ $statusCounts[$s] ?? 0 }})</option>
            @endforeach
        </select>
    </form>
    <a href="{{ route('admin.reservations.create') }}" class="bg-brown-950 text-white text-sm px-4 py-2 rounded-lg whitespace-nowrap">+ Tambah Reservasi (Manual)</a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-stone-100 overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-stone-50 text-stone-500 text-left">
            <tr>
                <th class="px-4 py-3">Kode</th>
                <th class="px-4 py-3">Customer</th>
                <th class="px-4 py-3">Tanggal</th>
                <th class="px-4 py-3">Jam</th>
                <th class="px-4 py-3">Stylist</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-stone-100">
            @forelse ($reservations as $r)
                @php
                    $badge = match($r->status) {
                        'Dikonfirmasi' => 'bg-blue-50 text-blue-700',
                        'Selesai' => 'bg-green-50 text-green-700',
                        'Dibatalkan' => 'bg-red-50 text-red-700',
                        default => 'bg-amber-50 text-amber-700',
                    };
                @endphp
                <tr>
                    <td class="px-4 py-3 font-mono text-xs">{{ $r->reservation_code }}</td>
                    <td class="px-4 py-3">{{ $r->customer->name }}</td>
                    <td class="px-4 py-3">{{ $r->reservation_date->format('d M Y') }}</td>
                    <td class="px-4 py-3">{{ substr($r->start_time,0,5) }} - {{ substr($r->end_time,0,5) }}</td>
                    <td class="px-4 py-3">{{ $r->stylist->name }}</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 rounded-full text-xs {{ $badge }}">{{ $r->status }}</span></td>
                    <td class="px-4 py-3">
                        <a href="{{ route('admin.reservations.show', $r) }}" class="text-gold-700 hover:underline">Detail</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="px-4 py-6 text-center text-stone-400">Belum ada reservasi.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $reservations->links() }}</div>
@endsection
