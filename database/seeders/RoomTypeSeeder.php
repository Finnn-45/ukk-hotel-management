<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoomType;

class RoomTypeSeeder extends Seeder
{
    public function run(): void
    {
        $roomTypes = [
            ['name' => 'Standard Room', 'description' => 'Kamar standard dengan fasilitas dasar', 'price' => 500000, 'max_guests' => 2],
            ['name' => 'Deluxe Room', 'description' => 'Kamar deluxe dengan view yang bagus', 'price' => 800000, 'max_guests' => 2],
            ['name' => 'Suite Room', 'description' => 'Kamar suite dengan ruang tamu', 'price' => 1500000, 'max_guests' => 4],
            ['name' => 'Family Room', 'description' => 'Kamar keluarga dengan 2 kamar tidur', 'price' => 1200000, 'max_guests' => 6],
        ];

        foreach ($roomTypes as $type) {
            RoomType::create($type);
        }
    }
}