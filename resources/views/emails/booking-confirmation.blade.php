<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Booking</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 30px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .header { background: linear-gradient(135deg, #0d6efd, #0a58ca); color: white; padding: 30px; text-align: center; }
        .header h1 { margin: 0; font-size: 24px; }
        .body { padding: 30px; }
        .detail-table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .detail-table td { padding: 10px 12px; border-bottom: 1px solid #eee; }
        .detail-table td:first-child { font-weight: 600; color: #555; width: 40%; }
        .status-badge { display: inline-block; padding: 6px 16px; border-radius: 20px; font-size: 14px; font-weight: 600; }
        .status-pending { background: #fff3cd; color: #856404; }
        .status-paid { background: #d4edda; color: #155724; }
        .footer { background: #f8f9fa; padding: 20px; text-align: center; color: #888; font-size: 13px; }
        .btn { display: inline-block; padding: 12px 30px; background: #0d6efd; color: white; text-decoration: none; border-radius: 8px; font-weight: 600; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏨 Konfirmasi Booking</h1>
            <p style="margin: 8px 0 0; opacity: 0.9;">Terima kasih telah memesan di Hotel Kami</p>
        </div>
        <div class="body">
            <p>Halo <strong>{{ $booking->guest->name ?? $booking->user->name ?? 'Customer' }}</strong>,</p>
            <p>Booking kamar Anda telah berhasil dibuat dengan detail berikut:</p>

            <table class="detail-table">
                <tr>
                    <td>Kode Booking</td>
                    <td><strong>#{{ $booking->booking_code ?? $booking->id }}</strong></td>
                </tr>
                <tr>
                    <td>Kamar</td>
                    <td><strong>{{ $booking->room->room_number ?? '-' }} - {{ $booking->room->roomType->name ?? '-' }}</strong></td>
                </tr>
                <tr>
                    <td>Check In</td>
                    <td>{{ \Carbon\Carbon::parse($booking->check_in)->format('d F Y') }}</td>
                </tr>
                <tr>
                    <td>Check Out</td>
                    <td>{{ \Carbon\Carbon::parse($booking->check_out)->format('d F Y') }}</td>
                </tr>
                <tr>
                    <td>Total Harga</td>
                    <td><strong>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</strong></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <span class="status-badge status-{{ $booking->status }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                </tr>
            </table>

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