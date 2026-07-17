<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - {{ $appName }}</title>
    <style>
        /* Reset & Base */
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 40px 20px;
            color: #334155;
        }
        .email-wrapper {
            max-width: 550px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
        }

        /* Header dengan aksen modern */
        .email-header {
            background: #ffffff;
            padding: 48px 30px 24px;
            text-align: center;
        }
        .logo-circle {
            width: 72px;
            height: 72px;
            background: #f0f9ff;
            color: #0284c7;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: 800;
            margin: 0 auto 20px;
            border: 4px solid #e0f2fe;
        }

        /* Konten */
        .email-body { padding: 0 40px 40px; }
        h2 { color: #0f172a; font-size: 24px; margin-bottom: 16px; }
        p { font-size: 16px; line-height: 1.6; margin-bottom: 20px; color: #64748b; }

        /* Tombol */
        .btn-verify {
            display: block;
            width: 100%;
            padding: 16px;
            background: #0284c7;
            color: #ffffff !important;
            text-decoration: none;
            font-weight: 600;
            border-radius: 12px;
            text-align: center;
            font-size: 16px;
            transition: background 0.3s ease;
        }
        .btn-verify:hover { background: #0369a1; }

        /* Aksen tambahan */
        .info-box {
            margin-top: 32px;
            padding: 20px;
            background: #f1f5f9;
            border-radius: 16px;
            font-size: 13px;
            color: #475569;
        }

        /* Footer */
        .email-footer {
            padding: 30px;
            text-align: center;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
        }
        .email-footer p { font-size: 12px; margin-bottom: 0; }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-header">
            <div class="logo-circle">S</div>
            <h2>Verifikasi Email Anda</h2>
        </div>

        <div class="email-body">
            <p>Halo, <strong>{{ $userName }}</strong>!</p>
            <p>Selamat bergabung di <strong>{{ $appName }}</strong>. Kami senang Anda ada di sini. Untuk mulai menggunakan layanan kami, silakan konfirmasi email Anda terlebih dahulu.</p>

            <a href="{{ $verificationUrl }}" class="btn-verify">Verifikasi Akun Sekarang</a>

            <div class="info-box">
                <strong>Catatan keamanan:</strong> Link ini akan kedaluwarsa dalam 30 menit. Jika Anda tidak merasa melakukan pendaftaran, Anda bisa mengabaikan email ini.
            </div>
        </div>

        <div class="email-footer">
            <p style="font-weight: 600; color: #334155;">{{ $appName }}</p>
            <p>&copy; {{ $year }} Hotel Management System. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
