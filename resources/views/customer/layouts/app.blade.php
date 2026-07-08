<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title', 'StayEase - Hotel & Restaurant Booking')</title>
    
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    {{-- Bootstrap + Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    {{-- PWA --}}
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#2563EB">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <style>
        :root {
            --primary: #2563EB;
            --primary-dark: #1D4ED8;
            --primary-light: #DBEAFE;
            --primary-glow: rgba(37,99,235,0.12);
            --primary-gradient: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%);
            --accent: #FBBF24;
            --accent-light: #FEF3C7;
            --success: #22C55E;
            --danger: #EF4444;
            --bg: #F8FAFC;
            --bg-card: #FFFFFF;
            --text: #0F172A;
            --text-muted: #64748B;
            --border: #E2E8F0;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.06);
            --shadow: 0 4px 20px rgba(0,0,0,0.08);
            --shadow-lg: 0 12px 40px rgba(0,0,0,0.12);
            --radius: 20px;
            --radius-sm: 12px;
            --radius-xs: 8px;
            --font: 'Poppins', sans-serif;
            --font-alt: 'Inter', sans-serif;
            --nav-height: 68px;
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        
        body {
            font-family: var(--font);
            background: var(--bg);
            color: var(--text);
            padding-top: var(--nav-height);
            -webkit-font-smoothing: antialiased;
        }

        /* ─── Glassmorphism Navbar ─── */
        .navbar-stayease {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--nav-height);
            z-index: 1030;
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid rgba(226,232,240,0.6);
            transition: all 0.3s ease;
        }
        .navbar-stayease.scrolled {
            background: rgba(255,255,255,0.95);
            box-shadow: 0 4px 30px rgba(0,0,0,0.08);
        }
        .navbar-stayease .container {
            height: 100%;
            display: flex;
            align-items: center;
        }

        /* Logo */
        .se-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            flex-shrink: 0;
        }
        .se-logo-icon {
            width: 36px;
            height: 36px;
            background: var(--primary-gradient);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 900;
            font-size: 1rem;
            box-shadow: 0 4px 12px rgba(37,99,235,0.3);
            transition: transform 0.3s ease;
        }
        .se-logo:hover .se-logo-icon { transform: scale(1.05) rotate(-3deg); }
        .se-logo-text {
            font-weight: 800;
            font-size: 1.15rem;
            color: var(--text);
            letter-spacing: -0.5px;
        }
        .se-logo-text span { color: var(--primary); }

        /* Desktop Nav */
        .se-nav-links {
            display: flex;
            align-items: center;
            gap: 4px;
            margin-left: 32px;
        }
        .se-nav-link {
            font-family: var(--font-alt);
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--text-muted);
            text-decoration: none;
            padding: 8px 16px;
            border-radius: var(--radius-xs);
            transition: all 0.2s ease;
            position: relative;
        }
        .se-nav-link:hover { color: var(--primary); background: var(--primary-glow); }
        .se-nav-link.active {
            color: var(--primary);
            font-weight: 600;
            background: var(--primary-glow);
        }

        /* Right actions */
        .se-nav-right {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-left: auto;
        }
        .se-icon-btn {
            width: 40px;
            height: 40px;
            border: none;
            background: transparent;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            font-size: 1.1rem;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
            position: relative;
        }
        .se-icon-btn:hover { background: var(--primary-glow); color: var(--primary); }
        .se-icon-btn .badge-dot {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 8px;
            height: 8px;
            background: var(--danger);
            border-radius: 50%;
            border: 2px solid #fff;
        }

        .se-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--primary-gradient);
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 10px 22px;
            font-family: var(--font-alt);
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 14px rgba(37,99,235,0.3);
            cursor: pointer;
        }
        .se-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37,99,235,0.4);
            color: #fff;
        }
        .se-btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: transparent;
            color: var(--text);
            border: 1.5px solid var(--border);
            border-radius: 50px;
            padding: 10px 20px;
            font-family: var(--font-alt);
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .se-btn-outline:hover { border-color: var(--primary); color: var(--primary); background: var(--primary-glow); }

        /* Avatar */
        .se-avatar {
            width: 38px;
            height: 38px;
            background: var(--primary-gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 0.75rem;
            cursor: pointer;
            flex-shrink: 0;
            border: 2px solid #fff;
            box-shadow: 0 2px 8px rgba(37,99,235,0.2);
            transition: transform 0.2s;
        }
        .se-avatar:hover { transform: scale(1.05); }
        .navbar-stayease .dropdown-menu {
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 8px;
            box-shadow: var(--shadow-lg);
            min-width: 220px;
            border: none;
            background: rgba(255,255,255,0.98);
            backdrop-filter: blur(20px);
        }
        .navbar-stayease .dropdown-item {
            border-radius: 10px;
            padding: 10px 14px;
            font-family: var(--font-alt);
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--text);
            transition: all 0.15s;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .navbar-stayease .dropdown-item i { font-size: 1rem; color: var(--text-muted); width: 20px; }
        .navbar-stayease .dropdown-item:hover { background: var(--primary-glow); color: var(--primary); }
        .navbar-stayease .dropdown-item:hover i { color: var(--primary); }
        .navbar-stayease .dropdown-item.text-danger:hover { background: rgba(239,68,68,0.08); color: var(--danger) !important; }
        .navbar-stayease .dropdown-item.text-danger:hover i { color: var(--danger); }

        /* Hamburger */
        .se-hamburger {
            width: 40px;
            height: 40px;
            display: none;
            align-items: center;
            justify-content: center;
            border: none;
            background: transparent;
            border-radius: 10px;
            color: var(--text);
            font-size: 1.3rem;
            cursor: pointer;
            transition: background 0.2s;
        }
        .se-hamburger:hover { background: var(--primary-glow); }
        @media (max-width: 991.98px) {
            .se-nav-links { display: none; }
            .se-hamburger { display: flex; }
            .se-btn-primary span, .se-btn-outline span { display: none; }
        }

        /* Side Drawer */
        .se-drawer-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 1049;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s;
        }
        .se-drawer-overlay.open { opacity: 1; pointer-events: auto; }
        .se-drawer {
            position: fixed;
            top: 0;
            left: 0;
            width: 300px;
            height: 100vh;
            background: rgba(255,255,255,0.98);
            backdrop-filter: blur(20px);
            z-index: 1050;
            transform: translateX(-100%);
            transition: transform 0.35s cubic-bezier(0.4,0,0.2,1);
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 40px rgba(0,0,0,0.1);
        }
        .se-drawer.open { transform: translateX(0); }
        .se-drawer-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
        }
        .se-drawer-close {
            width: 36px; height: 36px;
            border: none; background: var(--bg);
            border-radius: 10px; font-size: 1rem;
            cursor: pointer; color: var(--text);
            display: flex; align-items: center; justify-content: center;
        }
        .se-drawer-body { flex: 1; overflow-y: auto; padding: 12px; }
        .se-drawer-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            border-radius: 12px;
            text-decoration: none;
            color: var(--text);
            font-family: var(--font-alt);
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.15s;
            margin-bottom: 2px;
        }
        .se-drawer-link i { font-size: 1.1rem; color: var(--text-muted); width: 22px; text-align: center; }
        .se-drawer-link:hover { background: var(--primary-glow); color: var(--primary); }
        .se-drawer-link:hover i { color: var(--primary); }
        .se-drawer-link.active { background: var(--primary-glow); color: var(--primary); font-weight: 600; }
        .se-drawer-link.active i { color: var(--primary); }
        .se-drawer-divider { height: 1px; background: var(--border); margin: 8px 0; }
        .se-drawer-footer { padding: 16px 20px; border-top: 1px solid var(--border); }

        /* ─── Shared Components ─── */
        .se-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
        }
        .se-card:hover {
            box-shadow: var(--shadow);
            transform: translateY(-2px);
        }
        .se-card-lg {
            border-radius: var(--radius);
            overflow: hidden;
            background: var(--bg-card);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
        }

        .se-section-title {
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--text);
            margin-bottom: 24px;
            letter-spacing: -0.3px;
        }
        .se-section-title .highlight { color: var(--primary); }

        .se-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            font-family: var(--font-alt);
        }
        .se-badge-primary { background: var(--primary-light); color: var(--primary); }
        .se-badge-success { background: #DCFCE7; color: #16A34A; }
        .se-badge-warning { background: var(--accent-light); color: #D97706; }
        .se-badge-danger { background: #FEE2E2; color: var(--danger); }

        .se-star { color: var(--accent); font-size: 0.8rem; }
        .se-star-empty { color: #D1D5DB; font-size: 0.8rem; }

        /* Buttons */
        .btn-se {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-family: var(--font-alt);
            font-weight: 600;
            border-radius: 50px;
            padding: 12px 28px;
            border: none;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-se-primary {
            background: var(--primary-gradient);
            color: #fff;
            box-shadow: 0 4px 14px rgba(37,99,235,0.3);
        }
        .btn-se-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37,99,235,0.4);
            color: #fff;
        }
        .btn-se-outline {
            background: transparent;
            color: var(--text);
            border: 1.5px solid var(--border);
        }
        .btn-se-outline:hover { border-color: var(--primary); color: var(--primary); background: var(--primary-glow); }
        .btn-se-white {
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            color: #fff;
            border: 1px solid rgba(255,255,255,0.3);
        }
        .btn-se-white:hover { background: rgba(255,255,255,0.3); color: #fff; }

        /* Glass card */
        .glass-card {
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: var(--radius);
            box-shadow: 0 8px 32px rgba(0,0,0,0.08);
        }

        /* Animated elements */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.6s ease forwards;
        }
        @keyframes fadeInUp {
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in-d1 { animation-delay: 0.1s; }
        .fade-in-d2 { animation-delay: 0.2s; }
        .fade-in-d3 { animation-delay: 0.3s; }
        .fade-in-d4 { animation-delay: 0.4s; }

        /* Floating animation */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
        .animate-float { animation: float 3s ease-in-out infinite; }

        /* Shimmer loading */
        .shimmer {
            background: linear-gradient(90deg, var(--border) 25%, #F1F5F9 50%, var(--border) 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }
        @keyframes shimmer {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* Footer */
        .se-footer {
            background: #0F172A;
            color: #94A3B8;
            font-family: var(--font-alt);
        }
        .se-footer h5, .se-footer h6 { color: #fff; font-weight: 700; }
        .se-footer a { color: #94A3B8; text-decoration: none; transition: color 0.2s; }
        .se-footer a:hover { color: #fff; }
        .se-footer .social-btn {
            width: 40px; height: 40px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.15);
            display: flex; align-items: center; justify-content: center;
            color: #94A3B8; text-decoration: none;
            transition: all 0.2s;
        }
        .se-footer .social-btn:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
            transform: translateY(-2px);
        }

        /* Breadcrumb */
        .se-breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 20px;
        }
        .se-breadcrumb .breadcrumb-item { font-size: 0.82rem; font-family: var(--font-alt); }
        .se-breadcrumb .breadcrumb-item a { color: var(--text-muted); text-decoration: none; }
        .se-breadcrumb .breadcrumb-item a:hover { color: var(--primary); }
        .se-breadcrumb .breadcrumb-item.active { color: var(--primary); font-weight: 600; }
        .se-breadcrumb .breadcrumb-item+.breadcrumb-item::before { color: var(--text-muted); }

        /* Pagination */
        .se-pagination {
            display: flex;
            gap: 6px;
            list-style: none;
            padding: 0;
            margin: 0;
            flex-wrap: wrap;
            justify-content: center;
        }
        .se-pagination li {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 42px;
            height: 42px;
            border-radius: 12px;
            font-family: var(--font-alt);
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.2s;
            border: 1.5px solid var(--border);
            background: #fff;
            color: var(--text);
        }
        .se-pagination li:hover:not(.active):not(.disabled) {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-glow);
            transform: translateY(-2px);
        }
        .se-pagination li.active {
            background: var(--primary-gradient);
            border-color: var(--primary);
            color: #fff;
            box-shadow: 0 4px 12px rgba(37,99,235,0.3);
        }
        .se-pagination li.disabled { opacity: 0.4; cursor: not-allowed; pointer-events: none; }
        .se-pagination li a {
            text-decoration: none;
            color: inherit;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            padding: 0 14px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .se-section-title { font-size: 1.25rem; }
            :root { --nav-height: 60px; }
        }
    </style>
    @stack('styles')
</head>
<body>
    {{-- ─── NAVBAR ─── --}}
    <nav class="navbar-stayease" id="seNavbar">
        <div class="container">
            {{-- Hamburger --}}
            <button class="se-hamburger" id="seDrawerToggle" aria-label="Menu">
                <i class="bi bi-list"></i>
            </button>

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="se-logo">
                <div class="se-logo-icon">SE</div>
                <span class="se-logo-text">Stay<span>Ease</span></span>
            </a>

            {{-- Desktop Links --}}
            <div class="se-nav-links">
                <a href="{{ route('home') }}" class="se-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    <i class="bi bi-house me-1"></i>Beranda
                </a>
                <a href="{{ route('rooms.index') }}" class="se-nav-link {{ request()->routeIs('rooms.*') ? 'active' : '' }}">
                    <i class="bi bi-building me-1"></i>Hotel
                </a>
                <a href="{{ route('customer.restaurant.menu') }}" class="se-nav-link {{ request()->routeIs('customer.restaurant.*') ? 'active' : '' }}">
                    <i class="bi bi-cup-hot me-1"></i>Restoran
                </a>
                <a href="{{ route('customer.gallery') }}" class="se-nav-link {{ request()->routeIs('customer.gallery') ? 'active' : '' }}">
                    <i class="bi bi-images me-1"></i>Galeri
                </a>
                <a href="{{ route('customer.contact') }}" class="se-nav-link {{ request()->routeIs('customer.contact') ? 'active' : '' }}">
                    <i class="bi bi-chat me-1"></i>Kontak
                </a>
            </div>

            {{-- Right --}}
            <div class="se-nav-right">
                @auth
                    <a href="{{ route('customer.bookings') }}" class="se-icon-btn" title="Booking Saya">
                        <i class="bi bi-calendar-check"></i>
                    </a>
                    <a href="{{ route('customer.notifications') }}" class="se-icon-btn" title="Notifikasi">
                        <i class="bi bi-bell"></i>
                        <span class="badge-dot"></span>
                    </a>
                    <div class="dropdown">
                        <div class="se-avatar" data-bs-toggle="dropdown" aria-expanded="false" title="{{ auth()->user()->name }}">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="px-3 py-2 border-bottom" style="border-color: var(--border) !important;">
                                <div style="font-weight:700;font-size:0.85rem;color:var(--text);">{{ auth()->user()->name }}</div>
                                <div style="font-size:0.72rem;color:var(--text-muted);">{{ auth()->user()->email }}</div>
                            </li>
                            <li class="mt-1"><a class="dropdown-item" href="{{ route('customer.bookings') }}"><i class="bi bi-calendar-check"></i>Booking Saya</a></li>
                            <li><a class="dropdown-item" href="{{ route('customer.restaurant.orders') }}"><i class="bi bi-receipt"></i>Pesanan Restoran</a></li>
                            <li><a class="dropdown-item" href="{{ route('customer.wishlist') }}"><i class="bi bi-heart"></i>Wishlist</a></li>
                            <li><a class="dropdown-item" href="{{ route('customer.reviews') }}"><i class="bi bi-star"></i>Ulasan Saya</a></li>
                            <li><a class="dropdown-item" href="{{ route('customer.profile') }}"><i class="bi bi-person"></i>Profile</a></li>
                            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'staff')
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2"></i>Admin Panel</a></li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#" onclick="event.preventDefault();document.getElementById('se-logout').submit();"><i class="bi bi-box-arrow-right"></i>Keluar</a></li>
                        </ul>
                        <form id="se-logout" action="{{ route('customer.logout') }}" method="POST" class="d-none">@csrf</form>
                    </div>
                @else
                    <a href="{{ route('customer.login') }}" class="se-btn-outline"><i class="bi bi-person"></i><span>Masuk</span></a>
                    <a href="{{ route('customer.register') }}" class="se-btn-primary"><i class="bi bi-person-plus"></i><span>Daftar</span></a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- ─── SIDE DRAWER ─── --}}
    <div class="se-drawer-overlay" id="seOverlay"></div>
    <div class="se-drawer" id="seDrawer">
        <div class="se-drawer-head">
            <a href="{{ route('home') }}" class="se-logo">
                <div class="se-logo-icon">SE</div>
                <span class="se-logo-text">Stay<span>Ease</span></span>
            </a>
            <button class="se-drawer-close" id="seDrawerClose"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="se-drawer-body">
            <a href="{{ route('home') }}" class="se-drawer-link {{ request()->routeIs('home') ? 'active' : '' }}">
                <i class="bi bi-house"></i> Beranda
            </a>
            <a href="{{ route('rooms.index') }}" class="se-drawer-link {{ request()->routeIs('rooms.*') ? 'active' : '' }}">
                <i class="bi bi-building"></i> Cari Hotel
            </a>
            <a href="{{ route('customer.restaurant.menu') }}" class="se-drawer-link {{ request()->routeIs('customer.restaurant.*') ? 'active' : '' }}">
                <i class="bi bi-cup-hot"></i> Restoran
            </a>
            <a href="{{ route('customer.gallery') }}" class="se-drawer-link {{ request()->routeIs('customer.gallery') ? 'active' : '' }}">
                <i class="bi bi-images"></i> Galeri
            </a>
            <a href="{{ route('customer.contact') }}" class="se-drawer-link {{ request()->routeIs('customer.contact') ? 'active' : '' }}">
                <i class="bi bi-geo-alt"></i> Kontak
            </a>
            <div class="se-drawer-divider"></div>
            @auth
                <a href="{{ route('customer.bookings') }}" class="se-drawer-link">
                    <i class="bi bi-calendar-check"></i> Booking Saya
                </a>
                <a href="{{ route('customer.restaurant.orders') }}" class="se-drawer-link">
                    <i class="bi bi-receipt"></i> Pesanan Restoran
                </a>
                <a href="{{ route('customer.wishlist') }}" class="se-drawer-link">
                    <i class="bi bi-heart"></i> Wishlist
                </a>
                <a href="{{ route('customer.reviews') }}" class="se-drawer-link">
                    <i class="bi bi-star"></i> Ulasan Saya
                </a>
                <a href="{{ route('customer.profile') }}" class="se-drawer-link">
                    <i class="bi bi-person"></i> Profile
                </a>
                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'staff')
                    <div class="se-drawer-divider"></div>
                    <a href="{{ route('admin.dashboard') }}" class="se-drawer-link">
                        <i class="bi bi-speedometer2"></i> Admin Panel
                    </a>
                @endif
            @else
                <div class="se-drawer-divider"></div>
                <a href="{{ route('customer.login') }}" class="se-drawer-link">
                    <i class="bi bi-box-arrow-in-right"></i> Masuk
                </a>
                <a href="{{ route('customer.register') }}" class="se-drawer-link">
                    <i class="bi bi-person-plus"></i> Daftar Gratis
                </a>
            @endauth
        </div>
        @auth
        <div class="se-drawer-footer">
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px;">
                <div class="se-avatar" style="width:38px;height:38px;font-size:0.8rem;">{{ strtoupper(substr(auth()->user()->name,0,2)) }}</div>
                <div>
                    <div style="font-weight:700;font-size:0.85rem;">{{ auth()->user()->name }}</div>
                    <div style="font-size:0.72rem;color:var(--text-muted);">{{ auth()->user()->email }}</div>
                </div>
            </div>
            <a href="#" onclick="event.preventDefault();document.getElementById('se-logout-drawer').submit();" class="btn-se btn-se-outline w-100" style="color:#EF4444;border-color:#FEE2E2;">
                <i class="bi bi-box-arrow-right"></i> Keluar
            </a>
            <form id="se-logout-drawer" action="{{ route('customer.logout') }}" method="POST" class="d-none">@csrf</form>
        </div>
        @endauth
    </div>

    <script>
        (function() {
            const toggle = document.getElementById('seDrawerToggle');
            const drawer = document.getElementById('seDrawer');
            const overlay = document.getElementById('seOverlay');
            const closeBtn = document.getElementById('seDrawerClose');
            function openD() { drawer.classList.add('open'); overlay.classList.add('open'); document.body.style.overflow='hidden'; }
            function closeD() { drawer.classList.remove('open'); overlay.classList.remove('open'); document.body.style.overflow=''; }
            if(toggle) toggle.addEventListener('click', openD);
            if(closeBtn) closeBtn.addEventListener('click', closeD);
            if(overlay) overlay.addEventListener('click', closeD);
            // Navbar scroll effect
            window.addEventListener('scroll', function() {
                const nav = document.getElementById('seNavbar');
                if(window.scrollY > 20) nav.classList.add('scrolled');
                else nav.classList.remove('scrolled');
            });
        })();
    </script>

    {{-- ─── CONTENT ─── --}}
    <main>
        @if(session('success'))
            <div class="container mt-3">
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4" style="background:#DCFCE7;color:#16A34A;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill fs-5"></i>
                        <span>{{ session('success') }}</span>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            </div>
        @endif
        @if(session('error'))
            <div class="container mt-3">
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-4" style="background:#FEE2E2;color:#DC2626;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-exclamation-circle-fill fs-5"></i>
                        <span>{{ session('error') }}</span>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            </div>
        @endif
        @if(session('info'))
            <div class="container mt-3">
                <div class="alert alert-info alert-dismissible fade show border-0 shadow-sm rounded-4" style="background:#DBEAFE;color:#1D4ED8;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-info-circle-fill fs-5"></i>
                        <span>{{ session('info') }}</span>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- ─── FOOTER ─── --}}
    <footer class="se-footer pt-5 pb-3 mt-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <a href="{{ route('home') }}" class="se-logo mb-3 d-inline-flex">
                        <div class="se-logo-icon" style="background:#fff;color:#2563EB;">SE</div>
                        <span class="se-logo-text" style="color:#fff;">Stay<span style="color:#60A5FA;">Ease</span></span>
                    </a>
                    <p style="font-size:0.85rem;line-height:1.7;">Platform booking hotel dan restoran terpercaya. Nikmati pengalaman menginap dan bersantap terbaik dengan harga terbaik.</p>
                    <div class="d-flex gap-2 mt-3">
                        <a href="#" class="social-btn"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-btn"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-btn"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="social-btn"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                <div class="col-6 col-lg-2">
                    <h6 class="mb-3">Menu</h6>
                    <ul class="list-unstyled" style="font-size:0.85rem;">
                        <li class="mb-2"><a href="{{ route('home') }}">Beranda</a></li>
                        <li class="mb-2"><a href="{{ route('rooms.index') }}">Hotel</a></li>
                        <li class="mb-2"><a href="{{ route('customer.restaurant.menu') }}">Restoran</a></li>
                        <li class="mb-2"><a href="{{ route('customer.gallery') }}">Galeri</a></li>
                        <li class="mb-2"><a href="{{ route('customer.contact') }}">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-3">
                    <h6 class="mb-3">Layanan</h6>
                    <ul class="list-unstyled" style="font-size:0.85rem;">
                        <li class="mb-2"><a href="#">Bantuan</a></li>
                        <li class="mb-2"><a href="#">FAQ</a></li>
                        <li class="mb-2"><a href="#">Kebijakan Privasi</a></li>
                        <li class="mb-2"><a href="#">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h6 class="mb-3">Kontak</h6>
                    <ul class="list-unstyled" style="font-size:0.85rem;">
                        <li class="mb-2"><i class="bi bi-geo-alt me-2"></i>Jakarta, Indonesia</li>
                        <li class="mb-2"><i class="bi bi-telephone me-2"></i>+62 123 4567 890</li>
                        <li class="mb-2"><i class="bi bi-envelope me-2"></i>hello@stayease.com</li>
                        <li class="mb-2"><i class="bi bi-clock me-2"></i>24/7 Customer Support</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4" style="border-color:rgba(255,255,255,0.1);">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2" style="font-size:0.8rem;">
                <p class="mb-0">&copy; {{ date('Y') }} StayEase. All rights reserved.</p>
                <div class="d-flex gap-3">
                    <a href="#">Privacy</a>
                    <a href="#">Terms</a>
                    <a href="#">Cookies</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- PWA SW --}}
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/sw.js').then(function(reg) {
                    console.log('StayEase SW registered');
                }).catch(function(err) {
                    console.log('StayEase SW failed:', err);
                });
            });
        }
    </script>
    @stack('scripts')
</body>
</html>