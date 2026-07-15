<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - {{ config('app.name', 'StayEase Hotel') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
        .hero-icon {
            width: 64px; height: 64px;
            background: rgba(255,255,255,0.12);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: var(--accent);
            margin-bottom: 24px;
        }
        .auth-hero h1 {
            color: #fff;
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 16px;
        }
        .auth-hero h1 span { color: var(--accent); }
        .auth-hero p {
            color: rgba(255,255,255,0.75);
            font-family: var(--font-alt);
            font-size: 1rem;
            line-height: 1.7;
            max-width: 360px;
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

        .form-header { margin-bottom: 32px; }
        .form-header .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 28px;
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

        .icon-box {
            width: 56px; height: 56px;
            background: #EFF6FF;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--primary);
            margin-bottom: 16px;
        }
        .form-header h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 6px;
        }
        .form-header p { color: var(--text-muted); font-size: 0.88rem; font-family: var(--font-alt); }

        .form-group { margin-bottom: 18px; }
        .form-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 8px;
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
            padding: 12px 42px;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            font-size: 0.9rem;
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
        .form-input[readonly] {
            background: #F1F5F9;
            cursor: not-allowed;
            color: var(--text-muted);
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

        .error-text { color: #DC2626; font-size: 0.8rem; margin-top: 6px; font-family: var(--font-alt); }

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

        @media (max-width: 991px) {
            .auth-hero { display: none; }
            .auth-form-panel { width: 100%; padding: 48px 32px; }
        }
    </style>
</head>
<body>
<div class="auth-wrapper">
    <div class="auth-hero">
        <div class="hero-icon"><i class="bi bi-key-fill"></i></div>
        <h1>Buat Password<br><span>Baru</span></h1>
        <p>Masukkan password baru Anda. Pastikan password cukup kuat dan mudah diingat.</p>
        <div class="auth-hero-logo">
            <i class="bi bi-building"></i>
            © {{ date('Y') }} StayEase Hotel Management
        </div>
    </div>

    <div class="auth-form-panel">
        <a href="{{ route('customer.login') }}" class="back-link">
            <i class="bi bi-arrow-left"></i> Kembali ke Login
        </a>

        <div class="form-header">
            <div class="logo">
                <div class="logo-icon">S</div>
                <div class="logo-text">Stay<span>Ease</span></div>
            </div>
            <div class="icon-box"><i class="bi bi-key-fill"></i></div>
            <h2>Reset Password</h2>
            <p>Masukkan password baru untuk akun Anda</p>
        </div>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label>Email</label>
                <div class="input-wrapper">
                    <i class="bi bi-envelope input-icon"></i>
                    <input type="email" name="email" class="form-input" value="{{ $email }}" readonly>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password Baru</label>
                <div class="input-wrapper">
                    <i class="bi bi-lock input-icon"></i>
                    <input type="password" id="password" name="password" class="form-input has-toggle"
                           placeholder="Minimal 8 karakter" required minlength="8">
                    <button type="button" class="toggle-password" onclick="togglePass('password', this)" tabindex="-1">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                @error('password')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <div class="input-wrapper">
                    <i class="bi bi-lock-fill input-icon"></i>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-input has-toggle"
                           placeholder="Ulangi password baru" required minlength="8">
                    <button type="button" class="toggle-password" onclick="togglePass('password_confirmation', this)" tabindex="-1">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-submit">
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
