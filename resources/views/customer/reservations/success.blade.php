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
                                    Item Reservasi</h4>
                                @php $totalPrice = 0; @endphp

                                <!-- Desktop View (List) -->
                                <div class="hidden sm:block">
                                    <ul class="divide-y divide-gray-100">
                                        @foreach($reservation->reservationItems as $item)
                                            @php $totalPrice += $item->service_price; @endphp
                                            <li class="py-3 flex justify-between items-center group">
                                                <span
                                                    class="text-salon-textLight font-medium group-hover:text-salon-goldHover transition">
                                                    {{ $item->service_name }}
                                                    @if($item->item_type == 'product')
                                                        <span class="text-xs text-gray-500 font-normal ml-2">({{ $item->quantity }} pcs)</span>
                                                    @elseif($item->item_type == 'promotion')
                                                        <span class="text-xs text-gray-500 font-normal ml-2">(Promo)</span>
                                                    @endif
                                                </span>
                                                <span class="font-bold text-salon-text">Rp
                                                    {{ number_format($item->service_price, 0, ',', '.') }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <!-- Mobile View (Card-like) -->
                                <div class="sm:hidden space-y-3">
                                    @foreach($reservation->reservationItems as $item)
                                        <div class="bg-gray-50 border border-salon-beige rounded-xl p-4 shadow-sm">
                                            <p class="font-bold text-salon-text text-base mb-2">
                                                {{ $item->service_name }}
                                                @if($item->item_type == 'product')
                                                    <span class="text-xs text-gray-500 font-normal ml-1">({{ $item->quantity }} pcs)</span>
                                                @elseif($item->item_type == 'promotion')
                                                    <span class="text-xs text-gray-500 font-normal ml-1">(Promo)</span>
                                                @endif
                                            </p>
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
                                    class="mt-6 sm:mt-4 pt-4 border-t-2 border-dashed border-salon-beige flex flex-col justify-between items-start bg-salon-cream sm:bg-transparent p-4 sm:p-0 rounded-xl sm:rounded-none space-y-2">

                                    <div class="flex justify-between items-center w-full">
                                        <span class="font-bold text-salon-text text-base">Subtotal</span>
                                        <span class="font-bold text-salon-text text-lg">Rp {{ number_format($calculatedTotal, 0, ',', '.') }}</span>
                                    </div>

                                    @if($reservation->discount_amount > 0)
                                    <div class="flex justify-between items-center w-full text-green-700">
                                        <span class="font-bold text-base">Diskon Member</span>
                                        <span class="font-bold text-lg">- Rp {{ number_format($reservation->discount_amount, 0, ',', '.') }}</span>
                                    </div>
                                    @endif

                                    <div class="flex justify-between items-center w-full pt-2 border-t border-salon-beige/50">
                                        <span class="font-bold text-salon-text text-lg sm:text-xl">Total Pembayaran</span>
                                        <span class="font-bold text-salon-goldHover text-xl sm:text-2xl">Rp {{ number_format($calculatedTotal - $reservation->discount_amount, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        @if($setting->phone)
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
                        @endif

                            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-salon-beige">
                                <a href="{{ $waUrl }}" target="_blank"
                                    class="w-full sm:w-1/2 flex justify-center items-center py-4 sm:py-3.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-green-500 hover:bg-green-600 focus:outline-none transition duration-300">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z" />
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
