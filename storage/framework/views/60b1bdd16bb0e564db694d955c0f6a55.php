<?php $__env->startSection('title', 'Add Blog'); ?>
<?php $__env->startSection('page-title', 'Add New Blog'); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    <script>
        document.addEventListener('trix-file-accept', function (event) {
            event.preventDefault();
        });

        document.addEventListener('DOMContentLoaded', function () {
            const mediaTypeSelect = document.getElementById('media_type');
            const videoBlocks = document.querySelectorAll('.video-settings');

            if (!mediaTypeSelect) {
                return;
            }

            const toggleVideoFields = () => {
                const isVideo = mediaTypeSelect.value === 'video';
                videoBlocks.forEach(block => block.classList.toggle('d-none', !isVideo));
            };

            mediaTypeSelect.addEventListener('change', toggleVideoFields);
            toggleVideoFields();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card shadow-sm border-0">
            <div class="card-body py-4 px-4">
                <h5 class="card-title mb-4 text-primary">Create Blog Post</h5>

                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('admin.blogs.store')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <div class="row g-4">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="title" class="form-label fw-semibold">Title</label>
                                <input type="text" id="title" name="title" value="<?php echo e(old('title')); ?>"
                                       class="form-control form-control-lg" placeholder="Enter headline" required>
                            </div>

                            <div class="mb-3">
                                <label for="excerpt" class="form-label fw-semibold">Excerpt</label>
                                <textarea id="excerpt" name="excerpt" rows="3" class="form-control"
                                          placeholder="Short summary shown on listings (max 400 characters)"><?php echo e(old('excerpt')); ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="content" class="form-label fw-semibold">Body</label>
                                <input id="content" type="hidden" name="content" value="<?php echo e(old('content')); ?>">
                                <trix-editor input="content" class="bg-white border rounded"></trix-editor>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="category_id" class="form-label fw-semibold">Category</label>
                                <select id="category_id" name="category_id" class="form-select" required>
                                    <option value="">Select category</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>" <?php if(old('category_id') == $category->id): echo 'selected'; endif; ?>>
                                            <?php echo e($category->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="media_type" class="form-label fw-semibold">Content Type</label>
                                <select id="media_type" name="media_type" class="form-select" required>
                                    <option value="article" <?php if(old('media_type', 'article') === 'article'): echo 'selected'; endif; ?>>Article</option>
                                    <option value="video" <?php if(old('media_type') === 'video'): echo 'selected'; endif; ?>>Video</option>
                                </select>
                            </div>

                            <div class="mb-3 video-settings <?php echo e(old('media_type') === 'video' ? '' : 'd-none'); ?>">
                                <label for="video_file" class="form-label fw-semibold">Upload Video</label>
                                <input type="file" id="video_file" name="video_file" class="form-control"
                                       accept="video/mp4,video/quicktime,video/x-m4v,video/webm">
                                <small class="text-muted d-block mt-1">Max 100 MB. Supported: MP4, MOV, WEBM.</small>
                            </div>

                            <div class="mb-3 video-settings <?php echo e(old('media_type') === 'video' ? '' : 'd-none'); ?>">
                                <label for="external_video_url" class="form-label fw-semibold">External Video URL</label>
                                <input type="url" id="external_video_url" name="external_video_url"
                                       value="<?php echo e(old('external_video_url')); ?>"
                                       class="form-control" placeholder="https://www.youtube.com/watch?v=...">
                                <small class="text-muted d-block mt-1">Optional. Use if the video is hosted on YouTube, Vimeo, etc.</small>
                            </div>

                            <div class="mb-3">
                                <label for="published_at" class="form-label fw-semibold">Publish Date</label>
                                <input type="datetime-local" id="published_at" name="published_at"
                                       class="form-control"
                                       value="<?php echo e(old('published_at', now()->format('Y-m-d\TH:i'))); ?>">
                            </div>

                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" role="switch"
                                       id="is_featured" name="is_featured" value="1" <?php if(old('is_featured')): echo 'checked'; endif; ?>>
                                <label class="form-check-label fw-semibold" for="is_featured">Feature on blog hero</label>
                            </div>

                            <div class="mb-3">
                                <label for="thumbnail" class="form-label fw-semibold">Thumbnail</label>
                                <input type="file" id="thumbnail" name="thumbnail" class="form-control"
                                       accept=".jpg,.jpeg,.png,.webp">
                                <small class="text-muted d-block mt-1">Recommended: 1280 x 720 px</small>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="<?php echo e(route('admin.blogs.index')); ?>" class="btn btn-outline-secondary px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary px-5">Publish Blog</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\levelminds-laravel\resources\views/admin/blogs/create.blade.php ENDPATH**/ ?>