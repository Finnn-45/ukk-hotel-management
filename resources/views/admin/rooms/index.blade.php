@extends('admin.layouts.app')

@section('title', 'Kamar')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Kamar</h2>
        <p class="text-muted mb-0">Kelola kamar hotel dan pantau status ketersediaannya</p>
    </div>
    <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary rounded-3">
        <i class="bi bi-plus-circle me-1"></i> Tambah Kamar
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-4">
        {{-- Search & Filters --}}
        <form method="GET" action="{{ route('admin.rooms.index') }}" class="mb-4">
            <div class="row g-3 align-items-end">
                <div class="col-md-4 col-lg-3">
                    <label class="form-label small fw-semibold text-muted">Cari</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="No Kamar, lantai, tipe..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3 col-lg-3">
                    <label class="form-label small fw-semibold text-muted">Status</label>
                    <select name="status" class="form-select border rounded-3">
                        <option value="">Semua Status</option>
                        <option value="available" {{ request('status') === 'available' ? 'selected' : '' }}>Available (Tersedia)</option>
                        <option value="occupied" {{ request('status') === 'occupied' ? 'selected' : '' }}>Occupied (Terisi)</option>
                        <option value="booked" {{ request('status') === 'booked' ? 'selected' : '' }}>Booked (Terpesan)</option>
                        <option value="maintenance" {{ request('status') === 'maintenance' ? 'selected' : '' }}>Maintenance (Perawatan)</option>
                    </select>
                </div>
                <div class="col-md-3 col-lg-3">
                    <label class="form-label small fw-semibold text-muted">Tipe Kamar</label>
                    <select name="room_type_id" class="form-select border rounded-3">
                        <option value="">Semua Tipe</option>
                        @foreach($roomTypes as $type)
                            <option value="{{ $type->id }}" {{ request('room_type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 col-lg-3 d-flex gap-2">
                    <button class="btn btn-outline-secondary w-100 rounded-3" type="submit">Filter</button>
                    @if(request()->hasAny(['search', 'status', 'room_type_id']))
                        <a href="{{ route('admin.rooms.index') }}" class="btn btn-outline-danger rounded-3" title="Reset Filter"><i class="bi bi-arrow-counterclockwise"></i></a>
                    @endif
                </div>
            </div>
        </form>

        {{-- Table --}}
        <div class="table-responsive">
            <table class="table table-hover align-middle table-custom">
                <thead class="table-light">
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Nomor Kamar</th>
                        <th>Tipe Kamar</th>
                        <th>Lantai</th>
                        <th>Status</th>
                        <th style="width: 150px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rooms as $room)
                        <tr>
                            <td><strong>#{{ $room->id }}</strong></td>
                            <td>
                                <span class="fw-bold text-dark fs-5">Kamar {{ $room->room_number }}</span>
                            </td>
                            <td>
                                <div class="fw-semibold text-muted">{{ $room->roomType->name }}</div>
                            </td>
                            <td>
                                <span class="badge badge-premium badge-premium-secondary">Lt. {{ $room->floor ?: '1' }}</span>
                            </td>
                            <td>
                                @php
                                    $statusClasses = [
                                        'available' => 'success',
                                        'occupied' => 'danger',
                                        'booked' => 'warning',
                                        'maintenance' => 'secondary'
                                    ];
                                    $statusLabel = [
                                        'available' => 'Tersedia',
                                        'occupied' => 'Terisi',
                                        'booked' => 'Terpesan',
                                        'maintenance' => 'Perbaikan'
                                    ];
                                    $color = $statusClasses[$room->status] ?? 'dark';
                                    $label = $statusLabel[$room->status] ?? ucfirst($room->status);
                                @endphp
                                <span class="badge badge-premium badge-premium-{{ $color }}">
                                    {{ $label }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-sm btn-outline-warning rounded-3" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kamar ini?')">
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
                            <td colspan="6" class="text-center py-5">
                                <i class="bi bi-door-closed display-4 text-muted d-block mb-3"></i>
                                <h5 class="fw-bold">Tidak Ada Kamar</h5>
                                <p class="text-muted">Coba bersihkan filter pencarian atau buat kamar baru.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $rooms->links('vendor.pagination.admin-pagination') }}
        </div>
    </div>
</div>
@endsection