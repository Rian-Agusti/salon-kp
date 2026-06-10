<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Customer;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/services', [PublicController::class, 'services'])->name('services');
Route::get('/products', [PublicController::class, 'products'])->name('products');
Route::get('/promotions', [PublicController::class, 'promotions'])->name('promotions');
Route::get('/gallery', [PublicController::class, 'gallery'])->name('gallery');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');

// Auth routes (from Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Customer routes
Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [Customer\ReservationController::class, 'index'])->name('dashboard');
    Route::resource('reservations', Customer\ReservationController::class)->only(['create', 'store', 'index', 'show']);
    Route::get('reservations/{reservation}/success', [Customer\ReservationController::class, 'success'])->name('reservations.success');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('services', Admin\ServiceController::class);
    Route::resource('products', Admin\ProductController::class);
    Route::resource('promotions', Admin\PromotionController::class);
    Route::resource('galleries', Admin\GalleryController::class);

    Route::resource('reservations', Admin\ReservationController::class)->except(['edit', 'update']);
    Route::patch('reservations/{reservation}/status', [Admin\ReservationController::class, 'updateStatus'])->name('reservations.updateStatus');
    Route::get('reservations/{reservation}/pdf', [Admin\ReservationController::class, 'pdf'])->name('reservations.pdf');

    Route::resource('customers', Admin\CustomerController::class)->except(['destroy']);

    Route::get('settings', [Admin\SettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [Admin\SettingController::class, 'update'])->name('settings.update');
});

require __DIR__.'/auth.php';
Route::get('/dashboard', function () {
    return redirect('/customer/dashboard');
})->middleware(['auth'])->name('dashboard');
