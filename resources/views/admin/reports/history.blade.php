@extends('layouts.admin')
@section('title', 'Riwayat Treatment')

@section('content')
<form method="GET" class="mb-4">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama customer..."
           class="w-full max-w-sm rounded-lg border border-stone-300 px-4 py-2 text-sm">
</form>

<div class="bg-white rounded-xl shadow-sm border border-stone-100 overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-stone-50 text-stone-500 text-left">
            <tr>
                <th class="px-4 py-3">Customer</th>
                <th class="px-4 py-3">Treatment</th>
                <th class="px-4 py-3">Stylist</th>
                <th class="px-4 py-3">Tanggal</th>
                <th class="px-4 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-stone-100">
            @forelse ($riwayat as $r)
                <tr>
                    <td class="px-4 py-3 font-medium">{{ $r->customer->name }}</td>
                    <td class="px-4 py-3">{{ $r->treatment->name }}</td>
                    <td class="px-4 py-3">{{ $r->stylist->name }}</td>
                    <td class="px-4 py-3">{{ $r->reservation_date->format('d M Y') }}</td>
                    <td class="px-4 py-3">
                        <a href="{{ route('admin.reservations.show', $r) }}" class="text-gold-700 hover:underline">Detail</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-4 py-6 text-center text-stone-400">Belum ada riwayat treatment.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $riwayat->links() }}</div>
@endsection
