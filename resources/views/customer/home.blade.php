@extends('customer.layouts.app')

@section('title', 'StayEase - Hotel & Restaurant Booking Premium')

@push('styles')
<style>
    /* ─── HERO ─── */
    .se-hero {
        position: relative;
        background: linear-gradient(135deg, #0F172A 0%, #1E3A5F 40%, #2563EB 100%);
        min-height: 600px;
        display: flex;
        align-items: center;
        overflow: hidden;
        padding: 40px 0 80px;
    }
    .se-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('https://images.unsplash.com/photo-1566073771259-6a8506099945?w=1600&q=80') center/cover;
        opacity: 0.15;
        z-index: 0;
    }
    .se-hero-pattern {
        position: absolute;
        inset: 0;
        z-index: 1;
    }
    .se-hero-pattern::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(37,99,235,0.15) 0%, transparent 70%);
        border-radius: 50%;
    }
    .se-hero-pattern::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(251,191,36,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }
    .se-hero-content { position: relative; z-index: 2; }

    .se-hero h1 {
        font-size: 3rem;
        font-weight: 900;
        color: #fff;
        line-height: 1.1;
        letter-spacing: -1px;
        margin-bottom: 16px;
    }
    .se-hero h1 .highlight {
        background: linear-gradient(135deg, #60A5FA, #FBBF24);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .se-hero p {
        color: rgba(255,255,255,0.7);
        font-size: 1.05rem;
        line-height: 1.7;
        max-width: 520px;
        margin-bottom: 32px;
    }

    /* Floating Search Card */
    .se-floating-search {
        position: relative;
        z-index: 3;
        margin-top: -60px;
    }
    .se-search-card {
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(25px);
        -webkit-backdrop-filter: blur(25px);
        border: 1px solid rgba(255,255,255,0.5);
        border-radius: 24px;
        padding: 24px;
        box-shadow: 0 25px 60px rgba(0,0,0,0.15);
    }
    .se-search-tabs {
        display: flex;
        gap: 4px;
        margin-bottom: 20px;
        background: var(--bg);
        border-radius: 14px;
        padding: 4px;
    }
    .se-search-tab {
        flex: 1;
        padding: 10px 20px;
        text-align: center;
        border-radius: 12px;
        font-family: var(--font-alt);
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-muted);
        cursor: pointer;
        border: none;
        background: transparent;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    .se-search-tab i { font-size: 1rem; }
    .se-search-tab.active {
        background: #fff;
        color: var(--primary);
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    }
    .se-search-tab:hover:not(.active) { color: var(--text); }

    .se-search-form .form-control, .se-search-form .form-select {
        border: 1.5px solid var(--border);
        border-radius: 14px;
        padding: 12px 16px;
        font-size: 0.9rem;
        font-family: var(--font-alt);
        transition: all 0.2s;
    }
    .se-search-form .form-control:focus, .se-search-form .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37,99,235,0.12);
    }
    .se-search-form .input-group-text {
        border: 1.5px solid var(--border);
        border-radius: 14px 0 0 14px;
        background: var(--bg);
        color: var(--text-muted);
        font-size: 0.85rem;
    }
    .se-search-form .btn-search-hero {
        background: var(--primary-gradient);
        color: #fff;
        border: none;
        border-radius: 14px;
        padding: 12px 32px;
        font-family: var(--font-alt);
        font-weight: 700;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 16px rgba(37,99,235,0.35);
        height: 100%;
        white-space: nowrap;
    }
    .se-search-form .btn-search-hero:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(37,99,235,0.45);
    }

    /* Hero Stats */
    .se-hero-stats {
        display: flex;
        gap: 40px;
        margin-top: 40px;
    }
    .se-hero-stat h3 {
        color: #fff;
        font-size: 1.8rem;
        font-weight: 900;
        margin-bottom: 2px;
    }
    .se-hero-stat p {
        color: rgba(255,255,255,0.5);
        font-size: 0.8rem;
        font-weight: 500;
        margin: 0;
        letter-spacing: 0.3px;
    }

    /* ─── FEATURED SECTION ─── */
    .se-featured { padding: 80px 0; }
    .se-featured-header {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        margin-bottom: 28px;
        flex-wrap: wrap;
        gap: 12px;
    }
    .se-featured-header h2 {
        font-weight: 800;
        font-size: 1.6rem;
        color: var(--text);
    }
    .se-featured-header h2 span { color: var(--primary); }
    .se-featured-header a {
        font-family: var(--font-alt);
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--primary);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: gap 0.2s;
    }
    .se-featured-header a:hover { gap: 10px; }

    /* Hotel Card Premium */
    .se-hotel-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4,0,0.2,1);
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .se-hotel-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.12);
        border-color: transparent;
    }
    .se-hotel-card-img {
        position: relative;
        height: 200px;
        overflow: hidden;
        flex-shrink: 0;
    }
    .se-hotel-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    .se-hotel-card:hover .se-hotel-card-img img { transform: scale(1.08); }
    .se-hotel-card-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(255,255,255,0.9);
        backdrop-filter: blur(10px);
        color: var(--text);
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 700;
        font-family: var(--font-alt);
    }
    .se-hotel-card-price-float {
        position: absolute;
        bottom: 12px;
        right: 12px;
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(10px);
        padding: 6px 14px;
        border-radius: 12px;
        font-weight: 800;
        font-size: 0.9rem;
        color: var(--primary);
    }
    .se-hotel-card-body {
        padding: 18px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }
    .se-hotel-card-title {
        font-weight: 700;
        font-size: 1rem;
        color: var(--text);
        margin-bottom: 4px;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .se-hotel-card-sub {
        font-family: var(--font-alt);
        font-size: 0.78rem;
        color: var(--text-muted);
        margin-bottom: 8px;
    }
    .se-hotel-card-rating {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 10px;
    }
    .se-hotel-card-rating .score {
        background: var(--primary-gradient);
        color: #fff;
        font-weight: 800;
        font-size: 0.75rem;
        padding: 3px 8px;
        border-radius: 8px;
    }
    .se-hotel-card-rating .label {
        font-family: var(--font-alt);
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--text);
    }
    .se-hotel-card-rating .count {
        font-family: var(--font-alt);
        font-size: 0.72rem;
        color: var(--text-muted);
    }
    .se-hotel-card-amenities {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-top: auto;
    }
    .se-hotel-card-amenities span {
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 3px 10px;
        font-family: var(--font-alt);
        font-size: 0.68rem;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* ─── RESTAURANT TEASER ─── */
    .se-resto-teaser {
        background: #fff;
        padding: 80px 0;
    }
    .se-resto-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        overflow: hidden;
        transition: all 0.4s ease;
        height: 100%;
    }
    .se-resto-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.1);
    }
    .se-resto-card-img {
        height: 180px;
        overflow: hidden;
    }
    .se-resto-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s;
    }
    .se-resto-card:hover .se-resto-card-img img { transform: scale(1.08); }
    .se-resto-card-body { padding: 18px; }
    .se-resto-card-body h5 { font-weight: 700; font-size: 1rem; }
    .se-resto-card-body .meta {
        font-family: var(--font-alt);
        font-size: 0.78rem;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 4px;
        margin-bottom: 6px;
    }

    /* ─── APP DOWNLOAD ─── */
    .se-app-download {
        background: linear-gradient(135deg, #0F172A 0%, #1E3A5F 100%);
        border-radius: var(--radius);
        padding: 60px;
        position: relative;
        overflow: hidden;
    }
    .se-app-download::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(37,99,235,0.2) 0%, transparent 70%);
        border-radius: 50%;
    }
    .se-app-download h2 {
        font-weight: 800;
        font-size: 2rem;
        color: #fff;
        margin-bottom: 12px;
    }
    .se-app-download p { color: rgba(255,255,255,0.6); font-size: 0.95rem; }
    .se-app-btns { display: flex; gap: 12px; flex-wrap: wrap; }
    .se-app-btn {
        display: flex;
        align-items: center;
        gap: 10px;
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.15);
        border-radius: 16px;
        padding: 14px 24px;
        color: #fff;
        text-decoration: none;
        transition: all 0.3s;
    }
    .se-app-btn:hover { background: rgba(255,255,255,0.2); color: #fff; transform: translateY(-2px); }
    .se-app-btn i { font-size: 1.5rem; }
    .se-app-btn small { font-size: 0.65rem; opacity: 0.7; display: block; }
    .se-app-btn strong { font-size: 0.95rem; }

    /* ─── TESTIMONIALS ─── */
    .se-testi-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 28px;
        height: 100%;
        transition: all 0.3s;
    }
    .se-testi-card:hover {
        box-shadow: var(--shadow);
        transform: translateY(-4px);
    }
    .se-testi-card .stars { color: var(--accent); font-size: 0.9rem; margin-bottom: 12px; }
    .se-testi-card p {
        font-style: italic;
        color: var(--text);
        font-size: 0.9rem;
        line-height: 1.7;
        margin-bottom: 16px;
    }
    .se-testi-card .user {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .se-testi-card .user .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--primary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 700;
        font-size: 0.8rem;
    }
    .se-testi-card .user .name { font-weight: 700; font-size: 0.85rem; }
    .se-testi-card .user .pos { font-family: var(--font-alt); font-size: 0.72rem; color: var(--text-muted); }

    /* ─── BRANDS ─── */
    .se-brands {
        padding: 60px 0;
        text-align: center;
    }
    .se-brands p {
        font-family: var(--font-alt);
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--text-muted);
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 24px;
    }
    .se-brands-logos {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 40px;
        flex-wrap: wrap;
    }
    .se-brands-logos span {
        font-family: var(--font-alt);
        font-size: 0.85rem;
        font-weight: 700;
        color: #94A3B8;
        letter-spacing: 1px;
    }

    @media (max-width: 768px) {
        .se-hero { min-height: auto; padding: 30px 0 60px; }
        .se-hero h1 { font-size: 2rem; }
        .se-hero p { font-size: 0.9rem; }
        .se-hero-stats { gap: 20px; flex-wrap: wrap; }
        .se-hero-stat h3 { font-size: 1.3rem; }
        .se-floating-search { margin-top: -30px; }
        .se-search-card { padding: 16px; border-radius: 16px; }
        .se-search-tab { font-size: 0.75rem; padding: 8px 12px; }
        .se-search-tab span { display: none; }
        .se-app-download { padding: 30px; }
        .se-app-download h2 { font-size: 1.3rem; }
        .se-featured { padding: 40px 0; }
        .se-resto-teaser { padding: 40px 0; }
    }
