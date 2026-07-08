@extends('admin.layouts.app')

@section('title', 'Pesanan Restoran')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0">🍽️ Pesanan Restoran</h2>
        <p class="text-muted">Kelola pesanan restoran dari tamu hotel</p>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-warning bg-opacity-10">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon stat-icon-warning">
                    <i class="bi bi-clock"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0">{{ $ordersPending }}</h3>
                    <small class="text-muted">Pending</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-info bg-opacity-10">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon stat-icon-info">
                    <i class="bi bi-gear"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0">{{ $ordersPreparing }}</h3>
                    <small class="text-muted">Dibuat</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-success bg-opacity-10">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon stat-icon-success">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0">{{ $ordersCompleted }}</h3>
                    <small class="text-muted">Selesai</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-dark bg-opacity-10">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon stat-icon-primary">
                    <i class="bi bi-receipt"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0">{{ $ordersTotal }}</h3>
                    <small class="text-muted">Total</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">Daftar Pesanan</h5>
        <div class="d-flex gap-2">
            <select class="form-select form-select-sm" id="statusFilter" style="width: auto;">
                <option value="">Semua Status</option>
                <option value="pending">Pending</option>
                <option value="preparing">Dibuat</option>
                <option value="ready">Siap</option>
                <option value="completed">Selesai</option>
                <option value="cancelled">Dibatalkan</option>
            </select>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th>No. Order</th>
                        <th>Kamar/Meja</th>
                        <th>Customer</th>
                        <th>Menu</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Waktu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>
                                <strong class="text-primary">#{{ $order->order_number }}</strong>
                            </td>
                            <td>
                                <span class="badge bg-dark">🏠 {{ $order->table_number ?? '-' }}</span>
                            </td>
                            <td>
                                <div class="fw-bold">{{ $order->guest->full_name }}</div>
                                <small class="text-muted">{{ $order->guest->email }}</small>
                            </td>
                            <td>
                                <small>
                                    @foreach($order->details->take(2) as $detail)
                                        <div>{{ $detail->menu->name }} x{{ $detail->quantity }}</div>
                                    @endforeach
                                    @if($order->details->count() > 2)
                                        <span class="text-muted">+{{ $order->details->count() - 2 }} lainnya</span>
                                    @endif
                                </small>
                            </td>
                            <td class="fw-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            <td>
                                @php
                                    $statusClass = [
                                        'pending' => 'warning',
                                        'preparing' => 'info',
                                        'ready' => 'primary',
                                        'completed' => 'success',
                                        'cancelled' => 'danger',
                                    ];
                                @endphp
                                <span class="badge-premium badge-premium-{{ $statusClass[$order->status] ?? 'secondary' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>
                                <small class="text-muted">{{ $order->created_at->diffForHumans() }}</small>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.restaurant.order.show', $order) }}" class="btn btn-sm btn-primary" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <i class="bi bi-receipt" style="font-size: 3rem; color: #ddd;"></i>
                                <p class="text-muted mt-2">Tidak ada pesanan restoran</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($orders->hasPages())
        <div class="card-footer bg-white">
            {{ $orders->links() }}
        </div>
    @endif
</div>

<script>
document.getElementById('statusFilter').addEventListener('change', function() {
    const status = this.value;
    if (status) {
        window.location.href = '?status=' + status;
    } else {
        window.location.href = '{{ route('admin.restaurant.order.index') }}';
    }
});

// Set filter from URL
const urlParams = new URLSearchParams(window.location.search);
const status = urlParams.get('status');
if (status) {
    document.getElementById('statusFilter').value = status;
}
</script>
@endsection