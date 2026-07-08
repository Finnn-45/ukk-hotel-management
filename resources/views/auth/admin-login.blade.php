<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { 
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); 
            min-height: 100vh; 
            display: flex;
            align-items: center;
        }
        .login-card { 
            background: white; 
            border-radius: 20px; 
            box-shadow: 0 20px 60px rgba(0,0,0,0.4);
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
                    <div class="bg-dark text-white d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 70px; height: 70px;">
                        <i class="bi bi-shield-lock fs-2"></i>
                    </div>
                    <h4 class="fw-bold">Admin Panel</h4>
                    <p class="text-muted small">Login untuk mengelola sistem</p>
                </div>
                
                @if($errors->any())
                    <div class="alert alert-danger py-2">
                        <i class="bi bi-exclamation-circle"></i> {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('admin.login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control form-control-lg" placeholder="admin@example.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password</label>
                        <div class="input-group input-group-lg">
                            <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="password" required>
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark btn-lg w-100 py-2 fw-bold">
                        <i class="bi bi-shield-lock"></i> Login Admin
                    </button>
                </form>
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
