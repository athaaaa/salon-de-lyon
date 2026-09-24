@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<form method="GET" class="flex flex-wrap items-end gap-3 mb-6">
    <div>
        <label class="block text-xs text-stone-500 mb-1">Dari tanggal</label>
        <input type="date" name="start" value="{{ $start->toDateString() }}" class="rounded-lg border border-stone-300 px-3 py-2 text-sm">
    </div>
    <div>
        <label class="block text-xs text-stone-500 mb-1">Sampai tanggal</label>
        <input type="date" name="end" value="{{ $end->toDateString() }}" class="rounded-lg border border-stone-300 px-3 py-2 text-sm">
    </div>
    <button class="bg-brown-950 text-white text-sm px-4 py-2 rounded-lg">Terapkan</button>
</form>

{{-- KPI CARDS --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-xl p-4 shadow-sm border border-stone-100">
        <p class="text-xs text-stone-500">Total Reservasi</p>
        <p class="text-2xl font-semibold text-stone-800">{{ $totalReservasi }}</p>
    </div>
    <div class="bg-white rounded-xl p-4 shadow-sm border border-stone-100">
        <p class="text-xs text-stone-500">Total Customer</p>
        <p class="text-2xl font-semibold text-stone-800">{{ $totalCustomer }}</p>
    </div>
    <div class="bg-white rounded-xl p-4 shadow-sm border border-stone-100">
        <p class="text-xs text-stone-500">Total Transaksi</p>
        <p class="text-2xl font-semibold text-stone-800">Rp {{ number_format($totalTransaksi, 0, ',', '.') }}</p>
    </div>
    <div class="bg-white rounded-xl p-4 shadow-sm border border-stone-100">
        <p class="text-xs text-stone-500">Pendapatan (Lunas)</p>
        <p class="text-2xl font-semibold text-stone-800">Rp {{ number_format($pendapatanStylist, 0, ',', '.') }}</p>
    </div>
</div>

<div class="grid md:grid-cols-2 gap-4 mb-6">
    <div class="bg-white rounded-xl p-4 shadow-sm border border-stone-100">
        <p class="text-sm font-medium text-stone-700 mb-3">Reservasi per Hari</p>
        <canvas id="chartHarian" height="180"></canvas>
    </div>
    <div class="bg-white rounded-xl p-4 shadow-sm border border-stone-100">
        <p class="text-sm font-medium text-stone-700 mb-3">Treatment Paling Sering Dipesan</p>
        <canvas id="chartTreatment" height="180"></canvas>
    </div>
</div>

<div class="grid md:grid-cols-2 gap-4">
    <div class="bg-white rounded-xl p-4 shadow-sm border border-stone-100">
        <p class="text-sm font-medium text-stone-700 mb-3">Reservasi Berdasarkan Status</p>
        <canvas id="chartStatus" height="180"></canvas>
    </div>
    <div class="bg-white rounded-xl p-4 shadow-sm border border-stone-100">
        <p class="text-sm font-medium text-stone-700 mb-3">Pendapatan per Stylist</p>
        <canvas id="chartStylist" height="180"></canvas>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
<script>
new Chart(document.getElementById('chartHarian'), {
    type: 'line',
    data: {
        labels: {!! json_encode($reservasiPerHari->pluck('reservation_date')) !!},
        datasets: [{ label: 'Reservasi', data: {!! json_encode($reservasiPerHari->pluck('jumlah')) !!}, borderColor: '#8b5e26', tension: .3 }]
    },
    options: { plugins: { legend: { display: false } } }
});
new Chart(document.getElementById('chartTreatment'), {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($treatmentTerlaris->pluck('name')) !!},
        datasets: [{ data: {!! json_encode($treatmentTerlaris->pluck('jumlah')) !!}, backgroundColor: ['#8b5e26','#a9702e','#c98f4e','#e0b57e','#2b1710'] }]
    }
});
new Chart(document.getElementById('chartStatus'), {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($reservasiPerStatus->pluck('status')) !!},
        datasets: [{ data: {!! json_encode($reservasiPerStatus->pluck('jumlah')) !!}, backgroundColor: ['#e0b57e','#8b5e26','#4caf50','#e57373'] }]
    }
});
new Chart(document.getElementById('chartStylist'), {
    type: 'bar',
    data: {
        labels: {!! json_encode($pendapatanPerStylist->pluck('name')) !!},
        datasets: [{ label: 'Pendapatan', data: {!! json_encode($pendapatanPerStylist->pluck('total')) !!}, backgroundColor: '#8b5e26' }]
    },
    options: { plugins: { legend: { display: false } } }
});
</script>
@endpush
