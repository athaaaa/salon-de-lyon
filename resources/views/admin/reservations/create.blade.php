@extends('layouts.admin')
@section('title', 'Tambah Reservasi (Manual)')

@section('content')
<a href="{{ route('admin.reservations.index') }}" class="inline-flex items-center gap-1.5 text-sm text-stone-500 hover:underline">
    @include('partials.icon', ['name' => 'chevron-left', 'class' => 'w-4 h-4'])
    Kembali
</a>

<div class="bg-white rounded-xl shadow-sm border border-stone-100 p-6 mt-3 max-w-3xl">
    <h2 class="font-serif text-lg mb-4">Tambah Reservasi (Manual)</h2>
    <p class="text-xs text-stone-500 mb-4">Dipakai untuk booking yang masuk lewat Telepon, WhatsApp, atau Instagram.</p>

    <form method="POST" action="{{ route('admin.reservations.store') }}" class="space-y-4" id="form-reservasi">
        @csrf

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs text-stone-500 mb-1">Customer (pilih yang sudah ada, atau isi baru di bawah)</label>
                <select name="customer_id" id="customer_id" class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
                    <option value="">-- Customer baru --</option>
                    @foreach ($customers as $c)
                        <option value="{{ $c->id }}">{{ $c->name }} ({{ $c->phone }})</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs text-stone-500 mb-1">Sumber Reservasi</label>
                <select name="source" class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
                    <option value="Admin">Admin</option>
                    <option value="Telepon">Telepon</option>
                    <option value="WhatsApp">WhatsApp</option>
                    <option value="Instagram">Instagram</option>
                </select>
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-4">
            <input name="customer_name" placeholder="Nama customer" class="rounded-lg border border-stone-300 px-3 py-2 text-sm">
            <input name="customer_phone" placeholder="No. HP customer" class="rounded-lg border border-stone-300 px-3 py-2 text-sm">
            <input name="customer_email" placeholder="Email (opsional)" class="rounded-lg border border-stone-300 px-3 py-2 text-sm">
        </div>
        <p class="text-[11px] text-stone-400 -mt-2">*Nama & No. HP wajib diisi kalau tidak memilih customer yang sudah ada.</p>

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs text-stone-500 mb-1">Treatment</label>
                <select name="treatment_id" id="treatment_id" required class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
                    <option value="">-- Pilih treatment --</option>
                    @foreach ($treatments as $t)
                        <option value="{{ $t->id }}" data-duration="{{ $t->duration_minutes }}">{{ $t->name }} ({{ $t->duration_minutes }} mnt — {{ $t->formatted_price }})</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs text-stone-500 mb-1">Stylist</label>
                <select name="stylist_id" id="stylist_id" required class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
                    <option value="">-- Pilih stylist --</option>
                    @foreach ($stylists as $s)
                        <option value="{{ $s->id }}">{{ $s->name }} — {{ $s->specialization }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs text-stone-500 mb-1">Tanggal</label>
                <input type="date" name="reservation_date" id="reservation_date" required class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-xs text-stone-500 mb-1">Jam Mulai</label>
                <input type="time" name="start_time" id="start_time" required class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
            </div>
        </div>

        <div id="availability-info" class="text-sm hidden rounded-lg px-3 py-2"></div>

        <textarea name="notes" placeholder="Catatan tambahan (opsional)" class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm"></textarea>

        <div class="flex justify-end gap-2 pt-2">
            <button type="reset" class="px-4 py-2 text-sm text-stone-500">Reset</button>
            <button class="px-5 py-2 text-sm bg-brown-950 text-white rounded-lg">Simpan Reservasi</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
const info = document.getElementById('availability-info');
async function checkAvailability() {
    const stylistId = document.getElementById('stylist_id').value;
    const treatmentId = document.getElementById('treatment_id').value;
    const date = document.getElementById('reservation_date').value;
    const time = document.getElementById('start_time').value;

    if (!stylistId || !treatmentId || !date || !time) return;

    const res = await fetch(`{{ route('admin.reservations.check') }}`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ stylist_id: stylistId, treatment_id: treatmentId, reservation_date: date, start_time: time })
    });
    const data = await res.json();
    info.classList.remove('hidden');
    if (data.available) {
        info.className = 'text-sm rounded-lg px-3 py-2 bg-green-50 text-green-700';
        info.textContent = `Jadwal tersedia. Estimasi selesai pukul ${data.end_time}.`;
    } else {
        info.className = 'text-sm rounded-lg px-3 py-2 bg-red-50 text-red-700';
        info.textContent = 'Jadwal bentrok dengan reservasi lain. Silakan pilih jam/stylist lain.';
    }
}
['stylist_id', 'treatment_id', 'reservation_date', 'start_time'].forEach(id => {
    document.getElementById(id).addEventListener('change', checkAvailability);
});
document.getElementById('customer_id').addEventListener('change', function () {
    const fields = document.querySelectorAll('[name=customer_name],[name=customer_phone],[name=customer_email]');
    fields.forEach(f => f.disabled = this.value !== '');
});
</script>
@endpush
