<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Verifikasi Email - {{ config('app.name', 'StayEase Hotel') }}</title>
    <meta name="description" content="Verifikasi alamat email Anda untuk mengaktifkan akun StayEase Hotel.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary: #0284C7;
            --primary-dark: #0369A1;
            --primary-light: #E0F2FE;
            --accent: #FBBF24;
            --text: #0F172A;
            --text-muted: #64748B;
            --border: #E2E8F0;
            --font: 'Inter', sans-serif;
            --shadow: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
            --shadow-lg: 0 10px 40px rgba(0,0,0,0.08);
        }

        body {
            font-family: var(--font);
            min-height: 100vh;
            background: #F0F5FF;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-container {
            display: flex;
            width: 100%;
            max-width: 900px;
            min-height: 580px;
            background: #fff;
            border-radius: 24px;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            position: relative;
        }

        /* ─── LEFT HERO ─── */
        .auth-hero {
            flex: 1;
            background: linear-gradient(145deg, #1e3a8a 0%, #0369A1 50%, #0284C7 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 48px 44px;
            position: relative;
            overflow: hidden;
        }
        .auth-hero::before {
            content: '';
            position: absolute;
            width: 350px; height: 350px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
            top: -80px; right: -80px;
        }
        .auth-hero::after {
            content: '';
            position: absolute;
            width: 250px; height: 250px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
            bottom: -60px; left: -60px;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            color: #fff;
            border-radius: 100px;
            padding: 6px 16px;
            font-size: 0.75rem;
            font-weight: 500;
            margin-bottom: 24px;
            backdrop-filter: blur(8px);
            width: fit-content;
        }
        .auth-hero h1 {
            color: #fff;
            font-size: 2rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 12px;
            letter-spacing: -0.5px;
        }
        .auth-hero h1 span { color: var(--accent); }
        .auth-hero > p {
            color: rgba(255,255,255,0.75);
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 32px;
            max-width: 320px;
        }
        .hero-features {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }
        .hero-feature {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255,255,255,0.85);
            font-size: 0.85rem;
        }
        .hero-feature-icon {
            width: 32px; height: 32px;
            background: rgba(255,255,255,0.12);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            color: #fff;
            flex-shrink: 0;
        }

        /* ─── RIGHT FORM ─── */
        .auth-form {
            width: 420px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 40px 40px;
            position: relative;
        }

        .back-home {
            position: absolute;
            top: 20px; left: 24px;
            display: flex;
            align-items: center;
            gap: 6px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 500;
            transition: color 0.2s;
        }
        .back-home:hover { color: var(--primary); }

        .form-header {
            margin-bottom: 24px;
        }
        .form-header .logo-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        .logo-icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 900;
            font-size: 0.95rem;
            box-shadow: 0 4px 12px rgba(2,132,199,0.3);
        }
        .logo-text { font-size: 1rem; font-weight: 800; color: var(--text); }
        .logo-text span { color: var(--primary); }
        .form-header h2 {
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 4px;
        }
        .form-header p {
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        /* ─── ALERTS ─── */
        .alert-custom {
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 0.84rem;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 18px;
            line-height: 1.5;
        }
        .alert-success { background: #DCFCE7; color: #16A34A; border: 1px solid #BBF7D0; }
        .alert-info { background: #E0F2FE; color: #0369A1; border: 1px solid #BAE6FD; }
        .alert-warning { background: #FEF3C7; color: #D97706; border: 1px solid #FDE68A; }

        /* ─── CONTENT ─── */
        .verify-content {
            margin-bottom: 24px;
        }
        .verify-content p {
            font-size: 0.88rem;
            color: var(--text-muted);
            line-height: 1.7;
            margin-bottom: 10px;
        }
        .verify-icon {
            width: 64px; height: 64px;
            background: #E0F2FE;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            color: var(--primary);
            margin: 0 auto 16px;
        }

        /* ─── BUTTONS ─── */
        .btn-custom {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 12px;
            font-size: 0.92rem;
            font-weight: 700;
            font-family: var(--font);
            cursor: pointer;
            transition: all 0.25s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff;
            box-shadow: 0 4px 15px rgba(2,132,199,0.3);
        }
        .btn-primary-custom:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(2,132,199,0.4);
            color: #fff;
        }
        .btn-primary-custom:active { transform: translateY(0); }
        .btn-primary-custom:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .btn-outline-custom {
            background: transparent;
            color: var(--text-muted);
            border: 1.5px solid var(--border);
        }
        .btn-outline-custom:hover {
            background: #F8FAFC;
            border-color: #CBD5E1;
            color: var(--text);
        }

        .btn-group-stack {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 8px;
        }

        /* ─── FOOTER ─── */
        .form-footer {
            text-align: center;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
            font-size: 0.84rem;
            color: var(--text-muted);
            font-family: var(--font);
        }
        .form-footer a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }
        .form-footer a:hover { text-decoration: underline; }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 768px) {
            body { padding: 0; background: #fff; }
            .auth-container {
                border-radius: 0;
                min-height: auto;
                flex-direction: column;
                box-shadow: none;
            }
            .auth-hero {
                padding: 32px 24px 28px;
                border-radius: 0 0 24px 24px;
                flex: none;
            }
            .auth-hero h1 { font-size: 1.5rem; }
            .auth-hero > p { font-size: 0.82rem; margin-bottom: 20px; }
            .hero-features { gap: 10px; }
            .hero-feature { font-size: 0.8rem; }
            .hero-feature-icon { width: 28px; height: 28px; font-size: 0.8rem; }
            .auth-form {
                width: 100%;
                padding: 28px 20px 24px;
            }
            .back-home { top: 16px; left: 16px; }
            .form-header .logo-row { margin-bottom: 16px; }
            .form-header h2 { font-size: 1.2rem; }
        }
        @media (max-width: 480px) {
            .auth-hero { padding: 24px 20px 20px; }
            .auth-form { padding: 20px 16px 20px; }
            .auth-hero h1 { font-size: 1.3rem; }
            .hero-badge { font-size: 0.7rem; padding: 4px 12px; }
            .form-header h2 { font-size: 1.1rem; }
        }
    </style>
</head>
<body>
    <div class="auth-container">

        {{-- LEFT HERO --}}
        <div class="auth-hero">
            <div class="hero-badge">
                <i class="bi bi-star-fill" style="font-size:0.7rem;color:#FBBF24;"></i>
                Hotel & Restaurant Booking
            </div>
            <h1>Verifikasi<br><span>Email Anda</span></h1>
            <p>Konfirmasi alamat email Anda untuk mengaktifkan akun dan mulai melakukan pemesanan.</p>
            <div class="hero-features">
                <div class="hero-feature">
                    <div class="hero-feature-icon"><i class="bi bi-check-lg"></i></div>
                    Konfirmasi email dalam 1 klik
                </div>
                <div class="hero-feature">
                    <div class="hero-feature-icon"><i class="bi bi-shield-fill-check"></i></div>
                    Keamanan akun terjamin
                </div>
                <div class="hero-feature">
                    <div class="hero-feature-icon"><i class="bi bi-rocket-takeoff-fill"></i></div>
                    Akses fitur booking eksklusif
                </div>
            </div>
        </div>

        {{-- RIGHT FORM --}}
        <div class="auth-form">
            <a href="{{ route('home') }}" class="back-home">
                <i class="bi bi-arrow-left"></i> Beranda
            </a>

            <div class="form-header">
                <div class="logo-row">
                    <div class="logo-icon">S</div>
                    <div class="logo-text">Stay<span>Ease</span></div>
                </div>
                <h2>Verifikasi Email</h2>
                <p>Konfirmasi alamat email akun Anda</p>
            </div>

            <div class="verify-content">
                <div class="verify-icon">
                    <i class="bi bi-envelope-check-fill"></i>
                </div>
                <p>Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengklik tautan yang telah kami kirimkan ke email Anda.</p>
                <p class="mb-0">Jika Anda tidak menerima email tersebut, klik tombol di bawah untuk mengirim ulang.</p>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="alert-custom alert-success">
                    <i class="bi bi-check-circle-fill" style="flex-shrink:0;margin-top:1px;"></i>
                    <span>Tautan verifikasi baru telah dikirim ke alamat email yang Anda daftarkan.</span>
                </div>
            @endif

            <div class="btn-group-stack">
                <form method="POST" action="{{ route('verification.send') }}" id="resendForm">
                    @csrf
                    <button type="submit" class="btn-custom btn-primary-custom" id="resendBtn">
                        <span class="spinner-border spinner-border-sm d-none" id="resendSpinner" role="status"></span>
                        <span id="resendText"><i class="bi bi-send-fill"></i> Kirim Ulang Email Verifikasi</span>
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-custom btn-outline-custom">
                        <i class="bi bi-box-arrow-right"></i> Keluar
                    </button>
                </form>
            </div>

            <div class="form-footer">
                Sudah diverifikasi? <a href="{{ route('customer.login') }}">Masuk sekarang</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.getElementById('resendForm')?.addEventListener('submit', function(e) {
        const btn = document.getElementById('resendBtn');
        const spinner = document.getElementById('resendSpinner');
        const text = document.getElementById('resendText');
        btn.disabled = true;
        spinner.classList.remove('d-none');
        text.textContent = '  Mengirim...';
    });
    </script>
</body>
</html>