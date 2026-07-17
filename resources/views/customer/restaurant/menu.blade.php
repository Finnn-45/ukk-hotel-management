@extends('customer.layouts.app')

@section('title', 'Restoran Hotel - StayEase')

@push('styles')
<style>
    /* ─── Restaurant Hero ─── */
    .restaurant-hero {
        position: relative;
        min-height: 45vh;
        background: linear-gradient(135deg, #1e3a8a 0%, #0369A1 50%, #0284C7 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        padding: 80px 20px;
        overflow: hidden;
    }
    .restaurant-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=1920&q=80') center/cover;
        opacity: 0.1;
    }
    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 700px;
    }
    .hero-content h1 {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 16px;
        letter-spacing: -1px;
    }
    .hero-content p {
        font-size: 1rem;
        color: rgba(255,255,255,0.85);
        line-height: 1.6;
    }

    /* ─── About Section ─── */
    .about-section {
        padding: 60px 0;
        background: #fff;
    }
    .about-card {
        background: linear-gradient(135deg, #F0F9FF 0%, #E0F2FE 100%);
        border: 1px solid #BAE6FD;
        border-radius: 20px;
        padding: 40px;
        display: flex;
        align-items: center;
        gap: 30px;
    }
    .about-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #0284C7, #0369A1);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        flex-shrink: 0;
        box-shadow: 0 8px 20px rgba(2,132,199,0.3);
    }
    .about-text h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0F172A;
        margin-bottom: 12px;
    }
    .about-text p {
        color: #475569;
        line-height: 1.7;
        margin: 0;
    }

    /* ─── Promotions Section ─── */
    .promo-section {
        padding: 50px 0;
        background: #F8FAFC;
    }
    .section-title {
        font-size: 1.75rem;
        font-weight: 800;
        color: #0F172A;
        margin-bottom: 8px;
        text-align: center;
    }
    .section-subtitle {
        text-align: center;
        color: #64748B;
        margin-bottom: 32px;
    }
    .promo-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
    }
    .promo-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: all 0.3s;
        border: 1px solid #E2E8F0;
    }
    .promo-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.15);
    }
    .promo-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    .promo-body {
        padding: 20px;
    }
    .promo-badge {
        display: inline-block;
        background: linear-gradient(135deg, #FBBF24, #F59E0B);
        color: #fff;
        padding: 4px 12px;
        border-radius: 100px;
        font-size: 0.75rem;
        font-weight: 700;
        margin-bottom: 8px;
    }
    .promo-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #0F172A;
        margin-bottom: 6px;
    }
    .promo-desc {
        font-size: 0.85rem;
        color: #64748B;
        margin-bottom: 12px;
    }
    .promo-price {
        font-size: 1.25rem;
        font-weight: 800;
        color: #0284C7;
    }
    .promo-price del {
        font-size: 0.9rem;
        color: #94A3B8;
        margin-left: 8px;
        font-weight: 500;
    }

    /* ─── Menu Section ─── */
    .menu-section {
        padding: 60px 0 100px;
        background: #fff;
    }

    /* Search & Filter Bar */
    .menu-toolbar {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }
    .search-box {
        position: relative;
        margin-bottom: 16px;
    }
    .search-box input {
        width: 100%;
        padding: 12px 16px 12px 44px;
        border: 1.5px solid #E2E8F0;
        border-radius: 12px;
        font-size: 0.95rem;
        transition: all 0.2s;
    }
    .search-box input:focus {
        outline: none;
        border-color: #0284C7;
        box-shadow: 0 0 0 4px rgba(2,132,199,0.08);
    }
    .search-box i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #64748B;
    }
    .filter-row {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    .filter-select {
        flex: 1;
        min-width: 150px;
        padding: 10px 14px;
        border: 1.5px solid #E2E8F0;
        border-radius: 10px;
        font-size: 0.9rem;
        background: #fff;
        cursor: pointer;
    }
    .filter-select:focus {
        outline: none;
        border-color: #0284C7;
    }

    .menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 24px;
    }
    .menu-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }
    .menu-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.12);
        border-color: transparent;
    }
    .menu-image-container {
        position: relative;
        width: 100%;
        height: 220px;
        overflow: hidden;
        background: #F1F5F9;
    }
    .menu-card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }
    .menu-card:hover .menu-card-img {
        transform: scale(1.08);
    }
    .menu-image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .menu-status-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        padding: 6px 14px;
        border-radius: 100px;
        font-size: 0.72rem;
        font-weight: 700;
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
    .menu-body {
        padding: 20px;
    }
    .menu-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #0F172A;
        margin-bottom: 6px;
    }
    .menu-desc {
        font-size: 0.85rem;
        color: #64748B;
        margin-bottom: 12px;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .menu-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 12px;
        border-top: 1px solid #E2E8F0;
    }
    .menu-price {
        font-size: 1.2rem;
        font-weight: 800;
        color: #0284C7;
    }
    .btn-order {
        background: linear-gradient(135deg, #0284C7, #0369A1);
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 10px 20px;
        font-size: 0.88rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.3s;
        box-shadow: 0 4px 14px rgba(2,132,199,0.25);
    }
    .btn-order:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(2,132,199,0.4);
    }
    .btn-order:disabled {
        background: #E2E8F0;
        color: #94A3B8;
        cursor: not-allowed;
        box-shadow: none;
    }

    /* ─── Floating Cart ─── */
    .floating-cart {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #0284C7, #0369A1);
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        box-shadow: 0 12px 32px rgba(2,132,199,0.45);
        cursor: pointer;
        z-index: 999;
        border: none;
        animation: pulse 2s ease-in-out infinite;
    }
    @keyframes pulse {
        0%, 100% { box-shadow: 0 12px 32px rgba(2,132,199,0.45); }
        50% { box-shadow: 0 12px 40px rgba(2,132,199,0.65); }
    }
    .floating-cart:hover {
        transform: translateY(-6px) scale(1.08);
        animation: none;
    }
    .cart-badge {
        position: absolute;
        top: -6px;
        right: -6px;
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: linear-gradient(135deg, #EF4444, #DC2626);
        color: #fff;
        font-size: 0.75rem;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.5);
        border: 2px solid #fff;
    }

    /* ─── Responsive ─── */
    @media (max-width: 768px) {
        .hero-content h1 { font-size: 1.8rem; }
        .hero-content p { font-size: 0.9rem; }
        .about-card {
            flex-direction: column;
            text-align: center;
            padding: 30px 20px;
        }
        .about-icon {
            width: 60px;
            height: 60px;
            font-size: 2rem;
        }
        .menu-grid {
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 16px;
        }
        .menu-image-container {
            height: 180px;
        }
        .floating-cart {
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            font-size: 1.4rem;
        }
    }
    @media (max-width: 480px) {
        .restaurant-hero {
            min-height: 35vh;
            padding: 60px 16px;
        }
        .hero-content h1 {
            font-size: 1.5rem;
        }
        .menu-grid {
            grid-template-columns: 1fr;
        }
        .promo-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
{{-- Hero --}}
<div class="restaurant-hero">
    <div class="hero-content">
        <h1>🍽️ Restoran StayEase</h1>
        <p>Nikmati hidangan lezat dari chef profesional kami dengan bahan-bahan pilihan terbaik.</p>
    </div>
</div>

{{-- About Section --}}
<div class="about-section">
    <div class="container">
        <div class="about-card">
            <div class="about-icon">👨‍🍳</div>
            <div class="about-text">
                <h3>Tentang Restoran Kami</h3>
                <p>Restoran StayEase menawarkan pengalaman kuliner yang tak terlupakan dengan menu fusion Asia-Eropa yang dibuat oleh chef berpengalaman. Setiap hidangan disajikan dengan penuh dedikasi menggunakan bahan-bahan segar pilihan untuk memastikan kualitas terbaik untuk Anda.</p>
            </div>
        </div>
    </div>
</div>

{{-- Promotions Section --}}
<div class="promo-section">
    <div class="container">
        <h2 class="section-title">🔥 Promo Spesial</h2>
        <p class="section-subtitle">Penawaran eksklusif untuk Anda</p>

        <div class="promo-grid">
            <div class="promo-card">
                <img src="https://images.unsplash.com/photo-1544025162-d76694265947?w=600&q=80" alt="Weekend Dinner" class="promo-image">
                <div class="promo-body">
                    <span class="promo-badge">HOT</span>
                    <div class="promo-title">Weekend Dinner Special</div>
                    <div class="promo-desc">Set menu dinner untuk 2 orang dengan pemandangan city view</div>
                    <div class="promo-price">Rp 350.000 <del>Rp 500.000</del></div>
                </div>
            </div>

            <div class="promo-card">
                <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?w=600&q=80" alt="Lunch Set" class="promo-image">
                <div class="promo-body">
                    <span class="promo-badge">NEW</span>
                    <div class="promo-title">Business Lunch Set</div>
                    <div class="promo-desc">Paket lunch hemat untuk pelaku bisnis, Senin-Jumat</div>
                    <div class="promo-price">Rp 85.000 <del>Rp 120.000</del></div>
                </div>
            </div>

            <div class="promo-card">
                <img src="https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=600&q=80" alt="Breakfast" class="promo-image">
                <div class="promo-body">
                    <span class="promo-badge">SAVE 30%</span>
                    <div class="promo-title">Breakfast Paradise</div>
                    <div class="promo-desc">Breakfast buffet dengan pilihan menu internasional</div>
                    <div class="promo-price">Rp 150.000 <del>Rp 220.000</del></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Menu Section --}}
