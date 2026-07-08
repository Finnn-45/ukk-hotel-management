# Setup Google reCAPTCHA untuk Customer

## Status Saat Ini
✅ **Captcha sudah implementasi** di:
- Login customer (`/login`)
- Register customer (`/register`)
- Login admin (`/admin/login`)

⚠️ **Mode saat ini:** Captcha **TIDAK AKTIF** untuk development/testing
- Form tetap menampilkan widget captcha
- Validasi dilewati secara otomatis

🔒 **Mode production:** Captcha **AKTIF** dan wajib diisi

---

## Cara Mengaktifkan Captcha (Production)

### Langkah 1: Dapatkan reCAPTCHA Keys dari Google

1. Buka: https://www.google.com/recaptcha/admin
2. Login dengan akun Google
3. Klik **"+"** (Create) untuk register site baru
4. Isi form:
   - **Label:** Hotel Reservation System
   - **reCAPTCHA type:** Pilih **reCAPTCHA v2** → **"I'm not a robot" Checkbox**
   - **Domains:** Masukkan domain Anda (contoh: `yourdomain.com`)
   - Centang **"Accept the reCAPTCHA Terms of Service"**
5. Klik **Submit**
6. Anda akan mendapatkan:
   - **Site Key** (public key)
   - **Secret Key** (private key)

### Langkah 2: Update .env File

Buka file `.env` dan update bagian captcha:

```env
# Google reCAPTCHA
RECAPTCHA_SITE_KEY=6LdXyz1234567890abcdefghijklmnopqrstuvwxyz_SITE_KEY_ANDA
RECAPTCHA_SECRET_KEY=6LdXyz1234567890abcdefghijklmnopqrstuvwxyz_SECRET_KEY_ANDA
```

**Jangan gunakan placeholder value** seperti:
- `your_recaptcha_site_key_here`
- `6LdCvEUt...` (test key yang sudah terdeteksi)

### Langkah 3: Clear Cache (jika perlu)

```bash
php artisan config:clear
php artisan cache:clear
```

### Langkah 4: Test Captcha

1. Buka: `http://127.0.0.1:8000/register`
2. Isi form
3. **CHECKLIST:** Widget captcha harus menunjukkan "I'm not a robot"
4. Klik checkbox dan selesaikan challenge
5. Submit form

---

## Cara Kerja Captcha di Sistem Ini

### Di Controller (CustomerAuthController)

```php
// Login - Baris 28-36
// Register - Baris 95-103

// Captcha hanya di-cek jika:
// 1. APP_ENV=production, ATAU
// 2. RECAPTCHA_SECRET_KEY ada DAN bukan placeholder

if (app()->environment('production') || 
    (config('captcha.secret') && 
     !str_contains(config('captcha.secret'), 'your_') && 
     !str_contains(config('captcha.secret'), '6LdCvEUt'))) {
    $validator->addRules([
        'g-recaptcha-response' => 'required|captcha',
    ]);
}
```

### Hasilnya:
- **Development** (`APP_ENV=local`): Captcha tidak di-validate
- **Production** (`APP_ENV=production`): Captcha di-validate
- **With Real Keys**: Captcha di-validate meskipun di localhost

---

## Testing Captcha

### Test 1: Tanpa Captcha (Development Mode)
```bash
# Pastikan .env masih menggunakan test keys:
RECAPTCHA_SITE_KEY=6LdCvEUtAAAAAFCvcjfM5RJpMxOX6X-NA8fdJmPE
RECAPTCHA_SECRET_KEY=6LdCvEUtAAAAAKBmF8zZTKsPghpNBd8KXmVJvkKF

# Buka /register
# Isi form tanpa checkbox captcha
# Submit → Harus berhasil (skip validasi)
```

### Test 2: Dengan Captcha (Production Mode)
```bash
# Ganti .env dengan keys yang benar:
RECAPTCHA_SITE_KEY=6LdXyz1234567890abcdefghijklmnopqrstuvwxyz
RECAPTCHA_SECRET_KEY=6LdXyz1234567890abcdefghijklmnopqrstuvwxyz

# Buka /register
# Isi form
# Checklist "I'm not a robot"
# Submit → Harus berhasil
```

