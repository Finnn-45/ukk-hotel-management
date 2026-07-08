@extends('admin.layouts.app')

@section('title', 'Edit Menu')

@section('content')
<h2 class="mb-4">Edit Menu Restaurant</h2>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.restaurant.menu.update', $restaurantMenu) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Menu</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                       value="{{ old('name', $restaurantMenu->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                          rows="3">{{ old('description', $restaurantMenu->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Harga</label>
                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" 
                           value="{{ old('price', $restaurantMenu->price) }}" min="0" step="1000" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" 
                           value="{{ old('category', $restaurantMenu->category) }}" placeholder="Main Course, Beverage, etc">
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_available" class="form-check-input" value="1" 
                       {{ old('is_available', $restaurantMenu->is_available) ? 'checked' : '' }}>
                <label class="form-check-label">Tersedia</label>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.restaurant.menu.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection