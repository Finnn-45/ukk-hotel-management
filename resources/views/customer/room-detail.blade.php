@extends('customer.layouts.app')

@section('title', 'Detail Kamar - ' . $room->room_number)

@push('styles')
<style>
    :root {
        --se-primary: #0284C7;
        --se-primary-dark: #0369A1;
        --se-primary-light: #E0F2FE;
        --se-accent: #38BDF8;
        --se-success: #22C55E;
        --se-warning: #F59E0B;
        --se-danger: #EF4444;
        --se-bg: #F1F5F9;
        --se-card: #FFFFFF;
        --se-text: #334155;
        --se-text-muted: #64748B;
        --se-border: #E2E8F0;
        --se-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 4px 20px rgba(0,0,0,0.06);
        --se-shadow-hover: 0 12px 40px rgba(0,0,0,0.1);
        --se-radius: 20px;
        --se-radius-sm: 12px;
        --se-radius-xs: 8px;
    }

    /* Room Gallery */
    .se-room-gallery {
        border-radius: var(--se-radius);
        overflow: hidden;
        background: var(--se-card);
        border: 1px solid var(--se-border);
        box-shadow: var(--se-shadow);
    }
    .se-main-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .se-thumbnail-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 8px;
        padding: 12px;
        background: var(--se-bg);
    }
    .se-thumbnail {
        width: 100%;
        height: 70px;
        object-fit: cover;
        border-radius: var(--se-radius-xs);
        cursor: pointer;
        transition: all 0.2s;
        border: 2px solid transparent;
    }
    .se-thumbnail:hover {
        transform: scale(1.05);
        border-color: var(--se-primary);
    }

    /* Room Info Card */
    .se-room-info-card {
        border-radius: var(--se-radius);
        background: var(--se-card);
        border: 1px solid var(--se-border);
        box-shadow: var(--se-shadow);
    }
    .se-room-info-card .card-body {
        padding: 28px;
    }

    /* Section Headers */
    .se-section-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }
    .se-section-icon {
        width: 40px;
        height: 40px;
        border-radius: var(--se-radius-xs);
        background: var(--se-primary-light);
        color: var(--se-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }
    .se-section-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--se-text);
        margin: 0;
    }

    /* Info Grid */
    .se-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 12px;
    }
    .se-info-item {
        background: var(--se-bg);
        border-radius: var(--se-radius-sm);
        padding: 16px;
        text-align: center;
        transition: all 0.2s;
    }
    .se-info-item:hover {
        transform: translateY(-2px);
        box-shadow: var(--se-shadow);
    }
    .se-info-item i {
        color: var(--se-primary);
        font-size: 1.5rem;
        display: block;
        margin-bottom: 8px;
    }
    .se-info-item small {
        color: var(--se-text-muted);
        font-size: 0.75rem;
        display: block;
        margin-bottom: 4px;
    }
    .se-info-item span {
        font-weight: 700;
        color: var(--se-text);
        font-size: 0.9rem;
    }

    /* Facilities Grid */
    .se-facilities-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        gap: 10px;
    }
    .se-facility-card {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px;
        background: var(--se-card);
        border: 1px solid var(--se-border);
        border-radius: var(--se-radius-sm);
        transition: all 0.2s;
    }
    .se-facility-card:hover {
        border-color: var(--se-primary);
        transform: translateY(-2px);
        box-shadow: var(--se-shadow);
    }
    .se-facility-card i {
        color: var(--se-primary);
        font-size: 1.25rem;
        flex-shrink: 0;
    }
    .se-facility-card span {
        font-size: 0.85rem;
        color: var(--se-text);
        font-weight: 500;
    }

    /* About Room */
    .se-about-card {
        background: var(--se-card);
        border: 1px solid var(--se-border);
        border-radius: var(--se-radius);
        padding: 24px;
        box-shadow: var(--se-shadow);
    }
    .se-about-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid var(--se-border);
    }
    .se-about-item:last-child {
        border-bottom: none;
    }
    .se-about-item i {
        color: var(--se-primary);
        margin-top: 4px;
        flex-shrink: 0;
    }
    .se-about-content strong {
        display: block;
        color: var(--se-text);
        margin-bottom: 2px;
        font-size: 0.9rem;
    }
    .se-about-content span {
        color: var(--se-text-muted);
        font-size: 0.85rem;
    }

    /* Policy List */
    .se-policy-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 14px 0;
        border-bottom: 1px solid var(--se-border);
    }
    .se-policy-item:last-child {
        border-bottom: none;
    }
    .se-policy-item i {
        color: var(--se-success);
        font-size: 1.25rem;
        margin-top: 2px;
        flex-shrink: 0;
    }
    .se-policy-content strong {
        display: block;
        color: var(--se-text);
        margin-bottom: 2px;
        font-size: 0.9rem;
    }
    .se-policy-content span {
        color: var(--se-text-muted);
        font-size: 0.85rem;
    }

    /* Location */
    .se-map-container {
        border-radius: var(--se-radius-sm);
        overflow: hidden;
        margin-bottom: 16px;
        border: 1px solid var(--se-border);
    }
    .se-map-container iframe {
        width: 100%;
        height: 350px;
        border: none;
    }
    .se-distance-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
        border-radius: var(--se-radius-xs);
        background: var(--se-bg);
        margin-bottom: 8px;
    }
    .se-distance-item i {
        color: var(--se-primary);
        font-size: 1rem;
    }
    .se-distance-item span {
        font-size: 0.85rem;
        color: var(--se-text);
    }

    /* Reviews */
    .se-review-item {
        padding: 16px;
        border-bottom: 1px solid var(--se-border);
    }
    .se-review-item:last-child {
        border-bottom: none;
    }
    .se-review-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }
    .se-review-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--se-primary-gradient);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.85rem;
        flex-shrink: 0;
    }
    .se-review-info strong {
        display: block;
        color: var(--se-text);
        font-size: 0.9rem;
        margin-bottom: 2px;
    }
    .se-review-info small {
        color: var(--se-text-muted);
        font-size: 0.75rem;
    }
    .se-review-rating {
        color: var(--se-warning);
        font-size: 0.85rem;
        margin-left: auto;
    }
    .se-review-text {
        color: var(--se-text-muted);
        font-size: 0.9rem;
        line-height: 1.6;
        margin: 0;
        padding-left: 52px;
    }

    /* FAQ Accordion */
    .se-accordion-item {
        border: 1px solid var(--se-border);
        border-radius: var(--se-radius-sm) !important;
        margin-bottom: 10px;
        overflow: hidden;
        box-shadow: var(--se-shadow);
    }
    .se-accordion-button {
        background: var(--se-card);
        color: var(--se-text);
        font-weight: 600;
        font-size: 0.95rem;
        padding: 16px 20px;
    }
    .se-accordion-button:not(.collapsed) {
        background: var(--se-primary-light);
        color: var(--se-primary);
    }
    .se-accordion-button:focus {
        box-shadow: 0 0 0 3px rgba(2,132,199,0.1);
    }
    .se-accordion-body {
        padding: 16px 20px;
        color: var(--se-text-muted);
        font-size: 0.9rem;
        line-height: 1.6;
    }

    /* Restaurant Card */
    .se-restaurant-card {
        background: var(--se-card);
        border: 1px solid var(--se-border);
        border-radius: var(--se-radius);
        padding: 24px;
        box-shadow: var(--se-shadow);
    }
    .se-restaurant-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: var(--se-radius-sm);
        margin-bottom: 16px;
    }
    .se-menu-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px;
        background: var(--se-bg);
        border-radius: var(--se-radius-xs);
        margin-bottom: 8px;
    }
    .se-menu-item strong {
        color: var(--se-text);
        font-size: 0.9rem;
    }
    .se-menu-item span {
        color: var(--se-primary);
        font-weight: 700;
        font-size: 0.85rem;
    }

    /* Gallery Grid */
    .se-gallery-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }
    .se-gallery-item {
        position: relative;
        border-radius: var(--se-radius-sm);
        overflow: hidden;
        cursor: pointer;
        aspect-ratio: 4/3;
    }
    .se-gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }
    .se-gallery-item:hover img {
        transform: scale(1.1);
    }
    .se-gallery-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
    }
    .se-gallery-item:hover .se-gallery-overlay {
        background: rgba(0,0,0,0.4);
    }
    .se-gallery-overlay i {
        color: #fff;
        font-size: 2rem;
        opacity: 0;
        transform: scale(0.8);
        transition: all 0.3s;
    }
    .se-gallery-item:hover .se-gallery-overlay i {
        opacity: 1;
        transform: scale(1);
    }

    /* Sticky Navigation */
    .se-sticky-nav {
        position: sticky;
        top: var(--se-nav-height, 68px);
        background: var(--se-card);
        border: 1px solid var(--se-border);
        border-radius: var(--se-radius-sm);
        padding: 12px 20px;
        margin-bottom: 24px;
        box-shadow: var(--se-shadow);
        z-index: 100;
        display: flex;
        gap: 24px;
        overflow-x: auto;
    }
    .se-sticky-nav a {
        color: var(--se-text-muted);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        white-space: nowrap;
        transition: color 0.2s;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .se-sticky-nav a:hover,
    .se-sticky-nav a.active {
        color: var(--se-primary);
    }

    /* Booking Sidebar */
    .se-booking-sidebar {
        border-radius: var(--se-radius);
        background: var(--se-card);
        border: 1px solid var(--se-border);
        box-shadow: var(--se-shadow);
    }
    .se-booking-sidebar .card-body {
        padding: 24px;
    }
    .se-benefit-item {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 0;
        font-size: 0.85rem;
        color: var(--se-text-muted);
    }
    .se-benefit-item i {
        color: var(--se-success);
        font-size: 1rem;
    }

    /* Similar Rooms */
    .se-similar-room-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px;
        border-radius: var(--se-radius-xs);
        border: 1px solid var(--se-border);
        background: var(--se-card);
        transition: all 0.2s;
        text-decoration: none;
    }
    .se-similar-room-item:hover {
        border-color: var(--se-primary);
        background: var(--se-primary-light);
    }
    .se-similar-room-item img {
        width: 60px;
        height: 45px;
        border-radius: 8px;
        object-fit: cover;
        flex-shrink: 0;
    }
    .se-similar-room-item .room-info small {
        color: var(--se-text-muted);
        font-size: 0.75rem;
    }
    .se-similar-room-item .room-info strong {
        color: var(--se-text);
        font-size: 0.85rem;
    }
    .se-similar-room-item .room-price {
        color: var(--se-primary);
        font-weight: 700;
        font-size: 0.8rem;
    }

    /* Price Breakdown */
    .se-price-breakdown {
        background: var(--se-bg);
        border-radius: var(--se-radius-sm);
        padding: 16px;
    }

    /* Star Rating */
    .star-rating {
        color: var(--se-accent);
        font-size: 0.85rem;
    }

    /* Responsive */
    @media (max-width: 991.98px) {
        .se-main-image {
            height: 280px;
        }
        .se-thumbnail-grid {
            grid-template-columns: repeat(5, 1fr);
        }
    }
    @media (max-width: 768px) {
        .se-main-image {
            height: 220px;
        }
        .se-thumbnail-grid {
            grid-template-columns: repeat(4, 1fr);
        }
        .se-facilities-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .se-gallery-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .se-sticky-nav {
            gap: 16px;
            padding: 10px 16px;
        }
        .se-sticky-nav a {
            font-size: 0.85rem;
        }
    }
