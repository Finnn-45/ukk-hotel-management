<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Daftar - {{ config('app.name', 'StayEase Hotel') }}</title>
    <meta name="description" content="Buat akun baru untuk booking hotel, restoran, dan layanan eksklusif.">
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
            --accent: #FBBF24;
            --text: #0F172A;
            --text-muted: #64748B;
            --border: #E2E8F0;
            --font: 'Inter', sans-serif;
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
            max-width: 950px;
            min-height: 600px;
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
        .hero-steps {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .hero-step {
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }
        .step-num {
            width: 30px; height: 30px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 0.78rem;
            font-weight: 700;
            flex-shrink: 0;
        }
        .step-text strong {
            display: block;
            color: #fff;
            font-size: 0.85rem;
            margin-bottom: 2px;
        }
        .step-text span {
            color: rgba(255,255,255,0.65);
            font-size: 0.8rem;
        }

        /* ─── RIGHT FORM ─── */
        .auth-form {
            width: 440px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 32px 40px;
            position: relative;
        }

        .back-home {
            position: absolute;
            top: 16px; left: 24px;
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
            margin-bottom: 20px;
        }
        .form-header .logo-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
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
            margin-bottom: 14px;
        }
        .alert-danger { background: #FEE2E2; color: #DC2626; border: 1px solid #FECACA; }
        .alert-success { background: #DCFCE7; color: #16A34A; border: 1px solid #BBF7D0; }

        /* ─── FORM ELEMENTS ─── */
        .form-group { margin-bottom: 14px; }
        .form-group label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 5px;
        }
        .input-wrap {
            position: relative;
        }
        .form-control-custom {
            width: 100%;
            padding: 10px 14px;
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

        .info-box {
            background: #EFF6FF;
            border: 1px solid #BFDBFE;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 0.8rem;
            color: #0369A1;
            display: flex;
            align-items: flex-start;
            gap: 8px;
            margin-bottom: 14px;
        }

        /* ─── CAPTCHA ─── */
        .captcha-wrap {
            background: #F8FAFC;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            padding: 10px;
            margin-bottom: 14px;
        }

        /* ─── BUTTON ─── */
        .btn-register {
            width: 100%;
            padding: 12px;
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
        .btn-register:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(2,132,199,0.4);
        }
        .btn-register:active { transform: translateY(0); }
        .btn-register:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        /* ─── FOOTER ─── */
        .form-footer {
            text-align: center;
            margin-top: 16px;
            padding-top: 16px;
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

        /* ─── SPINNER ─── */
        .spinner { display: none; }
        .spinner.show { display: inline-block; }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 768px) {
            body { padding: 0; background: #F0F5FF; align-items: flex-start; }
            .auth-container {
                border-radius: 0;
                min-height: 100vh;
                flex-direction: column;
                box-shadow: none;
            }
            .auth-hero { display: none; }
            .auth-form {
                width: 100%;
                padding: 32px 24px;
                flex: 1;
                justify-content: flex-start;
            }
            .back-home {
                position: static;
                margin-bottom: 20px;
                display: inline-flex;
                font-size: 0.78rem;
            }
            .form-header { margin-bottom: 20px; }
            .form-header .logo-row { margin-bottom: 12px; }
            .logo-icon { width: 32px; height: 32px; font-size: 0.85rem; }
            .logo-text { font-size: 0.95rem; }
            .form-header h2 { font-size: 1.25rem; }
            .form-header p { font-size: 0.82rem; }
            .form-group { margin-bottom: 12px; }
            .form-group label { font-size: 0.8rem; }
            .form-control-custom { padding: 11px 14px; font-size: 0.85rem; border-radius: 11px; }
            .captcha-wrap { padding: 8px; margin-bottom: 12px; }
            .info-box { font-size: 0.78rem; padding: 10px 12px; }
            .btn-register { padding: 12px; font-size: 0.88rem; border-radius: 11px; }
            .form-footer { margin-top: 14px; padding-top: 14px; font-size: 0.82rem; }
        }
        @media (max-width: 480px) {
            .auth-form { padding: 24px 18px; }
            .back-home { margin-bottom: 16px; }
            .form-header { margin-bottom: 16px; }
            .form-header .logo-row { margin-bottom: 10px; }
            .logo-icon { width: 28px; height: 28px; font-size: 0.75rem; }
            .logo-text { font-size: 0.85rem; }
            .form-header h2 { font-size: 1.1rem; }
            .form-header p { font-size: 0.78rem; }
            .form-group { margin-bottom: 10px; }
            .form-control-custom { padding: 10px 12px; font-size: 0.82rem; border-radius: 10px; }
            .btn-register { padding: 11px; font-size: 0.85rem; border-radius: 10px; }
            .form-footer { margin-top: 12px; padding-top: 12px; font-size: 0.78rem; }
        }
    </style>
</head>
<body>
    <div class="auth-container">

        {{-- LEFT HERO --}}
        <div class="auth-hero">
            <div class="hero-badge">
                <i class="bi bi-person-plus-fill" style="font-size:0.7rem;"></i>
                Bergabung Sekarang
            </div>
            <h1>Mulai Perjalanan<br>Anda Bersama <span>Kami</span></h1>
            <p>Daftar dan nikmati kemudahan booking kamar hotel premium, restoran eksklusif, dan berbagai layanan unggulan lainnya.</p>
            <div class="hero-steps">
                <div class="hero-step">
                    <div class="step-num">1</div>
                    <div class="step-text">
                        <strong>Buat akun gratis</strong>
                        <span>Hanya memerlukan email & password</span>
                    </div>
                </div>
                <div class="hero-step">
                    <div class="step-num">2</div>
                    <div class="step-text">
                        <strong>Verifikasi email</strong>
                        <span>Konfirmasi melalui email yang dikirimkan</span>
                    </div>
                </div>
                <div class="hero-step">
                    <div class="step-num">3</div>
                    <div class="step-text">
                        <strong>Mulai booking</strong>
                        <span>Nikmati semua fasilitas hotel bintang 5</span>
                    </div>
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
                <h2>Buat Akun Baru</h2>
                <p>Isi formulir di bawah untuk mendaftar</p>
            </div>

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

            <div class="info-box">
                <i class="bi bi-info-circle-fill" style="flex-shrink:0;margin-top:2px;"></i>
                <span>Setelah registrasi, cek email Anda untuk melakukan verifikasi akun sebelum bisa login.</span>
            </div>

            <form method="POST" action="{{ route('customer.register') }}" id="registerForm">
                @csrf

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <div class="input-wrap">
                        <input type="text" id="name" name="name"
                               class="form-control-custom @error('name') is-invalid @enderror"
                               placeholder="Nama lengkap Anda" value="{{ old('name') }}" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-wrap">
                        <input type="email" id="email" name="email"
                               class="form-control-custom @error('email') is-invalid @enderror"
                               placeholder="nama@email.com" value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <input type="password" id="password" name="password"
                               class="form-control-custom @error('password') is-invalid @enderror"
                               placeholder="Minimal 6 karakter" required>
                        <button type="button" class="password-toggle" onclick="togglePass('password', this)" tabindex="-1">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <div class="input-wrap">
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="form-control-custom" placeholder="Ulangi password" required>
                        <button type="button" class="password-toggle" onclick="togglePass('password_confirmation', this)" tabindex="-1">
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

                <button type="submit" class="btn-register" id="submitBtn">
                    <span class="spinner" id="spinner">
                        <span class="spinner-border spinner-border-sm" role="status"></span>
                    </span>
                    <span id="btnText"><i class="bi bi-person-plus-fill"></i> Daftar Sekarang</span>
                </button>
            </form>

            <div class="form-footer">
                Sudah punya akun? <a href="{{ route('customer.login') }}">Masuk di sini</a>
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
    document.getElementById('registerForm')?.addEventListener('submit', function(e) {
        const btn = document.getElementById('submitBtn');
        const spinner = document.getElementById('spinner');
        const btnText = document.getElementById('btnText');
        btn.disabled = true;
        spinner.classList.add('show');
        btnText.textContent = '  Mendaftarkan...';
    });
    </script>
</body>
</html>
