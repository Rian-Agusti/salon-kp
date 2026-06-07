@extends('layouts.customer')

@section('header')
    Detail Reservasi #{{ $reservation->reservation_code }}
@endsection

@section('content')
    <div class="bg-white rounded-2xl shadow-sm border border-salon-beige overflow-hidden">
        <div class="p-6 sm:p-8 bg-white border-b border-salon-beige">

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 pb-6 border-b border-salon-beige gap-4">
                <div>
                    <h3 class="text-2xl font-serif font-bold text-salon-text">{{ $reservation->reservation_code }}</h3>
                    <p class="text-sm text-gray-500 mt-1">Dipesan pada {{ $reservation->created_at->translatedFormat('d F Y H:i') }}</p>
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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div>
                    <h4 class="text-sm font-bold text-salon-text uppercase tracking-wider mb-4">Info Jadwal</h4>
                    <div class="bg-gray-50 p-5 rounded-xl border border-salon-beige">
                        <p class="mb-3 flex items-center"><span class="text-gray-500 w-24 inline-block font-medium">Tanggal:</span> <span
                                class="font-bold text-salon-text">{{ $reservation->booking_date->translatedFormat('l, d F Y') }}</span></p>
                        <p class="flex items-center"><span class="text-gray-500 w-24 inline-block font-medium">Waktu:</span> <span
                                class="font-bold text-salon-text">{{ \Carbon\Carbon::parse($reservation->booking_time)->format('H:i') }} WIB</span>
                        </p>
                    </div>

                    @if($reservation->notes)
                        <div class="mt-6">
                            <h4 class="text-sm font-bold text-salon-text uppercase tracking-wider mb-3">Catatan Khusus</h4>
                            <p class="text-amber-800 bg-amber-50 border border-amber-100 p-4 rounded-xl text-sm leading-relaxed">"{{ $reservation->notes }}"</p>
                        </div>
                    @endif
                </div>

                <div>
                    <h4 class="text-sm font-bold text-salon-text uppercase tracking-wider mb-4">Data Diri Anda</h4>
                    <div class="bg-gray-50 p-5 rounded-xl border border-salon-beige">
                        <p class="mb-3 flex items-center"><span class="text-gray-500 w-24 inline-block font-medium">Nama:</span> <span
                                class="font-bold text-salon-text">{{ $reservation->customer_name }}</span></p>
                        <p class="mb-3 flex items-center"><span class="text-gray-500 w-24 inline-block font-medium">Email:</span> <span
                                class="font-bold text-salon-text">{{ $reservation->customer_email }}</span></p>
                        <p class="flex items-center"><span class="text-gray-500 w-24 inline-block font-medium">Telepon:</span> <span
                                class="font-bold text-salon-text">{{ $reservation->customer_phone ?? 'Tidak diisi' }}</span></p>
                    </div>
                </div>
            </div>

            <div>
                <h4 class="text-sm font-bold text-salon-text uppercase tracking-wider mb-4">Layanan & Produk yang Dipilih</h4>
                <div class="border border-salon-beige rounded-xl overflow-hidden shadow-sm">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Layanan</th>
                                <th scope="col"
                                    class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Durasi</th>
                                <th scope="col"
                                    class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Harga</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @php
                                $totalPrice = 0;
                                $totalDuration = 0;
                            @endphp
                            @foreach($reservation->reservationItems as $item)
                                @php
                                    $totalPrice += $item->service_price;
                                    $totalDuration += $item->service_duration;
                                @endphp
                                <tr class="hover:bg-gray-50/50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-salon-text">
                                        {{ $item->service_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-salon-textLight text-center font-medium">
                                        {{ $item->service_duration }} menit
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-salon-text text-right">
                                        Rp {{ number_format($item->service_price, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50 border-t border-salon-beige">
                            <tr>
                                <th scope="row"
                                    class="px-6 py-5 whitespace-nowrap text-sm font-bold text-salon-text text-right">Total Keseluruhan
                                </th>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-bold text-salon-gold text-center">
                                    {{ $totalDuration }} menit</td>
                                <td class="px-6 py-5 whitespace-nowrap text-lg font-bold text-salon-goldHover text-right">Rp
                                    {{ number_format($totalPrice, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="mt-10 pt-6 border-t border-salon-beige flex flex-col sm:flex-row justify-between items-center gap-4">
                <a href="{{ route('customer.dashboard') }}"
                    class="order-2 sm:order-1 text-sm font-medium text-salon-textLight hover:text-salon-goldHover transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Dasbor
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
                    class="order-1 sm:order-2 w-full sm:w-auto flex justify-center items-center py-2.5 px-6 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-300">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    Hubungi Admin via WhatsApp
                </a>
            </div>
        </div>
    </div>
@endsection
