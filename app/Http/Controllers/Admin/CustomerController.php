<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

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
        if (!$customer->hasRole('customer')) {
            abort(404);
        }

        $customer->load(['reservations' => function($query) {
            $query->latest();
        }]);

        return view('admin.customers.show', compact('customer'));
    }
}
