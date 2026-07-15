@extends('customer.layouts.app')

@section('title', 'Hubungi Kami - StayEase')

@push('styles')
<style>
    /* ─── Page Hero ─── */
    .page-hero {
        background: linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #0369A1 100%);
        padding: 80px 0 60px;
        position: relative;
        overflow: hidden;
    }
    .page-hero::before {
        content: '';
        position: absolute;
        width: 500px; height: 500px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(2,132,199,0.15) 0%, transparent 70%);
        top: -150px; right: -100px;
    }
    .page-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.15);
        color: rgba(255,255,255,0.8);
        padding: 6px 18px;
        border-radius: 100px;
        font-size: 0.8rem;
        font-weight: 500;
        margin-bottom: 20px;
        letter-spacing: 0.3px;
    }
    .page-hero h1 {
        font-size: 2.8rem;
        font-weight: 800;
        color: #fff;
        margin-bottom: 12px;
        letter-spacing: -0.5px;
    }
    .page-hero p {
        color: rgba(255,255,255,0.65);
        font-size: 1.05rem;
        margin-bottom: 0;
    }
    .breadcrumb-custom {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.85rem;
        margin-bottom: 20px;
    }
    .breadcrumb-custom a { color: rgba(255,255,255,0.5); text-decoration: none; transition: color 0.2s; }
    .breadcrumb-custom a:hover { color: #fff; }
    .breadcrumb-custom .sep { color: rgba(255,255,255,0.3); }
    .breadcrumb-custom .current { color: rgba(255,255,255,0.85); }

    /* ─── Contact Page Layouts ─── */
    .contact-section {
        padding: 60px 0 80px;
        background: var(--bg);
    }
    .contact-card {
        background: var(--bg-card);
        border-radius: var(--radius);
        border: 1px solid var(--border);
        box-shadow: var(--shadow-sm);
        padding: 32px;
        height: 100%;
        transition: all 0.3s ease;
    }
    .contact-card:hover {
        box-shadow: var(--shadow);
    }
    .section-title {
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--text);
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* ─── Hotel Info List ─── */
    .contact-list {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }
    .contact-list-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }
    .contact-list-icon {
        width: 44px;
        height: 44px;
        border-radius: var(--radius-xs);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }
    .contact-list-body strong {
        display: block;
        font-size: 0.92rem;
        color: var(--text);
        margin-bottom: 2px;
    }
    .contact-list-body span, .contact-list-body a {
        color: var(--text-muted);
        font-size: 0.9rem;
        font-family: var(--font-alt);
        text-decoration: none;
    }
    .contact-list-body a:hover { color: var(--primary); }

    /* ─── Map ─── */
    .map-card {
        background: var(--bg-card);
        border-radius: var(--radius);
        border: 1px solid var(--border);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
        height: 100%;
    }
    .map-container {
        height: 100%;
        min-height: 460px;
    }
    .map-container iframe {
        width: 100%;
        height: 100%;
        border: none;
    }

    /* ─── Contact Form ─── */
    .form-control-custom {
        border: 1.5px solid var(--border);
        border-radius: 14px;
        padding: 12px 16px;
        font-size: 0.95rem;
        font-family: var(--font-alt);
        transition: all 0.2s;
        background: var(--bg);
        color: var(--text);
    }
    .form-control-custom:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(2,132,199,0.08);
        background: #fff;
    }

    /* ─── Restaurant Contact ─── */
    .resto-contact-card {
        background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #1e3a5f 100%);
        border-radius: var(--radius);
        padding: 32px;
        color: #fff;
        height: 100%;
        border: 1px solid rgba(255,255,255,0.1);
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    .resto-contact-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        margin-bottom: 18px;
        padding-bottom: 18px;
        border-bottom: 1px solid rgba(255,255,255,0.15);
    }
    .resto-contact-item:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }
    .resto-contact-icon {
        width: 44px; height: 44px;
        border-radius: var(--radius-xs);
        background: linear-gradient(135deg, rgba(59,130,246,0.3), rgba(2,132,199,0.3));
        border: 1px solid rgba(255,255,255,0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    /* ─── Social Media ─── */
    .social-card {
        background: var(--bg-card);
        border-radius: var(--radius);
        border: 1px solid var(--border);
        box-shadow: var(--shadow-sm);
        padding: 32px;
        height: 100%;
    }
    .social-icons {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
    }
    .social-btn {
        width: 52px; height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        color: #fff;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .social-btn:hover { 
        transform: translateY(-4px); 
        color: #fff; 
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }
    .social-instagram { background: linear-gradient(135deg, #833AB4 0%, #C13584 50%, #E1306C 100%); }
    .social-facebook { background: linear-gradient(135deg, #1877F2 0%, #166fe5 100%); }
    .social-tiktok { background: linear-gradient(135deg, #000000 0%, #1a1a1a 100%); }
    .social-twitter { background: linear-gradient(135deg, #0F172A 0%, #1e293b 100%); }

    /* ─── FAQ ─── */
    .faq-item {
        border: 1px solid var(--border);
        border-radius: var(--radius-xs);
        margin-bottom: 12px;
        overflow: hidden;
        background: var(--bg-card);
        transition: all 0.3s ease;
    }
    .faq-item:hover {
        border-color: #BFDBFE;
        box-shadow: 0 4px 12px rgba(2,132,199,0.08);
    }
    .faq-question {
        width: 100%;
        background: transparent;
        border: none;
        padding: 20px 24px;
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--text);
        text-align: left;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        font-family: var(--font);
        transition: all 0.2s;
    }
    .faq-question:hover {
        color: var(--primary);
    }
    .faq-question::after {
        content: '\f282';
        font-family: 'bootstrap-icons';
        transition: transform 0.3s;
        color: var(--primary);
        font-size: 1.1rem;
    }
    .faq-question[aria-expanded="true"]::after {
        transform: rotate(180deg);
    }
    .faq-answer {
        padding: 0 24px 20px;
        color: var(--text-muted);
        font-size: 0.92rem;
        font-family: var(--font-alt);
        line-height: 1.7;
    }

    /* ─── Access Info Table ─── */
    .access-table {
        width: 100%;
        border-collapse: collapse;
        background: var(--bg-card);
        border-radius: var(--radius);
        overflow: hidden;
        border: 1px solid var(--border);
        box-shadow: var(--shadow-sm);
    }
    .access-table th, .access-table td {
        padding: 16px 20px;
        font-size: 0.92rem;
        text-align: left;
        border-bottom: 1px solid var(--border);
    }
    .access-table th {
        background: linear-gradient(135deg, #0284C7 0%, #0369A1 100%);
        color: #fff;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .access-table tbody tr:last-child td { border-bottom: none; }
    .access-table tbody tr:hover { 
        background: linear-gradient(to right, rgba(2,132,199,0.04), rgba(2,132,199,0.02));
        transition: all 0.2s;
    }
    .access-table td:last-child {
        font-weight: 700;
        color: var(--primary);
        font-family: var(--font-alt);
        font-size: 0.95rem;
    }

    /* ─── Location Photos ─── */
    .location-photos {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }
    .location-photo {
        border-radius: var(--radius-xs);
        overflow: hidden;
        aspect-ratio: 4/3;
        border: 1px solid var(--border);
    }
    .location-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s;
    }
    .location-photo:hover img { transform: scale(1.05); }

    @media (max-width: 768px) {
        .page-hero { padding: 40px 0 30px; }
        .page-hero h1 { font-size: 1.8rem; }
        .page-hero p { font-size: 0.9rem; }
        .contact-section { padding: 32px 0; }
        .contact-card { padding: 20px; }
        .location-photos { grid-template-columns: repeat(2, 1fr); gap: 8px; }
    }
</style>
@endpush

@section('content')
{{-- Hero --}}
<div class="page-hero">
    <div class="container">
        <div class="breadcrumb-custom">
            <a href="{{ route('home') }}"><i class="bi bi-house"></i> Beranda</a>
            <span class="sep"><i class="bi bi-chevron-right" style="font-size:0.7rem;"></i></span>
            <span class="current">Hubungi Kami</span>
        </div>
        <div class="page-hero-badge">
            <i class="bi bi-telephone-inbound" style="font-size:0.8rem;"></i>
            Respon Cepat 24/7
        </div>
        <h1>Hubungi Kami</h1>
        <p>Ada pertanyaan atau butuh bantuan? Tim kami siap melayani kebutuhan Anda kapan saja</p>
    </div>
</div>

{{-- Contact Section --}}
<div class="contact-section">
    <div class="container">
        <div class="row g-4 mb-4">

            {{-- Left: Hotel Contact Info --}}
            <div class="col-lg-5 col-md-12">
                <div class="contact-card">
                    <div class="section-title"><i class="bi bi-building"></i> {{ $hotelName }}</div>
                    <div class="contact-list">
                        <div class="contact-list-item">
                            <div class="contact-list-icon" style="background:var(--primary-light);color:var(--primary);"><i class="bi bi-geo-alt-fill"></i></div>
                            <div class="contact-list-body">
                                <strong>Alamat</strong>
                                <span>{{ $hotelAddress }}</span>
                            </div>
                        </div>
                        <div class="contact-list-item">
                            <div class="contact-list-icon" style="background:#ECFDF5;color:#10B981;"><i class="bi bi-telephone-fill"></i></div>
                            <div class="contact-list-body">
                                <strong>Telepon</strong>
                                <a href="tel:{{ $hotelPhone }}">{{ $hotelPhone }}</a>
                            </div>
                        </div>
                        <div class="contact-list-item">
                            <div class="contact-list-icon" style="background:#F5F3FF;color:#7C3AED;"><i class="bi bi-envelope-fill"></i></div>
                            <div class="contact-list-body">
                                <strong>Email</strong>
                                <a href="mailto:{{ $hotelEmail }}">{{ $hotelEmail }}</a>
                            </div>
                        </div>
                        <div class="contact-list-item">
                            <div class="contact-list-icon" style="background:#FFF7ED;color:#F97316;"><i class="bi bi-whatsapp"></i></div>
                            <div class="contact-list-body">
                                <strong>WhatsApp</strong>
                                <a href="https://wa.me/{{ $hotelWhatsapp }}" target="_blank">+{{ $hotelWhatsapp }}</a>
                            </div>
                        </div>
                        <div class="contact-list-item">
                            <div class="contact-list-icon" style="background:#EFF6FF;color:#0284C7;"><i class="bi bi-clock-fill"></i></div>
                            <div class="contact-list-body">
                                <strong>Resepsionis</strong>
                                <span>24 Jam</span>
                            </div>
                        </div>
                    </div>

                    {{-- Google Maps Button --}}
                    <a href="https://maps.google.com/?q={{ urlencode($hotelAddress) }}" target="_blank" class="btn-se btn-se-primary w-100 mt-4 py-3">
                        <i class="bi bi-map me-1"></i> Lihat di Google Maps
                    </a>
                </div>
            </div>

            {{-- Right: Google Map --}}
            <div class="col-lg-7 col-md-12">
                <div class="map-card">
                    @if($mapsApiKey)
                        <div id="googleMap" class="map-container"></div>
                    @else
                        <div class="map-container">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.283456789!2d{{ $longitude }}!3d{{ $latitude }}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTPCsDA0JzM2LjQiTiAxMDbCsDI5JzM4LjQiRQ!5e0!3m2!1sid!2sid!4v1234567890"
                                allowfullscreen="" 
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    @endif
                </div>
            </div>

        </div>

        {{-- Form + Restaurant Contact + Social + FAQ + Access + Photos --}}
        <div class="row g-4">

            {{-- Contact Form --}}
            <div class="col-lg-7 col-md-12">
                <div class="contact-card">
                    <div class="section-title"><i class="bi bi-chat-dots-fill"></i> Form Hubungi Kami</div>
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Nama Lengkap</label>
                                <input type="text" class="form-control-custom form-control" placeholder="Nama Anda">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Email</label>
                                <input type="email" class="form-control-custom form-control" placeholder="email@contoh.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Nomor HP</label>
                                <input type="tel" class="form-control-custom form-control" placeholder="+62 812-3456-7890">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Subjek</label>
                                <input type="text" class="form-control-custom form-control" placeholder="Subjek pesan">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold small">Pesan</label>
                                <textarea class="form-control-custom form-control" rows="5" placeholder="Tulis pesan Anda..."></textarea>
                            </div>
                            <div class="col-12">
                                <button type="button" class="btn-se btn-se-primary px-5 py-3">
                                    <i class="bi bi-send me-1"></i> Kirim Pesan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Restaurant Contact --}}
            <div class="col-lg-5 col-md-12">
                <div class="resto-contact-card">
                    <div class="section-title" style="color:#fff;"><i class="bi bi-cup-hot"></i> Restaurant</div>
                    <div class="resto-contact-item">
                        <div class="resto-contact-icon"><i class="bi bi-clock"></i></div>
                        <div>
                            <div style="font-weight:700;font-size:0.92rem;">Jam Operasional</div>
                            <div style="color:rgba(255,255,255,0.7);font-size:0.9rem;font-family:var(--font-alt);">07.00 - 22.00 WIB</div>
                        </div>
                    </div>
                    <div class="resto-contact-item">
                        <div class="resto-contact-icon"><i class="bi bi-whatsapp"></i></div>
                        <div>
                            <div style="font-weight:700;font-size:0.92rem;">WhatsApp Reservasi</div>
                            <a href="https://wa.me/6281234567890" target="_blank" style="color:#FBBF24;font-size:0.9rem;font-family:var(--font-alt);text-decoration:none;">+62 812-3456-7890</a>
                        </div>
                    </div>
                    <div class="resto-contact-item">
                        <div class="resto-contact-icon"><i class="bi bi-geo-alt"></i></div>
                        <div>
                            <div style="font-weight:700;font-size:0.92rem;">Lokasi Restoran</div>
                            <div style="color:rgba(255,255,255,0.7);font-size:0.9rem;font-family:var(--font-alt);">Lantai 1, Hotel Serenity</div>
                        </div>
                    </div>
                </div>

                {{-- Social Media --}}
                <div class="social-card mt-4">
                    <div class="section-title"><i class="bi bi-share"></i> Sosial Media</div>
                    <div class="social-icons">
                        <a href="#" class="social-btn social-instagram" title="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-btn social-facebook" title="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-btn social-tiktok" title="TikTok"><i class="bi bi-tiktok"></i></a>
                        <a href="#" class="social-btn social-twitter" title="X / Twitter"><i class="bi bi-twitter-x"></i></a>
                    </div>
                </div>
            </div>

        </div>

        {{-- FAQ --}}
        <div class="row g-4 mt-4">
            <div class="col-12">
                <div class="contact-card">
                    <div class="section-title"><i class="bi bi-question-circle-fill"></i> Pertanyaan yang Sering Ditanyakan</div>
                    <div class="accordion" id="faqAccordion">
                        <div class="faq-item">
                            <button class="faq-question" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="false">Apakah check-in 24 jam?</button>
                            <div id="faq1" class="collapse" data-bs-parent="#faqAccordion">
                                <div class="faq-answer">Ya, resepsionis hotel kami tersedia 24 jam untuk check-in dan check-out sesuai kebutuhan Anda.</div>
                            </div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false">Apakah tersedia WiFi?</button>
                            <div id="faq2" class="collapse" data-bs-parent="#faqAccordion">
                                <div class="faq-answer">WiFi gratis tersedia di seluruh area hotel, mulai dari lobby, kamar, restoran, hingga area kolam renang.</div>
                            </div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false">Apakah restoran terbuka untuk umum?</button>
                            <div id="faq3" class="collapse" data-bs-parent="#faqAccordion">
                                <div class="faq-answer">Ya, restoran dapat dikunjungi oleh tamu hotel maupun masyarakat umum dengan jam operasional 07.00 - 22.00 WIB.</div>
                            </div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false">Apakah tersedia parkir?</button>
                            <div id="faq4" class="collapse" data-bs-parent="#faqAccordion">
                                <div class="faq-answer">Ya, area parkir gratis tersedia khusus untuk tamu hotel dengan keamanan 24 jam.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Access Info --}}
        <div class="row g-4 mt-4">
            <div class="col-12">
                <div class="contact-card">
                    <div class="section-title"><i class="bi bi-signpost-2"></i> Informasi Akses</div>
                    <div style="overflow-x:auto;">
                        <table class="access-table">
                            <thead><tr><th>Lokasi</th><th>Jarak</th></tr></thead>
                            <tbody>
                                <tr><td>Bandara</td><td>20 km</td></tr>
                                <tr><td>Stasiun</td><td>5 km</td></tr>
                                <tr><td>Terminal</td><td>3 km</td></tr>
                                <tr><td>Pusat Kota</td><td>2 km</td></tr>
                                <tr><td>Mall</td><td>1 km</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Location Photos --}}
        <div class="row g-4 mt-4">
            <div class="col-12">
                <div class="contact-card">
                    <div class="section-title"><i class="bi bi-images"></i> Galeri Lokasi</div>
                    <div class="location-photos">
                        <div class="location-photo">
                            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=600&q=80" alt="Tampak Depan Hotel">
                        </div>
                        <div class="location-photo">
                            <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?w=600&q=80" alt="Lobby Hotel">
                        </div>
                        <div class="location-photo">
                            <img src="https://images.unsplash.com/photo-1536440136628-849c177e76a1?w=600&q=80" alt="Area Parkir">
                        </div>
                        <div class="location-photo">
                            <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=600&q=80" alt="Restoran">
                        </div>
                        <div class="location-photo">
                            <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=600&q=80" alt="Kamar Hotel">
                        </div>
                        <div class="location-photo">
                            <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=600&q=80" alt="Kolam Renang">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@if($mapsApiKey)
@push('scripts')
<script>
    function initMap() {
        const hotelLocation = { lat: {{ $latitude }}, lng: {{ $longitude }} };
        
        const map = new google.maps.Map(document.getElementById("googleMap"), {
            zoom: 15,
            center: hotelLocation,
            styles: [
                { featureType: "poi", elementType: "labels", stylers: [{ visibility: "off" }] }
            ]
        });

        const marker = new google.maps.Marker({
            position: hotelLocation,
            map: map,
            title: "{{ $hotelName }}",
            icon: {
                url: "https://maps.google.com/mapfiles/ms/icons/red-dot.png"
            }
        });

        const infoWindow = new google.maps.InfoWindow({
            content: `
                <div style="padding: 10px; font-family: 'Poppins', sans-serif;">
                    <h6 style="margin: 0 0 5px 0; color: #0284C7; font-weight: 700;">{{ $hotelName }}</h6>
                    <p style="margin: 0; font-size: 13px; color: #64748B; line-height:1.4;">{{ $hotelAddress }}</p>
                    <p style="margin: 5px 0 0 0; font-size: 13px; color: #10B981; font-weight:600;">{{ $hotelPhone }}</p>
                </div>
            `
        });

        marker.addListener("click", () => {
            infoWindow.open(map, marker);
        });
        
        // Open by default
        infoWindow.open(map, marker);
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ $mapsApiKey }}&callback=initMap"></script>
@endpush
@endif
@endsection