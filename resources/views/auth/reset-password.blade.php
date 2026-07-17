<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Reset Password - {{ config('app.name', 'StayEase Hotel') }}</title>
    <meta name="description" content="Buat password baru untuk akun StayEase Hotel Anda.">
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
        .form-header { margin-bottom: 24px; }
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
        .form-header p { color: var(--text-muted); font-size: 0.85rem; }
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
        .alert-danger { background: #FEE2E2; color: #DC2626; border: 1px solid #FECACA; }
        .form-group { margin-bottom: 16px; }
        .form-group label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 6px;
        }
        .input-wrap { position: relative; }
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
            padding: 11px 16px 11px 42px;
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
        .form-control-custom-has-toggle { padding-right: 48px; }
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
        .error-text { color: #DC2626; font-size: 0.78rem; margin-top: 6px; }
        .btn-custom {
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
            margin-top: 4px;
        }
        .btn-custom:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(2,132,199,0.4);
        }
        .btn-custom:active { transform: translateY(0); }
        .btn-custom:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }
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
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .form-footer a:hover { text-decoration: underline; }
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
            .auth-form { width: 100%; padding: 28px 20px 24px; }
            .back-home { top: 16px; left: 16px; }
            .form-header .logo-row { margin-bottom: 16px; }
            .form-header h2 { font-size: 1.2rem; }
        }
        @media (max-width: 480px) {
            .auth-hero { padding: 24px 20px 20px; }
            .auth-form { padding: 20px 16px 20px; }
            .auth-hero h1 { font-size: 1.3rem; }
            .hero-badge { font-size: 0.7rem; padding: 4px 12px; }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-hero">
            <div class="hero-badge">
                <i class="bi bi-star-fill" style="font-size:0.7rem;color:#FBBF24;"></i>
                Hotel & Restaurant Booking
            </div>
            <h1>Buat Password<br><span>Baru</span></h1>
            <p>Masukkan password baru Anda. Pastikan password cukup kuat dan mudah diingat.</p>
            <div class="hero-features">
                <div class="hero-feature">
                    <div class="hero-feature-icon"><i class="bi bi-lock-fill"></i></div>
                    Minimal 8 karakter
                </div>
                <div class="hero-feature">
                    <div class="hero-feature-icon"><i class="bi bi-shield-fill-check"></i></div>
                    Keamanan akun terjaga
                </div>
                <div class="hero-feature">
                    <div class="hero-feature-icon"><i class="bi bi-check-circle-fill"></i></div>
                    Gunakan kombinasi huruf & angka
                </div>
            </div>
        </div>
        <div class="auth-form">
            <a href="{{ route('customer.login') }}" class="back-home">
                <i class="bi bi-arrow-left"></i> Kembali ke Login
            </a>
            <div class="form-header">
                <div class="logo-row">
                    <div class="logo-icon">S</div>
                    <div class="logo-text">Stay<span>Ease</span></div>
                </div>
                <h2>Reset Password</h2>
                <p>Masukkan password baru untuk akun Anda</p>
            </div>
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
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">
                    <label>Email</label>
                    <div class="input-wrap">
                        <i class="bi bi-envelope input-icon"></i>
                        <input type="email" name="email" class="form-control-custom" value="{{ $email }}" readonly style="background:#F1F5F9;cursor:not-allowed;color:var(--text-muted);">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password Baru</label>
                    <div class="input-wrap">
                        <i class="bi bi-lock input-icon"></i>
                        <input type="password" id="password" name="password" class="form-control-custom form-control-custom-has-toggle @error('password') is-invalid @enderror"
                               placeholder="Minimal 8 karakter" required minlength="8">
                        <button type="button" class="password-toggle" onclick="togglePass('password', this)" tabindex="-1">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <div class="input-wrap">
                        <i class="bi bi-lock-fill input-icon"></i>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control-custom form-control-custom-has-toggle"
                               placeholder="Ulangi password baru" required minlength="8">
                        <button type="button" class="password-toggle" onclick="togglePass('password_confirmation', this)" tabindex="-1">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>
                <button type="submit" class="btn-custom">
                    <i class="bi bi-check-circle-fill"></i>
                    Simpan Password Baru
                </button>
            </form>
            <div class="form-footer">
                <a href="{{ route('customer.login') }}">
                    <i class="bi bi-arrow-left"></i> Kembali ke halaman login
                </a>
            </div>
        </div>
    </div>
    <script>
    function togglePass(inputId, btn) {
        const input = document.getElementById(inputId);
        const icon = btn.querySelector('i');
        input.type = input.type === 'password' ? 'text' : 'password';
        icon.className = input.type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
    }
    </script>
</body>
</html>