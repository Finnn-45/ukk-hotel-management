<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - StayEase</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary: #0284C7;
            --primary-dark: #0369A1;
            --dark: #0F172A;
            --dark2: #1E293B;
            --text-light: rgba(255,255,255,0.75);
            --border-dark: rgba(255,255,255,0.08);
            --font: 'Inter', sans-serif;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: var(--font);
            min-height: 100vh;
            background: var(--dark);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            position: relative;
            overflow: hidden;
        }

        /* Background decorations */
        body::before {
            content: '';
            position: fixed;
            top: -200px; left: -200px;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(2,132,199,0.12) 0%, transparent 70%);
            pointer-events: none;
        }
        body::after {
            content: '';
            position: fixed;
            bottom: -200px; right: -200px;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(2,132,199,0.08) 0%, transparent 70%);
            pointer-events: none;
        }

        .admin-card {
            width: 100%;
            max-width: 420px;
            background: var(--dark2);
            border: 1px solid var(--border-dark);
            border-radius: 24px;
            padding: 44px 40px;
            position: relative;
            z-index: 1;
            box-shadow: 0 25px 60px rgba(0,0,0,0.5);
        }

        .admin-header {
            text-align: center;
            margin-bottom: 36px;
        }
        .admin-logo-wrap {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 24px;
        }
        .admin-logo-icon {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.1rem;
            box-shadow: 0 4px 16px rgba(2,132,199,0.4);
        }
        .admin-logo-text {
            font-size: 1.1rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: -0.3px;
        }
        .admin-logo-text span { color: #38BDF8; }
        .shield-wrap {
            width: 60px; height: 60px;
            background: rgba(2,132,199,0.12);
            border: 1px solid rgba(2,132,199,0.2);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            color: #38BDF8;
            font-size: 1.6rem;
        }
        .admin-header h2 {
            color: #fff;
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 6px;
        }
        .admin-header p { color: var(--text-light); font-size: 0.88rem; }

        .form-group { margin-bottom: 18px; }
        .form-group label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: rgba(255,255,255,0.6);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .input-wrapper { position: relative; }
        .input-icon {
            position: absolute;
            left: 14px; top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.3);
            font-size: 1rem;
            pointer-events: none;
        }
        .form-input {
            width: 100%;
            padding: 12px 44px;
            background: rgba(255,255,255,0.05);
            border: 1.5px solid rgba(255,255,255,0.08);
            border-radius: 12px;
            font-size: 0.9rem;
            color: #fff;
            font-family: var(--font);
            transition: all 0.2s;
            outline: none;
        }
        .form-input::placeholder { color: rgba(255,255,255,0.25); }
        .form-input:focus {
            border-color: rgba(2,132,199,0.5);
            background: rgba(255,255,255,0.07);
            box-shadow: 0 0 0 4px rgba(2,132,199,0.1);
        }
        .form-input.has-toggle { padding-right: 48px; }
        .toggle-password {
            position: absolute;
            right: 14px; top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: rgba(255,255,255,0.35);
            cursor: pointer;
            padding: 0;
            font-size: 1rem;
            transition: color 0.2s;
        }
        .toggle-password:hover { color: rgba(255,255,255,0.7); }

        .alert-danger-custom {
            background: rgba(239,68,68,0.12);
            border: 1px solid rgba(239,68,68,0.25);
            color: #FCA5A5;
            padding: 11px 14px;
            border-radius: 10px;
            font-size: 0.84rem;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 18px;
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
            box-shadow: 0 4px 16px rgba(2,132,199,0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 4px;
        }
        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 22px rgba(2,132,199,0.5);
        }

        .admin-footer {
            text-align: center;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid var(--border-dark);
        }
        .admin-footer a {
            color: rgba(255,255,255,0.35);
            text-decoration: none;
            font-size: 0.82rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: color 0.2s;
        }
        .admin-footer a:hover { color: rgba(255,255,255,0.6); }
    </style>
</head>
<body>
<div class="admin-card">
    <div class="admin-header">
        <div class="admin-logo-wrap">
            <div class="admin-logo-icon"><i class="bi bi-building"></i></div>
            <div class="admin-logo-text">Stay<span>Ease</span></div>
        </div>
        <div class="shield-wrap">
            <i class="bi bi-shield-lock-fill"></i>
        </div>
        <h2>Admin Panel</h2>
        <p>Masuk untuk mengelola sistem hotel</p>
    </div>

    @if($errors->any())
        <div class="alert-danger-custom">
            <i class="bi bi-exclamation-circle-fill" style="flex-shrink:0;margin-top:2px;"></i>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    <form action="{{ route('admin.login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email Admin</label>
            <div class="input-wrapper">
                <i class="bi bi-envelope input-icon"></i>
                <input type="email" id="email" name="email" class="form-input"
                       placeholder="admin@example.com" required autofocus>
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
        <button type="submit" class="btn-submit">
            <i class="bi bi-shield-lock-fill"></i>
            Masuk sebagai Admin
        </button>
    </form>

    <div class="admin-footer">
        <a href="{{ route('home') }}">
            <i class="bi bi-arrow-left"></i> Kembali ke Beranda
        </a>
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
