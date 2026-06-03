<x-layouts.app>
    <div class="bg-rose-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl">Our Packages & Services</h1>
                <p class="mt-4 text-xl text-gray-600">Choose the perfect treatment to pamper yourself.</p>
            </div>

            <!-- Category Navigation Tabs (Static for now, could be dynamic) -->
            <div class="flex justify-center space-x-4 mb-10">
                <button class="px-6 py-2 rounded-full bg-rose-600 text-white font-semibold shadow-sm hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500">All</button>
                <button class="px-6 py-2 rounded-full bg-white text-gray-700 font-semibold shadow-sm hover:bg-rose-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500">Hair</button>
                <button class="px-6 py-2 rounded-full bg-white text-gray-700 font-semibold shadow-sm hover:bg-rose-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500">Nail</button>
                <button class="px-6 py-2 rounded-full bg-white text-gray-700 font-semibold shadow-sm hover:bg-rose-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500">Facial</button>
            </div>

            <!-- Package Grid Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($packages ?? [] as $package)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-rose-100 flex flex-col">
                        <div class="p-6 flex-grow">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-2xl font-bold text-rose-800">{{ $package->name }}</h3>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-100 text-rose-800">
                                    {{ $package->duration_min }} mins
                                </span>
                            </div>
                            <p class="text-gray-600 mb-6">{{ $package->description }}</p>

                            <h4 class="font-semibold text-gray-900 mb-2">Includes:</h4>
                            <ul class="space-y-2 mb-6">
                                @forelse ($package->package_details ?? [] as $detail)
                                    <li class="flex items-start">
                                        <svg class="h-5 w-5 text-rose-500 mr-2 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="text-sm text-gray-700">{{ $detail->item_name ?? $detail }}</span>
                                    </li>
                                @empty
                                    <li class="text-sm text-gray-500 italic">No details available.</li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="bg-rose-50 p-6 border-t border-rose-100 flex items-center justify-between">
                            <div class="text-2xl font-bold text-gray-900">
                                Rp {{ number_format($package->price, 0, ',', '.') }}
                            </div>
                            <a href="{{ url('/reservations/create?package_id=' . $package->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-rose-600 hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500">
                                Book Now
                            </a>
                        </div>
                    </div>
                @empty
                    <!-- Placeholder/Dummy Data if $packages is empty -->
                    @for ($i = 1; $i <= 6; $i++)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-rose-100 flex flex-col">
                            <div class="p-6 flex-grow">
                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="text-2xl font-bold text-rose-800">Premium Package {{ $i }}</h3>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-100 text-rose-800">
                                        120 mins
                                    </span>
                                </div>
                                <p class="text-gray-600 mb-6">Experience our signature premium treatment customized just for you. Relax and rejuvenate.</p>

                                <h4 class="font-semibold text-gray-900 mb-2">Includes:</h4>
                                <ul class="space-y-2 mb-6">
                                    <li class="flex items-start">
                                        <svg class="h-5 w-5 text-rose-500 mr-2 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="text-sm text-gray-700">Pikaru Hair Spa</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="h-5 w-5 text-rose-500 mr-2 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="text-sm text-gray-700">Basic Manicure</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="bg-rose-50 p-6 border-t border-rose-100 flex items-center justify-between">
                                <div class="text-2xl font-bold text-gray-900">
                                    Rp 500.000
                                </div>
                                <a href="{{ url('/reservations/create?package_id='.$i) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-rose-600 hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    @endfor
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.app>