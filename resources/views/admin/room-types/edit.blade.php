@extends('admin.layouts.app')

@section('title', 'Edit Tipe Kamar')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Edit Tipe Kamar</h2>
        <p class="text-muted mb-0">Ubah detail dan spesifikasi tipe kamar #{{ $roomType->id }}</p>
    </div>
    <a href="{{ route('admin.room-types.index') }}" class="btn btn-outline-secondary rounded-3">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <form action="{{ route('admin.room-types.update', $roomType) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nama Tipe Kamar</label>
                        <input type="text" class="form-control rounded-3 @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $roomType->name) }}" required placeholder="Contoh: Deluxe Room">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label fw-semibold">Harga per Malam (Rp)</label>
                        <input type="number" class="form-control rounded-3 @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', (int)$roomType->price) }}" required min="0" placeholder="Contoh: 500000">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="max_guests" class="form-label fw-semibold">Maksimal Tamu</label>
                        <input type="number" class="form-control rounded-3 @error('max_guests') is-invalid @enderror" id="max_guests" name="max_guests" value="{{ old('max_guests', $roomType->max_guests) }}" required min="1" placeholder="Contoh: 2">
                        @error('max_guests')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Deskripsi</label>
                        <textarea class="form-control rounded-3 @error('description') is-invalid @enderror" id="description" name="description" rows="5" placeholder="Tulis deskripsi atau spesifikasi tipe kamar...">{{ old('description', $roomType->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('admin.room-types.index') }}" class="btn btn-outline-secondary rounded-3 px-4">Batal</a>
                        <button type="submit" class="btn btn-primary rounded-3 px-4">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection