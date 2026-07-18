<?php $__env->startSection('title', 'Pembayaran - Restoran StayEase'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .payment-section {
        padding: 60px 0;
        background: #F8FAFC;
        min-height: 60vh;
    }
    .payment-card {
        background: #fff;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        border: 1px solid #E2E8F0;
        max-width: 600px;
        margin: 0 auto;
    }
    .payment-header {
        text-align: center;
        margin-bottom: 30px;
    }
    .payment-header h2 {
        font-size: 1.75rem;
        font-weight: 800;
        color: #0F172A;
        margin-bottom: 8px;
    }
    .payment-header p {
        color: #64748B;
    }
    .order-info {
        background: #F0F9FF;
        border: 1px solid #BAE6FD;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 24px;
    }
    .order-info-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }
    .order-info-row:last-child {
        margin-bottom: 0;
    }
    .order-info-label {
        color: #64748B;
        font-size: 0.9rem;
    }
    .order-info-value {
        font-weight: 600;
        color: #0F172A;
    }
    .order-total {
        font-size: 1.5rem;
        font-weight: 800;
        color: #0284C7;
    }
    .btn-pay {
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, #0284C7, #0369A1);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(2,132,199,0.3);
    }
    .btn-pay:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(2,132,199,0.4);
    }
    .btn-back {
        width: 100%;
        padding: 12px;
        background: #fff;
        color: #64748B;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        margin-top: 12px;
    }
    .btn-back:hover {
        background: #F8FAFC;
        border-color: #CBD5E1;
    }
    .secure-badge {
        text-align: center;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #E2E8F0;
    }
    .secure-badge i {
        color: #10B981;
        font-size: 1.2rem;
    }
    .secure-badge span {
        color: #64748B;
        font-size: 0.85rem;
        margin-left: 6px;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="payment-section">
    <div class="container">
        <div class="payment-card">
            <div class="payment-header">
                <h2>💳 Pembayaran</h2>
                <p>Pesanan #<?php echo e($order->order_number); ?></p>
            </div>

            <div class="order-info">
                <div class="order-info-row">
                    <span class="order-info-label">Nomor Pesanan:</span>
                    <span class="order-info-value"><?php echo e($order->order_number); ?></span>
                </div>
                <div class="order-info-row">
                    <span class="order-info-label">Tipe Pesanan:</span>
                    <span class="order-info-value">
                        <?php if($order->order_type === 'dine_in'): ?>
                            🍴 Dine In (Kamar <?php echo e($order->table_number); ?>)
                        <?php elseif($order->order_type === 'takeaway'): ?>
                            📦 Takeaway
                        <?php else: ?>
                            🚚 Delivery
                        <?php endif; ?>
                    </span>
                </div>
                <div class="order-info-row">
                    <span class="order-info-label">Total Item:</span>
                    <span class="order-info-value"><?php echo e($order->details->sum('quantity')); ?> item</span>
                </div>
                <div class="order-info-row" style="border-top: 1px solid #BAE6FD; padding-top: 12px; margin-top: 12px;">
                    <span class="order-info-label" style="font-weight: 600; color: #0F172A;">Total Pembayaran:</span>
                    <span class="order-info-value order-total">Rp <?php echo e(number_format($order->total_amount, 0, ',', '.')); ?></span>
                </div>
            </div>

            <button class="btn-pay" id="payButton">
                <i class="bi bi-shield-lock-fill"></i> Bayar dengan Midtrans
            </button>

            <button class="btn-back" onclick="window.location.href='<?php echo e(route('customer.restaurant.orders')); ?>'">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar Pesanan
            </button>

            <div class="secure-badge">
                <i class="bi bi-check-circle-fill"></i>
                <span>Pembayaran aman dan terenkripsi dengan Midtrans</span>
            </div>
        </div>
    </div>
</div>

<script src="https://app.midtrans.com/snap/snap.js" data-client-key="<?php echo e(config('services.midtrans.client_key')); ?>"></script>
<script>
document.getElementById('payButton').addEventListener('click', function() {
    const button = this;
    button.disabled = true;
    button.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Memproses...';

    // Open Midtrans Snap
    snap.pay('<?php echo e($snapToken); ?>', {
        onSuccess: function(result) {
            window.location.href = '<?php echo e(route("customer.restaurant.payment.success")); ?>?order_id=' + result.order_id + '&status_code=' + result.status_code;
        },
        onPending: function(result) {
            window.location.href = '<?php echo e(route("customer.restaurant.payment.pending")); ?>?order_id=' + result.order_id;
        },
        onError: function(result) {
            window.location.href = '<?php echo e(route("customer.restaurant.payment.error")); ?>';
        },
        onClose: function() {
            button.disabled = false;
            button.innerHTML = '<i class="bi bi-shield-lock-fill"></i> Bayar dengan Midtrans';
        }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('customer.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ukk-hotel-management\resources\views/customer/restaurant/payment.blade.php ENDPATH**/ ?>