<div class="menu-section">
    <div class="container">
        <h2 class="section-title">Menu Kami</h2>
        <p class="section-subtitle">Pilihan hidangan terbaik dari chef kami</p>

        {{-- Search & Filter Toolbar --}}
        <div class="menu-toolbar">
            <div class="search-box">
                <i class="bi bi-search"></i>
                <input type="text" id="searchInput" placeholder="Cari menu favorit Anda...">
            </div>
            <div class="filter-row">
                <select class="filter-select" id="categoryFilter">
                    <option value="all">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}">{{ ucfirst($category) }}</option>
                    @endforeach
                </select>
                <select class="filter-select" id="sortFilter">
                    <option value="default">Urutkan: Default</option>
                    <option value="price-asc">Harga: Rendah ke Tinggi</option>
                    <option value="price-desc">Harga: Tinggi ke Rendah</option>
                    <option value="name-asc">Nama: A-Z</option>
                </select>
            </div>
        </div>

        <div class="menu-grid" id="menuGrid">
            @forelse($menus as $menu)
                <div class="menu-item" data-category="{{ $menu->category }}" data-price="{{ $menu->price }}" data-name="{{ strtolower($menu->name) }}">
                    <div class="menu-card">
                        <div class="menu-image-container">
                            @if($menu->image)
                                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="menu-card-img" loading="lazy">
                            @else
                                @php
                                    $foodImages = [
                                        'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=600&q=80',
                                        'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=600&q=80',
                                        'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=600&q=80',
                                        'https://images.unsplash.com/photo-1551782450-17144efb9c50?w=600&q=80',
                                        'https://images.unsplash.com/photo-1579584425555-c3ce17fd4351?w=600&q=80',
                                        'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?w=600&q=80',
                                        'https://images.unsplash.com/photo-1563379926898-05f4575a45d8?w=600&q=80',
                                        'https://images.unsplash.com/photo-1555126634-323283e090fa?w=600&q=80',
                                        'https://images.unsplash.com/photo-1606491956689-2ea866880c84?w=600&q=80',
                                        'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=600&q=80',
                                        'https://images.unsplash.com/photo-1569718212165-515a7cb661fc?w=600&q=80',
                                        'https://images.unsplash.com/photo-1551504734-5ee1c4a1479b?w=600&q=80',
                                        'https://images.unsplash.com/photo-1512058564366-18510be2db19?w=600&q=80',
                                        'https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=600&q=80',
                                        'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=600&q=80',
                                        'https://images.unsplash.com/photo-1565299507177-b0ac66763828?w=600&q=80',
                                        'https://images.unsplash.com/photo-1551232864-3f0890e580d9?w=600&q=80',
                                        'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?w=600&q=80',
                                        'https://images.unsplash.com/photo-1588166524941-3bf61a9c41db?w=600&q=80',
                                        'https://images.unsplash.com/photo-1563379926898-05f4575a45d8?w=600&q=80',
                                    ];
                                    $imageUrl = $foodImages[$menu->id % count($foodImages)];
                                @endphp
                                <img src="{{ $imageUrl }}" alt="{{ $menu->name }}" class="menu-card-img" loading="lazy">
                            @endif
                            <span class="menu-status-badge {{ $menu->is_available ? 'bg-available' : 'bg-unavailable' }}">
                                {{ $menu->is_available ? 'Tersedia' : 'Habis' }}
                            </span>
                        </div>
                        <div class="menu-body">
                            <div class="menu-title">{{ $menu->name }}</div>
                            <div class="menu-desc">{{ $menu->description }}</div>
                            <div class="menu-footer">
                                <div class="menu-price">Rp {{ number_format($menu->price, 0, ',', '.') }}</div>
                                @auth
                                    @if($menu->is_available)
                                        @if($hasBookedRoom)
                                            <button class="btn-order" onclick="addToCart({{ $menu->id }}, this)">
                                                <i class="bi bi-cart-plus-fill"></i> Tambah
                                            </button>
                                        @else
                                            <button class="btn-order" disabled title="Booking kamar terlebih dahulu">
                                                <i class="bi bi-lock-fill"></i>
                                            </button>
                                        @endif
                                    @else
                                        <button class="btn-order" disabled>Habis</button>
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
                    <h5 class="text-muted">Menu Belum Tersedia</h5>
                    <p class="text-muted">Kembali lagi nanti untuk menu terupdate.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

