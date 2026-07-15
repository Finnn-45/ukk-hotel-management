@extends('customer.layouts.app')

@section('title', 'Pesanan Berhasil - Restoran Hotel')

@push('styles')
<style>
    .se-confirmation-hero {
        background: linear-gradient(135deg, #0F172A 0%, #1E3A5F 40%, #0284C7 100%);
        color: white;
        padding: 60px 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .se-confirmation-hero::before {
        content: '';
        position: absolute;
        width: 400px; height: 400px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(2,132,199,0.15) 0%, transparent 70%);
        top: -100px; right: -100px;
    }
    .se-confirmation-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        font-size: 3rem;
        color: #fff;
        box-shadow: 0 8px 24px rgba(34,197,94,0.3);
        animation: scaleIn 0.5s ease;
    }
    @keyframes scaleIn {
        from { transform: scale(0); }
        to { transform: scale(1); }
    }
    .se-confirmation-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow-lg);
        overflow: hidden;
    }
    .se-confirmation-card .card-body {
        padding: 40px;
    }
    .se-order-info-row {
        display: flex;
        justify-content: space-between;
        padding: 14px 0;
        border-bottom: 1px solid var(--border);
    }
    .se-order-info-row:last-of-type {
        border-bottom: none;
    }
    .se-menu-item-confirm {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 14px 0;
        border-bottom: 1px solid var(--border);
    }
    .se-menu-item-confirm:last-child {
        border-bottom: none;
    }
</style>
@endpush

@section('content')
<div class="se-confirmation-hero">
    <div class="container">
        <div class="se-confirmation-icon">
            <i class="bi bi-check-lg"></i>
        </div>
        <h1 class="fw-bold mb-3" style="font-size:2rem;">Pesanan Berhasil!</h1>
        <p class="mb-0" style="color:rgba(255,255,255,0.7);font-size:1.05rem;">Terima kasih atas pesanan Anda. Pesanan sedang diproses.</p>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="se-confirmation-card">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h4 class="fw-bold" style="color: var(--text);">Nomor Pesanan: #{{ $order->order_number }}</h4>
                        @php
                            $statusColors = [
                                'pending' => ['bg' => '#FEF3C7', 'text' => '#D97706'],
                                'preparing' => ['bg' => '#E0F2FE', 'text' => '#0369A1'],
                                'ready' => ['bg' => '#E0F2FE', 'text' => '#0369A1'],
                                'completed' => ['bg' => '#DCFCE7', 'text' => '#16A34A'],
                                'cancelled' => ['bg' => '#FEE2E2', 'text' => '#DC2626'],
                            ];
                            $sc = $statusColors[$order->status] ?? ['bg' => '#F3F4F6', 'text' => '#6B7280'];
                        @endphp
                        <span class="se-badge mt-2" style="background:{{ $sc['bg'] }};color:{{ $sc['text'] }};">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <div class="se-order-info-row">
                        <span class="text-muted" style="font-family:var(--font-alt);">Waktu Order</span>
                        <strong style="color: var(--text);">{{ $order->created_at->format('d/m/Y H:i') }}</strong>
                    </div>
                    <div class="se-order-info-row">
                        <span class="text-muted" style="font-family:var(--font-alt);">Total</span>
                        <strong class="fs-5" style="color: var(--primary);">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong>
                    </div>
                    <div class="se-order-info-row">
                        <span class="text-muted" style="font-family:var(--font-alt);">Nomor Kamar/Meja</span>
                        <strong style="color: var(--text);">{{ $order->table_number }}</strong>
                    </div>

                    <hr class="my-4" style="border-color:var(--border);">

                    <h5 class="fw-bold mb-3" style="color: var(--text);">Detail Pesanan</h5>
                    @foreach($order->details as $detail)
                        <div class="se-menu-item-confirm">
                            <div>
                                <strong style="color: var(--text);">{{ $detail->menu->name }}</strong>
                                @if($detail->menu->description)
                                    <br><small class="text-muted" style="font-family:var(--font-alt);">{{ $detail->menu->description }}</small>
                                @endif
                            </div>
                            <div class="text-end">
                                <div style="font-family:var(--font-alt);color:var(--text-muted);">x{{ $detail->quantity }}</div>
                                <div class="fw-bold" style="color: var(--text);">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    @endforeach

                    @if($order->notes)
                        <div class="p-3 rounded-3 mt-3" style="background: var(--primary-light); color: var(--primary);">
                            <strong class="small">Catatan:</strong><br>
                            <span style="font-family:var(--font-alt);font-size:0.9rem;">{{ $order->notes }}</span>
                        </div>
                    @endif

                    <div class="d-grid gap-2 mt-4">
                        @if($order->status == 'pending')
                            <button id="pay-button" class="btn-se btn-se-primary w-100 py-3" style="font-size:1rem;">
                                <i class="bi bi-credit-card me-2"></i> Bayar Sekarang
                            </button>
                        @endif
                        <a href="{{ route('customer.restaurant.order.detail', $order) }}" class="btn-se btn-se-primary w-100 py-3" style="font-size:1rem;">
                            <i class="bi bi-eye me-2"></i> Lihat Detail Pesanan
                        </a>
                        <a href="{{ route('customer.restaurant.menu') }}" class="btn-se btn-se-outline w-100 py-3" style="font-size:1rem;">
                            <i class="bi bi-arrow-left me-2"></i> Pesan Lagi
                        </a>
                    </div>

                    @if($order->status == 'pending')
                        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
                        <script type="text/javascript">
                            document.getElementById('pay-button').addEventListener('click', function() {
                                fetch("{{ route('payment.midtrans.restaurant.token', $order) }}")
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.error) {
                                            alert(data.message);
                                            return;
                                        }
                                        window.snap.pay(data.token, {
                                            onSuccess: function(result) {
                                                window.location.href = "{{ route('payment.midtrans.restaurant.success') }}?order_id=" + result.order_id + "&status_code=" + result.status_code;
                                            },
                                            onPending: function(result) {
                                                window.location.href = "{{ route('payment.midtrans.restaurant.pending') }}?order_id=" + result.order_id;
                                            },
                                            onError: function(result) {
                                                window.location.href = "{{ route('payment.midtrans.restaurant.error') }}";
                                            }
                                        });
                                    });
                            });
                        </script>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection