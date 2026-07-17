@extends('admin.layouts.app')

@section('title', 'Tambah Kamar')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Tambah Kamar Baru</h2>
        <p class="text-muted mb-0">Masukkan spesifikasi dan detail kamar baru</p>
    </div>
    <a href="{{ route('admin.rooms.index') }}" class="btn btn-outline-secondary rounded-3">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <form action="{{ route('admin.rooms.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="room_type_id" class="form-label fw-semibold">Tipe Kamar</label>
                        <select class="form-select rounded-3 @error('room_type_id') is-invalid @enderror" id="room_type_id" name="room_type_id" required>
                            <option value="">Pilih Tipe Kamar</option>
                            @foreach($roomTypes as $type)
                                <option value="{{ $type->id }}" {{ old('room_type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }} (Rp {{ number_format($type->price, 0, ',', '.') }} / malam)
                                </option>
                            @endforeach
                        </select>
                        @error('room_type_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="room_number" class="form-label fw-semibold">Nomor Kamar</label>
                        <input type="text" class="form-control rounded-3 @error('room_number') is-invalid @enderror" id="room_number" name="room_number" value="{{ old('room_number') }}" required placeholder="Contoh: 101, A-02">
                        @error('room_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="floor" class="form-label fw-semibold">Lantai</label>
                        <input type="number" class="form-control rounded-3 @error('floor') is-invalid @enderror" id="floor" name="floor" value="{{ old('floor', 1) }}" min="1" placeholder="Contoh: 1">
                        @error('floor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label fw-semibold">Status Kamar</label>
                        <select class="form-select rounded-3 @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="available" {{ old('status', 'available') === 'available' ? 'selected' : '' }}>Available (Tersedia)</option>
                            <option value="occupied" {{ old('status') === 'occupied' ? 'selected' : '' }}>Occupied (Terisi)</option>
                            <option value="booked" {{ old('status') === 'booked' ? 'selected' : '' }}>Booked (Terpesan)</option>
                            <option value="maintenance" {{ old('status') === 'maintenance' ? 'selected' : '' }}>Maintenance (Perawatan)</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('admin.rooms.index') }}" class="btn btn-outline-secondary rounded-3 px-4">Batal</a>
                        <button type="submit" class="btn btn-primary rounded-3 px-4">Simpan Kamar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection