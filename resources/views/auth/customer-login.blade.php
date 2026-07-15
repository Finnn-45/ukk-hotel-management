<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ config('app.name', 'StayEase Hotel') }}</title>
    <meta name="description" content="Login ke akun Anda untuk menikmati layanan booking hotel terbaik.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {!! NoCaptcha::renderJs() !!}
    <style>
        :root {
            --primary: #0284C7;
            --primary-dark: #0369A1;
            --primary-light: #E0F2FE;
            --accent: #FBBF24;
            --text: #0F172A;
            --text-muted: #64748B;
            --border: #E2E8F0;
            --font: 'Poppins', sans-serif;
            --font-alt: 'Inter', sans-serif;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: var(--font);
            min-height: 100vh;
            display: flex;
            align-items: stretch;
            background: #0F172A;
        }

        /* ─── Split Layout ─── */
        .auth-wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        /* Left Panel - Hero */
        .auth-hero {
            flex: 1;
            background: linear-gradient(145deg, #1e3a8a 0%, #0369A1 40%, #0284C7 70%, #3b82f6 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            padding: 60px 56px;
            position: relative;
            overflow: hidden;
        }
        .auth-hero::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
            top: -100px;
            right: -100px;
        }
        .auth-hero::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
            bottom: -80px;
            left: -60px;
        }
        .auth-hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            color: #fff;
            border-radius: 100px;
            padding: 6px 16px;
            font-size: 0.78rem;
            font-weight: 500;
            margin-bottom: 28px;
            letter-spacing: 0.3px;
            backdrop-filter: blur(8px);
        }
        .auth-hero h1 {
            color: #fff;
            font-size: 2.8rem;
            font-weight: 800;
            line-height: 1.15;
            margin-bottom: 20px;
            letter-spacing: -0.5px;
        }
        .auth-hero h1 span { color: var(--accent); }
        .auth-hero p {
            color: rgba(255,255,255,0.75);
            font-family: var(--font-alt);
            font-size: 1rem;
            line-height: 1.7;
            max-width: 380px;
            margin-bottom: 40px;
        }
        .auth-features {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }
        .auth-feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255,255,255,0.85);
            font-size: 0.9rem;
            font-family: var(--font-alt);
        }
        .auth-feature-icon {
            width: 36px;
            height: 36px;
            background: rgba(255,255,255,0.15);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: #fff;
            flex-shrink: 0;
        }
        .auth-hero-logo {
            position: absolute;
            bottom: 32px;
            left: 56px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255,255,255,0.5);
            font-size: 0.8rem;
            font-family: var(--font-alt);
        }

        /* Right Panel - Form */
        .auth-form-panel {
            width: 480px;
            flex-shrink: 0;
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 56px 48px;
            position: relative;
        }
        .auth-form-panel .back-link {
            position: absolute;
            top: 24px;
            left: 24px;
            display: flex;
            align-items: center;
            gap: 6px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.85rem;
            font-family: var(--font-alt);
            font-weight: 500;
            transition: color 0.2s;
        }
        .auth-form-panel .back-link:hover { color: var(--primary); }

        .form-header { margin-bottom: 36px; }
        .form-header .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 28px;
        }
        .form-header .logo-icon {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 900;
            font-size: 1rem;
            box-shadow: 0 4px 12px rgba(2,132,199,0.35);
        }
        .form-header .logo-text {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--text);
        }
        .form-header .logo-text span { color: var(--primary); }
        .form-header h2 {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 6px;
        }
        .form-header p {
            color: var(--text-muted);
            font-size: 0.9rem;
            font-family: var(--font-alt);
        }

        /* Form Elements */
        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 8px;
        }
        .input-wrapper {
            position: relative;
        }
        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 1rem;
            pointer-events: none;
        }
        .form-input {
            width: 100%;
            padding: 12px 42px;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            font-size: 0.9rem;
            font-family: var(--font-alt);
            color: var(--text);
            background: #F8FAFC;
            transition: all 0.2s ease;
            outline: none;
        }
        .form-input:focus {
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(2,132,199,0.08);
        }
        .form-input.has-toggle { padding-right: 48px; }
        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            padding: 0;
            font-size: 1rem;
            transition: color 0.2s;
        }
        .toggle-password:hover { color: var(--primary); }

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }
        .remember-check {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }
        .remember-check input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--primary);
            cursor: pointer;
        }
        .remember-check span {
            font-size: 0.85rem;
            font-family: var(--font-alt);
            color: var(--text-muted);
        }
        .forgot-link {
            font-size: 0.85rem;
            font-family: var(--font-alt);
            color: var(--primary);
            font-weight: 500;
            text-decoration: none;
            transition: opacity 0.2s;
        }
        .forgot-link:hover { opacity: 0.75; }

        /* Submit button */
        .btn-submit {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 700;
            font-family: var(--font);
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 4px 15px rgba(2,132,199,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 20px;
        }
        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(2,132,199,0.4);
        }
        .btn-submit:active { transform: translateY(0); }

        .form-divider {
            text-align: center;
            color: var(--text-muted);
            font-size: 0.85rem;
            font-family: var(--font-alt);
            margin-bottom: 16px;
        }
        .form-footer {
            text-align: center;
            font-size: 0.88rem;
            font-family: var(--font-alt);
            color: var(--text-muted);
        }
        .form-footer a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }
        .form-footer a:hover { text-decoration: underline; }

        /* Alerts */
        .alert-custom {
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 0.85rem;
            font-family: var(--font-alt);
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 20px;
        }
        .alert-success-custom {
            background: #DCFCE7;
            color: #16A34A;
            border: 1px solid #BBF7D0;
        }
        .alert-info-custom {
            background: #E0F2FE;
            color: #0369A1;
            border: 1px solid #BFDBFE;
        }
        .alert-danger-custom {
            background: #FEE2E2;
            color: #DC2626;
            border: 1px solid #FECACA;
        }

        /* Captcha container */
        .captcha-container {
            background: #F8FAFC;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            padding: 12px;
            margin-bottom: 20px;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .auth-hero { display: none; }
            .auth-form-panel {
                width: 100%;
                padding: 48px 32px;
            }
        }
        @media (max-width: 480px) {
            .auth-form-panel { padding: 40px 24px; }
        }
    </style>
