# Admin Login Guide

## URL Admin Login
```
http://127.0.0.1:8000/admin/login
```

## Default Admin Credentials

**Admin:**
- Email: `admin@example.com`
- Password: `password`

**Staff:**
- Email: `staff@example.com`
- Password: `password`

## Langkah-Langkah Login Admin

### 1. Buka Halaman Admin Login
```
http://127.0.0.1:8000/admin/login
```

### 2. Masukkan Credentials
```
Email: admin@example.com
Password: password
```

### 3. Klik Login
- Akan redirect ke `/admin/dashboard`
- Bisa manage booking, kamar, guest, payment, restaurant, dan landing page

## Admin Features

### Dashboard (`/admin/dashboard`)
- Lihat statistik booking, kamar, guests
- Lihat pendapatan bulanan & tahunan
- Lihat tingkat hunian kamar
- Lihat tren booking (chart)
- Lihat metode pembayaran (chart)

### Booking Management (`/admin/bookings`)
- Lihat semua booking
- Create booking baru
- Edit booking
- Cancel booking
- Lihat detail booking

### Room Management (`/admin/rooms`)
- Manage kamar (CRUD)
- Manage tipe kamar
- Lihat status kamar (available/booked)

### Guest Management (`/admin/guests`)
- Lihat daftar tamu
- Tambah/edit guest
- Lihat history booking guest

### Payment Management (`/admin/payments`)
- Lihat semua pembayaran
- Update status pembayaran
- Lihat detail pembayaran

### Restaurant Management (`/admin/restaurant/menu`)
- Manage menu restaurant
- Lihat order restaurant

### Landing Page Management (`/admin/landing-page`)
- Edit hero section
- Edit about section
- Manage services
- Manage gallery
- Manage testimonials

## Troubleshooting

### "Email atau password salah"
**Solusi:** Pastikan email dan password benar. Default:
- Email: `admin@example.com`
- Password: `password`

### "Akses ditolak. Anda bukan admin/staff"
**Solusi:** Login dengan akun yang role-nya admin atau staff, bukan customer.

### "Silakan verifikasi email Anda terlebih dahulu"
**Solusi:** Admin juga perlu verifikasi email. Untuk development, langsung verify via tinker:
```bash
php artisan tinker
>>> \App\Models\User::where('email', 'admin@example.com')->first()->markEmailAsVerified();
```

### Captcha error
**Solusi:** Captcha disabled di development. Pastikan tidak ada error di `.env` untuk `RECAPTCHA_SECRET_KEY`.

## Reset Admin Password

Jika lupa password, reset via tinker:
```bash
php artisan tinker
>>> $user = \App\Models\User::where('email', 'admin@example.com')->first();
>>> $user->password = Hash::make('password');
>>> $user->save();
```

## Create New Admin

Buat admin baru via tinker:
```bash
php artisan tinker
>>> \App\Models\User::create([
    'name' => 'New Admin',
    'email' => 'newadmin@example.com',
    'password' => Hash::make('password123'),
    'role' => 'admin',
    'email_verified_at' => now()
]);
```

**Note:** `email_verified_at` diisi langsung agar tidak perlu verifikasi.

## URLs Penting Admin

- **Login:** `/admin/login`
- **Dashboard:** `/admin/dashboard`
- **Bookings:** `/admin/bookings`
- **Rooms:** `/admin/rooms`
- **Room Types:** `/admin/room-types`
- **Guests:** `/admin/guests`
- **Payments:** `/admin/payments`
- **Restaurant Menu:** `/admin/restaurant/menu`
- **Restaurant Orders:** `/admin/restaurant/orders`
- **Landing Page:** `/admin/landing-page`
- **Logout:** POST `/admin/logout`

## Security Notes

1. **Production:**
   - Ganti default password setelah setup
   - Enable email verification untuk admin
   - Enable captcha untuk security
   - Gunakan HTTPS
   - Restrict `/admin/*` routes dengan IP whitelist jika perlu

2. **Development:**
   - Email verification bisa di-disabled (sudah disabled)
   - Captcha bisa di-skip (sudah di-skip)
   - Default credentials okay untuk testing

**Server:** Running at http://127.0.0.1:8000
**Admin Login:** http://127.0.0.1:8000/admin/login