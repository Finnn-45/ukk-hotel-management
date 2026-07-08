@extends('admin.layouts.app')

@section('title', 'Tambah Booking')

@section('content')
<h2 class="mb-4">Tambah Booking</h2>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.bookings.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Guest</label>
                <select name="guest_id" class="form-select" required>
                    <option value="">Pilih Guest</option>
                    @foreach($guests as $guest)
                        <option value="{{ $guest->id }}">{{ $guest->full_name }} - {{ $guest->phone }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Kamar</label>
                <select name="room_id" class="form-select" required>
                    <option value="">Pilih Kamar</option>
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}">
                            {{ $room->room_number }} - {{ $room->roomType->name }} (Rp {{ number_format($room->roomType->price, 0, ',', '.') }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Check In</label>
                    <input type="date" name="check_in" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Check Out</label>
                    <input type="date" name="check_out" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jumlah Tamu</label>
                    <input type="number" name="number_of_guests" class="form-control" min="1" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Total Harga</label>
                    <input type="number" name="total_price" class="form-control" min="0" step="1000" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="checked_in">Checked In</option>
                    <option value="checked_out">Checked Out</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection