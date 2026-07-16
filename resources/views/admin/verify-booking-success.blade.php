@extends('admin.layouts.app')

@section('title', 'Check-in Berhasil')

@section('content')
<div class="row mb-4">
    <div class="col-md-8 offset-md-2">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <div class="mb-4">
                    <div class="avatar-initials mx-auto" style="width:80px;height:80px;font-size:2rem;background:linear-gradient(135deg, #10b981 0%, #059669 100%);">
                        <i class="bi bi-check-lg" style="font-size:2.5rem;"></i>
                    </div>
                </div>

                <h3 class="fw-bold mb-3" style="color:#334155;">Check-in Berhasil!</h3>
                <p class="text-muted mb-4">Booking telah berhasil diverifikasi dan check-in</p>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="card border bg-light">
                            <div class="card-body">
                                <small class="text-muted d-block mb-1">Tamu</small>
                                <strong class="text-dark">{{ $booking->guest->full_name }}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border bg-light">
                            <div class="card-body">
                                <small class="text-muted d-block mb-1">Kamar</small>
                                <strong class="text-dark">
                                    {{ $booking->room->room_number }} - {{ $booking->room->roomType->name }}
                                </strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border bg-light">
                            <div class="card-body">
                                <small class="text-muted d-block mb-1">Check-in</small>
                                <strong class="text-dark">{{ \Carbon\Carbon::parse($booking->check_in)->format('d/m/Y') }}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border bg-light">
                            <div class="card-body">
                                <small class="text-muted d-block mb-1">Check-out</small>
                                <strong class="text-dark">{{ \Carbon\Carbon::parse($booking->check_out)->format('d/m/Y') }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-primary">
                        <i class="bi bi-eye me-2"></i>Lihat Detail Booking
                    </a>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-light">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection