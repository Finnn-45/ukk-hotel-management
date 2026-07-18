<?php $__env->startSection('title', 'Detail Pesanan #' . $order->order_number); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .se-order-detail-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
    }
    .se-order-detail-card .card-header {
        background: var(--bg-card);
        border-bottom: 1px solid var(--border);
        padding: 16px 20px;
    }
    .se-order-detail-card .card-body {
        padding: 20px;
    }
    .se-summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }
    .se-summary-item .label {
        color: var(--text-muted);
        font-size: 0.9rem;
        font-family: var(--font-alt);
    }
    .se-summary-item .value {
        font-weight: 600;
        color: var(--text);
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    
    <div class="d-flex align-items-center gap-3 mb-4 flex-wrap justify-content-between">
        <div class="d-flex align-items-center gap-3">
            <div class="p-3 rounded-2" style="background: var(--primary-light);">
                <i class="bi bi-receipt fs-4" style="color: var(--primary);"></i>
            </div>
            <div>
                <h3 class="fw-bold mb-1" style="color: var(--text);">Detail Pesanan #<?php echo e($order->order_number); ?></h3>
                <p class="text-muted small mb-0" style="font-family:var(--font-alt);">Informasi lengkap pesanan restoran Anda</p>
            </div>
        </div>
        <a href="<?php echo e(route('customer.restaurant.orders')); ?>" class="btn-se btn-se-outline" style="padding:10px 20px;font-size:0.85rem;">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-8 col-md-12">
            <div class="se-order-detail-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <h5 class="fw-bold mb-0" style="color: var(--text);">Detail Item</h5>
                        <?php
                            $statusColors = [
                                'pending' => ['bg' => '#FEF3C7', 'text' => '#D97706'],
                                'preparing' => ['bg' => '#E0F2FE', 'text' => '#0369A1'],
                                'ready' => ['bg' => '#E0F2FE', 'text' => '#0369A1'],
                                'completed' => ['bg' => '#DCFCE7', 'text' => '#16A34A'],
                                'cancelled' => ['bg' => '#FEE2E2', 'text' => '#DC2626'],
                            ];
                            $sc = $statusColors[$order->status] ?? ['bg' => '#F3F4F6', 'text' => '#6B7280'];
                        ?>
                        <span class="se-badge" style="background:<?php echo e($sc['bg']); ?>;color:<?php echo e($sc['text']); ?>;">
                            <?php echo e(ucfirst($order->status)); ?>

                        </span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <thead style="background: var(--bg);">
                                <tr>
                                    <th style="font-size:0.75rem;font-weight:700;text-transform:uppercase;color:var(--text-muted);padding:12px 20px;">Menu</th>
                                    <th class="text-center d-none d-md-table-cell" style="font-size:0.75rem;font-weight:700;text-transform:uppercase;color:var(--text-muted);">Qty</th>
                                    <th class="text-end d-none d-md-table-cell" style="font-size:0.75rem;font-weight:700;text-transform:uppercase;color:var(--text-muted);">Harga</th>
                                    <th class="text-end" style="font-size:0.75rem;font-weight:700;text-transform:uppercase;color:var(--text-muted);padding:12px 20px;">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $order->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td style="padding:14px 20px;">
                                            <div class="d-flex align-items-center gap-2">
                                                <div>
                                                    <strong class="d-block" style="color: var(--text);"><?php echo e($detail->menu->name); ?></strong>
                                                    <?php if($detail->menu->description): ?>
                                                        <small class="text-muted d-block d-md-none"><?php echo e(Str::limit($detail->menu->description, 50)); ?></small>
                                                    <?php endif; ?>
                                                    <small class="text-muted d-none d-md-inline" style="font-family:var(--font-alt);"><?php echo e($detail->menu->description); ?></small>
                                                </div>
                                            </div>
                                            <div class="d-md-none mt-1">
                                                <small class="text-muted" style="font-family:var(--font-alt);">Qty: <strong>x<?php echo e($detail->quantity); ?></strong></small>
                                                <small class="text-muted ms-2" style="font-family:var(--font-alt);">Harga: Rp <?php echo e(number_format($detail->price, 0, ',', '.')); ?></small>
                                            </div>
                                        </td>
                                        <td class="text-center d-none d-md-table-cell" style="padding:14px 10px;font-family:var(--font-alt);">x<?php echo e($detail->quantity); ?></td>
                                        <td class="text-end d-none d-md-table-cell" style="padding:14px 10px;font-family:var(--font-alt);">Rp <?php echo e(number_format($detail->price, 0, ',', '.')); ?></td>
                                        <td class="text-end fw-bold" style="padding:14px 20px;color: var(--text);">Rp <?php echo e(number_format($detail->subtotal, 0, ',', '.')); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="se-order-detail-card">
                <div class="card-header">
                    <h5 class="fw-bold mb-0" style="color: var(--text);">Ringkasan</h5>
                </div>
                <div class="card-body">
                    <div class="se-summary-item">
                        <span class="label">No. Pesanan</span>
                        <span class="value">#<?php echo e($order->order_number); ?></span>
                    </div>
                    <div class="se-summary-item">
                        <span class="label">Tanggal</span>
                        <span class="value"><?php echo e($order->created_at->format('d/m/Y H:i')); ?></span>
                    </div>
                    <div class="se-summary-item">
                        <span class="label">Nomor Kamar/Meja</span>
                        <strong style="color: var(--text);"><?php echo e($order->table_number); ?></strong>
                    </div>
                    <hr style="border-color:var(--border);">
                    <div class="d-flex justify-content-between mb-3">
                        <span class="fw-bold" style="color: var(--text);">Total</span>
                        <span class="fw-bold fs-5" style="color: var(--primary);">Rp <?php echo e(number_format($order->total_amount, 0, ',', '.')); ?></span>
                    </div>
                    <?php if($order->notes): ?>
                        <div class="p-3 rounded-3" style="background: var(--primary-light); color: var(--primary);">
                            <strong class="small">Catatan:</strong><br>
                            <span style="font-family:var(--font-alt);font-size:0.9rem;"><?php echo e($order->notes); ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if($order->status === 'pending_payment'): ?>
                        <div class="mt-4 p-3 rounded-3" style="background: #FEF3C7; border: 1px solid #FBBF24;">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <i class="bi bi-exclamation-triangle-fill" style="color: #D97706;"></i>
                                <strong style="color: #D97706;">Menunggu Pembayaran</strong>
                            </div>
                            <p class="small mb-3" style="color: #92400E;">Silakan selesaikan pembayaran untuk memproses pesanan Anda.</p>
                            <a href="<?php echo e(route('customer.restaurant.payment', $order)); ?>" class="btn btn-warning w-100">
                                <i class="bi bi-shield-lock-fill"></i> Bayar Sekarang
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('customer.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ukk-hotel-management\resources\views/customer/restaurant/order-detail.blade.php ENDPATH**/ ?>