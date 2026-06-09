<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::role('customer')->latest()->paginate(15);

        return view('admin.customers.index', compact('customers'));
    }

    public function show(User $customer)
    {
        // Ensure the user is actually a customer
        if (! $customer->hasRole('customer')) {
            abort(404);
        }

        $customer->load(['reservations' => function ($query) {
            $query->latest();
        }]);

        return view('admin.customers.show', compact('customer'));
    }

    public function edit(User $customer)
    {
        // Ensure the user is actually a customer
        if (! $customer->hasRole('customer')) {
            abort(404);
        }

        return view('admin.customers.edit', compact('customer'));
    }

    public function update(UpdateCustomerRequest $request, User $customer)
    {
        // Ensure the user is actually a customer
        if (! $customer->hasRole('customer')) {
            abort(404);
        }

        $validated = $request->validated();

        $data = [
            'name' => $validated['name'],
            'phone' => $validated['phone'],
        ];

        if (! empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $customer->update($data);

        return redirect()->route('admin.customers.index')
            ->with('success', 'Data pelanggan berhasil diperbarui.');
    }
}
