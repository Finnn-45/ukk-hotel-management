<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
            min-height: 100vh; 
            display: flex;
            align-items: center;
        }
        .login-card { 
            background: white; 
            border-radius: 15px; 
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            max-width: 420px;
            margin: 0 auto;
            width: 100%;
        }
        .login-card .card-body { padding: 40px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-card">
            <div class="card-body">
                <div class="text-center mb-4">
                    <div class="text-primary d-inline-block mb-2">
                        <i class="bi bi-building display-4"></i>
                    </div>
                    <h4 class="fw-bold">{{ config('app.name') }}</h4>
                    <p class="text-muted small">Silakan login untuk melanjutkan booking</p>
                </div>
                
                @if($errors->any())
                    <div class="alert alert-danger py-2">
                        <i class="bi bi-exclamation-circle"></i> {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <input type="hidden" name="login_type" value="customer">

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" class="form-control" placeholder="customer@example.com" required autofocus>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password" class="form-control" id="password" placeholder="password" required>
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Ingat saya</label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 mb-3">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </button>
                </form>

                <div class="text-center border-top pt-3">
                    <p class="mb-1 text-muted small">Belum punya akun? <a href="{{ route('register') }}" class="fw-bold">Daftar</a></p>
                    <p class="mb-0 text-muted small">Login sebagai admin? <a href="{{ route('login') }}" class="fw-bold">Klik disini</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script>
function togglePassword(inputId, btn) {
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
</script>
