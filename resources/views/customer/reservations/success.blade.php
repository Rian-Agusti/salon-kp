@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-stone-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
        <svg class="mx-auto h-16 w-16 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
            Booking Successful!
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Thank you for booking with Eeva Salon.
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-xl">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">

            <div class="text-center mb-6">
                <p class="text-sm text-gray-500 uppercase tracking-wide">Reservation Code</p>
                <p class="text-2xl font-bold text-rose-500 tracking-wider">{{ $reservation->reservation_code }}</p>
            </div>

            <div class="border-t border-b border-gray-200 py-4 mb-6">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Date</p>
                        <p class="font-medium">{{ $reservation->booking_date->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Time</p>
                        <p class="font-medium">{{ \Carbon\Carbon::parse($reservation->booking_time)->format('H:i') }}</p>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h4 class="text-sm font-medium text-gray-900 mb-2">Services Booked</h4>
                <ul class="divide-y divide-gray-200">
                    @php $totalPrice = 0; @endphp
                    @foreach($reservation->reservationItems as $item)
                        @php $totalPrice += $item->service_price; @endphp
                        <li class="py-2 flex justify-between text-sm">
                            <span class="text-gray-600">{{ $item->service_name }}</span>
                            <span class="font-medium">Rp {{ number_format($item->service_price, 0, ',', '.') }}</span>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-4 pt-4 border-t border-gray-200 flex justify-between">
                    <span class="font-bold text-gray-900">Total Price</span>
                    <span class="font-bold text-rose-600 text-lg">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                </div>
            </div>

            @php
                $cleanPhone = preg_replace('/[^0-9]/', '', $setting->phone ?? '');
                $message = urlencode("Halo Admin Eeva Salon, Saya sudah melakukan reservasi melalui website dengan kode booking [{$reservation->reservation_code}].");
                $waUrl = "https://wa.me/{$cleanPhone}?text={$message}";
            @endphp

            <div class="mt-8 space-y-4">
                <a href="{{ $waUrl }}" target="_blank" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.711.848 3.146.849 3.18 0 5.769-2.585 5.771-5.766.002-3.181-2.585-5.765-5.768-5.765zm3.327 8.364c-.16.465-1.184.736-1.524.754-.336.018-.656.095-2.241-.57-2.121-.892-3.487-3.111-3.591-3.25-.103-.139-.854-1.139-.853-2.17.001-1.031.528-1.543.714-1.741.187-.198.406-.248.539-.248.133 0 .266.004.385.009.124.006.294-.049.46.353.165.402.564 1.378.614 1.478.05.101.083.218.017.351-.067.133-.1.215-.2.316-.101.101-.207.215-.297.304-.101.102-.206.216-.092.414.114.198.508.839 1.089 1.359.75.672 1.383.878 1.581.98.199.102.315.086.433-.049.119-.136.509-.597.646-.803.137-.206.273-.172.454-.106.182.066 1.144.539 1.343.639.198.1.332.152.381.238.049.085.049.497-.111.962z"/></svg>
                    Contact Admin via WhatsApp
                </a>

                <a href="{{ route('customer.reservations.show', $reservation) }}" class="w-full flex justify-center py-3 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500">
                    View Reservation Details
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
