@extends('layouts.admin')
@section('title', 'Jadwal Stylist Harian')

@section('content')
<div class="grid md:grid-cols-3 gap-4">
    <div class="md:col-span-1 bg-white rounded-xl shadow-sm border border-stone-100 p-5">
        <form method="GET" class="space-y-3">
            <div>
                <label class="block text-xs text-stone-500 mb-1">Pilih Tanggal</label>
                <input type="date" name="date" value="{{ $date->toDateString() }}" class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-xs text-stone-500 mb-1">Pilih Stylist (Opsional)</label>
                <select name="stylist_id" class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
                    <option value="">Semua Stylist</option>
                    @foreach ($allStylists as $s)
                        <option value="{{ $s->id }}" @selected($selectedStylistId == $s->id)>{{ $s->name }}</option>
                    @endforeach
                </select>
            </div>
            <button class="w-full bg-brown-950 text-white text-sm py-2 rounded-lg">Lihat Jadwal</button>
            <a href="{{ route('admin.jadwal-stylist.index', ['date' => $date->toDateString(), 'stylist_id' => $selectedStylistId, 'print' => 1]) }}"
               target="_blank" class="flex items-center justify-center gap-2 w-full bg-gold-700 text-white text-sm py-2 rounded-lg">
            @include('partials.icon', ['name' => 'printer', 'class' => 'w-4 h-4'])
            Cetak PDF
        </a>
        </form>
    </div>

    <div class="md:col-span-2 bg-white rounded-xl shadow-sm border border-stone-100 p-5 overflow-x-auto">
        <h3 class="font-serif text-base mb-4">Jadwal Stylist — {{ $date->translatedFormat('l, d F Y') }}</h3>
        @include('admin.jadwal-stylist._table')
    </div>
</div>
@endsection
