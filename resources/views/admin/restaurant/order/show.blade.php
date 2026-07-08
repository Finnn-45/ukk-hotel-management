@extends('admin.layouts.app')

@section('title', 'Detail Pesanan Restoran')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0">🍽️ Detail Pesanan</h2>
        <p class="text-muted">#{{ $order->order_number }}</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.restaurant.order.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <!-- Info Tamu -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">👤 Informasi Tamu</h5>
                    <span class="badge-premium badge-premium-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'completed' ? 'success' : ($order->status == 'cancelled' ? 'danger' : ($order->status == 'preparing' ? 'info' : 'primary'))) }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <small class="text-muted d-block">Nama Tamu</small>
                        <strong>{{ $order->guest->full_name }}</strong>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block">Email</small>
                        <strong>{{ $order->guest->email }}</strong>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block">No. Kamar/Meja</small>
                        <span class="badge bg-dark fs-6">🏠 {{ $order->table_number }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Menu -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0">🍽️ Detail Menu</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-custom mb-0">
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th class="text-center">Qty</th>
                                <th class="text-end">Harga</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->details as $detail)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="stat-icon stat-icon-primary" style="width: 36px; height: 36px; font-size: 0.9rem;">
                                                <i class="bi bi-{{ $detail->menu->is_available ? 'check-circle' : 'x-circle' }}"></i>
                                            </div>
                                            <div>
                                                <strong>{{ $detail->menu->name }}</strong>
                                                @if($detail->menu->category)
                                                    <br><small class="text-muted">{{ $detail->menu->category }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">x{{ $detail->quantity }}</td>
                                    <td class="text-end">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                                    <td class="text-end fw-bold">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        @if($order->notes)
                            <small class="text-muted"><strong>Catatan:</strong> {{ $order->notes }}</small>
                        @endif
                    </div>
                    <div class="text-end">
                        <small class="text-muted d-block">Total Pesanan</small>
                        <span class="fw-bold fs-4 text-primary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Status Management -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0">⚙️ Manajemen Status</h5>
            </div>
            <div class="card-body">
                @if($order->status != 'cancelled' && $order->status != 'completed')
                    <div class="d-grid gap-2">
                        @if($order->status == 'pending')
                            <button class="btn btn-info w-100" onclick="updateStatus({{ $order->id }}, 'preparing')">
                                <i class="bi bi-gear"></i> Mulai Dibuat
                            </button>
                        @endif

                        @if($order->status == 'preparing')
                            <button class="btn btn-primary w-100" onclick="updateStatus({{ $order->id }}, 'ready')">
                                <i class="bi bi-check"></i> Siap Saji
                            </button>
                        @endif

                        @if($order->status == 'ready')
                            <button class="btn btn-success w-100" onclick="updateStatus({{ $order->id }}, 'completed')">
                                <i class="bi bi-check-circle"></i> Selesaikan
                            </button>
                        @endif

                        @if($order->status != 'cancelled')
                            <button class="btn btn-outline-danger w-100 mt-2" onclick="updateStatus({{ $order->id }}, 'cancelled')">
                                <i class="bi bi-x-circle"></i> Batalkan
                            </button>
                        @endif
                    </div>
                @else
                    <div class="text-center py-3">
                        @if($order->status == 'completed')
                            <div class="stat-icon stat-icon-success mx-auto mb-2" style="width: 60px; height: 60px; font-size: 1.5rem;">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <p class="fw-bold text-success mb-0">Pesanan Selesai</p>
                            <small class="text-muted">Pesanan telah selesai diproses</small>
                        @else
                            <div class="stat-icon stat-icon-danger mx-auto mb-2" style="width: 60px; height: 60px; font-size: 1.5rem;">
                                <i class="bi bi-x-circle"></i>
                            </div>
                            <p class="fw-bold text-danger mb-0">Pesanan Dibatalkan</p>
                            <small class="text-muted">Pesanan telah dibatalkan</small>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <!-- Timeline -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0">📋 Timeline</h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="d-flex align-items-center gap-3 mb-3">
                        <div class="stat-icon stat-icon-{{ $order->status != 'cancelled' ? 'success' : 'secondary' }}" style="width: 36px; height: 36px; font-size: 0.8rem;">
                            <i class="bi bi-receipt"></i>
                        </div>
                        <div>
                            <strong class="d-block">Dipesan</strong>
                            <small class="text-muted">{{ $order->created_at->format('d/m/Y H:i') }}</small>
                        </div>
                    </li>
                    @if($order->status == 'preparing' || $order->status == 'ready' || $order->status == 'completed')
                        <li class="d-flex align-items-center gap-3 mb-3">
                            <div class="stat-icon stat-icon-info" style="width: 36px; height: 36px; font-size: 0.8rem;">
                                <i class="bi bi-gear"></i>
                            </div>
                            <div>
                                <strong class="d-block">Sedang Dibuat</strong>
                                <small class="text-muted">Sedang diproses dapur</small>
                            </div>
                        </li>
                    @endif
                    @if($order->status == 'ready')
                        <li class="d-flex align-items-center gap-3 mb-3">
                            <div class="stat-icon stat-icon-primary" style="width: 36px; height: 36px; font-size: 0.8rem;">
                                <i class="bi bi-check"></i>
                            </div>
                            <div>
                                <strong class="d-block">Siap Saji</strong>
                                <small class="text-muted">Siap diantar ke tamu</small>
                            </div>
                        </li>
                    @endif
                    @if($order->status == 'completed')
                        <li class="d-flex align-items-center gap-3">
                            <div class="stat-icon stat-icon-success" style="width: 36px; height: 36px; font-size: 0.8rem;">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <div>
                                <strong class="d-block">Selesai</strong>
                                <small class="text-muted">Pesanan telah selesai</small>
                            </div>
                        </li>
                    @endif
                    @if($order->status == 'cancelled')
                        <li class="d-flex align-items-center gap-3">
                            <div class="stat-icon stat-icon-danger" style="width: 36px; height: 36px; font-size: 0.8rem;">
                                <i class="bi bi-x-circle"></i>
                            </div>
                            <div>
                                <strong class="d-block">Dibatalkan</strong>
                                <small class="text-muted">Pesanan dibatalkan</small>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
function updateStatus(orderId, status) {
    const messages = {
        'preparing': 'Mulai membuat pesanan ini?',
        'ready': 'Tandai pesanan sudah siap?',
        'completed': 'Selesaikan pesanan ini?',
        'cancelled': 'Batalkan pesanan ini?'
    };
    
    if (!confirm(messages[status] || 'Yakin ingin mengubah status?')) return;
    
    fetch(`/admin/restaurant/orders/${orderId}/status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ status: status })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Gagal update status');
        }
    });
}
</script>
@endsection