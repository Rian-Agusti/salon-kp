<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;

class MembershipTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Ensure roles exist
        Role::firstOrCreate(['name' => 'customer', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        // Setting required for success page
        Setting::firstOrCreate([
            'salon_name' => 'Eeva Salon',
            'phone' => '08123456789',
        ]);
    }

    public function test_new_customer_becomes_member_when_total_price_above_100k(): void
    {
        $user = User::factory()->create();
        $user->assignRole('customer');

        $service1 = Service::create([
            'name' => 'Test Service 1',
            'slug' => 'test-service-1',
            'price' => 60000,
            'duration_minutes' => 60,
            'is_active' => true,
        ]);
        $service2 = Service::create([
            'name' => 'Test Service 2',
            'slug' => 'test-service-2',
            'price' => 50000,
            'duration_minutes' => 60,
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->post(route('customer.reservations.store'), [
            'booking_date' => now()->addDay()->format('Y-m-d'),
            'booking_time' => '10:00',
            'services' => [$service1->id, $service2->id],
        ]);

        $response->assertSessionHasNoErrors();

        $user->refresh();

        // Total price = 110,000 >= 100,000
        $this->assertNotNull($user->member_until);
        $this->assertEquals(now()->addYear()->format('Y-m-d'), $user->member_until->format('Y-m-d'));

        // Should get 5% discount since they became a member in this transaction
        $reservation = $user->reservations()->latest()->first();
        $expectedDiscount = (60000 + 50000) * 0.05;
        $this->assertEquals($expectedDiscount, $reservation->discount_amount);
    }

    public function test_new_customer_does_not_become_member_when_total_price_below_100k(): void
    {
        $user = User::factory()->create();
        $user->assignRole('customer');

        $service1 = Service::create([
            'name' => 'Test Service 1',
            'slug' => 'test-service-1',
            'price' => 90000,
            'duration_minutes' => 60,
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->post(route('customer.reservations.store'), [
            'booking_date' => now()->addDay()->format('Y-m-d'),
            'booking_time' => '10:00',
            'services' => [$service1->id],
        ]);

        $response->assertSessionHasNoErrors();

        $user->refresh();

        $this->assertNull($user->member_until);

        $reservation = $user->reservations()->latest()->first();
        $this->assertEquals(0, $reservation->discount_amount);
    }

    public function test_active_member_gets_birthday_discount(): void
    {
        $user = User::factory()->create([
            'member_until' => now()->addMonths(6),
            'birth_date' => now()->subYears(25)->format('Y-m-d'), // Today is birthday
        ]);
        $user->assignRole('customer');

        $service1 = Service::create([
            'name' => 'Test Service 1',
            'slug' => 'test-service-1',
            'price' => 120000,
            'duration_minutes' => 60,
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->post(route('customer.reservations.store'), [
            'booking_date' => now()->addDay()->format('Y-m-d'),
            'booking_time' => '10:00',
            'services' => [$service1->id],
        ]);

        $response->assertSessionHasNoErrors();

        // 50% discount
        $reservation = $user->reservations()->latest()->first();
        $this->assertEquals(120000 * 0.5, $reservation->discount_amount);
    }

    public function test_admin_can_update_customer_membership(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $customer = User::factory()->create();
        $customer->assignRole('customer');

        $memberUntil = now()->addYear()->format('Y-m-d');
        $birthDate = now()->subYears(20)->format('Y-m-d');

        $response = $this->actingAs($admin)->put(route('admin.customers.update', $customer), [
            'name' => 'Updated Name',
            'phone' => '08123456789',
            'member_until' => $memberUntil,
            'birth_date' => $birthDate,
            'type' => 'online',
        ]);

        $response->assertSessionHasNoErrors();

        $customer->refresh();

        $this->assertEquals($memberUntil, $customer->member_until->format('Y-m-d'));
        $this->assertEquals($birthDate, $customer->birth_date->format('Y-m-d'));
    }
}
