# Panduan untuk Customer - Hotel Reservation System

## Cara Menggunakan Sistem

### 1. **Melihat Halaman Utama**
- Buka browser dan kunjungi: `http://127.0.0.1:8000`
- Anda akan melihat:
  - **Hero Section** - Gambar besar dengan tombol "Lihat Kamar"
  - **Search Box** - Filter kamar berdasarkan tipe dan harga
  - **Tipe Kamar** - Daftar tipe kamar yang tersedia
  - **Kamar Tersedia** - 8 kamar yang sedang tersedia
  - **Testimonials** - Review dari customer lain

### 2. **Melihat Daftar Kamar**
- Klik menu **"Kamar"** di navbar
- Atau klik tombol **"Cari Kamar"** di hero section
- Anda bisa filter:
  - By tipe kamar
  - By harga minimum
  - By harga maksimum
  - By lantai

### 3. **Melihat Detail Kamar**
- Klik tombol **"Detail"** pada kamar yang ingin dilihat
- Anda akan melihat:
  - Foto kamar
  - Deskripsi lengkap
  - Harga per malam
  - Fasilitas
  - Kamar lain dengan tipe yang sama

### 4. **Booking Kamar**

#### Langkah 1: Login/Daftar
- Klik **"Login"** di navbar
- Jika belum punya akun, klik **"Daftar"**
- Isi form registrasi:
  - Nama lengkap
  - Email
  - Password
  - Konfirmasi password
- Setelah daftar, Anda akan langsung login

**Catatan:** 
- Untuk development, captcha tidak dicek
- Email verification dapat dilewati untuk testing (lihat bagian Testing di bawah)

#### Langkah 2: Pilih Kamar & Tanggal
- Klik **"Booking"** pada detail kamar
- Pilih tanggal:
  - Check-in (tanggal masuk)
  - Check-out (tanggal keluar)
- Sistem akan hitung total harga otomatis

#### Langkah 3: Checkout & Pembayaran
-Review booking:
  - Detail kamar
  - Tanggal menginap
  - Total harga
- Pilih metode pembayaran:
  - **Cash** - Bayar di tempat
  - **Transfer** - Transfer bank (Midtrans integration untuk production)
  - **Credit Card** - Kartu kredit (Midtrans)
  - **E-Wallet** - GoPay, OVO, dll (Midtrans)
- Klik **"Proses Booking"**

#### Langkah 4: Konfirmasi
- Anda akan melihat halaman **"Booking Sukses"**
- Simpan kode booking untuk referensi
- Anda bisa lihat riwayat booking di **"Booking Saya"**

### 5. **Melihat Booking Saya**
- Klik **"Booking Saya"** di navbar
- Lihat semua booking yang pernah dilakukan
- Filter by status:
  - **Confirmed** - Booking dikonfirmasi
  - **Pending** - Menunggu pembayaran
  - **Cancelled** - Dibatalkan

### 6. **Edit Profile**
- Klik nama Anda di navbar (dropdown)
- Pilih **"Profile"**
- Update informasi pribadi

### 7. **Logout**
- Klik nama Anda di navbar (dropdown)
- Pilih **"Logout"**

## Fitur Yang Tersedia untuk Customer

### ✅ Fitur yang Sudah Berjalan:
1. **Landing Page Dinamis** - Konten dapat diubah oleh admin
2. **Pencarian Kamar** - Filter by tipe, harga, lantai
3. **Booking Online** - Pilih tanggal dan booking langsung
4. **Pembayaran** - Multiple metode (Cash, Transfer, E-wallet)
5. **PWA (Progressive Web App)** - Bisa diinstall di smartphone
6. **Responsive Design** - Tampilan optimal di HP & desktop

### 🔄 Fitur yang Perlu Konfigurasi:
1. **Email Verification** - Perlu setup SMTP (Mailtrap/Gmail)
2. **Midtrans Payment** - Perlu API keys dari midtrans.com
3. **Google reCAPTCHA** - Perlu API keys dari Google (optional di development)

## Testing untuk Customer

### Quick Test (tanpa verifikasi email):

**Option 1: Skip verification temporarily**
```php
// Edit file: app/Http/Controllers/Auth/CustomerAuthController.php
// Cari baris 78-80, lalu COMMENT bagian ini:

// if (!$user->hasVerifiedEmail()) {
//     Auth::logout();
//     return back()->withErrors(['email' => 'Silakan verifikasi email...']);
// }
```

**Option 2: Verify via database**
```bash
php artisan tinker
>>> $user = \App\Models\User::where('email', 'test@example.com')->first();
>>> $user->markEmailAsVerified();
>>> echo $user->hasVerifiedEmail(); // true
```

**Option 3: Verify via route**
- Setelah registrasi, buka: `http://127.0.0.1:8000/email/verify/{user_id}`
- Ganti `{user_id}` dengan ID user yang baru daftar

## Troubleshooting

### "Silakan verifikasi email Anda terlebih dahulu"
**Solusi:** Ikuti Testing di atas untuk bypass/mode development

### "Email atau password salah"
**Solusi:** Pastikan email dan password benar, atau daftar akun baru

### Halaman login error "Route [login.customer] not defined"
**Solusi:** Sudah diperbaiki, refresh browser (Ctrl+F5)

### Captcha error "The g-recaptcha-response field is required"
**Solusi:** Captcha hanya wajib di production. Sudah dibuat optional untuk development.

## URLs Penting untuk Customer

- **Homepage:** `/` atau `http://127.0.0.1:8000`
- **Login:** `/login`
- **Register:** `/register`
- **Daftar Kamar:** `/kamar`
- **Detail Kamar:** `/kamar/{id}`
- **Booking Saya:** `/booking-saya` (requires auth)
- **Profile:** `/profile` (requires auth)

## Next Steps untuk Production

1. **Konfigurasi Email SMTP** untuk email verification
2. **Daftar Midtrans** untuk payment gateway
3. **Daftar Google reCAPTCHA** untuk keamanan
4. **Upload gambar** untuk landing page
5. **Customize content** via `/admin/landing-page`
6. **Setup domain & SSL** (wajib untuk PWA & payment)

## Kontak & Support

Jika ada pertanyaan atau issues, silakan hubungi administrator hotel.