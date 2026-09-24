@extends('layouts.admin')
@section('title', 'Detail Reservasi - ' . $reservation->reservation_code)

@section('content')
<div class="mb-4 flex items-center justify-between">
    <a href="{{ route('admin.reservations.index') }}" class="inline-flex items-center text-sm text-stone-500 hover:text-stone-800 transition">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Kembali ke Daftar Reservasi
    </a>
</div>

{{-- NOTIFIKASI / FLASH MESSAGE --}}
@if (session('success'))
    <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200 text-green-700 text-sm flex items-center justify-between">
        <span>{{ session('success') }}</span>
        <button onclick="this.parentElement.remove()" class="text-green-900 font-bold ml-2">&times;</button>
    </div>
@endif

@if (session('error'))
    <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm flex items-center justify-between">
        <span>{{ session('error') }}</span>
        <button onclick="this.parentElement.remove()" class="text-red-900 font-bold ml-2">&times;</button>
    </div>
@endif

@php
    $badge = match($reservation->status) {
        'Dikonfirmasi' => 'bg-blue-100 text-blue-800 border-blue-200',
        'Selesai'      => 'bg-green-100 text-green-800 border-green-200',
        'Dibatalkan'   => 'bg-red-100 text-red-800 border-red-200',
        default        => 'bg-amber-100 text-amber-800 border-amber-200',
    };
@endphp

