<?php $__env->startSection('title', 'Detail Booking'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Detail Booking #<?php echo e($booking->id); ?></h2>
    <a href="<?php echo e(route('admin.bookings.index')); ?>" class="btn btn-secondary">Kembali</a>
</div>

<div class="card border-0 shadow-sm mb-3">
    <div class="card-header bg-white">Informasi Booking</div>
    <div class="card-body">
        <table class="table table-borderless">
            <tr><td><strong>Guest</strong></td><td><?php echo e($booking->guest->full_name); ?></td></tr>
            <tr><td><strong>Kamar</strong></td><td><?php echo e($booking->room->room_number); ?> (<?php echo e($booking->room->roomType->name); ?>)</td></tr>
            <tr><td><strong>Check In</strong></td><td><?php echo e(\Carbon\Carbon::parse($booking->check_in)->format('d/m/Y')); ?></td></tr>
            <tr><td><strong>Check Out</strong></td><td><?php echo e(\Carbon\Carbon::parse($booking->check_out)->format('d/m/Y')); ?></td></tr>
            <tr><td><strong>Jumlah Tamu</strong></td><td><?php echo e($booking->number_of_guests); ?></td></tr>
            <tr><td><strong>Total Harga</strong></td><td>Rp <?php echo e(number_format($booking->total_price, 0, ',', '.')); ?></td></tr>
            <tr><td><strong>Status</strong></td>
                <td>
                    <?php
                        $statusColors = [
                            'pending' => 'warning',
                            'confirmed' => 'success',
                            'checked_in' => 'info',
                            'checked_out' => 'secondary',
                            'cancelled' => 'danger',
                        ];
                    ?>
                    <span class="badge bg-<?php echo e($statusColors[$booking->status] ?? 'secondary'); ?>">
                        <?php echo e(ucfirst(str_replace('_', ' ', $booking->status))); ?>

                    </span>
                </td>
            </tr>
        </table>

        <div class="d-flex gap-2 mt-3">
            <?php if($booking->status === 'confirmed'): ?>
                <form action="<?php echo e(route('admin.bookings.check-in', $booking)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button class="btn btn-success" onclick="return confirm('Check-in booking ini?')">
                        <i class="bi bi-box-arrow-in-right"></i> Check In
                    </button>
                </form>
            <?php endif; ?>
            <?php if($booking->status === 'checked_in'): ?>
                <form action="<?php echo e(route('admin.bookings.check-out', $booking)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button class="btn btn-warning" onclick="return confirm('Check-out booking ini?')">
                        <i class="bi bi-box-arrow-right"></i> Check Out
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ukk-hotel-management\resources\views/admin/bookings/show.blade.php ENDPATH**/ ?>