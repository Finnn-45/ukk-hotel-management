<?php $__env->startSection('title', 'Detail User - Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-3">
            <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <div>
                <h4 class="fw-bold mb-1">Detail User</h4>
                <p class="text-muted small mb-0">Informasi lengkap pengguna</p>
            </div>
        </div>
        <div class="d-flex gap-2">
            <a href="<?php echo e(route('admin.users.edit', $user)); ?>" class="btn btn-primary">
                <i class="bi bi-pencil"></i> Edit
            </a>
            <?php if($user->id !== auth()->id()): ?>
                <form action="<?php echo e(route('admin.users.destroy', $user)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-4">
                    <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px; font-weight: 700; font-size: 2rem;">
                        <?php echo e(strtoupper(substr($user->name, 0, 2))); ?>

                    </div>
                    <h5 class="fw-bold mb-1"><?php echo e($user->name); ?></h5>
                    <p class="text-muted small mb-3"><?php echo e($user->email); ?></p>

                 

                    <div class="d-flex justify-content-center gap-2">
                        <?php if($user->email_verified_at): ?>
                            <span class="badge bg-success">
                                <i class="bi bi-check-circle"></i> Terverifikasi
                            </span>
                        <?php else: ?>
                            <span class="badge bg-secondary">
                                <i class="bi bi-clock"></i> Belum Verifikasi
                            </span>
                        <?php endif; ?>
                        <?php if(isset($user->is_active)): ?>
                            <span class="badge bg-<?php echo e($user->is_active ? 'success' : 'danger'); ?>">
                                <?php echo e($user->is_active ? 'Aktif' : 'Nonaktif'); ?>

                            </span>
                        <?php endif; ?>
                    </div>

                    <hr class="my-3">

                    <div class="d-grid gap-2">
                        <form action="<?php echo e(route('admin.users.toggle-verification', $user)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-outline-<?php echo e($user->email_verified_at ? 'warning' : 'success'); ?> w-100">
                                <i class="bi bi-<?php echo e($user->email_verified_at ? 'x-circle' : 'check-circle'); ?>"></i>
                                <?php echo e($user->email_verified_at ? 'Batalkan Verifikasi' : 'Verifikasi Email'); ?>

                            </button>
                        </form>
                        <?php if($user->id !== auth()->id() && isset($user->is_active)): ?>
                            <form action="<?php echo e(route('admin.users.toggle-active', $user)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-outline-<?php echo e($user->is_active ? 'danger' : 'success'); ?> w-100">
                                    <i class="bi bi-<?php echo e($user->is_active ? 'pause' : 'play'); ?>"></i>
                                    <?php echo e($user->is_active ? 'Nonaktifkan' : 'Aktifkan'); ?> User
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            
            <?php if($guest): ?>
            <div class="card border-0 shadow-sm mt-3">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="fw-bold mb-0">Informasi Guest</h6>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <small class="text-muted">Nama Lengkap</small>
                        <div class="fw-semibold"><?php echo e($guest->full_name); ?></div>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted">Email</small>
                        <div class="fw-semibold"><?php echo e($guest->email); ?></div>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted">Telepon</small>
                        <div class="fw-semibold"><?php echo e($guest->phone ?? '-'); ?></div>
                    </div>
                    <div>
                        <small class="text-muted">Total Booking</small>
                        <div class="fw-semibold"><?php echo e($guest->bookings()->count()); ?> booking</div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        
        <div class="col-md-8">
            
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="fw-bold mb-0">Booking Terakhir</h6>
                </div>
                <div class="card-body">
                    <?php if($bookings->count() > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>Kamar</th>
                                        <th>Check In</th>
                                        <th>Check Out</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <div class="fw-semibold"><?php echo e($booking->room->room_number); ?></div>
                                                <div class="small text-muted"><?php echo e($booking->room->roomType->name); ?></div>
                                            </td>
                                            <td class="small"><?php echo e(\Carbon\Carbon::parse($booking->check_in)->format('d M Y')); ?></td>
                                            <td class="small"><?php echo e(\Carbon\Carbon::parse($booking->check_out)->format('d M Y')); ?></td>
                                            <td class="fw-semibold">Rp <?php echo e(number_format($booking->total_price, 0, ',', '.')); ?></td>
                                            <td>
                                                <span class="badge bg-<?php echo e($booking->status == 'completed' ? 'success' : ($booking->status == 'cancelled' ? 'danger' : 'primary')); ?>">
                                                    <?php echo e(ucfirst($booking->status)); ?>

                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted text-center py-4">Belum ada booking</p>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="fw-bold mb-0">Review Terakhir</h6>
                </div>
                <div class="card-body">
                    <?php if($reviews->count() > 0): ?>
                        <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="border-bottom pb-3 mb-3">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <div class="text-warning">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <?php if($i <= $review->rating): ?>
                                                <i class="bi bi-star-fill"></i>
                                            <?php else: ?>
                                                <i class="bi bi-star"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>
                                    <small class="text-muted"><?php echo e($review->created_at->diffForHumans()); ?></small>
                                </div>
                                <p class="small text-muted mb-0"><?php echo e($review->review ?? 'Tidak ada ulasan'); ?></p>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <p class="text-muted text-center py-4">Belum ada review</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ukk-hotel-management\resources\views/admin/users/show.blade.php ENDPATH**/ ?>