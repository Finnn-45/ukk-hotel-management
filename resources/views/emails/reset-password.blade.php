<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - {{ $appName }}</title>
    <style>
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
        .email-body { padding: 0 40px 40px; }
        h2 { color: #0f172a; font-size: 24px; margin-bottom: 16px; text-align: center; }
        p { font-size: 16px; line-height: 1.6; margin-bottom: 20px; color: #64748b; }
        .btn-reset {
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
        .btn-reset:hover { background: #0369a1; }
        .info-box {
            margin-top: 32px;
            padding: 20px;
            background: #f1f5f9;
            border-radius: 16px;
            font-size: 13px;
            color: #475569;
        }
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
            <h2>Reset Password</h2>
        </div>

        <div class="email-body">
            <p>Halo, <strong>{{ $userName }}</strong>!</p>
            <p>Kami menerima permintaan reset password untuk akun <strong>{{ $appName }}</strong> Anda. Silakan klik tombol di bawah ini untuk membuat password baru.</p>

            <a href="{{ $resetUrl }}" class="btn-reset">Reset Password Sekarang</a>

            <div class="info-box">
                <strong>Catatan keamanan:</strong> Link ini akan kedaluwarsa dalam 30 menit. Jika Anda tidak merasa melakukan permintaan reset password, Anda bisa mengabaikan email ini.
            </div>
        </div>

        <div class="email-footer">
            <p style="font-weight: 600; color: #334155;">{{ $appName }}</p>
            <p>&copy; {{ $year }} Hotel Management System. All rights reserved.</p>
        </div>
    </div>
</body>
</html>