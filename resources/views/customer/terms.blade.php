@extends('layouts.customer')
@section('title', 'Syarat & Ketentuan')

@section('content')
{{-- HERO SECTION DENGAN FOTO INTERIOR SALON --}}
<div class="relative h-[220px] flex flex-col items-center justify-center text-center px-6"
     style="background-image: linear-gradient(180deg, rgba(43,23,16,.6) 0%, rgba(43,23,16,.85) 100%), url('{{ asset('images/salon-interior.jpg') }}'); background-size: cover; background-position: center;">
    <p class="text-[10px] tracking-[0.3em] uppercase text-white/70 mb-1 font-medium">Kebijakan Salon</p>
    <h1 class="font-serif text-2xl text-white font-medium leading-tight">Syarat & Ketentuan</h1>
    <p class="text-xs text-white/80 mt-1 max-w-xs font-light">Harap membaca ketentuan reservasi di Salon De Lyon</p>
</div>

<div class="px-5 py-6 space-y-6 -mt-6 relative z-10">

    <!-- DESKRIPSI PEMBUKA -->
    <div class="bg-white rounded-2xl p-5 shadow-lg border border-stone-100 text-stone-600 text-sm leading-relaxed text-center">
        <p class="font-serif text-stone-800 font-medium text-base mb-1">
            Syarat dan Ketentuan Booking
        </p>
        <p class="text-xs text-stone-500">
            Sebelum melakukan reservasi, harap membaca dan menyetujui ketentuan berikut demi kenyamanan bersama:
        </p>
    </div>

    <!-- DAFTAR SYARAT DAN KETENTUAN -->
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-stone-100 space-y-4">
        <div class="space-y-3.5">

            <!-- Poin 1 -->
            <div class="flex items-start gap-3">
                <span class="w-6 h-6 rounded-full bg-[#faf6ef] text-amber-800 font-serif font-semibold text-xs flex items-center justify-center shrink-0 mt-0.5 border border-amber-200">1</span>
                <p class="text-xs text-stone-600 leading-relaxed pt-0.5">
                    Customer wajib mengisi data diri dan informasi reservasi dengan benar dan lengkap.
                </p>
            </div>

            <!-- Poin 2 -->
            <div class="flex items-start gap-3">
                <span class="w-6 h-6 rounded-full bg-[#faf6ef] text-amber-800 font-serif font-semibold text-xs flex items-center justify-center shrink-0 mt-0.5 border border-amber-200">2</span>
                <p class="text-xs text-stone-600 leading-relaxed pt-0.5">
                    Reservasi dianggap berhasil setelah mendapatkan konfirmasi dari pihak Salon De Lyon.
                </p>
            </div>

            <!-- Poin 3 -->
            <div class="flex items-start gap-3">
                <span class="w-6 h-6 rounded-full bg-[#faf6ef] text-amber-800 font-serif font-semibold text-xs flex items-center justify-center shrink-0 mt-0.5 border border-amber-200">3</span>
                <p class="text-xs text-stone-600 leading-relaxed pt-0.5">
                    Customer diharapkan datang sesuai dengan tanggal dan waktu reservasi yang telah dipilih.
                </p>
            </div>

            <!-- Poin 4 -->
            <div class="flex items-start gap-3">
                <span class="w-6 h-6 rounded-full bg-[#faf6ef] text-amber-800 font-serif font-semibold text-xs flex items-center justify-center shrink-0 mt-0.5 border border-amber-200">4</span>
                <p class="text-xs text-stone-600 leading-relaxed pt-0.5">
                    Mohon datang tepat waktu. Keterlambatan dapat memengaruhi waktu pelayanan dan jadwal treatment.
                </p>
            </div>

            <!-- Poin 5 -->
            <div class="flex items-start gap-3">
                <span class="w-6 h-6 rounded-full bg-[#faf6ef] text-amber-800 font-serif font-semibold text-xs flex items-center justify-center shrink-0 mt-0.5 border border-amber-200">5</span>
                <p class="text-xs text-stone-600 leading-relaxed pt-0.5">
                    Perubahan atau pembatalan reservasi dapat dilakukan dengan menghubungi pihak Salon De Lyon terlebih dahulu.
                </p>
            </div>

            <!-- Poin 6 -->
            <div class="flex items-start gap-3">
                <span class="w-6 h-6 rounded-full bg-[#faf6ef] text-amber-800 font-serif font-semibold text-xs flex items-center justify-center shrink-0 mt-0.5 border border-amber-200">6</span>
                <p class="text-xs text-stone-600 leading-relaxed pt-0.5">
                    Jadwal reservasi dapat berubah apabila terdapat kondisi tertentu yang tidak dapat dihindari. Pihak salon akan menginformasikan kepada customer apabila terjadi perubahan.
                </p>
            </div>

            <!-- Poin 7 -->
            <div class="flex items-start gap-3">
                <span class="w-6 h-6 rounded-full bg-[#faf6ef] text-amber-800 font-serif font-semibold text-xs flex items-center justify-center shrink-0 mt-0.5 border border-amber-200">7</span>
                <p class="text-xs text-stone-600 leading-relaxed pt-0.5">
                    Customer diharapkan memilih treatment dan stylist sesuai dengan kebutuhan. Informasi mengenai harga dan durasi treatment dapat dilihat pada halaman layanan.
                </p>
            </div>

            <!-- Poin 8 -->
            <div class="flex items-start gap-3 pt-2 border-t border-stone-100">
                <span class="w-6 h-6 rounded-full bg-amber-800 text-white font-serif font-semibold text-xs flex items-center justify-center shrink-0 mt-0.5">✓</span>
                <p class="text-xs text-stone-700 font-medium leading-relaxed pt-0.5">
                    Dengan melakukan booking, customer dianggap telah membaca, memahami, dan menyetujui seluruh syarat dan ketentuan yang berlaku.
                </p>
            </div>

        </div>
    </div>

    {{-- FOOTER BANNER FOTO ELEGAN --}}
    <div class="relative h-[130px] rounded-2xl overflow-hidden shadow-sm flex flex-col items-center justify-center text-center p-4"
         style="background-image: linear-gradient(180deg, rgba(43,23,16,.7) 0%, rgba(43,23,16,.85) 100%), url('{{ asset('images/salon-interior.jpg') }}'); background-size: cover; background-position: center;">
        <img src="{{ asset('images/logo.jpeg') }}" alt="Salon De Lyon" class="w-8 h-8 rounded-full bg-white object-cover mb-1.5 ring-1 ring-white/50">
        <h3 class="font-serif text-sm text-white font-medium">Salon De LYON</h3>
        <p class="text-[10px] text-white/70 tracking-wider">Cantik, percaya diri, setiap saat.</p>
    </div>

</div>
@endsection