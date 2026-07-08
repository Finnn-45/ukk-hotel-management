@extends('admin.layouts.app')

@section('title', 'Tambah Menu')

@section('content')
<h2 class="mb-4">Tambah Menu Restaurant</h2>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.restaurant.menu.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Menu</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Harga</label>
                    <input type="number" name="price" class="form-control" min="0" step="1000" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="category" class="form-control" placeholder="Main Course, Beverage, etc">
                </div>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_available" class="form-check-input" value="1" checked>
                <label class="form-check-label">Tersedia</label>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.restaurant.menu.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection