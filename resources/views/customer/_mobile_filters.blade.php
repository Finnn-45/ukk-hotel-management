<div style="padding:16px;">
    <div class="d-flex justify-content-between align-items-center mb-3" style="border-bottom:1px solid var(--border);padding-bottom:12px;">
        <h5 class="fw-bold mb-0">Filter</h5>
        <button class="btn btn-sm btn-outline-secondary rounded-3" onclick="this.closest('.se-filter-card').classList.add('d-none')">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <form method="GET" action="{{ route('rooms.index') }}">
        <div class="mb-3">
            <label class="fw-semibold small d-block mb-2">Tipe Kamar</label>
            @foreach($roomTypes as $type)
                <div class="form-check mb-1">
                    <input class="form-check-input" type="radio" name="room_type" id="mf_{{ $type->id }}" value="{{ $type->id }}" {{ request('room_type') == $type->id ? 'checked' : '' }}>
                    <label class="form-check-label small" for="mf_{{ $type->id }}">{{ $type->name }}</label>
                </div>
            @endforeach
            <div class="form-check">
                <input class="form-check-input" type="radio" name="room_type" id="mf_all" value="" {{ !request('room_type') ? 'checked' : '' }}>
                <label class="form-check-label small" for="mf_all">Semua</label>
            </div>
        </div>

        <div class="row g-2 mb-3">
            <div class="col-6">
                <label class="small text-muted">Harga Min</label>
                <input type="number" name="min_price" class="form-control form-control-sm" value="{{ request('min_price') }}">
            </div>
            <div class="col-6">
                <label class="small text-muted">Harga Max</label>
                <input type="number" name="max_price" class="form-control form-control-sm" value="{{ request('max_price') }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="small text-muted">Lantai</label>
            <input type="number" name="floor" class="form-control form-control-sm" value="{{ request('floor') }}">
        </div>

        <button type="submit" class="btn-se btn-se-primary w-100 mb-2">Terapkan Filter</button>
        <a href="{{ route('rooms.index') }}" class="btn-se btn-se-outline w-100 text-center d-block">Reset</a>
    </form>
</div>