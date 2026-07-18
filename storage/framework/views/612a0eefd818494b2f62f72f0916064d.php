<?php $__env->startSection('title', 'Pesanan Restoran Saya'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .se-order-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
        overflow: hidden;
        margin-bottom: 16px;
    }
    .se-order-card:hover {
        box-shadow: var(--shadow);
        transform: translateY(-2px);
    }
    .se-order-header {
        padding: 20px;
        border-bottom: 1px solid var(--border);
    }
    .se-order-body {
        padding: 20px;
    }
    .se-order-footer {
        padding: 16px 20px;
        border-top: 1px solid var(--border);
        background: var(--bg);
    }
    .se-order-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 8px 0;
    }
    .se-order-item-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: var(--primary-light);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    
    <div class="d-flex align-items-center gap-3 mb-4">
        <div class="bg-primary bg-opacity-10 p-3 rounded-2">
            <i class="bi bi-receipt text-primary fs-4"></i>
        </div>
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--text);">Pesanan Restoran Saya</h3>
            <p class="text-muted small mb-0" style="font-family:var(--font-alt);">Riwayat pesanan restoran Anda</p>
        </div>
    </div>

    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php
            $statusColors = [
                'pending' => ['bg' => '#FEF3C7', 'text' => '#D97706'],
                'preparing' => ['bg' => '#E0F2FE', 'text' => '#0369A1'],
                'ready' => ['bg' => '#E0F2FE', 'text' => '#0369A1'],
                'completed' => ['bg' => '#DCFCE7', 'text' => '#16A34A'],
                'cancelled' => ['bg' => '#FEE2E2', 'text' => '#DC2626'],
            ];
            $sc = $statusColors[$order->status] ?? ['bg' => '#F3F4F6', 'text' => '#6B7280'];
            $statusLabels = [
                'pending' => 'Menunggu',
                'preparing' => 'Disiapkan',
                'ready' => 'Siap',
                'completed' => 'Selesai',
                'cancelled' => 'Dibatalkan',
            ];
        ?>
        <div class="se-order-card">
            <div class="se-order-header">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                    <div>
                        <h5 class="fw-bold mb-1" style="color: var(--text);">#<?php echo e($order->order_number); ?></h5>
                        <small class="text-muted" style="font-family:var(--font-alt);">
                            <i class="bi bi-clock me-1"></i><?php echo e($order->created_at->format('d/m/Y H:i')); ?>

                        </small>
                    </div>
                    <span class="se-badge" style="background:<?php echo e($sc['bg']); ?>;color:<?php echo e($sc['text']); ?>;">
                        <?php echo e($statusLabels[$order->status] ?? ucfirst($order->status)); ?>

                    </span>
                </div>
            </div>

            <div class="se-order-body">
                <?php $__currentLoopData = $order->details->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="se-order-item">
                        <div class="se-order-item-icon">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div style="font-weight: 600; font-size: 0.95rem; color: var(--text);"><?php echo e($detail->menu->name); ?></div>
                            <small class="text-muted" style="font-family:var(--font-alt);">Qty: x<?php echo e($detail->quantity); ?></small>
                        </div>
                        <div class="fw-semibold" style="color: var(--text); font-size: 0.9rem;">
                            Rp <?php echo e(number_format($detail->price * $detail->quantity, 0, ',', '.')); ?>

                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if($order->details->count() > 3): ?>
                    <small class="text-muted ms-5" style="font-family:var(--font-alt);">+<?php echo e($order->details->count() - 3); ?> item lainnya</small>
                <?php endif; ?>
            </div>

            <div class="se-order-footer">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small" style="font-family:var(--font-alt);">
                            <i class="bi bi-<?php echo e($order->order_type === 'dine_in' ? 'building' : 'box'); ?> me-1"></i>
                            <?php echo e($order->order_type === 'dine_in' ? 'Dine In' : 'Takeaway'); ?>

                        </span>
                        <?php if($order->table_number): ?>
                            <span class="text-muted small ms-3" style="font-family:var(--font-alt);">
                                <i class="bi bi-door-open me-1"></i><?php echo e($order->table_number); ?>

                            </span>
                        <?php endif; ?>
                    </div>
                    <div class="text-end">
                        <div class="text-muted small" style="font-family:var(--font-alt);">Total</div>
                        <span class="fw-bold fs-5" style="color: var(--primary);">Rp <?php echo e(number_format($order->total_amount, 0, ',', '.')); ?></span>
                    </div>
                </div>
                <div class="d-grid gap-2 mt-3">
                    <a href="<?php echo e(route('customer.restaurant.order.detail', $order)); ?>" class="btn-se btn-se-primary" style="padding:10px 18px;font-size:0.85rem;">
                        <i class="bi bi-eye me-1"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="se-card-lg text-center py-5">
            <div class="py-4">
                <i class="bi bi-receipt display-1 text-muted d-block mb-3"></i>
                <h4 class="fw-bold" style="color: var(--text);">Belum Ada Pesanan</h4>
                <p class="text-muted mb-4" style="font-family:var(--font-alt);">Mulai pesan dari menu restaurant kami</p>
                <a href="<?php echo e(route('customer.restaurant.menu')); ?>" class="btn-se btn-se-primary">
                    <i class="bi bi-arrow-left me-2"></i> Lihat Menu
                </a>
            </div>
        </div>
    <?php endif; ?>

    <div class="mt-4">
        <?php echo e($orders->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('customer.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ukk-hotel-management\resources\views/customer/restaurant/orders.blade.php ENDPATH**/ ?>