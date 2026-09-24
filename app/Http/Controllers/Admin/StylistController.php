<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stylist;
use App\Models\Treatment;
use Illuminate\Http\Request;

class StylistController extends Controller
{
    public function index(Request $request)
    {
        $stylists = Stylist::query()
            ->when($request->q, fn ($q) => $q->where('name', 'like', "%{$request->q}%"))
            ->withCount('reservations')
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        $treatments = Treatment::active()->orderBy('category')->orderBy('name')->get();

        return view('admin.stylists.index', compact('stylists', 'treatments'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'specialization' => ['nullable', 'string', 'max:150'],
            'gender' => ['required', 'in:L,P'],
            'status' => ['required', 'in:aktif,nonaktif'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'treatment_ids' => ['nullable', 'array'],
            'treatment_ids.*' => ['exists:treatments,id'],
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('stylists', 'public');
        }

        $stylist = Stylist::create($data);
        $stylist->treatments()->sync($request->input('treatment_ids', []));

        return back()->with('success', 'Stylist baru berhasil ditambahkan.');
    }

    public function update(Request $request, Stylist $stylist)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'specialization' => ['nullable', 'string', 'max:150'],
            'gender' => ['required', 'in:L,P'],
            'status' => ['required', 'in:aktif,nonaktif'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'treatment_ids' => ['nullable', 'array'],
            'treatment_ids.*' => ['exists:treatments,id'],
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('stylists', 'public');
        }

        $stylist->update($data);
        $stylist->treatments()->sync($request->input('treatment_ids', []));

        return back()->with('success', 'Data stylist berhasil diperbarui.');
    }

    public function destroy(Stylist $stylist)
    {
        $stylist->delete();

        return back()->with('success', 'Stylist berhasil dihapus.');
    }
}
