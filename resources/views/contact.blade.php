@extends('layouts.public')

@section('content')
    <div class="bg-salon-bg py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-salon-gold font-semibold tracking-wider uppercase text-sm">Hubungi Kami</span>
                <h1 class="mt-2 text-4xl font-serif font-bold text-salon-text sm:text-5xl">Informasi Kontak</h1>
                <p class="mt-4 max-w-2xl text-lg text-salon-textLight mx-auto">Kami senang mendengar dari Anda. Hubungi kami
                    untuk informasi lebih lanjut atau pemesanan.</p>
            </div>

            <div
                class="bg-white rounded-3xl shadow-sm hover:shadow-md transition duration-300 overflow-hidden border border-salon-beige">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-8 md:p-12 lg:p-16 bg-salon-cream">
                        <h3 class="text-2xl font-serif font-bold text-salon-text mb-8">Informasi Salon</h3>

                        <div class="space-y-8">
                            <div class="flex items-start group">
                                <div
                                    class="flex-shrink-0 text-salon-gold bg-white p-3 rounded-full group-hover:bg-salon-gold group-hover:text-white transition duration-300 shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-5">
                                    <h4 class="font-bold text-salon-text">Alamat</h4>
                                    <p class="text-salon-textLight mt-2 leading-relaxed">
                                        {{ $setting->address ?? 'Belum diatur' }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start group">
                                <div
                                    class="flex-shrink-0 text-salon-gold bg-white p-3 rounded-full group-hover:bg-salon-gold group-hover:text-white transition duration-300 shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="ml-5">
                                    <h4 class="font-bold text-salon-text">Telepon</h4>
                                    <p class="text-salon-textLight mt-2">{{ $setting->phone ?? 'Belum diatur' }}</p>
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

                                            // 4. Buat template teks dan encode agar aman dibaca oleh browser URL
                                            $textMessage = "Halo Admin Eeva Salon, saya ingin bertanya tentang layanan Anda.";
                                            $message = urlencode($textMessage);

                                            // 5. Gabungkan menjadi link wa.me yang valid
                                            $waUrl = "https://wa.me/{$cleanPhone}?text={$message}";
                                        @endphp
                                        <a href="{{ $waUrl }}" target="_blank"
                                            class="mt-3 inline-flex items-center text-sm font-medium text-green-600 hover:text-green-700 bg-green-50 px-3 py-1.5 rounded-full transition">
                                            <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                            </svg>
                                            Hubungi via WhatsApp
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <div class="flex items-start group">
                                <div
                                    class="flex-shrink-0 text-salon-gold bg-white p-3 rounded-full group-hover:bg-salon-gold group-hover:text-white transition duration-300 shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="ml-5">
                                    <h4 class="font-bold text-salon-text">Email</h4>
                                    <p class="text-salon-textLight mt-2">{{ $setting->email ?? 'Belum diatur' }}</p>
                                </div>
                            </div>

                            <div class="flex items-start group">
                                <div
                                    class="flex-shrink-0 text-salon-gold bg-white p-3 rounded-full group-hover:bg-salon-gold group-hover:text-white transition duration-300 shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-5">
                                    <h4 class="font-bold text-salon-text">Jam Operasional</h4>
                                    <p class="text-salon-textLight mt-2">Senin - Minggu:
                                        {{ \Carbon\Carbon::parse($setting->opening_hour ?? '09:00')->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($setting->closing_hour ?? '19:00')->format('H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-10 pt-8 border-t border-salon-beige/60">
                            <h4 class="font-bold text-salon-text mb-4">Ikuti Kami</h4>
                            <div class="flex space-x-4">
                                @if(!empty($setting->instagram))
                                    <a href="{{ $setting->instagram }}" target="_blank"
                                        class="text-salon-gold hover:text-salon-goldHover font-medium hover:underline transition">Instagram</a>
                                @endif
                                @if(!empty($setting->facebook))
                                    <a href="{{ $setting->facebook }}" target="_blank"
                                        class="text-salon-gold hover:text-salon-goldHover font-medium hover:underline transition">Facebook</a>
                                @endif
                                @if(!empty($setting->tiktok))
                                    <a href="{{ $setting->tiktok }}" target="_blank"
                                        class="text-salon-gold hover:text-salon-goldHover font-medium hover:underline transition">TikTok</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="p-0 h-[400px] md:h-auto w-full relative bg-gray-100">
                        @if(!empty($setting->google_maps))
                            {!! str_replace('<iframe ', '<iframe class="w-full h-full absolute inset-0" style="border:0;" ', $setting->google_maps) !!}
                        @else
                            <div
                                class="w-full h-full bg-gray-100 flex flex-col items-center justify-center text-gray-400 absolute inset-0">
                                <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7">
                                    </path>
                                </svg>
                                <span>Google Maps belum diatur</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
