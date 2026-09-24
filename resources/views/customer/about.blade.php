@extends('layouts.customer')
@section('title', 'Tentang Kami')

@section('content')
{{-- HERO SECTION DENGAN FOTO INTERIOR SALON --}}
<div class="relative h-[280px] flex flex-col items-center justify-center text-center px-6"
     style="background-image: linear-gradient(180deg, rgba(43,23,16,.6) 0%, rgba(43,23,16,.85) 100%), url('{{ asset('images/salon-interior.jpg') }}'); background-size: cover; background-position: center;">
    <p class="text-[10px] tracking-[0.3em] uppercase text-white/70 mb-2 font-medium">Beauty Salon</p>
    <h1 class="font-serif text-3xl text-white font-medium leading-tight">Tentang Kami</h1>
    <p class="text-xs text-white/80 mt-2 max-w-xs font-light">Mengenal lebih dekat Salon De Lyon dan komitmen pelayanan kami</p>
</div>

<div class="px-5 py-6 space-y-6 -mt-6 relative z-10">

    <!-- DESKRIPSI UTAMA -->
    <div class="bg-white rounded-2xl p-5 shadow-lg border border-stone-100 text-stone-600 text-sm leading-relaxed space-y-4">
        <p class="first-letter:text-3xl first-letter:font-serif first-letter:text-amber-800 first-letter:float-left first-letter:mr-2 first-letter:leading-none">
            <strong class="text-stone-800 font-serif font-semibold text-base">Salon De Lyon</strong> merupakan salon kecantikan yang hadir untuk memberikan berbagai layanan perawatan dan styling yang berkualitas dengan mengutamakan kenyamanan dan kepuasan pelanggan. Kami menyediakan beragam pilihan treatment yang dapat disesuaikan dengan kebutuhan dan keinginan setiap pelanggan.
        </p>
        <p>
            Didukung oleh stylist yang berpengalaman dan pelayanan yang profesional, Salon De Lyon berkomitmen untuk memberikan pengalaman perawatan yang nyaman dan menyenangkan. Kami percaya bahwa setiap pelanggan memiliki kebutuhan dan gaya yang berbeda, sehingga kami siap membantu Anda mendapatkan penampilan yang sesuai dengan keinginan dan membuat Anda semakin percaya diri.
        </p>
    </div>

    <!-- SECTION MENGAPA MEMILIH KAMI -->
    <div class="space-y-4 pt-2">
        <div class="text-center space-y-1">
            <p class="text-[10px] tracking-[0.25em] uppercase text-amber-700 font-semibold">Keunggulan</p>
            <h2 class="font-serif text-xl text-stone-800">Mengapa Memilih Kami?</h2>
            <div class="w-10 h-0.5 bg-amber-600 mx-auto rounded-full mt-1"></div>
        </div>

        <div class="grid grid-cols-1 gap-3">
            <!-- Point 1 -->
            <div class="flex items-start gap-3.5 bg-white p-4 rounded-xl shadow-sm border border-stone-100">
                <span class="w-10 h-10 rounded-full bg-[#faf6ef] flex items-center justify-center text-amber-800 shrink-0 shadow-inner">
                    @include('partials.icon', ['name' => 'scissors', 'class' => 'w-5 h-5'])
                </span>
                <div>
                    <h3 class="font-serif font-semibold text-stone-800 text-sm mb-0.5">Beragam Treatment</h3>
                    <p class="text-xs text-stone-500 leading-relaxed">
                        Pilihan treatment yang dapat disesuaikan dengan kebutuhan dan keinginan Anda.
                    </p>
                </div>
            </div>

            <!-- Point 2 -->
            <div class="flex items-start gap-3.5 bg-white p-4 rounded-xl shadow-sm border border-stone-100">
                <span class="w-10 h-10 rounded-full bg-[#faf6ef] flex items-center justify-center text-amber-800 shrink-0 shadow-inner">
                    @include('partials.icon', ['name' => 'scissors', 'class' => 'w-5 h-5'])
                </span>
                <div>
                    <h3 class="font-serif font-semibold text-stone-800 text-sm mb-0.5">Stylist Berpengalaman</h3>
                    <p class="text-xs text-stone-500 leading-relaxed">
                        Ditangani oleh stylist yang memiliki keahlian dalam memberikan layanan terbaik.
                    </p>
                </div>
            </div>

            <!-- Point 3 -->
            <div class="flex items-start gap-3.5 bg-white p-4 rounded-xl shadow-sm border border-stone-100">
                <span class="w-10 h-10 rounded-full bg-[#faf6ef] flex items-center justify-center text-amber-800 shrink-0 shadow-inner">
                    @include('partials.icon', ['name' => 'scissors', 'class' => 'w-5 h-5'])
                </span>
                <div>
                    <h3 class="font-serif font-semibold text-stone-800 text-sm mb-0.5">Reservasi Lebih Mudah</h3>
                    <p class="text-xs text-stone-500 leading-relaxed">
                        Pesan treatment dengan lebih praktis melalui sistem reservasi yang mudah digunakan.
                    </p>
                </div>
            </div>

            <!-- Point 4 -->
            <div class="flex items-start gap-3.5 bg-white p-4 rounded-xl shadow-sm border border-stone-100">
                <span class="w-10 h-10 rounded-full bg-[#faf6ef] flex items-center justify-center text-amber-800 shrink-0 shadow-inner">
                    @include('partials.icon', ['name' => 'scissors', 'class' => 'w-5 h-5'])
                </span>
                <div>
                    <h3 class="font-serif font-semibold text-stone-800 text-sm mb-0.5">Pelayanan Nyaman</h3>
                    <p class="text-xs text-stone-500 leading-relaxed">
                        Kami mengutamakan kenyamanan dan kepuasan pelanggan dalam setiap kunjungan.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- TOMBOL ACTION -->
    <div class="pt-2">
        <a href="{{ route('booking.treatments') }}" class="block w-full text-center bg-brown-950 text-white py-3.5 rounded-xl font-medium text-sm shadow-md hover:bg-stone-800 transition tracking-wide">
            Lihat Layanan Treatment
        </a>
    </div>

</div>
@endsection