<?php $__env->startSection('title', 'Data Guest'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Data Guest</h2>
    <a href="<?php echo e(route('admin.guests.create')); ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Guest
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari nama, email, no telp..." value="<?php echo e(request('search')); ?>">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No Telp</th>
                        <th>ID Card</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $guests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><strong><?php echo e($guest->full_name); ?></strong></td>
                            <td><?php echo e($guest->email); ?></td>
                            <td><?php echo e($guest->phone); ?></td>
                            <td><?php echo e($guest->id_card ?? '-'); ?></td>
                            <td>
                                <a href="<?php echo e(route('admin.guests.edit', $guest)); ?>" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="<?php echo e(route('admin.guests.destroy', $guest)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus guest ini?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="5" class="text-center py-4">Tidak ada data guest</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php echo e($guests->links('vendor.pagination.admin-pagination')); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ukk-hotel-management\resources\views/admin/guests/index.blade.php ENDPATH**/ ?>