{{-- Floating Cart Button --}}
@auth
    @if($hasBookedRoom)
        <button class="floating-cart" onclick="toggleCart()">
            <i class="bi bi-cart-fill"></i>
            <span class="cart-badge" id="cartBadge" style="display: none;">0</span>
        </button>
    @endif
@endauth

{{-- Dining Preference Modal --}}
<div class="modal fade" id="diningModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">🍽️ Pilihan Makan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted mb-3">Silakan pilih cara Anda ingin menikmati makanan:</p>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Opsi Makan:</label>
                    <div class="d-flex flex-column gap-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="order_type" id="dineIn" value="dine_in" checked>
                            <label class="form-check-label" for="dineIn">
                                <strong>🍴 Dine In</strong> - Makan di restoran
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="order_type" id="takeaway" value="takeaway">
                            <label class="form-check-label" for="takeaway">
                                <strong>📦 Takeaway</strong> - Bawa pulang
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="order_type" id="delivery" value="delivery">
                            <label class="form-check-label" for="delivery">
                                <strong>🚚 Delivery</strong> - Dikirim ke kamar
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mb-3" id="roomNumberField">
                    <label for="tableNumber" class="form-label fw-semibold">Nomor Kamar <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="tableNumber" placeholder="Contoh: 101, 205, dll">
                    <small class="text-muted">Masukkan nomor kamar Anda untuk room service</small>
                </div>

                <div class="mb-3">
                    <label for="addons" class="form-label fw-semibold">Tambahan / Permintaan Khusus</label>
                    <textarea class="form-control" id="addons" rows="3" placeholder="Contoh: Tanpa pedas, extra saos, dll"></textarea>
                </div>

                <div class="mb-3">
                    <label for="orderNotes" class="form-label fw-semibold">Catatan Lainnya</label>
                    <textarea class="form-control" id="orderNotes" rows="2" placeholder="Catatan tambahan (opsional)"></textarea>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="confirmOrder()">
                    <i class="bi bi-check-circle"></i> Konfirmasi Pesanan
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Cart Sidebar --}}
<div class="offcanvas offcanvas-end cart-offcanvas" tabindex="-1" id="cartOffcanvas">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Keranjang Belanja</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <div id="cartItems">
            <p class="text-muted text-center py-4">Keranjang kosong</p>
        </div>
        <div id="cartFooter" style="display: none; margin-top: 20px; padding-top: 20px; border-top: 1px solid #E2E8F0;">
            <div class="d-flex justify-content-between mb-3">
                <strong>Total:</strong>
                <strong id="cartTotal" style="color: #0284C7; font-size: 1.2rem;">Rp 0</strong>
            </div>
            <button class="btn-order w-100" onclick="checkout()">
                <i class="bi bi-check-circle-fill"></i> Checkout
            </button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
let cart = [];

function toggleCart() {
    const offcanvas = new bootstrap.Offcanvas(document.getElementById('cartOffcanvas'));
    offcanvas.toggle();
}

function addToCart(menuId, btn) {
    const item = menusData[menuId];
    if (!item) return;

    const existingItem = cart.find(i => i.menu_id === menuId);
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({
            menu_id: menuId,
            name: item.name,
            price: item.price,
            quantity: 1
        });
    }

    updateCartUI();

    // Button feedback
    const originalHTML = btn.innerHTML;
    btn.innerHTML = '<i class="bi bi-check-circle-fill"></i> Ditambahkan';
    btn.disabled = true;
    setTimeout(() => {
        btn.innerHTML = originalHTML;
        btn.disabled = false;
    }, 1500);
}

function removeFromCart(menuId) {
    cart = cart.filter(i => i.menu_id !== menuId);
    updateCartUI();
}

function updateCartUI() {
    const cartItems = document.getElementById('cartItems');
    const cartBadge = document.getElementById('cartBadge');
    const cartFooter = document.getElementById('cartFooter');
    const cartTotal = document.getElementById('cartTotal');

    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    const totalPrice = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);

    // Update badge
    if (totalItems > 0) {
        cartBadge.style.display = 'flex';
        cartBadge.textContent = totalItems;
    } else {
        cartBadge.style.display = 'none';
    }

    // Update cart items
    if (cart.length === 0) {
        cartItems.innerHTML = '<p class="text-muted text-center py-4">Keranjang kosong</p>';
        cartFooter.style.display = 'none';
    } else {
        cartItems.innerHTML = cart.map(item => `
            <div class="cart-item-row">
                <div>
                    <div style="font-weight: 600; font-size: 0.95rem; color: #0F172A;">${item.name}</div>
                    <small class="text-muted">Qty: x${item.quantity}</small>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <strong style="color: #0284C7;">Rp ${(item.price * item.quantity).toLocaleString('id-ID')}</strong>
                    <button class="btn-trash" onclick="removeFromCart(${item.menu_id})">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        `).join('');
        cartFooter.style.display = 'block';
        cartTotal.textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
    }
}

