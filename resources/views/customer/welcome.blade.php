@extends('layouts.customer')
@section('title', 'Beranda')

@section('content')
{{-- HERO — foto interior salon asli, dilapisi overlay coklat transparan --}}
<div class="relative h-[520px] flex flex-col items-center justify-center text-center px-6"
     style="background-image:linear-gradient(180deg, rgba(43,23,16,.55) 0%, rgba(43,23,16,.72) 55%, rgba(43,23,16,.92) 100%), url('{{ asset('images/salon-interior.jpg') }}'); background-size:cover; background-position:center;">
    <img src="{{ asset('images/logo.jpeg') }}" alt="Salon De Lyon" class="w-16 h-16 rounded-full bg-white object-cover mb-5 ring-2 ring-white/40">
    <p class="text-[10px] tracking-[0.3em] uppercase text-white/60 mb-2">Beauty Salon</p>
    <h1 class="font-serif text-2xl text-white leading-snug">Selamat Datang di<br>Salon De LYON</h1>
    <p class="text-xs text-white/70 mt-2 mb-8">Cantik, percaya diri, setiap saat.</p>

    <div class="w-full max-w-xs space-y-2.5">
        <a href="{{ route('booking.treatments') }}" class="block w-full text-center bg-gold-700 text-white py-3 rounded-xl font-medium text-sm tracking-wide">
            Mulai Booking
        </a>
        <a href="#info-salon" class="block w-full text-center border border-white/40 text-white py-3 rounded-xl font-medium text-sm tracking-wide">
            Lihat Informasi Salon
        </a>
    </div>
</div>

<!-- Menu Grid Section (Simetris 3 Kolom x 2 Baris) -->
<div class="px-5 -mt-6 relative z-10">
    <div class="bg-white rounded-2xl shadow-lg border border-stone-100 p-4 grid grid-cols-3 gap-y-4 gap-x-2 text-center">
        <a href="{{ route('booking.treatments') }}" class="flex flex-col items-center gap-1.5">
            <span class="w-11 h-11 rounded-full bg-[#faf6ef] flex items-center justify-center text-brown-950">
                @include('partials.icon', ['name' => 'scissors', 'class' => 'w-5 h-5'])
            </span>
            <span class="text-[11px] text-stone-600">Treatment</span>
        </a>
        <a href="{{ route('booking.allStylists') }}" class="flex flex-col items-center gap-1.5">
            <span class="w-11 h-11 rounded-full bg-[#faf6ef] flex items-center justify-center text-brown-950">
                @include('partials.icon', ['name' => 'user', 'class' => 'w-5 h-5'])
            </span>
            <span class="text-[11px] text-stone-600">Stylist</span>
        </a>
        <a href="{{ route('booking.status.form') }}" class="flex flex-col items-center gap-1.5">
            <span class="w-11 h-11 rounded-full bg-[#faf6ef] flex items-center justify-center text-brown-950">
                @include('partials.icon', ['name' => 'calendar', 'class' => 'w-5 h-5'])
            </span>
            <span class="text-[11px] text-stone-600">Booking Saya</span>
        </a>
        <a href="{{ route('booking.history') }}" class="flex flex-col items-center gap-1.5">
            <span class="w-11 h-11 rounded-full bg-[#faf6ef] flex items-center justify-center text-brown-950">
                @include('partials.icon', ['name' => 'clock', 'class' => 'w-5 h-5'])
            </span>
            <span class="text-[11px] text-stone-600">Riwayat</span>
        </a>

        {{-- Mengarah ke halaman tentang-kami --}}
        <a href="{{ route('about') }}" class="flex flex-col items-center gap-1.5">
            <span class="w-11 h-11 rounded-full bg-[#faf6ef] flex items-center justify-center text-brown-950">
                @include('partials.icon', ['name' => 'building', 'class' => 'w-5 h-5'])
            </span>
            <span class="text-[11px] text-stone-600">Tentang Kami</span>
        </a>

        {{-- Mengarah ke halaman hubungi-kami --}}
        <a href="{{ route('contact') }}" class="flex flex-col items-center gap-1.5">
            <span class="w-11 h-11 rounded-full bg-[#faf6ef] flex items-center justify-center text-brown-950">
                @include('partials.icon', ['name' => 'phone', 'class' => 'w-5 h-5'])
            </span>
            <span class="text-[11px] text-stone-600">Hubungi Kami</span>
        </a>
    </div>
</div>

<div class="p-5 space-y-5">
    <div>
        <h2 class="font-serif text-base mb-3">Treatment Populer</h2>
        <div class="space-y-2">
            @foreach (\App\Models\Treatment::active()->inRandomOrder()->limit(4)->get() as $t)
                <a href="{{ route('booking.treatments.show', $t) }}" class="flex items-center justify-between bg-white rounded-xl p-3 shadow-sm border border-stone-100">
                    <div>
                        <p class="text-sm font-medium">{{ $t->name }}</p>
                        <p class="text-xs text-stone-500">{{ $t->formatted_price }} &middot; {{ $t->duration_minutes }} menit</p>
                    </div>
                    @include('partials.icon', ['name' => 'chevron-right', 'class' => 'w-4 h-4 text-stone-300'])
                </a>
            @endforeach
        </div>
    </div>

    {{-- INFORMASI SALON --}}
    <div id="info-salon" class="mt-6 p-4 bg-white rounded-xl shadow-sm border border-stone-100">
        <div class="flex items-center justify-between mb-3">
            <h3 class="font-semibold text-gray-800">Informasi Salon</h3>
            <a href="{{ route('contact') }}" class="text-xs text-[#785549] hover:underline font-medium">Lihat Detail &rarr;</a>
        </div>
        
        <!-- Alamat -->
        <div class="flex items-start gap-3 mb-2 text-sm text-gray-600">
            <svg class="w-5 h-5 text-gray-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h4m-4 0V11m0 0h4m-4 0H7m4 0v10" />
            </svg>
            <span>Dharmawangsa square, Jl. Dharmawangsa Raya No.157, RT.5/RW.1, Pulo, Kec. Kby. Baru, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta</span>
        </div>

        <!-- Jam Operasional -->
        <div class="flex items-center gap-3 mb-2 text-sm text-gray-600">
            <svg class="w-5 h-5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Setiap hari, 10.00 – 19.00 WIB</span>
        </div>

        <!-- Nomor Telepon -->
        <div class="flex items-center gap-3 text-sm text-gray-600">
            <svg class="w-5 h-5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
            <span>(021) 7395440</span>
        </div>
    </div>
</div>
@endsection