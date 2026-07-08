@extends('customer.layouts.app')

@section('title', 'Detail Pesanan #' . $order->order_number)

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Detail Pesanan #{{ $order->order_number }}</h3>
        <a href="{{ route('customer.restaurant.orders') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Detail Item</h5>
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
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead class="table-light">
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
                                            <div class="d-flex align-items-center gap-3">
                                                <div>
                                                    <strong>{{ $detail->menu->name }}</strong>
                                                    @if($detail->menu->description)
                                                        <br><small class="text-muted">{{ $detail->menu->description }}</small>
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
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Ringkasan</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">No. Pesanan</span>
                        <strong>#{{ $order->order_number }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Tanggal</span>
                        <span>{{ $order->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Nomor Kamar/Meja</span>
                        <strong>{{ $order->table_number }}</strong>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="fw-bold">Total</span>
                        <span class="fw-bold fs-5 text-primary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                    @if($order->notes)
                        <div class="alert alert-info">
                            <strong>Catatan:</strong><br>
                            {{ $order->notes }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection