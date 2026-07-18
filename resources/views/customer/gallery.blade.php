@extends('customer.layouts.app')

@section('title', 'Galeri Hotel')

@push('styles')
<style>
    /* ─── Page Hero ─── */
    .page-hero {
        background: linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #0369A1 100%);
        padding: 80px 0 60px;
        position: relative;
        overflow: hidden;
    }
    .page-hero::before {
        content: '';
        position: absolute;
        width: 500px; height: 500px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(2,132,199,0.15) 0%, transparent 70%);
        top: -150px; right: -100px;
    }
    .page-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.15);
        color: rgba(255,255,255,0.8);
        padding: 6px 18px;
        border-radius: 100px;
        font-size: 0.8rem;
        font-weight: 500;
        margin-bottom: 20px;
        letter-spacing: 0.3px;
    }
    .page-hero h1 {
        font-size: 2.8rem;
        font-weight: 800;
        color: #fff;
        margin-bottom: 12px;
        letter-spacing: -0.5px;
    }
    .page-hero p {
        color: rgba(255,255,255,0.65);
        font-size: 1.05rem;
        margin-bottom: 0;
    }
    .breadcrumb-custom {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.85rem;
        margin-bottom: 20px;
    }
    .breadcrumb-custom a { color: rgba(255,255,255,0.5); text-decoration: none; transition: color 0.2s; }
    .breadcrumb-custom a:hover { color: #fff; }
    .breadcrumb-custom .sep { color: rgba(255,255,255,0.3); }
    .breadcrumb-custom .current { color: rgba(255,255,255,0.85); }

    /* ─── Filter Bar ─── */
    .filter-section {
        background: var(--bg-card);
        border-bottom: 1px solid var(--border);
        padding: 20px 0;
        position: sticky;
        top: var(--nav-height);
        z-index: 50;
        box-shadow: var(--shadow-sm);
    }
    .filter-pills {
        display: flex;
        gap: 10px;
        overflow-x: auto;
        padding-bottom: 4px;
        scrollbar-width: none;
    }
    .filter-pills::-webkit-scrollbar { display: none; }
    .filter-pill {
        flex-shrink: 0;
        padding: 8px 20px;
        border-radius: 100px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        border: 2px solid var(--border);
        background: var(--bg);
        color: var(--text-muted);
        transition: all 0.2s ease;
        white-space: nowrap;
    }
    .filter-pill:hover {
        border-color: var(--primary);
        color: var(--primary);
        background: var(--primary-light);
    }
    .filter-pill.active {
        background: var(--primary);
        border-color: var(--primary);
        color: #fff;
        box-shadow: 0 4px 12px rgba(2,132,199,0.3);
    }

    /* ─── Gallery Grid ─── */
    .gallery-section { padding: 48px 0 80px; background: var(--bg); }
    .gallery-grid {
        columns: 3;
        column-gap: 20px;
    }
    @media (max-width: 991px) { .gallery-grid { columns: 2; } }
    @media (max-width: 576px)  { .gallery-grid { columns: 1; } }

    .gallery-item-wrap {
        break-inside: avoid;
        margin-bottom: 20px;
        cursor: pointer;
    }
    .gallery-item-wrap.hide { display: none; }

    .gallery-card {
        border-radius: var(--radius-sm);
        overflow: hidden;
        position: relative;
        box-shadow: var(--shadow-sm);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .gallery-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
    }
    .gallery-card img {
        width: 100%;
        display: block;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .gallery-card:hover img { transform: scale(1.04); }
    .gallery-overlay {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.75) 0%, transparent 100%);
        padding: 28px 18px 16px;
        transform: translateY(10px);
        opacity: 0;
        transition: all 0.3s ease;
    }
    .gallery-card:hover .gallery-overlay { opacity: 1; transform: translateY(0); }
    .gallery-overlay h6 {
        color: #fff;
        font-weight: 700;
        margin-bottom: 4px;
        font-size: 0.95rem;
    }
    .gallery-overlay small {
        color: rgba(255,255,255,0.7);
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .gallery-zoom-icon {
        position: absolute;
        top: 14px; right: 14px;
        width: 36px; height: 36px;
        background: rgba(255,255,255,0.9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-dark);
        font-size: 1rem;
        opacity: 0;
        transform: scale(0.8);
        transition: all 0.3s ease;
    }
    .gallery-card:hover .gallery-zoom-icon { opacity: 1; transform: scale(1); }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
    }
    .empty-icon {
        width: 88px; height: 88px;
        background: var(--primary-light);
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: var(--primary);
        margin: 0 auto 20px;
    }

    /* Lightbox */
    .lightbox-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.92);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 24px;
        animation: fadeIn 0.25s ease;
    }
    .lightbox-overlay.active { display: flex; }
    .lightbox-img {
        max-width: 90vw;
        max-height: 85vh;
        border-radius: var(--radius-sm);
        object-fit: contain;
        box-shadow: 0 24px 64px rgba(0,0,0,0.5);
    }
    .lightbox-close {
        position: absolute;
        top: 20px; right: 24px;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        color: #fff;
        border-radius: 50%;
        width: 44px; height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 1.2rem;
        transition: background 0.2s;
    }
    .lightbox-close:hover { background: rgba(255,255,255,0.2); }
    .lightbox-caption {
        position: absolute;
        bottom: 24px; left: 50%;
        transform: translateX(-50%);
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.15);
        backdrop-filter: blur(8px);
        padding: 10px 24px;
        border-radius: 100px;
        color: #fff;
        font-size: 0.9rem;
        font-weight: 500;
        white-space: nowrap;
    }

    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    .animate-up { animation: slideUp 0.4s ease forwards; }

    @media (max-width: 768px) {
        .page-hero h1 { font-size: 1.8rem; }
        .gallery-section { padding: 24px 0; }
    }
