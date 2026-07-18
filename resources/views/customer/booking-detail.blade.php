@extends('customer.layouts.app')

@section('title', 'Detail Booking - StayEase')

@push('styles')
<style>
    .se-detail-wrapper {
        min-height: calc(100vh - var(--nav-height) - 200px);
        padding: 30px 0;
    }

    .se-detail-card {
        background: #fff;
        border-radius: var(--radius);
        box-shadow: var(--shadow-md);
        overflow: hidden;
        max-width: 800px;
        margin: 0 auto;
    }

    .se-detail-header {
        background: var(--primary-gradient);
        padding: 28px 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
    }
    .se-detail-header h5 {
        color: #fff;
        font-weight: 700;
        margin: 0;
        font-size: 1.1rem;
    }
    .se-detail-header .se-badge {
        font-size: 0.75rem;
        padding: 6px 16px;
    }

    .se-detail-body {
        padding: 30px;
    }

    .se-verify-code-box {
        background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
        border: 2px dashed #10B981;
        border-radius: var(--radius-sm);
        padding: 24px;
        text-align: center;
        margin-bottom: 28px;
    }
    .se-verify-code-box .label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #065F46;
        font-weight: 700;
        margin-bottom: 8px;
    }
    .se-verify-code-box .code {
        font-size: 2.5rem;
        font-weight: 900;
        letter-spacing: 0.4rem;
        color: #065F46;
        font-family: 'Courier New', monospace;
    }
    .se-verify-code-box .info {
        font-size: 0.82rem;
        color: #047857;
        margin-top: 8px;
    }

    .se-verify-code-empty {
        background: #FEF3C7;
        border: 2px dashed #F59E0B;
        border-radius: var(--radius-sm);
        padding: 20px;
        text-align: center;
        margin-bottom: 28px;
    }
    .se-verify-code-empty .label {
        font-size: 0.8rem;
        color: #92400E;
        font-weight: 600;
    }

    .se-info-row {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 0;
        border-bottom: 1px solid var(--border);
    }
    .se-info-row:last-child { border-bottom: none; }
    .se-info-row .icon {
        width: 40px;
        height: 40px;
        background: var(--primary-light);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 1.1rem;
        flex-shrink: 0;
    }
    .se-info-row .content { flex: 1; }
    .se-info-row .content .label {
        font-size: 0.75rem;
        color: var(--text-muted);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    .se-info-row .content .value {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--text);
        margin-top: 2px;
    }

    .se-total-section {
        background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
        border-radius: var(--radius-sm);
        padding: 18px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 16px;
    }
    .se-total-section .label {
        font-weight: 700;
        color: #92400E;
        font-size: 0.9rem;
    }
    .se-total-section .value {
        font-size: 1.5rem;
        font-weight: 900;
        color: #92400E;
        letter-spacing: -0.5px;
    }

    .se-notif-timeline {
        margin-top: 28px;
        padding: 20px;
        background: var(--bg);
        border-radius: var(--radius-sm);
    }
    .se-notif-timeline h6 {
        font-weight: 700;
        font-size: 0.9rem;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .se-notif-timeline h6 i { color: var(--primary); }
    .se-timeline-item {
        display: flex;
        gap: 12px;
        padding-bottom: 16px;
        position: relative;
        padding-left: 24px;
    }
    .se-timeline-item::before {
        content: '';
        position: absolute;
        left: 6px;
        top: 6px;
        bottom: 0;
        width: 2px;
        background: var(--border);
    }
    .se-timeline-item:last-child::before { display: none; }
    .se-timeline-item .dot {
        position: absolute;
        left: 0;
        top: 4px;
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background: var(--primary);
        border: 3px solid #fff;
        box-shadow: 0 0 0 2px var(--primary);
    }
    .se-timeline-item .dot.success { background: #10B981; box-shadow: 0 0 0 2px #10B981; }
    .se-timeline-item .dot.warning { background: #F59E0B; box-shadow: 0 0 0 2px #F59E0B; }
    .se-timeline-item .dot.muted { background: #94A3B8; box-shadow: 0 0 0 2px #94A3B8; }
    .se-timeline-item .text {
        font-size: 0.82rem;
        color: var(--text);
        font-weight: 500;
    }
    .se-timeline-item .text .time {
        display: block;
        font-size: 0.72rem;
        color: var(--text-muted);
        font-weight: 400;
        margin-top: 2px;
    }

    @media (max-width: 576px) {
        .se-detail-body { padding: 20px; }
        .se-detail-header { padding: 20px; }
        .se-verify-code-box .code { font-size: 1.8rem; letter-spacing: 0.3rem; }
        .se-total-section { flex-direction: column; text-align: center; gap: 6px; }
        .se-total-section .value { font-size: 1.3rem; }
    }
</style>
@endpush

@section('content')
<div class="se-detail-wrapper">
    <div class="container">
        <nav aria-label="breadcrumb" class="se-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('customer.bookings') }}">Booking Saya</a></li>
                <li class="breadcrumb-item active">Detail Booking</li>
            </ol>
        </nav>

        <div class="se-detail-card">
            {{-- Header --}}
            @php
                $statusColors = [
                    'pending' => ['bg' => '#FEF3C7', 'text' => '#D97706'],
                    'confirmed' => ['bg' => '#E0F2FE', 'text' => '#0369A1'],
                    'checked_in' => ['bg' => '#DCFCE7', 'text' => '#16A34A'],
                    'checked_out' => ['bg' => '#F3F4F6', 'text' => '#6B7280'],
                    'completed' => ['bg' => '#DCFCE7', 'text' => '#16A34A'],
                    'cancelled' => ['bg' => '#FEE2E2', 'text' => '#DC2626'],
                ];
                $sc = $statusColors[$booking->status] ?? ['bg' => '#F3F4F6', 'text' => '#6B7280'];
            @endphp
            <div class="se-detail-header">
                <div>
                    <h5>Booking #{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</h5>
                    <span style="color:rgba(255,255,255,0.8);font-size:0.82rem;">
                        Dibuat {{ $booking->created_at->format('d M Y, H:i') }}
                    </span>
                </div>
                <span class="se-badge" style="background:{{ $sc['bg'] }};color:{{ $sc['text'] }};">
                    {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                </span>
            </div>

            <div class="se-detail-body">
                {{-- Verification Code --}}
                @if($booking->payment && $booking->payment->verification_code && $booking->payment->payment_status === 'paid')
                <div class="se-verify-code-box">
                    <div class="label">Kode Verifikasi Check-in</div>
                    <div class="code">{{ $booking->payment->verification_code }}</div>
                    <div class="info">
                        <i class="bi bi-info-circle"></i> Tunjukkan kode ini ke resepsionis saat check-in di hotel
                    </div>
                </div>
                @elseif($booking->status === 'pending' || ($booking->payment && $booking->payment->payment_status !== 'paid'))
                <div class="se-verify-code-empty">
                    <div class="label">
                        <i class="bi bi-clock"></i> Kode verifikasi akan muncul setelah pembayaran dikonfirmasi
                    </div>
                </div>
                @elseif(!$booking->payment)
                <div class="se-verify-code-empty">
                    <div class="label">
                        <i class="bi bi-info-circle"></i> Lakukan pembayaran untuk mendapatkan kode verifikasi check-in
                    </div>
                </div>
                @endif

                {{-- Room Info --}}
                <h6 style="font-weight:700;font-size:0.85rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:12px;">
                    <i class="bi bi-door-open" style="color:var(--primary);"></i> Informasi Kamar
                </h6>
                <div class="se-info-row">
                    <div class="icon"><i class="bi bi-door-open"></i></div>
                    <div class="content">
                        <div class="label">Nomor Kamar</div>
                        <div class="value">{{ $booking->room->room_number }}</div>
                    </div>
                </div>
                <div class="se-info-row">
                    <div class="icon"><i class="bi bi-layers"></i></div>
                    <div class="content">
                        <div class="label">Tipe Kamar</div>
                        <div class="value">{{ $booking->room->roomType->name }}</div>
                    </div>
                </div>

                {{-- Date Info --}}
                <h6 style="font-weight:700;font-size:0.85rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.5px;margin:20px 0 12px;">
                    <i class="bi bi-calendar" style="color:var(--primary);"></i> Jadwal Menginap
                </h6>
                <div class="se-info-row">
                    <div class="icon"><i class="bi bi-calendar-check"></i></div>
                    <div class="content">
                        <div class="label">Check In</div>
                        <div class="value">{{ \Carbon\Carbon::parse($booking->check_in)->format('d F Y') }}</div>
                    </div>
                </div>
                <div class="se-info-row">
                    <div class="icon"><i class="bi bi-calendar-x"></i></div>
                    <div class="content">
                        <div class="label">Check Out</div>
                        <div class="value">{{ \Carbon\Carbon::parse($booking->check_out)->format('d F Y') }}</div>
                    </div>
                </div>
                <div class="se-info-row">
                    <div class="icon"><i class="bi bi-people"></i></div>
                    <div class="content">
                        <div class="label">Jumlah Tamu</div>
                        <div class="value">{{ $booking->number_of_guests }} orang</div>
                    </div>
                </div>

                {{-- Total --}}
                <div class="se-total-section">
                    <div class="label">Total Pembayaran</div>
                    <div class="value">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</div>
                </div>

                {{-- Payment Info --}}
                @if($booking->payment)
                <h6 style="font-weight:700;font-size:0.85rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.5px;margin:20px 0 12px;">
                    <i class="bi bi-credit-card" style="color:var(--primary);"></i> Informasi Pembayaran
                </h6>
                <div class="se-info-row">
                    <div class="icon"><i class="bi bi-wallet2"></i></div>
                    <div class="content">
                        <div class="label">Metode Pembayaran</div>
                        <div class="value">{{ ucfirst(str_replace('_', ' ', $booking->payment->payment_method ?? '-')) }}</div>
                    </div>
                </div>
                <div class="se-info-row">
                    <div class="icon"><i class="bi bi-check-circle"></i></div>
                    <div class="content">
                        <div class="label">Status Pembayaran</div>
                        <div class="value">
                            @if($booking->payment->payment_status === 'paid')
                                <span class="se-badge se-badge-success">Lunas</span>
                            @elseif($booking->payment->payment_status === 'pending')
                                <span class="se-badge se-badge-warning">Menunggu</span>
                            @elseif($booking->payment->payment_status === 'cancelled')
                                <span class="se-badge se-badge-danger">Dibatalkan</span>
                            @else
                                <span class="se-badge" style="background:#F3F4F6;color:#6B7280;">{{ ucfirst($booking->payment->payment_status) }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                @if($booking->payment->paid_at)
                <div class="se-info-row">
                    <div class="icon"><i class="bi bi-clock-history"></i></div>
                    <div class="content">
                        <div class="label">Dibayar Pada</div>
                        <div class="value">{{ $booking->payment->paid_at->format('d F Y H:i') }}</div>
                    </div>
                </div>
                @endif
                @endif

                {{-- Guest Info --}}
                <h6 style="font-weight:700;font-size:0.85rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.5px;margin:20px 0 12px;">
                    <i class="bi bi-person" style="color:var(--primary);"></i> Data Diri
                </h6>
                <div class="se-info-row">
                    <div class="icon"><i class="bi bi-person-badge"></i></div>
                    <div class="content">
                        <div class="label">Nama</div>
                        <div class="value">{{ $booking->guest->full_name ?? '-' }}</div>
                    </div>
                </div>
                <div class="se-info-row">
                    <div class="icon"><i class="bi bi-envelope"></i></div>
                    <div class="content">
                        <div class="label">Email</div>
                        <div class="value">{{ $booking->guest->email ?? '-' }}</div>
                    </div>
                </div>
                <div class="se-info-row">
                    <div class="icon"><i class="bi bi-telephone"></i></div>
                    <div class="content">
                        <div class="label">No. Telepon</div>
                        <div class="value">{{ $booking->guest->phone ?? '-' }}</div>
                    </div>
                </div>

                {{-- Timeline Notifications --}}
                <div class="se-notif-timeline">
                    <h6><i class="bi bi-clock-history"></i> Riwayat Booking</h6>

                    @if($booking->status === 'cancelled')
                    <div class="se-timeline-item">
                        <div class="dot muted"></div>
                        <div class="text">
                            Booking dibatalkan
                            <span class="time">{{ $booking->updated_at->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                    @endif

                    @if($booking->status === 'checked_out' || $booking->status === 'completed')
                    <div class="se-timeline-item">
                        <div class="dot success"></div>
                        <div class="text">
                            Check-out selesai
                            <span class="time">{{ $booking->updated_at->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                    @endif

                    @if($booking->status === 'checked_in' || $booking->status === 'checked_out' || $booking->status === 'completed')
                    <div class="se-timeline-item">
                        <div class="dot success"></div>
                        <div class="text">
                            Check-in berhasil
                            <span class="time">{{ $booking->updated_at->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                    @endif

                    @if($booking->payment && $booking->payment->payment_status === 'paid')
                    <div class="se-timeline-item">
                        <div class="dot success"></div>
                        <div class="text">
                            Pembayaran berhasil dikonfirmasi
                            <span class="time">{{ $booking->payment->paid_at ? $booking->payment->paid_at->format('d M Y H:i') : '-' }}</span>
                        </div>
                    </div>
                    @endif

                    <div class="se-timeline-item">
                        <div class="dot warning"></div>
                        <div class="text">
                            Booking dibuat (Menunggu pembayaran)
                            <span class="time">{{ $booking->created_at->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="d-flex gap-2 mt-4 flex-wrap">
                    <a href="{{ route('customer.bookings') }}" class="btn-se btn-se-outline" style="flex:1;justify-content:center;">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    @if(in_array($booking->status, ['pending', 'confirmed']) && (!$booking->payment || $booking->payment->payment_status !== 'paid'))
                        <button id="payButton-{{ $booking->id }}" class="btn-se btn-se-primary" style="flex:1;justify-content:center;">
                            <i class="bi bi-credit-card"></i> Bayar Sekarang
                        </button>
                    @endif
                    @if(in_array($booking->status, ['pending', 'confirmed']))
                        <form action="{{ route('customer.booking.cancel', $booking) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan booking ini?')" style="flex:1;">
                            @csrf
                            <button type="submit" class="btn-se w-100" style="color:#EF4444;border:1.5px solid #FEE2E2;background:transparent;justify-content:center;">
                                <i class="bi bi-x-circle"></i> Batalkan
                            </button>
                        </form>
                    @endif
                    @if($booking->status === 'checked_out' && !$booking->review)
                        <a href="{{ route('customer.booking.review', $booking) }}" class="btn-se btn-se-outline" style="flex:1;justify-content:center;">
                            <i class="bi bi-star"></i> Beri Review
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    @if(isset($booking))
        @if(in_array($booking->status, ['pending', 'confirmed']) && (!$booking->payment || $booking->payment->payment_status !== 'paid'))
        document.getElementById('payButton-{{ $booking->id }}')?.addEventListener('click', function() {
            const payBtn = this;
            payBtn.disabled = true;
            payBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Memuat...';

            fetch(`/payment/midtrans/{{ $booking->id }}/token`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json().then(data => ({ response, data })))
            .then(({ response, data }) => {
                if (response.ok && data.token) {
                    if (typeof window.snap !== 'undefined') {
                        window.snap.pay(data.token, {
                            onSuccess: function(result) {
                                window.location.href = '/payment/midtrans/success?order_id=' + result.order_id + '&status_code=200';
                            },
                            onPending: function(result) {
                                window.location.href = '/payment/midtrans/pending?order_id=' + result.order_id;
                            },
                            onError: function(result) {
                                window.location.href = '/payment/midtrans/error';
                            },
                            onClose: function() {
                                payBtn.disabled = false;
                                payBtn.innerHTML = '<i class="bi bi-credit-card"></i> Bayar Sekarang';
                            }
                        });
                    } else {
                        alert('Midtrans SDK belum dimuat. Silakan refresh halaman.');
                        payBtn.disabled = false;
                        payBtn.innerHTML = '<i class="bi bi-credit-card"></i> Bayar Sekarang';
                    }
                } else {
                    alert(data.message || 'Gagal memuat pembayaran. Silakan coba lagi.');
                    payBtn.disabled = false;
                    payBtn.innerHTML = '<i class="bi bi-credit-card"></i> Bayar Sekarang';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan koneksi. Silakan coba lagi.');
                payBtn.disabled = false;
                payBtn.innerHTML = '<i class="bi bi-credit-card"></i> Bayar Sekarang';
            });
        });
        @endif
    @endif
</script>
@endpush
