@extends('customer.layouts.app')

@section('title', 'Wishlist - StayEase')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb" class="se-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Wishlist</li>
        </ol>
    </nav>

    <div class="d-flex align-items-center gap-3 mb-4">
        <div class="bg-primary bg-opacity-10 p-3 rounded-2">
            <i class="bi bi-heart text-primary fs-4"></i>
        </div>
        <div>
            <h3 class="fw-bold mb-1">Wishlist</h3>
            <p class="text-muted small mb-0" style="font-family:var(--font-alt);">Hotel dan restoran favorit Anda</p>
        </div>
    </div>

    <div class="se-card-lg text-center py-5">
        <div class="py-4">
            <i class="bi bi-heart display-1 text-muted d-block mb-3"></i>
            <h4 class="fw-bold">Wishlist Kosong</h4>
            <p class="text-muted mb-4" style="font-family:var(--font-alt);">Tambahkan hotel atau restoran favorit Anda ke wishlist.</p>
            <div class="d-flex gap-2 justify-content-center">
                <a href="{{ route('rooms.index') }}" class="btn-se btn-se-primary">
                    <i class="bi bi-building me-2"></i> Jelajahi Hotel
                </a>
                <a href="{{ route('customer.restaurant.menu') }}" class="btn-se btn-se-outline">
                    <i class="bi bi-cup-hot me-2"></i> Lihat Restoran
                </a>
            </div>
        </div>
    </div>
</div>
@endsection