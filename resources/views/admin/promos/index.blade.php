@extends('admin.layouts.app')

@section('title', 'Kelola Promo')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex align-items-center gap-3">
        <h2 class="mb-0">Manajemen Promo</h2>
        <span class="badge bg-primary">{{ $promos->total() }} Promo Aktif</span>
    </div>
    <a href="{{ route('admin.promos.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Tambah Promo
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                    <th>Judul</th>
                    <th>Kode</th>
                    <th>Tipe Diskon</th>
                    <th>Nilai Diskon</th>
                    <th>Berlaku Dari</th>
                    <th>Berlaku Hingga</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($promos as $promo)
                    <tr>
                        <td>
                            <div class="fw-semibold">{{ $promo->title }}</div>
                            @if($promo->description)
                                <small class="text-muted">{{ Str::limit($promo->description, 50) }}</small>
                            @endif
                        </td>
                        <td>
                            <code class="bg-light px-2 py-1 rounded">{{ $promo->code }}</code>
                        </td>
                        <td>
                            <span class="badge bg-info text-dark">
                                {{ $promo->discount_type === 'percentage' ? 'Persentase' : 'Fixed' }}
                            </span>
                        </td>
                        <td>
                            <strong>
                                {{ $promo->discount_type === 'percentage' ? $promo->discount_value . '%' : 'Rp ' . number_format($promo->discount_value, 0, ',', '.') }}
                            </strong>
                        </td>
                        <td>
                            <small>{{ $promo->valid_from->format('d M Y') }}</small>
                        </td>
                        <td>
                            <small>{{ $promo->valid_until->format('d M Y') }}</small>
                        </td>
                        <td>
                            @if($promo->is_active)
                                @if($promo->valid_until->isFuture())
                                    <span class="badge badge-premium badge-premium-success">
                                        <i class="bi bi-check-circle"></i> Aktif
                                    </span>
                                @else
                                    <span class="badge badge-premium badge-premium-danger">
                                        <i class="bi bi-clock"></i> Kedaluwarsa
                                    </span>
                                @endif
                            @else
                                <span class="badge badge-premium badge-premium-secondary">
                                    <i class="bi bi-x-circle"></i> Nonaktif
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('admin.promos.edit', $promo) }}" 
                                   class="btn btn-sm btn-outline-primary rounded-3"
                                   data-bs-toggle="tooltip"
                                   title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.promos.destroy', $promo) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus promo ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-3" data-bs-toggle="tooltip" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <i class="bi bi-tag" style="font-size: 3rem; color: #CBD5E1;"></i>
                            <p class="text-muted mt-3">Belum ada promo yang dibuat</p>
                            <a href="{{ route('admin.promos.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-2"></i>Buat Promo Pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($promos->hasPages())
<div class="d-flex justify-content-between align-items-center mt-4">
    <div class="text-muted small">
        Menampilkan {{ $promos->firstItem() }} - {{ $promos->lastItem() }} dari {{ $promos->total() }} promo
    </div>
    <div>
        {{ $promos->links('vendor.pagination.admin-pagination') }}
    </div>
</div>
@endif
@endsection

@push('styles')
<style>
    .badge-premium {
        padding: 5px 12px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.72rem;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .badge-premium-success { background: #DCFCE7; color: #16A34A; }
    .badge-premium-danger { background: #FEE2E2; color: #DC2626; }
    .badge-premium-info { background: #E0F2FE; color: #0284C7; }
    .badge-premium-secondary { background: #F1F5F9; color: #64748B; }
</style>
@endpush

@push('scripts')
<script>
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
</script>
@endpush