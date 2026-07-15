@extends('admin.layouts.app')

@section('title', 'Kelola Landing Page')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Kelola Landing Page</h2>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row g-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span>Sections</span>
                <span class="badge bg-primary">{{ $sections->count() }}</span>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    @forelse($sections as $section)
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <strong>{{ $section->title ?? 'Tanpa Judul' }}</strong>
                                    <br><small class="text-muted">Order: {{ $section->order }}</small>
                                    @if($section->subtitle)
                                        <br><small class="text-muted">{{ $section->subtitle }}</small>
                                    @endif
                                </div>
                                <span class="badge bg-{{ $section->is_active ? 'success' : 'secondary' }}">
                                    {{ $section->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </div>
                            <form action="{{ route('admin.landing-page.section.update', $section) }}" method="POST" class="mt-2 d-flex gap-2">
                                @csrf
                                @method('POST')
                                <input type="text" name="title" value="{{ $section->title }}" class="form-control form-control-sm" placeholder="Judul">
                                <input type="number" name="order" value="{{ $section->order }}" class="form-control form-control-sm" style="width:80px;" placeholder="Order">
                                <select name="is_active" class="form-select form-select-sm" style="width:120px;">
                                    <option value="1" {{ $section->is_active ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ !$section->is_active ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary"><i class="bi bi-save"></i></button>
                            </form>
                        </div>
                    @empty
                        <div class="text-center py-4 text-muted">Belum ada section</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span>Services</span>
                <span class="badge bg-primary">{{ $services->count() }}</span>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    @forelse($services as $service)
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <strong>{{ $service->title }}</strong>
                                    <br><small class="text-muted">{{ $service->description }}</small>
                                </div>
                                <span class="badge bg-{{ $service->is_active ? 'success' : 'secondary' }}">
                                    {{ $service->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </div>
                            <div class="mt-2 d-flex gap-2">
                                <form action="{{ route('admin.landing-page.service.update', $service) }}" method="POST" class="flex-grow-1 d-flex gap-2">
                                    @csrf
                                    @method('POST')
                                    <input type="text" name="title" value="{{ $service->title }}" class="form-control form-control-sm" placeholder="Judul">
                                    <input type="number" name="order" value="{{ $service->order }}" class="form-control form-control-sm" style="width:80px;" placeholder="Order">
                                    <select name="is_active" class="form-select form-select-sm" style="width:120px;">
                                        <option value="1" {{ $service->is_active ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ !$service->is_active ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="bi bi-save"></i></button>
                                </form>
                                <form action="{{ route('admin.landing-page.service.destroy', $service) }}" method="POST" onsubmit="return confirm('Hapus service ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4 text-muted">Belum ada service</div>
                    @endforelse
                </div>
                <form action="{{ route('admin.landing-page.service.store') }}" method="POST" class="mt-3">
                    @csrf
                    <h6>Tambah Service</h6>
                    <div class="row g-2">
                        <div class="col-md-4">
                            <input type="text" name="title" class="form-control form-control-sm" placeholder="Judul" required>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="description" class="form-control form-control-sm" placeholder="Deskripsi" required>
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="order" class="form-control form-control-sm" placeholder="Order">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-sm btn-success w-100"><i class="bi bi-plus"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span>Gallery</span>
                <span class="badge bg-primary">{{ $galleries->count() }}</span>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    @forelse($galleries as $gallery)
                        <div class="col-md-4">
                            <div class="card h-100">
                                <img src="{{ asset('storage/' . $gallery->image) }}" class="card-img-top" style="height:180px;object-fit:cover;">
                                <div class="card-body p-2">
                                    <h6 class="card-title small">{{ $gallery->title ?? 'Tanpa judul' }}</h6>
                                    <span class="badge bg-{{ $gallery->is_active ? 'success' : 'secondary' }}">{{ $gallery->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                                    <form action="{{ route('admin.landing-page.gallery.destroy', $gallery) }}" method="POST" onsubmit="return confirm('Hapus gallery ini?')" class="mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger w-100"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-4 text-muted">Belum ada gallery</div>
                    @endforelse
                </div>
                <form action="{{ route('admin.landing-page.gallery.store') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                    @csrf
                    <h6>Tambah Gallery</h6>
                    <div class="row g-2">
                        <div class="col-md-4">
                            <input type="text" name="title" class="form-control form-control-sm" placeholder="Judul">
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="image" class="form-control form-control-sm" required accept="image/*">
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="order" class="form-control form-control-sm" placeholder="Order">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-sm btn-success w-100"><i class="bi bi-plus"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span>Testimonials</span>
                <span class="badge bg-primary">{{ $testimonials->count() }}</span>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    @forelse($testimonials as $testimonial)
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <strong>{{ $testimonial->name }}</strong>
                                    <span class="text-muted"> - {{ $testimonial->position }}</span>
                                    <br><small>{{ $testimonial->message }}</small>
                                    <br><span class="text-warning">{{ str_repeat('★', $testimonial->rating) }}</span>
                                </div>
                                <form action="{{ route('admin.landing-page.testimonial.destroy', $testimonial) }}" method="POST" onsubmit="return confirm('Hapus testimonial ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4 text-muted">Belum ada testimonial</div>
                    @endforelse
                </div>
                <form action="{{ route('admin.landing-page.testimonial.store') }}" method="POST" class="mt-3">
                    @csrf
                    <h6>Tambah Testimonial</h6>
                    <div class="row g-2">
                        <div class="col-md-3">
                            <input type="text" name="name" class="form-control form-control-sm" placeholder="Nama" required>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="position" class="form-control form-control-sm" placeholder="Posisi" required>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="message" class="form-control form-control-sm" placeholder="Pesan" required>
                        </div>
                        <div class="col-md-1">
                            <input type="number" name="rating" class="form-control form-control-sm" placeholder="1-5" min="1" max="5" required>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-sm btn-success w-100"><i class="bi bi-plus"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</div>
@endsection
