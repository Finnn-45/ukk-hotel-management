<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - {{ config('app.name', 'StayEase Hotel') }}</title>
    <meta name="description" content="Buat akun baru untuk menikmati layanan booking hotel premium.">
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
        .auth-wrapper { display: flex; width: 100%; min-height: 100vh; }

        /* Hero Panel */
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
            width: 400px; height: 400px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
            top: -100px; right: -100px;
        }
        .auth-hero::after {
            content: '';
            position: absolute;
            width: 300px; height: 300px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
            bottom: -80px; left: -60px;
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
            backdrop-filter: blur(8px);
        }
        .auth-hero h1 {
            color: #fff;
            font-size: 2.8rem;
            font-weight: 800;
            line-height: 1.15;
            margin-bottom: 20px;
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
        .auth-steps { display: flex; flex-direction: column; gap: 20px; }
        .auth-step {
            display: flex;
            align-items: flex-start;
            gap: 16px;
        }
        .step-num {
            width: 32px; height: 32px;
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.25);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 0.8rem;
            font-weight: 700;
            flex-shrink: 0;
        }
        .step-text strong {
            display: block;
            color: #fff;
            font-size: 0.9rem;
            margin-bottom: 2px;
        }
        .step-text span {
            color: rgba(255,255,255,0.65);
            font-size: 0.82rem;
            font-family: var(--font-alt);
        }
        .auth-hero-logo {
            position: absolute;
            bottom: 32px; left: 56px;
            color: rgba(255,255,255,0.4);
            font-size: 0.78rem;
            font-family: var(--font-alt);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Form Panel */
        .auth-form-panel {
            width: 500px;
            flex-shrink: 0;
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 48px 48px;
            overflow-y: auto;
            position: relative;
        }
        .back-link {
            position: absolute;
            top: 24px; left: 24px;
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
        .back-link:hover { color: var(--primary); }

        .form-header { margin-bottom: 28px; }
        .form-header .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 24px;
        }
        .logo-icon {
            width: 38px; height: 38px;
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
        .logo-text { font-size: 1.1rem; font-weight: 800; color: var(--text); }
        .logo-text span { color: var(--primary); }
        .form-header h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 6px;
        }
        .form-header p { color: var(--text-muted); font-size: 0.88rem; font-family: var(--font-alt); }

        .form-group { margin-bottom: 16px; }
        .form-group label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 7px;
        }
        .input-wrapper { position: relative; }
        .input-icon {
            position: absolute;
            left: 14px; top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 1rem;
            pointer-events: none;
        }
        .form-input {
            width: 100%;
            padding: 11px 42px;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            font-size: 0.88rem;
            font-family: var(--font-alt);
            color: var(--text);
            background: #F8FAFC;
            transition: all 0.2s;
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
            right: 14px; top: 50%;
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

        .captcha-container {
            background: #F8FAFC;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            padding: 12px;
            margin-bottom: 16px;
        }

        .btn-submit {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 0.93rem;
            font-weight: 700;
            font-family: var(--font);
            cursor: pointer;
            transition: all 0.25s;
            box-shadow: 0 4px 15px rgba(2,132,199,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 16px;
        }
        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(2,132,199,0.4);
        }

        .form-footer {
            text-align: center;
            font-size: 0.85rem;
            font-family: var(--font-alt);
            color: var(--text-muted);
        }
        .form-footer a { color: var(--primary); font-weight: 600; text-decoration: none; }
        .form-footer a:hover { text-decoration: underline; }

        .alert-custom {
            padding: 11px 16px;
            border-radius: 10px;
            font-size: 0.84rem;
            font-family: var(--font-alt);
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 16px;
        }
        .alert-danger-custom { background: #FEE2E2; color: #DC2626; border: 1px solid #FECACA; }
        .alert-success-custom { background: #DCFCE7; color: #16A34A; border: 1px solid #BBF7D0; }

        .info-box {
            background: #EFF6FF;
            border: 1px solid #BFDBFE;
            border-radius: 10px;
            padding: 11px 14px;
            font-size: 0.82rem;
            font-family: var(--font-alt);
            color: #0369A1;
            display: flex;
            align-items: flex-start;
            gap: 8px;
            margin-bottom: 16px;
        }

        @media (max-width: 991px) {
            .auth-hero { display: none; }
            .auth-form-panel { width: 100%; padding: 48px 32px; }
        }
        @media (max-width: 480px) {
            .auth-form-panel { padding: 40px 20px; }
        }
    </style>
</head>
<body>
<div class="auth-wrapper">

    {{-- Hero Panel --}}
    <div class="auth-hero">
        <div class="auth-hero-badge">
            <i class="bi bi-person-plus-fill" style="font-size:0.75rem;"></i>
            Bergabung Sekarang
        </div>
        <h1>Mulai Perjalanan<br>Anda Bersama <span>Kami</span></h1>
        <p>Daftar dan nikmati kemudahan booking kamar hotel premium, restoran eksklusif, dan berbagai layanan unggulan lainnya.</p>
        <div class="auth-steps">
            <div class="auth-step">
                <div class="step-num">1</div>
                <div class="step-text">
                    <strong>Buat akun gratis</strong>
                    <span>Hanya memerlukan email & password</span>
                </div>
            </div>
            <div class="auth-step">
                <div class="step-num">2</div>
                <div class="step-text">
                    <strong>Verifikasi email</strong>
                    <span>Konfirmasi melalui email yang dikirimkan</span>
                </div>
            </div>
            <div class="auth-step">
                <div class="step-num">3</div>
                <div class="step-text">
                    <strong>Mulai booking</strong>
                    <span>Nikmati semua fasilitas hotel bintang 5</span>
                </div>
            </div>
        </div>
        <div class="auth-hero-logo">
            <i class="bi bi-building"></i>
            © {{ date('Y') }} StayEase Hotel Management
        </div>
    </div>

    {{-- Form Panel --}}
    <div class="auth-form-panel">
        <a href="{{ route('home') }}" class="back-link">
            <i class="bi bi-arrow-left"></i> Kembali ke Beranda
        </a>

        <div class="form-header">
            <div class="logo">
                <div class="logo-icon">S</div>
                <div class="logo-text">Stay<span>Ease</span></div>
            </div>
            <h2>Buat Akun Baru</h2>
            <p>Isi formulir di bawah untuk mendaftar</p>
        </div>

        @if($errors->any())
            <div class="alert-custom alert-danger-custom">
                <i class="bi bi-exclamation-circle-fill" style="flex-shrink:0;margin-top:2px;"></i>
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
                <div class="input-wrapper">
                    <i class="bi bi-person input-icon"></i>
                    <input type="text" id="name" name="name" class="form-input"
                           placeholder="Nama lengkap Anda" value="{{ old('name') }}" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-wrapper">
                    <i class="bi bi-envelope input-icon"></i>
                    <input type="email" id="email" name="email" class="form-input"
                           placeholder="nama@email.com" value="{{ old('email') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <i class="bi bi-lock input-icon"></i>
                    <input type="password" id="password" name="password" class="form-input has-toggle"
                           placeholder="Minimal 6 karakter" required>
                    <button type="button" class="toggle-password" onclick="togglePass('password', this)" tabindex="-1">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <div class="input-wrapper">
                    <i class="bi bi-lock-fill input-icon"></i>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-input has-toggle"
                           placeholder="Ulangi password" required>
                    <button type="button" class="toggle-password" onclick="togglePass('password_confirmation', this)" tabindex="-1">
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

            <button type="submit" class="btn-submit">
                <i class="bi bi-person-plus-fill"></i>
                Daftar Sekarang
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
    input.type = input.type === 'password' ? 'text' : 'password';
    icon.className = input.type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
}
</script>
</body>
</html>
