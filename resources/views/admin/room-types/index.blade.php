@extends('admin.layouts.app')

@section('title', 'Tipe Kamar')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Tipe Kamar</h2>
        <p class="text-muted mb-0">Kelola tipe dan spesifikasi kamar yang ditawarkan</p>
    </div>
    <button class="btn btn-primary rounded-3" data-bs-toggle="modal" data-bs-target="#addRoomTypeModal">
        <i class="bi bi-plus-circle me-1"></i> Tambah Tipe Kamar
    </button>
</div>

<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-4">
        {{-- Search and Filter --}}
        <form method="GET" action="{{ route('admin.room-types.index') }}" class="mb-4">
            <div class="row g-3">
                <div class="col-md-6 col-lg-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Cari nama tipe kamar..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    </div>
                </div>
                @if(request('search'))
                    <div class="col-md-2">
                        <a href="{{ route('admin.room-types.index') }}" class="btn btn-outline-danger w-100 rounded-3">Reset</a>
                    </div>
                @endif
            </div>
        </form>

        {{-- Table --}}
        <div class="table-responsive">
            <table class="table table-hover align-middle table-custom">
                <thead class="table-light">
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Nama Tipe</th>
                        <th>Harga / Malam</th>
                        <th>Kapasitas</th>
                        <th>Jumlah Kamar</th>
                        <th>Deskripsi</th>
                        <th style="width: 150px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roomTypes as $type)
                        <tr>
                            <td><strong>#{{ $type->id }}</strong></td>
                            <td>
                                <div class="fw-bold text-dark">{{ $type->name }}</div>
                            </td>
                            <td>
                                <div class="text-primary fw-semibold">Rp {{ number_format($type->price, 0, ',', '.') }}</div>
                            </td>
                            <td>
                                <span class="badge badge-premium badge-premium-info">
                                    <i class="bi bi-people-fill me-1"></i> Max {{ $type->max_guests }} Tamu
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-premium badge-premium-secondary">
                                    <i class="bi bi-door-open me-1"></i> {{ $type->rooms_count }} Kamar
                                </span>
                            </td>
                            <td class="text-muted" style="max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ $type->description ?: '-' }}
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.room-types.edit', $type) }}" class="btn btn-sm btn-outline-warning rounded-3" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.room-types.destroy', $type) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tipe kamar ini? Semua kamar terkait akan terpengaruh.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-3" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-tags display-4 text-muted d-block mb-3"></i>
                                <h5 class="fw-bold">Tidak Ada Tipe Kamar</h5>
                                <p class="text-muted">Mulai dengan menambahkan tipe kamar baru.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Add Room Type Modal --}}
<div class="modal fade" id="addRoomTypeModal" tabindex="-1" aria-labelledby="addRoomTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="addRoomTypeModalLabel"><i class="bi bi-plus-circle-fill text-primary me-2"></i>Tambah Tipe Kamar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.room-types.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nama Tipe Kamar</label>
                        <input type="text" class="form-control rounded-3" id="name" name="name" required placeholder="Contoh: Deluxe Room, Family Suite">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label fw-semibold">Harga per Malam (Rp)</label>
                        <input type="number" class="form-control rounded-3" id="price" name="price" required min="0" placeholder="Contoh: 500000">
                    </div>
                    <div class="mb-3">
                        <label for="max_guests" class="form-label fw-semibold">Maksimal Tamu</label>
                        <input type="number" class="form-control rounded-3" id="max_guests" name="max_guests" required min="1" placeholder="Contoh: 2">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Deskripsi</label>
                        <textarea class="form-control rounded-3" id="description" name="description" rows="3" placeholder="Tulis deskripsi atau spesifikasi tipe kamar..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary rounded-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-3 px-4">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection