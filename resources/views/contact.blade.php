@extends('layouts.public')

@section('content')
<div class="py-12 bg-stone-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-gray-900">Contact Us</h1>
            <p class="mt-4 text-xl text-gray-500">Get in touch with us for inquiries or to schedule an appointment.</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="p-8 md:p-12 bg-rose-50">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Salon Information</h3>

                    <div class="space-y-6">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-rose-500 mt-1 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <div>
                                <h4 class="font-medium text-gray-900">Address</h4>
                                <p class="text-gray-600 mt-1">{{ $setting->address ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-rose-500 mt-1 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <div>
                                <h4 class="font-medium text-gray-900">Phone</h4>
                                <p class="text-gray-600 mt-1">{{ $setting->phone ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-rose-500 mt-1 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <div>
                                <h4 class="font-medium text-gray-900">Email</h4>
                                <p class="text-gray-600 mt-1">{{ $setting->email ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-rose-500 mt-1 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <div>
                                <h4 class="font-medium text-gray-900">Opening Hours</h4>
                                <p class="text-gray-600 mt-1">Mon - Sun: {{ \Carbon\Carbon::parse($setting->opening_hour ?? '09:00')->format('H:i') }} - {{ \Carbon\Carbon::parse($setting->closing_hour ?? '19:00')->format('H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-8 border-t border-rose-200">
                        <h4 class="font-medium text-gray-900 mb-4">Follow Us</h4>
                        <div class="flex space-x-4">
                            @if(!empty($setting->instagram))
                                <a href="{{ $setting->instagram }}" target="_blank" class="text-rose-500 hover:text-rose-600 font-medium">Instagram</a>
                            @endif
                            @if(!empty($setting->facebook))
                                <a href="{{ $setting->facebook }}" target="_blank" class="text-rose-500 hover:text-rose-600 font-medium">Facebook</a>
                            @endif
                            @if(!empty($setting->tiktok))
                                <a href="{{ $setting->tiktok }}" target="_blank" class="text-rose-500 hover:text-rose-600 font-medium">TikTok</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="p-0 h-96 md:h-auto">
                    @if(!empty($setting->google_maps))
                        {!! $setting->google_maps !!}
                    @else
                        <div class="w-full h-full bg-stone-200 flex items-center justify-center text-stone-500">
                            Google Maps not configured
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
