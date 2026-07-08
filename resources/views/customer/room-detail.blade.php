@extends('customer.layouts.app')

@section('title', 'Detail Kamar - ' . $room->room_number)

@section('content')
<div class="container py-3 py-md-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3 mb-md-4">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none"><i class="bi bi-house"></i> Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('rooms.index') }}" class="text-decoration-none">Kamar</a></li>
            <li class="breadcrumb-item active fw-semibold">{{ $room->room_number }}</li>
        </ol>
    </nav>

    <div class="row g-3 g-lg-4">
        {{-- ===== LEFT COLUMN: Room Gallery & Info ===== --}}
        <div class="col-lg-8">
            {{-- Hero Image Gallery --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-3 mb-lg-4">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?w=800"
                         class="w-100"
                         alt="Room"
                         style="height: 220px; object-fit: cover;"
                         onerror="this.style.display='none'">
                    <div class="position-absolute bottom-0 start-0 end-0 p-3" style="background: linear-gradient(transparent, rgba(0,0,0,0.6));">
                        <span class="badge bg-white text-dark rounded-pill px-3 py-1 shadow-sm">
                            <i class="bi bi-image me-1"></i> 1 / 5
                        </span>
                    </div>
                </div>
                <div class="d-flex gap-2 p-2 bg-light overflow-auto">
                    @foreach([
                        'https://images.unsplash.com/photo-1611892440504-42a792e24d32?w=200',
                        'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=200',
                        'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=200',
                        'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=200',
                        'https://images.unsplash.com/photo-1554995207-c18c203602cb?w=200',
                    ] as $img)
                    <div class="flex-shrink-0 rounded-2 overflow-hidden" style="width: 70px; height: 55px; cursor: pointer;">
                        <img src="{{ $img }}" class="w-100 h-100" style="object-fit: cover;" alt="Thumbnail">
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Room Info Card --}}
            <div class="card border-0 shadow-sm rounded-4 mb-3 mb-lg-4">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex flex-wrap align-items-start justify-content-between gap-2 mb-2">
                        <div>
                            <h4 class="fw-bold mb-1">{{ $room->room_number }} - {{ $room->roomType->name }}</h4>
                            <div class="d-flex align-items-center gap-2">
                                <div class="star-rating text-warning" style="font-size: 0.85rem;">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
                                </div>
                                <span class="text-muted small">4.5 <span class="d-none d-sm-inline">(120 ulasan)</span></span>
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1 small fw-semibold">
                                    <i class="bi bi-check-circle me-1"></i> {{ ucfirst($room->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="text-end">
                            <span class="fs-3 fw-bold text-primary">Rp {{ number_format($room->roomType->price, 0, ',', '.') }}</span>
                            <span class="text-muted small d-block">/malam</span>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="mt-3 p-3 bg-light rounded-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-2">
                                <i class="bi bi-info-circle text-primary"></i>
                            </div>
                            <h6 class="fw-bold mb-0">Deskripsi</h6>
                        </div>
                        <p class="mb-0 text-muted">{{ $room->roomType->description ?? 'Kamar yang nyaman dengan fasilitas lengkap untuk menginap Anda. Nikmati pengalaman menginap terbaik dengan pelayanan prima dari kami.' }}</p>
                    </div>

                    {{-- Facilities --}}
                    <div class="mt-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-2">
                                <i class="bi bi-grid text-primary"></i>
                            </div>
                            <h6 class="fw-bold mb-0">Fasilitas Kamar</h6>
                        </div>
                        <div class="row g-2">
                            @foreach([
                                ['icon' => 'bi-snow', 'label' => 'AC'],
                                ['icon' => 'bi-tv', 'label' => 'TV'],
                                ['icon' => 'bi-wifi', 'label' => 'WiFi'],
                                ['icon' => 'bi-door-open', 'label' => 'Kamar Mandi Dalam'],
                                ['icon' => 'bi-archive', 'label' => 'Lemari'],
                                ['icon' => 'bi-lamp', 'label' => 'Meja Kerja'],
                            ] as $facility)
                            <div class="col-6 col-md-4">
                                <div class="d-flex align-items-center gap-2 p-2 rounded-2 bg-white border">
                                    <i class="bi {{ $facility['icon'] }} text-primary"></i>
                                    <span class="small fw-medium">{{ $facility['label'] }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Room Details Table --}}
                    <div class="mt-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-2">
                                <i class="bi bi-info-square text-primary"></i>
                            </div>
                            <h6 class="fw-bold mb-0">Informasi Kamar</h6>
                        </div>
                        <div class="row g-2">
                            <div class="col-6 col-md-3">
                                <div class="p-3 rounded-3 bg-white border text-center">
                                    <i class="bi bi-layers text-primary fs-4 mb-1 d-block"></i>
                                    <small class="text-muted d-block">Lantai</small>
                                    <span class="fw-bold">{{ $room->floor }}</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="p-3 rounded-3 bg-white border text-center">
                                    <i class="bi bi-people text-primary fs-4 mb-1 d-block"></i>
                                    <small class="text-muted d-block">Max Tamu</small>
                                    <span class="fw-bold">{{ $room->roomType->max_guests }} org</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="p-3 rounded-3 bg-white border text-center">
                                    <i class="bi bi-door-open text-primary fs-4 mb-1 d-block"></i>
                                    <small class="text-muted d-block">Tipe</small>
                                    <span class="fw-bold small">{{ $room->roomType->name ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="p-3 rounded-3 bg-white border text-center">
                                    <i class="bi bi-building text-primary fs-4 mb-1 d-block"></i>
                                    <small class="text-muted d-block">No. Kamar</small>
                                    <span class="fw-bold">{{ $room->room_number }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== RIGHT COLUMN: Booking Card + Similar Rooms + Reviews ===== --}}
        <div class="col-lg-4">
            {{-- Booking Card --}}
            <div class="card border-0 shadow-sm rounded-4 mb-3 sticky-lg-top" style="top: 76px;">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="bg-primary bg-opacity-10 p-2 rounded-2">
                            <i class="bi bi-calendar-check text-primary"></i>
                        </div>
                        <h5 class="fw-bold mb-0">Booking Kamar</h5>
                    </div>
                    <form action="{{ route('customer.booking') }}" method="POST" id="bookingForm">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">
                                <i class="bi bi-calendar"></i> Check In
                            </label>
                            <input type="date" name="check_in" class="form-control rounded-3 border-1 bg-light" min="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">
                                <i class="bi bi-calendar"></i> Check Out
                            </label>
                            <input type="date" name="check_out" class="form-control rounded-3 border-1 bg-light" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                        </div>

                        {{-- Price Breakdown --}}
                        <div class="bg-primary bg-opacity-5 p-3 rounded-3 mb-3" style="background: rgba(255,105,15,0.04);">
                            <div class="d-flex justify-content-between mb-2 small text-muted">
                                <span>Harga/Malam</span>
                                <span class="fw-semibold">Rp {{ number_format($room->roomType->price, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-1 small text-muted">
                                <span>Jumlah Malam</span>
                                <span class="fw-semibold" id="nightsCount">-</span>
                            </div>
                            <hr class="my-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold">Total</span>
                                <span class="fw-bold text-primary fs-5" id="totalPrice">-</span>
                            </div>
                        </div>

                        @auth
                            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold rounded-3 d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-check-circle"></i> Booking Sekarang
                            </button>
                        @else
                            <a href="{{ route('customer.login') }}" class="btn btn-primary w-100 py-2 fw-bold rounded-3 d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-box-arrow-in-right"></i> Login untuk Booking
                            </a>
                        @endauth
                    </form>
                </div>
            </div>

            {{-- Similar Rooms --}}
            @if(isset($otherRooms) && $otherRooms->count() > 0)
            <div class="card border-0 shadow-sm rounded-4 mb-3">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="bg-primary bg-opacity-10 p-2 rounded-2">
                            <i class="bi bi-building text-primary"></i>
                        </div>
                        <h6 class="fw-bold mb-0">Kamar Serupa</h6>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        @foreach($otherRooms as $other)
                        <a href="{{ route('customer.room.detail', $other) }}" class="text-decoration-none">
                            <div class="d-flex align-items-center p-2 rounded-3 border bg-white hover-shadow" style="transition: all 0.2s;">
                                <div class="flex-shrink-0">
                                    <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?w=100"
                                         width="60" height="45"
                                         class="rounded-2" alt="Room"
                                         style="object-fit: cover;">
                                </div>
                                <div class="flex-grow-1 ms-3 min-w-0">
                                    <small class="fw-bold d-block text-dark text-truncate">{{ $other->room_number }} - {{ $other->roomType->name ?? 'Standard' }}</small>
                                    <small class="text-muted">
                                        <i class="bi bi-people me-1"></i>{{ $other->roomType->max_guests ?? '-' }} tamu
                                    </small>
                                    <small class="text-primary fw-bold d-block">Rp {{ number_format($other->roomType->price, 0, ',', '.') }}/malam</small>
                                </div>
                                <div class="flex-shrink-0 ms-1">
                                    <div class="btn btn-sm btn-outline-primary rounded-circle p-1 d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">
                                        <i class="bi bi-chevron-right small"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            {{-- Reviews Section --}}
            <div class="card border-0 shadow-sm rounded-4 mb-3">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="bg-primary bg-opacity-10 p-2 rounded-2">
                            <i class="bi bi-star text-primary"></i>
                        </div>
                        <h5 class="fw-bold mb-0">Ulasan Tamu</h5>
                    </div>

                    {{-- Rating Summary --}}
                    <div class="d-flex align-items-center gap-3 p-3 mb-3 bg-light rounded-3">
                        <div class="text-center">
                            <div class="fs-2 fw-bold text-warning">4.5</div>
                            <div class="star-rating text-warning small">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
                            </div>
                            <small class="text-muted">120 ulasan</small>
                        </div>
                        <div class="flex-grow-1">
                            @foreach([5,4,3,2,1] as $star)
                            <div class="d-flex align-items-center gap-2 small mb-1">
                                <span class="text-muted" style="min-width: 12px;">{{ $star }}</span>
                                <div class="progress flex-grow-1" style="height: 6px;">
                                    <div class="progress-bar bg-warning" style="width: {{ $star == 5 ? 60 : ($star == 4 ? 25 : ($star == 3 ? 10 : ($star == 2 ? 3 : 2))) }}%"></div>
                                </div>
                                <span class="text-muted" style="min-width: 30px;">{{ $star == 5 ? '60%' : ($star == 4 ? '25%' : ($star == 3 ? '10%' : ($star == 2 ? '3%' : '2%'))) }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    @php
                        $roomReviews = \App\Models\Review::where('room_id', $room->id)
                            ->where('is_approved', true)
                            ->with('user')
                            ->latest()
                            ->take(10)
                            ->get();
                    @endphp

                    @if($roomReviews->count() > 0)
                        <div class="d-flex flex-column gap-3">
                            @foreach($roomReviews as $review)
                            <div class="border-bottom pb-3 {{ !$loop->last ? 'mb-1' : '' }}">
                                <div class="d-flex justify-content-between align-items-start mb-1">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center text-primary fw-bold" style="width: 32px; height: 32px; font-size: 0.75rem;">
                                            {{ strtoupper(substr($review->user->name ?? 'A', 0, 1)) }}
                                        </div>
                                        <div>
                                            <strong class="small">{{ $review->user->name ?? 'Anonymous' }}</strong>
                                            <div class="text-warning" style="font-size: 0.7rem;">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $review->rating)
                                                        <i class="bi bi-star-fill"></i>
                                                    @else
                                                        <i class="bi bi-star"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <small class="text-muted" style="font-size: 0.65rem;">{{ $review->created_at->diffForHumans() }}</small>
                                </div>
                                @if($review->review)
                                    <p class="mt-1 mb-0 text-muted small ms-0" style="padding-left: 42px;">{{ $review->review }}</p>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-chat-square-text text-muted fs-1 d-block mb-2"></i>
                            <p class="text-muted small mb-0">Belum ada ulasan untuk kamar ini</p>
                            <p class="text-muted small">Jadilah yang pertama memberikan ulasan!</p>
                        </div>
                    @endif

                    {{-- Review Form for users who have booked --}}
                    @auth
                        @php
                            $userBookings = auth()->user()->bookings()
                                ->where('room_id', $room->id)
                                ->whereIn('status', ['checked_out', 'completed'])
                                ->whereHas('review', function($q) {
                                    $q->where('user_id', auth()->id());
                                }, '<', 1)
                                ->first();
                        @endphp

                        @if($userBookings)
                        <div class="mt-4 p-3 bg-light rounded-3">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <i class="bi bi-pencil-square text-primary"></i>
                                <h6 class="fw-bold mb-0">Tulis Ulasan</h6>
                            </div>
                            <form action="{{ route('customer.review.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="booking_id" value="{{ $userBookings->id }}">
                                
                                <div class="mb-3">
                                    <label class="form-label small fw-semibold">Rating Anda</label>
                                    <div class="star-rating d-flex flex-row-reverse justify-content-end gap-1">
                                        @for($i = 5; $i >= 1; $i--)
                                            <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}" class="d-none" required>
                                            <label for="star{{ $i }}" class="star-label" style="font-size: 1.5rem; color: #ddd; cursor: pointer; transition: color 0.15s;">
                                                <i class="bi bi-star-fill"></i>
                                            </label>
                                        @endfor
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-semibold">Ulasan <span class="text-muted fw-normal">(opsional)</span></label>
                                    <textarea name="review" class="form-control border-1 bg-white rounded-3" rows="3" placeholder="Bagikan pengalaman menginap Anda..." style="resize: none;"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold rounded-3 d-flex align-items-center justify-content-center gap-2">
                                    <i class="bi bi-send"></i> Kirim Ulasan
                                </button>
                            </form>
                        </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Price Calculator Script --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkIn = document.querySelector('input[name="check_in"]');
        const checkOut = document.querySelector('input[name="check_out"]');
        const totalEl = document.getElementById('totalPrice');
        const nightsEl = document.getElementById('nightsCount');
        const pricePerNight = {{ $room->roomType->price }};
        const submitBtn = document.querySelector('#bookingForm button[type="submit"]');

        function formatRupiah(num) {
            return 'Rp ' + num.toLocaleString('id-ID');
        }

        function calculateTotal() {
            if (checkIn.value && checkOut.value) {
                const start = new Date(checkIn.value);
                const end = new Date(checkOut.value);
                const diffTime = Math.abs(end - start);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                
                if (diffDays > 0) {
                    const total = pricePerNight * diffDays;
                    totalEl.textContent = formatRupiah(total);
                    nightsEl.textContent = diffDays + ' malam';
                    if (submitBtn) submitBtn.disabled = false;
                } else {
                    totalEl.textContent = '-';
                    nightsEl.textContent = '-';
                    if (submitBtn) submitBtn.disabled = true;
                }
            } else {
                totalEl.textContent = '-';
                nightsEl.textContent = '-';
                if (submitBtn) submitBtn.disabled = true;
            }
        }

        // Set min dates
        const today = new Date().toISOString().split('T')[0];
        if (checkIn) checkIn.min = today;
        
        if (checkIn && checkOut) {
            checkIn.addEventListener('change', function() {
                const nextDay = new Date(this.value);
                nextDay.setDate(nextDay.getDate() + 1);
                checkOut.min = nextDay.toISOString().split('T')[0];
                if (checkOut.value && new Date(checkOut.value) <= new Date(this.value)) {
                    checkOut.value = '';
                }
                calculateTotal();
            });
            
            checkOut.addEventListener('change', calculateTotal);
        }

        // Star rating hover interaction
        document.querySelectorAll('.star-label').forEach(label => {
            label.addEventListener('click', function() {
                const rating = this.getAttribute('for').replace('star', '');
                document.querySelectorAll('.star-label').forEach((l, index) => {
                    const starIndex = 5 - parseInt(rating);
                    l.style.color = (index >= starIndex) ? '#f59e0b' : '#ddd';
                });
            });

            label.addEventListener('mouseenter', function() {
                const rating = this.getAttribute('for').replace('star', '');
                document.querySelectorAll('.star-label').forEach((l, index) => {
                    const starIndex = 5 - parseInt(rating);
                    l.style.color = (index >= starIndex) ? '#f59e0b' : '#ddd';
                });
            });

            label.addEventListener('mouseleave', function() {
                const checked = document.querySelector('.star-rating input[name="rating"]:checked');
                if (!checked) {
                    document.querySelectorAll('.star-label').forEach(l => l.style.color = '#ddd');
                }
            });
        });
    });
</script>
@endpush
@endsection