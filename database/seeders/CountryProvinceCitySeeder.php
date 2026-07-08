<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\Province;
use App\Models\City;

class CountryProvinceCitySeeder extends Seeder
{
    public function run(): void
    {
        // Create Indonesia
        $country = Country::create(['name' => 'Indonesia']);

        $provinces = [
            'Aceh', 'Bali', 'Banten', 'Bengkulu', 'DI Yogyakarta',
            'DKI Jakarta', 'Gorontalo', 'Jambi', 'Jawa Barat', 'Jawa Tengah',
            'Jawa Timur', 'Kalimantan Barat', 'Kalimantan Selatan', 'Kalimantan Tengah',
            'Kalimantan Timur', 'Kalimantan Utara', 'Kepulauan Bangka Belitung',
            'Kepulauan Riau', 'Lampung', 'Maluku', 'Maluku Utara',
            'Nusa Tenggara Barat', 'Nusa Tenggara Timur', 'Papua', 'Papua Barat',
            'Riau', 'Sulawesi Barat', 'Sulawesi Selatan', 'Sulawesi Tengah',
            'Sulawesi Tenggara', 'Sulawesi Utara', 'Sumatera Barat',
            'Sumatera Selatan', 'Sumatera Utara',
        ];

        foreach ($provinces as $provName) {
            $province = Province::create(['country_id' => $country->id, 'name' => $provName]);

            // Create sample cities per province
            $cities = [
                'DKI Jakarta' => ['Jakarta Pusat', 'Jakarta Barat', 'Jakarta Timur', 'Jakarta Selatan', 'Jakarta Utara'],
                'Jawa Barat' => ['Bandung', 'Bogor', 'Depok', 'Bekasi', 'Cimahi'],
                'Jawa Tengah' => ['Semarang', 'Surakarta', 'Magelang', 'Pekalongan', 'Tegal'],
                'Jawa Timur' => ['Surabaya', 'Malang', 'Madiun', 'Kediri', 'Blitar'],
                'Bali' => ['Denpasar', 'Badung', 'Gianyar', 'Klungkung', 'Bangli'],
                'DI Yogyakarta' => ['Yogyakarta', 'Sleman', 'Bantul', 'Gunung Kidul', 'Kulon Progo'],
                'Banten' => ['Serang', 'Tangerang', 'Cilegon', 'Tangerang Selatan'],
                'Sumatera Utara' => ['Medan', 'Binjai', 'Pematangsiantar', 'Tebing Tinggi'],
                'Sumatera Selatan' => ['Palembang', 'Prabumulih', 'Lubuklinggau'],
                'Riau' => ['Pekanbaru', 'Dumai'],
                'Kalimantan Timur' => ['Samarinda', 'Balikpapan', 'Bontang'],
                'Sulawesi Selatan' => ['Makassar', 'Parepare', 'Palopo'],
            ];

            if (isset($cities[$provName])) {
                foreach ($cities[$provName] as $cityName) {
                    City::create(['province_id' => $province->id, 'name' => $cityName]);
                }
            }
        }
    }
}