### Test 3: Invalid Captcha
```bash
# Dengan keys yang benar, tapi:
# Jangan checklist captcha
# Submit → Harus ERROR: "The g-recaptcha-response field is required."
```

---

## Troubleshooting

### "The g-recaptcha-response field is required"
**Penyebab:** Captcha tidak dicentang
**Solusi:** Klik checkbox "I'm not a robot" dan selesaikan challenge

### Captcha tidak muncul
**Penyebab:** Site key salah atau domain tidak terdaftar
**Solusi:** 
1. Cek .env: `RECAPTCHA_SITE_KEY` benar
2. Cek di Google reCAPTCHA admin: domain terdaftar
3. Clear cache: `php artisan config:clear`

### "Captcha invalid"
**Penyebab:** Secret key salah atau expired
**Solusi:**
1. Cek .env: `RECAPTCHA_SECRET_KEY` benar
2. Cek di Google reCAPTCHA admin: copy ulang keys
3. Regenerate keys jika perlu

### Tidak ingin pakai captcha lagi
**Solusi:** Edit controller, hapus bagian validasi captcha:
```php
// Comment atau hapus baris 28-36 (login) dan 95-103 (register)
// di app/Http/Controllers/Auth/CustomerAuthController.php
```

---

## Lokasi File yang Terkait

### Config
- `config/captcha.php` - Konfigurasi captcha
- `.env` - Environment variables (RECAPTCHA_SITE_KEY, RECAPTCHA_SECRET_KEY)

### Controllers
- `app/Http/Controllers/Auth/CustomerAuthController.php` - Login & register customer
- `app/Http/Controllers/Auth/AdminAuthController.php` - Login admin

### Views
- `resources/views/auth/register.blade.php` - Form register (line 48-52)
- `resources/views/auth/customer-login.blade.php` - Form login customer (line 42-45)
- `resources/views/auth/login.blade.php` - Form login admin (line 78-81)

---

## Catatan Penting

1. **reCAPTCHA v2 vs v3:**
   - Sistem ini menggunakan **reCAPTCHA v2** (checkbox)
   - Jika ingin pakai v3 (invisible), ubah di Google admin & update view

2. **HTTPS Required:**
   - Untuk production, HTTPS wajib untuk captcha berfungsi
   - Development localhost tidak perlu HTTPS

3. **Multiple Domains:**
   - Jika punya banyak subdomain, daftarkan semua di Google reCAPTCHA admin
   - Atau pakai wildcard: `.yourdomain.com`

4. **Quota:**
   - Google reCAPTCHA gratis sampai 1,000,000 requests/month
   - Cukup untuk kebanyakan hotel booking system

5. **Testing Keys:**
   - Google menyediakan test keys untuk development
   - Test keys: `6LdCvEUtAAAAAFCvcjfM5RJpMxOX6X-NA8fdJmPE`
   - Hasilnya selalu PASS (tada yang sama setiap request)

---

## Quick Start (5 Menit)

```bash
# 1. Buka Google reCAPTCHA admin
https://www.google.com/recaptcha/admin

# 2. Register site baru, dapatkan:
#    - Site Key: 6LdXyz...
#    - Secret Key: 6LdXyz...

# 3. Edit .env
nano .env
# Ganti RECAPTCHA keys dengan keys Anda

# 4. Clear cache
php artisan config:clear

# 5. Test di browser
# Buka http://127.0.0.1:8000/register
# Coba register dengan captcha
```

---

## Support

Jika captcha bermasalah:
1. Cek console browser (F12) untuk error JavaScript
2. Cek Laravel log: `storage/logs/laravel.log`
3. Pastikan internet aktif (captcha memerlukan koneksi ke Google)
4. Coba test dengan Google's test keys terlebih dahulu

**Documentation:** https://developers.google.com/recaptcha