@extends('layouts.customer')
@section('title', 'Cek Status Reservasi')
@section('back', route('home'))

@section('content')
<div class="px-4">
    <p class="text-sm text-stone-500 mb-4">Masukkan kode reservasi kamu (format: RSV-000125) untuk melihat status booking.</p>

    <form method="POST" action="{{ route('booking.status.show') }}" class="space-y-3">
        @csrf
        <input name="code" placeholder="RSV-000125" required
               class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm font-mono uppercase">
        <button class="w-full bg-brown-950 text-white py-3 rounded-xl font-medium">Cek Status</button>
    </form>

    <hr class="my-6 border-stone-200">

    <p class="text-sm font-medium mb-2">Atau lihat semua riwayat booking kamu</p>
    <form method="GET" action="{{ route('booking.history') }}" class="space-y-3">
        <input name="phone" placeholder="Nomor WhatsApp yang dipakai saat booking" required
               class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm">
        <button class="w-full border border-stone-300 text-stone-700 py-3 rounded-xl font-medium">Lihat Riwayat</button>
    </form>
</div>
@endsection
