@extends('layouts.admin')

@section('header', 'Customer Profile')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.customers.index') }}" class="text-salon-textLight hover:text-salon-text flex items-center">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Back to customers
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
    <!-- Customer Profile Box -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 text-center">
            <div class="h-24 w-24 mx-auto bg-salon-beige rounded-full flex items-center justify-center text-salon-gold font-bold text-4xl mb-4">
                {{ substr($customer->name, 0, 1) }}
            </div>
            <h2 class="text-xl font-bold text-salon-text">{{ $customer->name }}</h2>
            <p class="text-sm text-gray-500 mb-4">Customer since {{ $customer->created_at->format('M Y') }}</p>

            <div class="mb-6">
                <a href="{{ route('admin.customers.edit', $customer) }}" class="inline-flex justify-center items-center px-4 py-2 bg-salon-gold border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-opacity-90 focus:bg-opacity-90 active:bg-opacity-100 focus:outline-none focus:ring-2 focus:ring-salon-gold focus:ring-offset-2 transition ease-in-out duration-150">
                    Edit
                </a>
            </div>

            <div class="text-left space-y-3 border-t border-salon-beige pt-4">
                <div>
                    <span class="text-xs text-gray-500 uppercase tracking-wider block">Email</span>
                    <a href="mailto:{{ $customer->email }}" class="text-sm font-medium text-blue-600 hover:underline">{{ $customer->email }}</a>
                </div>
                <div>
                    <span class="text-xs text-gray-500 uppercase tracking-wider block">Phone</span>
                    <span class="text-sm font-medium text-salon-text">{{ $customer->phone ?? 'Not provided' }}</span>
                </div>
                <div>
                    <span class="text-xs text-gray-500 uppercase tracking-wider block">Total Bookings</span>
                    <span class="text-sm font-medium text-salon-text">{{ $customer->reservations->count() }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Reservation History -->
    <div class="lg:col-span-3">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-bold text-salon-text">Reservation History</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reservation Code</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($customer->reservations as $reservation)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-salon-gold">
                                    {{ $reservation->reservation_code }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-salon-text">
                                    {{ $reservation->booking_date->format('d M Y') }} - {{ \Carbon\Carbon::parse($reservation->booking_time)->format('H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'confirmed' => 'bg-blue-100 text-blue-800',
                                            'completed' => 'bg-green-100 text-green-800',
                                            'cancelled' => 'bg-red-100 text-red-800',
                                        ];
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full uppercase {{ $statusColors[$reservation->status->value] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ $reservation->status->value }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('admin.reservations.show', $reservation) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                    No reservations found for this customer.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