</head>
<body>
<div class="auth-wrapper">

    {{-- Left Panel - Hero --}}
    <div class="auth-hero">
        <div class="auth-hero-badge">
            <i class="bi bi-star-fill" style="font-size:0.7rem;color:#FBBF24;"></i>
            Hotel & Restaurant Booking
        </div>
        <h1>Selamat Datang<br>di <span>StayEase</span></h1>
        <p>Temukan pengalaman menginap terbaik dengan layanan premium dan kemudahan booking 24/7.</p>
        <div class="auth-features">
            <div class="auth-feature-item">
                <div class="auth-feature-icon"><i class="bi bi-building-fill"></i></div>
                Pilihan kamar hotel bintang 5 eksklusif
            </div>
            <div class="auth-feature-item">
                <div class="auth-feature-icon"><i class="bi bi-fork-knife"></i></div>
                Restoran mewah langsung dari kamar Anda
            </div>
            <div class="auth-feature-item">
                <div class="auth-feature-icon"><i class="bi bi-shield-fill-check"></i></div>
                Pembayaran aman & terpercaya
            </div>
            <div class="auth-feature-item">
                <div class="auth-feature-icon"><i class="bi bi-headset"></i></div>
                Customer service 24/7 siap membantu
            </div>
        </div>
        <div class="auth-hero-logo">
            <i class="bi bi-building"></i>
            © {{ date('Y') }} StayEase Hotel Management
        </div>
    </div>

    {{-- Right Panel - Form --}}
    <div class="auth-form-panel">
        <a href="{{ route('home') }}" class="back-link">
            <i class="bi bi-arrow-left"></i> Kembali ke Beranda
        </a>

        <div class="form-header">
            <div class="logo">
                <div class="logo-icon">S</div>
                <div class="logo-text">Stay<span>Ease</span></div>
            </div>
            <h2>Masuk ke Akun</h2>
            <p>Silakan masukkan email dan password Anda</p>
        </div>

        {{-- Alerts --}}
        @if(session('success'))
            <div class="alert-custom alert-success-custom">
                <i class="bi bi-check-circle-fill" style="flex-shrink:0;margin-top:2px;"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(session('status'))
            <div class="alert-custom alert-info-custom">
                <i class="bi bi-info-circle-fill" style="flex-shrink:0;margin-top:2px;"></i>
                <span>{{ session('status') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="alert-custom alert-danger-custom">
                <i class="bi bi-exclamation-circle-fill" style="flex-shrink:0;margin-top:2px;"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif
        @if($errors->any())
            <div class="alert-custom alert-danger-custom">
                <i class="bi bi-exclamation-circle-fill" style="flex-shrink:0;margin-top:2px;"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form action="{{ route('customer.login') }}" method="POST" id="loginForm">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-wrapper">
                    <i class="bi bi-envelope input-icon"></i>
                    <input type="email" id="email" name="email" class="form-input"
                           placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <i class="bi bi-lock input-icon"></i>
                    <input type="password" id="password" name="password" class="form-input has-toggle"
                           placeholder="Masukkan password" required>
                    <button type="button" class="toggle-password" onclick="togglePass('password', this)" tabindex="-1">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <div class="captcha-container">
                {!! NoCaptcha::display() !!}
                @if($errors->has('g-recaptcha-response'))
                    <div style="color:#DC2626;font-size:0.8rem;margin-top:6px;">{{ $errors->first('g-recaptcha-response') }}</div>
                @endif
            </div>

            <div class="form-options">
                <label class="remember-check">
                    <input type="checkbox" name="remember" id="remember">
                    <span>Ingat saya</span>
                </label>
                <a href="{{ route('password.request') }}" class="forgot-link">Lupa password?</a>
            </div>

            <button type="submit" class="btn-submit" id="submitBtn">
                <i class="bi bi-box-arrow-in-right"></i>
                Masuk Sekarang
            </button>
        </form>

        <div class="form-divider">
            Belum punya akun?
        </div>
        <div class="form-footer">
            <a href="{{ route('customer.register') }}">Daftar sekarang gratis →</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
