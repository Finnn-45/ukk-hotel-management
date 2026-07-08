<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class HotelSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General Settings
            ['key' => 'hotel_name', 'value' => 'Grand Merdeka Hotel', 'group' => 'general'],
            ['key' => 'hotel_tagline', 'value' => 'Kenangan Manis di Setiap Kunjungan', 'group' => 'general'],
            ['key' => 'hotel_description', 'value' => 'Grand Merdeka Hotel adalah hotel bintang 4 yang terletak di pusat kota dengan akses mudah ke bandara, stasiun kereta, dan tempat wisata. Kami menyediakan pengalaman menginap yang nyaman dengan pelayanan profesional, fasilitas modern, dan harga terjangkau.', 'group' => 'general'],
            ['key' => 'hotel_address', 'value' => 'Jl. Merdeka No. 123, Jakarta Pusat, 10110', 'group' => 'general'],
            
            // Contact Settings
            ['key' => 'hotel_phone', 'value' => '(021) 123-4567', 'group' => 'contact'],
            ['key' => 'hotel_email', 'value' => 'info@grandmerdeka.com', 'group' => 'contact'],
            ['key' => 'hotel_whatsapp', 'value' => '6281234567890', 'group' => 'contact'],
            
            // Social Media
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/grandmerdeka', 'group' => 'social'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/grandmerdeka', 'group' => 'social'],
            ['key' => 'social_twitter', 'value' => 'https://twitter.com/grandmerdeka', 'group' => 'social'],
            
            // Business Settings
            ['key' => 'check_in_time', 'value' => '14:00', 'group' => 'business'],
            ['key' => 'check_out_time', 'value' => '12:00', 'group' => 'business'],
            ['key' => 'tax_percentage', 'value' => '10', 'group' => 'business'],
            ['key' => 'currency', 'value' => 'IDR', 'group' => 'business'],
            
            // Location Settings
            ['key' => 'hotel_latitude', 'value' => '-6.2088', 'group' => 'location'],
            ['key' => 'hotel_longitude', 'value' => '106.8456', 'group' => 'location'],
            ['key' => 'google_maps_api_key', 'value' => 'YOUR_GOOGLE_MAPS_API_KEY', 'group' => 'location'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}