@if (!isset($embed))
{{-- Standalone print view: tidak butuh filter form --}}
@else
<form method="GET" class="flex flex-wrap items-end gap-3 mb-6 no-print">
    <div>
        <label class="block text-xs text-stone-500 mb-1">Bulan</label>
        <select name="month" class="rounded-lg border border-stone-300 px-3 py-2 text-sm">
            @foreach (range(1,12) as $m)
                <option value="{{ $m }}" @selected($start->month === $m)>{{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-xs text-stone-500 mb-1">Tahun</label>
        <input type="number" name="year" value="{{ $start->year }}" class="w-24 rounded-lg border border-stone-300 px-3 py-2 text-sm">
    </div>
    <button class="bg-brown-950 text-white text-sm px-4 py-2 rounded-lg">Tampilkan</button>
    <a href="{{ route('admin.reports.monthly', ['month' => $start->month, 'year' => $start->year, 'print' => 1]) }}"
       target="_blank" class="inline-flex items-center gap-2 bg-gold-700 text-white text-sm px-4 py-2 rounded-lg">
        @include('partials.icon', ['name' => 'printer', 'class' => 'w-4 h-4'])
        Cetak PDF
    </a>
</form>
@endif

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-xl p-4 shadow-sm border border-stone-100">
        <p class="text-xs text-stone-500">Pelanggan Baru</p>
        <p class="text-xl font-semibold">{{ $jumlahPelangganBaru }}</p>
    </div>
    <div class="bg-white rounded-xl p-4 shadow-sm border border-stone-100">
        <p class="text-xs text-stone-500">Total Reservasi</p>
        <p class="text-xl font-semibold">{{ $jumlahReservasi }}</p>
    </div>
    <div class="bg-white rounded-xl p-4 shadow-sm border border-stone-100">
        <p class="text-xs text-stone-500">Reservasi Selesai</p>
        <p class="text-xl font-semibold">{{ $reservasiPerStatus['Selesai'] ?? 0 }}</p>
    </div>
    <div class="bg-white rounded-xl p-4 shadow-sm border border-stone-100">
        <p class="text-xs text-stone-500">Total Penghasilan</p>
        <p class="text-xl font-semibold">Rp {{ number_format($totalPenghasilan, 0, ',', '.') }}</p>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-stone-100 p-5 mb-6">
    <h3 class="font-medium mb-3">Treatment Paling Sering Dipesan</h3>
    <table class="w-full text-sm">
        <thead class="text-left text-stone-500 border-b"><tr><th class="py-2">Treatment</th><th class="py-2">Jumlah Dipesan</th></tr></thead>
        <tbody>
            @forelse ($treatmentTerlaris as $t)
                <tr class="border-b border-stone-50"><td class="py-2">{{ $t->name }}</td><td class="py-2">{{ $t->jumlah }}x</td></tr>
            @empty
                <tr><td colspan="2" class="py-3 text-stone-400">Tidak ada data pada periode ini.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="bg-white rounded-xl shadow-sm border border-stone-100 p-5">
    <h3 class="font-medium mb-3">Laporan Berdasarkan Stylist</h3>
    <table class="w-full text-sm">
        <thead class="text-left text-stone-500 border-b"><tr><th class="py-2">Stylist</th><th class="py-2">Jumlah Treatment</th><th class="py-2">Total Transaksi</th></tr></thead>
        <tbody>
            @forelse ($laporanPerStylist as $s)
                <tr class="border-b border-stone-50">
                    <td class="py-2">{{ $s->name }}</td>
                    <td class="py-2">{{ $s->jumlah_treatment }}x</td>
                    <td class="py-2">Rp {{ number_format($s->total_transaksi, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr><td colspan="3" class="py-3 text-stone-400">Tidak ada data pada periode ini.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
