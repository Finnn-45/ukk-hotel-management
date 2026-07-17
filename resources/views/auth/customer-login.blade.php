<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Masuk - {{ config('app.name', 'StayEase Hotel') }}</title>
    <meta name="description" content="Login ke akun StayEase Hotel untuk booking kamar dan layanan eksklusif.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {!! NoCaptcha::renderJs() !!}
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
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 0.82rem;
            display: flex;
            align-items: flex-start;
            gap: 8px;
            margin-bottom: 16px;
        }
        .alert-success { background: #DCFCE7; color: #16A34A; border: 1px solid #BBF7D0; }
        .alert-info { background: #E0F2FE; color: #0369A1; border: 1px solid #BAE6FD; }
        .alert-danger { background: #FEE2E2; color: #DC2626; border: 1px solid #FECACA; }

        /* ─── FORM ELEMENTS ─── */
        .form-group { margin-bottom: 16px; }
        .form-group label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 6px;
        }
        .input-wrap {
            position: relative;
        }
        .input-icon {
            position: absolute;
            left: 13px; top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 0.95rem;
            pointer-events: none;
            z-index: 2;
        }
        .form-control-custom {
            width: 100%;
            padding: 11px 16px;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            font-size: 0.87rem;
            font-family: var(--font);
            color: var(--text);
            background: #F8FAFC;
            transition: all 0.2s;
            outline: none;
        }
        .form-control-custom:focus {
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(2,132,199,0.08);
        }
        .form-control-custom.is-invalid {
            border-color: #DC2626;
            background: #FEF2F2;
        }
        .password-toggle {
            position: absolute;
            right: 12px; top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            padding: 4px;
            font-size: 0.95rem;
            transition: color 0.2s;
            z-index: 2;
        }
        .password-toggle:hover { color: var(--primary); }

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }
        .remember-check {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-size: 0.83rem;
            color: var(--text-muted);
            font-family: var(--font);
        }
        .remember-check input[type="checkbox"] {
            width: 15px; height: 15px;
            accent-color: var(--primary);
            cursor: pointer;
        }
        .forgot-link {
            font-size: 0.83rem;
            color: var(--primary);
            font-weight: 500;
            text-decoration: none;
        }
        .forgot-link:hover { text-decoration: underline; }

        /* ─── CAPTCHA ─── */
        .captcha-wrap {
            background: #F8FAFC;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            padding: 10px;
            margin-bottom: 16px;
        }

        /* ─── BUTTON ─── */
        .btn-login {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 0.92rem;
            font-weight: 700;
            font-family: var(--font);
            cursor: pointer;
            transition: all 0.25s;
            box-shadow: 0 4px 15px rgba(2,132,199,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(2,132,199,0.4);
        }
        .btn-login:active { transform: translateY(0); }
        .btn-login:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        /* ─── FOOTER ─── */
        .form-footer {
            text-align: center;
            margin-top: 20px;
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
        .form-footer .admin-link {
            display: block;
            margin-top: 8px;
            font-size: 0.78rem;
            color: var(--text-muted);
        }

        /* ─── SPINNER ─── */
        .spinner { display: none; }
        .spinner.show { display: inline-block; }

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
            .form-options { flex-wrap: wrap; gap: 8px; }
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
            <h1>Selamat Datang<br>di <span>StayEase</span></h1>
            <p>Temukan pengalaman menginap terbaik dengan layanan premium dan kemudahan booking 24/7.</p>
            <div class="hero-features">
                <div class="hero-feature">
                    <div class="hero-feature-icon"><i class="bi bi-building-fill"></i></div>
                    Pilihan kamar hotel bintang 5 eksklusif
                </div>
                <div class="hero-feature">
                    <div class="hero-feature-icon"><i class="bi bi-fork-knife"></i></div>
                    Restoran mewah dari kamar Anda
                </div>
                <div class="hero-feature">
                    <div class="hero-feature-icon"><i class="bi bi-shield-fill-check"></i></div>
                    Pembayaran aman & terpercaya
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
                <h2>Masuk ke Akun</h2>
                <p>Silakan masukkan email dan password Anda</p>
            </div>

            {{-- Alert Success --}}
            @if(session('success'))
                <div class="alert-custom alert-success">
                    <i class="bi bi-check-circle-fill" style="flex-shrink:0;margin-top:1px;"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- Alert Info --}}
            @if(session('status'))
                <div class="alert-custom alert-info">
                    <i class="bi bi-info-circle-fill" style="flex-shrink:0;margin-top:1px;"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            {{-- Alert Error --}}
            @if(session('error'))
                <div class="alert-custom alert-danger">
                    <i class="bi bi-exclamation-circle-fill" style="flex-shrink:0;margin-top:1px;"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="alert-custom alert-danger">
                    <i class="bi bi-exclamation-circle-fill" style="flex-shrink:0;margin-top:1px;"></i>
                    <div>
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('customer.login') }}" id="loginForm">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-wrap">
                        <input type="email" id="email" name="email"
                               class="form-control-custom @error('email') is-invalid @enderror"
                               placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <input type="password" id="password" name="password"
                               class="form-control-custom @error('password') is-invalid @enderror"
                               placeholder="Masukkan password" required>
                        <button type="button" class="password-toggle" onclick="togglePass('password', this)" tabindex="-1">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="captcha-wrap">
                    {!! NoCaptcha::display() !!}
                    @error('g-recaptcha-response')
                        <div style="color:#DC2626;font-size:0.78rem;margin-top:6px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-options">
                    <label class="remember-check">
                        <input type="checkbox" name="remember" id="remember">
                        <span>Ingat saya</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="forgot-link">Lupa password?</a>
                </div>

                <button type="submit" class="btn-login" id="submitBtn">
                    <span class="spinner" id="spinner">
                        <span class="spinner-border spinner-border-sm" role="status"></span>
                    </span>
                    <span id="btnText"><i class="bi bi-box-arrow-in-right"></i> Masuk</span>
                </button>
            </form>

            <div class="form-footer">
                Belum punya akun? <a href="{{ route('customer.register') }}">Daftar sekarang</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function togglePass(inputId, btn) {
        const input = document.getElementById(inputId);
        const icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'bi bi-eye-slash';
        } else {
            input.type = 'password';
            icon.className = 'bi bi-eye';
        }
    }

    // Loading state on submit
    document.getElementById('loginForm')?.addEventListener('submit', function(e) {
        const btn = document.getElementById('submitBtn');
        const spinner = document.getElementById('spinner');
        const btnText = document.getElementById('btnText');
        btn.disabled = true;
        spinner.classList.add('show');
        btnText.textContent = '  Memproses...';
    });
    </script>
</body>
</html>
