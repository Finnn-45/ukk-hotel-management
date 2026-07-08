<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            UserSeeder::class,
            GuestSeeder::class,
            RoomTypeSeeder::class,
            RoomSeeder::class,
            RestaurantMenuSeeder::class,
            LandingPageSeeder::class,
            SettingSeeder::class,
        ]);
    }
}