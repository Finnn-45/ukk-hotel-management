<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> - StayEase Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#0284C7">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link rel="apple-touch-icon" href="/icons/icon-192x192.svg">
    <style>
        :root {
            --sidebar-width: 260px;
            --primary: #0284C7;
            --primary-dark: #0369A1;
            --primary-light: #E0F2FE;
            --bg-dark: #0F172A;
            --bg-sidebar: #0F172A;
            --bg-main: #F1F5F9;
            --text-sidebar: #94A3B8;
            --text-sidebar-active: #fff;
            --radius: 16px;
            --radius-sm: 12px;
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-main);
            color: #334155;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--bg-sidebar);
            z-index: 100;
            overflow-y: auto;
            border-right: 1px solid rgba(255,255,255,0.05);
            transition: all 0.3s ease;
        }
        .sidebar-brand {
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .sidebar-brand .logo-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #0284C7, #0369A1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 900;
            font-size: 0.85rem;
        }
        .sidebar-brand h5 {
            color: #fff;
            font-weight: 800;
            margin: 0;
            font-size: 1rem;
        }
        .sidebar-brand h5 span { color: #38BDF8; }
        .sidebar-brand small {
            color: #64748B;
            font-size: 0.7rem;
            display: block;
        }
        .sidebar-section {
            color: #475569;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            padding: 20px 20px 8px;
            letter-spacing: 1.5px;
        }
        .sidebar .nav-link {
            color: var(--text-sidebar);
            padding: 10px 16px;
            margin: 3px 12px;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .sidebar .nav-link i {
            font-size: 1.05rem;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }
        .sidebar .nav-link:hover {
            color: #F1F5F9;
            background: rgba(255,255,255,0.06);
        }
        .sidebar .nav-link.active {
            color: #fff;
            background: linear-gradient(135deg, #0284C7, #0369A1);
            box-shadow: 0 4px 12px rgba(2,132,199,0.3);
        }
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 24px 32px;
            min-height: 100vh;
        }
        .top-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid #E2E8F0;
        }
        .top-bar h4 {
            font-weight: 700;
            margin: 0;
            color: #334155;
        }
        .top-bar-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .admin-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0284C7, #0369A1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 0.8rem;
            cursor: pointer;
        }
        .card {
            border: none;
            border-radius: var(--radius);
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
            overflow: hidden;
            background: #fff;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.08);
        }
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            transition: all 0.3s ease;
        }
        .stat-icon-primary { background: rgba(2,132,199,0.1); color: #0284C7; }
        .stat-icon-success { background: rgba(34,197,94,0.1); color: #16A34A; }
        .stat-icon-warning { background: rgba(251,191,36,0.1); color: #D97706; }
        .stat-icon-info { background: rgba(6,182,212,0.1); color: #0891B2; }
        .stat-icon-purple { background: rgba(139,92,246,0.1); color: #7C3AED; }
        .stat-icon-danger { background: rgba(239,68,68,0.1); color: #DC2626; }
        .card-hover:hover .stat-icon { transform: scale(1.1); }
        .badge-premium {
            padding: 5px 12px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.72rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .badge-premium-success { background: #DCFCE7; color: #16A34A; }
        .badge-premium-warning { background: #FEF3C7; color: #D97706; }
        .badge-premium-danger { background: #FEE2E2; color: #DC2626; }
        .badge-premium-info { background: #E0F2FE; color: #0284C7; }
        .badge-premium-secondary { background: #F1F5F9; color: #64748B; }
        /* Premium Pagination */
        .pagination-premium .page-link {
            border: none;
            padding: 6px 14px;
            margin: 0 3px;
            border-radius: 10px;
            font-size: 0.82rem;
            font-weight: 600;
            color: #475569;
            background: #F1F5F9;
            transition: all 0.2s ease;
        }
        .pagination-premium .page-link:hover {
            background: #E2E8F0;
            color: #334155;
            transform: translateY(-1px);
        }
        .pagination-premium .page-item.active .page-link {
            background: linear-gradient(135deg, #0284C7, #0369A1);
            color: #fff;
            box-shadow: 0 4px 12px rgba(2,132,199,0.3);
        }
        .pagination-premium .page-item.disabled .page-link {
            background: #F8FAFC;
            color: #CBD5E1;
        }
        .pagination-premium .page-item:first-child .page-link,
        .pagination-premium .page-item:last-child .page-link {
            padding: 6px 12px;
        }
        .pagination-premium .page-link.dots {
            background: transparent;
            color: #94A3B8;
        }

        .table-custom th {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748B;
            padding: 14px 20px;
            background: #F8FAFC;
            border-bottom: 1px solid #E2E8F0;
        }
        .table-custom td {
            padding: 14px 20px;
            vertical-align: middle;
            font-size: 0.85rem;
            border-bottom: 1px solid #F1F5F9;
        }
        .table-custom tr:last-child td { border-bottom: none; }

        /* Room Status Grid */
        .room-status-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(60px, 1fr));
            gap: 8px;
        }
        .room-status-item {
            width: 100%;
            aspect-ratio: 1;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.2s;
            border: 2px solid transparent;
        }
        .room-status-item:hover { transform: scale(1.1); }
        .room-available { background: #DCFCE7; color: #16A34A; border-color: #BBF7D0; }
        .room-occupied { background: #FEE2E2; color: #DC2626; border-color: #FECACA; }
        .room-cleaning { background: #FEF3C7; color: #D97706; border-color: #FDE68A; }
        .room-maintenance { background: #F1F5F9; color: #64748B; border-color: #E2E8F0; }

        /* Activity Timeline */
        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #F1F5F9;
        }
        .activity-item:last-child { border-bottom: none; }
        .activity-dot {
            width: 10px; height: 10px;
            border-radius: 50%;
            margin-top: 6px;
            flex-shrink: 0;
        }
        .activity-time {
            font-size: 0.72rem;
            color: #94A3B8;
            font-weight: 500;
        }

        /* Quick Action Buttons */
        .quick-action-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 18px;
            border-radius: 12px;
            border: 1.5px solid #E2E8F0;
            background: #fff;
            transition: all 0.2s;
            text-decoration: none;
            color: #334155;
            font-weight: 600;
            font-size: 0.85rem;
        }
        .quick-action-btn:hover {
            border-color: #0284C7;
            background: #E0F2FE;
            color: #0284C7;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .sidebar { width: 100%; position: relative; height: auto; max-height: 280px; overflow-y: auto; }
            .main-content { margin-left: 0; padding: 16px; }
            .top-bar { flex-direction: column; align-items: flex-start; gap: 12px; }
        }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <div class="sidebar d-none d-md-block">
        <div class="sidebar-brand">
            <div class="logo-icon">SE</div>
            <div>
                <h5>Stay<span>Ease</span></h5>
                <small><?php echo e(auth()->user()->name); ?></small>
            </div>
        </div>
        <ul class="nav flex-column">
            <li class="sidebar-section">Dashboard</li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('admin.dashboard')); ?>">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="sidebar-section">Manajemen Hotel</li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.rooms.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.rooms.index')); ?>">
                    <i class="bi bi-door-open"></i> Kamar
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.room-types.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.room-types.index')); ?>">
                    <i class="bi bi-tags"></i> Tipe Kamar
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.bookings.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.bookings.index')); ?>">
                    <i class="bi bi-calendar-check"></i> Reservasi
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin.bookings.index', ['status' => 'checked_in'])); ?>">
                    <i class="bi bi-box-arrow-in-right"></i> Check In
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin.bookings.index', ['status' => 'checked_out'])); ?>">
                    <i class="bi bi-box-arrow-right"></i> Check Out
                </a>
            </li>
            <li class="sidebar-section">Restoran</li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.restaurant.menu.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.restaurant.menu.index')); ?>">
                    <i class="bi bi-menu-app"></i> Menu
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin.restaurant.menu.index')); ?>">
                    <i class="bi bi-tags"></i> Kategori Menu
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.restaurant.order.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.restaurant.order.index')); ?>">
                    <i class="bi bi-receipt"></i> Pesanan
                </a>
            </li>
            <li class="sidebar-section">Pelanggan</li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.guests.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.guests.index')); ?>">
                    <i class="bi bi-people"></i> Pelanggan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.users.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.users.index')); ?>">
                    <i class="bi bi-person-badge"></i> Users
                </a>
            </li>
            <li class="sidebar-section">Review</li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.reviews.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.reviews.index')); ?>">
                    <i class="bi bi-star"></i> Review
                </a>
            </li>
            <li class="sidebar-section">Laporan</li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('admin.dashboard')); ?>">
                    <i class="bi bi-file-earmark-bar-graph"></i> Laporan
                </a>
            </li>
            <li class="sidebar-section">Pengaturan</li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.settings.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.settings.index')); ?>">
                    <i class="bi bi-gear"></i> Pengaturan
                </a>
            </li>
            <li class="sidebar-section">Akun</li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('home')); ?>" target="_blank">
                    <i class="bi bi-globe"></i> Lihat Website
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
                <form id="logout-form" action="<?php echo e(route('admin.logout')); ?>" method="POST" class="d-none"><?php echo csrf_field(); ?></form>
            </li>
        </ul>
    </div>

    
    <nav class="navbar navbar-dark bg-dark d-md-none">
        <div class="container-fluid">
            <span class="navbar-brand fw-bold"><i class="bi bi-building me-2"></i>StayEase Admin</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mobileNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.rooms.index')); ?>">Kamar</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.room-types.index')); ?>">Tipe Kamar</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.bookings.index')); ?>">Reservasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.restaurant.menu.index')); ?>">Menu Restoran</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.restaurant.order.index')); ?>">Pesanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.guests.index')); ?>">Tamu</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.payments.index')); ?>">Pembayaran</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.reviews.index')); ?>">Review</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.dashboard')); ?>">Laporan</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.settings.index')); ?>">Pengaturan</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('home')); ?>">Website</a></li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                        <form id="logout-form-mobile" action="<?php echo e(route('admin.logout')); ?>" method="POST" class="d-none"><?php echo csrf_field(); ?></form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="main-content">
        <div class="top-bar">
            <div>
                <h4><?php echo $__env->yieldContent('title', 'Dashboard'); ?></h4>
                <small class="text-muted">StayEase Administration Panel</small>
            </div>
            <div class="top-bar-actions">
                <a href="<?php echo e(route('home')); ?>" class="btn btn-sm btn-outline-primary rounded-3" target="_blank">
                    <i class="bi bi-box-arrow-up-right"></i>
                </a>
                <div class="dropdown">
                    <div class="admin-avatar" data-bs-toggle="dropdown">
                        <?php echo e(strtoupper(substr(auth()->user()->name, 0, 2))); ?>

                    </div>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg rounded-4 border-0 p-2" style="min-width:200px;">
                        <li class="px-3 py-2">
                            <div class="fw-bold small"><?php echo e(auth()->user()->name); ?></div>
                            <div class="text-muted" style="font-size:0.75rem;"><?php echo e(auth()->user()->email); ?></div>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item rounded-3" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" style="background:#DCFCE7;color:#16A34A;">
                <i class="bi bi-check-circle me-2"></i> <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" style="background:#FEE2E2;color:#DC2626;">
                <i class="bi bi-exclamation-circle me-2"></i> <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>

    
</body>
</html>
<?php /**PATH C:\laragon\www\ukk-hotel-management\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>