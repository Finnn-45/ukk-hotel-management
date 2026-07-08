<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; }
        .auth-card { 
            background: white; 
            border-radius: 15px; 
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            max-width: 450px;
            margin: 60px auto;
        }
        .auth-card .card-body { padding: 40px; }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="card-body">
            <h3 class="text-center mb-2 fw-bold">Daftar Akun</h3>
            <p class="text-center text-muted mb-4">Buat akun untuk booking kamar hotel</p>
            
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('customer.register') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" required autofocus value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" id="password" required>
                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password', this)">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password</label>
                    <div class="input-group">
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_confirmation', this)">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-3">
                    {!! NoCaptcha::display() !!}
                    <div class="mt-2">
                        <small class="text-muted">
                            <i class="bi bi-info-circle"></i> Captcha hanya diverifikasi pada mode production dengan valid reCAPTCHA keys.
                        </small>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2">Daftar</button>
            </form>

            <div class="mt-3 text-center">
                <p class="text-muted">
                    Sudah punya akun? <a href="{{ route('customer.login') }}">Login</a>
                </p>
            </div>

            <div class="mt-3">
                <div class="alert alert-info small">
                    <strong>Catatan:</strong> Setelah registrasi, Anda harus verifikasi email sebelum dapat login. Silakan cek inbox email Anda.
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
