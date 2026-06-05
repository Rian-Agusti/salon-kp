<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Service;
use App\Models\Setting;

class PublicController extends Controller
{
    public function home()
    {
        $services = Service::where('is_active', true)->take(6)->get();
        $promotions = Promotion::where('is_active', true)->whereDate('end_date', '>=', now())->take(3)->get();

        return view('home', compact('services', 'promotions'));
    }

    public function services()
    {
        $services = Service::where('is_active', true)->get();

        return view('services', compact('services'));
    }

    public function products()
    {
        $products = Product::where('is_active', true)->get();

        return view('products', compact('products'));
    }

    public function promotions()
    {
        $promotions = Promotion::where('is_active', true)->whereDate('end_date', '>=', now())->get();

        return view('promotions', compact('promotions'));
    }

    public function gallery()
    {
        $galleries = Gallery::all();

        return view('gallery', compact('galleries'));
    }

    public function contact()
    {
        $setting = Setting::first();

        return view('contact', compact('setting'));
    }
}
