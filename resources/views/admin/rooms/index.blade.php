@extends('admin.layouts.app')

@section('title', 'Kamar')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Data Kamar</h2>
        <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Kamar
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">Daftar Kamar</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">No Kamar</th>
                            <th>Tipe</th>
                            <th>Lantai</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rooms as $room)
                            <tr>
                                <td class="ps-4"><strong>{{ $room->room_number }}</strong></td>
                                <td>{{ $room->roomType->name ?? 'N/A' }}</td>
                                <td>{{ $room->floor }}</td>
                                <td>
                                    <span class="badge bg-{{ $room->status === 'available' ? 'success' : ($room->status === 'booked' ? 'warning' : ($room->status === 'occupied' ? 'info' : 'secondary')) }}">
                                        {{ ucfirst($room->status) }}
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus kamar ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class="bi bi-inbox display-4 text-muted"></i>
                                    <p class="text-muted mt-2">Tidak ada data kamar</p>
                                    <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary btn-sm mt-2">
                                        <i class="bi bi-plus-circle"></i> Tambah Kamar Pertama
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($rooms->hasPages())
                <div class="card-footer bg-white py-3 d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        Showing {{ $rooms->firstItem() ?? 0 }} to {{ $rooms->lastItem() ?? 0 }} of {{ $rooms->total() }} entries
                    </div>
                    <div>
                        {{ $rooms->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
