@extends('layouts.customer')
@section('title', 'Detail Reservasi')
@section('back', route('booking.status.form'))

@section('content')
@php
    $badge = match($reservation->status) {
        'Dikonfirmasi' => 'bg-blue-50 text-blue-700 border-blue-200',
        'Selesai' => 'bg-green-50 text-green-700 border-green-200',
        'Dibatalkan' => 'bg-red-50 text-red-700 border-red-200',
        default => 'bg-amber-50 text-amber-700 border-amber-200',
    };
@endphp
<div class="px-4">
    <div class="bg-white rounded-xl shadow-sm border border-stone-100 p-4 mb-4">
        <div class="flex items-center justify-between mb-3">
            <p class="font-mono font-bold text-brown-950">{{ $reservation->reservation_code }}</p>
            <span class="px-2 py-1 rounded-full text-xs border {{ $badge }}">{{ $reservation->status }}</span>
        </div>
        <p class="text-[11px] text-stone-400 mb-3">Dibuat pada {{ $reservation->created_at->translatedFormat('d M Y H:i') }}</p>

        <p class="text-xs text-stone-400 mb-1">Detail Booking</p>
        <dl class="text-sm space-y-1 mb-1">
            <p class="flex justify-between"><span class="text-stone-500">Treatment</span><span class="font-medium">{{ $reservation->treatment->name }}</span></p>
            <p class="flex justify-between"><span class="text-stone-500">Stylist</span><span class="font-medium">{{ $reservation->stylist->name }}</span></p>
            <p class="flex justify-between"><span class="text-stone-500">Tanggal</span><span class="font-medium">{{ $reservation->reservation_date->translatedFormat('d M Y') }}</span></p>
            <p class="flex justify-between"><span class="text-stone-500">Jam</span><span class="font-medium">{{ substr($reservation->start_time,0,5) }}</span></p>
            <p class="flex justify-between"><span class="text-stone-500">Durasi</span><span class="font-medium">{{ $reservation->treatment->duration_minutes }} Menit</span></p>
            <p class="flex justify-between"><span class="text-stone-500">Harga</span><span class="font-medium">{{ $reservation->treatment->formatted_price }}</span></p>
        </dl>
    </div>

    @if ($reservation->status === 'Menunggu Konfirmasi' || $reservation->status === 'Dikonfirmasi')
        <div class="flex items-start gap-2 bg-amber-50 border border-amber-200 text-amber-800 text-xs rounded-xl p-3 mb-4">
            @include('partials.icon', ['name' => 'info-circle', 'class' => 'w-4 h-4 flex-shrink-0 mt-0.5'])
            <span>Mohon datang 10 menit sebelum jadwal reservasi.</span>
        </div>
        <form method="POST" action="{{ route('booking.cancel', $reservation) }}" onsubmit="return confirm('Yakin ingin membatalkan reservasi ini?')">
            @csrf
            <button class="w-full border border-red-300 text-red-600 py-3 rounded-xl font-medium">Batalkan Reservasi</button>
        </form>
    @endif
</div>
@endsection