<div class="grid lg:grid-cols-3 gap-5">
    {{-- INFORMASI RESERVASI --}}
    <div class="bg-white rounded-xl shadow-sm border border-stone-200 p-5 flex flex-col justify-between">
        <div>
            <div class="flex items-center justify-between pb-3 mb-3 border-b border-stone-100">
                <h3 class="font-serif text-base font-semibold text-stone-800">Informasi Reservasi</h3>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $badge }}">
                    {{ $reservation->status }}
                </span>
            </div>
            
            <dl class="text-sm space-y-3">
                <div class="flex justify-between items-center">
                    <dt class="text-stone-400 text-xs">Kode Reservasi</dt>
                    <dd class="font-mono font-medium text-stone-800">{{ $reservation->reservation_code }}</dd>
                </div>
                <div class="flex justify-between items-center">
                    <dt class="text-stone-400 text-xs">Tanggal</dt>
                    <dd class="text-stone-800">
                        {{ $reservation->reservation_date ? \Carbon\Carbon::parse($reservation->reservation_date)->translatedFormat('l, d F Y') : '-' }}
                    </dd>
                </div>
                <div class="flex justify-between items-center">
                    <dt class="text-stone-400 text-xs">Jam</dt>
                    <dd class="text-stone-800">{{ substr($reservation->start_time, 0, 5) }} - {{ substr($reservation->end_time, 0, 5) }}</dd>
                </div>
                <div class="flex justify-between items-center">
                    <dt class="text-stone-400 text-xs">Stylist</dt>
                    <dd class="font-medium text-stone-800">{{ $reservation->stylist->name ?? '-' }}</dd>
                </div>
                <div class="flex justify-between items-center">
                    <dt class="text-stone-400 text-xs">Treatment</dt>
                    <dd class="font-medium text-stone-800">{{ $reservation->treatment->name ?? '-' }}</dd>
                </div>
                <div class="flex justify-between items-center">
                    <dt class="text-stone-400 text-xs">Durasi</dt>
                    <dd class="text-stone-800">{{ $reservation->treatment->duration_minutes ?? 0 }} menit</dd>
                </div>
                <div class="flex justify-between items-center">
                    <dt class="text-stone-400 text-xs">Harga</dt>
                    <dd class="font-semibold text-stone-800">{{ $reservation->treatment->formatted_price ?? '-' }}</dd>
                </div>
                <div class="flex justify-between items-center">
                    <dt class="text-stone-400 text-xs">Sumber</dt>
                    <dd class="text-stone-800 capitalize">{{ $reservation->source }}</dd>
                </div>
                <div class="pt-2 border-t border-stone-100">
                    <dt class="text-stone-400 text-xs mb-1">Catatan</dt>
                    <dd class="text-stone-600 bg-stone-50 p-2 rounded-lg text-xs italic">
                        {{ $reservation->notes ?: 'Tidak ada catatan.' }}
                    </dd>
                </div>
            </dl>
        </div>
    </div>

    {{-- INFORMASI CUSTOMER --}}
    <div class="bg-white rounded-xl shadow-sm border border-stone-200 p-5 flex flex-col justify-between">
        <div>
            <h3 class="font-serif text-base font-semibold text-stone-800 pb-3 mb-3 border-b border-stone-100">Informasi Customer</h3>
            <dl class="text-sm space-y-3">
                <div class="flex justify-between items-center">
                    <dt class="text-stone-400 text-xs">Nama</dt>
                    <dd class="font-medium text-stone-800">{{ $reservation->customer->name ?? '-' }}</dd>
                </div>
                <div class="flex justify-between items-center">
                    <dt class="text-stone-400 text-xs">No. HP</dt>
                    <dd class="text-stone-800">{{ $reservation->customer->phone ?? '-' }}</dd>
                </div>
                <div class="flex justify-between items-center">
                    <dt class="text-stone-400 text-xs">Email</dt>
                    <dd class="text-stone-800">{{ $reservation->customer->email ?: '-' }}</dd>
                </div>
                <div class="flex justify-between items-center">
                    <dt class="text-stone-400 text-xs">Total Kunjungan</dt>
                    <dd class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold bg-stone-100 text-stone-700">
                        {{ $reservation->customer->total_kunjungan ?? 0 }}x
                    </dd>
                </div>
            </dl>
            <div class="mt-4">
                @if($reservation->customer)
                <a href="{{ route('admin.reports.customer-history', $reservation->customer) }}" class="text-xs text-amber-700 hover:text-amber-900 hover:underline font-medium inline-flex items-center">
                    Lihat riwayat treatment customer
                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
                @endif
            </div>
        </div>

        <div class="mt-6 pt-4 border-t border-stone-100">
            <h4 class="text-sm font-semibold text-stone-800 mb-2">Ubah Status Reservasi</h4>
            <form method="POST" action="{{ route('admin.reservations.status', $reservation) }}" class="space-y-3" id="form-status">
                @csrf 
                @method('PUT')
                
                <div>
                    <select name="status" id="select-status" class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition">
                        @foreach (['Menunggu Konfirmasi','Dikonfirmasi','Selesai','Dibatalkan'] as $s)
                            <option value="{{ $s }}" @selected($reservation->status === $s)>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="cancel-reason-container" class="hidden">
                    <textarea name="cancelled_reason" id="cancel-reason" rows="2" placeholder="Masukkan alasan pembatalan..."
                              class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition"></textarea>
                </div>

                <button type="submit" class="w-full bg-stone-900 hover:bg-stone-800 text-white text-sm font-medium py-2 px-4 rounded-lg transition duration-150 shadow-sm">
                    Simpan Perubahan Status
                </button>
            </form>
        </div>
    </div>

    {{-- RIWAYAT STATUS + TRANSAKSI --}}
    <div class="bg-white rounded-xl shadow-sm border border-stone-200 p-5 flex flex-col justify-between">
        <div>
            <h3 class="font-serif text-base font-semibold text-stone-800 pb-3 mb-3 border-b border-stone-100">Riwayat Status</h3>
            
            <div class="max-h-56 overflow-y-auto pr-1">
                <ol class="relative border-l border-stone-200 ml-2 space-y-4 text-sm">
                    @forelse ($reservation->statusLogs as $log)
                        <li class="ml-4">
                            <div class="absolute w-2.5 h-2.5 bg-amber-600 rounded-full -left-1.25 mt-1 border border-white"></div>
                            <p class="font-medium text-stone-800 leading-tight">{{ $log->new_status }}</p>
                            <p class="text-xs text-stone-400 mt-0.5">
                                {{ $log->changed_at ? \Carbon\Carbon::parse($log->changed_at)->translatedFormat('d M Y - H:i') : '-' }}
                                @if($log->changedBy) · <span class="text-stone-600">{{ $log->changedBy->name }}</span> @endif
                            </p>
                            @if($log->note)
                                <p class="text-xs text-stone-500 mt-1 bg-stone-50 p-1.5 rounded border border-stone-100">{{ $log->note }}</p>
                            @endif
                        </li>
                    @empty
                        <li class="ml-4 text-stone-400 text-xs italic">Belum ada riwayat perubahan status.</li>
                    @endforelse
                </ol>
            </div>
        </div>

        <div class="mt-6 pt-4 border-t border-stone-100">
            <h4 class="text-sm font-semibold text-stone-800 mb-3">Transaksi</h4>
            @if ($reservation->transaction)
                <div class="bg-stone-50 rounded-lg p-3 border border-stone-200 space-y-2 text-sm">
                    <div class="flex justify-between items-center">
                        <dt class="text-stone-400 text-xs">Kode Transaksi</dt>
                        <dd class="font-mono text-stone-800 text-xs">{{ $reservation->transaction->transaction_code }}</dd>
                    </div>
                    <div class="flex justify-between items-center">
                        <dt class="text-stone-400 text-xs">Total Pembayaran</dt>
                        <dd class="font-semibold text-stone-800">{{ $reservation->transaction->formatted_total }}</dd>
                    </div>
                    <div class="flex justify-between items-center">
                        <dt class="text-stone-400 text-xs">Status Pembayaran</dt>
                        <dd>
                            <span class="px-2 py-0.5 text-xs rounded font-medium {{ $reservation->transaction->payment_status === 'Lunas' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $reservation->transaction->payment_status }}
                            </span>
                        </dd>
                    </div>
                    <div class="flex justify-between items-center">
                        <dt class="text-stone-400 text-xs">Metode</dt>
                        <dd class="text-stone-800 text-xs">{{ $reservation->transaction->payment_method ?: '-' }}</dd>
                    </div>
                </div>
            @else
                <form method="POST" action="{{ route('admin.transactions.store', $reservation) }}" class="space-y-2.5" id="form-transaction">
                    @csrf
                    <div>
                        <label class="block text-xs text-stone-400 mb-1">Total Biaya (Rp)</label>
                        <input type="number" name="total_amount" value="{{ $reservation->treatment->price ?? 0 }}" required
                               class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none" placeholder="Total (Rp)">
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block text-xs text-stone-400 mb-1">Metode</label>
                            <select name="payment_method" class="w-full rounded-lg border border-stone-300 px-2 py-2 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none">
                                <option value="Cash">Cash</option>
                                <option value="Transfer">Transfer</option>
                                <option value="QRIS">QRIS</option>
                                <option value="Kartu Debit/Kredit">Kartu Debit/Kredit</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs text-stone-400 mb-1">Status</label>
                            <select name="payment_status" class="w-full rounded-lg border border-stone-300 px-2 py-2 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none">
                                <option value="Lunas">Lunas</option>
                                <option value="Belum Lunas">Belum Lunas</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-amber-700 hover:bg-amber-800 text-white text-sm font-medium py-2 rounded-lg transition duration-150 shadow-sm mt-1">
                        Catat Transaksi
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectStatus = document.getElementById('select-status');
    const reasonContainer = document.getElementById('cancel-reason-container');
    const reasonInput = document.getElementById('cancel-reason');
    const formStatus = document.getElementById('form-status');
    const formTransaction = document.getElementById('form-transaction');

    function toggleReason() {
        const isCancelled = selectStatus.value === 'Dibatalkan';
        reasonContainer.classList.toggle('hidden', !isCancelled);
        
        if (isCancelled) {
            reasonInput.setAttribute('required', 'required');
        } else {
            reasonInput.removeAttribute('required');
        }
    }

    selectStatus.addEventListener('change', toggleReason);
    toggleReason();

    if (formStatus) {
        formStatus.addEventListener('submit', function(e) {
            if (!confirm('Apakah Anda yakin ingin memperbarui status reservasi ini?')) {
                e.preventDefault();
            }
        });
    }

    if (formTransaction) {
        formTransaction.addEventListener('submit', function(e) {
            if (!confirm('Apakah Anda yakin data transaksi sudah benar?')) {
                e.preventDefault();
            }
        });
    }
});
</script>
@endpush