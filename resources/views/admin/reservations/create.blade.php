@extends('layouts.admin')

@section('header', 'Buat Transaksi Offline')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.reservations.index') }}"
            class="text-salon-textLight hover:text-salon-text flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
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
                    <div x-data="customerDropdown()" class="relative">
                        <label for="user_id" class="block font-medium text-sm text-gray-700">Pelanggan <span
                                class="text-red-500">*</span></label>
                        <input type="hidden" name="user_id" id="user_id" x-model="selectedId">

                        <button type="button" @click="open = !open" @click.away="open = false"
                            class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-salon-gold focus:border-salon-gold sm:text-sm mt-1">
                            <span class="block truncate" x-text="selectedName || '-- Pilih Pelanggan --'"></span>
                            <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        </button>

                        <div x-show="open" x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                            class="absolute z-10 mt-1 w-full bg-white shadow-lg rounded-md border border-gray-200"
                            style="display: none;">

                            <div class="p-2 border-b border-gray-100">
                                <input type="text" x-model="search" placeholder="Cari nama atau no. HP..."
                                    class="w-full text-sm border-gray-300 focus:border-salon-gold focus:ring-salon-gold rounded-md mb-2">
                                <div class="flex items-center space-x-4 text-sm">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" x-model="filters.online"
                                            class="rounded border-gray-300 text-salon-gold focus:ring-salon-gold">
                                        <span class="ml-2">Online</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" x-model="filters.offline"
                                            class="rounded border-gray-300 text-salon-gold focus:ring-salon-gold">
                                        <span class="ml-2">Offline</span>
                                    </label>
                                </div>
                            </div>

                            <ul class="max-h-52 overflow-y-auto py-1 text-base sm:text-sm">
                                <template x-for="customer in filteredCustomers" :key="customer.id">
                                    <li @click="selectCustomer(customer)"
                                        class="text-gray-900 cursor-default select-none relative py-2 pl-3 pr-9 border-b border-gray-50 last:border-0 group">
                                        <span class="block truncate font-medium" x-text="customer.name"></span>
                                        <span class="block truncate text-xs text-gray-500"
                                            x-text="(customer.phone || 'Tanpa nomor') + ' - ' + customer.type.charAt(0).toUpperCase() + customer.type.slice(1)"></span>
                                    </li>
                                </template>
                                <li x-show="filteredCustomers.length === 0"
                                    class="text-gray-500 cursor-default select-none relative py-2 pl-3 pr-9 text-sm">
                                    Tidak ada pelanggan ditemukan.
                                </li>
                            </ul>
                        </div>

                        @error('user_id')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div></div>

                    <!-- Booking Date -->
                    <div>
                        <label for="booking_date" class="block font-medium text-sm text-gray-700">Tanggal Transaksi <span
                                class="text-red-500">*</span></label>
                        <input id="booking_date" type="date" name="booking_date"
                            value="{{ old('booking_date', date('Y-m-d')) }}"
                            class="block mt-1 w-full border-gray-300 focus:border-salon-gold focus:ring-salon-gold rounded-md shadow-sm"
                            required>
                        @error('booking_date')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Booking Time -->
                    <div>
                        <label for="booking_time" class="block font-medium text-sm text-gray-700">Waktu <span
                                class="text-red-500">*</span></label>
                        <input id="booking_time" type="time" name="booking_time"
                            value="{{ old('booking_time', date('H:i')) }}"
                            class="block mt-1 w-full border-gray-300 focus:border-salon-gold focus:ring-salon-gold rounded-md shadow-sm"
                            required>
                        @error('booking_time')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                @error('general')
                    <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
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
                                <input type="checkbox" name="services[]" value="{{ $service->id }}"
                                    class="w-4 h-4 text-salon-gold border-gray-300 rounded focus:ring-salon-gold" {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}>
                            </div>
                            <div class="ml-3 text-sm">
                                <span class="font-medium text-gray-900">{{ $service->name }}</span>
                                <p class="text-gray-500">Rp {{ number_format($service->price, 0, ',', '.') }} •
                                    {{ $service->duration_minutes }} menit
                                </p>
                            </div>
                        </label>
                    @endforeach
                </div>

                <h3 class="text-lg font-bold text-salon-text mb-4 border-b pb-2">Catatan Tambahan</h3>
                <div>
                    <label for="notes" class="block font-medium text-sm text-gray-700">Catatan (Opsional)</label>
                    <textarea id="notes" name="notes" rows="3"
                        class="block mt-1 w-full border-gray-300 focus:border-salon-gold focus:ring-salon-gold rounded-md shadow-sm">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="bg-gray-50 px-6 py-4 border-t flex items-center justify-end">
                <a href="{{ route('admin.reservations.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 mr-3">
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-salon-gold border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 focus:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Simpan Transaksi Offline
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('customerDropdown', () => ({
                open: false,
                search: '',
                filters: {
                    online: true,
                    offline: true
                },
                selectedId: '{{ old('user_id', '') }}',
                selectedName: '',
                customers: <?php echo json_encode($customers->map(function ($c) {
        return [
            'id' => $c->id,
            'name' => $c->name,
            'phone' => $c->phone,
            'type' => $c->type
        ];
    })) ?>,

                init() {
                    if (this.selectedId) {
                        const cust = this.customers.find(c => c.id == this.selectedId);
                        if (cust) {
                            this.selectedName = cust.name;
                        }
                    }
                },

                get filteredCustomers() {
                    return this.customers.filter(customer => {
                        // Filter by type
                        if (!this.filters.online && customer.type === 'online') return false;
                        if (!this.filters.offline && customer.type === 'offline') return false;

                        // Filter by search
                        if (this.search === '') return true;

                        const searchLower = this.search.toLowerCase();
                        const nameMatch = customer.name.toLowerCase().includes(searchLower);
                        const phoneMatch = (customer.phone || '').toLowerCase().includes(searchLower);

                        return nameMatch || phoneMatch;
                    });
                },

                selectCustomer(customer) {
                    this.selectedId = customer.id;
                    this.selectedName = customer.name;
                    this.open = false;
                }
            }));
        });
    </script>
@endsection