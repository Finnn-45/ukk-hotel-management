@extends('customer.layouts.app')

@section('title', 'Berikan Review - StayEase')

@push('styles')
<style>
    .review-section {
        padding: 60px 0;
        background: #F8FAFC;
        min-height: 60vh;
    }
    .review-card {
        background: #fff;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        border: 1px solid #E2E8F0;
        max-width: 700px;
        margin: 0 auto;
    }
    .review-header {
        text-align: center;
        margin-bottom: 30px;
    }
    .review-header h2 {
        font-size: 1.75rem;
        font-weight: 800;
        color: #0F172A;
        margin-bottom: 8px;
    }
    .review-header p {
        color: #64748B;
    }
    .booking-info {
        background: #F0F9FF;
        border: 1px solid #BAE6FD;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 24px;
    }
    .booking-info-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
    }
    .booking-info-row:last-child {
        margin-bottom: 0;
    }
    .booking-info-label {
        color: #64748B;
        font-size: 0.9rem;
    }
    .booking-info-value {
        font-weight: 600;
        color: #0F172A;
    }
    .rating-section {
        text-align: center;
        margin-bottom: 24px;
    }
    .rating-section label {
        display: block;
        font-size: 1rem;
        font-weight: 600;
        color: #0F172A;
        margin-bottom: 12px;
    }
    .star-rating {
        display: flex;
        justify-content: center;
        gap: 8px;
        font-size: 2.5rem;
        cursor: pointer;
    }
    .star-rating .star {
        color: #CBD5E1;
        transition: all 0.2s;
    }
    .star-rating .star:hover,
    .star-rating .star.active {
        color: #FBBF24;
        transform: scale(1.1);
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        font-size: 0.9rem;
        font-weight: 600;
        color: #0F172A;
        margin-bottom: 8px;
    }
    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 1.5px solid #E2E8F0;
        border-radius: 12px;
        font-size: 0.95rem;
        font-family: inherit;
        transition: all 0.2s;
    }
    .form-control:focus {
        outline: none;
        border-color: #0284C7;
        box-shadow: 0 0 0 4px rgba(2,132,199,0.08);
    }
    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }
    .btn-submit {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, #0284C7, #0369A1);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(2,132,199,0.3);
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(2,132,199,0.4);
    }
    .btn-submit:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }
    .thank-you-message {
        text-align: center;
        padding: 40px 20px;
    }
    .thank-you-message .icon {
        font-size: 4rem;
        margin-bottom: 20px;
    }
    .thank-you-message h3 {
        font-size: 1.5rem;
        font-weight: 800;
        color: #0F172A;
        margin-bottom: 12px;
    }
    .thank-you-message p {
        color: #64748B;
        margin-bottom: 24px;
    }
</style>
@endpush

@section('content')
<div class="review-section">
    <div class="container">
        <div class="review-card">
            <div class="review-header">
                <h2>⭐ Berikan Review Anda</h2>
                <p>Bagikan pengalaman Anda menginap di hotel kami</p>
            </div>

            @if(session('success'))
                <div class="thank-you-message">
                    <div class="icon">🎉</div>
                    <h3>Terima Kasih!</h3>
                    <p>{{ session('success') }}</p>
                    <a href="{{ route('customer.bookings') }}" class="btn btn-primary">
                        <i class="bi bi-arrow-left"></i> Kembali ke Booking Saya
                    </a>
                </div>
            @else
                <div class="booking-info">
                    <div class="booking-info-row">
                        <span class="booking-info-label">No. Booking:</span>
                        <span class="booking-info-value">#{{ $booking->id }}</span>
                    </div>
                    <div class="booking-info-row">
                        <span class="booking-info-label">Kamar:</span>
                        <span class="booking-info-value">{{ $booking->room->room_number }} - {{ $booking->room->roomType->name }}</span>
                    </div>
                    <div class="booking-info-row">
                        <span class="booking-info-label">Check-in:</span>
                        <span class="booking-info-value">{{ \Carbon\Carbon::parse($booking->check_in)->format('d/m/Y') }}</span>
                    </div>
                    <div class="booking-info-row">
                        <span class="booking-info-label">Check-out:</span>
                        <span class="booking-info-value">{{ \Carbon\Carbon::parse($booking->check_out)->format('d/m/Y') }}</span>
                    </div>
                </div>

                <form method="POST" action="{{ route('customer.review.store') }}" id="reviewForm">
                    @csrf
                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                    <div class="rating-section">
                        <label>Rating Anda:</label>
                        <div class="star-rating" id="starRating">
                            <span class="star" data-rating="1">⭐</span>
                            <span class="star" data-rating="2">⭐</span>
                            <span class="star" data-rating="3">⭐</span>
                            <span class="star" data-rating="4">⭐</span>
                            <span class="star" data-rating="5">⭐</span>
                        </div>
                        <input type="hidden" name="rating" id="ratingValue" value="0" required>
                        <p class="text-muted mt-2" id="ratingText">Klik bintang untuk memberikan rating</p>
                    </div>

                    <div class="form-group">
                        <label for="review">Ulasan Anda (Opsional)</label>
                        <textarea class="form-control" id="review" name="review" placeholder="Ceritakan pengalaman Anda menginap di hotel kami...">{{ old('review') }}</textarea>
                        @error('review')
                            <div class="text-danger mt-1" style="font-size: 0.85rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn-submit" id="submitBtn" disabled>
                        <i class="bi bi-send-fill"></i> Kirim Review
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>

<script>
const stars = document.querySelectorAll('.star');
const ratingValue = document.getElementById('ratingValue');
const ratingText = document.getElementById('ratingText');
const submitBtn = document.getElementById('submitBtn');
const ratingLabels = ['', 'Buruk', 'Cukup', 'Baik', 'Sangat Baik', 'Luar Biasa'];

stars.forEach(star => {
    star.addEventListener('click', function() {
        const rating = this.dataset.rating;
        ratingValue.value = rating;

        // Update star display
        stars.forEach(s => {
            if (s.dataset.rating <= rating) {
                s.classList.add('active');
            } else {
                s.classList.remove('active');
            }
        });

        // Update text
        ratingText.textContent = ratingLabels[rating];

        // Enable submit button
        submitBtn.disabled = false;
    });
});
</script>
@endsection
