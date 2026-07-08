@extends('admin.layouts.app')

@section('title', 'Edit Booking')

@section('content')
<h2 class="mb-4">Edit Booking #{{ $booking->id }}</h2>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-3">
                <label class="form-label">Guest</label>
                <select name="guest_id" class="form-select" required>
                    @foreach($guests as $guest)
                        <option value="{{ $guest->id }}" {{ $booking->guest_id == $guest->id ? 'selected' : '' }}>
                            {{ $guest->full_name }} - {{ $guest->phone }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Kamar</label>
                <select name="room_id" class="form-select" required>
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}" {{ $booking->room_id == $room->id ? 'selected' : '' }}>
                            {{ $room->room_number }} - {{ $room->roomType->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Check In</label>
                    <input type="date" name="check_in" class="form-control" value="{{ $booking->check_in }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Check Out</label>
                    <input type="date" name="check_out" class="form-control" value="{{ $booking->check_out }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jumlah Tamu</label>
                    <input type="number" name="number_of_guests" class="form-control" value="{{ $booking->number_of_guests }}" min="1" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Total Harga</label>
                    <input type="number" name="total_price" class="form-control" value="{{ $booking->total_price }}" min="0" step="1000" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="checked_in" {{ $booking->status == 'checked_in' ? 'selected' : '' }}>Checked In</option>
                    <option value="checked_out" {{ $booking->status == 'checked_out' ? 'selected' : '' }}>Checked Out</option>
                    <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection