@extends('admin.layouts.app')

@section('title', 'Edit Guest')

@section('content')
<h2 class="mb-4">Edit Guest</h2>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.guests.update', $guest) }}" method="POST">
            @csrf @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" name="full_name" class="form-control" value="{{ $guest->full_name }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ $guest->email }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">No Telepon <span class="text-danger">*</span></label>
                    <input type="text" name="phone" class="form-control" value="{{ $guest->phone }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">ID Card</label>
                    <input type="text" name="id_card" class="form-control" value="{{ $guest->id_card }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="address" class="form-control" rows="3">{{ $guest->address }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.guests.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection