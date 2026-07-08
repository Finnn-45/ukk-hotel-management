@extends('admin.layouts.app')

@section('title', 'Detail Booking')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Detail Booking #{{ $booking->id }}</h2>
    <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="card border-0 shadow-sm mb-3">
    <div class="card-header bg-white">Informasi Booking</div>
    <div class="card-body">
        <table class="table table-borderless">
            <tr><td><strong>Guest</strong></td><td>{{ $booking->guest->full_name }}</td></tr>
            <tr><td><strong>Kamar</strong></td><td>{{ $booking->room->room_number }} ({{ $booking->room->roomType->name }})</td></tr>
            <tr><td><strong>Check In</strong></td><td>{{ \Carbon\Carbon::parse($booking->check_in)->format('d/m/Y') }}</td></tr>
            <tr><td><strong>Check Out</strong></td><td>{{ \Carbon\Carbon::parse($booking->check_out)->format('d/m/Y') }}</td></tr>
            <tr><td><strong>Jumlah Tamu</strong></td><td>{{ $booking->number_of_guests }}</td></tr>
            <tr><td><strong>Total Harga</strong></td><td>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td></tr>
            <tr><td><strong>Status</strong></td>
                <td>
                    @php
                        $statusColors = [
                            'pending' => 'warning',
                            'confirmed' => 'success',
                            'checked_in' => 'info',
                            'checked_out' => 'secondary',
                            'cancelled' => 'danger',
                        ];
                    @endphp
                    <span class="badge bg-{{ $statusColors[$booking->status] ?? 'secondary' }}">
                        {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                    </span>
                </td>
            </tr>
        </table>

        <div class="d-flex gap-2 mt-3">
            @if($booking->status === 'confirmed')
                <form action="{{ route('admin.bookings.check-in', $booking) }}" method="POST">
                    @csrf
                    <button class="btn btn-success" onclick="return confirm('Check-in booking ini?')">
                        <i class="bi bi-box-arrow-in-right"></i> Check In
                    </button>
                </form>
            @endif
            @if($booking->status === 'checked_in')
                <form action="{{ route('admin.bookings.check-out', $booking) }}" method="POST">
                    @csrf
                    <button class="btn btn-warning" onclick="return confirm('Check-out booking ini?')">
                        <i class="bi bi-box-arrow-right"></i> Check Out
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
