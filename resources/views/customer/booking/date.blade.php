@extends('layouts.customer')
@section('title', 'Pilih Tanggal')
@section('back', route('booking.stylists', $treatment))

@section('content')
<div class="px-4">
    <div class="flex items-center gap-3 bg-white rounded-xl p-3 shadow-sm border border-stone-100 mb-4">
        <img src="{{ $stylist->photo_url }}" class="w-10 h-10 rounded-full object-cover">
        <div>
            <p class="text-sm font-medium">{{ $stylist->name }}</p>
            <p class="text-xs text-stone-500">{{ $treatment->name }} · {{ $treatment->duration_minutes }} menit</p>
        </div>
    </div>

    <form method="GET" action="{{ route('booking.time', [$treatment, $stylist]) }}">
        <label class="block text-sm font-medium mb-2">Pilih Tanggal</label>
        <input type="date" name="date" required min="{{ now()->toDateString() }}" value="{{ now()->toDateString() }}"
               class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm mb-5">
        <button class="w-full bg-brown-950 text-white py-3 rounded-xl font-medium">Lanjut Pilih Jam</button>
    </form>
</div>
@endsection