</style>
@endpush

@section('content')
<div class="container py-3 py-md-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="se-breadcrumb mb-3 mb-md-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house"></i> Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('rooms.index') }}">Kamar</a></li>
            <li class="breadcrumb-item active fw-semibold">{{ $room->room_number }}</li>
        </ol>
    </nav>

    <!-- Sticky Navigation -->
    <div class="se-sticky-nav">
        <a href="#deskripsi" class="active"><i class="bi bi-file-text"></i> Deskripsi</a>
        <a href="#fasilitas"><i class="bi bi-grid"></i> Fasilitas</a>
        <a href="#lokasi"><i class="bi bi-geo-alt"></i> Lokasi</a>
        <a href="#review"><i class="bi bi-star"></i> Review</a>
        <a href="#faq"><i class="bi bi-question-circle"></i> FAQ</a>
    </div>

    <div class="row g-3 g-lg-4">
        {{-- ===== LEFT COLUMN: Room Gallery & Info ===== --}}
        <div class="col-lg-8">
            {{-- Hero Image Gallery --}}
            <div class="se-room-gallery mb-3 mb-lg-4">
                <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?w=800"
                     class="se-main-image"
                     alt="Room {{ $room->room_number }}"
                     id="mainImage">
                <div class="se-thumbnail-grid">
                    @foreach([
                        'https://images.unsplash.com/photo-1611892440504-42a792e24d32?w=200',
                        'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=200',
                        'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=200',
                        'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=200',
                        'https://images.unsplash.com/photo-1554995207-c18c203602cb?w=200',
                    ] as $index => $img)
                    <img src="{{ $img }}" 
                         class="se-thumbnail" 
                         alt="Thumbnail {{ $index + 1 }}"
                         onclick="document.getElementById('mainImage').src='{{ $img }}'.replace('w=200', 'w=800')">
                    @endforeach
                </div>
            </div>

            {{-- Tentang Kamar --}}
            <div class="se-about-card mb-3 mb-lg-4" id="deskripsi">
                <div class="se-section-header">
                    <div class="se-section-icon">
                        <i class="bi bi-info-circle"></i>
                    </div>
                    <h3 class="se-section-title">Tentang Kamar</h3>
                </div>
                <div class="se-about-item">
                    <i class="bi bi-rulers"></i>
                    <div class="se-about-content">
                        <strong>Ukuran Kamar</strong>
                        <span>25 m² dengan layout modern dan fungsional</span>
                    </div>
                </div>
                <div class="se-about-item">
                    <i class="bi bi-bed"></i>
                    <div class="se-about-content">
                        <strong>Jenis Kasur</strong>
                        <span>1x King Bed (180x200cm) dengan matras premium</span>
                    </div>
                </div>
                <div class="se-about-item">
                    <i class="bi bi-eye"></i>
                    <div class="se-about-content">
                        <strong>Pemandangan</strong>
                        <span>Pemandangan kota dan taman</span>
                    </div>
                </div>
                <div class="se-about-item">
                    <i class="bi bi-thermometer-half"></i>
                    <div class="se-about-content">
                        <strong>Kenyamanan</strong>
                        <span>AC, heater, dan soundproofing system</span>
                    </div>
                </div>
                <div class="se-about-item">
                    <i class="bi bi-lightning"></i>
                    <div class="se-about-content">
                        <strong>Fasilitas Utama</strong>
                        <span>WiFi 100Mbps, TV 55" Smart TV, minibar, safe deposit box</span>
                    </div>
                </div>
            </div>

            {{-- Fasilitas Hotel --}}
            <div class="se-room-info-card mb-3 mb-lg-4" id="fasilitas">
                <div class="card-body">
                    <div class="se-section-header">
                        <div class="se-section-icon">
                            <i class="bi bi-building"></i>
                        </div>
                        <h3 class="se-section-title">Fasilitas Hotel</h3>
                    </div>
                    <div class="se-facilities-grid">
                        <div class="se-facility-card">
                            <i class="bi bi-water"></i>
                            <span>Kolam Renang</span>
                        </div>
                        <div class="se-facility-card">
                            <i class="bi bi-cup-hot"></i>
                            <span>Restoran</span>
                        </div>
                        <div class="se-facility-card">
                            <i class="bi bi-heart-pulse"></i>
                            <span>Gym</span>
                        </div>
                        <div class="se-facility-card">
                            <i class="bi bi-wifi"></i>
                            <span>WiFi Gratis</span>
                        </div>
                        <div class="se-facility-card">
                            <i class="bi bi-p-square"></i>
                            <span>Parkir Gratis</span>
                        </div>
                        <div class="se-facility-card">
                            <i class="bi bi-bell"></i>
                            <span>Room Service</span>
                        </div>
                        <div class="se-facility-card">
                            <i class="bi bi-basket"></i>
                            <span>Laundry</span>
                        </div>
                        <div class="se-facility-card">
                            <i class="bi bi-arrow-up-circle"></i>
                            <span>Lift</span>
                        </div>
                        <div class="se-facility-card">
                            <i class="bi bi-shield-check"></i>
                            <span>Keamanan 24 Jam</span>
                        </div>
                        <div class="se-facility-card">
                            <i class="bi bi-people"></i>
                            <span>Meeting Room</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kebijakan Hotel --}}
            <div class="se-room-info-card mb-3 mb-lg-4">
                <div class="card-body">
                    <div class="se-section-header">
                        <div class="se-section-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h3 class="se-section-title">Kebijakan Hotel</h3>
                    </div>
                    <div class="se-policy-item">
                        <i class="bi bi-check-circle-fill"></i>
                        <div class="se-policy-content">
                            <strong>Check-in</strong>
                            <span>14.00 WIB</span>
                        </div>
                    </div>
                    <div class="se-policy-item">
                        <i class="bi bi-check-circle-fill"></i>
                        <div class="se-policy-content">
                            <strong>Check-out</strong>
                            <span>12.00 WIB</span>
                        </div>
                    </div>
                    <div class="se-policy-item">
                        <i class="bi bi-x-circle-fill" style="color: var(--se-danger);"></i>
                        <div class="se-policy-content">
                            <strong>Tidak Boleh Merokok</strong>
                            <span>Kamar adalah area bebas rokok</span>
                        </div>
                    </div>
                    <div class="se-policy-item">
                        <i class="bi bi-x-circle-fill" style="color: var(--se-danger);"></i>
                        <div class="se-policy-content">
                            <strong>Hewan Peliharaan</strong>
                            <span>Tidak diperbolehkan</span>
                        </div>
                    </div>
                    <div class="se-policy-item">
                        <i class="bi bi-check-circle-fill"></i>
                        <div class="se-policy-content">
                            <strong>Pembatalan</strong>
                            <span>Gratis pembatalan sebelum 24 jam</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Lokasi Hotel --}}
            <div class="se-room-info-card mb-3 mb-lg-4" id="lokasi">
                <div class="card-body">
                    <div class="se-section-header">
                        <div class="se-section-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <h3 class="se-section-title">Lokasi Hotel</h3>
                    </div>
                    <div class="se-map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126928.89647852757!2d106.689234!3d-6.208763!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fd7aa70b1!2sJakarta%20Pusat%2C%20Jakarta!5e0!3m2!1sen!2sid!4v1234567890"
                                allowfullscreen=""
                                loading="lazy">
                        </iframe>
                    </div>
                    <div class="se-about-item">
                        <i class="bi bi-geo-alt"></i>
                        <div class="se-about-content">
                            <strong>Alamat</strong>
                            <span>Jl. Merdeka No. 123, Jakarta Pusat, Indonesia</span>
                        </div>
                    </div>
                    <div class="se-distance-item">
                        <i class="bi bi-airplane"></i>
                        <span>Bandara Internasional Soekarno-Hatta - 35 km (45 menit)</span>
                    </div>
                    <div class="se-distance-item">
                        <i class="bi bi-shop"></i>
                        <span>Mall Grand Indonesia - 2 km (10 menit)</span>
                    </div>
                    <div class="se-distance-item">
                        <i class="bi bi-train"></i>
                        <span>Stasiun Jakarta Kota - 5 km (15 menit)</span>
                    </div>
                    <div class="se-distance-item">
                        <i class="bi bi-basket"></i>
                        <span>Pantai Ancol - 8 km (20 menit)</span>
                    </div>
                </div>
            </div>

            {{-- Review Tamu --}}
            <div class="se-room-info-card mb-3 mb-lg-4" id="review">
                <div class="card-body">
                    <div class="se-section-header">
                        <div class="se-section-icon">
                            <i class="bi bi-star"></i>
                        </div>
                        <h3 class="se-section-title">Review Tamu</h3>
                    </div>

                    {{-- Rating Chart --}}
                    <div class="d-flex align-items-center gap-3 p-3 mb-3 rounded-3" style="background: var(--se-bg);">
                        <div class="text-center">
                            <div class="fs-2 fw-bold" style="color: var(--se-accent);">4.5</div>
                            <div style="color: var(--se-accent); font-size: 0.85rem;">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
                            </div>
                            <small class="text-muted">120 ulasan</small>
                        </div>
                        <div class="flex-grow-1">
                            @foreach([5,4,3,2,1] as $star)
                            <div class="d-flex align-items-center gap-2 small mb-1">
                                <span class="text-muted" style="min-width: 12px;">{{ $star }}</span>
                                <div class="progress flex-grow-1" style="height: 6px;">
                                    <div class="progress-bar" style="width: {{ $star == 5 ? 60 : ($star == 4 ? 25 : ($star == 3 ? 10 : ($star == 2 ? 3 : 2))) }}%; background-color: var(--se-accent);"></div>
                                </div>
                                <span class="text-muted" style="min-width: 30px;">{{ $star == 5 ? '60%' : ($star == 4 ? '25%' : ($star == 3 ? '10%' : ($star == 2 ? '3%' : '2%'))) }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Review List --}}
                    <div>
                        @php
                            $reviews = [
                                ['name' => 'Andi Wijaya', 'date' => '2 hari lalu', 'rating' => 5, 'text' => 'Kamar sangat bersih dan nyaman. Pelayanan ramah dan cepat. Lokasi strategis dekat dengan pusat kota. Highly recommended!'],
                                ['name' => 'Siti Nurhaliza', 'date' => '1 minggu lalu', 'rating' => 5, 'text' => 'Staycation yang sangat menyenangkan. Kamar luas dan fasilitas lengkap. Breakfast variatif dan enak.'],
                                ['name' => 'Budi Santoso', 'date' => '2 minggu lalu', 'rating' => 4, 'text' => 'Hotel bagus dengan harga terjangkau. AC dingin, kasur empuk. Parkir luas dan aman.'],
                            ];
                        @endphp

                        @foreach($reviews as $review)
                        <div class="se-review-item">
                            <div class="se-review-header">
                                <div class="se-review-avatar">
                                    {{ strtoupper(substr($review['name'], 0, 1)) }}
                                </div>
                                <div class="se-review-info">
                                    <strong>{{ $review['name'] }}</strong>
                                    <small>{{ $review['date'] }}</small>
                                </div>
                                <div class="se-review-rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review['rating'])
                                            <i class="bi bi-star-fill"></i>
                                        @else
                                            <i class="bi bi-star"></i>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            <p class="se-review-text">{{ $review['text'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- FAQ --}}
            <div class="se-room-info-card mb-3 mb-lg-4" id="faq">
                <div class="card-body">
                    <div class="se-section-header">
                        <div class="se-section-icon">
                            <i class="bi bi-question-circle"></i>
                        </div>
                        <h3 class="se-section-title">Pertanyaan Umum</h3>
                    </div>
                    <div class="accordion">
                        <div class="se-accordion-item">
                            <button class="accordion-button se-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                Apakah tersedia WiFi?
                            </button>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="se-accordion-body">
                                    Ya, hotel menyediakan WiFi gratis dengan kecepatan hingga 100Mbps di semua area kamar dan publik.
                                </div>
                            </div>
                        </div>
                        <div class="se-accordion-item">
                            <button class="accordion-button se-accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Apakah sarapan termasuk?
                            </button>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="se-accordion-body">
                                    Ya, sarapan buffet gratis untuk semua tamu yang menginap di hotel kami. Tersedia dari pukul 06.30 - 10.00 WIB.
                                </div>
                            </div>
                        </div>
                        <div class="se-accordion-item">
                            <button class="accordion-button se-accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Jam check-in dan check-out?
                            </button>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="se-accordion-body">
                                    Check-in dimulai pukul 14.00 WIB dan check-out sebelum pukul 12.00 WIB. Early check-in dan late check-out tersedia dengan tambahan biaya.
                                </div>
                            </div>
                        </div>
                        <div class="se-accordion-item">
                            <button class="accordion-button se-accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                Apakah tersedia parkir?
                            </button>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="se-accordion-body">
                                    Ya, hotel menyediakan parkir gratis untuk tamu. Area parkir yang luas dan aman dengan keamanan 24 jam.
                                </div>
                            </div>
                        </div>
                        <div class="se-accordion-item">
                            <button class="accordion-button se-accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                Apakah restoran buka 24 jam?
                            </button>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="se-accordion-body">
                                    Restoran buka dari pukul 06.00 - 23.00 WIB. Room service tersedia 24 jam untuk kamar.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Restoran Hotel --}}
            <div class="se-room-info-card mb-3 mb-lg-4">
                <div class="card-body">
                    <div class="se-section-header">
                        <div class="se-section-icon">
                            <i class="bi bi-cup-hot"></i>
                        </div>
                        <h3 class="se-section-title">Restoran Hotel</h3>
                    </div>
                    
                    {{-- Restaurant Image Gallery --}}
                    <div class="se-room-gallery mb-3">
                        <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800"
                             class="se-main-image"
                             alt="Restaurant Interior"
                             id="restaurantMainImage"
                             style="height: 300px;">
                        <div class="se-thumbnail-grid">
                            @foreach([
                                'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=200',
                                'https://images.unsplash.com/photo-1559329007-40df8a9345d8?w=200',
                                'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=200',
                                'https://images.unsplash.com/photo-1550966871-3ed3c47e718c?w=200',
                                'https://images.unsplash.com/photo-1544025162-d76694265947?w=200',
                            ] as $index => $img)
                            <img src="{{ $img }}" 
                                 class="se-thumbnail" 
                                 alt="Restaurant {{ $index + 1 }}"
                                 onclick="document.getElementById('restaurantMainImage').src='{{ $img }}'.replace('w=200', 'w=800')">
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="fw-bold mb-1">The EstEase Restaurant</h5>
                            <div class="d-flex align-items-center gap-2">
                                <div style="color: var(--se-accent); font-size: 0.85rem;">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"></i>
                                </div>
                                <span class="text-muted small">4.0</span>
                            </div>
                        </div>
                        <div class="text-end">
                            <small class="text-muted d-block">Jam Operasional</small>
                            <span class="fw-semibold">06.00 - 23.00 WIB</span>
                        </div>
                    </div>
                    <div class="se-menu-item">
                        <strong>Nasi Goreng Special</strong>
                        <span>Rp 85.000</span>
                    </div>
                    <div class="se-menu-item">
                        <strong>Beef Steak</strong>
                        <span>Rp 150.000</span>
                    </div>
                    <div class="se-menu-item">
                        <strong>Sushi Platter</strong>
                        <span>Rp 185.000</span>
                    </div>
                    <a href="{{ route('customer.restaurant.menu') }}" class="btn-se btn-se-primary w-100 mt-3" style="justify-content: center;">
                        <i class="bi bi-menu-button-wide"></i> Lihat Menu Lengkap
                    </a>
                </div>
            </div>

            {{-- Gallery Hotel --}}
            <div class="se-room-info-card mb-3 mb-lg-4">
                <div class="card-body">
                    <div class="se-section-header">
                        <div class="se-section-icon">
                            <i class="bi bi-images"></i>
                        </div>
                        <h3 class="se-section-title">Gallery Hotel</h3>
                    </div>
                    <div class="se-gallery-grid">
                    @php
                        $galleryImages = [
                            '1566073771259-6a8506099945',
                            '1517248135467-4c7edcad34c4',
                            '1571896349842-33c89424de2d',
                            '1534438327276-14e5300c3a48',
                            '1585320806297-3234d8a64611',
                            '1590679427486-5972014'
                        ];
                    @endphp
                    @foreach(['Lobby', 'Restaurant', 'Kolam Renang', 'Gym', 'Garden', 'Parking'] as $index => $gallery)
                        <div class="se-gallery-item" data-bs-toggle="modal" data-bs-target="#galleryModal{{ $index }}">
                            <img src="https://images.unsplash.com/photo-{{ $galleryImages[$index % 6] }}?w=400" 
                                 alt="{{ $gallery }}">
                            <div class="se-gallery-overlay">
                                <i class="bi bi-zoom-in"></i>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== RIGHT COLUMN: Booking Card + Similar Rooms + Reviews ===== --}}
        <div class="col-lg-4">
            {{-- Booking Card --}}
            <div class="se-booking-sidebar mb-3 sticky-lg-top" style="top: 76px;">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="se-section-icon" style="width: 36px; height: 36px; font-size: 1rem;">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <h5 class="fw-bold mb-0">Booking Kamar</h5>
                    </div>
                    
                    <form action="{{ route('customer.booking') }}" method="POST" id="bookingForm">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">
                                <i class="bi bi-calendar me-1"></i> Check In
                            </label>
                            <input type="date" name="check_in" class="form-control rounded-3" style="background: var(--se-bg); border: 1.5px solid var(--se-border); font-family: var(--font-alt, inherit);" min="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">
                                <i class="bi bi-calendar me-1"></i> Check Out
                            </label>
                            <input type="date" name="check_out" class="form-control rounded-3" style="background: var(--se-bg); border: 1.5px solid var(--se-border); font-family: var(--font-alt, inherit);" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                        </div>

                        {{-- Price Breakdown --}}
                        <div class="se-price-breakdown mb-3">
                            <div class="d-flex justify-content-between mb-2 small text-muted">
                                <span>Harga/Malam</span>
                                <span class="fw-semibold">Rp {{ number_format($room->roomType->price, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-1 small text-muted">
                                <span>Jumlah Malam</span>
                                <span class="fw-semibold" id="nightsCount">-</span>
                            </div>
                            <hr class="my-2" style="border-color: var(--se-border);">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold">Total</span>
                                <span class="fw-bold fs-5" style="color: var(--se-primary);" id="totalPrice">-</span>
                            </div>
                        </div>

                        @auth
                            <button type="submit" class="btn-se btn-se-primary w-100 py-3" style="font-size: 0.95rem; min-height: 52px; border-radius: var(--se-radius-sm);">
                                <i class="bi bi-check-circle me-2"></i> Booking Sekarang
                            </button>
                        @else
                            <a href="{{ route('customer.login') }}" class="btn-se btn-se-primary w-100 py-3" style="font-size: 0.95rem; min-height: 52px; border-radius: var(--se-radius-sm); text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px;">
                                <i class="bi bi-box-arrow-in-right me-2"></i> Login untuk Booking
                            </a>
                        @endauth

                        {{-- Benefits --}}
                        <div class="mt-3 pt-3" style="border-top: 1px solid var(--se-border);">
                            <div class="se-benefit-item">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Konfirmasi Instan</span>
                            </div>
                            <div class="se-benefit-item">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Pembayaran Aman</span>
                            </div>
                            <div class="se-benefit-item">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Gratis Pembatalan</span>
                            </div>
                            <div class="se-benefit-item">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Customer Service 24 Jam</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Similar Rooms --}}
            @if(isset($otherRooms) && $otherRooms->count() > 0)
            <div class="se-booking-sidebar mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="se-section-icon" style="width: 36px; height: 36px; font-size: 1rem;">
                            <i class="bi bi-building"></i>
                        </div>
                        <h6 class="fw-bold mb-0">Kamar Serupa</h6>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        @foreach($otherRooms as $other)
                        <a href="{{ route('customer.room.detail', $other) }}" class="se-similar-room-item">
                            <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?w=100" alt="Room">
                            <div class="room-info flex-grow-1 min-w-0">
                                <strong class="d-block text-truncate">{{ $other->room_number }} - {{ $other->roomType->name ?? 'Standard' }}</strong>
                                <small><i class="bi bi-people me-1"></i>{{ $other->roomType->max_guests ?? '-' }} tamu</small>
                                <div class="room-price">Rp {{ number_format($other->roomType->price, 0, ',', '.') }}/malam</div>
                            </div>
                            <div class="arrow-btn" style="width: 30px; height: 30px; border-radius: 50%; border: 1.5px solid var(--se-border); display: flex; align-items: center; justify-content: center; color: var(--se-text-muted); flex-shrink: 0;">
                                <i class="bi bi-chevron-right small"></i>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- Gallery Modals --}}
