@extends('admin.layouts.app')

@section('title', 'Tambah Kamar')

@section('content')
<h2 class="mb-4">Tambah Kamar</h2>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.rooms.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Tipe Kamar</label>
                <select name="room_type_id" class="form-select" required>
                    <option value="">Pilih Tipe</option>
                    @foreach($roomTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->name }} - Rp {{ number_format($type->price, 0, ',', '.') }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">No Kamar</label>
                <input type="text" name="room_number" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Lantai</label>
                <input type="text" name="floor" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="available">Available</option>
                    <option value="occupied">Occupied</option>
                    <option value="maintenance">Maintenance</option>
                    <option value="booked">Booked</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection