<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::query()
            ->when($request->q, function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->q}%")
                    ->orWhere('phone', 'like', "%{$request->q}%")
                    ->orWhere('email', 'like', "%{$request->q}%");
            })
            ->withCount(['reservations as total_reservasi'])
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.customers.index', compact('customers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:20', 'unique:customers,phone'],
            'email' => ['nullable', 'email', 'max:100'],
            'address' => ['nullable', 'string'],
        ]);

        Customer::create($data);

        return back()->with('success', 'Customer baru berhasil ditambahkan.');
    }

    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:20', 'unique:customers,phone,' . $customer->id],
            'email' => ['nullable', 'email', 'max:100'],
            'address' => ['nullable', 'string'],
        ]);

        $customer->update($data);

        return back()->with('success', 'Data customer berhasil diperbarui.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return back()->with('success', 'Customer berhasil dihapus.');
    }
}
