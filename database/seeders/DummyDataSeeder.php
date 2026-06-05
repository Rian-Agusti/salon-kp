<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Gallery;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Services
        $services = [
            ['name' => 'Haircut & Styling', 'price' => 150000, 'duration' => 60, 'desc' => 'Professional haircut and styling.'],
            ['name' => 'Hair Coloring', 'price' => 350000, 'duration' => 120, 'desc' => 'Full hair coloring.'],
            ['name' => 'Facial Treatment', 'price' => 200000, 'duration' => 60, 'desc' => 'Rejuvenating facial treatment.'],
            ['name' => 'Manicure & Pedicure', 'price' => 120000, 'duration' => 90, 'desc' => 'Complete nail care.'],
            ['name' => 'Creambath', 'price' => 100000, 'duration' => 60, 'desc' => 'Relaxing hair creambath.'],
        ];

        foreach ($services as $srv) {
            Service::firstOrCreate(
                ['slug' => Str::slug($srv['name'])],
                [
                    'name' => $srv['name'],
                    'description' => $srv['desc'],
                    'price' => $srv['price'],
                    'duration_minutes' => $srv['duration'],
                    'is_active' => true,
                ]
            );
        }

        // Products
        $products = [
            ['name' => 'Hair Serum', 'price' => 150000, 'desc' => 'Nourishing hair serum.'],
            ['name' => 'Facial Wash', 'price' => 85000, 'desc' => 'Gentle facial wash.'],
            ['name' => 'Body Lotion', 'price' => 120000, 'desc' => 'Moisturizing body lotion.'],
        ];

        foreach ($products as $prd) {
            Product::firstOrCreate(
                ['slug' => Str::slug($prd['name'])],
                [
                    'name' => $prd['name'],
                    'description' => $prd['desc'],
                    'price' => $prd['price'],
                    'is_active' => true,
                ]
            );
        }

        // Promotions
        Promotion::firstOrCreate(
            ['title' => 'Summer Beauty Package'],
            [
                'description' => 'Get 20% off on all hair treatments this summer.',
                'start_date' => Carbon::now()->subDays(5)->toDateString(),
                'end_date' => Carbon::now()->addDays(30)->toDateString(),
                'is_active' => true,
            ]
        );

        Promotion::firstOrCreate(
            ['title' => 'Weekend Glow Up'],
            [
                'description' => 'Special discount for facial treatments on weekends.',
                'start_date' => Carbon::now()->subDays(1)->toDateString(),
                'end_date' => Carbon::now()->addDays(14)->toDateString(),
                'is_active' => true,
            ]
        );

        // Galleries
        $galleries = [
            ['title' => 'Haircut Style 1', 'category' => 'hair', 'desc' => 'Modern haircut.', 'image' => 'haircut1.jpg'],
            ['title' => 'Facial Result', 'category' => 'facial', 'desc' => 'Glowing skin after facial.', 'image' => 'facial1.jpg'],
            ['title' => 'Hair Color Blonde', 'category' => 'coloring', 'desc' => 'Beautiful blonde coloring.', 'image' => 'color1.jpg'],
            ['title' => 'Nail Art', 'category' => 'other', 'desc' => 'Creative nail art.', 'image' => 'nails1.jpg'],
        ];

        foreach ($galleries as $gal) {
            Gallery::firstOrCreate(
                ['title' => $gal['title']],
                [
                    'category' => $gal['category'],
                    'description' => $gal['desc'],
                    'image' => $gal['image'],
                ]
            );
        }
    }
}
