@extends('layouts.customer')

@section('header')
    Detail Reservasi #{{ $reservation->reservation_code }}
@endsection

@section('content')
        <div class="bg-white rounded-2xl shadow-sm border border-salon-beige overflow-hidden">
            <div class="p-6 sm:p-8 bg-white border-b border-salon-beige">

                <div
                    class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 pb-6 border-b border-salon-beige gap-4">
                    <div>
                        <h3 class="text-2xl font-serif font-bold text-salon-text">{{ $reservation->reservation_code }}</h3>
                        <p class="text-sm text-gray-500 mt-1">Dipesan pada
                            {{ $reservation->created_at->translatedFormat('d F Y H:i') }}
                        </p>
                    </div>
                    <div>
                        <span class="inline-flex px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider
                                                @if($reservation->status->value == 'pending') bg-amber-50 text-amber-600 border border-amber-200
                                                @elseif($reservation->status->value == 'confirmed') bg-blue-50 text-blue-600 border border-blue-200
                                                @elseif($reservation->status->value == 'completed') bg-emerald-50 text-emerald-600 border border-emerald-200
                                                @else bg-red-50 text-red-600 border border-red-200 @endif">
                            {{ $reservation->status->value === 'pending' ? 'Menunggu' : ($reservation->status->value === 'confirmed' ? 'Dikonfirmasi' : ($reservation->status->value === 'completed' ? 'Selesai' : 'Dibatalkan')) }}
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 mb-8">
                    <div>
                        <h4 class="text-sm font-bold text-salon-text uppercase tracking-wider mb-4">Info Jadwal</h4>
                        <div class="bg-gray-50 p-5 rounded-xl border border-salon-beige">
                            <div class="mb-3 flex flex-col sm:flex-row sm:items-center">
                                <span
                                    class="text-gray-500 w-full sm:w-24 inline-block font-medium text-xs sm:text-base uppercase sm:normal-case tracking-wider sm:tracking-normal mb-1 sm:mb-0">Tanggal</span>
                                <span
                                    class="font-bold text-salon-text text-base">{{ $reservation->booking_date->translatedFormat('l, d F Y') }}</span>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:items-center">
                                <span
                                    class="text-gray-500 w-full sm:w-24 inline-block font-medium text-xs sm:text-base uppercase sm:normal-case tracking-wider sm:tracking-normal mb-1 sm:mb-0">Waktu</span>
                                <span
                                    class="font-bold text-salon-text text-base">{{ \Carbon\Carbon::parse($reservation->booking_time)->format('H:i') }}
                                    WIB</span>
                            </div>
                        </div>

                        @if($reservation->notes)
                            <div class="mt-6">
                                <h4 class="text-sm font-bold text-salon-text uppercase tracking-wider mb-3">Catatan Khusus</h4>
                                <p
                                    class="text-amber-800 bg-amber-50 border border-amber-100 p-4 rounded-xl text-sm leading-relaxed">
                                    "{{ $reservation->notes }}"</p>
                            </div>
                        @endif
                    </div>

                    <div>
                        <h4 class="text-sm font-bold text-salon-text uppercase tracking-wider mb-4">Data Diri Anda</h4>
                        <div class="bg-gray-50 p-5 rounded-xl border border-salon-beige">
                            <div class="mb-3 flex flex-col sm:flex-row sm:items-center">
                                <span
                                    class="text-gray-500 w-full sm:w-24 inline-block font-medium text-xs sm:text-base uppercase sm:normal-case tracking-wider sm:tracking-normal mb-1 sm:mb-0">Nama</span>
                                <span class="font-bold text-salon-text text-base">{{ $reservation->customer_name }}</span>
                            </div>
                            <div class="mb-3 flex flex-col sm:flex-row sm:items-center overflow-hidden">
                                <span
                                    class="text-gray-500 w-full sm:w-24 inline-block font-medium text-xs sm:text-base uppercase sm:normal-case tracking-wider sm:tracking-normal mb-1 sm:mb-0">Email</span>
                                <span
                                    class="font-bold text-salon-text text-base break-words w-full">{{ $reservation->customer_email }}</span>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:items-center">
                                <span
                                    class="text-gray-500 w-full sm:w-24 inline-block font-medium text-xs sm:text-base uppercase sm:normal-case tracking-wider sm:tracking-normal mb-1 sm:mb-0">Telepon</span>
                                <span
                                    class="font-bold text-salon-text text-base">{{ $reservation->customer_phone ?? 'Tidak diisi' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="text-sm font-bold text-salon-text uppercase tracking-wider mb-4">Layanan & Produk yang Dipilih
                    </h4>

                    @php
    $totalPrice = 0;
    $totalDuration = 0;
                    @endphp

                    <!-- Desktop Table View -->
                    <div class="hidden sm:block border border-salon-beige rounded-xl overflow-hidden shadow-sm">
                        <table class="min-w-full divide-y divide-gray-100">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        Tipe</th>
                                    <th scope="col"
                                        class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        Item</th>
                                    <th scope="col"
                                        class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        Qty/Durasi</th>
                                    <th scope="col"
                                        class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        Harga</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @foreach($reservation->reservationItems as $item)
                                    @php
        $totalPrice += $item->service_price;
        $totalDuration += $item->service_duration;
                                    @endphp
                                    <tr class="hover:bg-gray-50/50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                                            {{ $item->type }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-salon-text">
                                            @if($item->type == 'service')
                                                {{ $item->service_name }}
                                            @elseif($item->type == 'product')
                                                {{ $item->product_name }}
                                            @elseif($item->type == 'promotion')
                                                {{ $item->promotion_name }}
                                            @endif
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-salon-textLight text-center font-medium">
                                            @if($item->type == 'service')
                                                {{ $item->service_duration }} menit
                                            @elseif($item->type == 'product')
                                                {{ $item->product_quantity }} pcs
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-salon-text text-right">
                                            Rp {{ number_format($item->service_price, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50 border-t border-salon-beige">
                                <tr>
                                    <th scope="row" colspan="3"
                                        class="px-6 py-3 whitespace-nowrap text-sm font-bold text-salon-text text-right">Subtotal
                                    </th>
                                    <td class="px-6 py-3 whitespace-nowrap text-md font-bold text-salon-text text-right">Rp
                                        {{ number_format($totalPrice, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @if($reservation->discount_amount > 0)
                                <tr class="bg-green-50 text-green-700">
                                    <th scope="row" colspan="3"
                                        class="px-6 py-3 whitespace-nowrap text-sm font-bold text-right">Diskon Member
                                    </th>
                                    <td class="px-6 py-3 whitespace-nowrap text-md font-bold text-right">- Rp
                                        {{ number_format($reservation->discount_amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <th scope="row" colspan="3"
                                        class="px-6 py-5 whitespace-nowrap text-sm font-bold text-salon-text text-right border-t border-gray-200">Total
                                        Keseluruhan
                                    </th>
                                    <td class="px-6 py-5 whitespace-nowrap text-lg font-bold text-salon-goldHover text-right border-t border-gray-200">Rp
                                        {{ number_format($totalPrice - $reservation->discount_amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="sm:hidden space-y-4">
                        @foreach($reservation->reservationItems as $item)
                            <div class="bg-white p-4 rounded-xl border border-salon-beige shadow-sm">
                                <h5 class="font-bold text-salon-text text-base mb-2">
                                    @if($item->type == 'service')
                                        {{ $item->service_name }}
                                    @elseif($item->type == 'product')
                                        {{ $item->product_name }}
                                    @elseif($item->type == 'promotion')
                                        {{ $item->promotion_name }}
                                    @endif
                                </h5>
                                <div class="flex justify-between items-center mt-2">
                                    <span class="text-sm text-gray-500 font-medium flex items-center gap-1">
                                        @if($item->type == 'service')
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $item->service_duration }} Menit
                                        @elseif($item->type == 'product')
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                            </svg>
                                            {{ $item->product_quantity }} Pcs
                                        @endif
                                    </span>
                                    <span class="text-salon-text font-bold">
                                        Rp {{ number_format($item->service_price, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        @endforeach

                        <!-- Mobile Total Card -->
                        <div class="bg-salon-cream p-4 rounded-xl border border-salon-gold/30 shadow-sm mt-4">
                            <div class="flex justify-between items-center pt-2 mt-2 border-t border-salon-beige/50">
                                <span class="text-base font-bold text-salon-text">Subtotal</span>
                                <span class="text-md font-bold text-salon-text">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                            </div>
                            @if($reservation->discount_amount > 0)
                            <div class="flex justify-between items-center pt-2 mt-2 text-green-700">
                                <span class="text-base font-bold">Diskon Member</span>
                                <span class="text-md font-bold">- Rp {{ number_format($reservation->discount_amount, 0, ',', '.') }}</span>
                            </div>
                            @endif
                            <div class="flex justify-between items-center pt-2 mt-2 border-t border-salon-beige/50">
                                <span class="text-base font-bold text-salon-text">Total Pembayaran</span>
                                <span class="text-lg font-bold text-salon-goldHover">Rp
                                    {{ number_format($totalPrice - $reservation->discount_amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="mt-10 pt-6 border-t border-salon-beige flex flex-col sm:flex-row justify-between items-center gap-4">
                    <a href="{{ route('customer.dashboard') }}"
                        class="order-2 sm:order-1 w-full sm:w-auto text-sm font-medium text-salon-textLight hover:text-salon-goldHover transition flex justify-center items-center py-2.5 sm:py-0 border sm:border-transparent border-gray-300 rounded-lg sm:rounded-none bg-white sm:bg-transparent hover:bg-gray-50 sm:hover:bg-transparent shadow-sm sm:shadow-none gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Dasboard
                    </a>

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
    $textMessage = "Halo Admin Eeva Salon, Saya sudah melakukan reservasi melalui website dengan kode booking [{$bookingCode}]. Mohon konfirmasinya.";
    $message = urlencode($textMessage);

    // 6. Gabungkan menjadi link wa.me yang valid (sudah ditambahkan tanda / setelah wa.me)
    $waUrl = "https://wa.me/{$cleanPhone}?text={$message}";
                    @endphp

                    <a href="{{ $waUrl }}" target="_blank"
                        class="order-1 sm:order-2 w-full sm:w-auto flex justify-center items-center py-2.5 px-6 py-6 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-300">
                        Hubungi Admin via WhatsApp
                    </a>
                </div>
            </div>
        </div>
@endsection
