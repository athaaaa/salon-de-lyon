@if (isset($embed))
@extends('layouts.admin')
@section('title', 'Laporan Akhir Bulan')
@section('content')
    @include('admin.reports._monthly-content')
@endsection
@else
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Bulanan {{ $start->translatedFormat('F Y') }} — Salon De Lyon</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none !important; }
            body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
</head>
<body class="font-sans text-stone-800 p-8 max-w-3xl mx-auto">
    <div class="no-print mb-4 text-right">
        <button onclick="window.print()" class="inline-flex items-center gap-2 bg-brown-950 bg-[#2b1710] text-white text-sm px-4 py-2 rounded-lg">
            @include('partials.icon', ['name' => 'printer', 'class' => 'w-4 h-4'])
            Cetak / Simpan PDF
        </button>
    </div>
    <div class="flex items-center gap-3 mb-6 border-b pb-4">
        <img src="{{ asset('images/logo.jpeg') }}" class="w-12 h-12 rounded-full object-cover">
        <div>
            <p class="font-bold text-lg">Salon De Lyon</p>
            <p class="text-sm text-stone-500">Laporan Akhir Bulan — {{ $start->translatedFormat('F Y') }}</p>
        </div>
    </div>
    @include('admin.reports._monthly-content')
    <p class="text-[11px] text-stone-400 mt-8">Dicetak pada {{ now()->translatedFormat('d F Y - H:i') }}</p>
</body>
</html>
@endif
