<?php $__env->startSection('title', 'Bookings'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Bookings</h2>
        <p class="text-muted mb-0">Kelola dan pantau reservasi kamar hotel</p>
    </div>
    <a href="<?php echo e(route('admin.bookings.create')); ?>" class="btn btn-primary rounded-3">
        <i class="bi bi-plus-circle me-1"></i> Tambah Booking
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        
        <form method="GET" action="<?php echo e(route('admin.bookings.index')); ?>" class="mb-4">
            <div class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label small fw-semibold text-muted">Cari</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Nama, email, kamar, ID..." value="<?php echo e(request('search')); ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-semibold text-muted">Status</label>
                    <select name="status" class="form-select border rounded-3">
                        <option value="">Semua Status</option>
                        <option value="pending" <?php echo e(request('status') === 'pending' ? 'selected' : ''); ?>>Pending (Tertunda)</option>
                        <option value="confirmed" <?php echo e(request('status') === 'confirmed' ? 'selected' : ''); ?>>Confirmed (Dikonfirmasi)</option>
                        <option value="checked_in" <?php echo e(request('status') === 'checked_in' ? 'selected' : ''); ?>>Checked In (Masuk)</option>
                        <option value="checked_out" <?php echo e(request('status') === 'checked_out' ? 'selected' : ''); ?>>Checked Out (Keluar)</option>
                        <option value="cancelled" <?php echo e(request('status') === 'cancelled' ? 'selected' : ''); ?>>Cancelled (Dibatalkan)</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-semibold text-muted">Check In</label>
                    <input type="date" name="check_in" class="form-control rounded-3" value="<?php echo e(request('check_in')); ?>">
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-semibold text-muted">Check Out</label>
                    <input type="date" name="check_out" class="form-control rounded-3" value="<?php echo e(request('check_out')); ?>">
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button class="btn btn-outline-secondary w-100 rounded-3" type="submit">Filter</button>
                    <?php if(request()->hasAny(['search', 'status', 'check_in', 'check_out'])): ?>
                        <a href="<?php echo e(route('admin.bookings.index')); ?>" class="btn btn-outline-danger rounded-3" title="Reset Filter"><i class="bi bi-arrow-counterclockwise"></i></a>
                    <?php endif; ?>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle table-custom">
                <thead class="table-light">
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Tamu</th>
                        <th>Kamar / Tipe</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Total Pembayaran</th>
                        <th>Status</th>
                        <th style="width: 150px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><strong>#<?php echo e($booking->id); ?></strong></td>
                            <td>
                                <div class="fw-bold text-dark"><?php echo e($booking->guest->full_name); ?></div>
                                <small class="text-muted d-block" style="font-size:0.75rem;"><?php echo e($booking->guest->phone); ?></small>
                            </td>
                            <td>
                                <div class="fw-semibold text-dark">Kamar <?php echo e($booking->room->room_number); ?></div>
                                <small class="text-muted d-block" style="font-size:0.75rem;"><?php echo e($booking->room->roomType->name); ?></small>
                            </td>
                            <td><?php echo e(\Carbon\Carbon::parse($booking->check_in)->format('d/m/Y')); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($booking->check_out)->format('d/m/Y')); ?></td>
                            <td>
                                <div class="text-primary fw-semibold">Rp <?php echo e(number_format($booking->total_price, 0, ',', '.')); ?></div>
                            </td>
                            <td>
                                <?php
                                    $statusColors = [
                                        'pending' => 'warning',
                                        'confirmed' => 'success',
                                        'checked_in' => 'info',
                                        'checked_out' => 'secondary',
                                        'cancelled' => 'danger'
                                    ];
                                    $statusLabels = [
                                        'pending' => 'Pending',
                                        'confirmed' => 'Confirmed',
                                        'checked_in' => 'Checked In',
                                        'checked_out' => 'Checked Out',
                                        'cancelled' => 'Cancelled'
                                    ];
                                    $color = $statusColors[$booking->status] ?? 'dark';
                                    $label = $statusLabels[$booking->status] ?? ucfirst($booking->status);
                                ?>
                                <span class="badge badge-premium badge-premium-<?php echo e($color); ?>">
                                    <?php echo e($label); ?>

                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="<?php echo e(route('admin.bookings.show', $booking)); ?>" class="btn btn-sm btn-outline-info rounded-3" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="<?php echo e(route('admin.bookings.edit', $booking)); ?>" class="btn btn-sm btn-outline-warning rounded-3" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="<?php echo e(route('admin.bookings.destroy', $booking)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus booking ini?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-3" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <i class="bi bi-calendar-x display-4 text-muted d-block mb-3"></i>
                                <h5 class="fw-bold">Tidak Ada Data Booking</h5>
                                <p class="text-muted">Coba ubah filter pencarian Anda atau buat booking baru.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        
        <div class="mt-4">
            <?php echo e($bookings->links('vendor.pagination.admin-pagination')); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ukk-hotel-management\resources\views/admin/bookings/index.blade.php ENDPATH**/ ?>