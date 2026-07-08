@extends('customer.layouts.app')

@section('title', 'Checkout - StayEase')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb" class="se-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('rooms.index') }}">Hotel</a></li>
            <li class="breadcrumb-item active">Checkout</li>
        </ol>
    </nav>

    <h3 class="se-section-title mb-4">Checkout Booking</h3>

    <div class="row g-4">
        <div class="col-lg-8">
            {{-- Guest Information --}}
            <div class="se-card-lg p-4 mb-4">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-2">
                        <i class="bi bi-person text-primary fs-4"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Data Pemesan</h5>
                        <p class="text-muted small mb-0" style="font-family:var(--font-alt);">Lengkapi data diri Anda untuk melanjutkan booking</p>
                    </div>
                </div>

                <form action="{{ route('customer.process-booking') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold small">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="full_name" class="form-control" value="{{ auth()->user()->name }}" required style="border:1.5px solid var(--border);border-radius:12px;padding:12px 16px;font-family:var(--font-alt);font-size:0.9rem;">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold small">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" required style="border:1.5px solid var(--border);border-radius:12px;padding:12px 16px;font-family:var(--font-alt);font-size:0.9rem;">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">No Telepon <span class="text-danger">*</span></label>
                        <input type="text" name="phone" class="form-control" required style="border:1.5px solid var(--border);border-radius:12px;padding:12px 16px;font-family:var(--font-alt);font-size:0.9rem;">
                    </div>

                    {{-- Special Request --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Permintaan Khusus <span class="text-muted fw-normal">(opsional)</span></label>
                        <textarea name="special_request" class="form-control" rows="3" placeholder="Contoh: extra bed, kamar non-smoking, view laut..." style="border:1.5px solid var(--border);border-radius:12px;padding:12px 16px;font-family:var(--font-alt);font-size:0.9rem;resize:none;"></textarea>
                    </div>

                    {{-- Coupon --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Kode Kupon <span class="text-muted fw-normal">(opsional)</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Masukkan kode" style="border:1.5px solid var(--border);border-radius:12px 0 0 12px;padding:12px 16px;font-family:var(--font-alt);font-size:0.9rem;">
                            <button class="btn btn-outline-primary" type="button" style="border-radius:0 12px 12px 0;font-weight:600;">Pakai</button>
                        </div>
                    </div>

                    <button type="submit" class="btn-se btn-se-primary w-100 py-3" style="font-size:1rem;">
                        <i class="bi bi-check-circle me-2"></i> Konfirmasi Booking
                    </button>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            {{-- Booking Summary --}}
            <div class="se-card-lg p-4 mb-4 sticky-lg-top" style="top: calc(var(--nav-height) + 20px);">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-2">
                        <i class="bi bi-receipt text-primary fs-4"></i>
                    </div>
                    <h5 class="fw-bold mb-0">Ringkasan Booking</h5>
                </div>

                <div class="d-flex gap-3 mb-3">
                    <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=150&q=80"
                         style="width:80px;height:60px;border-radius:12px;object-fit:cover;" alt="Room">
                    <div>
                        <div class="fw-bold">{{ $data['room_number'] ?? 'Room' }} - {{ $data['room_type'] ?? 'Standard' }}</div>
                        <div class="small text-muted" style="font-family:var(--font-alt);">Hotel StayEase Premium</div>
                    </div>
                </div>

                <hr style="border-color:var(--border);">

                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small" style="font-family:var(--font-alt);">Check In</span>
                    <span class="fw-semibold">{{ \Carbon\Carbon::parse($data['check_in'])->format('d M Y') }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small" style="font-family:var(--font-alt);">Check Out</span>
                    <span class="fw-semibold">{{ \Carbon\Carbon::parse($data['check_out'])->format('d M Y') }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small" style="font-family:var(--font-alt);">Durasi</span>
                    <span class="fw-semibold">{{ $data['days'] }} malam</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small" style="font-family:var(--font-alt);">Jumlah Tamu</span>
                    <span class="fw-semibold">1 orang</span>
                </div>

                <hr style="border-color:var(--border);">

                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small" style="font-family:var(--font-alt);">Harga {{ $data['days'] }} malam</span>
                    <span class="fw-semibold">Rp {{ number_format($data['price_per_night'] * $data['days'], 0, ',', '.') }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small" style="font-family:var(--font-alt);">Diskon</span>
                    <span class="text-success fw-semibold">Rp 0</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small" style="font-family:var(--font-alt);">Pajak & Layanan</span>
                    <span class="fw-semibold">Termasuk</span>
                </div>
                <hr style="border-color:var(--border);">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-bold">Total Pembayaran</span>
                    <span class="fw-bold text-primary fs-4">Rp {{ number_format($data['total_price'], 0, ',', '.') }}</span>
                </div>

                <div class="mt-3 p-3 bg-light rounded-3 d-flex align-items-center gap-2" style="font-size:0.78rem;font-family:var(--font-alt);color:var(--text-muted);">
                    <i class="bi bi-shield-check text-primary fs-5"></i>
                    Pembayaran aman terenkripsi via Midtrans
                </div>
            </div>
        </div>
    </div>
</div>
@endsection