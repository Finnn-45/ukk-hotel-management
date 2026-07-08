@extends('customer.layouts.app')

@section('title', 'Galeri Hotel')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Galeri</li>
        </ol>
    </nav>

    <div class="text-center mb-5">
        <h2 class="fw-bold">Galeri Hotel</h2>
        <p class="text-muted">Jelajahi fasilitas dan kamar mewah kami</p>
    </div>

    @php
        $galleries = \App\Models\LandingPageGallery::orderBy('order')->get();
        $categories = $galleries->pluck('category')->unique()->filter();
    @endphp

    @if($categories->count() > 0)
    <div class="d-flex gap-2 mb-4 justify-content-center flex-wrap">
        <button class="btn btn-primary filter-btn active" data-filter="all">Semua</button>
        @foreach($categories as $category)
            <button class="btn btn-outline-primary filter-btn" data-filter="{{ $category }}">
                {{ ucfirst($category) }}
            </button>
        @endforeach
    </div>
    @endif

    @if($galleries->count() > 0)
        <div class="row g-3 gallery-grid">
            @foreach($galleries as $gallery)
                <div class="col-md-6 col-lg-4 gallery-item" data-category="{{ $gallery->category }}">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="{{ asset('storage/' . $gallery->image) }}" 
                             class="card-img-top" 
                             alt="{{ $gallery->title }}"
                             style="height: 250px; object-fit: cover;"
                             onerror="this.src='https://images.unsplash.com/photo-1566073771259-6a8506099945?w=600&q=80'">
                        <div class="card-body">
                            <h6 class="fw-bold mb-0">{{ $gallery->title }}</h6>
                            @if($gallery->category)
                                <small class="text-muted">{{ ucfirst($gallery->category) }}</small>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-images display-1 text-muted"></i>
            <p class="text-muted mt-3">Galeri akan segera ditambahkan</p>
        </div>
    @endif
</div>

@push('styles')
<style>
    .gallery-item {
        transition: all 0.3s ease;
    }
    .gallery-item.hide {
        display: none;
    }
    .gallery-item.show {
        animation: fadeIn 0.5s ease;
    }
    .filter-btn {
        transition: all 0.2s ease;
    }
    .filter-btn.active {
        background: #0d6efd;
        color: white;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterBtns = document.querySelectorAll('.filter-btn');
        const galleryItems = document.querySelectorAll('.gallery-item');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const filter = this.getAttribute('data-filter');

                galleryItems.forEach(item => {
                    if (filter === 'all' || item.getAttribute('data-category') === filter) {
                        item.classList.remove('hide');
                        item.classList.add('show');
                    } else {
                        item.classList.add('hide');
                        item.classList.remove('show');
                    }
                });
            });
        });
    });
</script>
@endpush
@endsection