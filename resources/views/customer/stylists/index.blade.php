@extends('layouts.customer')
@section('title', 'Pilih Stylist')
@section('back', route('booking.treatments.show', $treatment))

@section('content')
<div class="px-4">
    <p class="text-xs text-stone-500 mb-3">Treatment: <strong>{{ $treatment->name }}</strong></p>

    <div class="space-y-3">
        @forelse ($stylists as $s)
            <a href="{{ route('booking.date', [$treatment, $s]) }}" class="flex items-center gap-3 bg-white rounded-xl p-3.5 shadow-sm border border-stone-100">
                <img src="{{ $s->photo_url }}" class="w-12 h-12 rounded-full object-cover">
                <div>
                    <p class="text-sm font-medium">{{ $s->name }}</p>
                    <p class="text-xs text-stone-500">{{ $s->specialization }}</p>
                </div>
                <span class="ml-auto text-stone-300">@include('partials.icon', ['name' => 'chevron-right', 'class' => 'w-4 h-4'])</span>
            </a>
        @empty
            <p class="text-center text-stone-400 py-10 text-sm">Belum ada stylist yang tersedia untuk treatment ini.</p>
        @endforelse
    </div>
</div>
@endsection
