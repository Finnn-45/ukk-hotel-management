<?php $__env->startSection('title', 'Manajemen User - Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Manajemen User</h4>
            <p class="text-muted small mb-0">Kelola semua pengguna yang terdaftar di sistem</p>
        </div>
    </div>

    
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="<?php echo e(route('admin.users.index')); ?>">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label small fw-semibold">Cari User</label>
                        <input type="text" name="search" class="form-control" placeholder="Nama atau email..." value="<?php echo e(request('search')); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold">Role</label>
                        <select name="role" class="form-select">
                            <option value="">Semua Role</option>
                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($role->name); ?>" <?php echo e(request('role') == $role->name ? 'selected' : ''); ?>>
                                    <?php echo e(ucfirst($role->name)); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold">Status Verifikasi</label>
                        <select name="verified" class="form-select">
                            <option value="">Semua</option>
                            <option value="yes" <?php echo e(request('verified') == 'yes' ? 'selected' : ''); ?>>Terverifikasi</option>
                            <option value="no" <?php echo e(request('verified') == 'no' ? 'selected' : ''); ?>>Belum Verifikasi</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-funnel"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>User</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Terdaftar</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; font-weight: 700; font-size: 0.9rem;">
                                            <?php echo e(strtoupper(substr($user->name, 0, 2))); ?>

                                        </div>
                                        <div>
                                            <div class="fw-semibold"><?php echo e($user->name); ?></div>
                                            <div class="small text-muted"><?php echo e($user->email); ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="badge bg-<?php echo e($role->name == 'admin' ? 'danger' : ($role->name == 'staff' ? 'warning' : 'primary')); ?>">
                                            <?php echo e(ucfirst($role->name)); ?>

                                        </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                <td>
                                    <?php if($user->email_verified_at): ?>
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle"></i> Terverifikasi
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">
                                            <i class="bi bi-clock"></i> Belum Verifikasi
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="small text-muted">
                                    <?php echo e($user->created_at->format('d M Y')); ?>

                                </td>
                                <td class="text-end">
                                    <a href="<?php echo e(route('admin.users.show', $user)); ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class="bi bi-people display-4 text-muted d-block mb-3"></i>
                                    <p class="text-muted">Tidak ada user ditemukan</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            
            <?php if($users->hasPages()): ?>
                <div class="mt-4">
                    <?php echo e($users->links('vendor.pagination.admin-pagination')); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Auto-submit filter form on change
    document.querySelectorAll('select[name="role"], select[name="verified"]').forEach(select => {
        select.addEventListener('change', function() {
            this.form.submit();
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ukk-hotel-management\resources\views/admin/users/index.blade.php ENDPATH**/ ?>