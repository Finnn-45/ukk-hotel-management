<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            ['key' => 'hotel_name', 'value' => 'Hotel Reservation', 'group' => 'general'],
            ['key' => 'hotel_tagline', 'value' => 'Your Comfort, Our Priority', 'group' => 'general'],
            ['key' => 'hotel_description', 'value' => 'Hotel bintang 5 dengan pelayanan terbaik', 'group' => 'general'],
            
            // Contact
            ['key' => 'hotel_address', 'value' => 'Jl. Contoh No. 123, Jakarta', 'group' => 'contact'],
            ['key' => 'hotel_phone', 'value' => '(021) 1234-5678', 'group' => 'contact'],
            ['key' => 'hotel_email', 'value' => 'info@hotelreservation.com', 'group' => 'contact'],
            ['key' => 'hotel_whatsapp', 'value' => '6281234567890', 'group' => 'contact'],
            
            // Social Media
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/hotel', 'group' => 'social'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/hotel', 'group' => 'social'],
            ['key' => 'social_twitter', 'value' => 'https://twitter.com/hotel', 'group' => 'social'],
            
            // Business
            ['key' => 'check_in_time', 'value' => '14:00', 'group' => 'business'],
            ['key' => 'check_out_time', 'value' => '12:00', 'group' => 'business'],
            ['key' => 'tax_percentage', 'value' => '10', 'group' => 'business'],
            ['key' => 'currency', 'value' => 'IDR', 'group' => 'business'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}