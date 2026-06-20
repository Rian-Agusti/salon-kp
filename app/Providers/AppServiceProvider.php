<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
                RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip());
        });

        RateLimiter::for('register', function (Request $request) {
            return Limit::perHour(3)->by($request->ip());
        });

        RateLimiter::for('reservation-store', function (Request $request) {
            return Limit::perHour(10)->by($request->user()?->id ?: $request->ip());
        });

        View::composer(['layouts.public', 'layouts.admin', 'layouts.customer', 'contact', 'customer.reservations.index', 'customer.reservations.success', 'customer.reservations.show', 'admin.settings.edit'], function ($view) {
            $settingArray = Cache::rememberForever('public.setting', function () {
                $setting = Setting::firstOrCreate(['id' => 1]);
                return array_merge([
                    'phone' => '',
                    'email' => '',
                    'address' => '',
                    'salon_name' => '',
                    'instagram' => '',
                    'facebook' => '',
                    'tiktok' => '',
                    'google_maps' => '',
                ], $setting->toArray());
            });
            $view->with('setting', (object) $settingArray);
        });
    }
}
