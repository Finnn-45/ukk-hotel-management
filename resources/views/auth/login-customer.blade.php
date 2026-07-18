<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center" style="min-height: 100vh;">
            <div class="col-md-5 col-lg-4 align-self-center py-4">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <input type="hidden" name="login_type" value="customer">

                    @if($errors->any())
                        <div class="alert alert-danger py-2"> <i class="bi bi-exclamation-circle"></i> {{ $errors->first() }} </div>
                    @endif

                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
                    </div>

                    <div class="mb-3 input-group">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password', this)"><i class="bi bi-eye"></i></button>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Ingat saya</label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 fw-semibold">Login</button>

                    <div class="text-center mt-3">
                        <small class="text-muted">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></small>
                        <br>
                        <small class="text-muted">Admin? <a href="{{ route('login') }}">Klik disini</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    function togglePassword(id, btn) {
        const input = document.getElementById(id);
        const icon = btn.querySelector('i');
        input.type = input.type === 'password' ? 'text' : 'password';
        icon.className = input.type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
    }
    </script>
</body>
</html>