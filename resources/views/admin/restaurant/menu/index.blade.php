@extends('admin.layouts.app')

@section('title', 'Restaurant Menu')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Restaurant Menu</h2>
    <a href="{{ route('admin.restaurant.menu.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Menu
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($menus as $menu)
                        <tr>
                            <td><strong>{{ $menu->name }}</strong></td>
                            <td>{{ $menu->category }}</td>
                            <td>Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge bg-{{ $menu->is_available ? 'success' : 'danger' }}">
                                    {{ $menu->is_available ? 'Available' : 'Unavailable' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.restaurant.menu.edit', $menu) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.restaurant.menu.destroy', $menu) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus menu ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-4">Tidak ada data menu</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection