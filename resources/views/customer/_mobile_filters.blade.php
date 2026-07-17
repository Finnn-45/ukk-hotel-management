<div class="d-flex justify-content-between align-items-center p-3 border-bottom bg-light">
    <h6 class="mb-0 fw-bold"><i class="bi bi-sliders me-2"></i>Filter Pencarian</h6>
    <button type="button" class="btn-close" onclick="document.getElementById('mobileFilterCard')?.classList.add('d-none')" aria-label="Close"></button>
</div>
<form method="GET" action="{{ route('rooms.index') }}" class="p-3">
    {{-- Preserve sort param --}}
    @if(request('sort'))
        <input type="hidden" name="sort" value="{{ request('sort') }}">
    @endif

    {{-- Room Type --}}
    <div class="mb-3">
        <label class="form-label fw-semibold small">Tipe Kamar</label>
        <select name="room_type" class="form-select form-select-sm">
            <option value="">Semua Tipe</option>
            @foreach($roomTypes as $type)
                <option value="{{ $type->id }}" {{ request('room_type') == $type->id ? 'selected' : '' }}>
                    {{ $type->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Price Range --}}
    <div class="mb-3">
        <label class="form-label fw-semibold small">Harga / Malam</label>
        <div class="row g-2">
            <div class="col-6">
                <input type="number" name="min_price" class="form-control form-control-sm" placeholder="Min" value="{{ request('min_price') }}" min="0">
            </div>
            <div class="col-6">
                <input type="number" name="max_price" class="form-control form-control-sm" placeholder="Max" value="{{ request('max_price') }}" min="0">
            </div>
        </div>
    </div>

    {{-- Floor --}}
    <div class="mb-3">
        <label class="form-label fw-semibold small">Lantai</label>
        <input type="number" name="floor" class="form-control form-control-sm" placeholder="Nomor lantai" value="{{ request('floor') }}" min="1">
    </div>

    {{-- Actions --}}
    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="bi bi-funnel-fill me-1"></i> Terapkan Filter
        </button>
        <a href="{{ route('rooms.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
        </a>
    </div>
</form>