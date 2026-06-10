@extends('layouts.admin')

@section('header', 'Buat Transaksi Offline')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.reservations.index') }}" class="text-salon-textLight hover:text-salon-text flex items-center">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar Reservasi
    </a>
</div>

<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    <form action="{{ route('admin.reservations.store') }}" method="POST">
        @csrf

        <div class="p-6">
            <h3 class="text-lg font-bold text-salon-text mb-4 border-b pb-2">Informasi Pelanggan & Waktu</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Customer Selection -->
                <div>
                    <label for="user_id" class="block font-medium text-sm text-gray-700">Pelanggan <span class="text-red-500">*</span></label>
                    <select id="user_id" name="user_id" class="block mt-1 w-full border-gray-300 focus:border-salon-gold focus:ring-salon-gold rounded-md shadow-sm" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ old('user_id') == $customer->id ? 'selected' : '' }}>
                                {{ $customer->name }} ({{ $customer->phone ?? 'Tanpa nomor' }}) - {{ ucfirst($customer->type) }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div></div>

                <!-- Booking Date -->
                <div>
                    <label for="booking_date" class="block font-medium text-sm text-gray-700">Tanggal Transaksi <span class="text-red-500">*</span></label>
                    <input id="booking_date" type="date" name="booking_date" value="{{ old('booking_date', date('Y-m-d')) }}" class="block mt-1 w-full border-gray-300 focus:border-salon-gold focus:ring-salon-gold rounded-md shadow-sm" required>
                    @error('booking_date')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Booking Time -->
                <div>
                    <label for="booking_time" class="block font-medium text-sm text-gray-700">Waktu <span class="text-red-500">*</span></label>
                    <input id="booking_time" type="time" name="booking_time" value="{{ old('booking_time', date('H:i')) }}" class="block mt-1 w-full border-gray-300 focus:border-salon-gold focus:ring-salon-gold rounded-md shadow-sm" required>
                    @error('booking_time')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            @error('general')
                <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">
                                {{ $message }}
                            </p>
                        </div>
                    </div>
                </div>
            @enderror

            <h3 class="text-lg font-bold text-salon-text mb-4 border-b pb-2">Pilih Layanan</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                @foreach($services as $service)
                    <label class="flex items-start p-3 border rounded-lg cursor-pointer hover:bg-gray-50 transition">
                        <div class="flex items-center h-5 mt-1">
                            <input type="checkbox" name="services[]" value="{{ $service->id }}" class="w-4 h-4 text-salon-gold border-gray-300 rounded focus:ring-salon-gold" {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}>
                        </div>
                        <div class="ml-3 text-sm">
                            <span class="font-medium text-gray-900">{{ $service->name }}</span>
                            <p class="text-gray-500">Rp {{ number_format($service->price, 0, ',', '.') }} • {{ $service->duration_minutes }} menit</p>
                        </div>
                    </label>
                @endforeach
            </div>

            <h3 class="text-lg font-bold text-salon-text mb-4 border-b pb-2">Pilih Produk</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                @foreach($products as $product)
                    <div class="flex items-start p-3 border rounded-lg hover:bg-gray-50 transition">
                        <div class="flex items-center h-5 mt-1">
                            <input type="checkbox" id="product_{{ $product->id }}_check" name="products[{{ $loop->index }}][id]" value="{{ $product->id }}" class="w-4 h-4 text-salon-gold border-gray-300 rounded focus:ring-salon-gold" {{ isset(old('products', [])[$loop->index]['id']) ? 'checked' : '' }} onchange="document.getElementById('product_{{ $product->id }}_qty').disabled = !this.checked; if(this.checked && document.getElementById('product_{{ $product->id }}_qty').value === '') document.getElementById('product_{{ $product->id }}_qty').value = 1;">
                        </div>
                        <div class="ml-3 text-sm flex-grow">
                            <label for="product_{{ $product->id }}_check" class="font-medium text-gray-900 cursor-pointer block">{{ $product->name }}</label>
                            <p class="text-gray-500 mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <div class="flex items-center">
                                <label for="product_{{ $product->id }}_qty" class="mr-2 text-xs text-gray-500">Qty:</label>
                                <input type="number" id="product_{{ $product->id }}_qty" name="products[{{ $loop->index }}][quantity]" value="{{ old('products.' . $loop->index . '.quantity', 1) }}" min="1" class="w-16 h-8 text-sm border-gray-300 focus:border-salon-gold focus:ring-salon-gold rounded-md shadow-sm" {{ isset(old('products', [])[$loop->index]['id']) ? '' : 'disabled' }}>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($promotions->isNotEmpty())
            <h3 class="text-lg font-bold text-salon-text mb-4 border-b pb-2">Pilih Promo / Paket</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                @foreach($promotions as $promo)
                    <label class="flex items-start p-3 border rounded-lg cursor-pointer hover:bg-gray-50 transition">
                        <div class="flex items-center h-5 mt-1">
                            <input type="checkbox" name="promotions[]" value="{{ $promo->id }}" class="w-4 h-4 text-salon-gold border-gray-300 rounded focus:ring-salon-gold" {{ in_array($promo->id, old('promotions', [])) ? 'checked' : '' }}>
                        </div>
                        <div class="ml-3 text-sm">
                            <span class="font-medium text-gray-900">{{ $promo->title }}</span>
                            <p class="text-gray-500 text-xs mt-1">{{ Str::limit($promo->description, 50) }}</p>
                        </div>
                    </label>
                @endforeach
            </div>
            @endif

            <h3 class="text-lg font-bold text-salon-text mb-4 border-b pb-2">Catatan Tambahan</h3>
            <div>
                <label for="notes" class="block font-medium text-sm text-gray-700">Catatan (Opsional)</label>
                <textarea id="notes" name="notes" rows="3" class="block mt-1 w-full border-gray-300 focus:border-salon-gold focus:ring-salon-gold rounded-md shadow-sm">{{ old('notes') }}</textarea>
                @error('notes')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="bg-gray-50 px-6 py-4 border-t flex items-center justify-end">
            <a href="{{ route('admin.reservations.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 mr-3">
                Batal
            </a>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-salon-gold border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 focus:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Simpan Transaksi Offline
            </button>
        </div>
    </form>
</div>
@endsection
