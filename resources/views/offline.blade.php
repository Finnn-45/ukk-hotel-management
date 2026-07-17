<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offline - StayEase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: #F8FAFC;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .offline-card {
            text-align: center;
            background: #fff;
            border-radius: 24px;
            padding: 48px 40px;
            max-width: 400px;
            width: 100%;
            box-shadow: 0 4px 24px rgba(0,0,0,0.06);
            border: 1px solid #E2E8F0;
        }
        .offline-icon {
            width: 80px;
            height: 80px;
            background: #FEE2E2;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            font-size: 2.5rem;
            color: #EF4444;
        }
        h1 {
            font-size: 1.5rem;
            font-weight: 800;
            color: #0F172A;
            margin-bottom: 8px;
        }
        p {
            color: #64748B;
            margin-bottom: 24px;
            line-height: 1.6;
        }
        .btn-retry {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #2563EB, #1D4ED8);
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 12px 28px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(37,99,235,0.3);
        }
        .btn-retry:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37,99,235,0.4);
            color: #fff;
        }
        .features {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid #E2E8F0;
        }
        .feature {
            padding: 12px;
            border-radius: 12px;
            background: #F8FAFC;
            font-size: 0.8rem;
            color: #475569;
            font-weight: 500;
        }
        .feature i {
            display: block;
            font-size: 1.2rem;
            margin-bottom: 6px;
            color: #2563EB;
        }
    </style>
</head>
<body>
    <div class="offline-card">
        <div class="offline-icon">
            <i class="bi bi-wifi-off"></i>
        </div>
        <h1>Koneksi Terputus</h1>
        <p>Anda sedang offline. StayEase akan kembali saat koneksi internet tersedia.</p>
        <button onclick="window.location.reload()" class="btn-retry">
            <i class="bi bi-arrow-clockwise"></i> Coba Lagi
        </button>

        <div class="features">
            <div class="feature">
                <i class="bi bi-building"></i>
                Booking Kamar
            </div>
            <div class="feature">
                <i class="bi bi-cup-hot"></i>
                Pesan Makanan
            </div>
            <div class="feature">
                <i class="bi bi-credit-card"></i>
                Pembayaran Aman
            </div>
            <div class="feature">
                <i class="bi bi-headset"></i>
                Support 24/7
            </div>
        </div>
    </div>

    <script>
        // Auto-reload when back online
        window.addEventListener('online', function() {
            window.location.reload();
        });
    </script>
</body>
</html>