</style>
@endpush

@section('content')
{{-- ─── HERO ─── --}}
<section class="se-hero">
    <div class="se-hero-pattern"></div>
    <div class="container se-hero-content">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <p class="mb-2" style="color:rgba(255,255,255,0.6);font-size:0.85rem;font-weight:600;letter-spacing:1px;text-transform:uppercase;">
                    <i class="bi bi-stars me-1" style="color:var(--accent);"></i> Premium Hotel & Restaurant Booking
                </p>
                <h1>
                    Tempat <span class="highlight">Menginap</span><br>
                    & Bersantap Terbaik<br>
                    di Indonesia
                </h1>
                <p>Temukan hotel mewah, restoran terbaik, dan pengalaman tak terlupakan. Booking mudah, harga transparan, layanan 24/7.</p>

                {{-- Stats --}}
                <div class="se-hero-stats">
                    <div class="se-hero-stat">
                        <h3>10K+</h3>
                        <p>Kamar Tersedia</p>
                    </div>
                    <div class="se-hero-stat">
                        <h3>50K+</h3>
                        <p>Tamu Puas</p>
                    </div>
                    <div class="se-hero-stat">
                        <h3>4.8</h3>
                        <p>Rating Pengguna</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=600&q=80"
                         class="rounded-4 shadow-lg"
                         alt="Premium Hotel"
                         style="width:100%;height:400px;object-fit:cover;border-radius:24px !important;">
                    <div class="position-absolute bottom-0 start-0 end-0 p-4" style="background:linear-gradient(transparent, rgba(0,0,0,0.6));border-radius:0 0 24px 24px;">
                        <div class="d-flex align-items-center gap-2 text-white">
                            <i class="bi bi-shield-check fs-4"></i>
                            <div>
                                <strong style="font-size:0.85rem;">Terpercaya & Aman</strong>
                                <span style="font-size:0.72rem;display:block;opacity:0.7;">Booking terjamin</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ─── FLOATING SEARCH CARD ─── --}}
