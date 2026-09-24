@extends('layouts.customer')
@section('title', 'Daftar Stylist')

@section('content')
<div class="p-5 space-y-4">
    <div class="flex items-center gap-3 mb-2">
        <a href="{{ route('home') }}" class="w-8 h-8 flex items-center justify-center rounded-full bg-white shadow text-stone-700">
            @include('partials.icon', ['name' => 'chevron-left', 'class' => 'w-4 h-4'])
        </a>
        <h1 class="font-serif text-lg font-medium">Tim Stylist Salon De LYON</h1>
    </div>

    <p class="text-xs text-stone-500">Pilih stylist favoritmu untuk melihat atau memesan layanan yang mereka tangani.</p>

    <div class="grid grid-cols-2 gap-3">
        @foreach ($stylists as $stylist)
            <div class="bg-white rounded-xl p-4 shadow-sm border border-stone-100 flex flex-col items-center text-center space-y-2">
                <img src="{{ $stylist->photo_url }}" class="w-16 h-16 rounded-full object-cover bg-stone-100 border">
                <div>
                    <h3 class="text-sm font-medium text-stone-800">{{ $stylist->name }}</h3>
                    <p class="text-xs text-stone-500 mt-0.5">{{ $stylist->specialization ?? 'Stylist Profesional' }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection