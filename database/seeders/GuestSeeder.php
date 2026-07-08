<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guest;
use App\Models\User;

class GuestSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'customer@example.com')->first();
        
        Guest::create([
            'user_id' => $user->id,
            'full_name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '081234567890',
            'id_card' => '123456789',
            'address' => 'Jl. Sudirman No. 1, Jakarta',
        ]);
    }
}