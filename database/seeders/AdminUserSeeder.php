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

    //     $customer1 = User::firstOrCreate(
    //         ['email' => 'customer1@eeva.com'],
    //         [
    //             'name' => 'Member Aktif Ultah',
    //             'password' => Hash::make('password'),
    //             'phone' => '081234567891',
    //             'member_until' => now()->addYear(),
    //             'birth_date' => now()->subYears(20), // Today is birthday
    //         ]
    //     );
    // //     $customer1->assignRole('customer');

    // //     $customer2 = User::firstOrCreate(
    // //         ['email' => 'customer2@eeva.com'],
    // //         [
    // //             'name' => 'Member Aktif Biasa',
    // //             'password' => Hash::make('password'),
    // //             'phone' => '081234567892',
    // //             'member_until' => now()->addMonths(6),
    // //             'birth_date' => now()->subYears(25)->subMonths(3), // Not birthday
    // //         ]
    //     );
    //     $customer2->assignRole('customer');

    //     $customer3 = User::firstOrCreate(
    //         ['email' => 'customer3@eeva.com'],
    //         [
    //             'name' => 'Bukan Member',
    //             'password' => Hash::make('password'),
    //             'phone' => '081234567893',
    //         ]
    //     );
    //     $customer3->assignRole('customer');
    // }
}
}
