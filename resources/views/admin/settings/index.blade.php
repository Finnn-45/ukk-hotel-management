@extends('admin.layouts.app')

@section('title', 'Pengaturan Hotel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Pengaturan Hotel</h2>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            <ul class="nav nav-tabs mb-4" id="settingsTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab">
                        <i class="bi bi-building"></i> Umum
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab">
                        <i class="bi bi-telephone"></i> Kontak
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="social-tab" data-bs-toggle="tab" data-bs-target="#social" type="button" role="tab">
                        <i class="bi bi-share"></i> Sosial Media
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="business-tab" data-bs-toggle="tab" data-bs-target="#business" type="button" role="tab">
                        <i class="bi bi-gear"></i> Bisnis
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="settingsTabContent">
                @php
                    $groupLabels = [
                        'general' => 'Umum',
                        'contact' => 'Kontak',
                        'social' => 'Sosial Media',
                        'business' => 'Bisnis',
                    ];
                    $fieldLabels = [
                        'hotel_name' => 'Nama Hotel',
                        'hotel_tagline' => 'Tagline',
                        'hotel_description' => 'Deskripsi Hotel',
                        'hotel_address' => 'Alamat',
                        'hotel_phone' => 'Telepon',
                        'hotel_email' => 'Email',
                        'hotel_whatsapp' => 'WhatsApp',
                        'social_facebook' => 'Facebook',
                        'social_instagram' => 'Instagram',
                        'social_twitter' => 'Twitter',
                        'check_in_time' => 'Jam Check In',
                        'check_out_time' => 'Jam Check Out',
                        'tax_percentage' => 'Persentase Pajak (%)',
                        'currency' => 'Mata Uang',
                    ];
                    $fieldTypes = [
                        'hotel_description' => 'textarea',
                        'hotel_address' => 'textarea',
                    ];
                @endphp

                @foreach($settings as $group => $groupSettings)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $group }}" role="tabpanel">
                        <h5 class="mb-3">{{ $groupLabels[$group] ?? ucfirst($group) }}</h5>
                        <div class="row">
                            @foreach($groupSettings as $setting)
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ $fieldLabels[$setting->key] ?? ucfirst(str_replace('_', ' ', $setting->key)) }}</label>
                                    
                                    @if(isset($fieldTypes[$setting->key]) && $fieldTypes[$setting->key] == 'textarea')
                                        <textarea name="settings[{{ $setting->id }}][value]" 
                                                  class="form-control" rows="3">{{ $setting->value }}</textarea>
                                    @else
                                        <input type="text" name="settings[{{ $setting->id }}][value]" 
                                               class="form-control" value="{{ $setting->value }}">
                                    @endif
                                    
                                    <input type="hidden" name="settings[{{ $setting->id }}][key]" value="{{ $setting->key }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Store active tab on page load
    var triggerTabList = [].slice.call(document.querySelectorAll('#settingsTab button'))
    triggerTabList.forEach(function (el) {
        var tabTrigger = new bootstrap.Tab(el)
        el.addEventListener('click', function (event) {
            event.preventDefault()
            tabTrigger.show()
        })
    })
</script>
@endpush