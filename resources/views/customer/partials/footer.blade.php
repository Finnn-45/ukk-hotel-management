@push('footer')
<footer class="se-footer pt-5 pb-3 mt-5">
    <div class="container">
        <div class="row g-4 pb-4">
            <div class="col-lg-4">
                <a href="{{ route('home') }}" class="se-logo mb-3 d-inline-flex">
                    <div class="se-logo-icon" style="background:#fff;color:var(--primary);">SE</div>
                    <span class="se-logo-text" style="color:#fff;">Stay<span style="color:#60A5FA;">Ease</span></span>
                </a>
                <p style="font-size:0.85rem;line-height:1.8;color:#94A3B8;margin-top:16px;max-width:320px;">
                    Your trusted platform for luxury hotel bookings and fine dining experiences. Enjoy seamless reservations with transparent pricing.
                </p>
                <div class="d-flex gap-2 mt-3">
                    <a href="#" class="social-btn"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-btn"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-btn"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="social-btn"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
            <div class="col-6 col-lg-2">
                <h6 class="mb-3">Navigation</h6>
                <a href="{{ route('home') }}" class="se-footer-link">Home</a>
                <a href="{{ route('rooms.index') }}" class="se-footer-link">Rooms</a>
                <a href="{{ route('customer.restaurant.menu') }}" class="se-footer-link">Restaurant</a>
                <a href="{{ route('customer.contact') }}" class="se-footer-link">Contact</a>
            </div>
            <div class="col-6 col-lg-3">
                <h6 class="mb-3">Support</h6>
                <a href="#" class="se-footer-link">Help Center</a>
                <a href="#" class="se-footer-link">FAQ</a>
                <a href="#" class="se-footer-link">Privacy Policy</a>
                <a href="#" class="se-footer-link">Terms & Conditions</a>
            </div>
            <div class="col-lg-3">
                <h6 class="mb-3">Contact</h6>
                <div style="font-size:0.85rem;">
                    <div class="d-flex align-items-start gap-2 mb-2">
                        <i class="bi bi-geo-alt" style="color:#60A5FA;margin-top:2px;"></i>
                        <span>Jakarta, Indonesia</span>
                    </div>
                    <div class="d-flex align-items-start gap-2 mb-2">
                        <i class="bi bi-telephone" style="color:#60A5FA;margin-top:2px;"></i>
                        <span>+62 123 4567 890</span>
                    </div>
                    <div class="d-flex align-items-start gap-2 mb-2">
                        <i class="bi bi-envelope" style="color:#60A5FA;margin-top:2px;"></i>
                        <span>hello@stayease.com</span>
                    </div>
                    <div class="d-flex align-items-start gap-2">
                        <i class="bi bi-clock" style="color:#60A5FA;margin-top:2px;"></i>
                        <span>24/7 Customer Support</span>
                    </div>
                </div>
            </div>
        </div>
        <hr style="border-color:rgba(255,255,255,0.06);margin:0;">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 pt-4" style="font-size:0.8rem;">
            <p class="mb-0">&copy; {{ date('Y') }} StayEase. All rights reserved.</p>
            <div class="d-flex gap-3">
                <a href="#">Privacy</a>
                <a href="#">Terms</a>
                <a href="#">Cookies</a>
            </div>
        </div>
    </div>
</footer>
@endpush
