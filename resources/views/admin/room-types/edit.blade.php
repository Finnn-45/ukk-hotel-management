@extends('admin.layouts.app')

@section('title', 'Edit Tipe Kamar')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Tipe Kamar</h2>
    <a href="{{ route('admin.room-types.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.room-types.update', $roomType) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nama <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                       value="{{ old('name', $roomType->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                          rows="3">{{ old('description', $roomType->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Harga/Malam <span class="text-danger">*</span></label>
                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" 
                           value="{{ old('price', $roomType->price) }}" min="0" step="1000" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Max Tamu <span class="text-danger">*</span></label>
                    <input type="number" name="max_guests" class="form-control @error('max_guests') is-invalid @enderror" 
                           value="{{ old('max_guests', $roomType->max_guests) }}" min="1" required>
                    @error('max_guests')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.room-types.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection