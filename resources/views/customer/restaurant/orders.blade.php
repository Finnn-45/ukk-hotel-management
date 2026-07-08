@extends('customer.layouts.app')

@section('title', 'Pesanan Restoran Saya')

@section('content')
<div class="container py-4">
    <h3 class="section-title">Pesanan Restoran Saya</h3>

    @forelse($orders as $order)
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h5 class="fw-bold mb-1">#{{ $order->order_number }}</h5>
                        <small class="text-muted">{{ $order->created_at->format('d/m/Y H:i') }}</small>
                    </div>
                    @php
                        $statusColors = [
                            'pending' => 'warning',
                            'preparing' => 'info',
                            'ready' => 'primary',
                            'completed' => 'success',
                            'cancelled' => 'danger',
                        ];
                    @endphp
                    <span class="badge bg-{{ $statusColors[$order->status] ?? 'secondary' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <div class="row mb-3">
                    @foreach($order->details->take(3) as $detail)
                        <div class="col-md-4 mb-2">
                            <div class="d-flex align-items-center gap-2">
                                <div class="stat-icon stat-icon-primary" style="width: 40px; height: 40px; font-size: 1rem;">
                                    <i class="bi bi-{{ $detail->menu->is_available ? 'check-circle' : 'x-circle' }}"></i>
                                </div>
                                <div>
                                    <div style="font-weight: 600;">{{ $detail->menu->name }}</div>
                                    <small class="text-muted">x{{ $detail->quantity }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if($order->details->count() > 3)
                        <div class="col-12">
                            <small class="text-muted">+{{ $order->details->count() - 3 }} item lainnya</small>
                        </div>
                    @endif
                </div>

                <div class="d-flex justify-content-between align-items-center border-top pt-3">
                    <span class="text-muted">Total Pesanan</span>
                    <span class="fw-bold fs-5 text-primary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>

                <div class="d-grid gap-2 mt-3">
                    <a href="{{ route('customer.restaurant.order.detail', $order) }}" class="btn btn-primary">
                        <i class="bi bi-eye"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-5">
            <i class="bi bi-receipt display-1 text-muted"></i>
            <h5 class="mt-3">Belum ada pesanan</h5>
            <p class="text-muted">Mulai pesan dari menu restaurant kami</p>
            <a href="{{ route('customer.restaurant.menu') }}" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Lihat Menu
            </a>
        </div>
    @endforelse

    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection