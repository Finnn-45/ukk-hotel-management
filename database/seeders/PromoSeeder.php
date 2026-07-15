<?php

namespace Database\Seeders;

use App\Models\Promo;
use Illuminate\Database\Seeder;

class PromoSeeder extends Seeder
{
    public function run(): void
    {
        $promos = [
            [
                'title' => 'Diskon Pembukaan 10%',
                'code' => 'STAYEASE10',
                'discount_type' => 'percentage',
                'discount_value' => 10,
                'description' => 'Dapatkan diskon 10% untuk pemesanan kamar apa saja tanpa minimum pembayaran.',
                'image' => 'https://images.unsplash.com/photo-1540518614846-7eded433c457?w=600&q=80',
                'valid_from' => now()->subDay()->toDateString(),
                'valid_until' => now()->addMonths(6)->toDateString(),
                'is_active' => true,
            ],
            [
                'title' => 'Promo Pengguna Baru Rp 50.000',
                'code' => 'WELCOME50K',
                'discount_type' => 'fixed',
                'discount_value' => 50000,
                'description' => 'Potongan langsung Rp 50.000 khusus untuk Anda pengguna setia StayEase.',
                'image' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=600&q=80',
                'valid_from' => now()->subDay()->toDateString(),
                'valid_until' => now()->addMonths(3)->toDateString(),
                'is_active' => true,
            ],
        ];

        foreach ($promos as $promo) {
            Promo::updateOrCreate(['code' => $promo['code']], $promo);
        }
    }
}
