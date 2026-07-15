@extends('customer.layouts.app')

@section('title', 'Profile - StayEase')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb" class="se-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="se-card-lg p-4 p-md-5">
                {{-- Header --}}
                <div class="text-center mb-4">
                    <div class="se-avatar" style="width:72px;height:72px;font-size:1.35rem;margin:0 auto 14px;">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <h4 class="fw-bold mb-1" style="font-size:1.25rem;">{{ $user->name }}</h4>
                    <p class="text-muted small mb-0" style="font-family:var(--font-alt);font-size:0.85rem;">{{ $user->email }}</p>
                </div>

                <form action="{{ route('customer.profile.update') }}" method="POST">
                    @csrf
                    
                    <div class="d-flex align-items-center gap-2 mb-4">
                        <div class="bg-primary bg-opacity-10 p-2 rounded-2">
                            <i class="bi bi-person text-primary"></i>
                        </div>
                        <h5 class="fw-bold mb-0">Informasi Personal</h5>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold small">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required style="border:1.5px solid var(--border);border-radius:12px;padding:12px 16px;font-family:var(--font-alt);font-size:0.9rem;">
                            @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold small">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required style="border:1.5px solid var(--border);border-radius:12px;padding:12px 16px;font-family:var(--font-alt);font-size:0.9rem;">
                            @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    @php
                        $guest = \App\Models\Guest::where('user_id', $user->id)->first();
                    @endphp
                    <div class="mb-4">
                        <label class="form-label fw-semibold small">No Telepon</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $guest->phone ?? '') }}" style="border:1.5px solid var(--border);border-radius:12px;padding:12px 16px;font-family:var(--font-alt);font-size:0.9rem;">
                        @error('phone')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>

                    <hr style="border-color:var(--border);">

                    <div class="d-flex align-items-center gap-2 mb-4">
                        <div class="bg-primary bg-opacity-10 p-2 rounded-2">
                            <i class="bi bi-key text-primary"></i>
                        </div>
                        <h5 class="fw-bold mb-0">Ubah Password <span class="text-muted fw-normal" style="font-size:0.8rem;">(opsional)</span></h5>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold small">Password Saat Ini</label>
                            <div class="input-group">
                                <input type="password" name="current_password" class="form-control" id="curr_pass" style="border:1.5px solid var(--border);border-radius:12px 0 0 12px;padding:12px 16px;font-family:var(--font-alt);font-size:0.9rem;">
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePass('curr_pass',this)" style="border:1.5px solid var(--border);border-radius:0 12px 12px 0;">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            @error('current_password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold small">Password Baru</label>
                            <div class="input-group">
                                <input type="password" name="new_password" class="form-control" id="new_pass" style="border:1.5px solid var(--border);border-radius:12px 0 0 12px;padding:12px 16px;font-family:var(--font-alt);font-size:0.9rem;">
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePass('new_pass',this)" style="border:1.5px solid var(--border);border-radius:0 12px 12px 0;">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            @error('new_password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold small">Konfirmasi Password</label>
                            <div class="input-group">
                                <input type="password" name="new_password_confirmation" class="form-control" id="new_pass_conf" style="border:1.5px solid var(--border);border-radius:12px 0 0 12px;padding:12px 16px;font-family:var(--font-alt);font-size:0.9rem;">
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePass('new_pass_conf',this)" style="border:1.5px solid var(--border);border-radius:0 12px 12px 0;">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn-se btn-se-primary w-100 py-3 mt-3" style="font-size:0.95rem;">
                        <i class="bi bi-check-circle me-2"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function togglePass(id, btn) {
    const inp = document.getElementById(id);
    const icon = btn.querySelector('i');
    if (inp.type === 'password') {
        inp.type = 'text';
        icon.className = 'bi bi-eye-slash';
    } else {
        inp.type = 'password';
        icon.className = 'bi bi-eye';
    }
}
</script>
@endpush