<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background: #f8f9fa; display: flex; align-items: center; min-height: 100vh; }
        .error-code { font-size: 8rem; font-weight: 800; color: #ffc107; line-height: 1; }
        .error-divider { width: 80px; height: 4px; background: #ffc107; margin: 1.5rem auto; border-radius: 2px; }
    </style>
</head>
<body>
    <div class="container text-center">
        <div class="error-code">404</div>
        <div class="error-divider"></div>
        <h2 class="mb-3">Halaman Tidak Ditemukan</h2>
        <p class="text-muted mb-4">Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan.</p>
        <a href="{{ url('/') }}" class="btn btn-primary btn-lg">
            <i class="bi bi-house-door"></i> Kembali ke Beranda
        </a>
    </div>
</body>
</html>