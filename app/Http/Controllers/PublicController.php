<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class PublicController extends Controller
{
    public function home()
    {
        $services = Cache::remember('public.home.services', 600, function () {
            return Service::where('is_active', true)->take(6)->get();
        });

        $promotions = Cache::remember('public.home.promotions', 600, function () {
            return Promotion::where('is_active', true)->whereDate('end_date', '>=', now())->take(3)->get();
        });

        return view('home', compact('services', 'promotions'));
    }

    public function services()
    {
        $services = Cache::remember('public.services', 600, function () {
            return Service::where('is_active', true)->get();
        });

        return view('services', compact('services'));
    }

    public function products()
    {
        $products = Cache::remember('public.products', 600, function () {
            return Product::where('is_active', true)->get();
        });

        return view('products', compact('products'));
    }

    public function promotions()
    {
        $promotions = Cache::remember('public.promotions', 600, function () {
            return Promotion::where('is_active', true)->whereDate('end_date', '>=', now())->get();
        });

        return view('promotions', compact('promotions'));
    }

    public function gallery()
    {
        $galleries = Cache::remember('public.gallery', 600, function () {
            return Gallery::all();
        });

        return view('gallery', compact('galleries'));
    }

    public function contact()
    {
        $setting = Cache::rememberForever('public.setting', function () {
            return Setting::first();
        });

        return view('contact', compact('setting'));
    }
}
