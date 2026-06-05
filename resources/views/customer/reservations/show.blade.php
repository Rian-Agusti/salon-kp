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
                        <p class="mb-2"><span class="text-gray-500 w-24 inline-block">Date:</span> <span
                                class="font-medium">{{ $reservation->booking_date->format('l, F j, Y') }}</span></p>
                        <p><span class="text-gray-500 w-24 inline-block">Time:</span> <span
                                class="font-medium">{{ \Carbon\Carbon::parse($reservation->booking_time)->format('H:i') }}</span>
                        </p>
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
                        <p class="mb-2"><span class="text-gray-500 w-24 inline-block">Name:</span> <span
                                class="font-medium">{{ $reservation->customer_name }}</span></p>
                        <p class="mb-2"><span class="text-gray-500 w-24 inline-block">Email:</span> <span
                                class="font-medium">{{ $reservation->customer_email }}</span></p>
                        <p><span class="text-gray-500 w-24 inline-block">Phone:</span> <span
                                class="font-medium">{{ $reservation->customer_phone ?? 'N/A' }}</span></p>
                    </div>
                </div>
            </div>

            <div>
                <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Selected Services</h4>
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Service</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                    Duration</th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Price</th>
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
                                <th scope="row"
                                    class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 text-right">Total
                                </th>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 text-center">
                                    {{ $totalDuration }} mins</td>
                                <td class="px-6 py-4 whitespace-nowrap text-lg font-bold text-rose-600 text-right">Rp
                                    {{ number_format($totalPrice, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <a href="{{ route('customer.dashboard') }}"
                    class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500">
                    Back to Dashboard
                </a>
            </div>
            @php
                // 1. Ambil input nomor HP dari database atau gunakan default jika kosong
                $phoneInput = $setting->phone ?? '0877-8391-5874';

                // 2. Bersihkan semua karakter selain angka (spasi, strip, dll)
                $cleanPhone = preg_replace('/[^0-9]/', '', $phoneInput);

                // 3. Konversi angka '0' di awal nomor menjadi kode negara '62' secara aman
                if (strpos($cleanPhone, '0') === 0) {
                    $cleanPhone = '62' . substr($cleanPhone, 1);
                }

                // 4. Ambil kode booking secara aman (beri fallback 'DRAFT' jika null)
                $bookingCode = $reservation->reservation_code ?? 'DRAFT';

                // 5. Buat template teks dan encode agar aman dibaca oleh browser URL
                $textMessage = "Halo Admin Eeva Salon, Saya sudah melakukan reservasi melalui website dengan kode booking [{$bookingCode}].";
                $message = urlencode($textMessage);

                // 6. Gabungkan menjadi link wa.me yang valid (sudah ditambahkan tanda / setelah wa.me)
                $waUrl = "https://wa.me/{$cleanPhone}?text={$message}";
            @endphp

            <div class="mt-8 space-y-4">
                <a href="{{ $waUrl }}" target="_blank"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.711.848 3.146.849 3.18 0 5.769-2.585 5.771-5.766.002-3.181-2.585-5.765-5.768-5.765zm3.327 8.364c-.16.465-1.184.736-1.524.754-.336.018-.656.095-2.241-.57-2.121-.892-3.487-3.111-3.591-3.25-.103-.139-.854-1.139-.853-2.17.001-1.031.528-1.543.714-1.741.187-.198.406-.248.539-.248.133 0 .266.004.385.009.124.006.294-.049.46.353.165.402.564 1.378.614 1.478.05.101.083.218.017.351-.067.133-.1.215-.2.316-.101.101-.207.215-.297.304-.101.102-.206.216-.092.414.114.198.508.839 1.089 1.359.75.672 1.383.878 1.581.98.199.102.315.086.433-.049.119-.136.509-.597.646-.803.137-.206.273-.172.454-.106.182.066 1.144.539 1.343.639.198.1.332.152.381.238.049.085.049.497-.111.962z" />
                    </svg>
                    Contact Admin via WhatsApp
                </a>

            </div>
        </div>
@endsection