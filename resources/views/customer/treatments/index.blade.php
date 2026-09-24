@extends('layouts.customer')
@section('title', 'Treatment')
@section('back', route('home'))

@section('content')
<div class="px-4">
    <form method="GET" class="mb-4">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari treatment..."
               class="w-full rounded-xl border border-stone-300 px-4 py-2.5 text-sm bg-white">
    </form>

    <div class="flex gap-2 overflow-x-auto pb-2 mb-4 text-xs">
        <a href="{{ route('booking.treatments') }}" class="px-3 py-1.5 rounded-full whitespace-nowrap {{ !request('category') ? 'bg-brown-950 text-white' : 'bg-white border border-stone-200' }}">Semua</a>
        @foreach ($categories as $cat)
            <a href="{{ route('booking.treatments', ['category' => $cat]) }}"
               class="px-3 py-1.5 rounded-full whitespace-nowrap {{ request('category') === $cat ? 'bg-brown-950 text-white' : 'bg-white border border-stone-200' }}">{{ $cat }}</a>
        @endforeach
    </div>

    @forelse ($treatments as $category => $items)
        <h2 class="font-serif text-sm text-stone-500 mb-2 mt-4">{{ $category }}</h2>
        <div class="space-y-2 mb-2">
            @foreach ($items as $t)
                <a href="{{ route('booking.treatments.show', $t) }}" class="flex items-center justify-between bg-white rounded-xl p-3.5 shadow-sm border border-stone-100">
                    <div>
                        <p class="text-sm font-medium">{{ $t->name }}</p>
                        <p class="text-xs text-stone-500 mt-0.5">{{ $t->formatted_price }} · {{ $t->duration_minutes }} menit</p>
                    </div>
                    <span class="text-stone-300">@include('partials.icon', ['name' => 'chevron-right', 'class' => 'w-4 h-4'])</span>
                </a>
            @endforeach
        </div>
    @empty
        <p class="text-center text-stone-400 py-10 text-sm">Treatment tidak ditemukan.</p>
    @endforelse
</div>
@endsection
