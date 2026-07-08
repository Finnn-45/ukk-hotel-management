<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Pembayaran</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 30px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .header { background: linear-gradient(135deg, #198754, #157347); color: white; padding: 30px; text-align: center; }
        .header h1 { margin: 0; font-size: 24px; }
        .body { padding: 30px; }
        .detail-table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .detail-table td { padding: 10px 12px; border-bottom: 1px solid #eee; }
        .detail-table td:first-child { font-weight: 600; color: #555; width: 40%; }
        .status-badge { display: inline-block; padding: 6px 16px; border-radius: 20px; font-size: 14px; font-weight: 600; }
        .status-pending { background: #fff3cd; color: #856404; }
        .status-paid { background: #d4edda; color: #155724; }
        .status-failed { background: #f8d7da; color: #721c24; }
        .footer { background: #f8f9fa; padding: 20px; text-align: center; color: #888; font-size: 13px; }
        .btn { display: inline-block; padding: 12px 30px; background: #198754; color: white; text-decoration: none; border-radius: 8px; font-weight: 600; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>💳 Notifikasi Pembayaran</h1>
            <p style="margin: 8px 0 0; opacity: 0.9;">Status pembayaran booking Anda</p>
        </div>
        <div class="body">
            <p>Halo <strong>{{ $payment->booking->guest->name ?? $payment->booking->user->name ?? 'Customer' }}</strong>,</p>
            <p>Status pembayaran untuk booking Anda telah diperbarui:</p>

            <table class="detail-table">
                <tr>
                    <td>Kode Booking</td>
                    <td><strong>#{{ $payment->booking->booking_code ?? $payment->booking_id }}</strong></td>
                </tr>
                <tr>
                    <td>Metode Pembayaran</td>
                    <td>{{ $payment->payment_method ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Jumlah Dibayar</td>
                    <td><strong>Rp {{ number_format($payment->amount ?? 0, 0, ',', '.') }}</strong></td>
                </tr>
                <tr>
                    <td>Status Pembayaran</td>
                    <td>
                        <span class="status-badge status-{{ $payment->status }}">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>{{ $payment->created_at ? \Carbon\Carbon::parse($payment->created_at)->format('d F Y H:i') : '-' }}</td>
                </tr>
            </table>

            @if($payment->status == 'pending')
                <div style="background: #fff3cd; padding: 15px; border-radius: 8px; margin-top: 20px;">
                    <p style="margin:0; color: #856404;">
                        <strong>⚠️ Pembayaran Anda masih menunggu.</strong> 
                        Silakan selesaikan pembayaran Anda.
                    </p>
                </div>
            @elseif($payment->status == 'paid' || $payment->status == 'success')
                <div style="background: #d4edda; padding: 15px; border-radius: 8px; margin-top: 20px;">
                    <p style="margin:0; color: #155724;">
                        <strong>✅ Pembayaran berhasil!</strong> 
                        Booking Anda telah dikonfirmasi.
                    </p>
                </div>
            @elseif($payment->status == 'failed')
                <div style="background: #f8d7da; padding: 15px; border-radius: 8px; margin-top: 20px;">
                    <p style="margin:0; color: #721c24;">
                        <strong>❌ Pembayaran gagal.</strong> 
                        Silakan coba melakukan pembayaran ulang.
                    </p>
                </div>
            @endif

            <div style="text-align: center; margin-top: 25px;">
                <a href="{{ route('customer.bookings') }}" class="btn">Lihat Booking Saya</a>
            </div>
        </div>
        <div class="footer">
            <p>Hotel Reservation System &copy; {{ date('Y') }}. All rights reserved.</p>
            <p style="margin:0;">Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
        </div>
    </div>
</body>
</html>