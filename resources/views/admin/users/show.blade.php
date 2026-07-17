@extends('admin.layouts.app')

@section('title', 'Detail User - Admin')

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <div>
                <h4 class="fw-bold mb-1">Detail User</h4>
                <p class="text-muted small mb-0">Informasi lengkap pengguna</p>
            </div>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary">
                <i class="bi bi-pencil"></i> Edit
            </a>
            @if($user->id !== auth()->id())
                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </form>
            @endif
        </div>
    </div>

    <div class="row">
        {{-- User Info --}}
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-4">
                    <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px; font-weight: 700; font-size: 2rem;">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <h5 class="fw-bold mb-1">{{ $user->name }}</h5>
                    <p class="text-muted small mb-3">{{ $user->email }}</p>

                 

                    <div class="d-flex justify-content-center gap-2">
                        @if($user->email_verified_at)
                            <span class="badge bg-success">
                                <i class="bi bi-check-circle"></i> Terverifikasi
                            </span>
                        @else
                            <span class="badge bg-secondary">
                                <i class="bi bi-clock"></i> Belum Verifikasi
                            </span>
                        @endif
                        @if(isset($user->is_active))
                            <span class="badge bg-{{ $user->is_active ? 'success' : 'danger' }}">
                                {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        @endif
                    </div>

                    <hr class="my-3">

                    <div class="d-grid gap-2">
                        <form action="{{ route('admin.users.toggle-verification', $user) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-{{ $user->email_verified_at ? 'warning' : 'success' }} w-100">
                                <i class="bi bi-{{ $user->email_verified_at ? 'x-circle' : 'check-circle' }}"></i>
                                {{ $user->email_verified_at ? 'Batalkan Verifikasi' : 'Verifikasi Email' }}
                            </button>
                        </form>
                        @if($user->id !== auth()->id() && isset($user->is_active))
                            <form action="{{ route('admin.users.toggle-active', $user) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-{{ $user->is_active ? 'danger' : 'success' }} w-100">
                                    <i class="bi bi-{{ $user->is_active ? 'pause' : 'play' }}"></i>
                                    {{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }} User
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Guest Info --}}
            @if($guest)
            <div class="card border-0 shadow-sm mt-3">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="fw-bold mb-0">Informasi Guest</h6>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <small class="text-muted">Nama Lengkap</small>
                        <div class="fw-semibold">{{ $guest->full_name }}</div>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted">Email</small>
                        <div class="fw-semibold">{{ $guest->email }}</div>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted">Telepon</small>
                        <div class="fw-semibold">{{ $guest->phone ?? '-' }}</div>
                    </div>
                    <div>
                        <small class="text-muted">Total Booking</small>
                        <div class="fw-semibold">{{ $guest->bookings()->count() }} booking</div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        {{-- Bookings & Reviews --}}
        <div class="col-md-8">
            {{-- Recent Bookings --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="fw-bold mb-0">Booking Terakhir</h6>
                </div>
                <div class="card-body">
                    @if($bookings->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>Kamar</th>
                                        <th>Check In</th>
                                        <th>Check Out</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings as $booking)
                                        <tr>
                                            <td>
                                                <div class="fw-semibold">{{ $booking->room->room_number }}</div>
                                                <div class="small text-muted">{{ $booking->room->roomType->name }}</div>
                                            </td>
                                            <td class="small">{{ \Carbon\Carbon::parse($booking->check_in)->format('d M Y') }}</td>
                                            <td class="small">{{ \Carbon\Carbon::parse($booking->check_out)->format('d M Y') }}</td>
                                            <td class="fw-semibold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                            <td>
                                                <span class="badge bg-{{ $booking->status == 'completed' ? 'success' : ($booking->status == 'cancelled' ? 'danger' : 'primary') }}">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted text-center py-4">Belum ada booking</p>
                    @endif
                </div>
            </div>

            {{-- Recent Reviews --}}
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="fw-bold mb-0">Review Terakhir</h6>
                </div>
                <div class="card-body">
                    @if($reviews->count() > 0)
                        @foreach($reviews as $review)
                            <div class="border-bottom pb-3 mb-3">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <div class="text-warning">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <i class="bi bi-star-fill"></i>
                                            @else
                                                <i class="bi bi-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="small text-muted mb-0">{{ $review->review ?? 'Tidak ada ulasan' }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted text-center py-4">Belum ada review</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
