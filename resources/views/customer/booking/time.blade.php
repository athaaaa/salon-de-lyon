@extends('layouts.customer')
@section('title', 'Pilih Jam')
@section('back', route('booking.date', [$treatment, $stylist]))

@section('content')
<div class="px-4">
    <p class="text-xs text-stone-500 mb-1">{{ \Carbon\Carbon::parse($date)->translatedFormat('l, d F Y') }}</p>
    <p class="text-sm font-medium mb-4">Pilih Jam Tersedia</p>

    <form method="GET" action="{{ route('booking.form', [$treatment, $stylist]) }}">
        <input type="hidden" name="date" value="{{ $date }}">
        <div class="grid grid-cols-3 gap-2 mb-5">
            @foreach ($availableSlots as $slot => $available)
                <label class="relative">
                    <input type="radio" name="time" value="{{ $slot }}" class="peer sr-only" {{ $available ? '' : 'disabled' }} required>
                    <div class="text-center py-2.5 rounded-lg border text-sm cursor-pointer
                                {{ $available ? 'border-stone-300 bg-white peer-checked:bg-brown-950 peer-checked:text-white peer-checked:border-brown-950' : 'border-stone-100 bg-stone-100 text-stone-300 cursor-not-allowed' }}">
                        {{ $slot }}
                    </div>
                </label>
            @endforeach
        </div>
        <p class="text-[11px] text-stone-400 mb-4">Jam yang tampak abu-abu berarti stylist sudah memiliki booking lain pada jam tersebut.</p>
        <button class="w-full bg-brown-950 text-white py-3 rounded-xl font-medium">Lanjut Isi Data</button>
    </form>
</div>
@endsection