</style>
@endpush

@section('content')
{{-- Hero --}}
<div class="page-hero">
    <div class="container">
        <div class="breadcrumb-custom">
            <a href="{{ route('home') }}"><i class="bi bi-house"></i> Beranda</a>
            <span class="sep"><i class="bi bi-chevron-right" style="font-size:0.7rem;"></i></span>
            <span class="current">Galeri</span>
        </div>
        <div class="page-hero-badge">
            <i class="bi bi-images" style="font-size:0.8rem;"></i>
            Foto Hotel & Fasilitas
        </div>
        <h1>Galeri Hotel</h1>
        <p>Jelajahi keindahan fasilitas dan kamar premium kami melalui koleksi foto eksklusif</p>
    </div>
</div>

@php
    $galleries = \App\Models\LandingPageGallery::orderBy('order')->get();
    $categories = $galleries->pluck('category')->unique()->filter();
@endphp

{{-- Filter Bar --}}
@if($categories->count() > 0)
<div class="filter-section">
    <div class="container">
        <div class="filter-pills">
            <button class="filter-pill active" data-filter="all">
                <i class="bi bi-grid-3x3-gap me-1"></i> Semua
                <span style="background:rgba(255,255,255,0.25);padding:1px 7px;border-radius:20px;margin-left:6px;font-size:0.78rem;">{{ $galleries->count() }}</span>
            </button>
            @foreach($categories as $category)
                <button class="filter-pill" data-filter="{{ $category }}">
                    {{ ucfirst($category) }}
                    <span style="background:rgba(0,0,0,0.08);padding:1px 7px;border-radius:20px;margin-left:6px;font-size:0.78rem;">{{ $galleries->where('category', $category)->count() }}</span>
                </button>
            @endforeach
        </div>
    </div>
</div>
@endif

{{-- Gallery Grid --}}
<div class="gallery-section">
    <div class="container">
        @if($galleries->count() > 0)
            <div class="gallery-grid" id="galleryGrid">
                @foreach($galleries as $gallery)
                    <div class="gallery-item-wrap" data-category="{{ $gallery->category }}" onclick="openLightbox('{{ asset('storage/' . $gallery->image) }}', '{{ $gallery->title }}', '{{ ucfirst($gallery->category) }}')">
                        <div class="gallery-card">
                            <img src="{{ asset('storage/' . $gallery->image) }}"
                                 alt="{{ $gallery->title }}"
                                 loading="lazy"
                                 onerror="this.src='https://images.unsplash.com/photo-1566073771259-6a8506099945?w=600&q=80'">
                            <div class="gallery-overlay">
                                <h6>{{ $gallery->title }}</h6>
                                @if($gallery->category)
                                    <small>{{ ucfirst($gallery->category) }}</small>
                                @endif
                            </div>
                            <div class="gallery-zoom-icon">
                                <i class="bi bi-arrows-fullscreen"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon"><i class="bi bi-images"></i></div>
                <h5 style="font-weight:700;color:var(--text);">Galeri Segera Hadir</h5>
                <p style="color:var(--text-muted);">Foto-foto fasilitas hotel akan ditambahkan segera.</p>
            </div>
        @endif
    </div>
</div>

{{-- Lightbox --}}
<div class="lightbox-overlay" id="lightbox" onclick="closeLightbox(event)">
    <button class="lightbox-close" onclick="closeLightbox()"><i class="bi bi-x-lg"></i></button>
    <img class="lightbox-img" id="lightboxImg" src="" alt="">
    <div class="lightbox-caption" id="lightboxCaption"></div>
</div>

@push('scripts')
<script>
// Filter
document.querySelectorAll('.filter-pill').forEach(pill => {
    pill.addEventListener('click', function() {
        document.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('active'));
        this.classList.add('active');
        const filter = this.dataset.filter;
        document.querySelectorAll('.gallery-item-wrap').forEach(item => {
            const show = filter === 'all' || item.dataset.category === filter;
            item.classList.toggle('hide', !show);
        });
    });
});

// Lightbox
function openLightbox(src, title, category) {
    document.getElementById('lightboxImg').src = src;
    document.getElementById('lightboxCaption').textContent = category ? `${title} · ${category}` : title;
    document.getElementById('lightbox').classList.add('active');
    document.body.style.overflow = 'hidden';
}
function closeLightbox(e) {
    if (!e || e.target === document.getElementById('lightbox') || e.currentTarget.classList.contains('lightbox-close')) {
        document.getElementById('lightbox').classList.remove('active');
        document.body.style.overflow = '';
    }
}
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });
</script>
@endpush
@include('customer.partials.footer')
@endsection