<section class="se-floating-search">
    <div class="container">
        <div class="se-search-card">
            {{-- Tabs --}}
            <div class="se-search-tabs" role="tablist">
                <button class="se-search-tab active" data-tab="hotel" role="tab">
                    <i class="bi bi-building"></i> <span>Cari Hotel</span>
                </button>
                <button class="se-search-tab" data-tab="restaurant" role="tab">
                    <i class="bi bi-cup-hot"></i> <span>Cari Restoran</span>
                </button>
            </div>

            {{-- Hotel Search Form --}}
            <div class="se-search-form" id="searchHotel" style="display:block;">
                <form action="{{ route('rooms.index') }}" method="GET">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Tipe Kamar</label>
                            <select name="room_type" class="form-select">
                                <option value="">Semua Tipe</option>
                                @foreach($roomTypes ?? [] as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold small">Check In</label>
                            <input type="date" class="form-control" name="check_in" min="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold small">Check Out</label>
                            <input type="date" class="form-control" name="check_out" min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn-search-hero w-100">
                                <i class="bi bi-search me-1"></i> Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Restaurant Search Form --}}
            <div class="se-search-form" id="searchRestaurant" style="display:none;">
                <form action="{{ route('customer.restaurant.menu') }}" method="GET">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Restaurant</label>
                            <input type="text" class="form-control" placeholder="Nama restoran atau menu..." name="search">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold small">Tanggal</label>
                            <input type="date" class="form-control" name="date" min="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold small">Jam</label>
                            <select class="form-select" name="time">
                                <option>12:00</option>
                                <option>13:00</option>
                                <option>18:00</option>
                                <option>19:00</option>
                                <option>20:00</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <label class="form-label fw-semibold small">Tamu</label>
                            <select class="form-select" name="guests">
                                @for($i=1;$i<=10;$i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn-search-hero w-100">
                                <i class="bi bi-search me-1"></i> Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

{{-- ─── BRANDS / TRUST ─── --}}
<section class="se-brands">
    <div class="container">
        <p>Dipercaya oleh hotel dan restoran terbaik</p>
        <div class="se-brands-logos">
            <span>🏨 Grand Hotel</span>
            <span>🍽️ Le Restaurant</span>
            <span>🏛️ Royal Suites</span>
            <span>🌊 Seaside Resort</span>
            <span>🥂 Fine Dining Co</span>
            <span>⭐ Premium Stay</span>
        </div>
    </div>
</section>

{{-- ─── ROOM TYPES / CATEGORIES ─── --}}
@if(isset($roomTypes) && $roomTypes->count() > 0)
<section class="se-featured" style="padding-top:0;">
    <div class="container">
        <div class="se-featured-header">
            <h2>Jelajahi <span>Tipe Kamar</span></h2>
            <a href="{{ route('rooms.index') }}">Lihat Semua Hotel <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="row g-3">
            @foreach($roomTypes->take(4) as $type)
                @php
                    $imgs = [
                        'https://images.unsplash.com/photo-1611892440504-42a792e24d32?w=600&q=80',
                        'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=600&q=80',
                        'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=600&q=80',
                        'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=600&q=80',
                    ];
                @endphp
                <div class="col-6 col-lg-3">
                    <a href="{{ route('rooms.index', ['room_type' => $type->id]) }}" class="text-decoration-none">
                        <div class="se-hotel-card">
                            <div class="se-hotel-card-img">
                                <img src="{{ $imgs[$loop->index % count($imgs)] }}" alt="{{ $type->name }}" loading="lazy">
                                <span class="se-hotel-card-badge"><i class="bi bi-door-open me-1"></i>{{ $type->rooms_count ?? 0 }} kamar</span>
                                <span class="se-hotel-card-price-float">Rp {{ number_format($type->price, 0, ',', '.') }}</span>
                            </div>
                            <div class="se-hotel-card-body">
                                <div class="se-hotel-card-title">{{ $type->name }}</div>
                                <div class="se-hotel-card-sub">
                                    <i class="bi bi-people me-1"></i>Max {{ $type->max_guests }} tamu
                                </div>
                                <div class="se-hotel-card-rating">
                                    <span class="score">{{ number_format(4.5 + ($loop->index * 0.1), 1) }}</span>
                                    <span class="label">Sangat Baik</span>
                                    <span class="count">({{ 80 + ($loop->index * 30) }} ulasan)</span>
                                </div>
                                <div class="se-hotel-card-amenities">
                                    <span><i class="bi bi-wifi"></i>WiFi</span>
                                    <span><i class="bi bi-snow"></i>AC</span>
                                    <span><i class="bi bi-tv"></i>TV</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ─── FEATURED HOTELS ─── --}}
