@extends('customer.layouts.app')

@section('title', 'Ulasan Saya - StayEase')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb" class="se-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Ulasan Saya</li>
        </ol>
    </nav>

    <div class="d-flex align-items-center gap-3 mb-4">
        <div class="bg-primary bg-opacity-10 p-3 rounded-2">
            <i class="bi bi-star text-primary fs-4"></i>
        </div>
        <div>
            <h3 class="fw-bold mb-1">Ulasan Saya</h3>
            <p class="text-muted small mb-0" style="font-family:var(--font-alt);">Semua ulasan yang telah Anda berikan</p>
        </div>
    </div>

    @if(isset($reviews) && $reviews->count() > 0)
        <div class="row g-3">
            @foreach($reviews as $review)
                <div class="col-md-6">
                    <div class="se-card-lg p-3 p-md-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="d-flex gap-3">
                                <div class="bg-primary bg-opacity-10 p-2 rounded-2">
                                    <i class="bi bi-building text-primary"></i>
                                </div>
                                <div>
                                    <div class="fw-bold small">{{ $review->booking->room->room_number ?? '-' }}</div>
                                    <div class="text-muted" style="font-family:var(--font-alt);font-size:0.78rem;">{{ $review->booking->room->roomType->name ?? '-' }}</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-1">
                                @for($i=1;$i<=5;$i++)
                                    <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}" style="color:var(--accent);font-size:0.8rem;"></i>
                                @endfor
                            </div>
                        </div>
                        @if($review->review)
                            <p class="text-muted small mb-2" style="font-family:var(--font-alt);">"{{ $review->review }}"</p>
                        @endif
                        <div class="text-muted" style="font-size:0.7rem;">{{ $review->created_at ? $review->created_at->diffForHumans() : '' }}</div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-4">{{ $reviews->links() }}</div>
    @else
        <div class="se-card-lg text-center py-5">
            <i class="bi bi-chat-square-text display-1 text-muted d-block mb-3"></i>
            <h4 class="fw-bold">Belum Ada Ulasan</h4>
            <p class="text-muted mb-4" style="font-family:var(--font-alt);">Anda belum menulis ulasan untuk booking apapun.</p>
            <a href="{{ route('rooms.index') }}" class="btn-se btn-se-primary">
                <i class="bi bi-building me-2"></i> Booking Sekarang
            </a>
        </div>
    @endif
</div>
@endsection