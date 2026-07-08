@extends('customer.layouts.app')

@section('title', 'Pesanan Berhasil - Restoran Hotel')

@section('content')
<style>
    .confirmation-hero {
        background: linear-gradient(135deg, #ff690f 0%, #e55a00 100%);
        color: white;
        padding: 4rem 0;
        text-align: center;
    }
    .confirmation-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    .confirmation-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2rem;
        font-size: 3rem;
        animation: scaleIn 0.5s ease;
    }
    @keyframes scaleIn {
        from { transform: scale(0); }
        to { transform: scale(1); }
    }
    .order-info-row {
        display: flex;
        justify-content: space-between;
        padding: 1rem 0;
        border-bottom: 1px solid #f3f4f6;
    }
    .menu-item-confirm {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid #f3f4f6;
    }
    .menu-item-confirm:last-child {
        border-bottom: none;
    }
</style>

<div class="confirmation-hero">
    <div class="container">
        <div class="confirmation-icon">✓</div>
        <h1 class="fw-bold mb-3">Pesanan Berhasil!</h1>
        <p class="lead">Terima kasih atas pesanan Anda. Pesanan sedang diproses.</p>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card confirmation-card">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h4 class="fw-bold">Nomor Pesanan: #{{ $order->order_number }}</h4>
                        <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'completed' ? 'success' : 'info') }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <div class="order-info-row">
                        <span class="text-muted">Waktu Order</span>
                        <strong>{{ $order->created_at->format('d/m/Y H:i') }}</strong>
                    </div>
                    <div class="order-info-row">
                        <span class="text-muted">Total</span>
                        <strong class="text-primary fs-5">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong>
                    </div>
                    <div class="order-info-row">
                        <span class="text-muted">Nomor Kamar/Meja</span>
                        <strong>{{ $order->table_number }}</strong>
                    </div>

                    <hr class="my-4">

                    <h5 class="fw-bold mb-3">Detail Pesanan</h5>
                    @foreach($order->details as $detail)
                        <div class="menu-item-confirm">
                            <div>
                                <strong>{{ $detail->menu->name }}</strong>
                                @if($detail->menu->description)
                                    <br><small class="text-muted">{{ $detail->menu->description }}</small>
                                @endif
                            </div>
                            <div class="text-end">
                                <div>x{{ $detail->quantity }}</div>
                                <div class="fw-bold">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    @endforeach

                    @if($order->notes)
                        <div class="alert alert-info mt-3">
                            <strong>Catatan:</strong><br>
                            {{ $order->notes }}
                        </div>
                    @endif

                    <div class="d-grid gap-2 mt-4">
                        <a href="{{ route('customer.restaurant.order.detail', $order) }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-eye"></i> Lihat Detail Pesanan
                        </a>
                        <a href="{{ route('customer.restaurant.menu') }}" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-left"></i> Pesan Lagi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection