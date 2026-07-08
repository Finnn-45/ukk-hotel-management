@extends('admin.layouts.app')

@section('title', 'Detail Pembayaran')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Detail Pembayaran</h2>
    <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-white">Informasi Pembayaran</div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr><td><strong>Booking ID</strong></td><td>#{{ $payment->booking_id }}</td></tr>
                    <tr><td><strong>Guest</strong></td><td>{{ $payment->booking->guest->full_name }}</td></tr>
                    <tr><td><strong>Kamar</strong></td><td>{{ $payment->booking->room->room_number }} ({{ $payment->booking->room->roomType->name }})</td></tr>
                    <tr><td><strong>Metode</strong></td><td>{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</td></tr>
                    <tr><td><strong>Jumlah</strong></td><td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td></tr>
                    <tr><td><strong>Status</strong></td>
                        <td>
                            <span class="badge bg-{{ $payment->payment_status === 'paid' ? 'success' : ($payment->payment_status === 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($payment->payment_status) }}
                            </span>
                        </td>
                    </tr>
                    <tr><td><strong>Tanggal Bayar</strong></td><td>{{ $payment->paid_at ? \Carbon\Carbon::parse($payment->paid_at)->format('d/m/Y H:i') : '-' }}</td></tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-white">Update Pembayaran</div>
            <div class="card-body">
                <form action="{{ route('admin.payments.update', $payment) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Metode Pembayaran</label>
                        <select name="payment_method" class="form-select">
                            <option value="cash" {{ $payment->payment_method == 'cash' ? 'selected' : '' }}>Cash</option>
                            <option value="transfer" {{ $payment->payment_method == 'transfer' ? 'selected' : '' }}>Transfer</option>
                            <option value="credit_card" {{ $payment->payment_method == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                            <option value="e_wallet" {{ $payment->payment_method == 'e_wallet' ? 'selected' : '' }}>E-Wallet</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status Pembayaran</label>
                        <select name="payment_status" class="form-select">
                            <option value="pending" {{ $payment->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $payment->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="failed" {{ $payment->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                            <option value="refunded" {{ $payment->payment_status == 'refunded' ? 'selected' : '' }}>Refunded</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Pembayaran</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection