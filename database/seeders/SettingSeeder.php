<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::firstOrCreate(
            ['id' => 1],
            [
                'salon_name' => 'Eeva Hair & Beauty Salon',
                'address' => 'Jl. Contoh Alamat No. 123, Kota, Provinsi',
                'phone' => '081234567890',
                'email' => 'info@eeva.com',
                'instagram' => '@eevasalon',
                'facebook' => 'Eeva Salon',
                'tiktok' => '@eevasalon',
                'google_maps' => 'https://maps.google.com/?q=salon',
                'opening_hour' => '09:00:00',
                'closing_hour' => '19:00:00',
            ]
        );
    }
}
