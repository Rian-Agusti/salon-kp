@extends('layouts.admin')

@section('header', 'Reservations')

@section('content')
    <div class="mb-6 flex justify-between items-center bg-white p-4 rounded-lg shadow-sm">
        <div class="flex items-center space-x-4">
            <span class="text-sm font-medium text-gray-700">Filter by Status:</span>
            <a href="{{ route('admin.reservations.index') }}"
                class="px-3 py-1 text-sm rounded-full {{ request('status') == '' ? 'bg-gray-800 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">All</a>
            <a href="{{ route('admin.reservations.index', ['status' => 'pending']) }}"
                class="px-3 py-1 text-sm rounded-full {{ request('status') == 'pending' ? 'bg-yellow-500 text-white' : 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200' }}">Pending</a>
            <a href="{{ route('admin.reservations.index', ['status' => 'confirmed']) }}"
                class="px-3 py-1 text-sm rounded-full {{ request('status') == 'confirmed' ? 'bg-blue-500 text-white' : 'bg-blue-100 text-blue-800 hover:bg-blue-200' }}">Confirmed</a>
            <a href="{{ route('admin.reservations.index', ['status' => 'completed']) }}"
                class="px-3 py-1 text-sm rounded-full {{ request('status') == 'completed' ? 'bg-green-500 text-white' : 'bg-green-100 text-green-800 hover:bg-green-200' }}">Completed</a>
            <a href="{{ route('admin.reservations.index', ['status' => 'cancelled']) }}"
                class="px-3 py-1 text-sm rounded-full {{ request('status') == 'cancelled' ? 'bg-red-500 text-white' : 'bg-red-100 text-red-800 hover:bg-red-200' }}">Cancelled</a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code /
                            Date</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($reservations as $reservation)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-salon-gold">{{ $reservation->reservation_code }}</div>
                                <div class="text-sm text-gray-500">{{ $reservation->booking_date->format('d M Y') }} at
                                    {{ \Carbon\Carbon::parse($reservation->booking_time)->format('H:i') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-salon-text">{{ $reservation->customer_name }}</div>
                                <div class="text-sm text-gray-500">
                                    {{ $reservation->customer_phone ?? $reservation->customer_email }}</div>
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
                                <span
                                    class="badge {{ $statusColors[$reservation->status->value] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($reservation->status->value) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.reservations.show', $reservation) }}"
                                    class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 px-3 py-1 rounded">View Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                No reservations found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($reservations->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $reservations->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
@endsection