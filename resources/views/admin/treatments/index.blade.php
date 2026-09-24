@extends('layouts.admin')
@section('title', 'Data Treatment')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-3 mb-4">
    <form method="GET" class="flex-1 min-w-[220px]">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari treatment..."
               class="w-full max-w-sm rounded-lg border border-stone-300 px-4 py-2 text-sm">
    </form>
    <button onclick="document.getElementById('modal-tambah').classList.remove('hidden')"
            class="bg-brown-950 text-white text-sm px-4 py-2 rounded-lg">+ Tambah Treatment</button>
</div>

<div class="bg-white rounded-xl shadow-sm border border-stone-100 overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-stone-50 text-stone-500 text-left">
            <tr>
                <th class="px-4 py-3">Nama Treatment</th>
                <th class="px-4 py-3">Kategori</th>
                <th class="px-4 py-3">Durasi</th>
                <th class="px-4 py-3">Harga</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-stone-100">
            @forelse ($treatments as $t)
                <tr>
                    <td class="px-4 py-3 font-medium">{{ $t->name }}</td>
                    <td class="px-4 py-3 text-stone-500">{{ $t->category }}</td>
                    <td class="px-4 py-3">{{ $t->duration_minutes }} menit</td>
                    <td class="px-4 py-3">{{ $t->formatted_price }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded-full text-xs {{ $t->status === 'aktif' ? 'bg-green-50 text-green-700' : 'bg-stone-100 text-stone-500' }}">
                            {{ ucfirst($t->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <button onclick='editTreatment(@json($t))' class="text-stone-500 hover:underline">Edit</button>
                        <form action="{{ route('admin.treatments.destroy', $t) }}" method="POST" class="inline"
                              onsubmit="return confirm('Hapus treatment ini?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline ml-3">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="px-4 py-6 text-center text-stone-400">Belum ada data treatment.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $treatments->links() }}</div>

{{-- MODAL TAMBAH --}}
<div id="modal-tambah" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-xl w-full max-w-md p-6 max-h-[90vh] overflow-y-auto">
        <h2 class="font-serif text-lg mb-4">Tambah Treatment</h2>
        <form method="POST" action="{{ route('admin.treatments.store') }}" class="space-y-3">
            @csrf
            <input name="name" placeholder="Nama treatment" required class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
            <input name="category" placeholder="Kategori (mis. Cut Woman)" class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
            <textarea name="description" placeholder="Deskripsi" class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm"></textarea>
            <input type="number" name="price" placeholder="Harga (Rp)" required class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
            <input type="number" name="duration_minutes" placeholder="Durasi (menit)" required class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
            <select name="status" class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('modal-tambah').classList.add('hidden')" class="px-4 py-2 text-sm text-stone-500">Batal</button>
                <button class="px-4 py-2 text-sm bg-brown-950 text-white rounded-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT --}}
<div id="modal-edit" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-xl w-full max-w-md p-6 max-h-[90vh] overflow-y-auto">
        <h2 class="font-serif text-lg mb-4">Edit Treatment</h2>
        <form id="form-edit" method="POST" class="space-y-3">
            @csrf @method('PUT')
            <input id="edit-name" name="name" placeholder="Nama treatment" required class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
            <input id="edit-category" name="category" placeholder="Kategori" class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
            <textarea id="edit-description" name="description" placeholder="Deskripsi" class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm"></textarea>
            <input id="edit-price" type="number" name="price" placeholder="Harga (Rp)" required class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
            <input id="edit-duration" type="number" name="duration_minutes" placeholder="Durasi (menit)" required class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
            <select id="edit-status" name="status" class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>
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
function editTreatment(t) {
    document.getElementById('form-edit').action = `/admin/treatments/${t.id}`;
    document.getElementById('edit-name').value = t.name;
    document.getElementById('edit-category').value = t.category ?? '';
    document.getElementById('edit-description').value = t.description ?? '';
    document.getElementById('edit-price').value = t.price;
    document.getElementById('edit-duration').value = t.duration_minutes;
    document.getElementById('edit-status').value = t.status;
    document.getElementById('modal-edit').classList.remove('hidden');
}
</script>
@endpush
