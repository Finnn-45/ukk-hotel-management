@extends('admin.layouts.app')

@section('title', 'Bookings')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Bookings</h2>
    <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Booking
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari nama tamu..." value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Tamu</th>
                        <th>Kamar</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr>
                            <td>#{{ $booking->id }}</td>
                            <td>{{ $booking->guest->full_name }}</td>
                            <td>{{ $booking->room->room_number }} ({{ $booking->room->roomType->name }})</td>
                            <td>{{ \Carbon\Carbon::parse($booking->check_in)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->check_out)->format('d/m/Y') }}</td>
                            <td>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : ($booking->status === 'pending' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.bookings.show', $booking) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.bookings.edit', $booking) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus booking ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center py-4">Tidak ada data booking</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $bookings->links() }}
    </div>
</div>
@endsection