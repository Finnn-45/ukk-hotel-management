@extends('customer.layouts.app')

@section('title', 'Reset Password')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <i class="bi bi-key text-primary" style="font-size: 48px;"></i>
                        <h3 class="fw-bold mt-3">Reset Password</h3>
                        <p class="text-muted">Masukkan password baru Anda</p>
                    </div>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="email" value="{{ $email }}">

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $email }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" id="password" required minlength="8">
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password', this)">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <div class="input-group">
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required minlength="8">
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_confirmation', this)">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2">
                            <i class="bi bi-check-circle"></i> Reset Password
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <a href="{{ route('customer.login') }}" class="text-decoration-none">
                            <i class="bi bi-arrow-left"></i> Kembali ke Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function togglePassword(inputId, btn) {
    const input = document.getElementById(inputId);
    const icon = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'bi bi-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'bi bi-eye';
    }
}
</script>
@endpush
