@extends('admin.layouts.app')

@section('title', 'Edit Promo')

@section('content')
        <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Edit Promo</h2>
        <p class="text-muted mb-0">Perbarui informasi promo: {{ $promo->title }}</p>
    </div>
    <a href="{{ route('admin.promos.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('admin.promos.update', $promo) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold">Judul Promo <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title', $promo->title) }}"
                               placeholder="Contoh: Diskon Akhir Tahun" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Judul promo yang akan ditampilkan</small>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="code" class="form-label fw-semibold">Kode Promo <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('code') is-invalid @enderror" 
                               id="code" name="code" value="{{ old('code', $promo->code) }}"
                               placeholder="Contoh: YEAR2024" required style="text-transform: uppercase;">
                        @error('code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Kode yang akan dimasukkan pelanggan saat pembayaran</small>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="discount_type" class="form-label fw-semibold">Tipe Diskon <span class="text-danger">*</span></label>
                        <select class="form-select @error('discount_type') is-invalid @enderror" 
                                id="discount_type" name="discount_type" required>
                            <option value="">Pilih Tipe Diskon</option>
                            <option value="percentage" {{ old('discount_type', $promo->discount_type) === 'percentage' ? 'selected' : '' }}>
                                Persentase (%)
                            </option>
                            <option value="fixed" {{ old('discount_type', $promo->discount_type) === 'fixed' ? 'selected' : '' }}>
                                Nominal Tetap (Rp)
                            </option>
                        </select>
                        @error('discount_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="discount_value" class="form-label fw-semibold">Nilai Diskon <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="value-prefix">Rp</span>
                            <input type="number" class="form-control @error('discount_value') is-invalid @enderror" 
                                   id="discount_value" name="discount_value" value="{{ old('discount_value', $promo->discount_value) }}"
                                   placeholder="0" required step="0.01" min="0">
                            @error('discount_value')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <small class="text-muted">Masukkan nominal atau persentase diskon</small>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="valid_from" class="form-label fw-semibold">Berlaku Dari <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('valid_from') is-invalid @enderror" 
                               id="valid_from" name="valid_from" value="{{ old('valid_from', $promo->valid_from?->format('Y-m-d')) }}" required>
                        @error('valid_from')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="valid_until" class="form-label fw-semibold">Berlaku Hingga <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('valid_until') is-invalid @enderror" 
                               id="valid_until" name="valid_until" value="{{ old('valid_until', $promo->valid_until?->format('Y-m-d')) }}" required>
                        @error('valid_until')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="is_active" class="form-label fw-semibold">Status</label>
                        <select class="form-select @error('is_active') is-invalid @enderror" 
                                id="is_active" name="is_active" required>
                            <option value="1" {{ old('is_active', $promo->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('is_active', $promo->is_active) == 0 ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('is_active')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Deskripsi</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3"
                                  placeholder="Jelaskan syarat dan ketentuan promo">{{ old('description', $promo->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('admin.promos.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle me-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-2"></i>Update Promo
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection