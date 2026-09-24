@extends('layouts.customer')
@section('title', 'Hubungi Kami')

@section('content')
{{-- Header Halaman --}}
<div class="relative h-[220px] flex flex-col items-center justify-center text-center px-6"
     style="background-image:linear-gradient(180deg, rgba(43,23,16,.65) 0%, rgba(43,23,16,.85) 100%), url('{{ asset('images/salon-interior.jpg') }}'); background-size:cover; background-position:center;">
    <h1 class="font-serif text-2xl text-white font-bold">Hubungi Kami</h1>
    <p class="text-xs text-white/70 mt-1">Pilih metode komunikasi yang Anda inginkan</p>
</div>

<div class="p-5 space-y-5">
    
    <h2 class="font-semibold text-stone-800 text-sm">Pilih Layanan Kontak</h2>

    {{-- OPSI 1: TELEPON --}}
    <a href="tel:0217395440" class="block bg-white rounded-2xl p-4 shadow-sm border border-stone-100 hover:border-gold-700 transition">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3.5">
                <span class="w-11 h-11 rounded-full bg-[#faf6ef] flex items-center justify-center text-brown-950 shrink-0">
                    <svg class="w-5 h-5 text-amber-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                </span>
                <div>
                    <p class="font-medium text-stone-800 text-sm">Telepon Salon</p>
                    <p class="text-xs text-stone-500 mt-0.5">(021) 7395440</p>
                </div>
            </div>
            <span class="text-xs font-semibold text-amber-900 bg-amber-50 px-3 py-1.5 rounded-lg">Panggil</span>
        </div>
    </a>

    {{-- OPSI 2: WHATSAPP (Otomatis Buka App WhatsApp ke Room Chat) --}}
    <a href="https://wa.me/628995245455?text=Halo%20Salon%20De%20LYON,%20saya%20ingin%20bertanya%20mengenai%20layanan%20salon" 
       target="_blank" 
       class="block bg-emerald-50 rounded-2xl p-4 shadow-sm border border-emerald-200 hover:bg-emerald-100 transition">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3.5">
                <span class="w-11 h-11 rounded-full bg-emerald-600 flex items-center justify-center text-white shrink-0">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.572-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                    </svg>
                </span>
                <div>
                    <p class="font-medium text-emerald-950 text-sm">WhatsApp Chat</p>
                    <p class="text-xs text-emerald-700 mt-0.5">08995245455</p>
                </div>
            </div>
            <span class="text-xs font-semibold text-white bg-emerald-600 px-3 py-1.5 rounded-lg shadow-sm">Chat</span>
        </div>
    </a>

    {{-- Info Alamat & Jam Operasional --}}
    <div class="bg-white rounded-2xl p-4 shadow-sm border border-stone-100 space-y-3 mt-4">
        <h3 class="font-semibold text-stone-800 text-xs uppercase tracking-wider text-stone-400">Informasi Tambahan</h3>
        <p class="text-xs text-stone-600"><strong>Alamat:</strong> Dharmawangsa square, Jl. Dharmawangsa Raya No.157, RT.5/RW.1, Pulo, Kec. Kby. Baru, Kota Jakarta Selatan, DKI Jakarta</p>
        <p class="text-xs text-stone-600"><strong>Jam Operasional:</strong> Setiap hari, 10.00 – 19.00 WIB</p>
    </div>

</div>
@endsection