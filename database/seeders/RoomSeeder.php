<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\RoomType;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $roomTypes = RoomType::all();

        foreach ($roomTypes as $type) {
            for ($i = 1; $i <= 5; $i++) {
                Room::create([
                    'room_type_id' => $type->id,
                    'room_number' => strtoupper($type->name[0]) . '-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                    'floor' => ceil($i / 2),
                    'status' => 'available',
                ]);
            }
        }
    }
}