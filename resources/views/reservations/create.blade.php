<x-layouts.app>
    <div class="bg-rose-50 py-12 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            @guest
                <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-8" role="alert">
                    <div class="flex">
                        <div class="shrink-0">
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">
                                Harus Login Terlebih Dahulu. Please <a href="{{ url('/login') }}" class="font-medium underline text-red-700 hover:text-red-600">login</a> or <a href="{{ url('/register') }}" class="font-medium underline text-red-700 hover:text-red-600">register</a> to make a reservation.
                            </p>
                        </div>
                    </div>
                </div>
            @endguest

            <div class="bg-white shadow sm:rounded-lg overflow-hidden border border-rose-100">
                <div class="px-4 py-5 sm:px-6 bg-rose-600">
                    <h3 class="text-lg leading-6 font-medium text-white">Book Your Reservation</h3>
                    <p class="mt-1 max-w-2xl text-sm text-rose-100">Complete the steps below to secure your appointment.</p>
                </div>

                <form action="{{ url('/reservations') }}" method="POST" class="p-6">
                    @csrf

                    <!-- Step 1: Package Confirmation -->
                    <div class="mb-8">
                        <h4 class="text-lg font-medium text-gray-900 border-b border-rose-100 pb-2 mb-4">Step 1: Selected Package</h4>
                        <div class="bg-rose-50 p-4 rounded-md flex justify-between items-center">
                            <div>
                                <h5 class="font-bold text-rose-800">{{ request('package_id') ? 'Premium Package ' . request('package_id') : 'Select a Package' }}</h5>
                                <p class="text-sm text-gray-600">Please confirm your selection.</p>
                            </div>
                            <!-- In a real app, this would be a hidden input or select, keeping it simple for UI -->
                            <select name="package_id" class="block w-48 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-rose-500 focus:border-rose-500 sm:text-sm rounded-md shadow-sm">
                                <option value="">Select Package</option>
                                <option value="1" {{ request('package_id') == '1' ? 'selected' : '' }}>Premium Package 1</option>
                                <option value="2" {{ request('package_id') == '2' ? 'selected' : '' }}>Premium Package 2</option>
                            </select>
                        </div>
                    </div>

                    <!-- Step 2: Date & Time -->
                    <div class="mb-8">
                        <h4 class="text-lg font-medium text-gray-900 border-b border-rose-100 pb-2 mb-4">Step 2: Choose Date & Time</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="booking_date" class="block text-sm font-medium text-gray-700">Date</label>
                                <input type="date" name="booking_date" id="booking_date" class="mt-1 focus:ring-rose-500 focus:border-rose-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border" required>
                            </div>
                            <div>
                                <label for="booking_time" class="block text-sm font-medium text-gray-700">Time</label>
                                <!-- Temporary placeholder for Alpine/JS logic -->
                                <select name="booking_time" id="booking_time" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-rose-500 focus:border-rose-500 sm:text-sm" required>
                                    <option value="">Select available slot</option>
                                    <option value="09:00">09:00 AM</option>
                                    <option value="11:00">11:00 AM</option>
                                    <option value="13:00">01:00 PM</option>
                                    <option value="15:00">03:00 PM</option>
                                    <option value="17:00">05:00 PM</option>
                                </select>
                                <p class="mt-2 text-xs text-rose-500" id="availability-message">Select a date to check availability.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Stylist -->
                    <div class="mb-8">
                        <h4 class="text-lg font-medium text-gray-900 border-b border-rose-100 pb-2 mb-4">Step 3: Select Stylist</h4>
                        <div>
                            <label for="stylist_id" class="block text-sm font-medium text-gray-700">Stylist (Optional)</label>
                            <select name="stylist_id" id="stylist_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-rose-500 focus:border-rose-500 sm:text-sm">
                                <option value="">Any Available Stylist</option>
                                <option value="1">Sarah - Senior Stylist</option>
                                <option value="2">Maya - Color Specialist</option>
                                <option value="3">Dina - Hair Spa Expert</option>
                            </select>
                        </div>
                    </div>

                    <!-- Step 4: Customer Information -->
                    <div class="mb-8">
                        <h4 class="text-lg font-medium text-gray-900 border-b border-rose-100 pb-2 mb-4">Step 4: Your Details</h4>
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="customer_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                <input type="text" name="customer_name" id="customer_name" class="mt-1 focus:ring-rose-500 focus:border-rose-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border" value="{{ auth()->user()->name ?? '' }}" required>
                            </div>
                            <div>
                                <label for="customer_phone" class="block text-sm font-medium text-gray-700">Phone Number (WhatsApp)</label>
                                <input type="tel" name="customer_phone" id="customer_phone" class="mt-1 focus:ring-rose-500 focus:border-rose-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border" required>
                            </div>
                            <div>
                                <label for="notes" class="block text-sm font-medium text-gray-700">Additional Notes</label>
                                <textarea id="notes" name="notes" rows="3" class="mt-1 shadow-sm focus:ring-rose-500 focus:border-rose-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2" placeholder="Any specific requests or conditions we should know about?"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="pt-5 border-t border-gray-200 flex justify-end">
                        <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500">
                            Cancel
                        </button>
                        <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-rose-600 hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500" {{ !auth()->check() ? 'disabled' : '' }}>
                            Confirm Booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>