@if(isset($rooms) && $rooms->count() > 0)
<section class="se-featured">
    <div class="container">
        <div class="se-featured-header">
            <h2>Hotel <span>Premium</span></h2>
            <a href="{{ route('rooms.index') }}">Lihat Semua <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="row g-3">
            @foreach($rooms->take(4) as $room)
                @php
                    $imgs = [
                        'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=600&q=80',
                        'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=600&q=80',
                        'https://images.unsplash.com/photo-1611892440504-42a792e24d32?w=600&q=80',
                        'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=600&q=80',
                    ];
                    $scores = [8.5, 8.7, 8.9, 9.0, 9.1, 9.2];
                    $score = $scores[$room->id % count($scores)];
                    $labels = [9.0 => 'Luar Biasa', 8.5 => 'Sangat Baik', 8.0 => 'Baik'];
                    $label = 'Baik';
                    foreach($labels as $t => $l) { if($score >= $t) { $label = $l; break; } }
                    $rc = ($room->id * 37 + 120) % 400 + 80;
                @endphp
                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('customer.room.detail', $room) }}" class="text-decoration-none">
                        <div class="se-hotel-card">
                            <div class="se-hotel-card-img">
                                <img src="{{ $imgs[$room->id % count($imgs)] }}" alt="{{ $room->room_number }}" loading="lazy">
                                <span class="se-hotel-card-badge"><i class="bi bi-check-circle-fill text-success me-1"></i>Tersedia</span>
                                <span class="se-hotel-card-price-float">Rp {{ number_format($room->roomType->price, 0, ',', '.') }}</span>
                            </div>
                            <div class="se-hotel-card-body">
                                <div class="se-hotel-card-title">{{ $room->room_number }} - {{ $room->roomType->name }}</div>
                                <div class="se-hotel-card-sub"><i class="bi bi-building me-1"></i>Lantai {{ $room->floor }} · Max {{ $room->roomType->max_guests }} tamu</div>
                                <div class="se-hotel-card-rating">
                                    <span class="score">{{ number_format($score, 1) }}</span>
                                    <span class="label">{{ $label }}</span>
                                    <span class="count">({{ $rc }} ulasan)</span>
                                </div>
                                <div class="se-hotel-card-amenities">
                                    <span><i class="bi bi-wifi"></i>WiFi</span>
                                    <span><i class="bi bi-snow"></i>AC</span>
                                    <span><i class="bi bi-tv"></i>TV</span>
                                    <span><i class="bi bi-people"></i>{{ $room->roomType->max_guests }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ─── RESTAURANT TEASER ─── --}}
