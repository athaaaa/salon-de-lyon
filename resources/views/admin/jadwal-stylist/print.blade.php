<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Jadwal Stylist {{ $date->format('d-m-Y') }} — Salon De Lyon</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print { .no-print { display: none !important; } }
    </style>
</head>
<body class="font-sans text-stone-800 p-8">
    <div class="no-print mb-4 text-right">
        <button onclick="window.print()" class="inline-flex items-center gap-2 bg-[#2b1710] text-white text-sm px-4 py-2 rounded-lg">
            @include('partials.icon', ['name' => 'printer', 'class' => 'w-4 h-4'])
            Cetak / Simpan PDF
        </button>
    </div>
    <div class="flex items-center gap-3 mb-6 border-b pb-4">
        <img src="{{ asset('images/logo.jpeg') }}" class="w-12 h-12 rounded-full object-cover">
        <div>
            <p class="font-bold text-lg">Salon De Lyon</p>
            <p class="text-sm text-stone-500">Jadwal Stylist — {{ $date->translatedFormat('l, d F Y') }}</p>
        </div>
    </div>

    @include('admin.jadwal-stylist._table')

    <p class="text-[11px] text-stone-400 mt-6">Dicetak pada {{ now()->translatedFormat('d F Y - H:i') }}</p>
</body>
</html>
