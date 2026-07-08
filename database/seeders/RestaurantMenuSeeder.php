<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RestaurantMenu;

class RestaurantMenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            ['name' => 'Nasi Goreng', 'description' => 'Nasi goreng spesial dengan telur', 'price' => 25000, 'category' => 'Main Course'],
            ['name' => 'Mie Goreng', 'description' => 'Mie goreng dengan sayuran', 'price' => 22000, 'category' => 'Main Course'],
            ['name' => 'Sate Ayam', 'description' => 'Sate ayam dengan bumbu kacang', 'price' => 30000, 'category' => 'Main Course'],
            ['name' => 'Gado-Gado', 'description' => 'Sayuran segar dengan bumbu kacang', 'price' => 20000, 'category' => 'Appetizer'],
            ['name' => 'Es Jeruk', 'description' => 'Es jeruk segar', 'price' => 8000, 'category' => 'Beverage'],
        ];

        foreach ($menus as $menu) {
            RestaurantMenu::create($menu);
        }
    }
}