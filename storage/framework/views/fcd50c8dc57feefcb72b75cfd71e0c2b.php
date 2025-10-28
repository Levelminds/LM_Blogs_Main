<?php $__env->startSection('title', 'Blogs'); ?>
<?php $__env->startSection('page-title', 'Manage Blogs'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0">All Blog Posts</h4>
                <small class="text-muted">Track performance and manage publishing</small>
            </div>
            <a href="<?php echo e(route('admin.blogs.create')); ?>" class="btn btn-primary">
                <span class="me-1">+</span> New Blog
            </a>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Views</th>
                        <th class="text-center">Likes</th>
                        <th>Published</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($blogs->firstItem() + $loop->index); ?></td>
                        <td>
                            <div class="fw-semibold"><?php echo e($blog->title); ?></div>
                            <div class="d-flex gap-2 align-items-center flex-wrap">
                                <small class="text-muted"><?php echo e($blog->reading_time); ?></small>
                                <?php if($blog->is_video): ?>
                                    <span class="badge text-bg-primary">Video</span>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td><?php echo e($blog->category->name ?? 'Uncategorized'); ?></td>
                        <td class="text-center">
                            <?php if($blog->published_at && $blog->published_at->isPast()): ?>
                                <span class="badge text-bg-success">Published</span>
                            <?php else: ?>
                                <span class="badge text-bg-warning text-dark">Draft</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center"><?php echo e(number_format($blog->views)); ?></td>
                        <td class="text-center"><?php echo e(number_format($blog->likes)); ?></td>
                        <td><?php echo e(optional($blog->published_at)->format('d M Y, H:i') ?? '—'); ?></td>
                        <td class="text-end">
                            <a href="<?php echo e(route('blog.show', $blog->slug)); ?>" class="btn btn-sm btn-outline-secondary me-2" target="_blank">
                                View
                            </a>
                            <a href="<?php echo e(route('admin.blogs.edit', $blog)); ?>" class="btn btn-sm btn-warning me-2">
                                Edit
                            </a>
                            <form action="<?php echo e(route('admin.blogs.destroy', $blog)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete this blog?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">No blog posts yet.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <small class="text-muted">
                Showing <?php echo e($blogs->firstItem() ?? 0); ?>-<?php echo e($blogs->lastItem() ?? 0); ?> of <?php echo e($blogs->total()); ?> posts
            </small>
            <?php echo e($blogs->links('pagination::bootstrap-5')); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\levelminds-laravel\resources\views/admin/blogs/index.blade.php ENDPATH**/ ?>