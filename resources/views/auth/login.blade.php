<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            max-width: 420px;
            width: 100%;
            margin: 0 auto;
        }
        .login-card .card-body { padding: 40px; }
        .admin-badge {
            background: #1e293b;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            display: inline-block;
        }
        /* Responsive adjustments */
        @media (max-width: 768px) {
            body {
                background: #0f172a;
                padding: 10px;
                align-items: flex-start;
            }
            .login-card {
                max-width: 100%;
                margin: 0;
                box-shadow: none;
            }
            .login-card .card-body {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-card">
            <div class="card-body">
                <div class="text-center mb-4">
                    <div class="bg-dark text-white d-inline-block rounded-circle p-3 mb-2">
                        <i class="bi bi-shield-lock fs-3"></i>
                    </div>
                    <h4 class="fw-bold">Admin Login</h4>
                    <span class="admin-badge"><i class="bi bi-gear"></i> Management Panel</span>
                </div>
                
                @if($errors->any())
                    <div class="alert alert-danger py-2">
                        <i class="bi bi-exclamation-circle"></i> {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email Admin</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" class="form-control" placeholder="admin@example.com" required autofocus>
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

                    <div class="mb-3">
                        {!! NoCaptcha::display() !!}
                        @if($errors->has('g-recaptcha-response'))
                            <span class="text-danger small">{{ $errors->first('g-recaptcha-response') }}</span>
                        @endif
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Ingat saya</label>
                    </div>

                    <button type="submit" class="btn btn-dark w-100 py-2 mb-3">
                        <i class="bi bi-box-arrow-in-right"></i> Login Admin
                    </button>
                </form>

                <div class="text-center border-top pt-3">
                    <p class="mb-0 text-muted small">Login sebagai customer? <a href="{{ route('login.customer') }}" class="fw-bold">Klik disini</a></p>
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
