@extends('customer.layouts.app')

@section('title', 'Lupa Password')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <i class="bi bi-lock-open text-primary" style="font-size: 48px;"></i>
                        <h3 class="fw-bold mt-3">Lupa Password?</h3>
                        <p class="text-muted">Masukkan email Anda dan kami akan mengirimkan link reset password</p>
                    </div>

                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2">
                            <i class="bi bi-envelope"></i> Kirim Link Reset Password
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