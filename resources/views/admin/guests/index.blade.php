@extends('admin.layouts.app')

@section('title', 'Data Guest')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Data Guest</h2>
    <a href="{{ route('admin.guests.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Guest
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari nama, email, no telp..." value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No Telp</th>
                        <th>ID Card</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($guests as $guest)
                        <tr>
                            <td><strong>{{ $guest->full_name }}</strong></td>
                            <td>{{ $guest->email }}</td>
                            <td>{{ $guest->phone }}</td>
                            <td>{{ $guest->id_card ?? '-' }}</td>
                            <td>
                                <a href="{{ route('admin.guests.edit', $guest) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.guests.destroy', $guest) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus guest ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-4">Tidak ada data guest</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $guests->links('vendor.pagination.admin-pagination') }}
    </div>
</div>
@endsection