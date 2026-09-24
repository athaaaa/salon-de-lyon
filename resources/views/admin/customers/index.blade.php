@extends('layouts.admin')
@section('title', 'Data Customer')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-3 mb-4">
    <form method="GET" class="flex-1 min-w-[220px]">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama, no. HP, atau email..."
               class="w-full max-w-sm rounded-lg border border-stone-300 px-4 py-2 text-sm">
    </form>
    <button onclick="document.getElementById('modal-tambah').classList.remove('hidden')"
            class="bg-brown-950 text-white text-sm px-4 py-2 rounded-lg">+ Tambah Customer</button>
</div>

<div class="bg-white rounded-xl shadow-sm border border-stone-100 overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-stone-50 text-stone-500 text-left">
            <tr>
                <th class="px-4 py-3">Nama</th>
                <th class="px-4 py-3">No. HP</th>
                <th class="px-4 py-3">Email</th>
                <th class="px-4 py-3">Total Reservasi</th>
                <th class="px-4 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-stone-100">
            @forelse ($customers as $c)
                <tr>
                    <td class="px-4 py-3 font-medium">{{ $c->name }}</td>
                    <td class="px-4 py-3">{{ $c->phone }}</td>
                    <td class="px-4 py-3">{{ $c->email ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $c->total_reservasi }}</td>
                    <td class="px-4 py-3">
                        <a href="{{ route('admin.reports.customer-history', $c) }}" class="text-gold-700 hover:underline">Riwayat</a>
                        <button onclick="editCustomer({{ $c->id }}, '{{ addslashes($c->name) }}', '{{ $c->phone }}', '{{ $c->email }}', `{{ addslashes($c->address) }}`)"
                                class="text-stone-500 hover:underline ml-3">Edit</button>
                        <form action="{{ route('admin.customers.destroy', $c) }}" method="POST" class="inline"
                              onsubmit="return confirm('Hapus customer ini?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline ml-3">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-4 py-6 text-center text-stone-400">Belum ada data customer.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $customers->links() }}</div>

{{-- MODAL TAMBAH --}}
<div id="modal-tambah" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-xl w-full max-w-md p-6">
        <h2 class="font-serif text-lg mb-4">Tambah Customer</h2>
        <form method="POST" action="{{ route('admin.customers.store') }}" class="space-y-3">
            @csrf
            <input name="name" placeholder="Nama" required class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
            <input name="phone" placeholder="No. HP" required class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
            <input name="email" placeholder="Email (opsional)" class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
            <textarea name="address" placeholder="Alamat (opsional)" class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm"></textarea>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('modal-tambah').classList.add('hidden')" class="px-4 py-2 text-sm text-stone-500">Batal</button>
                <button class="px-4 py-2 text-sm bg-brown-950 text-white rounded-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT --}}
<div id="modal-edit" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-xl w-full max-w-md p-6">
        <h2 class="font-serif text-lg mb-4">Edit Customer</h2>
        <form id="form-edit" method="POST" class="space-y-3">
            @csrf @method('PUT')
            <input id="edit-name" name="name" placeholder="Nama" required class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
            <input id="edit-phone" name="phone" placeholder="No. HP" required class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
            <input id="edit-email" name="email" placeholder="Email" class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
            <textarea id="edit-address" name="address" placeholder="Alamat" class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm"></textarea>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('modal-edit').classList.add('hidden')" class="px-4 py-2 text-sm text-stone-500">Batal</button>
                <button class="px-4 py-2 text-sm bg-brown-950 text-white rounded-lg">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function editCustomer(id, name, phone, email, address) {
    document.getElementById('form-edit').action = `/admin/customers/${id}`;
    document.getElementById('edit-name').value = name;
    document.getElementById('edit-phone').value = phone;
    document.getElementById('edit-email').value = email;
    document.getElementById('edit-address').value = address;
    document.getElementById('modal-edit').classList.remove('hidden');
}
</script>
@endpush
