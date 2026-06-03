<x-layouts.app>
    <!-- Hero Section -->
    <div class="bg-rose-100 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 text-center md:text-left mb-10 md:mb-0">
                <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                    <span class="block text-rose-800 mb-2">Women Only</span>
                    <span class="block text-rose-600">Professional Salon</span>
                </h1>
                <p class="mt-3 text-base text-gray-700 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                    Experience premium treatments using high-quality products. We are proudly Pikaru Authorized brand from Korea.
                </p>
                <div class="mt-8 sm:flex sm:justify-center md:justify-start">
                    <div class="rounded-md shadow">
                        <a href="{{ url('/packages') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-rose-600 hover:bg-rose-700 md:py-4 md:text-lg transition duration-150 ease-in-out">
                            Book an Appointment
                        </a>
                    </div>
                    <div class="mt-3 sm:mt-0 sm:ml-3">
                        <a href="{{ url('/pricelist') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-rose-700 bg-rose-200 hover:bg-rose-300 md:py-4 md:text-lg transition duration-150 ease-in-out">
                            View Pricelist
                        </a>
                    </div>
                </div>
            </div>
            <div class="md:w-1/2">
                <!-- Placeholder for Hero Image -->
                <div class="rounded-lg shadow-xl overflow-hidden aspect-video bg-rose-200 flex items-center justify-center">
                    <span class="text-rose-400 font-semibold text-lg">Hero Image Placeholder</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Promotional Section -->
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Special Offers</h2>
                <p class="mt-4 text-lg text-gray-500">Don't miss out on our limited time promotions!</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Promo Card 1 -->
                <div class="bg-rose-50 rounded-lg shadow overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-rose-700 mb-2">Happy Hour Discount!</h3>
                        <p class="text-gray-600 mb-4">Get up to 50% off on all hair spa treatments every Tuesday and Wednesday between 10 AM and 2 PM.</p>
                        <a href="#" class="text-rose-600 font-semibold hover:text-rose-800">Learn more &rarr;</a>
                    </div>
                </div>
                <!-- Promo Card 2 -->
                <div class="bg-rose-50 rounded-lg shadow overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-rose-700 mb-2">Pikaru Special</h3>
                        <p class="text-gray-600 mb-4">Experience the magic of Korea's Pikaru treatment with a 20% discount this month.</p>
                        <a href="#" class="text-rose-600 font-semibold hover:text-rose-800">Learn more &rarr;</a>
                    </div>
                </div>
                <!-- Promo Card 3 -->
                <div class="bg-rose-50 rounded-lg shadow overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-rose-700 mb-2">Bring a Friend</h3>
                        <p class="text-gray-600 mb-4">Bring a friend and both of you will receive a complimentary basic facial with any hair coloring service.</p>
                        <a href="#" class="text-rose-600 font-semibold hover:text-rose-800">Learn more &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Gallery -->
    <div class="py-16 bg-rose-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Our Transformations</h2>
                <p class="mt-4 text-lg text-gray-500">See the stunning results of our treatments.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @for ($i = 1; $i <= 8; $i++)
                    <div class="bg-white rounded-lg shadow overflow-hidden aspect-square flex items-center justify-center relative group">
                        <span class="text-gray-400 font-semibold">Image {{ $i }}</span>
                        <div class="absolute inset-0 bg-rose-900 bg-opacity-70 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="text-white font-medium">Before & After</span>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <!-- Testimonials -->
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">What Our Clients Say</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Review Card 1 -->
                <div class="bg-rose-50 rounded-lg p-6 shadow-sm border border-rose-100">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 flex">
                            <!-- 5 Stars -->
                            @for ($j = 0; $j < 5; $j++)
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                    </div>
                    <p class="text-gray-700 italic mb-4">"The Pikaru smoothing treatment was incredible! My hair has never felt this soft and healthy. Highly recommend Eeva Salon!"</p>
                    <p class="font-semibold text-rose-800">- Sarah D.</p>
                </div>
                 <!-- Review Card 2 -->
                 <div class="bg-rose-50 rounded-lg p-6 shadow-sm border border-rose-100">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 flex">
                            <!-- 5 Stars -->
                            @for ($j = 0; $j < 5; $j++)
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                    </div>
                    <p class="text-gray-700 italic mb-4">"Very cozy and private since it's women-only. The facial left my skin glowing. The staff is so friendly and professional."</p>
                    <p class="font-semibold text-rose-800">- Rina M.</p>
                </div>
                 <!-- Review Card 3 -->
                 <div class="bg-rose-50 rounded-lg p-6 shadow-sm border border-rose-100">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 flex">
                            <!-- 5 Stars -->
                            @for ($j = 0; $j < 5; $j++)
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                    </div>
                    <p class="text-gray-700 italic mb-4">"Best hair coloring experience! The stylist really understood what I wanted and the color is perfect. Love the ambiance."</p>
                    <p class="font-semibold text-rose-800">- Alya K.</p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>