@extends('customer.layouts.app')

@section('title', 'Notifikasi - StayEase')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb" class="se-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Notifikasi</li>
        </ol>
    </nav>

    <div class="d-flex align-items-center gap-3 mb-4">
        <div class="bg-primary bg-opacity-10 p-3 rounded-2">
            <i class="bi bi-bell text-primary fs-4"></i>
        </div>
        <div>
            <h3 class="fw-bold mb-1">Notifikasi</h3>
            <p class="text-muted small mb-0" style="font-family:var(--font-alt);">Pemberitahuan dan informasi terbaru</p>
        </div>
    </div>

    @if(isset($notifications) && $notifications->count() > 0)
        <div class="d-flex flex-column gap-2">
            @foreach($notifications as $notif)
                <div class="se-card-lg p-3 d-flex align-items-start gap-3">
                    <div class="bg-primary bg-opacity-10 p-2 rounded-2 flex-shrink-0">
                        <i class="bi bi-bell text-primary"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-semibold small">{{ $notif->title ?? 'Notifikasi' }}</div>
                        <div class="text-muted" style="font-family:var(--font-alt);font-size:0.82rem;">{{ $notif->message ?? $notif->description ?? '-' }}</div>
                        <div class="text-muted mt-1" style="font-size:0.7rem;">{{ $notif->created_at ? $notif->created_at->diffForHumans() : '' }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="se-card-lg text-center py-5">
            <i class="bi bi-bell-slash display-1 text-muted d-block mb-3"></i>
            <h4 class="fw-bold">Tidak Ada Notifikasi</h4>
            <p class="text-muted" style="font-family:var(--font-alt);">Anda akan mendapat notifikasi saat ada aktivitas booking atau promo terbaru.</p>
        </div>
    @endif
</div>
@endsection