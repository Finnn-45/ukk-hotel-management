@extends('customer.layouts.app')

@section('title', 'Cari Hotel - StayEase')

@push('styles')
<style>
    /* ─── Filter Sidebar ─── */
    .se-filter-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        overflow: hidden;
        position: sticky;
        top: calc(var(--nav-height) + 80px);
    }
    .se-filter-header {
        background: var(--primary-gradient);
        padding: 16px 20px;
    }
    .se-filter-header h5 { color: #fff; font-weight: 700; margin: 0; font-size: 0.95rem; }
    .se-filter-section {
        padding: 18px 20px;
        border-bottom: 1px solid var(--border);
    }
    .se-filter-section:last-child { border-bottom: none; }
    .se-filter-title {
        font-weight: 700;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text);
        margin-bottom: 12px;
    }
    .se-filter-section .form-check-label {
        font-family: var(--font-alt);
        font-size: 0.85rem;
        color: var(--text);
        cursor: pointer;
    }
    .se-filter-section .form-check-input:checked {
        background-color: var(--primary);
        border-color: var(--primary);
    }
    .se-filter-section .form-control, .se-filter-section .form-select {
        border-radius: 10px;
        font-size: 0.85rem;
        border: 1.5px solid var(--border);
        font-family: var(--font-alt);
    }
    .se-filter-section .form-control:focus, .se-filter-section .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(2,132,199,0.1);
    }
    .btn-filter-apply {
        background: var(--primary-gradient);
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 11px;
        font-weight: 700;
        font-size: 0.85rem;
        width: 100%;
        transition: all 0.2s;
        font-family: var(--font-alt);
    }
    .btn-filter-apply:hover { transform: translateY(-1px); box-shadow: 0 4px 14px rgba(2,132,199,0.3); }
    .btn-filter-reset {
        background: var(--bg);
        color: var(--text-muted);
        border: 1.5px solid var(--border);
        border-radius: 12px;
        padding: 9px;
        font-weight: 600;
        font-size: 0.85rem;
        width: 100%;
        transition: all 0.2s;
        font-family: var(--font-alt);
        text-decoration: none;
        display: block;
        text-align: center;
    }
    .btn-filter-reset:hover { background: var(--border); }

    /* ─── Results ─── */
    .se-results-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
        flex-wrap: wrap;
        gap: 10px;
    }
    .se-results-count {
        font-weight: 700;
        font-size: 1.1rem;
        color: var(--text);
    }
    .se-results-count span { color: var(--primary); }
    .se-sort-select {
        border: 1.5px solid var(--border);
        border-radius: 12px;
        font-size: 0.82rem;
        padding: 8px 14px;
        font-weight: 500;
        font-family: var(--font-alt);
    }
    .se-sort-select:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(2,132,199,0.1); }

    /* ─── Hotel Card ─── */
    .se-hotel-list-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        overflow: hidden;
        display: flex;
        transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
        margin-bottom: 16px;
        min-height: 200px;
    }
    .se-hotel-list-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 32px rgba(0,0,0,0.08);
        border-color: transparent;
    }
    .se-hotel-list-img {
        flex: 0 0 260px;
        max-width: 260px;
        position: relative;
        overflow: hidden;
        min-height: 220px;
    }
    .se-hotel-list-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .se-hotel-list-card:hover .se-hotel-list-img img { transform: scale(1.05); }
    .se-hotel-list-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(255,255,255,0.9);
        backdrop-filter: blur(8px);
        padding: 4px 10px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 700;
        font-family: var(--font-alt);
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .se-hotel-list-floor {
        position: absolute;
        bottom: 12px;
        left: 12px;
        background: rgba(0,0,0,0.5);
        backdrop-filter: blur(8px);
        color: #fff;
        padding: 4px 10px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 600;
        font-family: var(--font-alt);
    }

    .se-hotel-list-info {
        flex: 1;
        padding: 20px 20px 20px 24px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-width: 0;
    }
    .se-hotel-list-name {
        font-weight: 700;
        font-size: 1.05rem;
        color: var(--text);
        margin-bottom: 3px;
    }
    .se-hotel-list-type {
        font-family: var(--font-alt);
        font-size: 0.8rem;
        color: var(--text-muted);
        margin-bottom: 10px;
    }
    .se-hotel-list-rating {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 10px;
    }
    .se-hotel-list-rating .score {
        background: var(--primary-gradient);
        color: #fff;
        font-weight: 800;
        font-size: 0.85rem;
        padding: 5px 9px;
        border-radius: 8px 8px 8px 0;
        line-height: 1;
    }
    .se-hotel-list-rating .label { font-weight: 700; font-size: 0.82rem; color: var(--text); }
    .se-hotel-list-rating .count { font-family: var(--font-alt); font-size: 0.75rem; color: var(--text-muted); }

    .se-hotel-list-stars { margin-bottom: 10px; }
    .se-hotel-list-stars i { color: var(--accent); font-size: 0.75rem; }

    .se-hotel-list-amenities {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }
    .se-hotel-list-amenities span {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 4px 10px;
        font-family: var(--font-alt);
        font-size: 0.72rem;
        color: var(--text-muted);
    }

    .se-hotel-list-price {
        flex: 0 0 220px;
        max-width: 220px;
        padding: 20px;
        border-left: 1px solid var(--border);
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        justify-content: center;
        gap: 12px;
        background: #FAFBFC;
        text-align: right;
    }
    .se-hotel-list-tag {
        font-size: 0.7rem;
        font-weight: 700;
        color: #16A34A;
        background: #DCFCE7;
        border: 1px solid #BBF7D0;
        border-radius: 50px;
        padding: 3px 10px;
        text-align: right;
    }
    .se-hotel-list-price-group { text-align: right; }
    .se-hotel-list-price-label {
        font-family: var(--font-alt);
        font-size: 0.72rem;
        color: var(--text-muted);
        margin-bottom: 2px;
    }
    .se-hotel-list-price-main {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--primary);
        line-height: 1;
    }
    .se-hotel-list-price-sub {
        font-family: var(--font-alt);
        font-size: 0.72rem;
        color: var(--text-muted);
        margin-top: 2px;
    }
    .btn-se-hotel-book {
        background: var(--primary-gradient);
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 11px 18px;
        font-weight: 700;
        font-size: 0.85rem;
        width: 100%;
        text-align: center;
        transition: all 0.2s;
        text-decoration: none;
        display: block;
        font-family: var(--font-alt);
        box-shadow: 0 4px 14px rgba(2,132,199,0.25);
    }
    .btn-se-hotel-book:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(2,132,199,0.35);
        color: #fff;
    }

    /* ─── Empty State ─── */
    .se-empty-state {
        background: #fff;
        border-radius: var(--radius);
        border: 1px solid var(--border);
        padding: 60px 40px;
        text-align: center;
    }

    /* ─── Responsive ─── */
    @media (max-width: 991.98px) {
        .se-search-header { position: static !important; box-shadow: none !important; }
    }
    @media (max-width: 768px) {
        .se-hotel-list-card { 
            flex-direction: column; 
            margin-bottom: 20px;
        }
        .se-hotel-list-img { 
            flex: none; 
            max-width: 100%; 
            height: 220px; 
            min-height: 220px;
        }
        .se-hotel-list-info { 
            padding: 16px; 
        }
        .se-hotel-list-price {
            flex: none;
            max-width: 100%;
            border-left: none;
            border-top: 1px solid var(--border);
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            gap: 12px;
        }
        .se-hotel-list-price-group { text-align: left; }
        .se-hotel-list-tag { display: none; }
        .btn-se-hotel-book {
            width: auto;
            padding: 10px 20px;
            white-space: nowrap;
        }
        .se-hotel-list-price-main {
            font-size: 1.25rem;
        }
    }

    @media (max-width: 576px) {
        .se-hotel-list-img { 
            height: 180px; 
            min-height: 180px;
        }
        .se-hotel-list-info { 
            padding: 12px; 
        }
        .se-hotel-list-price {
            padding: 12px 16px;
            flex-wrap: wrap;
        }
        .se-hotel-list-price-group {
            flex: 1;
            min-width: 0;
        }
        .btn-se-hotel-book {
            width: 100%;
            justify-content: center;
        }
    }

    /* Mobile filter toggle */
    .se-mobile-filter-btn {
        display: none;
        background: #fff;
        border: 1.5px solid var(--border);
        border-radius: 12px;
        padding: 10px 18px;
        font-family: var(--font-alt);
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text);
        align-items: center;
        gap: 8px;
    }
    @media (max-width: 991px) {
        .se-mobile-filter-btn { display: inline-flex; }
    }
</style>
@endpush

@section('content')
{{-- ─── MAIN CONTENT ─── --}}
<div class="container py-4 mt-3">
    <div class="row g-4">
        {{-- Sidebar Filters (Desktop) --}}
        <div class="col-lg-3 d-none d-lg-block">
            <div class="se-filter-card">
                <div class="se-filter-header">
                    <h5><i class="bi bi-sliders me-2"></i>Filter</h5>
                </div>

                <form method="GET" action="{{ route('rooms.index') }}">
                    @if(request('sort'))
                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                    @endif
                    {{-- Room Type --}}
                    <div class="se-filter-section">
                        <div class="se-filter-title">Tipe Kamar</div>
                        @foreach($roomTypes as $type)
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="room_type" id="ft_{{ $type->id }}" value="{{ $type->id }}" {{ request('room_type') == $type->id ? 'checked' : '' }}>
                                <label class="form-check-label" for="ft_{{ $type->id }}">
                                    {{ $type->name }}
                                    <span class="text-muted" style="font-size:0.72rem;">({{ $type->rooms_count }} kmr)</span>
                                </label>
                            </div>
                        @endforeach
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="room_type" id="ft_all" value="" {{ !request('room_type') ? 'checked' : '' }}>
                            <label class="form-check-label" for="ft_all">Semua Tipe</label>
                        </div>
                    </div>

                    {{-- Price Range --}}
                    <div class="se-filter-section">
                        <div class="se-filter-title">Harga / Malam</div>
                        <div class="row g-2">
                            <div class="col-6">
                                <label style="font-size:0.72rem;color:var(--text-muted);">Min</label>
                                <input type="number" name="min_price" class="form-control form-control-sm" placeholder="Rp 0" value="{{ request('min_price') }}" min="0">
                            </div>
                            <div class="col-6">
                                <label style="font-size:0.72rem;color:var(--text-muted);">Max</label>
                                <input type="number" name="max_price" class="form-control form-control-sm" placeholder="Rp ∞" value="{{ request('max_price') }}" min="0">
                            </div>
                        </div>
                    </div>

                    {{-- Facilities --}}
                    <div class="se-filter-section">
                        <div class="se-filter-title">Fasilitas</div>
                        @php $facs = [['bi-wifi','WiFi'],['bi-snow','AC'],['bi-tv','TV'],['bi-cup-hot','Sarapan'],['bi-p-square','Parkir']]; @endphp
                        @foreach($facs as $f)
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="fac_{{ $loop->index }}" disabled>
                                <label class="form-check-label" for="fac_{{ $loop->index }}">
                                    <i class="bi {{ $f[0] }} me-1"></i> {{ $f[1] }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    {{-- Floor --}}
                    <div class="se-filter-section">
                        <div class="se-filter-title">Lantai</div>
                        <input type="number" name="floor" class="form-control form-control-sm" placeholder="Nomor lantai" value="{{ request('floor') }}" min="1">
                    </div>

                    {{-- Actions --}}
                    <div class="se-filter-section">
                        <button type="submit" class="btn-filter-apply mb-2"><i class="bi bi-funnel-fill me-1"></i> Terapkan</button>
                        <a href="{{ route('rooms.index') }}" class="btn-filter-reset"><i class="bi bi-arrow-counterclockwise me-1"></i> Reset</a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Room Listings --}}
        <div class="col-lg-9">
            {{-- Mobile filter button --}}
            <div class="d-flex d-lg-none align-items-center gap-2 mb-3">
                <button class="se-mobile-filter-btn" onclick="document.getElementById('mobileFilterCard')?.classList.toggle('d-none')">
                    <i class="bi bi-sliders"></i> Filter
                </button>
                <div id="mobileFilterCard" class="se-filter-card d-none" style="position:fixed;top:60px;left:0;right:0;bottom:0;z-index:1000;overflow-y:auto;border-radius:0;background:#fff;width:100%;">
                    @include('customer._mobile_filters')
                </div>
            </div>

            {{-- Results Header --}}
            <div class="se-results-header">
                <div>
                    <span class="se-results-count"><span>{{ $rooms->total() }}</span> Kamar Ditemukan</span>
                    @if(request()->hasAny(['room_type', 'min_price', 'max_price', 'floor']))
                        <span class="se-badge se-badge-warning ms-2">Filter Aktif</span>
                    @endif
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="text-muted" style="font-size:0.8rem;font-family:var(--font-alt);">Urutkan:</span>
                    <select class="se-sort-select form-select form-select-sm" style="width:auto;">
                        <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                        <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                        <option value="rating_desc" {{ request('sort') === 'rating_desc' ? 'selected' : '' }}>Rating Terbaik</option>
                    </select>
                </div>
            </div>

            {{-- Cards --}}
            @forelse($rooms as $room)
                @php
                    $scores = [8.5, 8.7, 8.9, 9.0, 9.1, 9.2, 7.9, 8.3, 8.8];
                    $score = $scores[$room->id % count($scores)];
                    $labels = [9.0 => 'Luar Biasa', 8.5 => 'Sangat Baik', 8.0 => 'Baik', 7.5 => 'Cukup Baik'];
                    $rlabel = 'Baik';
                    foreach($labels as $t => $l) { if($score >= $t) { $rlabel = $l; break; } }
                    $rcount = (($room->id * 37 + 120) % 400) + 80;
                    $imgs = [
                        'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=500&q=80',
                        'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=500&q=80',
                        'https://images.unsplash.com/photo-1611892440504-42a792e24d32?w=500&q=80',
                        'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=500&q=80',
                        'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=500&q=80',
                        'https://images.unsplash.com/photo-1578683010236-d716f9a3f461?w=500&q=80',
                    ];
                    $img = $imgs[$room->id % count($imgs)];
                    $allAms = [
                        ['icon' => 'bi-wifi', 'label' => 'WiFi'],
                        ['icon' => 'bi-snow', 'label' => 'AC'],
                        ['icon' => 'bi-tv', 'label' => 'TV'],
                        ['icon' => 'bi-water', 'label' => 'Shower'],
                        ['icon' => 'bi-cup-hot', 'label' => 'Sarapan'],
                    ];
                    $roomAms = array_slice($allAms, 0, 3 + ($room->id % 3));
                    $tags = ['Pembatalan Gratis', 'Bayar di Hotel', 'Harga Terbaik', 'Penawaran Terbatas'];
                    $tag = $tags[$room->id % count($tags)];
                @endphp

                <div class="se-hotel-list-card">
                    {{-- Image --}}
                    <div class="se-hotel-list-img">
                        <img src="{{ $img }}" alt="Kamar {{ $room->room_number }}" loading="lazy">
                        <span class="se-hotel-list-badge"><i class="bi bi-check-circle-fill text-success"></i> Tersedia</span>
                        <span class="se-hotel-list-floor"><i class="bi bi-building me-1"></i>Lt {{ $room->floor }}</span>
                    </div>

                    {{-- Info --}}
                    <div class="se-hotel-list-info">
                        <div>
                            <div class="se-hotel-list-name">{{ $room->room_number }}</div>
                            <div class="se-hotel-list-type"><i class="bi bi-tag me-1"></i>{{ $room->roomType->name }}</div>
                            <div class="se-hotel-list-rating">
                                <span class="score">{{ number_format($score, 1) }}</span>
                                <div>
                                    <div class="label">{{ $rlabel }}</div>
                                    <div class="count">{{ $rcount }} ulasan</div>
                                </div>
                            </div>
                            <div class="se-hotel-list-stars">
                                @for($s=1;$s<=5;$s++)
                                    @if($s <= 4)<i class="bi bi-star-fill"></i>@else<i class="bi bi-star-half"></i>@endif
                                @endfor
                            </div>
                        </div>
                        <div class="se-hotel-list-amenities">
                            @foreach($roomAms as $am)
                                <span><i class="bi {{ $am['icon'] }}"></i> {{ $am['label'] }}</span>
                            @endforeach
                            <span><i class="bi bi-people"></i> Max {{ $room->roomType->max_guests }}</span>
                        </div>
                    </div>

                    {{-- Price & CTA --}}
                    <div class="se-hotel-list-price">
                        <span class="se-hotel-list-tag"><i class="bi bi-check-circle-fill me-1"></i>{{ $tag }}</span>
                        <div class="se-hotel-list-price-group">
                            <div class="se-hotel-list-price-label">Mulai</div>
                            <div class="se-hotel-list-price-main">Rp {{ number_format($room->roomType->price, 0, ',', '.') }}</div>
                            <div class="se-hotel-list-price-sub">per malam</div>
                        </div>
                        <a href="{{ route('customer.room.detail', $room) }}" class="btn-se-hotel-book">
                            Lihat Detail <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="se-empty-state">
                    <i class="bi bi-building-x display-1 text-muted d-block mb-4"></i>
                    <h4 class="fw-bold">Tidak Ada Kamar</h4>
                    <p class="text-muted mb-4" style="font-family:var(--font-alt);">Coba ubah atau hapus filter pencarian Anda.</p>
                    <a href="{{ route('rooms.index') }}" class="btn-se btn-se-primary">
                        <i class="bi bi-arrow-counterclockwise me-2"></i>Reset Pencarian
                    </a>
                </div>
            @endforelse

            {{-- Pagination --}}
            @if($rooms->hasPages())
                <div class="mt-4 d-flex justify-content-center">
                    <nav>
                        <ul class="se-pagination">
                            @if($rooms->onFirstPage())
                                <li class="disabled"><span>←</span></li>
                            @else
                                <li><a href="{{ $rooms->previousPageUrl() . (request()->except('page') ? '&' . http_build_query(request()->except('page')) : '') }}">←</a></li>
                            @endif

                            @foreach($rooms->getUrlRange(1, $rooms->lastPage()) as $page => $url)
                                @php
                                    $pageUrl = $url;
                                    if (request()->hasAny(['room_type','min_price','max_price','floor'])) {
                                        $pageUrl .= '&' . http_build_query(request()->except('page'));
                                    }
                                @endphp
                                <li class="{{ $page == $rooms->currentPage() ? 'active' : '' }}">
                                    @if($page == $rooms->currentPage())
                                        <span>{{ $page }}</span>
                                    @else
                                        <a href="{{ $pageUrl }}">{{ $page }}</a>
                                    @endif
                                </li>
                            @endforeach

                            @if($rooms->hasMorePages())
                                <li><a href="{{ $rooms->nextPageUrl() . (request()->except('page') ? '&' . http_build_query(request()->except('page')) : '') }}">→</a></li>
                            @else
                                <li class="disabled"><span>→</span></li>
                            @endif
                        </ul>
                    </nav>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.querySelector('.se-sort-select')?.addEventListener('change', function(e) {
        const url = new URL(window.location.href);
        url.searchParams.set('sort', e.target.value);
        // Reset page when sorting changes
        url.searchParams.delete('page');
        window.location.href = url.toString();
    });
</script>
@endpush
@endsection