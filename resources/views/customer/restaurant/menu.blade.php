@extends('customer.layouts.app')

@section('title', 'Restoran Hotel - StayEase')

@push('styles')
<style>
    /* ─── Restaurant Hero ─── */
    .restaurant-hero {
        position: relative;
        height: 50vh;
        min-height: 350px;
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.75) 0%, rgba(30, 58, 95, 0.85) 100%), 
                    url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=1920') center/cover;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        overflow: hidden;
    }
    .restaurant-hero::before {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 80px;
        background: linear-gradient(to top, var(--bg), transparent);
        z-index: 3;
    }
    .restaurant-hero::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(245, 158, 11, 0.15) 0%, transparent 70%);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-30px); }
    }
    .hero-content {
        z-index: 2;
        position: relative;
    }
    .hero-content h1 {
        font-size: 3.5rem;
        font-weight: 900;
        letter-spacing: -2px;
        margin-bottom: 16px;
        background: linear-gradient(135deg, #FFF 0%, #FCD34D 50%, #F59E0B 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-shadow: 0 4px 20px rgba(245, 158, 11, 0.3);
        animation: fadeInUp 0.8s ease;
    }
    .hero-content p {
        font-size: 1.15rem;
        color: rgba(255, 255, 255, 0.9);
        font-weight: 500;
        max-width: 650px;
        margin: 0 auto;
        line-height: 1.7;
        animation: fadeInUp 0.8s ease 0.2s both;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ─── Booking Guard Notice ─── */
    .se-booking-guard {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        padding: 20px 24px;
        position: relative;
        transition: all 0.25s;
    }
    .se-booking-guard-body {
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .se-booking-guard-icon {
        flex-shrink: 0;
        width: 52px; height: 52px;
        border-radius: var(--radius);
        background: #EFF6FF;
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    .se-booking-guard-content {
        flex: 1;
        min-width: 0;
    }
    .se-booking-guard-title {
        color: var(--text);
        font-size: 1rem;
        font-weight: 750;
        display: block;
        margin-bottom: 4px;
    }
    .se-booking-guard-text {
        color: var(--text-muted);
        font-family: var(--font-alt);
        font-size: 0.88rem;
        line-height: 1.6;
    }
    .se-booking-guard-btn {
        flex-shrink: 0;
        background: var(--primary);
        color: #fff;
        border-radius: var(--radius-xs);
        padding: 10px 18px;
        font-size: 0.88rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s;
        white-space: nowrap;
    }
    .se-booking-guard-btn:hover {
        background: #1d4ed8;
        color: #fff;
        transform: translateY(-1px);
    }
    .se-booking-guard-close {
        position: absolute;
        top: 12px;
        right: 16px;
        background: transparent;
        border: none;
        color: var(--text-muted);
        cursor: pointer;
        font-size: 1rem;
        transition: color 0.2s;
    }
    .se-booking-guard-close:hover {
        color: var(--text);
    }

    @media (max-width: 768px) {
        .se-booking-guard-body {
            flex-direction: column;
            align-items: flex-start;
        }
        .se-booking-guard-btn {
            width: 100%;
            justify-content: center;
            margin-top: 16px;
        }
        .se-booking-guard-close {
            top: 16px;
            right: 16px;
        }
    }

    /* ─── Category Sticky Bar ─── */
    .category-bar-section {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid var(--border);
        padding: 18px 0;
        position: sticky;
        top: var(--nav-height);
        z-index: 50;
        box-shadow: 0 2px 20px rgba(0,0,0,0.06);
    }
    .category-badges {
        display: flex;
        gap: 12px;
        overflow-x: auto;
        padding-bottom: 4px;
        scrollbar-width: none;
    }
    .category-badges::-webkit-scrollbar { display: none; }
    .category-badge {
        flex-shrink: 0;
        padding: 10px 24px;
        border-radius: 100px;
        font-size: 0.88rem;
        font-weight: 600;
        cursor: pointer;
        border: 2px solid var(--border);
        background: var(--bg-card);
        color: var(--text-muted);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        white-space: nowrap;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }
    .category-badge:hover {
        border-color: var(--primary);
        color: var(--primary);
        background: var(--primary-light);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15);
    }
    .category-badge.active {
        background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%);
        border-color: var(--primary);
        color: #fff;
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.35);
        transform: translateY(-2px);
    }

    /* ─── Menu Grid ─── */
    .menu-section {
        padding: 48px 0 100px;
        background: linear-gradient(180deg, var(--bg) 0%, #F1F5F9 100%);
    }
    .menu-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
        box-shadow: var(--shadow-xs);
        position: relative;
    }
    .menu-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        border-color: transparent;
    }
    .menu-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, #2563EB 0%, #F59E0B 50%, #2563EB 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 10;
    }
    .menu-card:hover::before {
        opacity: 1;
    }
    .menu-image-container {
        position: relative;
        overflow: hidden;
        aspect-ratio: 4/3;
        background: var(--bg);
    }
    .menu-card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .menu-card:hover .menu-card-img {
        transform: scale(1.1);
    }
    .menu-image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 5rem;
        transition: all 0.6s ease;
        position: absolute;
        top: 0; left: 0;
    }
    .menu-card:hover .menu-image-placeholder {
        transform: scale(1.1) rotate(5deg);
    }
    .menu-placeholder-1 { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .menu-placeholder-2 { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
    .menu-placeholder-3 { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
    .menu-placeholder-4 { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }
    .menu-placeholder-5 { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); }
    .menu-placeholder-6 { background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); }
    .menu-placeholder-7 { background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%); }
    .menu-placeholder-8 { background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%); }
    .menu-placeholder-9 { background: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%); }
    .menu-placeholder-10 { background: linear-gradient(135deg, #d299c2 0%, #fef9d7 100%); }
    .menu-placeholder-11 { background: linear-gradient(135deg, #89f7fe 0%, #66a6ff 100%); }
    .menu-placeholder-12 { background: linear-gradient(135deg, #fddb92 0%, #d1fdff 100%); }
    .menu-image-shine {
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.6s ease;
        z-index: 2;
    }
    .menu-card:hover .menu-image-shine {
        left: 100%;
    }
    .menu-status-badge {
        position: absolute;
        top: 16px; right: 16px;
        padding: 6px 14px;
        border-radius: 100px;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        backdrop-filter: blur(10px);
        z-index: 5;
    }
    .bg-available { 
        background: rgba(220, 252, 231, 0.95); 
        color: #15803D; 
        border: 1px solid #BBF7D0;
    }
    .bg-unavailable { 
        background: rgba(254, 226, 226, 0.95); 
        color: #B91C1C; 
        border: 1px solid #FECACA;
    }
    .menu-image-overlay {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 50%;
        background: linear-gradient(to top, rgba(0,0,0,0.3), transparent);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .menu-card:hover .menu-image-overlay {
        opacity: 1;
    }

    .menu-body {
        padding: 24px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        position: relative;
    }
    .menu-title {
        font-size: 1.2rem;
        font-weight: 800;
        color: var(--text);
        margin-bottom: 10px;
        line-height: 1.35;
        letter-spacing: -0.3px;
        transition: color 0.3s ease;
    }
    .menu-card:hover .menu-title {
        color: var(--primary);
    }
    .menu-desc {
        font-size: 0.88rem;
        color: var(--text-muted);
        margin-bottom: 20px;
        line-height: 1.65;
        flex-grow: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .menu-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-top: auto;
        padding-top: 16px;
        border-top: 1px solid var(--border);
    }
    .menu-price-wrapper {
        position: relative;
        display: inline-block;
    }
    .menu-price {
        font-size: 1.35rem;
        font-weight: 900;
        color: var(--primary);
        white-space: nowrap;
        letter-spacing: -0.5px;
        position: relative;
    }
    .menu-price::after {
        content: '';
        position: absolute;
        bottom: -2px; left: 0;
        width: 0; height: 2px;
        background: var(--primary);
        transition: width 0.3s ease;
    }
    .menu-card:hover .menu-price::after {
        width: 100%;
    }
    .btn-order {
        background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%);
        color: #fff;
        border: none;
        border-radius: var(--radius-xs);
        padding: 11px 22px;
        font-size: 0.88rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        white-space: nowrap;
        box-shadow: 0 4px 14px rgba(37, 99, 235, 0.25);
    }
    .btn-order:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.4);
        background: linear-gradient(135deg, #1D4ED8 0%, #1E40AF 100%);
    }
    .btn-order:active {
        transform: translateY(0);
    }
    .btn-order:disabled {
        background: var(--bg);
        color: #94A3B8;
        border: 1px solid var(--border);
        cursor: not-allowed;
        box-shadow: none;
    }

    /* ─── Floating Cart Button ─── */
    .floating-cart {
        position: fixed;
        bottom: 30px; right: 30px;
        width: 70px; height: 70px;
        background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%);
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        box-shadow: 0 12px 32px rgba(37, 99, 235, 0.45);
        cursor: pointer;
        z-index: 999;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: none;
        animation: pulse 2s ease-in-out infinite;
    }
    @keyframes pulse {
        0%, 100% { box-shadow: 0 12px 32px rgba(37, 99, 235, 0.45); }
        50% { box-shadow: 0 12px 40px rgba(37, 99, 235, 0.65); }
    }
    .floating-cart:hover {
        transform: translateY(-6px) scale(1.08);
        box-shadow: 0 18px 44px rgba(37, 99, 235, 0.55);
        animation: none;
    }
    .cart-badge {
        position: absolute;
        top: -6px; right: -6px;
        width: 26px; height: 26px;
        border-radius: 50%;
        background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
        color: #fff;
        font-size: 0.75rem;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.5);
        border: 2px solid #fff;
    }

    /* ─── Cart Sidebar ─── */
    .cart-offcanvas {
        border-radius: 20px 0 0 20px;
        box-shadow: -10px 0 40px rgba(0,0,0,0.1);
    }
    .cart-item-row {
        padding: 16px 0;
        border-bottom: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .btn-trash {
        background: #FEE2E2;
        color: var(--danger);
        border: none;
        width: 32px; height: 32px;
        border-radius: var(--radius-xs);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        transition: all 0.2s;
    }
    .btn-trash:hover {
        background: var(--danger);
        color: #fff;
    }

    /* ─── Modal Styles ─── */
    .custom-modal-content {
        border-radius: 24px;
        border: none;
        overflow: hidden;
    }

    @media (max-width: 768px) {
        .restaurant-hero { height: 40vh; min-height: 280px; }
        .hero-content h1 { font-size: 2.2rem; letter-spacing: -1px; }
        .hero-content p { font-size: 0.95rem; }
        .menu-body { padding: 18px; }
        .menu-title { font-size: 1.05rem; }
        .menu-price { font-size: 1.15rem; }
        .floating-cart { bottom: 20px; right: 20px; width: 60px; height: 60px; font-size: 1.4rem; }
        .btn-order { padding: 9px 18px; font-size: 0.85rem; }
        .category-badge { padding: 8px 18px; font-size: 0.82rem; }
        .menu-card {
            border-radius: var(--radius-sm);
        }
    }
    
    @media (max-width: 576px) {
        .restaurant-hero { height: 35vh; min-height: 240px; }
        .hero-content h1 { font-size: 1.8rem; }
        .hero-content p { font-size: 0.88rem; }
        .menu-body { padding: 16px; }
        .menu-title { font-size: 1rem; }
        .menu-price { font-size: 1.1rem; }
        .btn-order { padding: 8px 16px; font-size: 0.82rem; }
        .menu-status-badge { 
            top: 10px; right: 10px; 
            padding: 5px 10px; 
            font-size: 0.68rem; 
        }
    }
</style>
@endpush

@section('content')
{{-- Hero --}}
<div class="restaurant-hero">
    <div class="hero-content">
        <h1>🍽️ Restoran StayEase</h1>
        <p>Manjakan diri dengan berbagai pilihan menu masakan premium, disiapkan oleh chef profesional kami langsung untuk Anda.</p>
    </div>
</div>

{{-- Booking reservation guard notice --}}
@auth
    @if(!$hasBookedRoom)
    <div class="container mt-4">
        <div class="se-booking-guard">
            <div class="se-booking-guard-body">
                <div class="se-booking-guard-icon"><i class="bi bi-shield-lock-fill"></i></div>
                <div class="se-booking-guard-content">
                    <strong class="se-booking-guard-title">Akses restoran untuk tamu hotel</strong>
                    <span class="se-booking-guard-text">Anda belum memiliki reservasi kamar. <b>Pesan / cek-in kamar terlebih dahulu</b> agar bisa memesan makanan di sini.</span>
                </div>
                <a href="{{ route('rooms.index') }}" class="se-booking-guard-btn">
                    <i class="bi bi-building"></i> Booking Sekarang
                </a>
            </div>
            <button type="button" class="se-booking-guard-close" data-bs-dismiss="alert" aria-label="Tutup">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    </div>
    @endif
@endauth

{{-- Category Stick Bar --}}
<div class="category-bar-section">
    <div class="container">
        <div class="category-badges">
            <button class="category-badge active" data-category="all">
                <i class="bi bi-grid-3x3-gap me-1"></i> Semua Menu
            </button>
            @foreach($categories as $category)
                <button class="category-badge" data-category="{{ $category }}">
                    {{ ucfirst($category) }}
                </button>
            @endforeach
        </div>
    </div>
</div>

{{-- Menu Grid --}}
<div class="menu-section">
    <div class="container">
        <div class="row g-4" id="menuGrid">
            @forelse($menus as $menu)
                <div class="col-12 col-sm-6 col-lg-4 menu-item animate-up" data-category="{{ $menu->category }}">
                    <div class="menu-card">
                        <div class="menu-image-container">
                            @if($menu->image)
                                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="menu-card-img" loading="lazy">
                            @else
                                @php
                                    $emojis = ['🍕', '🍔', '🍟', '🌭', '🍿', '🧁', '🍩', '🍪', '🎂', '🍰', '🥗', '🍝', '🍜', '🍱', '🍛', '🍣', '🍤', '🍗', '🥘', '🍲'];
                                    $emoji = $emojis[$menu->id % count($emojis)];
                                    $placeholderClass = 'menu-placeholder-' . (($menu->id % 12) + 1);
                                @endphp
                                <div class="menu-image-placeholder {{ $placeholderClass }}">
                                    <span style="filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2));">{{ $emoji }}</span>
                                </div>
                            @endif
                            
                            @if($menu->image)
                                <div class="menu-image-shine"></div>
                                <div class="menu-image-overlay"></div>
                            @endif
                            
                            <span class="menu-status-badge {{ $menu->is_available ? 'bg-available' : 'bg-unavailable' }}">
                                {{ $menu->is_available ? 'Tersedia' : 'Habis' }}
                            </span>
                        </div>
                        
                        <div class="menu-body">
                            <h5 class="menu-title">{{ $menu->name }}</h5>
                            <p class="menu-desc">{{ $menu->description }}</p>
                            
                            <div class="menu-footer">
                                <div class="menu-price">Rp {{ number_format($menu->price, 0, ',', '.') }}</div>
                                @auth
                                    @if($menu->is_available)
                                        @if($hasBookedRoom)
                                        <button class="btn-order" onclick="addToCart({{ $menu->id }}, this)">
                                            <i class="bi bi-cart-plus-fill"></i> Tambah
                                        </button>
                                        @else
                                        <button class="btn-order" onclick="showBookingAlert()">
                                            <i class="bi bi-cart-plus-fill"></i> Tambah
                                        </button>
                                        @endif
                                    @else
                                        <button class="btn-order" disabled>
                                            <i class="bi bi-x-circle-fill"></i> Habis
                                        </button>
                                    @endif
                                @else
                                    <a href="{{ route('customer.login') }}" class="btn-order">
                                        <i class="bi bi-box-arrow-in-right"></i> Login
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div style="font-size: 3.5rem;" class="text-muted mb-3"><i class="bi bi-egg-fried"></i></div>
                    <h5 class="fw-bold" style="color: var(--text);">Menu Belum Tersedia</h5>
                    <p class="text-muted">Kembali lagi nanti untuk menu terupdate.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

{{-- Floating Cart Button --}}
<button class="floating-cart" onclick="toggleCart()" id="cartFloatingBtn">
    <i class="bi bi-cart3"></i>
    <span class="cart-badge" id="cartCount">0</span>
</button>

{{-- Cart Sidebar --}}
<div class="offcanvas offcanvas-end cart-offcanvas" tabindex="-1" id="cartSidebar">
    <div class="offcanvas-header border-bottom py-3 px-4">
        <h5 class="offcanvas-title fw-bold" style="color: var(--text);"><i class="bi bi-cart3 text-primary me-2"></i> Keranjang Belanja</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column px-4">
        <div id="cartItems" class="flex-grow-1 overflow-auto"></div>
        <div class="pt-4 border-top mt-auto mb-2">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Total Pembayaran</span>
                <strong id="cartTotal" class="text-primary fs-4 fw-extrabold">Rp 0</strong>
            </div>
            <button class="btn btn-primary w-100 py-3 rounded-3 fw-bold" onclick="showCheckoutModal()">
                <i class="bi bi-credit-card-fill me-1"></i> Checkout Sekarang
            </button>
        </div>
    </div>
</div>

{{-- Order Type Modal --}}
<div class="modal fade" id="orderTypeModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custom-modal-content">
            <div class="modal-header bg-light border-bottom py-3 px-4">
                <h5 class="modal-title fw-bold" style="color:var(--text);"><i class="bi bi-file-text text-primary me-2"></i> Detail Pemesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3">
                    <label class="form-label fw-bold small text-uppercase" style="color:var(--text-muted);">Metode Pengantaran</label>
                    <select class="form-select form-select-lg rounded-3 fs-6" id="orderType" onchange="toggleOrderFields()">
                        <option value="dine_in">🍽️ Dine In (Makan di tempat / kamar)</option>
                        <option value="takeaway">🥡 Takeaway (Ambil sendiri di restoran)</option>
                    </select>
                </div>
                
                <div class="mb-3" id="tableNumberField">
                    <label class="form-label fw-bold small text-uppercase" style="color:var(--text-muted);">Nomor Kamar / Meja *</label>
                    <input type="text" class="form-control form-control-lg rounded-3 fs-6" id="tableNumber" placeholder="Contoh: Kamar 302">
                </div>

                <div class="mb-0">
                    <label class="form-label fw-bold small text-uppercase" style="color:var(--text-muted);">Catatan Tambahan (Opsional)</label>
                    <textarea class="form-control rounded-3" id="orderNotes" rows="2" placeholder="Contoh: Sendok plastik, tidak pedas, dll."></textarea>
                </div>
            </div>
            <div class="modal-footer bg-light border-top p-3">
                <button type="button" class="btn btn-outline-secondary px-4 py-2" data-bs-dismiss="modal">Kembali</button>
                <button type="button" class="btn btn-primary fw-bold px-4 py-2" onclick="processCheckout()">
                    <i class="bi bi-check-circle-fill"></i> Buat Pesanan
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Booking Required Alert Modal --}}
<div class="modal fade" id="bookingAlertModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border: none; border-radius: 24px; overflow: hidden; box-shadow: 0 25px 60px rgba(0,0,0,0.15);">
            <div class="text-center px-4 pt-5 pb-4" style="background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);">
                <div style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; box-shadow: 0 8px 24px rgba(245,158,11,0.3);">
                    <i class="bi bi-building" style="font-size: 2rem; color: #fff;"></i>
                </div>
                <h4 class="fw-bold mb-1" style="color: #92400E;">Booking Kamar Diperlukan</h4>
                <p style="color: #A16207; font-size: 0.9rem; font-family: var(--font-alt); max-width: 360px; margin: 0 auto;">Anda belum memesan kamar hotel. Silakan booking kamar terlebih dahulu untuk mengakses layanan restoran.</p>
            </div>
            <div class="text-center px-4 py-4" style="background: #FFFBEB;">
                <div style="display: flex; align-items: flex-start; gap: 12px; background: #fff; border-radius: 16px; padding: 16px; text-align: left; margin-bottom: 16px; border: 1px solid #FDE68A;">
                    <div style="width: 36px; height: 36px; border-radius: 10px; background: #EFF6FF; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="bi bi-info-circle" style="color: #0284C7; font-size: 1rem;"></i>
                    </div>
                    <div style="font-size: 0.82rem; color: #64748B; font-family: var(--font-alt); line-height: 1.5;">
                        Layanan restoran StayEase tersedia <strong style="color: #0F172A;">khusus untuk tamu hotel</strong> yang telah melakukan booking kamar.
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('rooms.index') }}" class="btn-se btn-se-primary flex-grow-1" style="padding: 12px 20px; font-size: 0.9rem;">
                        <i class="bi bi-building me-1"></i> Booking Kamar
                    </a>
                    <button type="button" class="btn-se btn-se-outline" style="padding: 12px 20px; font-size: 0.9rem;" data-bs-dismiss="modal">
                        Nanti
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let cart = [];

    function showBookingAlert() {
        const modal = new bootstrap.Modal(document.getElementById('bookingAlertModal'));
        modal.show();
    }
    
    function toggleCart() {
        const cartEl = document.getElementById('cartSidebar');
        const cartSidebar = new bootstrap.Offcanvas(cartEl);
        cartSidebar.show();
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateCartCount();
    });

    function showCheckoutModal() {
        if (cart.length === 0) {
            alert('Keranjang masih kosong');
            return;
        }
        const cartEl = document.getElementById('cartSidebar');
        const cartSidebar = bootstrap.Offcanvas.getInstance(cartEl);
        if (cartSidebar) cartSidebar.hide();
        
        setTimeout(() => {
            new bootstrap.Modal(document.getElementById('orderTypeModal')).show();
        }, 300);
    }

    function toggleOrderFields() {
        const orderType = document.getElementById('orderType').value;
        const tableField = document.getElementById('tableNumberField');
        if (orderType === 'dine_in') {
            tableField.classList.remove('d-none');
        } else if (orderType === 'takeaway') {
            tableField.classList.add('d-none');
        }
    }

    function processCheckout() {
        if (cart.length === 0) {
            alert('Keranjang masih kosong');
            return;
        }

        const orderType = document.getElementById('orderType').value;
        const orderNotes = document.getElementById('orderNotes').value;

        if (orderType === 'dine_in') {
            const tableNumber = document.getElementById('tableNumber').value;
            if (!tableNumber.trim()) {
                alert('Mohon masukkan nomor kamar/meja');
                return;
            }
        }

        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route('customer.restaurant.order.place') }}';
        
        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = '{{ csrf_token() }}';
        form.appendChild(csrf);

        cart.forEach(function(item, index) {
            const menuIdInput = document.createElement('input');
            menuIdInput.type = 'hidden';
            menuIdInput.name = 'items[' + index + '][menu_id]';
            menuIdInput.value = item.menu_id;
            form.appendChild(menuIdInput);

            const qtyInput = document.createElement('input');
            qtyInput.type = 'hidden';
            qtyInput.name = 'items[' + index + '][quantity]';
            qtyInput.value = item.quantity;
            form.appendChild(qtyInput);
        });

        const typeInput = document.createElement('input');
        typeInput.type = 'hidden';
        typeInput.name = 'order_type';
        typeInput.value = orderType;
        form.appendChild(typeInput);

        if (orderNotes) {
            const orderNotesInput = document.createElement('input');
            orderNotesInput.type = 'hidden';
            orderNotesInput.name = 'notes';
            orderNotesInput.value = orderNotes;
            form.appendChild(orderNotesInput);
        }

        if (orderType === 'dine_in') {
            const tableInput = document.createElement('input');
            tableInput.type = 'hidden';
            tableInput.name = 'table_number';
            tableInput.value = document.getElementById('tableNumber').value;
            form.appendChild(tableInput);
        }

        document.body.appendChild(form);
        form.submit();
    }

    // Store menus data for JavaScript
    const menusData = @json($menus->keyBy('id')->toArray());
    
    function addToCart(menuId, btn) {
        const item = menusData[menuId];
        
        if (!item) return;

        const existingItem = cart.find(i => i.menu_id === menuId);
        if (existingItem) {
            existingItem.quantity++;
        } else {
            cart.push({
                menu_id: menuId,
                name: item.name,
                price: item.price,
                quantity: 1
            });
        }

        updateCartUI();
        updateCartCount();
        
        if (btn) {
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="bi bi-check-circle-fill"></i> Ok';
            btn.style.background = '#10B981';
            btn.style.color = '#fff';
            btn.style.borderColor = '#10B981';
            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.style.background = '';
                btn.style.color = '';
                btn.style.borderColor = '';
            }, 800);
        }
    }

    function removeFromCart(menuId) {
        cart = cart.filter(i => i.menu_id !== menuId);
        updateCartUI();
        updateCartCount();
    }

    function updateCartUI() {
        const cartItems = document.getElementById('cartItems');
        const cartTotal = document.getElementById('cartTotal');
        
        if (cart.length === 0) {
            cartItems.innerHTML = '<div class="text-center py-5"><i class="bi bi-cart-x text-muted mb-2" style="font-size: 3rem;"></i><p class="text-muted">Keranjang kosong</p></div>';
            cartTotal.textContent = 'Rp 0';
            return;
        }

        let html = '<div class="d-flex flex-column gap-3">';
        let total = 0;

        cart.forEach(item => {
            const subtotal = item.price * item.quantity;
            total += subtotal;
            html += `
                <div class="cart-item-row">
                    <div style="max-width: 70%;">
                        <strong class="text-dark d-block text-truncate" style="font-size:0.95rem;">${item.name}</strong>
                        <span class="text-muted small">Rp ${item.price.toLocaleString('id-ID')} × ${item.quantity}</span>
                    </div>
                    <div class="text-end">
                        <span class="fw-bold text-dark d-block">Rp ${subtotal.toLocaleString('id-ID')}</span>
                        <button class="btn-trash ms-auto mt-1" onclick="removeFromCart(${item.menu_id})">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            `;
        });

        html += '</div>';
        cartItems.innerHTML = html;
        cartTotal.textContent = 'Rp ' + total.toLocaleString('id-ID');
    }

    function updateCartCount() {
        const count = cart.reduce((sum, item) => sum + item.quantity, 0);
        const el = document.getElementById('cartCount');
        if (el) el.textContent = count;
    }

    document.addEventListener('DOMContentLoaded', function() {
        toggleOrderFields();
    });

    // Category filter
    document.querySelectorAll('.category-badge').forEach(badge => {
        badge.addEventListener('click', function() {
            document.querySelectorAll('.category-badge').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const category = this.dataset.category;
            document.querySelectorAll('.menu-item').forEach(item => {
                if (category === 'all' || item.dataset.category === category) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
</script>
@endpush
@endsection