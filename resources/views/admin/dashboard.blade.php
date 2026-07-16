@extends('admin.layouts.app')

@section('title', 'Dashboard')

@push('styles')
<style>
    :root {
        --primary: #0284C7;
        --primary-dark: #0369A1;
        --accent: #38BDF8;
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
    .text-purple { color: #7c3aed !important; }
    .stat-icon-purple { background: rgba(139, 92, 246, 0.1) !important; color: #7c3aed !important; }

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
    .timeline-scroll::-webkit-scrollbar { height: 8px; }
    .timeline-scroll::-webkit-scrollbar-track { background: #f8fafc; }
    .timeline-scroll::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 6px; }
    .timeline-grid {
        display: grid;
        grid-template-columns: minmax(180px, 1fr) repeat(14, minmax(100px, 1fr));
        min-width: 1580px;
        position: relative;
    }
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
    .timeline-day-header.weekend { background: #f1f5f9; }
    .timeline-day-header.today { background: #E0F2FE; border-bottom: 2px solid #0284C7; }
    .timeline-day-header.today .day-date { color: #0284C7; }
    .timeline-day-header .day-name {
        font-size: 0.65rem; color: #64748b; text-transform: uppercase;
        display: block; font-weight: 700; margin-bottom: 2px; letter-spacing: 0.5px;
    }
    .timeline-day-header .day-date { font-size: 0.95rem; font-weight: 700; color: #0f172a; }
    .timeline-room-header {
        position: sticky; left: 0; background: #f8fafc; z-index: 10;
        border-bottom: 2px solid #e2e8f0; border-right: 2px solid #e2e8f0;
        padding: 14px 16px; font-weight: 700; font-size: 0.75rem;
        text-transform: uppercase; letter-spacing: 1px; color: #475569;
        display: flex; align-items: center; box-shadow: 4px 0 8px -4px rgba(0,0,0,0.08);
    }
    .timeline-group-header {
        grid-column: 1 / -1; background: #f1f5f9;
        padding: 10px 16px; font-weight: 700; font-size: 0.8rem;
        color: #1e293b; border-bottom: 1px solid #cbd5e1; border-top: 1px solid #cbd5e1;
        letter-spacing: 0.5px; display: flex; align-items: center; gap: 8px;
        z-index: 6; position: sticky; left: 0;
    }
    .timeline-room-label {
        position: sticky; left: 0; background: #ffffff; z-index: 7;
        padding: 16px; font-weight: 600; color: #334155;
        border-right: 2px solid #e2e8f0; border-bottom: 1px solid #e2e8f0;
        display: flex; flex-direction: column; justify-content: center;
        box-shadow: 4px 0 8px -4px rgba(0,0,0,0.08);
    }
    .timeline-room-label .room-title { font-size: 0.85rem; font-weight: 700; color: #0f172a; }
    .timeline-room-label .room-floor { font-size: 0.7rem; color: #64748b; margin-top: 2px; font-weight: 500; }
    .timeline-cell {
        border-right: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0;
        min-height: 76px; background: #ffffff;
    }
    .timeline-cell.weekend { background: #fafafb; }
    .timeline-cell.today { background: rgba(224, 242, 254, 0.2); }
    .timeline-booking-bar {
        pointer-events: auto; margin: 14px 6px; padding: 8px 12px;
        border-radius: 8px; font-size: 0.72rem; font-weight: 600;
        display: flex; align-items: center; gap: 8px; z-index: 5;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none; overflow: hidden; align-self: center;
    }
    .timeline-booking-bar:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 6px 12px rgba(0,0,0,0.1); z-index: 9;
    }
    .timeline-booking-bar .bar-avatar {
        width: 22px; height: 22px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-weight: 700; font-size: 0.65rem; color: #ffffff;
        flex-shrink: 0; box-shadow: 0 1px 3px rgba(0,0,0,0.15);
    }
    .theme-green { background: #e8fbf1 !important; border: 1px solid #a3e635 !important; border-left: 5px solid #22c55e !important; color: #14532d !important; }
    .theme-green .bar-avatar { background: #22c55e !important; }
    .theme-purple { background: #faf5ff !important; border: 1px solid #e9d5ff !important; border-left: 5px solid #a855f7 !important; color: #581c87 !important; }
    .theme-purple .bar-avatar { background: #a855f7 !important; }
    .theme-pink { background: #fff1f2 !important; border: 1px solid #fecdd3 !important; border-left: 5px solid #f43f5e !important; color: #881337 !important; }
    .theme-pink .bar-avatar { background: #f43f5e !important; }
    .theme-yellow { background: #fefce8 !important; border: 1px solid #fecdd3 !important; border-left: 5px solid #eab308 !important; color: #713f12 !important; }
    .theme-yellow .bar-avatar { background: #eab308 !important; }
    .theme-cyan { background: #ecfeff !important; border: 1px solid #cffafe !important; border-left: 5px solid #06b6d4 !important; color: #164e63 !important; }
    .theme-cyan .bar-avatar { background: #06b6d4 !important; }
</style>
@endpush

@section('content')
<!-- Header -->
<div class="row mb-4 align-items-center">
    <div class="col-md-8">
        <h2 class="fw-bold mb-1" style="color: #334155;">Dashboard</h2>
        <p class="text-muted mb-0">Selamat datang kembali, <span class="fw-semibold text-dark">{{ auth()->user()->name }}</span>. Berikut ringkasan performa operasional hotel Anda.</p>
    </div>
    <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <span class="badge bg-white text-dark shadow-sm px-3 py-2 border-0 rounded-pill">
            <i class="bi bi-calendar3 text-primary me-2"></i>
            {{ now()->translatedFormat('l, d F Y') }}
        </span>
    </div>
</div>

{{-- ═══ STATS ROW 1 ═══ --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-hover h-100 shadow-sm border-0">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon stat-icon-primary me-3"><i class="bi bi-door-open"></i></div>
                <div>
                    <h6 class="text-muted mb-1 text-uppercase fs-7 fw-bold" style="letter-spacing:0.5px;font-size:0.72rem;">Total Kamar</h6>
                    <h3 class="fw-bold mb-0" style="color:#334155;">{{ $stats['total_rooms'] }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-hover h-100 shadow-sm border-0">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon stat-icon-danger me-3"><i class="bi bi-person-check"></i></div>
                <div>
                    <h6 class="text-muted mb-1 text-uppercase fs-7 fw-bold" style="letter-spacing:0.5px;font-size:0.72rem;">Kamar Terisi</h6>
                    <h3 class="fw-bold mb-0" style="color:#334155;">{{ $stats['occupied_rooms'] }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-hover h-100 shadow-sm border-0">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon stat-icon-success me-3"><i class="bi bi-door-closed"></i></div>
                <div>
                    <h6 class="text-muted mb-1 text-uppercase fs-7 fw-bold" style="letter-spacing:0.5px;font-size:0.72rem;">Kamar Kosong</h6>
                    <h3 class="fw-bold mb-0" style="color:#334155;">{{ $stats['available_rooms'] }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-hover h-100 shadow-sm border-0">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon stat-icon-info me-3"><i class="bi bi-percent"></i></div>
                <div>
                    <h6 class="text-muted mb-1 text-uppercase fs-7 fw-bold" style="letter-spacing:0.5px;font-size:0.72rem;">Okupansi</h6>
                    <h3 class="fw-bold mb-0" style="color:#334155;">{{ $reports['occupancy_rate'] }}%</h3>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ═══ STATS ROW 2 ═══ --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-hover h-100 shadow-sm border-0">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon stat-icon-warning me-3"><i class="bi bi-calendar-check"></i></div>
                <div>
                    <h6 class="text-muted mb-1 text-uppercase fs-7 fw-bold" style="letter-spacing:0.5px;font-size:0.72rem;">Booking Hari Ini</h6>
                    <h3 class="fw-bold mb-0" style="color:#334155;">{{ $stats['today_bookings'] }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-hover h-100 shadow-sm border-0">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon stat-icon-purple me-3"><i class="bi bi-egg-fried"></i></div>
                <div>
                    <h6 class="text-muted mb-1 text-uppercase fs-7 fw-bold" style="letter-spacing:0.5px;font-size:0.72rem;">Pesanan Resto Hari Ini</h6>
                    <h3 class="fw-bold mb-0" style="color:#334155;">{{ $stats['today_restaurant_orders'] }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-hover h-100 shadow-sm border-0">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon stat-icon-success me-3"><i class="bi bi-cash-stack"></i></div>
                <div>
                    <h6 class="text-muted mb-1 text-uppercase fs-7 fw-bold" style="letter-spacing:0.5px;font-size:0.72rem;">Pendapatan Hari Ini</h6>
                    <h4 class="fw-bold mb-0 text-success" style="font-size:1.1rem;">Rp {{ number_format($stats['today_revenue'], 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-hover h-100 shadow-sm border-0">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon stat-icon-primary me-3"><i class="bi bi-wallet2"></i></div>
                <div>
                    <h6 class="text-muted mb-1 text-uppercase fs-7 fw-bold" style="letter-spacing:0.5px;font-size:0.72rem;">Pendapatan Bulan Ini</h6>
                    <h4 class="fw-bold mb-0 text-primary" style="font-size:1.1rem;">Rp {{ number_format($reports['monthly_revenue'], 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ═══ CHARTS ═══ --}}
<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="card-title fw-bold mb-0" style="font-size:1rem;color:#334155;"><i class="bi bi-bar-chart-line text-primary me-2"></i>Pendapatan 7 Hari Terakhir</h5>
            </div>
            <div class="card-body">
                <div style="position:relative;height:220px;width:100%;">
                    <canvas id="weeklyRevenueChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="card-title fw-bold mb-0" style="font-size:1rem;color:#334155;"><i class="bi bi-pie-chart text-primary me-2"></i>Distribusi Metode Pembayaran</h5>
            </div>
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                @if($reports['payment_methods']->count() > 0)
                    <div style="position:relative;height:200px;width:100%;max-width:260px;">
                        <canvas id="paymentMethodsChart"></canvas>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-pie-chart text-muted display-4 d-block mb-3"></i>
                        <p class="text-muted">Belum ada data</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- ═══ BOOKING TIMELINE ═══ --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-0 py-3 d-flex align-items-center justify-content-between">
        <div>
            <h5 class="card-title fw-bold mb-0" style="font-size:1.1rem;color:#334155;"><i class="bi bi-calendar-range text-primary me-2"></i>Jadwal Alokasi Kamar</h5>
            <small class="text-muted">Status alokasi kamar selama 14 hari ke depan</small>
        </div>
        <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill" style="font-size:0.75rem;">
            <i class="bi bi-info-circle me-1 text-primary"></i> Geser untuk jadwal penuh
        </span>
    </div>
    <div class="card-body p-0">
        <div class="timeline-scroll">
            <div class="timeline-grid">
                <div class="timeline-room-header" style="grid-row:1;grid-column:1;">Kamar</div>
                @foreach($timeline_dates as $dateIndex => $date)
                    @php
                        $isToday = $date->isToday();
                        $isWeekend = $date->isWeekend();
                        $classes = '';
                        if ($isToday) $classes .= ' today';
                        if ($isWeekend) $classes .= ' weekend';
                    @endphp
                    <div class="timeline-day-header{{ $classes }}" style="grid-row:1;grid-column:{{ 2 + $dateIndex }};">
                        <span class="day-name">{{ $date->translatedFormat('D') }}</span>
                        <span class="day-date">{{ $date->format('d/m') }}</span>
                    </div>
                @endforeach

                @php $gridRowIndex = 2; @endphp
                @foreach($room_types_timeline as $roomType)
                    <div class="timeline-group-header" style="grid-row:{{ $gridRowIndex }};grid-column:1/-1;">
                        <i class="bi bi-tag-fill text-primary"></i> <span class="fw-bold">{{ $roomType->name }} Rooms</span>
                    </div>
                    @php $gridRowIndex++; @endphp
                    @foreach($roomType->rooms as $room)
                        <div class="timeline-room-label" style="grid-row:{{ $gridRowIndex }};grid-column:1;">
                            <span class="room-title">Kamar {{ $room->room_number }}</span>
                            <span class="room-floor">Lantai {{ $room->floor }}</span>
                        </div>
                        @foreach($timeline_dates as $dateIndex => $date)
                            @php
                                $isToday = $date->isToday();
                                $isWeekend = $date->isWeekend();
                                $classes = '';
                                if ($isToday) $classes .= ' today';
                                if ($isWeekend) $classes .= ' weekend';
                            @endphp
                            <div class="timeline-cell{{ $classes }}" style="grid-row:{{ $gridRowIndex }};grid-column:{{ 2 + $dateIndex }};"></div>
                        @endforeach
                        @foreach($room->bookings as $booking)
                            @php
                                $checkIn = \Carbon\Carbon::parse($booking->check_in)->startOfDay();
                                $checkOut = \Carbon\Carbon::parse($booking->check_out)->startOfDay();
                                $startDateObj = \Carbon\Carbon::parse($timeline_dates[0])->startOfDay();
                                $endDateObj = \Carbon\Carbon::parse($timeline_dates[count($timeline_dates)-1])->startOfDay()->addDay();
                                $overlaps = $checkOut->gt($startDateObj) && $checkIn->lt($endDateObj);
                            @endphp
                            @if($overlaps)
                                @php
                                    $startCol = $checkIn->lt($startDateObj) ? 2 : 2 + $startDateObj->diffInDays($checkIn);
                                    $endCol = $checkOut->gte($endDateObj) ? 16 : 2 + $startDateObj->diffInDays($checkOut);
                                    if ($endCol <= $startCol) $endCol = $startCol + 1;
                                    $themes = ['theme-green','theme-purple','theme-pink','theme-yellow','theme-cyan'];
                                    $themeClass = $themes[$booking->id % count($themes)];
                                @endphp
                                <a href="{{ route('admin.bookings.show', $booking->id) }}" class="timeline-booking-bar {{ $themeClass }}" style="grid-row:{{ $gridRowIndex }};grid-column:{{ $startCol }}/{{ $endCol }};" title="{{ $booking->guest->full_name }} ({{ $booking->number_of_guests }} Tamu)">
                                    <div class="bar-avatar">{{ strtoupper(substr($booking->guest->full_name, 0, 1)) }}</div>
                                    <span class="fw-bold text-truncate" style="max-width:90px;">{{ $booking->guest->full_name }}</span>
                                    <span class="opacity-75 d-none d-md-inline" style="font-size:0.65rem;">({{ $booking->number_of_guests }} Pax)</span>
                                </a>
                            @endif
                        @endforeach
                        @php $gridRowIndex++; @endphp
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- ═══ BOOKING + RESTAURANT TABLES ═══ --}}
<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 py-3 d-flex align-items-center justify-content-between">
                <h5 class="card-title fw-bold mb-0" style="font-size:1rem;color:#334155;"><i class="bi bi-calendar-check text-primary me-2"></i>Booking Terbaru</h5>
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-sm btn-light text-primary fw-semibold px-3 rounded-pill">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-custom table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Kamar</th>
                                <th>Check In</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($recent_bookings as $booking)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-initials me-2">{{ strtoupper(substr($booking->guest->full_name ?? '?', 0, 2)) }}</div>
                                        <span class="fw-semibold text-dark">{{ $booking->guest->full_name ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td class="fw-semibold">{{ $booking->room->room_number ?? '-' }} - {{ $booking->room->roomType->name ?? '-' }}</td>
                                <td>{{ $booking->check_in ? \Carbon\Carbon::parse($booking->check_in)->format('d/m') : '-' }}</td>
                                <td>
                                    @if($booking->status == 'confirmed' || $booking->status == 'checked_in')
                                        <span class="badge-premium badge-premium-success">{{ ucfirst($booking->status) }}</span>
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
                            <tr><td colspan="4" class="text-center text-muted py-4">Belum ada booking terbaru</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 py-3 d-flex align-items-center justify-content-between">
                <h5 class="card-title fw-bold mb-0" style="font-size:1rem;color:#334155;"><i class="bi bi-egg-fried text-primary me-2"></i>Pesanan Restoran Terbaru</h5>
                <a href="{{ route('admin.restaurant.order.index') }}" class="btn btn-sm btn-light text-primary fw-semibold px-3 rounded-pill">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-custom table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Pemesan</th>
                                <th>Menu</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($recent_restaurant_orders as $order)
                            <tr>
                                <td class="fw-semibold">{{ $order->guest->full_name ?? 'N/A' }}</td>
                                <td>
                                    @if($order->details->count() > 0)
                                        {{ $order->details->first()->menu->name ?? '-' }}
                                        @if($order->details->count() > 1)
                                            <span class="text-muted">+{{ $order->details->count()-1 }} lainnya</span>
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="fw-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                <td>
                                    @php
                                        $statusColors = [
                                            'pending' => 'warning', 'preparing' => 'info',
                                            'ready' => 'info', 'completed' => 'success', 'cancelled' => 'danger'
                                        ];
                                        $sc = $statusColors[$order->status] ?? 'secondary';
                                    @endphp
                                    <span class="badge-premium badge-premium-{{ $sc }}">{{ ucfirst($order->status) }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center text-muted py-4">Belum ada pesanan restoran</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ═══ STATUS KAMAR + REVIEW ═══ --}}
<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="card-title fw-bold mb-0" style="font-size:1rem;color:#334155;"><i class="bi bi-grid-3x3-gap text-primary me-2"></i>Status Kamar</h5>
            </div>
            <div class="card-body">
                <div class="d-flex gap-3 mb-3 flex-wrap">
                    <span><span style="display:inline-block;width:12px;height:12px;border-radius:50%;background:#16A34A;"></span> Kosong</span>
                    <span><span style="display:inline-block;width:12px;height:12px;border-radius:50%;background:#DC2626;"></span> Terisi</span>
                    <span><span style="display:inline-block;width:12px;height:12px;border-radius:50%;background:#D97706;"></span> Cleaning</span>
                    <span><span style="display:inline-block;width:12px;height:12px;border-radius:50%;background:#64748B;"></span> Maintenance</span>
                </div>
                <div class="room-status-grid">
                    @forelse($rooms as $room)
                        @php
                            $statusClass = match($room->status) {
                                'available' => 'room-available',
                                'occupied' => 'room-occupied',
                                'cleaning' => 'room-cleaning',
                                'maintenance' => 'room-maintenance',
                                default => 'room-available'
                            };
                        @endphp
                        <div class="room-status-item {{ $statusClass }}" title="Kamar {{ $room->room_number }} - {{ $room->status }}">
                            {{ $room->room_number }}
                        </div>
                    @empty
                        <div class="col-12 text-center text-muted py-3">Tidak ada data kamar</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="card-title fw-bold mb-0" style="font-size:1rem;color:#334155;"><i class="bi bi-star text-primary me-2"></i>Review Terbaru</h5>
            </div>
            <div class="card-body">
                @forelse($recent_reviews as $review)
                    <div class="d-flex align-items-start gap-3 mb-3 pb-3" style="border-bottom:1px solid #F1F5F9;">
                        <div class="avatar-initials" style="width:36px;height:36px;font-size:0.7rem;">{{ strtoupper(substr($review->user->name ?? '?', 0, 2)) }}</div>
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <strong style="font-size:0.85rem;">{{ $review->user->name ?? 'Anonim' }}</strong>
                                <span class="text-warning" style="font-size:0.75rem;">
                                    @for($i=1;$i<=5;$i++)
                                        @if($i<=$review->rating)<i class="bi bi-star-fill"></i>@else<i class="bi bi-star"></i>@endif
                                    @endfor
                                </span>
                            </div>
                            <p class="text-muted mb-0" style="font-size:0.82rem;font-style:italic;">"{{ $review->message ?? $review->review ?? '-' }}"</p>
                            <small class="text-muted" style="font-size:0.7rem;">{{ $review->created_at ? $review->created_at->diffForHumans() : '' }}</small>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4">
                        <i class="bi bi-star text-muted display-5 d-block mb-2"></i>
                        <p class="text-muted">Belum ada review</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- ═══ QUICK ACTIONS + ACTIVITIES ═══ --}}
<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="card-title fw-bold mb-0" style="font-size:1rem;color:#334155;"><i class="bi bi-lightning-charge text-primary me-2"></i>Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-6">
                        <a href="{{ route('admin.bookings.create') }}" class="quick-action-btn"><i class="bi bi-plus-circle text-primary"></i> Tambah Booking</a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.rooms.create') }}" class="quick-action-btn"><i class="bi bi-plus-circle text-success"></i> Tambah Kamar</a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.restaurant.menu.create') }}" class="quick-action-btn"><i class="bi bi-plus-circle text-warning"></i> Tambah Menu</a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.verify.booking.form') }}" class="quick-action-btn"><i class="bi bi-qr-code-scan text-danger"></i> Verifikasi Check-in</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="card-title fw-bold mb-0" style="font-size:1rem;color:#334155;"><i class="bi bi-clock-history text-primary me-2"></i>Aktivitas Terbaru</h5>
            </div>
            <div class="card-body">
                @forelse($recent_activities as $activity)
                    <div class="activity-item">
                        <div class="activity-dot" style="background:var(--primary);"></div>
                        <div class="flex-grow-1">
                            <div style="font-size:0.85rem;color:#334155;">{{ $activity->description ?? $activity->activity ?? '-' }}</div>
                            <div class="activity-time">{{ $activity->created_at ? $activity->created_at->diffForHumans() : '' }}</div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4">
                        <i class="bi bi-activity text-muted display-5 d-block mb-2"></i>
                        <p class="text-muted">Belum ada aktivitas terbaru</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Weekly Revenue Chart
    const weeklyCtx = document.getElementById('weeklyRevenueChart');
    if(weeklyCtx) {
        const ctx = weeklyCtx.getContext('2d');
        const days = {!! json_encode($reports['weekly_days']) !!};
        const revenues = {!! json_encode($reports['weekly_revenue']) !!};
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: days,
                datasets: [{
                    label: 'Pendapatan',
                    data: revenues,
                    borderColor: '#0284C7',
                    backgroundColor: 'rgba(2,132,199,0.1)',
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#0284C7',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        padding: 12,
                        backgroundColor: '#0f172a',
                        callbacks: {
                            label: function(context) {
                                return ' Rp ' + new Intl.NumberFormat('id-ID').format(context.raw || 0);
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f1f5f9' },
                        ticks: {
                            callback: function(v) { return 'Rp' + new Intl.NumberFormat('id-ID', {notation:"compact"}).format(v); },
                            color: '#64748b',
                            font: { family: "'Inter', sans-serif" }
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#64748b', font: { family: "'Inter', sans-serif" } }
                    }
                }
            }
        });
    }

    // Payment Methods Chart
    @if($reports['payment_methods']->count() > 0)
    const paymentCtx = document.getElementById('paymentMethodsChart');
    if(paymentCtx) {
        const ctx2 = paymentCtx.getContext('2d');
        const methodNames = {
            'cash': 'Tunai', 'transfer': 'Transfer Bank',
            'credit_card': 'Kartu Kredit', 'e_wallet': 'E-Wallet', 'midtrans': 'Midtrans'
        };
        const rawLabels = {!! $reports['payment_methods']->pluck('payment_method')->toJson() !!};
        const labels = rawLabels.map(m => methodNames[m.toLowerCase()] || m.toUpperCase());
        
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: {!! $reports['payment_methods']->pluck('count') !!},
                    backgroundColor: ['#0284C7', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'],
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
                        labels: { padding: 14, color: '#475569', font: { family: "'Inter', sans-serif", size: 11 } }
                    },
                    tooltip: {
                        padding: 12,
                        backgroundColor: '#0f172a',
                        callbacks: {
                            label: function(context) {
                                let total = context.dataset.data.reduce((a,b) => a+b, 0);
                                let pct = ((context.raw / total) * 100).toFixed(1);
                                return ' ' + context.label + ': ' + context.raw + ' (' + pct + '%)';
                            }
                        }
                    }
                },
                cutout: '72%'
            }
        });
    }
    @endif
});
</script>
@endpush
@endsection