<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LandingPageSection;
use App\Models\LandingPageService;
use App\Models\LandingPageGallery;
use App\Models\LandingPageTestimonial;

class LandingPageSeeder extends Seeder
{
    public function run(): void
    {
        // Sections
        $sections = [
            [
                'section_key' => 'hero',
                'title' => 'Selamat Datang di Hotel Kami',
                'subtitle' => 'Pengalaman menginap yang tak terlupakan dengan fasilitas modern dan pelayanan terbaik',
                'content' => null,
                'image' => 'images/landing/hero-bg.jpg',
                'metadata' => json_encode([
                    'button_text' => 'Lihat Kamar',
                    'button_link' => '/kamar',
                    'background_video' => null,
                ]),
                'order' => 1,
                'is_active' => true,
            ],
            [
                'section_key' => 'about',
                'title' => 'Tentang Hotel Kami',
                'subtitle' => 'Lebih dari 20 tahun pengalaman dalam industri perhotelan',
                'content' => 'Hotel kami menawarkan pengalaman menginap yang nyaman dan mewah dengan pelayanan profesional. Kami berlokasi strategies di pusat kota dengan akses mudah ke tempat wisata dan bisnis.',
                'image' => 'images/landing/about.jpg',
                'metadata' => json_encode([
                    'features' => ['Lokasi Strategis', '24/7 Room Service', 'Free WiFi', 'Fitness Center'],
                ]),
                'order' => 2,
                'is_active' => true,
            ],
        ];
        foreach ($sections as $section) {
            LandingPageSection::updateOrCreate(['section_key' => $section['section_key']], $section);
        }

        // Services
        $services = [
            [
                'title' => 'Kamar Mewah',
                'description' => 'Pilihan kamar berbagai tipe dengan fasilitas lengkap dan desain modern',
                'icon' => 'fa-bed',
                'image' => 'images/landing/services/room.jpg',
                'link' => '/kamar',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Restoran',
                'description' => 'Nikmati masakan lokal dan internasional di restoran kami',
                'icon' => 'fa-utensils',
                'image' => 'images/landing/services/restaurant.jpg',
                'link' => '/restaurant',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Meeting & Event',
                'description' => 'Fasilitas meeting room dan ballroom untuk acara Anda',
                'icon' => 'fa-briefcase',
                'image' => 'images/landing/services/meeting.jpg',
                'link' => '/meeting',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Spa & Wellness',
                'description' => 'Relaksasi total dengan treatment spa profesional',
                'icon' => 'fa-spa',
                'image' => 'images/landing/services/spa.jpg',
                'link' => '/spa',
                'order' => 4,
                'is_active' => true,
            ],
        ];
        foreach ($services as $service) {
            LandingPageService::updateOrCreate(['title' => $service['title']], $service);
        }

        // Galleries
        $galleries = [
            ['title' => 'Kamar Deluxe', 'image' => 'images/landing/gallery/deluxe-room.jpg', 'category' => 'room', 'order' => 1],
            ['title' => 'Kamar Suite', 'image' => 'images/landing/gallery/suite-room.jpg', 'category' => 'room', 'order' => 2],
            ['title' => 'Restoran', 'image' => 'images/landing/gallery/restaurant.jpg', 'category' => 'restaurant', 'order' => 3],
            ['title' => 'Swimming Pool', 'image' => 'images/landing/gallery/pool.jpg', 'category' => 'facility', 'order' => 4],
            ['title' => 'Lobby', 'image' => 'images/landing/gallery/lobby.jpg', 'category' => 'facility', 'order' => 5],
            ['title' => 'Gym', 'image' => 'images/landing/gallery/gym.jpg', 'category' => 'facility', 'order' => 6],
        ];
        foreach ($galleries as $gallery) {
            LandingPageGallery::updateOrCreate(['title' => $gallery['title']], $gallery);
        }

        // Testimonials
        $testimonials = [
            [
                'name' => 'Budi Santoso',
                'position' => 'Manager, PT. ABC',
                'message' => 'Pelayanan sangat memuaskan! Kamar bersih dan nyaman, staff sangat ramah. Recommended!',
                'avatar' => 'images/landing/testimonials/avatar1.jpg',
                'rating' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Siti Nurhaliza',
                'position' => 'Travel Blogger',
                'message' => 'Fasilitas hotel sangat lengkap. Lokasi strategis, mudah akses ke tempat wisata.',
                'avatar' => 'images/landing/testimonials/avatar2.jpg',
                'rating' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'John Doe',
                'position' => 'Business Traveler',
                'message' => 'Perfect untuk business trip. WiFi kencang dan meeting room nyaman.',
                'avatar' => 'images/landing/testimonials/avatar3.jpg',
                'rating' => 4,
                'is_active' => true,
            ],
        ];
        foreach ($testimonials as $testimonial) {
            LandingPageTestimonial::updateOrCreate(['name' => $testimonial['name']], $testimonial);
        }
    }
}