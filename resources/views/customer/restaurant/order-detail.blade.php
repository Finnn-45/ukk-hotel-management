@extends('customer.layouts.app')

@section('title', 'Detail Pesanan #' . $order->order_number)

@push('styles')
<style>
    .se-order-detail-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
    }
    .se-order-detail-card .card-header {
        background: var(--bg-card);
        border-bottom: 1px solid var(--border);
        padding: 16px 20px;
    }
    .se-order-detail-card .card-body {
        padding: 20px;
    }
    .se-summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }
    .se-summary-item .label {
        color: var(--text-muted);
        font-size: 0.9rem;
        font-family: var(--font-alt);
    }
    .se-summary-item .value {
        font-weight: 600;
        color: var(--text);
    }
</style>
@endpush

@section('content')
<div class="container py-4">
    {{-- Header --}}
    <div class="d-flex align-items-center gap-3 mb-4 flex-wrap justify-content-between">
        <div class="d-flex align-items-center gap-3">
            <div class="p-3 rounded-2" style="background: var(--primary-light);">
                <i class="bi bi-receipt fs-4" style="color: var(--primary);"></i>
            </div>
            <div>
                <h3 class="fw-bold mb-1" style="color: var(--text);">Detail Pesanan #{{ $order->order_number }}</h3>
                <p class="text-muted small mb-0" style="font-family:var(--font-alt);">Informasi lengkap pesanan restoran Anda</p>
            </div>
        </div>
        <a href="{{ route('customer.restaurant.orders') }}" class="btn-se btn-se-outline" style="padding:10px 20px;font-size:0.85rem;">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-8 col-md-12">
            <div class="se-order-detail-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <h5 class="fw-bold mb-0" style="color: var(--text);">Detail Item</h5>
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
                        <span class="se-badge" style="background:{{ $sc['bg'] }};color:{{ $sc['text'] }};">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <thead style="background: var(--bg);">
                                <tr>
                                    <th style="font-size:0.75rem;font-weight:700;text-transform:uppercase;color:var(--text-muted);padding:12px 20px;">Menu</th>
                                    <th class="text-center d-none d-md-table-cell" style="font-size:0.75rem;font-weight:700;text-transform:uppercase;color:var(--text-muted);">Qty</th>
                                    <th class="text-end d-none d-md-table-cell" style="font-size:0.75rem;font-weight:700;text-transform:uppercase;color:var(--text-muted);">Harga</th>
                                    <th class="text-end" style="font-size:0.75rem;font-weight:700;text-transform:uppercase;color:var(--text-muted);padding:12px 20px;">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->details as $detail)
                                    <tr>
                                        <td style="padding:14px 20px;">
                                            <div class="d-flex align-items-center gap-2">
                                                <div>
                                                    <strong class="d-block" style="color: var(--text);">{{ $detail->menu->name }}</strong>
                                                    @if($detail->menu->description)
                                                        <small class="text-muted d-block d-md-none">{{ Str::limit($detail->menu->description, 50) }}</small>
                                                    @endif
                                                    <small class="text-muted d-none d-md-inline" style="font-family:var(--font-alt);">{{ $detail->menu->description }}</small>
                                                </div>
                                            </div>
                                            <div class="d-md-none mt-1">
                                                <small class="text-muted" style="font-family:var(--font-alt);">Qty: <strong>x{{ $detail->quantity }}</strong></small>
                                                <small class="text-muted ms-2" style="font-family:var(--font-alt);">Harga: Rp {{ number_format($detail->price, 0, ',', '.') }}</small>
                                            </div>
                                        </td>
                                        <td class="text-center d-none d-md-table-cell" style="padding:14px 10px;font-family:var(--font-alt);">x{{ $detail->quantity }}</td>
                                        <td class="text-end d-none d-md-table-cell" style="padding:14px 10px;font-family:var(--font-alt);">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                                        <td class="text-end fw-bold" style="padding:14px 20px;color: var(--text);">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="se-order-detail-card">
                <div class="card-header">
                    <h5 class="fw-bold mb-0" style="color: var(--text);">Ringkasan</h5>
                </div>
                <div class="card-body">
                    <div class="se-summary-item">
                        <span class="label">No. Pesanan</span>
                        <span class="value">#{{ $order->order_number }}</span>
                    </div>
                    <div class="se-summary-item">
                        <span class="label">Tanggal</span>
                        <span class="value">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="se-summary-item">
                        <span class="label">Nomor Kamar/Meja</span>
                        <strong style="color: var(--text);">{{ $order->table_number }}</strong>
                    </div>
                    <hr style="border-color:var(--border);">
                    <div class="d-flex justify-content-between mb-3">
                        <span class="fw-bold" style="color: var(--text);">Total</span>
                        <span class="fw-bold fs-5" style="color: var(--primary);">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                    @if($order->notes)
                        <div class="p-3 rounded-3" style="background: var(--primary-light); color: var(--primary);">
                            <strong class="small">Catatan:</strong><br>
                            <span style="font-family:var(--font-alt);font-size:0.9rem;">{{ $order->notes }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection