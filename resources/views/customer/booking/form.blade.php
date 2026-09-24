@extends('layouts.customer')
@section('title', 'Data Customer')
@section('back', route('booking.time', [$treatment, $stylist]) . '?date=' . $date)

@section('content')
<div class="px-4">
    <div class="bg-white rounded-xl p-4 shadow-sm border border-stone-100 mb-4 text-sm space-y-1">
        <p class="flex justify-between"><span class="text-stone-500">Treatment</span><span class="font-medium">{{ $treatment->name }}</span></p>
        <p class="flex justify-between"><span class="text-stone-500">Stylist</span><span class="font-medium">{{ $stylist->name }}</span></p>
        <p class="flex justify-between"><span class="text-stone-500">Tanggal</span><span class="font-medium">{{ \Carbon\Carbon::parse($date)->translatedFormat('d M Y') }}</span></p>
        <p class="flex justify-between"><span class="text-stone-500">Jam</span><span class="font-medium">{{ $time }}</span></p>
        <p class="flex justify-between"><span class="text-stone-500">Harga</span><span class="font-medium">{{ $treatment->formatted_price }}</span></p>
    </div>

    <form method="POST" action="{{ route('booking.store', [$treatment, $stylist]) }}" class="space-y-3">
        @csrf
        <input type="hidden" name="date" value="{{ $date }}">
        <input type="hidden" name="time" value="{{ $time }}">

        <div>
            <label class="block text-xs text-stone-500 mb-1">Nama Lengkap</label>
            <input name="name" value="{{ old('name') }}" required class="w-full rounded-xl border border-stone-300 px-4 py-2.5 text-sm">
        </div>
        <div>
            <label class="block text-xs text-stone-500 mb-1">No. WhatsApp</label>
            <input name="phone" value="{{ old('phone') }}" required class="w-full rounded-xl border border-stone-300 px-4 py-2.5 text-sm">
        </div>
        <div>
            <label class="block text-xs text-stone-500 mb-1">Email (opsional)</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-xl border border-stone-300 px-4 py-2.5 text-sm">
        </div>
        <div>
            <label class="block text-xs text-stone-500 mb-1">Catatan (opsional)</label>
            <textarea name="notes" class="w-full rounded-xl border border-stone-300 px-4 py-2.5 text-sm">{{ old('notes') }}</textarea>
        </div>
        
        {{-- Checkbox Syarat & Ketentuan dengan Link Biru (Buka di Tab Baru) --}}
        <div class="flex items-start gap-2 pt-1">
            <input type="checkbox" id="agree" name="agree" required class="mt-0.5 rounded border-stone-300 text-brown-950 focus:ring-brown-950 w-4 h-4">
            <label for="agree" class="text-xs text-stone-500 leading-tight">
                Saya setuju dengan 
                <a href="{{ route('terms') }}" target="_blank" class="text-blue-600 font-semibold underline hover:text-blue-800">
                    syarat & ketentuan
                </a> 
                booking Salon De Lyon.
            </label>
        </div>

        <button class="w-full bg-brown-950 text-white py-3 rounded-xl font-medium mt-2">Lanjut Konfirmasi</button>
    </form>
</div>
@endsection