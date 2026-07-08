@extends('admin.layouts.app')

@section('title', 'Notifikasi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Notifikasi</h2>
    <form action="{{ route('admin.notifications.mark-all-read') }}" method="POST" class="d-inline">
        @csrf
        <button class="btn btn-outline-primary btn-sm">
            <i class="bi bi-check-all"></i> Tandai Semua Dibaca
        </button>
    </form>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="list-group list-group-flush">
            @forelse($notifications as $notification)
                <div class="list-group-item list-group-item-action d-flex align-items-start gap-3 p-4 {{ !$notification->is_read ? 'bg-light' : '' }}">
                    <div class="flex-shrink-0">
                        <span class="badge bg-{{ $notification->type == 'booking' ? 'primary' : ($notification->type == 'payment' ? 'success' : ($notification->type == 'review' ? 'info' : 'secondary')) }} p-2">
                            <i class="bi bi-{{ $notification->type == 'booking' ? 'calendar-check' : ($notification->type == 'payment' ? 'credit-card' : ($notification->type == 'review' ? 'star' : 'bell')) }}"></i>
                        </span>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-1 {{ !$notification->is_read ? 'fw-bold' : '' }}">{{ $notification->title }}</h6>
                            <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="mb-1 text-muted">{{ $notification->message }}</p>
                        @if($notification->url)
                            <a href="{{ $notification->url }}" class="btn btn-sm btn-link p-0">Lihat Detail</a>
                        @endif
                    </div>
                    @if(!$notification->is_read)
                        <button class="btn btn-sm btn-link text-decoration-none mark-read" data-id="{{ $notification->id }}">
                            <i class="bi bi-check-circle text-success"></i>
                        </button>
                    @endif
                </div>
            @empty
                <div class="text-center py-5">
                    <i class="bi bi-bell-slash" style="font-size: 3rem; color: #ccc;"></i>
                    <p class="mt-3 text-muted">Tidak ada notifikasi</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<div class="d-flex justify-content-center mt-3">
    {{ $notifications->links() }}
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.mark-read').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            fetch(`/admin/notifications/${id}/read`, { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
                .then(() => {
                    this.closest('.list-group-item').classList.remove('bg-light');
                    this.remove();
                });
        });
    });
</script>
@endpush