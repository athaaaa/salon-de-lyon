@extends('layouts.admin')
@section('title', 'Laporan')

@section('content')
<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
    <a href="{{ route('admin.reports.monthly') }}" class="bg-white rounded-xl shadow-sm border border-stone-100 p-5 hover:shadow-md transition">
        <div class="w-10 h-10 rounded-lg bg-stone-100 flex items-center justify-center mb-3 text-stone-800">
            @include('partials.icon', ['name' => 'calendar', 'class' => 'w-5 h-5'])
        </div>
        <p class="font-medium mb-1">Laporan Akhir Bulan</p>
        <p class="text-xs text-stone-500">Jumlah pelanggan baru, reservasi, treatment terlaris, dan performa stylist per bulan &mdash; bisa dicetak PDF.</p>
    </a>
    <a href="{{ route('admin.reports.history') }}" class="bg-white rounded-xl shadow-sm border border-stone-100 p-5 hover:shadow-md transition">
        <div class="w-10 h-10 rounded-lg bg-stone-100 flex items-center justify-center mb-3 text-stone-800">
            @include('partials.icon', ['name' => 'clock', 'class' => 'w-5 h-5'])
        </div>
        <p class="font-medium mb-1">Riwayat Treatment</p>
        <p class="text-xs text-stone-500">Daftar seluruh treatment yang sudah selesai, bisa dicari per nama customer.</p>
    </a>
    <a href="{{ route('admin.jadwal-stylist.index') }}" class="bg-white rounded-xl shadow-sm border border-stone-100 p-5 hover:shadow-md transition">
        <div class="w-10 h-10 rounded-lg bg-stone-100 flex items-center justify-center mb-3 text-stone-800">
            @include('partials.icon', ['name' => 'clipboard', 'class' => 'w-5 h-5'])
        </div>
        <p class="font-medium mb-1">Jadwal Stylist Harian</p>
        <p class="text-xs text-stone-500">Lihat &amp; cetak jadwal booking semua stylist pada tanggal tertentu.</p>
    </a>
</div>
@endsection
