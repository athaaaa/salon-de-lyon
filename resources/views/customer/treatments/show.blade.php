@extends('layouts.customer')
@section('title', 'Detail Treatment')
@section('back', route('booking.treatments'))

@section('content')
<div class="px-4">
    <div class="bg-gradient-to-br from-brown-900 to-brown-950 rounded-2xl p-6 text-white mb-4">
        <p class="text-xs uppercase tracking-widest text-white/60 mb-1">{{ $treatment->category }}</p>
        <h1 class="font-serif text-xl mb-1">{{ $treatment->name }}</h1>
        <p class="text-lg font-medium">{{ $treatment->formatted_price }}</p>
        <p class="text-xs text-white/70 mt-1">⏱ {{ $treatment->duration_minutes }} menit</p>
    </div>

    <h2 class="text-sm font-medium mb-1">Deskripsi</h2>
    <p class="text-sm text-stone-600 mb-6 leading-relaxed">{{ $treatment->description ?: 'Tidak ada deskripsi tambahan untuk treatment ini.' }}</p>

    <a href="{{ route('booking.stylists', $treatment) }}"
       class="block w-full text-center bg-brown-950 text-white py-3 rounded-xl font-medium">
        Pilih Treatment Ini
    </a>
</div>
@endsection
