<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title', 'StayEase - Premium Hotel & Restaurant Booking')</title>
    <meta name="description" content="StayEase — Discover luxury hotels, fine dining, and unforgettable experiences. Book easily with transparent pricing and 24/7 support.">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- Bootstrap + Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- PWA --}}
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#2563EB">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="apple-touch-icon" href="/icons/icon-192x192.svg">
    <link rel="apple-touch-startup-image" href="/icons/icon-512x512.svg">

    <style>
        /* ════════════════════════════════════════
           DESIGN SYSTEM — Nordic Minimalist
           ════════════════════════════════════════ */
        :root {
            /* Colors */
            --primary: #2563EB;
            --primary-dark: #1D4ED8;
            --primary-light: #EFF6FF;
            --primary-glow: rgba(37,99,235,0.08);
            --primary-gradient: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%);
            --accent: #F59E0B;
            --accent-light: #FFFBEB;
            --success: #16A34A;
            --danger: #EF4444;

            /* Surfaces */
            --bg: #F8FAFC;
            --bg-card: #FFFFFF;
            --text: #0F172A;
            --text-secondary: #475569;
            --text-muted: #94A3B8;
            --border: #E5E7EB;

            /* Shadows */
            --shadow-xs: 0 1px 2px rgba(15,23,42,0.03);
            --shadow-sm: 0 1px 3px rgba(15,23,42,0.04), 0 1px 2px rgba(15,23,42,0.02);
            --shadow: 0 4px 16px rgba(15,23,42,0.06);
            --shadow-md: 0 8px 30px rgba(15,23,42,0.08);
            --shadow-lg: 0 20px 60px rgba(15,23,42,0.10);

            /* Radii */
            --radius: 16px;
            --radius-sm: 12px;
            --radius-xs: 8px;
            --radius-full: 50px;

            /* Typography */
            --font: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
            --font-alt: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;

            /* Layout */
            --nav-height: 72px;
            --transition: 0.25s ease;
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        body {
            font-family: var(--font);
            background: var(--bg);
            color: var(--text);
            padding-top: var(--nav-height);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            line-height: 1.6;
        }

        /* ─── NAVBAR ─── */
        .navbar-stayease {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--nav-height);
            z-index: 1030;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(16px) saturate(180%);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
            border-bottom: 1px solid var(--border);
            transition: all var(--transition);
        }
        .navbar-stayease.scrolled {
            background: rgba(255,255,255,0.98);
            box-shadow: var(--shadow-sm);
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
            width: 40px;
            height: 40px;
            background: var(--primary-gradient);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 800;
            font-size: 0.95rem;
            letter-spacing: -0.5px;
            transition: transform var(--transition);
        }
        .se-logo:hover .se-logo-icon { transform: scale(1.05); }
        .se-logo-text {
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--text);
            letter-spacing: -0.5px;
        }
        .se-logo-text span { color: var(--primary); }

        /* Desktop Nav Links */
        .se-nav-links {
            display: flex;
            align-items: center;
            gap: 4px;
            margin-left: 40px;
        }
        .se-nav-link {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-secondary);
            text-decoration: none;
            padding: 8px 16px;
            border-radius: var(--radius-xs);
            transition: all var(--transition);
            position: relative;
            white-space: nowrap;
        }
        .se-nav-link:hover {
            color: var(--primary);
            background: var(--primary-glow);
        }
        .se-nav-link.active {
            color: var(--primary);
            font-weight: 600;
            background: var(--primary-glow);
        }
        .se-nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 2.5px;
            background: var(--primary);
            border-radius: 2px;
        }

        /* Right actions */
        .se-nav-right {
            display: flex;
            align-items: center;
            gap: 4px;
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
            color: var(--text-secondary);
            font-size: 1.15rem;
            cursor: pointer;
            text-decoration: none;
            transition: all var(--transition);
            position: relative;
        }
        .se-icon-btn:hover {
            background: var(--primary-glow);
            color: var(--primary);
            transform: translateY(-1px);
        }
        .se-icon-btn .badge-dot {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 7px;
            height: 7px;
            background: var(--danger);
            border-radius: 50%;
            border: 2px solid #fff;
        }
        .se-nav-divider {
            width: 1px;
            height: 24px;
            background: var(--border);
            margin: 0 8px;
        }

        /* Avatar */
        .se-avatar {
            width: 36px;
            height: 36px;
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
            transition: all var(--transition);
        }
        .se-avatar:hover {
            transform: scale(1.08);
            box-shadow: 0 4px 16px rgba(37,99,235,0.3);
        }

        /* Dropdown */
        .navbar-stayease .dropdown-menu {
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 8px;
            box-shadow: var(--shadow-lg);
            min-width: 220px;
            background: rgba(255,255,255,0.98);
            backdrop-filter: blur(20px);
        }
        .navbar-stayease .dropdown-item {
            border-radius: var(--radius-xs);
            padding: 10px 14px;
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
        .navbar-stayease .dropdown-item.text-danger:hover { background: rgba(239,68,68,0.06); color: var(--danger) !important; }
        .navbar-stayease .dropdown-item.text-danger:hover i { color: var(--danger); }

        /* Auth Buttons */
        .se-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--primary-gradient);
            color: #fff;
            border: none;
            border-radius: var(--radius-full);
            padding: 9px 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            transition: all var(--transition);
            box-shadow: 0 2px 8px rgba(37,99,235,0.25);
            cursor: pointer;
        }
        .se-btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(37,99,235,0.35);
            color: #fff;
        }
        .se-btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: transparent;
            color: var(--text);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-full);
            padding: 8px 18px;
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            transition: all var(--transition);
            cursor: pointer;
        }
        .se-btn-outline:hover { border-color: var(--primary); color: var(--primary); background: var(--primary-glow); }

        /* Hamburger */
        .se-hamburger {
            width: 40px;
            height: 40px;
            display: none;
            align-items: center;
            justify-content: center;
            border: none;
            background: transparent;
            border-radius: var(--radius-xs);
            color: var(--text);
            font-size: 1.3rem;
            cursor: pointer;
            transition: background var(--transition);
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
            background: rgba(15,23,42,0.3);
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
            background: #fff;
            z-index: 1050;
            transform: translateX(-100%);
            transition: transform 0.35s cubic-bezier(0.4,0,0.2,1);
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 40px rgba(15,23,42,0.08);
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
            border-radius: var(--radius-xs); font-size: 1rem;
            cursor: pointer; color: var(--text);
            display: flex; align-items: center; justify-content: center;
        }
        .se-drawer-body { flex: 1; overflow-y: auto; padding: 12px; }
        .se-drawer-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: var(--radius-xs);
            text-decoration: none;
            color: var(--text);
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

        /* ─── SHARED COMPONENTS ─── */
        .se-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow-xs);
            transition: all var(--transition);
        }
        .se-card:hover {
            box-shadow: var(--shadow);
            transform: translateY(-2px);
        }

        .se-section-title {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--text);
            margin-bottom: 8px;
            letter-spacing: -0.3px;
        }
        .se-section-title .highlight { color: var(--primary); }
        .se-section-subtitle {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-bottom: 32px;
            max-width: 480px;
        }

        .se-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 12px;
            border-radius: var(--radius-full);
            font-size: 0.75rem;
            font-weight: 600;
        }
        .se-badge-primary { background: var(--primary-light); color: var(--primary); }
        .se-badge-success { background: #DCFCE7; color: #16A34A; }
        .se-badge-warning { background: var(--accent-light); color: #D97706; }
        .se-badge-danger { background: #FEE2E2; color: var(--danger); }

        /* Buttons */
        .btn-se {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-family: var(--font);
            font-weight: 600;
            border-radius: var(--radius-sm);
            padding: 12px 28px;
            border: none;
            transition: all var(--transition);
            cursor: pointer;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .btn-se-primary {
            background: var(--primary-gradient);
            color: #fff;
            box-shadow: 0 2px 8px rgba(37,99,235,0.25);
        }
        .btn-se-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37,99,235,0.35);
            color: #fff;
        }
        .btn-se-outline {
            background: transparent;
            color: var(--text);
            border: 1.5px solid var(--border);
        }
        .btn-se-outline:hover { border-color: var(--primary); color: var(--primary); background: var(--primary-glow); }
        .btn-se-white {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            color: #fff;
            border: 1px solid rgba(255,255,255,0.2);
        }
        .btn-se-white:hover { background: rgba(255,255,255,0.25); color: #fff; }

        /* Animations */
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

        /* Breadcrumb */
        .se-breadcrumb { background: transparent; padding: 0; margin-bottom: 20px; }
        .se-breadcrumb .breadcrumb-item { font-size: 0.82rem; }
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
            min-width: 40px;
            height: 40px;
            border-radius: var(--radius-xs);
            font-weight: 600;
            font-size: 0.85rem;
            transition: all var(--transition);
            border: 1.5px solid var(--border);
            background: #fff;
            color: var(--text);
        }
        .se-pagination li:hover:not(.active):not(.disabled) {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-glow);
            transform: translateY(-1px);
        }
        .se-pagination li.active {
            background: var(--primary-gradient);
            border-color: var(--primary);
            color: #fff;
            box-shadow: 0 2px 8px rgba(37,99,235,0.25);
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

        /* Glass card */
        .glass-card {
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        /* ─── FOOTER ─── */
        .se-footer {
            background: #0F172A;
            color: #94A3B8;
            font-family: var(--font);
        }
        .se-footer h6 {
            color: #fff;
            font-weight: 600;
            font-size: 0.9rem;
            letter-spacing: -0.2px;
        }
        .se-footer a { color: #94A3B8; text-decoration: none; transition: color var(--transition); }
        .se-footer a:hover { color: #E2E8F0; }
        .se-footer-link {
            display: block;
            font-size: 0.85rem;
            color: #94A3B8;
            text-decoration: none;
            padding: 4px 0;
            transition: all var(--transition);
        }
        .se-footer-link:hover { color: #fff; padding-left: 4px; }
        .se-footer .social-btn {
            width: 36px; height: 36px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.12);
            display: flex; align-items: center; justify-content: center;
            color: #94A3B8; text-decoration: none;
            transition: all var(--transition);
            font-size: 0.9rem;
        }
        .se-footer .social-btn:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .se-section-title { font-size: 1.25rem; }
            :root { --nav-height: 64px; }
            .hero-content h1 { font-size: 2rem !important; }
            .hero-content p { font-size: 0.95rem !important; }
            .restaurant-hero { height: 35vh; min-height: 250px; }
            .floating-cart { bottom: 20px; right: 20px; width: 56px; height: 56px; font-size: 1.25rem; }
            .menu-title { font-size: 1rem !important; }
            .menu-price { font-size: 1.1rem !important; }
            .menu-body { padding: 16px !important; }
            .btn-order { padding: 8px 16px; font-size: 0.85rem; }
            .se-card, .card { border-radius: var(--radius-sm) !important; }
            .table-responsive { font-size: 0.9rem; }
            .container { padding-left: 16px; padding-right: 16px; }
        }

        @media (max-width: 576px) {
            .hero-content h1 { font-size: 1.75rem !important; letter-spacing: -0.5px; }
            .hero-content p { font-size: 0.9rem !important; }
            .restaurant-hero { height: 30vh; min-height: 220px; }
            .se-section-title { font-size: 1.15rem; }
            .menu-price { font-size: 1rem !important; }
            .btn-order { padding: 10px 18px; width: 100%; justify-content: center; }
            .menu-footer { flex-direction: column; gap: 10px !important; }
            .d-flex.gap-2 { gap: 0.5rem !important; }
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
                <a href="{{ route('home') }}" class="se-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('rooms.index') }}" class="se-nav-link {{ request()->routeIs('rooms.*') ? 'active' : '' }}">Rooms</a>
                <a href="{{ route('customer.restaurant.menu') }}" class="se-nav-link {{ request()->routeIs('customer.restaurant.*') ? 'active' : '' }}">Restaurant</a>
                @if(Route::has('admin.promos.index'))
                @endif
                <a href="{{ route('customer.contact') }}" class="se-nav-link {{ request()->routeIs('customer.contact') ? 'active' : '' }}">Contact</a>
            </div>

            {{-- Right --}}
            <div class="se-nav-right">
                <a href="{{ route('rooms.index') }}" class="se-icon-btn" title="Search">
                    <i class="bi bi-search"></i>
                </a>
                @auth
                    <a href="{{ route('customer.notifications') }}" class="se-icon-btn" title="Notifications">
                        <i class="bi bi-bell"></i>
                        <span class="badge-dot"></span>
                    </a>
                    <div class="se-nav-divider"></div>
                    <div class="dropdown">
                        <div class="se-avatar" data-bs-toggle="dropdown" aria-expanded="false" title="{{ auth()->user()->name }}">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="px-3 py-2 border-bottom" style="border-color: var(--border) !important;">
                                <div style="font-weight:700;font-size:0.85rem;color:var(--text);">{{ auth()->user()->name }}</div>
                                <div style="font-size:0.72rem;color:var(--text-muted);">{{ auth()->user()->email }}</div>
                            </li>
                            <li class="mt-1"><a class="dropdown-item" href="{{ route('customer.bookings') }}"><i class="bi bi-calendar-check"></i>My Bookings</a></li>
                            <li><a class="dropdown-item" href="{{ route('customer.restaurant.orders') }}"><i class="bi bi-receipt"></i>Restaurant Orders</a></li>
                            <li><a class="dropdown-item" href="{{ route('customer.wishlist') }}"><i class="bi bi-heart"></i>Wishlist</a></li>
                            <li><a class="dropdown-item" href="{{ route('customer.reviews') }}"><i class="bi bi-star"></i>My Reviews</a></li>
                            <li><a class="dropdown-item" href="{{ route('customer.profile') }}"><i class="bi bi-person"></i>Profile</a></li>
                            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'staff')
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2"></i>Admin Panel</a></li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#" onclick="event.preventDefault();document.getElementById('se-logout').submit();"><i class="bi bi-box-arrow-right"></i>Logout</a></li>
                        </ul>
                        <form id="se-logout" action="{{ route('customer.logout') }}" method="POST" class="d-none">@csrf</form>
                    </div>
                @else
                    <div class="se-nav-divider"></div>
                    <a href="{{ route('customer.login') }}" class="se-btn-outline"><i class="bi bi-person"></i><span>Sign In</span></a>
                    <a href="{{ route('customer.register') }}" class="se-btn-primary"><i class="bi bi-person-plus"></i><span>Sign Up</span></a>
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
                <i class="bi bi-house"></i> Home
            </a>
            <a href="{{ route('rooms.index') }}" class="se-drawer-link {{ request()->routeIs('rooms.*') ? 'active' : '' }}">
                <i class="bi bi-building"></i> Rooms
            </a>
            <a href="{{ route('customer.restaurant.menu') }}" class="se-drawer-link {{ request()->routeIs('customer.restaurant.*') ? 'active' : '' }}">
                <i class="bi bi-cup-hot"></i> Restaurant
            </a>
            <a href="{{ route('customer.contact') }}" class="se-drawer-link {{ request()->routeIs('customer.contact') ? 'active' : '' }}">
                <i class="bi bi-chat"></i> Contact
            </a>
            <div class="se-drawer-divider"></div>
            @auth
                <a href="{{ route('customer.bookings') }}" class="se-drawer-link">
                    <i class="bi bi-calendar-check"></i> My Bookings
                </a>
                <a href="{{ route('customer.restaurant.orders') }}" class="se-drawer-link">
                    <i class="bi bi-receipt"></i> Restaurant Orders
                </a>
                <a href="{{ route('customer.wishlist') }}" class="se-drawer-link">
                    <i class="bi bi-heart"></i> Wishlist
                </a>
                <a href="{{ route('customer.reviews') }}" class="se-drawer-link">
                    <i class="bi bi-star"></i> My Reviews
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
                    <i class="bi bi-box-arrow-in-right"></i> Sign In
                </a>
                <a href="{{ route('customer.register') }}" class="se-drawer-link">
                    <i class="bi bi-person-plus"></i> Sign Up Free
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
                <i class="bi bi-box-arrow-right"></i> Logout
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
                <div class="alert alert-info alert-dismissible fade show border-0 shadow-sm rounded-4" style="background:#EFF6FF;color:#1D4ED8;">
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

    {{-- ─── FOOTER (only shown on public pages via @push('footer')) ─── --}}
    @stack('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Midtrans Snap JS --}}
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>

    {{-- PWA: Service Worker + Update Prompt --}}
    <script>
        // ─── Service Worker Registration ───
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js').then((reg) => {
                    console.log('StayEase: SW registered');

                    // Check for updates
                    reg.addEventListener('updatefound', () => {
                        const newSW = reg.installing;
                        newSW.addEventListener('statechange', () => {
                            if (newSW.state === 'installed' && navigator.serviceWorker.controller) {
                                showUpdatePrompt(reg);
                            }
                        });
                    });
                }).catch((err) => {
                    console.log('StayEase: SW registration failed:', err);
                });
            });

            // Reload on controller change
            let refreshing = false;
            navigator.serviceWorker.addEventListener('controllerchange', () => {
                if (refreshing) return;
                refreshing = true;
                window.location.reload();
            });
        }

        // ─── Update Prompt ───
        function showUpdatePrompt(reg) {
            if (document.getElementById('se-pwa-update-toast')) return;

            const toast = document.createElement('div');
            toast.id = 'se-pwa-update-toast';
            toast.innerHTML = `
                <div style="display:flex;align-items:center;gap:12px;">
                    <i class="bi bi-arrow-clockwise" style="font-size:1.2rem;color:#2563EB;"></i>
                    <span style="flex:1;font-size:0.85rem;">Versi baru tersedia!</span>
                    <button id="se-update-btn" style="
                        background:#2563EB;color:#fff;border:none;border-radius:8px;
                        padding:8px 16px;font-size:0.8rem;font-weight:600;cursor:pointer;
                        font-family:'Poppins',sans-serif;
                    ">Update</button>
                    <button id="se-update-close" style="
                        background:transparent;color:#94A3B8;border:none;
                        font-size:1.2rem;cursor:pointer;padding:0 4px;
                    ">&times;</button>
                </div>
            `;
            toast.style.cssText = `
                position: fixed; bottom: 24px; left: 50%; transform: translateX(-50%);
                z-index: 9998;
                background: #fff; border: 1px solid #E2E8F0;
                border-radius: 16px; padding: 16px 20px;
                box-shadow: 0 8px 32px rgba(15,23,42,0.12);
                min-width: 320px; max-width: 90vw;
                font-family: 'Poppins', sans-serif;
                animation: sePwaFadeIn 0.5s ease;
            `;
            document.body.appendChild(toast);

            document.getElementById('se-update-btn').onclick = () => {
                if (reg.waiting) {
                    reg.waiting.postMessage({ type: 'SKIP_WAITING' });
                }
            };
            document.getElementById('se-update-close').onclick = () => toast.remove();

            setTimeout(() => { if (toast.parentNode) toast.remove(); }, 20000);
        }

        // ─── Animations ───
        const styleSheet = document.createElement('style');
        styleSheet.textContent = `
            @keyframes sePwaFadeIn {
                from { opacity: 0; transform: translateX(-50%) translateY(20px); }
                to { opacity: 1; transform: translateX(-50%) translateY(0); }
            }
        `;
        document.head.appendChild(styleSheet);
    </script>
    @stack('scripts')
</body>
</html>
