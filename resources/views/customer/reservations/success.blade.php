@extends('layouts.public')

@section('content')
    <div class="min-h-screen bg-salon-bg py-16 sm:py-24 flex items-center justify-center">
        <div class="max-w-2xl w-full mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-10">
                <div
                    class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-green-50 border-4 border-green-100 mb-6 shadow-inner relative">
                    <div class="absolute inset-0 rounded-full animate-ping opacity-20 bg-green-400"></div>
                    <svg class="h-12 w-12 text-green-500 relative z-10" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h2 class="text-3xl sm:text-4xl font-serif font-bold text-salon-text mb-4">Reservasi Berhasil!</h2>
                <p class="text-lg text-salon-textLight max-w-lg mx-auto">Terima kasih telah memilih
                    {{ $setting->salon_name ?? 'Eeva Salon' }}. Reservasi Anda telah berhasil dicatat di sistem kami.
                </p>
            </div>

            <div
                class="bg-white rounded-3xl shadow-sm hover:shadow-md transition duration-300 overflow-hidden border border-salon-beige">
                <div class="p-8 sm:p-12">

                    <div
                        class="bg-salon-cream rounded-2xl p-6 text-center mb-10 border border-rose-100 relative overflow-hidden">
                        <div class="absolute -right-4 -top-4 w-16 h-16 bg-salon-beige/50 rounded-full"></div>
                        <div class="absolute -left-4 -bottom-4 w-16 h-16 bg-salon-beige/50 rounded-full"></div>
                        <div class="relative z-10">
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Kode Booking Anda</p>
                            <p class="text-3xl sm:text-4xl font-serif font-bold text-salon-goldHover tracking-widest">
                                {{ $reservation->reservation_code }}
                            </p>
                            <p class="text-sm text-gray-500 mt-3">Silakan simpan kode ini untuk referensi Anda.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-10">
                        <div class="bg-gray-50 border border-salon-beige rounded-xl p-5 flex items-start gap-4">
                            <div
                                class="bg-white p-2.5 rounded-lg shadow-sm border border-salon-beige text-salon-gold shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Tanggal</p>
                                <p class="text-base font-bold text-salon-text mt-0.5">
                                    {{ $reservation->booking_date->translatedFormat('d F Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="bg-gray-50 border border-salon-beige rounded-xl p-5 flex items-start gap-4">
                            <div
                                class="bg-white p-2.5 rounded-lg shadow-sm border border-salon-beige text-salon-gold shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Waktu</p>
                                <p class="text-base font-bold text-salon-text mt-0.5">
                                    {{ \Carbon\Carbon::parse($reservation->booking_time)->format('H:i') }} WIB
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-10">
                        <h4
                            class="text-sm font-bold text-salon-text uppercase tracking-wider mb-4 border-b border-salon-beige pb-2">
                            Layanan yang Dipesan</h4>
                        @php $totalPrice = 0; @endphp

                        <!-- Desktop View (List) -->
                        <div class="hidden sm:block">
                            <ul class="divide-y divide-gray-100">
                                @foreach($reservation->reservationItems as $item)
                                    @php $totalPrice += $item->service_price; @endphp
                                    <li class="py-3 flex justify-between items-center group">
                                        <span
                                            class="text-salon-textLight font-medium group-hover:text-salon-goldHover transition">{{ $item->service_name }}</span>
                                        <span class="font-bold text-salon-text">Rp
                                            {{ number_format($item->service_price, 0, ',', '.') }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Mobile View (Card-like) -->
                        <div class="sm:hidden space-y-3">
                            @foreach($reservation->reservationItems as $item)
                                <!-- we have to recount totalPrice since we are looping twice, but we already added in the first loop so let's reset it before the loop if needed? No, wait, if we only render one view based on CSS, we shouldn't recount. Let's just recount and store in variable outside. -->
                                <div class="bg-gray-50 border border-salon-beige rounded-xl p-4 shadow-sm">
                                    <p class="font-bold text-salon-text text-base mb-2">{{ $item->service_name }}</p>
                                    <p class="text-salon-gold font-bold text-right">Rp
                                        {{ number_format($item->service_price, 0, ',', '.') }}</p>
                                </div>
                            @endforeach
                        </div>

                        @php
                            // Calculate total price accurately without double counting
                            $calculatedTotal = 0;
                            foreach ($reservation->reservationItems as $item) {
                                $calculatedTotal += $item->service_price;
                            }
                        @endphp
                        <!-- Total Section -->
                        <div
                            class="mt-6 sm:mt-4 pt-4 border-t-2 border-dashed border-salon-beige flex flex-col sm:flex-row justify-between items-start sm:items-center bg-salon-cream sm:bg-transparent p-4 sm:p-0 rounded-xl sm:rounded-none">
                            <span class="font-bold text-salon-text text-base sm:text-lg mb-1 sm:mb-0">Total
                                Pembayaran</span>
                            <span class="font-bold text-salon-goldHover text-xl sm:text-2xl self-end sm:self-auto">Rp
                                {{ number_format($calculatedTotal, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    @php
                        // 1. Ambil input nomor HP dari database atau gunakan default jika kosong
                        $phoneInput = '0877-8391-5874';

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

                        // 6. Gabungkan menjadi link wa.me yang valid (tambahkan / sebelum nomor)
                        $waUrl = "https://wa.me/{$cleanPhone}?text={$message}";
                    @endphp

                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-salon-beige">
                        <a href="{{ $waUrl }}" target="_blank"
                            class="w-full sm:w-1/2 flex justify-center items-center py-4 sm:py-3.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-green-500 hover:bg-green-600 focus:outline-none transition duration-300">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.711.848 3.146.849 3.18 0 5.769-2.585 5.771-5.766.002-3.181-2.585-5.765-5.768-5.765zm3.327 8.364c-.16.465-1.184.736-1.524.754-.336.018-.656.095-2.241-.57-2.121-.892-3.487-3.111-3.591-3.25-.103-.139-.854-1.139-.853-2.17.001-1.031.528-1.543.714-1.741.187-.198.406-.248.539-.248.133 0 .266.004.385.009.124.006.294-.049.46.353.165.402.564 1.378.614 1.478.05.101.083.218.017.351-.067.133-.1.215-.2.316-.101.101-.207.215-.297.304-.101.102-.206.216-.092.414.114.198.508.839 1.089 1.359.75.672 1.383.878 1.581.98.199.102.315.086.433-.049.119-.136.509-.597.646-.803.137-.206.273-.172.454-.106.182.066 1.144.539 1.343.639.198.1.332.152.381.238.049.085.049.497-.111.962z" />
                            </svg>
                            Konfirmasi via WhatsApp
                        </a>

                        <a href="{{ route('customer.reservations.show', $reservation) }}"
                            class="w-full sm:w-1/2 flex justify-center items-center py-4 sm:py-3.5 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-bold text-gray-700 bg-white hover:bg-gray-50 hover:text-salon-goldHover focus:outline-none transition duration-300">
                            Lihat Detail Reservasi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection