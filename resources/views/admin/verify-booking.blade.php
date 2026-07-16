@extends('admin.layouts.app')

@section('title', 'Verifikasi Booking')

@section('content')
<div class="row mb-4">
    <div class="col-md-8 offset-md-2">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="card-title fw-bold mb-0" style="font-size:1.1rem;color:#334155;">
                    <i class="bi bi-qr-code-scan text-primary me-2"></i>Verifikasi Kode Booking
                </h5>
                <small class="text-muted">Masukkan kode verifikasi dari customer untuk check-in otomatis</small>
            </div>
            <div class="card-body">
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('info'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        {{ session('info') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('admin.verify.booking') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="code" class="form-label fw-semibold">Kode Verifikasi</label>
                        <input type="text" 
                               class="form-control form-control-lg text-center @error('code') is-invalid @enderror" 
                               id="code" 
                               name="code" 
                               value="{{ old('code') }}" 
                               placeholder="XXXXXXXX" 
                               maxlength="8" 
                               style="font-size:1.5rem;letter-spacing:0.3rem;font-weight:700;"
                               required
                               autofocus>
                        @error('code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            Kode 8 karakter yang diberikan kepada customer setelah pembayaran
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-check-circle me-2"></i>Verifikasi & Check-in
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-light">
                            <i class="bi bi-arrow-left me-2"></i>Kembali ke Dashboard
                        </a>
                    </div>
                </form>

                <div class="mt-4 p-3 bg-light rounded">
                    <h6 class="fw-semibold mb-2"><i class="bi bi-info-circle text-primary me-1"></i>Petunjuk:</h6>
                    <ul class="mb-0 small text-muted">
                        <li>Minta customer menampilkan kode verifikasi 8 karakter</li>
                        <li>Masukkan kode tersebut pada form di atas</li>
                        <li>Sistem akan otomatis melakukan check-in dan memperbarui status kamar</li>
                        <li>Pastikan pembayaran sudah dikonfirmasi sebelum verifikasi</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Auto uppercase input
    document.getElementById('code').addEventListener('input', function(e) {
        this.value = this.value.toUpperCase();
    });
</script>
@endpush
@endsection