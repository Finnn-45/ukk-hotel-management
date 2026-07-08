@extends('customer.layouts.app')

@section('title', 'Booking Berhasil - StayEase')

@push('styles')
<style>
    .se-success-illustration {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #DCFCE7 0%, #BBF7D0 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
    }
    .se-success-illustration i {
        font-size: 3rem;
        color: #22C55E;
    }
    .se-qr-placeholder {
        width: 120px;
        height: 120px;
        background: #fff;
        border: 2px dashed var(--border);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }
</style>
@endpush

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="se-card-lg p-4 p-md-5 text-center">
                <div class="se-success-illustration">
                    <i class="bi bi-check-circle-fill"></i>
                </div>

                <h3 class="fw-bold mb-2">Booking Berhasil!</h3>
                <p class="text-muted mb-4" style="font-family:var(--font-alt);">Terima kasih! Booking kamar Anda telah berhasil dibuat.</p>

                {{-- Booking Number --}}
                <div class="bg-light rounded-3 p-4 mb-4">
                    <div class="small text-muted mb-1" style="font-family:var(--font-alt);">Nomor Booking</div>
                    <div class="fs-3 fw-bold text-primary">#{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</div>
                </div>

                {{-- Details --}}
                <div class="text-start mb-4">
                    <div class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted small" style="font-family:var(--font-alt);">Kamar</span>
                        <span class="fw-semibold">{{ $booking->room->room_number }} - {{ $booking->room->roomType->name }}</span>
                    </div>
                    <div class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted small" style="font-family:var(--font-alt);">Check In</span>
                        <span class="fw-semibold">{{ $booking->check_in->format('d M Y') }}</span>
                    </div>
                    <div class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted small" style="font-family:var(--font-alt);">Check Out</span>
                        <span class="fw-semibold">{{ $booking->check_out->format('d M Y') }}</span>
                    </div>
                    <div class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted small" style="font-family:var(--font-alt);">Status</span>
                        <span class="se-badge se-badge-warning">{{ ucfirst($booking->status) }}</span>
                    </div>
                    <div class="d-flex justify-content-between py-2">
                        <span class="text-muted small" style="font-family:var(--font-alt);">Total</span>
                        <span class="fw-bold text-primary fs-5">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>

                {{-- QR Code Placeholder --}}
                <div class="mb-4">
                    <div class="small text-muted mb-2" style="font-family:var(--font-alt);">Scan QR saat check-in</div>
                    <div class="se-qr-placeholder">
                        <i class="bi bi-qr-code text-muted" style="font-size:3rem;"></i>
                    </div>
                </div>

                {{-- Hotel Address --}}
                <div class="bg-primary bg-opacity-5 p-3 rounded-3 mb-4 text-start" style="background:rgba(37,99,235,0.04);">
                    <div class="d-flex align-items-start gap-3">
                        <i class="bi bi-geo-alt text-primary fs-4 mt-1"></i>
                        <div>
                            <div class="fw-bold small">Hotel StayEase Premium</div>
                            <div class="small text-muted" style="font-family:var(--font-alt);">Jl. Merdeka No. 123, Jakarta Pusat<br>Tel: +62 123 4567 890</div>
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="d-flex flex-wrap gap-2 justify-content-center">
                    <a href="{{ route('customer.bookings') }}" class="btn-se btn-se-primary">
                        <i class="bi bi-calendar-check me-2"></i> Lihat Booking Saya
                    </a>
                    <a href="{{ route('home') }}" class="btn-se btn-se-outline">
                        <i class="bi bi-house me-2"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection