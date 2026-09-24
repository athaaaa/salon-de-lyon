<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function index(Request $request)
    {
        $treatments = Treatment::query()
            ->when($request->q, fn ($q) => $q->where('name', 'like', "%{$request->q}%"))
            ->orderBy('category')
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('admin.treatments.index', compact('treatments'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'category' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'duration_minutes' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:aktif,nonaktif'],
        ]);

        Treatment::create($data);

        return back()->with('success', 'Treatment baru berhasil ditambahkan.');
    }

    public function update(Request $request, Treatment $treatment)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'category' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'duration_minutes' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:aktif,nonaktif'],
        ]);

        $treatment->update($data);

        return back()->with('success', 'Treatment berhasil diperbarui.');
    }

    public function destroy(Treatment $treatment)
    {
        $treatment->delete();

        return back()->with('success', 'Treatment berhasil dihapus.');
    }
}
