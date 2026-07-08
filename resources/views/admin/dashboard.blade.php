@extends('admin.layouts.app')

@section('title', 'Dashboard')

@push('styles')
<style>
    :root {
        --primary: #2563EB;
        --primary-dark: #1D4ED8;
        --accent: #FBBF24;
    }
    .avatar-initials {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: #ffffff;
        font-weight: 600;
        font-size: 0.8rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .text-purple {
        color: #7c3aed !important;
    }
    .stat-icon-purple {
        background: rgba(139, 92, 246, 0.1) !important;
        color: #7c3aed !important;
    }

    /* Timeline Container & Controls */
    .timeline-container {
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        background: #ffffff;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
        overflow: hidden;
        margin-top: 24px;
        margin-bottom: 24px;
    }
    .timeline-scroll {
        overflow-x: auto;
        position: relative;
        scrollbar-width: thin;
        scrollbar-color: #cbd5e1 #f8fafc;
        background: #ffffff;
    }
    .timeline-scroll::-webkit-scrollbar {
        height: 8px;
    }
    .timeline-scroll::-webkit-scrollbar-track {
        background: #f8fafc;
    }
    .timeline-scroll::-webkit-scrollbar-thumb {
        background-color: #cbd5e1;
        border-radius: 6px;
    }
    
    /* Grid layout */
    .timeline-grid {
        display: grid;
        grid-template-columns: minmax(180px, 1fr) repeat(14, minmax(100px, 1fr));
        min-width: 1580px;
        position: relative;
    }
    
    /* Header Row cell styles */
    .timeline-day-header {
        background: #f8fafc;
        border-bottom: 2px solid #e2e8f0;
        border-right: 1px solid #e2e8f0;
        padding: 14px 8px;
        text-align: center;
        position: sticky;
        top: 0;
        z-index: 8;
    }
    .timeline-day-header.weekend {
        background: #f1f5f9;
    }
    .timeline-day-header.today {
        background: #e0f2fe;
        border-bottom: 2px solid #0284c7;
    }
    .timeline-day-header.today .day-date {
        color: #0284c7;
    }
    .timeline-day-header .day-name {
        font-size: 0.65rem;
        color: #64748b;
        text-transform: uppercase;
        display: block;
        font-weight: 700;
        margin-bottom: 2px;
        letter-spacing: 0.5px;
    }
    .timeline-day-header .day-date {
        font-size: 0.95rem;
        font-weight: 700;
        color: #0f172a;
    }
    .timeline-room-header {
        position: sticky;
        left: 0;
        background: #f8fafc;
        z-index: 10;
        border-bottom: 2px solid #e2e8f0;
        border-right: 2px solid #e2e8f0;
        padding: 14px 16px;
        font-weight: 700;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #475569;
        display: flex;
        align-items: center;
        box-shadow: 4px 0 8px -4px rgba(0,0,0,0.08);
    }
    
    /* Grouping Row header */
    .timeline-group-header {
        grid-column: 1 / -1;
        background: #f1f5f9;
        padding: 10px 16px;
        font-weight: 700;
        font-size: 0.8rem;
        color: #1e293b;
        border-bottom: 1px solid #cbd5e1;
        border-top: 1px solid #cbd5e1;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 8px;
        z-index: 6;
        position: sticky;
        left: 0;
    }
    
    /* Room Row cell styles */
    .timeline-room-label {
        position: sticky;
        left: 0;
        background: #ffffff;
        z-index: 7;
        padding: 16px;
        font-weight: 600;
        color: #334155;
        border-right: 2px solid #e2e8f0;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        box-shadow: 4px 0 8px -4px rgba(0,0,0,0.08);
    }
    .timeline-room-label .room-title {
        font-size: 0.85rem;
        font-weight: 700;
        color: #0f172a;
    }
    .timeline-room-label .room-floor {
        font-size: 0.7rem;
        color: #64748b;
        margin-top: 2px;
        font-weight: 500;
    }
    .timeline-cell {
        border-right: 1px solid #e2e8f0;
        border-bottom: 1px solid #e2e8f0;
        min-height: 76px;
        background: #ffffff;
    }
    .timeline-cell.weekend {
        background: #fafafb;
    }
    .timeline-cell.today {
        background: rgba(224, 242, 254, 0.2);
    }
    
    /* Bar allocation styling */
    .timeline-booking-bar {
        pointer-events: auto;
        margin: 14px 6px;
        padding: 8px 12px;
        border-radius: 8px;
        font-size: 0.72rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        z-index: 5;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        overflow: hidden;
        align-self: center;
    }
    .timeline-booking-bar:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        z-index: 9;
    }
    .timeline-booking-bar .bar-avatar {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.65rem;
        color: #ffffff;
        flex-shrink: 0;
        box-shadow: 0 1px 3px rgba(0,0,0,0.15);
    }
    
    /* Colors for booking bars */
    .theme-green {
        background: #e8fbf1 !important;
        border: 1px solid #a3e635 !important;
        border-left: 5px solid #22c55e !important;
        color: #14532d !important;
    }
    .theme-green .bar-avatar { background: #22c55e !important; }
    
    .theme-purple {
        background: #faf5ff !important;
        border: 1px solid #e9d5ff !important;
        border-left: 5px solid #a855f7 !important;
        color: #581c87 !important;
    }
    .theme-purple .bar-avatar { background: #a855f7 !important; }
    
    .theme-pink {
        background: #fff1f2 !important;
        border: 1px solid #fecdd3 !important;
        border-left: 5px solid #f43f5e !important;
        color: #881337 !important;
    }
    .theme-pink .bar-avatar { background: #f43f5e !important; }
    
    .theme-yellow {
        background: #fefce8 !important;
        border: 1px solid #fecdd3 !important;
        border-left: 5px solid #eab308 !important;
        color: #713f12 !important;
    }
    .theme-yellow .bar-avatar { background: #eab308 !important; }
    
    .theme-cyan {
        background: #ecfeff !important;
        border: 1px solid #cffafe !important;
        border-left: 5px solid #06b6d4 !important;
        color: #164e63 !important;
    }
    .theme-cyan .bar-avatar { background: #06b6d4 !important; }
</style>
@endpush

@section('content')
<!-- Header & Welcome section -->
<div class="row mb-4 align-items-center">
    <div class="col-md-8">
        <h2 class="fw-bold mb-1" style="color: #0f172a;">Dashboard</h2>
        <p class="text-muted mb-0">Selamat datang kembali, <span class="fw-semibold text-dark">{{ auth()->user()->name }}</span>. Berikut ringkasan performa operasional hotel Anda.</p>
    </div>
    <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <span class="badge bg-white text-dark shadow-sm px-3 py-2 border-0 rounded-pill">
            <i class="bi bi-calendar3 text-primary me-2"></i>
            {{ now()->translatedFormat('l, d F Y') }}
        </span>
    </div>
</div>

<!-- Stats Metrics - Row 1 -->
<div class="row g-3 mb-4">
    <!-- Total Bookings -->
    <div class="col-md-3">
        <div class="card card-hover h-100 shadow-sm border-0">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon stat-icon-primary me-3">
                    <i class="bi bi-calendar-check"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 text-uppercase fs-7 fw-bold" style="letter-spacing: 0.5px;">Total Bookings</h6>
                    <h3 class="fw-bold mb-0" style="color: #0f172a;">{{ $stats['total_bookings'] }}</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- Kamar Tersedia / Total -->
    <div class="col-md-3">
        <div class="card card-hover h-100 shadow-sm border-0">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon stat-icon-success me-3">
                    <i class="bi bi-door-open"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 text-uppercase fs-7 fw-bold" style="letter-spacing: 0.5px;">Kamar Tersedia</h6>
                    <h3 class="fw-bold mb-0" style="color: #0f172a;">{{ $stats['available_rooms'] }} <span class="fs-6 text-muted">/ {{ $stats['total_rooms'] }}</span></h3>
                </div>
            </div>
        </div>
    </div>
    <!-- Total Tamu -->
    <div class="col-md-3">
        <div class="card card-hover h-100 shadow-sm border-0">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon stat-icon-indigo me-3">
                    <i class="bi bi-people"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 text-uppercase fs-7 fw-bold" style="letter-spacing: 0.5px;">Total Tamu</h6>
                    <h3 class="fw-bold mb-0" style="color: #0f172a;">{{ $stats['total_guests'] }}</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- Occupancy Rate -->
    <div class="col-md-3">
        <div class="card card-hover h-100 shadow-sm border-0">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon stat-icon-info me-3">
                    <i class="bi bi-percent"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 text-uppercase fs-7 fw-bold" style="letter-spacing: 0.5px;">Tingkat Hunian</h6>
                    <h3 class="fw-bold mb-0 text-info">{{ $reports['occupancy_rate'] ?? 0 }}%</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Metrics - Row 2 -->
<div class="row g-3 mb-4">
    <!-- Monthly Revenue -->
    <div class="col-md-3">
        <div class="card card-hover h-100 shadow-sm border-0">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon stat-icon-success me-3">
                    <i class="bi bi-wallet2"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 text-uppercase fs-7 fw-bold" style="letter-spacing: 0.5px;">Pendapatan Bulan Ini</h6>
                    <h4 class="fw-bold mb-0 text-success" style="font-size: 1.25rem;">Rp {{ number_format($reports['monthly_revenue'] ?? 0, 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
    </div>
    <!-- Yearly Revenue -->
    <div class="col-md-3">
        <div class="card card-hover h-100 shadow-sm border-0">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon stat-icon-primary me-3">
                    <i class="bi bi-graph-up-arrow"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 text-uppercase fs-7 fw-bold" style="letter-spacing: 0.5px;">Pendapatan Tahun Ini</h6>
                    <h4 class="fw-bold mb-0 text-primary" style="font-size: 1.25rem;">Rp {{ number_format($reports['yearly_revenue'] ?? 0, 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
    </div>
    <!-- Pending Bookings -->
    <div class="col-md-3">
        <div class="card card-hover h-100 shadow-sm border-0">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon stat-icon-warning me-3">
                    <i class="bi bi-hourglass-split"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 text-uppercase fs-7 fw-bold" style="letter-spacing: 0.5px;">Booking Pending</h6>
                    <h3 class="fw-bold mb-0 text-warning">{{ $stats['pending_bookings'] ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- Restaurant Orders Pending -->
    <div class="col-md-3">
        <a href="{{ route('admin.restaurant.order.index') }}" class="text-decoration-none">
            <div class="card card-hover h-100 shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon stat-icon-purple me-3">
                        <i class="bi bi-egg-fried"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 text-uppercase fs-7 fw-bold" style="letter-spacing: 0.5px;">Pesanan Restoran</h6>
                        <h3 class="fw-bold mb-0 text-purple">{{ $stats['restaurant_orders'] ?? 0 }} <span class="fs-6 text-muted">pending</span></h3>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- Rooms Allocation Timeline Scheduler -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-0 py-3 d-flex align-items-center justify-content-between">
        <div>
            <h5 class="card-title fw-bold mb-0 text-slate-800" style="font-size: 1.1rem; color: #0f172a;"><i class="bi bi-calendar-range text-primary me-2"></i>Jadwal Alokasi Kamar (Timeline Booking)</h5>
            <small class="text-muted">Status alokasi kamar selama 14 hari ke depan</small>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill" style="font-size: 0.75rem;">
                <i class="bi bi-info-circle me-1 text-primary"></i> Geser horizontal untuk melihat jadwal penuh
            </span>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="timeline-scroll">
            <div class="timeline-grid">
                <!-- Date Headers -->
                <div class="timeline-room-header" style="grid-row: 1; grid-column: 1;">Kamar</div>
                @foreach($timeline_dates as $dateIndex => $date)
                    @php
                        $isToday = $date->isToday();
                        $isWeekend = $date->isWeekend();
                        $classes = '';
                        if ($isToday) $classes .= ' today';
                        if ($isWeekend) $classes .= ' weekend';
                    @endphp
                    <div class="timeline-day-header{{ $classes }}" style="grid-row: 1; grid-column: {{ 2 + $dateIndex }};">
                        <span class="day-name">{{ $date->translatedFormat('D') }}</span>
                        <span class="day-date">{{ $date->format('d/m') }}</span>
                    </div>
                @endforeach

                <!-- Room Types and Rooms -->
                @php
                    $gridRowIndex = 2;
                @endphp
                @foreach($room_types_timeline as $roomType)
                    <!-- Room Type Group Header -->
                    <div class="timeline-group-header" style="grid-row: {{ $gridRowIndex }}; grid-column: 1 / -1;">
                        <i class="bi bi-tag-fill text-primary"></i> <span class="fw-bold">{{ $roomType->name }} Rooms</span>
                    </div>
                    @php
                        $gridRowIndex++;
                    @endphp

                    @foreach($roomType->rooms as $room)
                        <!-- Room Row Grid Line -->
                        <div class="timeline-room-label" style="grid-row: {{ $gridRowIndex }}; grid-column: 1;">
                            <span class="room-title">Kamar {{ $room->room_number }}</span>
                            <span class="room-floor">Lantai {{ $room->floor }}</span>
                        </div>

                        <!-- Empty day cells for visual grid lines -->
                        @foreach($timeline_dates as $dateIndex => $date)
                            @php
                                $isToday = $date->isToday();
                                $isWeekend = $date->isWeekend();
                                $classes = '';
                                if ($isToday) $classes .= ' today';
                                if ($isWeekend) $classes .= ' weekend';
                            @endphp
                            <div class="timeline-cell{{ $classes }}" style="grid-row: {{ $gridRowIndex }}; grid-column: {{ 2 + $dateIndex }};"></div>
                        @endforeach

                        <!-- Booking bars overlay -->
                        @foreach($room->bookings as $booking)
                            @php
                                $checkIn = \Carbon\Carbon::parse($booking->check_in)->startOfDay();
                                $checkOut = \Carbon\Carbon::parse($booking->check_out)->startOfDay();
                                $startDateObj = \Carbon\Carbon::parse($timeline_dates[0])->startOfDay();
                                $endDateObj = \Carbon\Carbon::parse($timeline_dates[count($timeline_dates) - 1])->startOfDay()->addDay();
                                
                                // Check overlap
                                $overlaps = $checkOut->gt($startDateObj) && $checkIn->lt($endDateObj);
                            @endphp
                            @if($overlaps)
                                @php
                                    // Calculate grid columns
                                    if ($checkIn->lt($startDateObj)) {
                                        $startCol = 2;
                                    } else {
                                        $startCol = 2 + $startDateObj->diffInDays($checkIn);
                                    }

                                    if ($checkOut->gte($endDateObj)) {
                                        $endCol = 16;
                                    } else {
                                        $endCol = 2 + $startDateObj->diffInDays($checkOut);
                                    }

                                    if ($endCol <= $startCol) {
                                        $endCol = $startCol + 1;
                                    }

                                    // Hash class color
                                    $themes = ['theme-green', 'theme-purple', 'theme-pink', 'theme-yellow', 'theme-cyan'];
                                    $themeClass = $themes[$booking->id % count($themes)];
                                @endphp
                                <a href="{{ route('admin.bookings.show', $booking->id) }}" class="timeline-booking-bar {{ $themeClass }}" style="grid-row: {{ $gridRowIndex }}; grid-column: {{ $startCol }} / {{ $endCol }};" title="{{ $booking->guest->full_name }} ({{ $booking->number_of_guests }} Tamu)">
                                    <div class="bar-avatar">{{ strtoupper(substr($booking->guest->full_name, 0, 1)) }}</div>
                                    <span class="fw-bold text-truncate" style="max-width: 90px;">{{ $booking->guest->full_name }}</span>
                                    <span class="opacity-75 d-none d-md-inline" style="font-size: 0.65rem;">({{ $booking->number_of_guests }} Pax)</span>
                                </a>
                            @endif
                        @endforeach

                        @php
                            $gridRowIndex++;
                        @endphp
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Activity Data Tables Section -->
<div class="row g-4 mb-4">
    <!-- Recent Bookings Table -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 py-3 d-flex align-items-center justify-content-between">
                <h5 class="card-title fw-bold mb-0 text-slate-800" style="font-size: 1rem;">Booking Terbaru</h5>
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-sm btn-light text-primary fw-semibold px-3 rounded-pill">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-custom table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Tamu</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($recent_bookings as $booking)
                            <tr>
                                <td class="fw-semibold text-secondary">#{{ $booking->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-initials me-2">{{ strtoupper(substr($booking->guest->full_name, 0, 2)) }}</div>
                                        <div>
                                            <span class="fw-semibold text-dark">{{ $booking->guest->full_name }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($booking->status == 'confirmed')
                                        <span class="badge-premium badge-premium-success">Confirmed</span>
                                    @elseif($booking->status == 'pending')
                                        <span class="badge-premium badge-premium-warning">Pending</span>
                                    @elseif($booking->status == 'cancelled')
                                        <span class="badge-premium badge-premium-danger">Cancelled</span>
                                    @else
                                        <span class="badge-premium badge-premium-secondary">{{ ucfirst($booking->status) }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">Belum ada booking terbaru</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Payments Table -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 py-3 d-flex align-items-center justify-content-between">
                <h5 class="card-title fw-bold mb-0 text-slate-800" style="font-size: 1rem;">Pembayaran Terbaru</h5>
                <a href="{{ route('admin.payments.index') }}" class="btn btn-sm btn-light text-primary fw-semibold px-3 rounded-pill">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-custom table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Jumlah</th>
                                <th>Metode</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($recent_payments as $payment)
                            <tr>
                                <td class="fw-semibold text-secondary">#{{ $payment->booking_id }}</td>
                                <td class="fw-bold text-dark">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                <td>
                                    @if($payment->payment_method == 'midtrans')
                                        <span class="badge bg-primary-subtle text-primary border-0 px-2 py-1 font-monospace" style="font-size: 0.7rem; font-weight: 700;">MIDTRANS</span>
                                    @else
                                        <span class="text-uppercase text-secondary font-monospace" style="font-size: 0.75rem;">{{ $payment->payment_method }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($payment->payment_status == 'paid' || $payment->payment_status == 'success')
                                        <span class="badge-premium badge-premium-success">Lunas</span>
                                    @elseif($payment->payment_status == 'pending')
                                        <span class="badge-premium badge-premium-warning">Pending</span>
                                    @elseif($payment->payment_status == 'failed' || $payment->payment_status == 'expire' || $payment->payment_status == 'deny')
                                        <span class="badge-premium badge-premium-danger">Gagal</span>
                                    @else
                                        <span class="badge-premium badge-premium-secondary">{{ ucfirst($payment->payment_status) }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Belum ada pembayaran terbaru</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detailed Charts and Reports Section -->
<div class="row g-4 mt-1">
    <!-- Monthly Booking Trends Chart -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="card-title fw-bold mb-0 text-slate-800" style="font-size: 1rem;">Tren Booking & Pendapatan Bulanan</h5>
            </div>
            <div class="card-body">
                @if($reports['booking_trends']->count() > 0)
                    <div style="position: relative; height:240px; width:100%">
                        <canvas id="bookingTrendsChart"></canvas>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-bar-chart-line text-muted display-4 d-block mb-3"></i>
                        <p class="text-muted">Belum ada data tren booking</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Payment Methods Distribution Chart -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="card-title fw-bold mb-0 text-slate-800" style="font-size: 1rem;">Distribusi Metode Pembayaran</h5>
            </div>
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                @if($reports['payment_methods']->count() > 0)
                    <div style="position: relative; height:220px; width:100%; max-width:280px;">
                        <canvas id="paymentMethodsChart"></canvas>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-pie-chart text-muted display-4 d-block mb-3"></i>
                        <p class="text-muted">Belum ada data metode pembayaran</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
@if($reports['booking_trends']->count() > 0)
<script>
document.addEventListener("DOMContentLoaded", function() {
    const bookingCtx = document.getElementById('bookingTrendsChart').getContext('2d');
    
    const monthNames = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt", "Sep", "Okt", "Nov", "Des"];
    const rawLabels = {!! $reports['booking_trends']->pluck('month') !!};
    const labels = rawLabels.map(m => monthNames[m - 1] || m);
    
    new Chart(bookingCtx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Pendapatan',
                data: {!! $reports['booking_trends']->pluck('revenue') !!},
                backgroundColor: 'rgba(59, 130, 246, 0.85)',
                borderColor: '#3b82f6',
                borderWidth: 1,
                borderRadius: 8,
                hoverBackgroundColor: '#2563eb'
            }]
        },
        options: { 
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    padding: 12,
                    backgroundColor: '#0f172a',
                    titleFont: { size: 13, weight: 'bold', family: "'Inter', sans-serif" },
                    bodyFont: { size: 13, family: "'Inter', sans-serif" },
                    callbacks: {
                        label: function(context) {
                            let val = context.raw || 0;
                            return ' Pendapatan: Rp ' + new Intl.NumberFormat('id-ID').format(val);
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#f1f5f9'
                    },
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID', { notation: "compact" }).format(value);
                        },
                        color: '#64748b',
                        font: { family: "'Inter', sans-serif" }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#64748b',
                        font: { family: "'Inter', sans-serif" }
                    }
                }
            }
        }
    });
});
</script>
@endif

@if($reports['payment_methods']->count() > 0)
<script>
document.addEventListener("DOMContentLoaded", function() {
    const paymentCtx = document.getElementById('paymentMethodsChart').getContext('2d');
    
    const methodNames = {
        'cash': 'Tunai',
        'transfer': 'Transfer Bank',
        'credit_card': 'Kartu Kredit',
        'e_wallet': 'E-Wallet',
        'midtrans': 'Midtrans Gateway'
    };
    
    const rawLabels = {!! $reports['payment_methods']->pluck('payment_method')->toJson() !!};
    const labels = rawLabels.map(m => methodNames[m.toLowerCase()] || m.toUpperCase());
    
    new Chart(paymentCtx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: {!! $reports['payment_methods']->pluck('count') !!},
                backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'],
                borderWidth: 2,
                borderColor: '#ffffff'
            }]
        },
        options: { 
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 16,
                        color: '#475569',
                        font: { family: "'Inter', sans-serif", size: 12 }
                    }
                },
                tooltip: {
                    padding: 12,
                    backgroundColor: '#0f172a',
                    bodyFont: { family: "'Inter', sans-serif" },
                    callbacks: {
                        label: function(context) {
                            let total = context.dataset.data.reduce((a, b) => a + b, 0);
                            let val = context.raw || 0;
                            let pct = ((val / total) * 100).toFixed(1);
                            return ` ${context.label}: ${val} (${pct}%)`;
                        }
                    }
                }
            },
            cutout: '72%'
        }
    });
});
</script>
@endif
@endpush
@endsection