@extends('admin.layouts.app')

@section('title', 'Edit Kamar')

@section('content')
<h2 class="mb-4">Edit Kamar</h2>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.rooms.update', $room) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-3">
                <label class="form-label">Tipe Kamar</label>
                <select name="room_type_id" class="form-select" required>
                    <option value="">Pilih Tipe</option>
                    @foreach($roomTypes as $type)
                        <option value="{{ $type->id }}" {{ $room->room_type_id == $type->id ? 'selected' : '' }}>
                            {{ $type->name }} - Rp {{ number_format($type->price, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">No Kamar</label>
                <input type="text" name="room_number" class="form-control" value="{{ $room->room_number }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Lantai</label>
                <input type="text" name="floor" class="form-control" value="{{ $room->floor }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="available" {{ $room->status == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="occupied" {{ $room->status == 'occupied' ? 'selected' : '' }}>Occupied</option>
                    <option value="maintenance" {{ $room->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    <option value="booked" {{ $room->status == 'booked' ? 'selected' : '' }}>Booked</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection