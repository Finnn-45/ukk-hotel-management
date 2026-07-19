<?php $__env->startSection('title', 'Booking Saya - StayEase'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .se-booking-status {
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.72rem;
        font-weight: 700;
        font-family: var(--font-alt);
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <nav aria-label="breadcrumb" class="se-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Beranda</a></li>
            <li class="breadcrumb-item active">Booking Saya</li>
        </ol>
    </nav>

    <div class="d-flex align-items-center gap-3 mb-4">
        <div class="bg-primary bg-opacity-10 p-3 rounded-2">
            <i class="bi bi-calendar-check text-primary fs-4"></i>
        </div>
        <div>
            <h3 class="fw-bold mb-1">Booking Saya</h3>
            <p class="text-muted small mb-0" style="font-family:var(--font-alt);">Kelola semua booking hotel Anda</p>
        </div>
    </div>

    
    <div class="d-flex gap-2 mb-4 flex-wrap">
        <button class="btn-se btn-se-primary btn-sm" style="padding:8px 18px;font-size:0.78rem;">Semua</button>
        <button class="btn-se btn-se-outline btn-sm" style="padding:8px 18px;font-size:0.78rem;">Aktif</button>
        <button class="btn-se btn-se-outline btn-sm" style="padding:8px 18px;font-size:0.78rem;">Selesai</button>
        <button class="btn-se btn-se-outline btn-sm" style="padding:8px 18px;font-size:0.78rem;">Dibatalkan</button>
    </div>

    <?php if($bookings->count() > 0): ?>
        <div class="row g-3">
            <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $statusColors = [
                        'pending' => ['bg' => '#FEF3C7', 'text' => '#D97706'],
                        'confirmed' => ['bg' => '#E0F2FE', 'text' => '#0369A1'],
                        'checked_in' => ['bg' => '#DCFCE7', 'text' => '#16A34A'],
                        'checked_out' => ['bg' => '#F3F4F6', 'text' => '#6B7280'],
                        'completed' => ['bg' => '#DCFCE7', 'text' => '#16A34A'],
                        'cancelled' => ['bg' => '#FEE2E2', 'text' => '#DC2626'],
                    ];
                    $sc = $statusColors[$booking->status] ?? ['bg' => '#F3F4F6', 'text' => '#6B7280'];
                ?>
                <div class="col-md-6">
                    <div class="se-card-lg">
                        <div class="p-3 p-md-4">
                            
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="d-flex gap-3">
                                    <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=100&q=80"
                                         style="width:56px;height:56px;border-radius:12px;object-fit:cover;" alt="Room">
                                    <div>
                                        <h5 class="fw-bold mb-1" style="font-size:1rem;"><?php echo e($booking->room->room_number); ?></h5>
                                        <div class="small text-muted" style="font-family:var(--font-alt);"><?php echo e($booking->room->roomType->name); ?></div>
                                    </div>
                                </div>
                                <span class="se-booking-status" style="background:<?php echo e($sc['bg']); ?>;color:<?php echo e($sc['text']); ?>;">
                                    <?php echo e(ucfirst(str_replace('_', ' ', $booking->status))); ?>

                                </span>
                            </div>

                            
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <div class="small text-muted" style="font-family:var(--font-alt);">
                                        <i class="bi bi-calendar me-1"></i> Check In
                                    </div>
                                    <div class="fw-semibold small"><?php echo e(\Carbon\Carbon::parse($booking->check_in)->format('d M Y')); ?></div>
                                </div>
                                <div class="col-6">
                                    <div class="small text-muted" style="font-family:var(--font-alt);">
                                        <i class="bi bi-calendar me-1"></i> Check Out
                                    </div>
                                    <div class="fw-semibold small"><?php echo e(\Carbon\Carbon::parse($booking->check_out)->format('d M Y')); ?></div>
                                </div>
                                <div class="col-6">
                                    <div class="small text-muted" style="font-family:var(--font-alt);">
                                        <i class="bi bi-people me-1"></i> Tamu
                                    </div>
                                    <div class="fw-semibold small"><?php echo e($booking->number_of_guests); ?> orang</div>
                                </div>
                                <div class="col-6">
                                    <div class="small text-muted" style="font-family:var(--font-alt);">
                                        <i class="bi bi-cash me-1"></i> Total
                                    </div>
                                    <div class="fw-bold text-primary small">Rp <?php echo e(number_format($booking->total_price, 0, ',', '.')); ?></div>
                                </div>
                            </div>

                            
                            <?php if($booking->payment): ?>
                            <div class="d-flex justify-content-between align-items-center py-2 border-top" style="border-color:var(--border) !important;">
                                <div class="small text-muted" style="font-family:var(--font-alt);">
                                    <i class="bi bi-credit-card me-1"></i> <?php echo e(ucfirst(str_replace('_', ' ', $booking->payment->payment_method))); ?>

                                </div>
                                <span class="se-badge <?php echo e($booking->payment->payment_status === 'paid' ? 'se-badge-success' : 'se-badge-warning'); ?>">
                                    <?php echo e(ucfirst($booking->payment->payment_status)); ?>

                                </span>
                            </div>
                            <?php endif; ?>

                            
                            <div class="d-flex gap-2 mt-3 pt-3 border-top" style="border-color:var(--border) !important;">
                                <a href="<?php echo e(route('customer.booking.detail', $booking)); ?>" class="btn-se btn-se-outline flex-grow-1" style="padding:8px 14px;font-size:0.78rem;">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                <?php if(in_array($booking->status, ['pending', 'confirmed'])): ?>
                                    <?php if(!$booking->payment || $booking->payment->payment_status !== 'paid'): ?>
                                        <button id="payButton-<?php echo e($booking->id); ?>" class="btn-se btn-se-primary flex-grow-1" style="padding:8px 14px;font-size:0.78rem;">
                                            <i class="bi bi-credit-card"></i> Bayar
                                        </button>
                                    <?php endif; ?>
                                    <form action="<?php echo e(route('customer.booking.cancel', $booking)); ?>" method="POST" onsubmit="return confirm('Yakin ingin membatalkan booking ini?')" class="flex-grow-1">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn-se btn-se-outline w-100" style="color:#EF4444;border-color:#FEE2E2;padding:8px 14px;font-size:0.78rem;">
                                            <i class="bi bi-x-circle"></i> Batalkan
                                        </button>
                                    </form>
                                <?php endif; ?>
                                <?php if($booking->status === 'checked_in'): ?>
                                    <form action="<?php echo e(route('customer.booking.checkout', $booking)); ?>" method="POST" onsubmit="return confirm('Check-out dari kamar ini?')" class="flex-grow-1">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn-se btn-se-primary w-100" style="padding:8px 14px;font-size:0.78rem;">
                                            <i class="bi bi-box-arrow-right"></i> Check Out
                                        </button>
                                    </form>
                                <?php endif; ?>
                                <?php if($booking->status === 'checked_out' && !$booking->review): ?>
                                    <a href="<?php echo e(route('customer.booking.review', $booking)); ?>" class="btn-se btn-se-outline flex-grow-1" style="padding:8px 14px;font-size:0.78rem;">
                                        <i class="bi bi-star"></i> Review
                                    </a>
                                <?php endif; ?>
                            </div>

                            
                            <?php if($booking->review): ?>
                            <div class="mt-3 pt-3 border-top" style="border-color:var(--border) !important;">
                                <div class="d-flex align-items-center gap-2">
                                    <?php for($i=1;$i<=5;$i++): ?>
                                        <i class="bi bi-star<?php echo e($i <= $booking->review->rating ? '-fill' : ''); ?>" style="color:var(--accent);font-size:0.8rem;"></i>
                                    <?php endfor; ?>
                                    <span class="small text-muted">(<?php echo e($booking->review->rating); ?>/5)</span>
                                </div>
                                <?php if($booking->review->review): ?>
                                    <p class="small text-muted mt-1 mb-0" style="font-family:var(--font-alt);">"<?php echo e($booking->review->review); ?>"</p>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="mt-4">
            <?php echo e($bookings->links()); ?>

        </div>
    <?php else: ?>
        <div class="se-card-lg text-center py-5">
            <div class="py-4">
                <i class="bi bi-calendar-x display-1 text-muted d-block mb-3"></i>
                <h4 class="fw-bold">Belum Ada Booking</h4>
                <p class="text-muted mb-4" style="font-family:var(--font-alt);">Anda belum melakukan booking kamar apapun.</p>
                <a href="<?php echo e(route('rooms.index')); ?>" class="btn-se btn-se-primary">
                    <i class="bi bi-search me-2"></i> Cari Kamar
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    <?php if(isset($bookings) && $bookings->count() > 0): ?>
    <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(in_array($b->status, ['pending', 'confirmed']) && (!$b->payment || $b->payment->payment_status !== 'paid')): ?>
        document.getElementById('payButton-<?php echo e($b->id); ?>')?.addEventListener('click', function() {
            const bookingId = <?php echo e($b->id); ?>;
            const amount = <?php echo e($b->total_price); ?>;
            const payBtn = document.getElementById('payButton-<?php echo e($b->id); ?>');

            payBtn.disabled = true;
            payBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Memuat...';

            fetch(`/payment/midtrans/${bookingId}/token`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json().then(data => ({ response, data })))
            .then(({ response, data }) => {
                if (response.ok && data.token) {
                    if (typeof window.snap !== 'undefined') {
                        window.snap.pay(data.token, {
                            onSuccess: function(result) {
                                window.location.href = '/payment/midtrans/success?order_id=' + result.order_id + '&status_code=200';
                            },
                            onPending: function(result) {
                                window.location.href = '/payment/midtrans/pending?order_id=' + result.order_id;
                            },
                            onError: function(result) {
                                window.location.href = '/payment/midtrans/error';
                            },
                            onClose: function() {
                                payBtn.disabled = false;
                                payBtn.innerHTML = '<i class="bi bi-credit-card"></i> Bayar Sekarang';
                            }
                        });
                    } else {
                        alert('Midtrans SDK belum dimuat. Silakan refresh halaman.');
                        payBtn.disabled = false;
                        payBtn.innerHTML = '<i class="bi bi-credit-card"></i> Bayar Sekarang';
                    }
                } else {
                    alert(data.message || 'Gagal memuat pembayaran. Silakan coba lagi.');
                    payBtn.disabled = false;
                    payBtn.innerHTML = '<i class="bi bi-credit-card"></i> Bayar Sekarang';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan koneksi. Silakan coba lagi.');
                payBtn.disabled = false;
                payBtn.innerHTML = '<i class="bi bi-credit-card"></i> Bayar Sekarang';
            });
        });
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('customer.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ukk-hotel-management\resources\views/customer/my-bookings.blade.php ENDPATH**/ ?>