@php
    $modalImages = [
        '1566073771259-6a8506099945',
        '1517248135467-4c7edcad34c4',
        '1571896349842-33c89424de2d',
        '1534438327276-14e5300c3a48',
        '1585320806297-3234d8a64611',
        '1590679427486-5972014'
    ];
@endphp
@foreach(['Lobby', 'Restaurant', 'Kolam Renang', 'Gym', 'Garden', 'Parking'] as $index => $gallery)
<div class="modal fade" id="galleryModal{{ $index }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border-radius: var(--se-radius);">
            <div class="modal-body p-0">
                <img src="https://images.unsplash.com/photo-{{ $modalImages[$index % 6] }}?w=1200" 
                     alt="{{ $gallery }}" 
                     class="w-100" 
                     style="border-radius: var(--se-radius);">
            </div>
        </div>
    </div>
</div>
@endforeach

{{-- Mobile Fixed Bottom Booking Button --}}
<div class="d-lg-none" style="position: fixed; bottom: 0; left: 0; right: 0; background: var(--se-card); border-top: 1px solid var(--se-border); padding: 16px; z-index: 1000; box-shadow: 0 -4px 20px rgba(0,0,0,0.08);">
    <form action="{{ route('customer.booking') }}" method="POST" id="mobileBookingForm">
        @csrf
        <input type="hidden" name="room_id" value="{{ $room->id }}">
        <input type="hidden" name="check_in" id="mobileCheckIn">
        <input type="hidden" name="check_out" id="mobileCheckOut">
        
        <div class="d-flex gap-2">
            <div class="flex-grow-1">
                <div class="d-flex justify-content-between mb-1">
                    <small class="text-muted">Total</small>
                    <small class="text-muted" id="mobileNights">-</small>
                </div>
                <strong class="fs-4 d-block" id="mobileTotalDisplay" style="color: var(--se-primary);">Rp 0</strong>
            </div>
            <div style="flex-shrink: 0; min-width: 120px;">
                @auth
                    <button type="button" onclick="submitMobileBooking()" class="btn-se btn-se-primary w-100 py-3" style="font-size: 0.9rem; min-height: 52px; border-radius: var(--se-radius-sm);">
                        <i class="bi bi-check-circle me-1"></i> Booking
                    </button>
                @else
                    <a href="{{ route('customer.login') }}" class="btn-se btn-se-primary w-100 py-3" style="font-size: 0.9rem; min-height: 52px; border-radius: var(--se-radius-sm); text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 6px;">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Login
                    </a>
                @endauth
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkIn = document.querySelector('input[name="check_in"]');
    const checkOut = document.querySelector('input[name="check_out"]');
    const totalEl = document.getElementById('totalPrice');
    const nightsEl = document.getElementById('nightsCount');
    const pricePerNight = {{ $room->roomType->price }};
    const submitBtn = document.querySelector('#bookingForm button[type="submit"]');
    
    const mobileTotalDisplay = document.getElementById('mobileTotalDisplay');
    const mobileNights = document.getElementById('mobileNights');

    function formatRupiah(num) {
        return 'Rp ' + num.toLocaleString('id-ID');
    }

    function calculateTotal() {
        if (checkIn.value && checkOut.value) {
            const start = new Date(checkIn.value);
            const end = new Date(checkOut.value);
            const diffTime = Math.abs(end - start);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            
            if (diffDays > 0) {
                const total = pricePerNight * diffDays;
                totalEl.textContent = formatRupiah(total);
                nightsEl.textContent = diffDays + ' malam';
                
                if (mobileTotalDisplay) {
                    mobileTotalDisplay.textContent = formatRupiah(total);
                }
                if (mobileNights) {
                    mobileNights.textContent = diffDays + ' malam';
                }
                
                if (submitBtn) submitBtn.disabled = false;
            } else {
                totalEl.textContent = '-';
                nightsEl.textContent = '-';
                if (submitBtn) submitBtn.disabled = true;
            }
        } else {
            totalEl.textContent = '-';
            nightsEl.textContent = '-';
            if (submitBtn) submitBtn.disabled = true;
        }
    }

    const today = new Date().toISOString().split('T')[0];
    if (checkIn) checkIn.min = today;
    
    if (checkIn && checkOut) {
        checkIn.addEventListener('change', function() {
            const nextDay = new Date(this.value);
            nextDay.setDate(nextDay.getDate() + 1);
            checkOut.min = nextDay.toISOString().split('T')[0];
            if (checkOut.value && new Date(checkOut.value) <= new Date(this.value)) {
                checkOut.value = '';
            }
            calculateTotal();
        });
        
        checkOut.addEventListener('change', calculateTotal);
    }

    // Sticky nav active state on scroll
    const sections = document.querySelectorAll('[id]');
    const navLinks = document.querySelectorAll('.se-sticky-nav a');
    
    window.addEventListener('scroll', function() {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            if (scrollY >= sectionTop - 100) {
                current = section.getAttribute('id');
            }
        });
        
        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href').slice(1) === current) {
                link.classList.add('active');
            }
        });
    });
});

function submitMobileBooking() {
    const checkIn = document.querySelector('input[name="check_in"]');
    const checkOut = document.querySelector('input[name="check_out"]');
    const mobileCheckIn = document.getElementById('mobileCheckIn');
    const mobileCheckOut = document.getElementById('mobileCheckOut');
    
    if (!checkIn.value || !checkOut.value) {
        alert('Silakan pilih tanggal check-in dan check-out terlebih dahulu');
        window.scrollTo({ top: 0, behavior: 'smooth' });
        return;
    }
    
    mobileCheckIn.value = checkIn.value;
    mobileCheckOut.value = checkOut.value;
    document.getElementById('mobileBookingForm').submit();
}
</script>
@endpush
@endsection