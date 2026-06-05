<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 5 Services
        Service::insert([
            ['name' => 'Haircut', 'slug' => 'haircut', 'description' => 'Stylish haircut.', 'price' => 150000, 'duration_minutes' => 45, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Hair Coloring', 'slug' => 'hair-coloring', 'description' => 'Full hair coloring.', 'price' => 500000, 'duration_minutes' => 120, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Basic Facial', 'slug' => 'basic-facial', 'description' => 'Refreshing basic facial.', 'price' => 200000, 'duration_minutes' => 60, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Creambath', 'slug' => 'creambath', 'description' => 'Nourishing creambath.', 'price' => 120000, 'duration_minutes' => 60, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Manicure & Pedicure', 'slug' => 'mani-pedi', 'description' => 'Complete nail care.', 'price' => 180000, 'duration_minutes' => 90, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 3 Products
        Product::insert([
            ['name' => 'Shampoo Anti Dandruff', 'slug' => 'shampoo-anti-dandruff', 'description' => 'Shampoo for daily use.', 'price' => 85000, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Hair Serum', 'slug' => 'hair-serum', 'description' => 'Serum to protect hair.', 'price' => 120000, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Face Toner', 'slug' => 'face-toner', 'description' => 'Refreshing face toner.', 'price' => 95000, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 2 Promotions
        Promotion::insert([
            ['title' => 'Opening Promo', 'description' => 'Discount 20% for all services.', 'start_date' => Carbon::today(), 'end_date' => Carbon::today()->addDays(30), 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Weekend Special', 'description' => 'Free creambath for coloring.', 'start_date' => Carbon::today()->addDays(5), 'end_date' => Carbon::today()->addDays(7), 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 4 Galleries
        Gallery::insert([
            ['title' => 'Bob Haircut', 'description' => 'Modern bob haircut style.', 'category' => 'hair', 'image' => 'bob.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Balayage Coloring', 'description' => 'Brown balayage.', 'category' => 'coloring', 'image' => 'balayage.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Acne Facial', 'description' => 'Facial treatment for acne.', 'category' => 'facial', 'image' => 'facial.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Nail Art', 'description' => 'Cute nail art design.', 'category' => 'other', 'image' => 'nailart.jpg', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