function checkout() {
    if (cart.length === 0) {
        alert('Keranjang belanja kosong!');
        return;
    }

    // Show dining preference modal
    const modal = new bootstrap.Modal(document.getElementById('diningModal'));
    modal.show();
}

function confirmOrder() {
    const orderType = document.querySelector('input[name="order_type"]:checked').value;
    const tableNumber = document.getElementById('tableNumber').value;
    const notes = document.getElementById('orderNotes').value;
    const addons = document.getElementById('addons').value;

    if (orderType === 'dine_in' && !tableNumber) {
        alert('Silakan masukkan nomor kamar Anda');
        return;
    }

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route("customer.restaurant.order.place") }}';

    const csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = '{{ csrf_token() }}';
    form.appendChild(csrfInput);

    cart.forEach((item, index) => {
        const menuIdInput = document.createElement('input');
        menuIdInput.type = 'hidden';
        menuIdInput.name = `items[${index}][menu_id]`;
        menuIdInput.value = item.menu_id;
        form.appendChild(menuIdInput);

        const qtyInput = document.createElement('input');
        qtyInput.type = 'hidden';
        qtyInput.name = `items[${index}][quantity]`;
        qtyInput.value = item.quantity;
        form.appendChild(qtyInput);
    });

    const orderTypeInput = document.createElement('input');
    orderTypeInput.type = 'hidden';
    orderTypeInput.name = 'order_type';
    orderTypeInput.value = orderType;
    form.appendChild(orderTypeInput);

    if (orderType === 'dine_in') {
        const tableInput = document.createElement('input');
        tableInput.type = 'hidden';
        tableInput.name = 'table_number';
        tableInput.value = tableNumber;
        form.appendChild(tableInput);
    }

    const notesInput = document.createElement('input');
    notesInput.type = 'hidden';
    notesInput.name = 'notes';
    notesInput.value = (notes + (addons ? '\nTambahan: ' + addons : '')).trim();
    form.appendChild(notesInput);

    document.body.appendChild(form);
    form.submit();

    // Hide modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('diningModal'));
    modal.hide();
}

// Store menus data for JavaScript
const menusData = @json($menus->keyBy('id')->toArray());

// Search, Filter, Sort functionality
const searchInput = document.getElementById('searchInput');
const categoryFilter = document.getElementById('categoryFilter');
const sortFilter = document.getElementById('sortFilter');

function filterAndSortMenus() {
    const searchTerm = searchInput.value.toLowerCase();
    const selectedCategory = categoryFilter.value;
    const sortType = sortFilter.value;

    const menuItems = document.querySelectorAll('.menu-item');

    menuItems.forEach(item => {
        const name = item.dataset.name;
        const category = item.dataset.category;
        const price = parseInt(item.dataset.price);

        // Search filter
        const matchesSearch = name.includes(searchTerm);

        // Category filter
        const matchesCategory = selectedCategory === 'all' || category === selectedCategory;

        // Show/hide based on filters
        if (matchesSearch && matchesCategory) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });

    // Sort visible items
    const visibleItems = Array.from(menuItems).filter(item => item.style.display !== 'none');

    visibleItems.sort((a, b) => {
        const priceA = parseInt(a.dataset.price);
        const priceB = parseInt(b.dataset.price);
        const nameA = a.dataset.name;
        const nameB = b.dataset.name;

        switch(sortType) {
            case 'price-asc':
                return priceA - priceB;
            case 'price-desc':
                return priceB - priceA;
            case 'name-asc':
                return nameA.localeCompare(nameB);
            default:
                return 0;
        }
    });

    // Reorder in DOM
    const menuGrid = document.getElementById('menuGrid');
    visibleItems.forEach(item => menuGrid.appendChild(item));
}

// Event listeners
searchInput.addEventListener('input', filterAndSortMenus);
categoryFilter.addEventListener('change', filterAndSortMenus);
sortFilter.addEventListener('change', filterAndSortMenus);
</script>
@endpush
