<?php $__env->startSection('title', 'StayEase — Discover Your Perfect Stay'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* ════════════════════════════════════════
       HOME — Nordic Minimalist Luxury
       ════════════════════════════════════════ */

    /* ─── HERO ─── */
    .se-hero {
        position: relative;
        background: linear-gradient(135deg, #0F172A 0%, #1E3A5F 50%, #1D4ED8 100%);
        min-height: 580px;
        display: flex;
        align-items: center;
        overflow: hidden;
        padding: 56px 0 96px;
    }
    .se-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('https://images.unsplash.com/photo-1566073771259-6a8506099945?w=1600&q=80') center/cover;
        opacity: 0.08;
        z-index: 0;
    }
    .se-hero::after {
        content: '';
        position: absolute;
        top: -200px;
        right: -100px;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(37,99,235,0.15) 0%, transparent 70%);
        border-radius: 50%;
        z-index: 0;
    }
    .se-hero-content { position: relative; z-index: 2; }

    .se-hero-subtitle {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: var(--radius-full);
        padding: 6px 16px;
        color: rgba(255,255,255,0.7);
        font-size: 0.8rem;
        font-weight: 500;
        letter-spacing: 0.5px;
        margin-bottom: 24px;
    }
    .se-hero-subtitle i { color: #F59E0B; }

    .se-hero h1 {
        font-size: 3.2rem;
        font-weight: 800;
        color: #fff;
        line-height: 1.12;
        letter-spacing: -1.5px;
        margin-bottom: 20px;
    }
    .se-hero h1 .highlight {
        background: linear-gradient(135deg, #60A5FA 0%, #F59E0B 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .se-hero-desc {
        color: rgba(255,255,255,0.55);
        font-size: 1rem;
        line-height: 1.7;
        max-width: 480px;
        margin-bottom: 32px;
    }

    .se-hero-cta {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: #fff;
        color: var(--primary);
        border: none;
        border-radius: var(--radius-sm);
        padding: 14px 32px;
        font-weight: 700;
        font-size: 0.95rem;
        text-decoration: none;
        transition: all var(--transition);
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    }
    .se-hero-cta:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.2);
        color: var(--primary);
    }
    .se-hero-cta i { transition: transform var(--transition); }
    .se-hero-cta:hover i { transform: translateX(4px); }

    /* Hero Image */
    .se-hero-image {
        position: relative;
    }
    .se-hero-image img {
        width: 100%;
        height: 420px;
        object-fit: cover;
        border-radius: var(--radius);
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    }
    .se-hero-image-badge {
        position: absolute;
        bottom: 20px;
        left: 20px;
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(10px);
        border-radius: var(--radius-sm);
        padding: 12px 18px;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
    }
    .se-hero-image-badge i { color: var(--primary); font-size: 1.25rem; }
    .se-hero-image-badge .label { font-size: 0.75rem; font-weight: 700; color: var(--text); }
    .se-hero-image-badge .sub { font-size: 0.68rem; color: var(--text-muted); }

    /* Hero Stats */
    .se-hero-stats {
        display: flex;
        gap: 40px;
        margin-top: 40px;
    }
    .se-hero-stat h3 {
        color: #fff;
        font-size: 1.6rem;
        font-weight: 800;
        margin-bottom: 2px;
        letter-spacing: -0.5px;
    }
    .se-hero-stat p {
        color: rgba(255,255,255,0.4);
        font-size: 0.78rem;
        font-weight: 500;
        margin: 0;
    }

    /* ─── FLOATING SEARCH ─── */
    .se-floating-search {
        position: relative;
        z-index: 3;
        margin-top: -56px;
    }
    .se-search-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 28px 32px;
        box-shadow: var(--shadow-lg);
    }
    .se-search-card label {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
        display: block;
    }
    .se-search-card .form-control,
    .se-search-card .form-select {
        border: 1.5px solid var(--border);
        border-radius: var(--radius-sm);
        padding: 11px 16px;
        font-size: 0.9rem;
        font-family: var(--font);
        transition: all var(--transition);
        color: var(--text);
        background-color: #fff;
    }
    .se-search-card .form-control:focus,
    .se-search-card .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37,99,235,0.08);
    }
    .se-search-card .btn-search {
        background: var(--primary-gradient);
        color: #fff;
        border: none;
        border-radius: var(--radius-sm);
        padding: 12px 32px;
        font-weight: 700;
        font-size: 0.9rem;
        transition: all var(--transition);
        box-shadow: 0 2px 12px rgba(37,99,235,0.3);
        height: 100%;
        white-space: nowrap;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .se-search-card .btn-search:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(37,99,235,0.4);
    }

    /* ─── SECTION SPACING ─── */
    .se-section {
        padding: 80px 0;
    }
    .se-section-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 32px;
        flex-wrap: wrap;
        gap: 12px;
    }
    .se-section-header .se-link {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--primary);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: gap var(--transition);
    }
    .se-section-header .se-link:hover { gap: 10px; }

    /* ─── HOTEL CARD ─── */
    .se-hotel-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .se-hotel-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-md);
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
        transition: transform 0.5s ease;
    }
    .se-hotel-card:hover .se-hotel-card-img img { transform: scale(1.06); }
    .se-hotel-card-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(255,255,255,0.92);
        backdrop-filter: blur(8px);
        color: var(--text);
        padding: 4px 12px;
        border-radius: var(--radius-full);
        font-size: 0.7rem;
        font-weight: 600;
    }
    .se-hotel-card-price {
        position: absolute;
        bottom: 12px;
        right: 12px;
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(8px);
        padding: 5px 14px;
        border-radius: var(--radius-sm);
        font-weight: 800;
        font-size: 0.88rem;
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
        font-size: 0.78rem;
        color: var(--text-muted);
        margin-bottom: 10px;
    }
    .se-hotel-card-rating {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 12px;
    }
    .se-hotel-card-rating .score {
        background: var(--primary-gradient);
        color: #fff;
        font-weight: 700;
        font-size: 0.72rem;
        padding: 3px 8px;
        border-radius: var(--radius-xs);
    }
    .se-hotel-card-rating .label {
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--text);
    }
    .se-hotel-card-rating .count {
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
        border-radius: var(--radius-xs);
        padding: 3px 10px;
        font-size: 0.68rem;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* ─── ROOM TYPE CHIPS ─── */
    .se-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 32px;
    }
    .se-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 20px;
        border-radius: var(--radius-full);
        border: 1.5px solid var(--border);
        background: #fff;
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--text-secondary);
        text-decoration: none;
        transition: all var(--transition);
        cursor: pointer;
    }
    .se-chip:hover, .se-chip.active {
        border-color: var(--primary);
        color: var(--primary);
        background: var(--primary-light);
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(37,99,235,0.12);
    }
    .se-chip i { font-size: 0.9rem; }

    /* ─── FEATURED BANNER ─── */
    .se-featured-banner {
        background: linear-gradient(135deg, #0F172A 0%, #1E3A5F 100%);
        border-radius: var(--radius);
        padding: 48px;
        position: relative;
        overflow: hidden;
    }
    .se-featured-banner::before {
        content: '';
        position: absolute;
        top: -40%;
        right: -15%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(37,99,235,0.2) 0%, transparent 70%);
        border-radius: 50%;
    }
    .se-featured-banner::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(245,158,11,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }
    .se-featured-banner > * { position: relative; z-index: 1; }
    .se-featured-banner h2 {
        font-weight: 800;
        font-size: 2rem;
        color: #fff;
        margin-bottom: 12px;
        letter-spacing: -0.5px;
    }
    .se-featured-banner p {
        color: rgba(255,255,255,0.5);
        font-size: 0.95rem;
        max-width: 420px;
        margin-bottom: 24px;
        line-height: 1.7;
    }
    .se-featured-banner .btn-cta {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #fff;
        color: var(--primary);
        border: none;
        border-radius: var(--radius-sm);
        padding: 12px 28px;
        font-weight: 700;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all var(--transition);
    }
    .se-featured-banner .btn-cta:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        color: var(--primary);
    }
    .se-featured-banner-img img {
        width: 100%;
        height: 280px;
        object-fit: cover;
        border-radius: var(--radius-sm);
        box-shadow: 0 12px 40px rgba(0,0,0,0.3);
    }

    /* ─── RESTAURANT CARD ─── */
    .se-resto-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
    }
    .se-resto-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-md);
        border-color: transparent;
    }
    .se-resto-card-img {
        height: 180px;
        overflow: hidden;
    }
    .se-resto-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .se-resto-card:hover .se-resto-card-img img { transform: scale(1.06); }
    .se-resto-card-body { padding: 18px; }
    .se-resto-card-body h5 { font-weight: 700; font-size: 1rem; color: var(--text); margin-bottom: 4px; }
    .se-resto-card-body .meta {
        font-size: 0.78rem;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 4px;
        margin-bottom: 8px;
    }

    /* ─── FACILITIES ─── */
    .se-facility {
        text-align: center;
        padding: 28px 16px;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        background: #fff;
        transition: all var(--transition);
    }
    .se-facility:hover {
        border-color: var(--primary);
        background: var(--primary-light);
        transform: translateY(-4px);
        box-shadow: var(--shadow);
    }
    .se-facility-icon {
        width: 52px;
        height: 52px;
        border-radius: var(--radius-sm);
        background: var(--primary-light);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 12px;
        font-size: 1.4rem;
        color: var(--primary);
        transition: all var(--transition);
    }
    .se-facility:hover .se-facility-icon {
        background: var(--primary);
        color: #fff;
    }
    .se-facility-name {
        font-weight: 600;
        font-size: 0.85rem;
        color: var(--text);
    }

    /* ─── TESTIMONIALS ─── */
    .se-testi-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 28px;
        height: 100%;
        transition: all var(--transition);
    }
    .se-testi-card:hover {
        box-shadow: var(--shadow);
        transform: translateY(-4px);
    }
    .se-testi-card .stars { color: #F59E0B; font-size: 0.85rem; margin-bottom: 16px; }
    .se-testi-card .quote {
        font-size: 0.9rem;
        color: var(--text-secondary);
        line-height: 1.75;
        margin-bottom: 20px;
        font-style: italic;
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
        flex-shrink: 0;
    }
    .se-testi-card .user .name { font-weight: 700; font-size: 0.85rem; color: var(--text); }
    .se-testi-card .user .pos { font-size: 0.72rem; color: var(--text-muted); }

    /* ─── NEWSLETTER ─── */
    .se-newsletter {
        background: var(--primary-light);
        border-radius: var(--radius);
        padding: 48px;
        text-align: center;
    }
    .se-newsletter h3 {
        font-weight: 700;
        font-size: 1.5rem;
        color: var(--text);
        margin-bottom: 8px;
    }
    .se-newsletter p {
        font-size: 0.9rem;
        color: var(--text-muted);
        margin-bottom: 24px;
    }
    .se-newsletter .input-group {
        max-width: 480px;
        margin: 0 auto;
    }
    .se-newsletter .form-control {
        border: 1.5px solid var(--border);
        border-radius: var(--radius-sm) 0 0 var(--radius-sm);
        padding: 14px 20px;
        font-size: 0.9rem;
        border-right: none;
    }
    .se-newsletter .form-control:focus {
        border-color: var(--primary);
        box-shadow: none;
    }
    .se-newsletter .btn-sub {
        background: var(--primary-gradient);
        color: #fff;
        border: none;
        border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
        padding: 14px 28px;
        font-weight: 700;
        font-size: 0.9rem;
        transition: all var(--transition);
    }
    .se-newsletter .btn-sub:hover {
        box-shadow: 0 4px 16px rgba(37,99,235,0.3);
    }

    /* ─── BRANDS ─── */
    .se-brands {
        padding: 48px 0;
        text-align: center;
    }
    .se-brands p {
        font-size: 0.72rem;
        font-weight: 600;
        color: var(--text-muted);
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 20px;
    }
    .se-brands-logos {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 40px;
        flex-wrap: wrap;
    }
    .se-brands-logos span {
        font-size: 0.82rem;
        font-weight: 700;
        color: #CBD5E1;
        letter-spacing: 0.5px;
    }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 991.98px) {
        .se-hero { min-height: auto; padding: 32px 0 80px; }
        .se-hero h1 { font-size: 2.2rem; }
        .se-hero-desc { font-size: 0.9rem; }
        .se-featured-banner { padding: 32px; }
        .se-featured-banner h2 { font-size: 1.5rem; }
    }

    @media (max-width: 768px) {
        .se-hero {
            padding: 24px 0 80px;
            min-height: auto;
        }
        .se-hero h1 {
            font-size: clamp(1.6rem, 6vw, 2.2rem);
            margin-bottom: 16px;
        }
        .se-hero-desc {
            font-size: 0.88rem;
            max-width: 100%;
            margin-bottom: 24px;
        }
        .se-hero-stats {
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 24px;
            padding: 16px;
            background: rgba(255,255,255,0.05);
            border-radius: var(--radius-sm);
            backdrop-filter: blur(10px);
        }
        .se-hero-stat h3 { font-size: 1.1rem; }
        .se-hero-stat p { font-size: 0.72rem; }
        .se-floating-search { margin-top: -40px; }
        .se-search-card {
            padding: 20px;
            border-radius: var(--radius-sm);
        }
        .se-section { padding: 40px 0; }
        .se-section-header { margin-bottom: 20px; }
        .se-featured-banner {
            padding: 24px;
            border-radius: var(--radius-sm);
            text-align: center;
        }
        .se-featured-banner h2 {
            font-size: 1.3rem;
            margin-bottom: 12px;
        }
        .se-featured-banner p {
            font-size: 0.85rem;
            margin-bottom: 20px;
        }
        .se-featured-banner-img {
            margin-top: 24px;
        }
        .se-newsletter {
            padding: 32px 20px;
        }
        .se-chips {
            gap: 6px;
            margin-bottom: 24px;
        }
        .se-chip {
            padding: 6px 14px;
            font-size: 0.75rem;
        }
    }

    @media (max-width: 576px) {
        .se-hero {
            padding: 20px 0 60px;
        }
        .se-hero h1 {
            font-size: 1.5rem;
            margin-bottom: 12px;
        }
        .se-hero-desc {
            font-size: 0.85rem;
            margin-bottom: 20px;
        }
        .se-hero-stats {
            gap: 16px;
            padding: 12px;
        }
        .se-hero-stat h3 { font-size: 1rem; }
        .se-hero-stat p { font-size: 0.7rem; }
        .se-floating-search { margin-top: -32px; }
        .se-search-card {
            padding: 16px;
        }
        .se-section { padding: 32px 0; }
        .se-section-header {
            margin-bottom: 16px;
            flex-direction: column;
            align-items: flex-start;
        }
        .se-featured-banner {
            padding: 20px;
        }
        .se-featured-banner h2 {
            font-size: 1.15rem;
            margin-bottom: 10px;
        }
        .se-featured-banner p {
            font-size: 0.82rem;
            margin-bottom: 16px;
        }
        .se-newsletter {
            padding: 24px 16px;
        }
        .se-newsletter h3 {
            font-size: 1.2rem;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<section class="se-hero">
    <div class="container se-hero-content">
        <div class="row align-items-center">
            <div class="col-lg-6 fade-in">
                <div class="se-hero-subtitle">
                    <i class="bi bi-star-fill"></i>
                    Premium Hotel & Restaurant Booking
                </div>
                <h1>
                    Discover Your<br>
                    <span class="highlight">Perfect Stay</span><br>
                    in Indonesia
                </h1>
                <p class="se-hero-desc">
                    Find luxury hotels, world-class restaurants, and unforgettable experiences.
                    Easy booking, transparent pricing, 24/7 support.
                </p>
                <a href="<?php echo e(route('rooms.index')); ?>" class="se-hero-cta">
                    Explore Rooms <i class="bi bi-arrow-right"></i>
                </a>

                <div class="se-hero-stats">
                    <div class="se-hero-stat">
                        <h3>10K+</h3>
                        <p>Rooms Available</p>
                    </div>
                    <div class="se-hero-stat">
                        <h3>50K+</h3>
                        <p>Happy Guests</p>
                    </div>
                    <div class="se-hero-stat">
                        <h3>4.8</h3>
                        <p>User Rating</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block fade-in fade-in-d2">
                <div class="se-hero-image">
                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80"
                         alt="Luxury Hotel Pool View"
                         loading="eager">
                    <div class="se-hero-image-badge">
                        <i class="bi bi-shield-check"></i>
                        <div>
                            <div class="label">Trusted & Secure</div>
                            <div class="sub">Verified bookings</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="se-floating-search">
    <div class="container">
        <div class="se-search-card fade-in fade-in-d1">
            <form action="<?php echo e(route('rooms.index')); ?>" method="GET">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label>Room Type</label>
                        <select name="room_type" class="form-select">
                            <option value="">All Types</option>
                            <?php $__currentLoopData = $roomTypes ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Check In</label>
                        <input type="date" class="form-control" name="check_in" min="<?php echo e(date('Y-m-d')); ?>">
                    </div>
                    <div class="col-md-3">
                        <label>Check Out</label>
                        <input type="date" class="form-control" name="check_out" min="<?php echo e(date('Y-m-d', strtotime('+1 day'))); ?>">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn-search w-100">
                            <i class="bi bi-search"></i> Search Rooms
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>


<section class="se-brands">
    <div class="container">
        <p>Trusted by the finest hotels and restaurants</p>
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


<?php if(isset($roomTypes) && $roomTypes->count() > 0): ?>
<section class="se-section" style="padding-top:0;" id="room-categories">
    <div class="container">
        <div class="se-section-header">
            <div>
                <h2 class="se-section-title">Explore <span class="highlight">Room Types</span></h2>
                <p class="se-section-subtitle mb-0">Find the perfect room that matches your comfort and style preferences.</p>
            </div>
            <a href="<?php echo e(route('rooms.index')); ?>" class="se-link">View All <i class="bi bi-arrow-right"></i></a>
        </div>

        
        <div class="se-chips">
            <a href="<?php echo e(route('rooms.index')); ?>" class="se-chip active">
                <i class="bi bi-grid"></i> All Rooms
            </a>
            <?php $__currentLoopData = $roomTypes->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('rooms.index', ['room_type' => $type->id])); ?>" class="se-chip">
                    <i class="bi bi-door-open"></i> <?php echo e($type->name); ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div class="row g-3">
            <?php $__currentLoopData = $roomTypes->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $imgs = [
                        'https://images.unsplash.com/photo-1611892440504-42a792e24d32?w=600&q=80',
                        'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=600&q=80',
                        'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=600&q=80',
                        'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=600&q=80',
                    ];
                ?>
                <div class="col-6 col-lg-3">
                    <a href="<?php echo e(route('rooms.index', ['room_type' => $type->id])); ?>" class="text-decoration-none">
                        <div class="se-hotel-card">
                            <div class="se-hotel-card-img">
                                <img src="<?php echo e($imgs[$loop->index % count($imgs)]); ?>" alt="<?php echo e($type->name); ?>" loading="lazy">
                                <span class="se-hotel-card-badge"><i class="bi bi-door-open me-1"></i><?php echo e($type->rooms_count ?? 0); ?> rooms</span>
                                <span class="se-hotel-card-price">Rp <?php echo e(number_format($type->price, 0, ',', '.')); ?></span>
                            </div>
                            <div class="se-hotel-card-body">
                                <div class="se-hotel-card-title"><?php echo e($type->name); ?></div>
                                <div class="se-hotel-card-sub">
                                    <i class="bi bi-people me-1"></i>Max <?php echo e($type->max_guests); ?> guests
                                </div>
                                <div class="se-hotel-card-rating">
                                    <span class="score"><?php echo e(number_format(4.5 + ($loop->index * 0.1), 1)); ?></span>
                                    <span class="label">Excellent</span>
                                    <span class="count">(<?php echo e(80 + ($loop->index * 30)); ?> reviews)</span>
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
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>


<?php if(isset($rooms) && $rooms->count() > 0): ?>
<section class="se-section">
    <div class="container">
        <div class="se-section-header">
            <div>
                <h2 class="se-section-title">Popular <span class="highlight">Hotels</span></h2>
                <p class="se-section-subtitle mb-0">Handpicked premium rooms for an exceptional stay experience.</p>
            </div>
            <a href="<?php echo e(route('rooms.index')); ?>" class="se-link">View All <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="row g-3">
            <?php $__currentLoopData = $rooms->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $imgs = [
                        'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=600&q=80',
                        'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=600&q=80',
                        'https://images.unsplash.com/photo-1611892440504-42a792e24d32?w=600&q=80',
                        'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=600&q=80',
                    ];
                    $scores = [8.5, 8.7, 8.9, 9.0, 9.1, 9.2];
                    $score = $scores[$room->id % count($scores)];
                    $labels = [9.0 => 'Outstanding', 8.5 => 'Excellent', 8.0 => 'Very Good'];
                    $label = 'Good';
                    foreach($labels as $t => $l) { if($score >= $t) { $label = $l; break; } }
                    $rc = ($room->id * 37 + 120) % 400 + 80;
                ?>
                <div class="col-md-6 col-lg-3">
                    <a href="<?php echo e(route('customer.room.detail', $room)); ?>" class="text-decoration-none">
                        <div class="se-hotel-card">
                            <div class="se-hotel-card-img">
                                <img src="<?php echo e($imgs[$room->id % count($imgs)]); ?>" alt="<?php echo e($room->room_number); ?>" loading="lazy">
                                <span class="se-hotel-card-badge"><i class="bi bi-check-circle-fill text-success me-1"></i>Available</span>
                                <span class="se-hotel-card-price">Rp <?php echo e(number_format($room->roomType->price, 0, ',', '.')); ?></span>
                            </div>
                            <div class="se-hotel-card-body">
                                <div class="se-hotel-card-title"><?php echo e($room->room_number); ?> - <?php echo e($room->roomType->name); ?></div>
                                <div class="se-hotel-card-sub"><i class="bi bi-building me-1"></i>Floor <?php echo e($room->floor); ?> · Max <?php echo e($room->roomType->max_guests); ?> guests</div>
                                <div class="se-hotel-card-rating">
                                    <span class="score"><?php echo e(number_format($score, 1)); ?></span>
                                    <span class="label"><?php echo e($label); ?></span>
                                    <span class="count">(<?php echo e($rc); ?> reviews)</span>
                                </div>
                                <div class="se-hotel-card-amenities">
                                    <span><i class="bi bi-wifi"></i>WiFi</span>
                                    <span><i class="bi bi-snow"></i>AC</span>
                                    <span><i class="bi bi-tv"></i>TV</span>
                                    <span><i class="bi bi-people"></i><?php echo e($room->roomType->max_guests); ?></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>


<section class="se-section" style="padding-top:0;">
    <div class="container">
        <div class="se-featured-banner">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <span class="se-badge se-badge-primary" style="background:rgba(255,255,255,0.1);color:#60A5FA;margin-bottom:16px;">
                        <i class="bi bi-stars"></i> Featured Property
                    </span>
                    <h2>Experience Luxury<br>Like Never Before</h2>
                    <p>Immerse yourself in unparalleled comfort with our premium suites. World-class amenities, breathtaking views, and personalized service await.</p>
                    <a href="<?php echo e(route('rooms.index')); ?>" class="btn-cta">
                        Book Now <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="col-lg-6 mt-4 mt-lg-0">
                    <div class="se-featured-banner-img">
                        <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?w=800&q=80"
                             alt="Luxury Hotel Suite"
                             loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="se-section" style="padding-top:0;">
    <div class="container">
        <div class="se-section-header">
            <div>
                <h2 class="se-section-title">Restaurant <span class="highlight">Picks</span></h2>
                <p class="se-section-subtitle mb-0">Savor exquisite cuisines from our handpicked restaurants.</p>
            </div>
            <a href="<?php echo e(route('customer.restaurant.menu')); ?>" class="se-link">See Menu <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="row g-3">
            <?php
                $restos = [
                    ['name' => 'Fine Dining Room', 'cuisine' => 'International', 'rating' => 4.8, 'img' => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=600&q=80'],
                    ['name' => 'Traditional Nusantara', 'cuisine' => 'Indonesian', 'rating' => 4.7, 'img' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=600&q=80'],
                    ['name' => 'Rooftop Lounge', 'cuisine' => 'Fusion', 'rating' => 4.9, 'img' => 'https://images.unsplash.com/photo-1470337458703-46ad1756a187?w=600&q=80'],
                    ['name' => 'Café & Bakery', 'cuisine' => 'French', 'rating' => 4.6, 'img' => 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?w=600&q=80'],
                ];
            ?>
            <?php $__currentLoopData = $restos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-6 col-lg-3">
                    <a href="<?php echo e(route('customer.restaurant.menu')); ?>" class="text-decoration-none">
                        <div class="se-resto-card">
                            <div class="se-resto-card-img">
                                <img src="<?php echo e($resto['img']); ?>" alt="<?php echo e($resto['name']); ?>" loading="lazy">
                            </div>
                            <div class="se-resto-card-body">
                                <h5><?php echo e($resto['name']); ?></h5>
                                <div class="meta"><i class="bi bi-bookmark"></i> <?php echo e($resto['cuisine']); ?></div>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="se-badge se-badge-primary"><i class="bi bi-star-fill me-1"></i><?php echo e($resto['rating']); ?></span>
                                    <small class="text-muted" style="font-size:0.72rem;">Open 10:00 - 22:00</small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>


<section class="se-section" style="padding-top:0;" id="about">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="se-section-title">Hotel <span class="highlight">Facilities</span></h2>
            <p class="se-section-subtitle mx-auto">Everything you need for a comfortable and memorable stay.</p>
        </div>
        <div class="row g-3">
            <?php
                $facilities = [
                    ['icon' => 'bi-wifi', 'name' => 'High-Speed WiFi'],
                    ['icon' => 'bi-water', 'name' => 'Swimming Pool'],
                    ['icon' => 'bi-heart-pulse', 'name' => 'Spa & Wellness'],
                    ['icon' => 'bi-bicycle', 'name' => 'Fitness Center'],
                    ['icon' => 'bi-cup-hot', 'name' => 'Restaurant & Bar'],
                    ['icon' => 'bi-p-circle', 'name' => 'Free Parking'],
                    ['icon' => 'bi-shield-check', 'name' => '24/7 Security'],
                    ['icon' => 'bi-headset', 'name' => 'Concierge'],
                ];
            ?>
            <?php $__currentLoopData = $facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fac): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="se-facility">
                        <div class="se-facility-icon">
                            <i class="bi <?php echo e($fac['icon']); ?>"></i>
                        </div>
                        <div class="se-facility-name"><?php echo e($fac['name']); ?></div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>


<?php if(isset($testimonials) && $testimonials->count() > 0): ?>
<section class="se-section" style="padding-top:0;">
    <div class="container">
        <div class="se-section-header">
            <div>
                <h2 class="se-section-title">What Our <span class="highlight">Guests Say</span></h2>
                <p class="se-section-subtitle mb-0">Real experiences from real guests who loved their stay.</p>
            </div>
        </div>
        <div class="row g-3">
            <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4">
                    <div class="se-testi-card">
                        <div class="stars">
                            <?php for($i=1;$i<=5;$i++): ?>
                                <?php if($i<=$t->rating): ?><i class="bi bi-star-fill"></i><?php else: ?><i class="bi bi-star"></i><?php endif; ?>
                            <?php endfor; ?>
                        </div>
                        <p class="quote">"<?php echo e($t->message); ?>"</p>
                        <div class="user">
                            <div class="avatar"><?php echo e(strtoupper(substr($t->name, 0, 2))); ?></div>
                            <div>
                                <div class="name"><?php echo e($t->name); ?></div>
                                <div class="pos"><?php echo e($t->position ?? 'Guest'); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>


<section class="se-section" style="padding-top:0;">
    <div class="container">
        <div class="se-newsletter">
            <h3>Get the Best Deals</h3>
            <p>Subscribe to our newsletter for exclusive offers and special discounts.</p>
            <form class="input-group" onsubmit="event.preventDefault();">
                <input type="email" class="form-control" placeholder="Enter your email address...">
                <button type="submit" class="btn-sub">Subscribe</button>
            </form>
        </div>
    </div>
</section>

<?php echo $__env->make('customer.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('customer.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ukk-hotel-management\resources\views/customer/home.blade.php ENDPATH**/ ?>