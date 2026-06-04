@extends('layouts.customer')

@section('header')
    Reservation Details #{{ $reservation->reservation_code }}
@endsection

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">

        <div class="flex justify-between items-start mb-8 pb-6 border-b border-gray-200">
            <div>
                <h3 class="text-2xl font-bold text-gray-900">{{ $reservation->reservation_code }}</h3>
                <p class="text-sm text-gray-500 mt-1">Booked on {{ $reservation->created_at->format('M d, Y H:i') }}</p>
            </div>
            <div>
                <span class="inline-flex px-3 py-1 rounded-full text-sm font-semibold uppercase tracking-wider
                    @if($reservation->status == 'pending') bg-yellow-100 text-yellow-800
                    @elseif($reservation->status == 'confirmed') bg-blue-100 text-blue-800
                    @elseif($reservation->status == 'completed') bg-green-100 text-green-800
                    @else bg-red-100 text-red-800 @endif">
                    {{ $reservation->status }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div>
                <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Appointment Info</h4>
                <div class="bg-stone-50 p-4 rounded-lg">
                    <p class="mb-2"><span class="text-gray-500 w-24 inline-block">Date:</span> <span class="font-medium">{{ $reservation->booking_date->format('l, F j, Y') }}</span></p>
                    <p><span class="text-gray-500 w-24 inline-block">Time:</span> <span class="font-medium">{{ \Carbon\Carbon::parse($reservation->booking_time)->format('H:i') }}</span></p>
                </div>

                @if($reservation->notes)
                <div class="mt-4">
                    <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Notes</h4>
                    <p class="text-gray-700 bg-gray-50 p-4 rounded-lg italic">"{{ $reservation->notes }}"</p>
                </div>
                @endif
            </div>

            <div>
                <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Your Details</h4>
                <div class="bg-stone-50 p-4 rounded-lg">
                    <p class="mb-2"><span class="text-gray-500 w-24 inline-block">Name:</span> <span class="font-medium">{{ $reservation->customer_name }}</span></p>
                    <p class="mb-2"><span class="text-gray-500 w-24 inline-block">Email:</span> <span class="font-medium">{{ $reservation->customer_email }}</span></p>
                    <p><span class="text-gray-500 w-24 inline-block">Phone:</span> <span class="font-medium">{{ $reservation->customer_phone ?? 'N/A' }}</span></p>
                </div>
            </div>
        </div>

        <div>
            <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Selected Services</h4>
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Duration</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php
                            $totalPrice = 0;
                            $totalDuration = 0;
                        @endphp
                        @foreach($reservation->reservationItems as $item)
                            @php
                                $totalPrice += $item->service_price;
                                $totalDuration += $item->service_duration;
                            @endphp
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $item->service_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                    {{ $item->service_duration }} mins
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right">
                                    Rp {{ number_format($item->service_price, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <th scope="row" class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 text-right">Total</th>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 text-center">{{ $totalDuration }} mins</td>
                            <td class="px-6 py-4 whitespace-nowrap text-lg font-bold text-rose-600 text-right">Rp {{ number_format($totalPrice, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="mt-8 flex justify-end">
            <a href="{{ route('customer.dashboard') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500">
                Back to Dashboard
            </a>
        </div>
    </div>
</div>
@endsection
