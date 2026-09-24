@extends('layouts.admin')
@section('title', 'Data Stylist')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-3 mb-4">
    <form method="GET" class="flex-1 min-w-[220px]">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari stylist..."
               class="w-full max-w-sm rounded-lg border border-stone-300 px-4 py-2 text-sm">
    </form>
    <button onclick="document.getElementById('modal-tambah').classList.remove('hidden')"
            class="bg-brown-950 text-white text-sm px-4 py-2 rounded-lg">+ Tambah Stylist</button>
</div>

<div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
    @forelse ($stylists as $s)
        <div class="bg-white rounded-xl shadow-sm border border-stone-100 p-4 text-center">
            <img src="{{ $s->photo_url }}" class="w-16 h-16 rounded-full mx-auto object-cover mb-2" alt="{{ $s->name }}">
            <p class="font-medium">{{ $s->name }}</p>
            <p class="text-xs text-stone-500 mb-2">{{ $s->specialization }}</p>
            <span class="px-2 py-0.5 rounded-full text-[11px] {{ $s->status === 'aktif' ? 'bg-green-50 text-green-700' : 'bg-stone-100 text-stone-500' }}">
                {{ ucfirst($s->status) }}
            </span>
            <p class="text-[11px] text-stone-400 mt-2">{{ $s->reservations_count }} reservasi</p>
            <div class="flex justify-center gap-3 mt-3 text-xs">
                <button onclick='editStylist(@json($s->load("treatments")))' class="text-stone-500 hover:underline">Edit</button>
                <form action="{{ route('admin.stylists.destroy', $s) }}" method="POST" onsubmit="return confirm('Hapus stylist ini?')">
                    @csrf @method('DELETE')
                    <button class="text-red-600 hover:underline">Hapus</button>
                </form>
            </div>
        </div>
    @empty
        <p class="text-stone-400 col-span-full text-center py-6">Belum ada data stylist.</p>
    @endforelse
</div>
<div class="mt-4">{{ $stylists->links() }}</div>

{{-- MODAL TAMBAH --}}
<div id="modal-tambah" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-xl w-full max-w-md p-6 max-h-[90vh] overflow-y-auto">
        <h2 class="font-serif text-lg mb-4">Tambah Stylist</h2>
        <form method="POST" action="{{ route('admin.stylists.store') }}" enctype="multipart/form-data" class="space-y-3">
            @csrf
            <input name="name" placeholder="Nama stylist" required class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
            <input name="specialization" placeholder="Spesialisasi" class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
            <select name="gender" class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
                <option value="P">Wanita</option>
                <option value="L">Pria</option>
            </select>
            <div>
                <p class="text-xs text-stone-500 mb-1">Foto (opsional — kalau kosong, pakai avatar siluet sesuai gender)</p>
                <input type="file" name="photo" accept="image/*" class="w-full text-sm">
            </div>
            <select name="status" class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>
            <div>
                <p class="text-xs text-stone-500 mb-1">Treatment yang bisa ditangani:</p>
                <div class="max-h-40 overflow-y-auto border border-stone-200 rounded-lg p-2 space-y-1">
                    @foreach ($treatments as $t)
                        <label class="flex items-center gap-2 text-xs">
                            <input type="checkbox" name="treatment_ids[]" value="{{ $t->id }}"> {{ $t->name }}
                        </label>
                    @endforeach
                </div>
            </div>
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
        <h2 class="font-serif text-lg mb-4">Edit Stylist</h2>
        <form id="form-edit" method="POST" enctype="multipart/form-data" class="space-y-3">
            @csrf @method('PUT')
            <input id="edit-name" name="name" placeholder="Nama stylist" required class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
            <input id="edit-specialization" name="specialization" placeholder="Spesialisasi" class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
            <select id="edit-gender" name="gender" class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
                <option value="P">Wanita</option>
                <option value="L">Pria</option>
            </select>
            <div>
                <p class="text-xs text-stone-500 mb-1">Foto (opsional — kosongkan kalau tidak ingin mengganti foto)</p>
                <input type="file" name="photo" accept="image/*" class="w-full text-sm">
            </div>
            <select id="edit-status" name="status" class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>
            <div>
                <p class="text-xs text-stone-500 mb-1">Treatment yang bisa ditangani:</p>
                <div id="edit-treatments" class="max-h-40 overflow-y-auto border border-stone-200 rounded-lg p-2 space-y-1">
                    @foreach ($treatments as $t)
                        <label class="flex items-center gap-2 text-xs">
                            <input type="checkbox" class="edit-treatment-checkbox" name="treatment_ids[]" value="{{ $t->id }}"> {{ $t->name }}
                        </label>
                    @endforeach
                </div>
            </div>
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
function editStylist(s) {
    document.getElementById('form-edit').action = `/admin/stylists/${s.id}`;
    document.getElementById('edit-name').value = s.name;
    document.getElementById('edit-specialization').value = s.specialization ?? '';
    document.getElementById('edit-gender').value = s.gender ?? 'P';
    document.getElementById('edit-status').value = s.status;

    const ids = (s.treatments || []).map(t => t.id);
    document.querySelectorAll('.edit-treatment-checkbox').forEach(cb => {
        cb.checked = ids.includes(parseInt(cb.value));
    });

    document.getElementById('modal-edit').classList.remove('hidden');
}
</script>
@endpush
