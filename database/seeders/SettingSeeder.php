<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::firstOrCreate(
            ['salon_name' => 'Eeva Hair & Beauty Salon'],
            [
                'address' => '123 Beauty Street, Fashion City',
                'phone' => '081234567890',
                'email' => 'contact@eeva.com',
                'instagram' => '@eevasalon',
                'facebook' => 'Eeva Salon',
                'tiktok' => '@eevasalon_official',
                'opening_hour' => '09:00',
                'closing_hour' => '21:00',
            ]
        );
    }
}
