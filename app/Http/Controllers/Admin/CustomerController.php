<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = User::role('customer')
            ->with(['reservations.reservationItems'])
            ->withCount('reservations')
            ->latest();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $customers = $query->paginate(15);

        // Calculate the accurate total spent for each customer
        foreach ($customers as $customer) {
            $customer->total_spent = $customer->reservations->sum(function ($reservation) {
                return $reservation->reservationItems->sum('service_price') - $reservation->discount_amount;
            });
        }

        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255', 'unique:users,email'],
            'address' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
            'birth_date' => ['nullable', 'date'],
            'is_member' => ['nullable', 'boolean'],
        ]);

        $email = $validated['email'] ?? 'walkin_' . Str::random(8) . '@example.com';

        $memberUntil = !empty($validated['is_member']) ? now()->addYear() : null;

        $customer = User::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $email,
            'password' => Hash::make(Str::random(20)),
            'type' => 'offline',
            'address' => $validated['address'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'birth_date' => $validated['birth_date'] ?? null,
            'member_until' => $memberUntil,
            'is_active' => true,
        ]);

        $customer->assignRole('customer');

        return redirect()->route('admin.customers.index')
            ->with('success', 'Member berhasil ditambahkan.');
    }

    public function show(User $customer)
    {
        // Ensure the user is actually a customer
        if (! $customer->hasRole('customer')) {
            abort(404);
        }

        $customer->load(['reservations.reservationItems' => function ($query) {
            $query->latest();
        }]);

        $totalVisits = $customer->reservations->count();
        $totalTransactions = $customer->reservations->count();

        $totalSpent = $customer->reservations->sum(function ($reservation) {
            return $reservation->reservationItems->sum('service_price') - $reservation->discount_amount;
        });

        // Favorite service
        $favoriteService = null;
        $serviceCounts = [];
        foreach ($customer->reservations as $reservation) {
            foreach ($reservation->reservationItems as $item) {
                $serviceCounts[$item->service_name] = ($serviceCounts[$item->service_name] ?? 0) + 1;
            }
        }
        if (!empty($serviceCounts)) {
            arsort($serviceCounts);
            $favoriteService = array_key_first($serviceCounts);
        }

        return view('admin.customers.show', compact('customer', 'totalVisits', 'totalTransactions', 'totalSpent', 'favoriteService'));
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
            'birth_date' => $validated['birth_date'] ?? null,
            'member_until' => $validated['member_until'] ?? null,
            'address' => $validated['address'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'type' => $validated['type'] ?? $customer->type,
            'is_active' => $request->has('is_active'),
        ];

        if (! empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $customer->update($data);

        return redirect()->route('admin.customers.index')
            ->with('success', 'Data pelanggan berhasil diperbarui.');
    }
}
