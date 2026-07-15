@extends('admin.layouts.app')

@section('title', 'Review Pelanggan')

@push('styles')
<style>
    .table-custom th {
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748B;
        padding: 14px 20px;
        background: #F8FAFC;
        border-bottom: 1px solid #E2E8F0;
    }
    .table-custom td {
        padding: 14px 20px;
        vertical-align: middle;
        font-size: 0.85rem;
        border-bottom: 1px solid #F1F5F9;
    }
    .table-custom tr:last-child td { border-bottom: none; }
</style>
@endpush

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold mb-1" style="color: #334155;">Review Pelanggan</h4>
        <p class="text-muted mb-0">Kelola ulasan dan rating dari tamu hotel</p>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom table-hover mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pelanggan</th>
                        <th>Rating</th>
                        <th>Review</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($reviews as $review)
                    <tr>
                        <td class="text-muted">{{ $loop->iteration }}</td>
                        <td class="fw-semibold text-dark">{{ $review->user->name ?? 'Anonim' }}</td>
                        <td>
                            <span class="text-warning">
                                @for($i=1;$i<=5;$i++)
                                    @if($i<=$review->rating)<i class="bi bi-star-fill"></i>@else<i class="bi bi-star"></i>@endif
                                @endfor
                            </span>
                        </td>
                        <td style="max-width:300px;">
                            <div class="text-truncate" style="font-size:0.85rem;">{{ $review->message ?? $review->review ?? '-' }}</div>
                        </td>
                        <td class="text-muted" style="font-size:0.82rem;">{{ $review->created_at ? $review->created_at->format('d/m/Y H:i') : '-' }}</td>
                        <td>
                            @if(($review->is_approved ?? $review->status) == 'approved' || ($review->is_approved ?? false))
                                <span class="badge-premium badge-premium-success">Disetujui</span>
                            @else
                                <span class="badge-premium badge-premium-warning">Menunggu</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <form action="{{ route('admin.reviews.approve', $review) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success rounded-3" title="Setujui">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus review ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger rounded-3" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <i class="bi bi-star text-muted display-5 d-block mb-3"></i>
                            <p class="text-muted">Belum ada review dari pelanggan</p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($reviews->hasPages())
<div class="d-flex justify-content-center mt-4">
    {{ $reviews->links() }}
</div>
@endif
@endsection