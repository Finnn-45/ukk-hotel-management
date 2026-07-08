# Testing Email Verification di Development

## Setup yang Sudah Ada

✅ **Mail Configuration** (di `.env`):
```env
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="noreply@hotelreservation.com"
```

✅ **Mailpit** - Tool untuk menangkap email di development
- Email tidak dikirim ke email address sebenarnya
- Email disimpan di memory dan bisa dilihat di web UI

---

## Cara Testing Email Verification

### Langkah 1: Pastikan Mailpit Running

Mailpit biasanya running otomatis di Laravel 11+. Cek dengan:

```bash
# Buka browser:
http://127.0.0.1:8025
```

Jika tidak terbuka, jalankan manual:
```bash
# Di terminal terpisah:
mailpit
```

### Langkah 2: Test Registration Flow

1. **Buka:** http://127.0.0.1:8000/register

2. **Isi form:**
   - Nama: `Test User`
   - Email: `test@example.com`
   - Password: `password123`
   - Konfirmasi Password: `password123`
   - Captcha: (skip untuk development)

3. **Klik "Daftar"**

4. **Akan redirect ke:** http://127.0.0.1:8000/login
   - Dengan pesan: "Registrasi berhasil. Silakan cek email Anda untuk melakukan verifikasi sebelum login."

### Langkah 3: Cek Email di Mailpit

1. **Buka:** http://127.0.0.1:8025

2. **Klik tab "Received"**

3. **Cari email dari:** `noreply@hotelreservation.com`
   - Subject: **"Verifikasi Email - Hotel Reservation System"**
   - To: `test@example.com`

4. **Buka email tersebut**

5. **Klik link verifikasi:** 
   ```
   http://127.0.0.1:8000/email/verify/1
   ```
   (angka 1 adalah user ID)

### Langkah 4: Login

1. **Kembali ke:** http://127.0.0.1:8000/login

2. **Login dengan:**
   - Email: `test@example.com`
   - Password: `password123`

3. **Berhasil login** → Redirect ke homepage

---

## Alur Lengkap (Your Suggested Flow)

```
Customer buka website (/)
    ↓
Register (/register)
    ↓
Data tersimpan di database (users table)
    ↓
Kirim email verifikasi (via Mailpit)
    ↓
Customer klik link di email (/email/verify/{id})
    ↓
Status email_verified_at terisi (di database)
    ↓
Baru bisa Login (/login)
    ↓
Booking kamar
    ↓
Pembayaran Midtrans
    ↓
Booking berhasil
```

---

## Verifikasi via Database (Quick Test)

Jika ingin skip email dan langsung verify via database:

```bash
php artisan tinker
```

```php
// 1. Cari user yang baru daftar
>>> $user = \App\Models\User::where('email', 'test@example.com')->first();

// 2. Verify email
>>> $user->markEmailAsVerified();
=> true

// 3. Cek status
>>> $user->hasVerifiedEmail();
=> true

// 4. Cek di database
>>> $user->email_verified_at;
=> "2025-07-05 16:30:00"
```

---

## Verifikasi via Route (Quick Test)

Atau langsung buka URL di browser:

```
http://127.0.0.1:8000/email/verify/1
```

(Ganti `1` dengan user ID yang sesuai)

---

## Troubleshooting

### Email tidak muncul di Mailpit

**Solusi 1:** Clear cache
```bash
php artisan config:clear
```

**Solusi 2:** Cek log
```bash
tail -f storage/logs/laravel.log
```

**Solusi 3:** Restart server
```bash
php artisan serve
```

### "Email verification link expired"

**Solusi:** Generate link baru via tinker:
```bash
php artisan tinker
>>> \App\Models\User::where('email', 'test@example.com')->first()->sendEmailVerificationNotification()
```

### Verification URL salah

**Cek di resources/views/vendor/notifications/email.blade.php** (jika ada custom template)
atau gunakan default Laravel notification.

---

## Production Setup

### Ganti ke Mailtrap (untuk testing SMTP)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
```

### Atau Gmail SMTP
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_gmail@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
```

**Catatan:** Untuk Gmail, gunakan "App Password" (bukan password biasa):
1. Enable 2FA di Google Account
2. Generate App Password
3. Gunakan App Password di `.env`

---

## Quick Test Checklist

- [ ] Mailpit running di http://127.0.0.1:8025
- [ ] Register akun baru
- [ ] Cek email di Mailpit
- [ ] Klik link verifikasi
- [ ] `email_verified_at` terisi di database
- [ ] Login berhasil
- [ ] Bisa akses protected routes (booking, profile, dll)

---

**Server:** Running at http://127.0.0.1:8000
**Mailpit UI:** http://127.0.0.1:8025

Email verification flow sudah fully functional!