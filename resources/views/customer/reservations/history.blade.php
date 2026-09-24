@extends('layouts.customer')
@section('title', 'Riwayat Reservasi')
@section('back', route('home'))

@section('content')
<div class="px-4">
    <form method="GET" class="mb-4">
        <input name="phone" value="{{ $phone }}" placeholder="Nomor WhatsApp"
               class="w-full rounded-xl border border-stone-300 px-4 py-2.5 text-sm">
    </form>

    <div class="flex gap-2 mb-4 text-xs">
        <span class="px-3 py-1.5 rounded-full bg-brown-950 text-white">Semua</span>
    </div>

    <div class="space-y-3">
        @forelse ($reservations as $r)
            @php
                $badge = match($r->status) {
                    'Dikonfirmasi' => 'bg-blue-50 text-blue-700',
                    'Selesai' => 'bg-green-50 text-green-700',
                    'Dibatalkan' => 'bg-red-50 text-red-700',
                    default => 'bg-amber-50 text-amber-700',
                };
            @endphp
            <a href="{{ route('booking.status.show.code', $r->reservation_code) }}" class="block bg-white rounded-xl p-3.5 shadow-sm border border-stone-100">
                <div class="flex items-center justify-between mb-1">
                    <p class="font-mono text-xs font-medium">{{ $r->reservation_code }}</p>
                    <span class="px-2 py-0.5 rounded-full text-[10px] {{ $badge }}">{{ $r->status }}</span>
                </div>
                <p class="text-xs text-stone-500">{{ $r->reservation_date->translatedFormat('d M Y') }} · {{ substr($r->start_time,0,5) }}</p>
                <p class="text-sm mt-1">{{ $r->treatment->name }} · {{ $r->stylist->name }}</p>
            </a>
        @empty
            <p class="text-center text-stone-400 py-10 text-sm">
                @if($phone)
                    Tidak ditemukan riwayat untuk nomor ini.
                @else
                    Masukkan nomor WhatsApp untuk melihat riwayat booking kamu.
                @endif
            </p>
        @endforelse
    </div>
</div>
@endsection
