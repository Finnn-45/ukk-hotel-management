@extends('admin.layouts.app')

@section('title', 'Pembayaran')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Data Pembayaran</h2>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari metode atau status pembayaran..." value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID Booking</th>
                        <th>Guest</th>
                        <th>Metode</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                        <tr>
                            <td>#{{ $payment->booking_id }}</td>
                            <td>{{ $payment->booking->guest->full_name }}</td>
                            <td>
                                <span class="badge bg-info">{{ str_replace('_', ' ', ucfirst(str_replace('_', ' ', $payment->payment_method))) }}</span>
                            </td>
                            <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge bg-{{ $payment->payment_status === 'paid' ? 'success' : ($payment->payment_status === 'pending' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($payment->payment_status) }}
                                </span>
                            </td>
                            <td>{{ $payment->paid_at ? \Carbon\Carbon::parse($payment->paid_at)->format('d/m/Y H:i') : '-' }}</td>
                            <td>
                                <a href="{{ route('admin.payments.show', $payment) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center py-4">Tidak ada data pembayaran</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $payments->links() }}
    </div>
</div>
@endsection