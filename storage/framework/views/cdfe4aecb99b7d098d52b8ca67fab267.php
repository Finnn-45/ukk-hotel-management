<?php $__env->startSection('title', 'Kamar'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Kamar</h2>
        <p class="text-muted mb-0">Kelola kamar hotel dan pantau status ketersediaannya</p>
    </div>
    <a href="<?php echo e(route('admin.rooms.create')); ?>" class="btn btn-primary rounded-3">
        <i class="bi bi-plus-circle me-1"></i> Tambah Kamar
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-4">
        
        <form method="GET" action="<?php echo e(route('admin.rooms.index')); ?>" class="mb-4">
            <div class="row g-3 align-items-end">
                <div class="col-md-4 col-lg-3">
                    <label class="form-label small fw-semibold text-muted">Cari</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="No Kamar, lantai, tipe..." value="<?php echo e(request('search')); ?>">
                    </div>
                </div>
                <div class="col-md-3 col-lg-3">
                    <label class="form-label small fw-semibold text-muted">Status</label>
                    <select name="status" class="form-select border rounded-3">
                        <option value="">Semua Status</option>
                        <option value="available" <?php echo e(request('status') === 'available' ? 'selected' : ''); ?>>Available (Tersedia)</option>
                        <option value="occupied" <?php echo e(request('status') === 'occupied' ? 'selected' : ''); ?>>Occupied (Terisi)</option>
                        <option value="booked" <?php echo e(request('status') === 'booked' ? 'selected' : ''); ?>>Booked (Terpesan)</option>
                        <option value="maintenance" <?php echo e(request('status') === 'maintenance' ? 'selected' : ''); ?>>Maintenance (Perawatan)</option>
                    </select>
                </div>
                <div class="col-md-3 col-lg-3">
                    <label class="form-label small fw-semibold text-muted">Tipe Kamar</label>
                    <select name="room_type_id" class="form-select border rounded-3">
                        <option value="">Semua Tipe</option>
                        <?php $__currentLoopData = $roomTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($type->id); ?>" <?php echo e(request('room_type_id') == $type->id ? 'selected' : ''); ?>><?php echo e($type->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-2 col-lg-3 d-flex gap-2">
                    <button class="btn btn-outline-secondary w-100 rounded-3" type="submit">Filter</button>
                    <?php if(request()->hasAny(['search', 'status', 'room_type_id'])): ?>
                        <a href="<?php echo e(route('admin.rooms.index')); ?>" class="btn btn-outline-danger rounded-3" title="Reset Filter"><i class="bi bi-arrow-counterclockwise"></i></a>
                    <?php endif; ?>
                </div>
            </div>
        </form>

        
        <div class="table-responsive">
            <table class="table table-hover align-middle table-custom">
                <thead class="table-light">
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Nomor Kamar</th>
                        <th>Tipe Kamar</th>
                        <th>Lantai</th>
                        <th>Status</th>
                        <th style="width: 150px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><strong>#<?php echo e($room->id); ?></strong></td>
                            <td>
                                <span class="fw-bold text-dark fs-5">Kamar <?php echo e($room->room_number); ?></span>
                            </td>
                            <td>
                                <div class="fw-semibold text-muted"><?php echo e($room->roomType->name); ?></div>
                            </td>
                            <td>
                                <span class="badge badge-premium badge-premium-secondary">Lt. <?php echo e($room->floor ?: '1'); ?></span>
                            </td>
                            <td>
                                <?php
                                    $statusClasses = [
                                        'available' => 'success',
                                        'occupied' => 'danger',
                                        'booked' => 'warning',
                                        'maintenance' => 'secondary'
                                    ];
                                    $statusLabel = [
                                        'available' => 'Tersedia',
                                        'occupied' => 'Terisi',
                                        'booked' => 'Terpesan',
                                        'maintenance' => 'Perbaikan'
                                    ];
                                    $color = $statusClasses[$room->status] ?? 'dark';
                                    $label = $statusLabel[$room->status] ?? ucfirst($room->status);
                                ?>
                                <span class="badge badge-premium badge-premium-<?php echo e($color); ?>">
                                    <?php echo e($label); ?>

                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="<?php echo e(route('admin.rooms.edit', $room)); ?>" class="btn btn-sm btn-outline-warning rounded-3" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="<?php echo e(route('admin.rooms.destroy', $room)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kamar ini?')">
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
                            <td colspan="6" class="text-center py-5">
                                <i class="bi bi-door-closed display-4 text-muted d-block mb-3"></i>
                                <h5 class="fw-bold">Tidak Ada Kamar</h5>
                                <p class="text-muted">Coba bersihkan filter pencarian atau buat kamar baru.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        
        <div class="mt-4">
            <?php echo e($rooms->links('vendor.pagination.admin-pagination')); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ukk-hotel-management\resources\views/admin/rooms/index.blade.php ENDPATH**/ ?>