<section class="se-resto-teaser">
    <div class="container">
        <div class="se-featured-header">
            <h2>Restoran <span>Terbaik</span></h2>
            <a href="{{ route('customer.restaurant.menu') }}">Lihat Menu <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="row g-3">
            @php
                $restos = [
                    ['name' => 'Fine Dining Room', 'cuisine' => 'Internasional', 'rating' => 4.8, 'img' => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=600&q=80'],
                    ['name' => 'Traditional Nusantara', 'cuisine' => 'Indonesia', 'rating' => 4.7, 'img' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=600&q=80'],
                    ['name' => 'Rooftop Lounge', 'cuisine' => 'Fusion', 'rating' => 4.9, 'img' => 'https://images.unsplash.com/photo-1470337458703-46ad1756a187?w=600&q=80'],
                    ['name' => 'Cafe & Bakery', 'cuisine' => 'French', 'rating' => 4.6, 'img' => 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?w=600&q=80'],
                ];
            @endphp
            @foreach($restos as $resto)
                <div class="col-6 col-lg-3">
                    <a href="{{ route('customer.restaurant.menu') }}" class="text-decoration-none">
                        <div class="se-resto-card">
                            <div class="se-resto-card-img">
                                <img src="{{ $resto['img'] }}" alt="{{ $resto['name'] }}" loading="lazy">
                            </div>
                            <div class="se-resto-card-body">
                                <h5 class="mb-1 text-dark">{{ $resto['name'] }}</h5>
                                <div class="meta"><i class="bi bi-bookmark"></i> {{ $resto['cuisine'] }}</div>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="se-badge se-badge-primary"><i class="bi bi-star-fill me-1"></i>{{ $resto['rating'] }}</span>
                                    <small class="text-muted">Buka 10:00-22:00</small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ─── TESTIMONIALS ─── --}}
@if(isset($testimonials) && $testimonials->count() > 0)
<section class="se-featured" style="padding-top:0;">
    <div class="container">
        <div class="se-featured-header">
            <h2>Apa Kata <span>Mereka</span></h2>
        </div>
        <div class="row g-3">
            @foreach($testimonials as $t)
                <div class="col-md-4">
                    <div class="se-testi-card">
                        <div class="stars">
                            @for($i=1;$i<=5;$i++)
                                @if($i<=$t->rating)<i class="bi bi-star-fill"></i>@else<i class="bi bi-star"></i>@endif
                            @endfor
                        </div>
                        <p>"{{ $t->message }}"</p>
                        <div class="user">
                            <div class="avatar">{{ strtoupper(substr($t->name, 0, 2)) }}</div>
                            <div>
                                <div class="name">{{ $t->name }}</div>
                                <div class="pos">{{ $t->position ?? 'Tamu' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ─── APP DOWNLOAD ─── --}}
<section style="padding:60px 0;">
    <div class="container">
        <div class="se-app-download">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h2>Download Aplikasi StayEase</h2>
                    <p>Booking hotel & restoran jadi lebih mudah dengan aplikasi mobile kami. Dapatkan penawaran eksklusif!</p>
                    <div class="se-app-btns">
                        <a href="#" class="se-app-btn">
                            <i class="bi bi-google-play"></i>
                            <div>
                                <small>Download di</small>
                                <strong>Google Play</strong>
                            </div>
                        </a>
                        <a href="#" class="se-app-btn">
                            <i class="bi bi-apple"></i>
                            <div>
                                <small>Download di</small>
                                <strong>App Store</strong>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-flex justify-content-center">
                    <div class="text-center">
                        <i class="bi bi-phone display-1 text-white" style="opacity:0.3;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ─── NEWSLETTER ─── --}}
<section style="padding:0 0 60px;">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-6">
                <h3 class="fw-bold mb-2">Dapatkan Penawaran Terbaik</h3>
                <p class="text-muted mb-4" style="font-family:var(--font-alt);font-size:0.9rem;">Langganan newsletter kami untuk info promo dan diskon spesial.</p>
                <form class="d-flex gap-2">
                    <input type="email" class="form-control rounded-3 py-3" placeholder="Masukkan email Anda..." style="border:1.5px solid var(--border);">
                    <button type="submit" class="btn-se btn-se-primary px-4" style="flex-shrink:0;">Langganan</button>
                </form>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    // Search tabs
    document.querySelectorAll('.se-search-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.se-search-tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            const tabName = this.dataset.tab;
            document.getElementById('searchHotel').style.display = tabName === 'hotel' ? 'block' : 'none';
            document.getElementById('searchRestaurant').style.display = tabName === 'restaurant' ? 'block' : 'none';
        });
    });
</script>
@endpush
@endsection
