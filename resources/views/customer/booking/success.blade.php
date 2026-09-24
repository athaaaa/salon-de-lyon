@extends('layouts.customer')
@section('title', 'Booking Berhasil')

@section('content')
<div class="px-4 pt-8 text-center">
    <div class="w-16 h-16 rounded-full bg-gold-700 text-white flex items-center justify-center mx-auto mb-4">
        @include('partials.icon', ['name' => 'check-circle', 'class' => 'w-8 h-8', 'stroke' => 1.5])
    </div>
    <h1 class="font-serif text-lg mb-1">Booking Berhasil!</h1>
    <p class="text-sm text-stone-500 mb-6">Reservasi kamu telah kami terima.</p>

    <div class="bg-white rounded-xl border-2 border-dashed border-gold-700 p-4 mb-6">
        <p class="text-xs text-stone-500 mb-1">Kode Reservasi</p>
        <p class="font-mono text-xl font-bold text-brown-950">{{ $reservation->reservation_code }}</p>
    </div>

    <p class="text-xs text-stone-500 mb-6">Simpan kode reservasi ini untuk memeriksa status booking kamu kapan saja.</p>

    <div class="bg-white rounded-xl p-4 shadow-sm border border-stone-100 text-left text-sm space-y-1 mb-6">
        <p class="flex justify-between"><span class="text-stone-500">Treatment</span><span class="font-medium">{{ $reservation->treatment->name }}</span></p>
        <p class="flex justify-between"><span class="text-stone-500">Stylist</span><span class="font-medium">{{ $reservation->stylist->name }}</span></p>
        <p class="flex justify-between"><span class="text-stone-500">Tanggal</span><span class="font-medium">{{ \Carbon\Carbon::parse($reservation->reservation_date)->translatedFormat('d M Y') }}</span></p>
        <p class="flex justify-between"><span class="text-stone-500">Jam</span><span class="font-medium">{{ substr($reservation->start_time,0,5) }}</span></p>
    </div>

    <a href="{{ route('booking.status.show.code', $reservation->reservation_code) }}" class="block w-full bg-brown-950 text-white py-3 rounded-xl font-medium mb-2">
        Lihat Detail Booking
    </a>
    <a href="{{ route('home') }}" class="block w-full text-stone-500 py-2 text-sm">Kembali ke Beranda</a>
</div>
@endsection