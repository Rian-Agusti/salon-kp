@extends('layouts.admin')

@section('header', 'Salon Settings')

@section('content')
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <form action="{{ route('admin.settings.update') }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- General Info -->
                <div>
                    <h3 class="text-lg font-bold text-salon-text mb-4 border-b pb-2">Infomasi General</h3>

                    <div class="space-y-4">
                        <div>
                            <label for="salon_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Salon
                                *</label>
                            <input type="text" name="salon_name" id="salon_name"
                                value="{{ old('salon_name', $setting->salon_name) }}" required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-salon-gold focus:ring focus:ring-salon-beige">
                            @error('salon_name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                            <textarea name="address" id="address" rows="3"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-salon-gold focus:ring focus:ring-salon-beige">{{ old('address', $setting->address) }}</textarea>
                            @error('address') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomer
                                    WhatsApp</label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone', $setting->phone) }}"
                                    placeholder="e.g. 6281234567890"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-salon-gold focus:ring focus:ring-salon-beige">
                                <div class="mt-2 bg-blue-50 border-l-4 border-blue-400 p-2 text-xs text-blue-700 rounded-r-md">
                                    <p class="font-medium">Nomor ini akan digunakan untuk tombol Hubungi Admin di halaman sukses reservasi dan halaman kontak publik.</p>
                                </div>
                                @error('phone') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $setting->email) }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-salon-gold focus:ring focus:ring-salon-beige">
                                @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="opening_hour" class="block text-sm font-medium text-gray-700 mb-1">Jam Buka
                                    *</label>
                                <input type="time" name="opening_hour" id="opening_hour"
                                    value="{{ old('opening_hour', \Carbon\Carbon::parse($setting->opening_hour)->format('H:i')) }}"
                                    required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-salon-gold focus:ring focus:ring-salon-beige">
                                @error('opening_hour') <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="closing_hour" class="block text-sm font-medium text-gray-700 mb-1">Jam Tutup
                                    *</label>
                                <input type="time" name="closing_hour" id="closing_hour"
                                    value="{{ old('closing_hour', \Carbon\Carbon::parse($setting->closing_hour)->format('H:i')) }}"
                                    required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-salon-gold focus:ring focus:ring-salon-beige">
                                @error('closing_hour') <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social & Maps -->
                <div>
                    <h3 class="text-lg font-bold text-salon-text mb-4 border-b pb-2">Social Media & Map</h3>

                    <div class="space-y-4">
                        <div>
                            <label for="instagram" class="block text-sm font-medium text-gray-700 mb-1">Instagram
                                URL</label>
                            <input type="url" name="instagram" id="instagram"
                                value="{{ old('instagram', $setting->instagram) }}" placeholder="https://instagram.com/..."
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-salon-gold focus:ring focus:ring-salon-beige">
                            @error('instagram') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="facebook" class="block text-sm font-medium text-gray-700 mb-1">Facebook URL</label>
                            <input type="url" name="facebook" id="facebook"
                                value="{{ old('facebook', $setting->facebook) }}" placeholder="https://facebook.com/..."
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-salon-gold focus:ring focus:ring-salon-beige">
                            @error('facebook') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="tiktok" class="block text-sm font-medium text-gray-700 mb-1">TikTok URL</label>
                            <input type="url" name="tiktok" id="tiktok" value="{{ old('tiktok', $setting->tiktok) }}"
                                placeholder="https://tiktok.com/@..."
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-salon-gold focus:ring focus:ring-salon-beige">
                            @error('tiktok') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="google_maps" class="block text-sm font-medium text-gray-700 mb-1">Google Maps Embed
                                HTML</label>
                            <textarea name="google_maps" id="google_maps" rows="4" placeholder='<iframe src="..."></iframe>'
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-salon-gold focus:ring focus:ring-salon-beige">{{ old('google_maps', $setting->google_maps) }}</textarea>
                            @error('google_maps') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            <p class="text-xs text-gray-500 mt-1">Go to Google Maps -> Share -> Embed a map -> Copy HTML</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-6 mt-6 border-t border-gray-200">
                <button type="submit"
                    class="bg-salon-gold hover:bg-salon-goldHover text-white font-medium py-2 px-6 rounded shadow-sm">Simpan
                    Settings</button>
            </div>
        </form>
    </div>
@endsection