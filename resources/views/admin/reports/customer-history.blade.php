@extends('layouts.admin')
@section('title', 'Riwayat Treatment — ' . $customer->name)

@section('content')
<a href="{{ route('admin.customers.index') }}" class="inline-flex items-center gap-1.5 text-sm text-stone-500 hover:underline">
    @include('partials.icon', ['name' => 'chevron-left', 'class' => 'w-4 h-4'])
    Kembali
</a>

<div class="bg-white rounded-xl shadow-sm border border-stone-100 p-5 mt-3 mb-4">
    <h2 class="font-serif text-lg">{{ $customer->name }}</h2>
    <p class="text-sm text-stone-500">{{ $customer->phone }} @if($customer->email) · {{ $customer->email }} @endif</p>
    <p class="text-sm text-stone-500 mt-1">Total kunjungan: <strong>{{ $customer->total_kunjungan }}x</strong></p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-stone-100 overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-stone-50 text-stone-500 text-left">
            <tr>
                <th class="px-4 py-3">Tanggal</th>
                <th class="px-4 py-3">Treatment</th>
                <th class="px-4 py-3">Stylist</th>
                <th class="px-4 py-3">Total Bayar</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-stone-100">
            @forelse ($riwayat as $r)
                <tr>
                    <td class="px-4 py-3">{{ $r->reservation_date->format('d M Y') }}</td>
                    <td class="px-4 py-3">{{ $r->treatment->name }}</td>
                    <td class="px-4 py-3">{{ $r->stylist->name }}</td>
                    <td class="px-4 py-3">{{ $r->transaction?->formatted_total ?? '-' }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-4 py-6 text-center text-stone-400">Belum ada riwayat treatment selesai.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
