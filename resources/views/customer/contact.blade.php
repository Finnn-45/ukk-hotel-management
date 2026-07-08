@extends('customer.layouts.app')

@section('title', 'Kontak Kami')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Kontak</li>
        </ol>
    </nav>

    <div class="text-center mb-5">
        <h2 class="fw-bold">Hubungi Kami</h2>
        <p class="text-muted">Kami siap membantu Anda 24/7</p>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="fw-bold mb-4">Informasi Kontak</h5>
                    
                    <div class="d-flex align-items-start mb-3">
                        <div class="stat-icon stat-icon-primary me-3">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Alamat</h6>
                            <p class="text-muted mb-0">{{ $hotelAddress }}</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-3">
                        <div class="stat-icon stat-icon-success me-3">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Telepon</h6>
                            <p class="text-muted mb-0">{{ $hotelPhone }}</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-3">
                        <div class="stat-icon stat-icon-info me-3">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Email</h6>
                            <p class="text-muted mb-0">{{ $hotelEmail }}</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start">
                        <div class="stat-icon stat-icon-warning me-3">
                            <i class="bi bi-whatsapp"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">WhatsApp</h6>
                            <p class="text-muted mb-0">+{{ $hotelWhatsapp }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    @if($mapsApiKey)
                        <div id="googleMap" style="height: 500px; width: 100%;"></div>
                    @else
                        <div class="ratio ratio-16x9" style="height: 500px;">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.283456789!2d{{ $longitude }}!3d{{ $latitude }}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTPCsDA0JzM2LjQiTiAxMDbCsDI5JzM4LjQiRQ!5e0!3m2!1sid!2sid!4v1234567890"
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    @endif
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

        new google.maps.Marker({
            position: hotelLocation,
            map: map,
            title: "{{ $hotelName }}",
            icon: {
                url: "https://maps.google.com/mapfiles/ms/icons/red-dot.png"
            }
        });

        const infoWindow = new google.maps.InfoWindow({
            content: `
                <div style="padding: 10px;">
                    <h5 style="margin: 0 0 5px 0; color: #0d6efd;">{{ $hotelName }}</h5>
                    <p style="margin: 0; font-size: 14px; color: #666;">{{ $hotelAddress }}</p>
                    <p style="margin: 5px 0 0 0; font-size: 14px; color: #666;">{{ $hotelPhone }}</p>
                </div>
            `
        });

        new google.maps.Marker({
            position: hotelLocation,
            map: map,
            title: "{{ $hotelName }}",
            icon: {
                url: "https://maps.google.com/mapfiles/ms/icons/red-dot.png"
            }
        }).addListener("click", () => {
            infoWindow.open(map, marker);
        });
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ $mapsApiKey }}&callback=initMap"></script>
@endpush
@endif
@endsection