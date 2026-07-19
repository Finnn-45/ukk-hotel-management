<?php $__env->startSection('title', 'Booking Berhasil - StayEase'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .se-success-wrapper {
        min-height: calc(100vh - var(--nav-height) - 200px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        position: relative;
        overflow: hidden;
    }
    
    /* Animated background shapes */
    .se-success-bg {
        position: absolute;
        inset: 0;
        overflow: hidden;
        pointer-events: none;
    }
    .se-bg-shape {
        position: absolute;
        border-radius: 50%;
        opacity: 0.08;
        animation: floatShape 8s ease-in-out infinite;
    }
    .se-bg-shape.shape-1 {
        width: 300px;
        height: 300px;
        background: var(--primary);
        top: -100px;
        right: -50px;
        animation-delay: 0s;
    }
    .se-bg-shape.shape-2 {
        width: 200px;
        height: 200px;
        background: var(--success);
        bottom: -50px;
        left: -50px;
        animation-delay: 2s;
    }
    .se-bg-shape.shape-3 {
        width: 150px;
        height: 150px;
        background: var(--accent);
        top: 50%;
        left: 10%;
        animation-delay: 4s;
    }
    @keyframes floatShape {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(20px, -20px) scale(1.05); }
        66% { transform: translate(-15px, 15px) scale(0.95); }
    }
    
    .se-success-card {
        background: #fff;
        border-radius: var(--radius);
        box-shadow: var(--shadow-lg);
        max-width: 700px;
        width: 100%;
        overflow: hidden;
        position: relative;
        z-index: 1;
        animation: slideUp 0.6s ease-out;
    }
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .se-success-header {
        background: var(--primary-gradient);
        padding: 40px 30px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .se-success-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        opacity: 0.3;
    }
    .se-success-icon-wrapper {
        width: 80px;
        height: 80px;
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        border: 3px solid rgba(255,255,255,0.3);
        animation: pulse 2s ease-in-out infinite;
    }
    @keyframes pulse {
        0%, 100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(255,255,255,0.4); }
        50% { transform: scale(1.05); box-shadow: 0 0 0 15px rgba(255,255,255,0); }
    }
    .se-success-icon-wrapper i {
        font-size: 2.5rem;
        color: #fff;
    }
    .se-success-title {
        font-size: 1.75rem;
        font-weight: 800;
        color: #fff;
        margin-bottom: 8px;
        position: relative;
        z-index: 1;
    }
    .se-success-subtitle {
        color: rgba(255,255,255,0.9);
        font-size: 0.95rem;
        margin-bottom: 0;
        position: relative;
        z-index: 1;
    }
    
    .se-success-body {
        padding: 30px;
    }
    
    .se-booking-number {
        background: var(--primary-light);
        border-radius: var(--radius-sm);
        padding: 20px;
        text-align: center;
        margin-bottom: 24px;
        border: 2px dashed var(--primary);
    }
    .se-booking-number-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--primary);
        font-weight: 700;
        margin-bottom: 8px;
    }
    .se-booking-number-value {
        font-size: 2.5rem;
        font-weight: 900;
        color: var(--primary);
        letter-spacing: -1px;
    }
    
    .se-details-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }
    .se-detail-item {
        background: var(--bg);
        border-radius: var(--radius-sm);
        padding: 16px;
        transition: all 0.3s ease;
    }
    .se-detail-item:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }
    .se-detail-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-muted);
        font-weight: 600;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .se-detail-label i {
        color: var(--primary);
        font-size: 0.9rem;
    }
    .se-detail-value {
        font-size: 1rem;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 0;
    }
    .se-detail-item.full-width {
        grid-column: 1 / -1;
    }
    
    .se-total-highlight {
        background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
        border-radius: var(--radius-sm);
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        border-left: 4px solid #F59E0B;
    }
    .se-total-label {
        font-weight: 700;
        color: #92400E;
        font-size: 0.95rem;
    }
    .se-total-value {
        font-size: 1.75rem;
        font-weight: 900;
        color: #92400E;
        letter-spacing: -0.5px;
    }
    
    .se-info-box {
        background: var(--primary-light);
        border-radius: var(--radius-sm);
        padding: 16px;
        display: flex;
        gap: 12px;
        align-items: flex-start;
        margin-bottom: 24px;
        border-left: 4px solid var(--primary);
    }
    .se-info-box i {
        color: var(--primary);
        font-size: 1.25rem;
        margin-top: 2px;
        flex-shrink: 0;
    }
    .se-info-box p {
        margin: 0;
        color: var(--primary-dark);
        font-size: 0.9rem;
        line-height: 1.5;
    }
    
    .se-qr-section {
        text-align: center;
        padding: 20px;
        background: var(--bg);
        border-radius: var(--radius-sm);
        margin-bottom: 24px;
    }
    .se-qr-label {
        font-size: 0.8rem;
        color: var(--text-muted);
        margin-bottom: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }
    .se-qr-container {
        width: 120px;
        height: 120px;
        background: #fff;
        border: 2px dashed var(--border);
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        transition: all 0.3s ease;
    }
    .se-qr-container:hover {
        border-color: var(--primary);
        transform: scale(1.05);
    }
    .se-qr-container i {
        font-size: 3rem;
        color: var(--text-muted);
    }
    
    .se-hotel-info {
        background: linear-gradient(135deg, #0F172A 0%, #1E293B 100%);
        color: #fff;
        border-radius: var(--radius-sm);
        padding: 20px;
        margin-bottom: 24px;
    }
    .se-hotel-info i {
        color: var(--accent);
        font-size: 1.5rem;
    }
    .se-hotel-name {
        font-weight: 800;
        font-size: 1.05rem;
        margin-bottom: 4px;
    }
    .se-hotel-details {
        color: #94A3B8;
        font-size: 0.85rem;
        line-height: 1.6;
    }
    
    .se-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    .se-actions .btn-se {
        flex: 1;
        min-width: 140px;
        justify-content: center;
        padding: 14px 24px;
    }
    
    @media (max-width: 576px) {
        .se-success-header { padding: 30px 20px; }
        .se-success-title { font-size: 1.5rem; }
        .se-success-body { padding: 20px; }
        .se-details-grid { grid-template-columns: 1fr; }
        .se-booking-number-value { font-size: 2rem; }
        .se-total-highlight { flex-direction: column; text-align: center; gap: 8px; }
        .se-total-value { font-size: 1.5rem; }
        .se-actions { flex-direction: column; }
        .se-actions .btn-se { width: 100%; }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="se-success-wrapper">
    <div class="se-success-bg">
        <div class="se-bg-shape shape-1"></div>
        <div class="se-bg-shape shape-2"></div>
        <div class="se-bg-shape shape-3"></div>
    </div>
    
    <div class="se-success-card">
        <div class="se-success-header">
            <div class="se-success-icon-wrapper">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <h1 class="se-success-title">Booking Berhasil!</h1>
            <p class="se-success-subtitle">Terima kasih! Booking kamar Anda telah berhasil dibuat. Silakan lakukan pembayaran untuk mengkonfirmasi kamar.</p>
        </div>
        
        <div class="se-success-body">
            
            <div class="se-booking-number">
                <div class="se-booking-number-label">Nomor Booking</div>
                <div class="se-booking-number-value">#<?php echo e(str_pad($booking->id, 6, '0', STR_PAD_LEFT)); ?></div>
            </div>
            
            
            <div class="se-details-grid">
                <div class="se-detail-item">
                    <div class="se-detail-label">
                        <i class="bi bi-door-open"></i> Kamar
                    </div>
                    <p class="se-detail-value"><?php echo e($booking->room->room_number); ?> - <?php echo e($booking->room->roomType->name); ?></p>
                </div>
                <div class="se-detail-item">
                    <div class="se-detail-label">
                        <i class="bi bi-calendar-check"></i> Status
                    </div>
                    <p class="se-detail-value">
                        <span class="se-badge se-badge-warning"><?php echo e(ucfirst(str_replace('_', ' ', $booking->status))); ?></span>
                    </p>
                </div>
                <div class="se-detail-item">
                    <div class="se-detail-label">
                        <i class="bi bi-calendar-event"></i> Check In
                    </div>
                    <p class="se-detail-value"><?php echo e(\Carbon\Carbon::parse($booking->check_in)->format('d M Y')); ?></p>
                </div>
                <div class="se-detail-item">
                    <div class="se-detail-label">
                        <i class="bi bi-calendar-event"></i> Check Out
                    </div>
                    <p class="se-detail-value"><?php echo e(\Carbon\Carbon::parse($booking->check_out)->format('d M Y')); ?></p>
                </div>
                <div class="se-detail-item full-width">
                    <div class="se-total-highlight">
                        <div class="se-total-label">Total Pembayaran</div>
                        <div class="se-total-value">Rp <?php echo e(number_format($booking->total_price, 0, ',', '.')); ?></div>
                    </div>
                </div>
            </div>
            
            
            <?php if($booking->payment && $booking->payment->verification_code): ?>
            <div class="se-info-box" style="background:#ECFDF5;border-left:4px solid #10B981;">
                <i class="bi bi-shield-check" style="color:#10B981;"></i>
                <div>
                    <strong style="color:#065F46;">Kode Verifikasi Check-in</strong>
                    <p style="margin:4px 0 0 0;color:#047857;font-size:0.85rem;">Tunjukkan kode ini ke resepsionis saat check-in:</p>
                    <div style="font-size:1.75rem;font-weight:900;letter-spacing:0.3rem;color:#065F46;margin-top:6px;">
                        <?php echo e($booking->payment->verification_code); ?>

                    </div>
                </div>
            </div>
            <?php endif; ?>
            
            
            <div class="se-info-box">
                <i class="bi bi-info-circle-fill"></i>
                <p>Booking Anda telah dibuat dan kamar sedang dipesan untuk Anda. Silakan lakukan pembayaran segera untuk mengkonfirmasi booking dan mengamankan kamar Anda.</p>
            </div>
            
            
            <div class="se-qr-section">
                <div class="se-qr-label">Scan QR saat Check-in</div>
                <div class="se-qr-container">
                    <i class="bi bi-qr-code"></i>
                </div>
            </div>
            
            
            <div class="se-hotel-info">
                <div class="d-flex gap-3 align-items-start">
                    <i class="bi bi-building"></i>
                    <div>
                        <div class="se-hotel-name">Hotel StayEase Premium</div>
                        <div class="se-hotel-details">
                            Jl. Merdeka No. 123, Jakarta Pusat<br>
                            Tel: +62 123 4567 890 | WhatsApp: +62 123 4567 890
                        </div>
                    </div>
                </div>
            </div>
            
            
            <div class="se-actions">
                <a href="<?php echo e(route('customer.bookings')); ?>" class="btn-se btn-se-primary">
                    <i class="bi bi-calendar-check"></i> Lihat Booking Saya
                </a>
                <a href="<?php echo e(route('home')); ?>" class="btn-se btn-se-outline">
                    <i class="bi bi-house"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('customer.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ukk-hotel-management\resources\views/customer/booking-success.blade.php ENDPATH**/ ?>