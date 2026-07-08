@extends('admin.layouts.app')

@section('title', 'Tipe Kamar')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Tipe Kamar</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
        <i class="bi bi-plus-circle"></i> Tambah Tipe Kamar
    </button>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Harga/Malam</th>
                        <th>Max Tamu</th>
                        <th>Total Kamar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roomTypes as $type)
                        <tr>
                            <td><strong>{{ $type->name }}</strong></td>
                            <td>{{ Str::limit($type->description, 30) ?? '-' }}</td>
                            <td>Rp {{ number_format($type->price, 0, ',', '.') }}</td>
                            <td>{{ $type->max_guests }}</td>
                            <td>{{ $type->rooms_count }}</td>
                            <td>
                                <a href="{{ route('admin.room-types.edit', $type) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.room-types.destroy', $type) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus tipe kamar ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" {{ $type->rooms_count > 0 ? 'disabled' : '' }}>
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-4">Tidak ada data tipe kamar</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.room-types.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Tipe Kamar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga/Malam <span class="text-danger">*</span></label>
                            <input type="number" name="price" class="form-control" min="0" step="1000" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Max Tamu <span class="text-danger">*</span></label>
                            <input type="number" name="max_guests" class="form-control" min="1" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection