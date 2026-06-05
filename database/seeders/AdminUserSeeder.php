<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@eeva.com'],
            [
                'name' => 'Admin Eeva',
                'password' => Hash::make('password'),
                'phone' => '081234567890',
            ]
        );

        $admin->assignRole('admin');
    }
}
