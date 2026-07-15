@extends('customer.layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="se-container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('rooms.index') }}" class="btn btn-outline-secondary rounded-3 me-3">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <h3 class="fw-bold mb-0" style="color:#334155;">Booking</h3>
            </div>

            @if(session('error'))
                <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
                    <i class="bi bi-exclamation-circle me-2"></i> {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('customer.process-booking') }}" method="POST">
                @csrf
                
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="fw-bold mb-0" style="color:#334155;"><i class="bi bi-info-circle text-primary me-2"></i>Detail Booking</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-muted">Kamar</label>
                                <input type="text" class="form-control rounded-3" value="{{ $data['room_number'] ?? '-' }} - {{ $data['room_type'] ?? '-' }}" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-semibold text-muted">Check In</label>
                                <input type="text" class="form-control rounded-3" value="{{ \Carbon\Carbon::parse($data['check_in'])->format('d/m/Y') }}" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-semibold text-muted">Check Out</label>
                                <input type="text" class="form-control rounded-3" value="{{ \Carbon\Carbon::parse($data['check_out'])->format('d/m/Y') }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="fw-bold mb-0" style="color:#334155;"><i class="bi bi-person text-primary me-2"></i>Data Pemesan</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-muted">Nama Lengkap</label>
                                <input type="text" name="full_name" class="form-control rounded-3 @error('full_name') is-invalid @enderror" value="{{ old('full_name', Auth::user()->name ?? '') }}" required>
                                @error('full_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-muted">Email</label>
                                <input type="email" name="email" class="form-control rounded-3 @error('email') is-invalid @enderror" value="{{ old('email', Auth::user()->email ?? '') }}" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-muted">Nomor Telepon</label>
                                <input type="text" name="phone" class="form-control rounded-3 @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-muted">Permintaan Khusus (Opsional)</label>
                                <input type="text" name="special_request" class="form-control rounded-3" placeholder="Contoh: Butuh kasur ekstra">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="fw-bold mb-0" style="color:#334155;"><i class="bi bi-receipt text-primary me-2"></i>Ringkasan Harga</h5>
                    </div>
                    <div class="card-body">
                        <div class="bg-light rounded-3 p-3 mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Harga per malam</span>
                                <span class="fw-semibold">Rp {{ number_format($data['price_per_night'] ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Jumlah malam</span>
                                <span class="fw-semibold">x {{ \Carbon\Carbon::parse($data['check_in'])->diffInDays($data['check_out']) }}</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">Subtotal</span>
                                <span class="fw-bold text-primary">Rp {{ number_format($data['total_price'] ?? 0, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="alert alert-info border-0 rounded-3" style="background:#E0F2FE;color:#0284C7;">
                            <i class="bi bi-info-circle me-2"></i>Booking akan dibuat terlebih dahulu. Anda dapat melakukan pembayaran nanti dari halaman "Booking Saya".
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 fw-bold" style="background:linear-gradient(135deg,#0284C7,#0369A1);border:none;">
                    <i class="bi bi-check-circle me-2"></i>Buat Booking
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
