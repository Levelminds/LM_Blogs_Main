<?php $__env->startSection('title', 'SEO Settings'); ?>
<?php $__env->startSection('page-title', 'SEO Settings'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="mb-3 text-primary">Global SEO Configuration</h5>

                        <?php if(session('success')): ?>
                            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                        <?php endif; ?>

                        <form action="<?php echo e(route('admin.seo.update')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="mb-3">
                                <label for="site_name" class="form-label fw-semibold">Site Name</label>
                                <input type="text" id="site_name" name="site_name" class="form-control"
                                       value="<?php echo e(old('site_name', $settings->site_name)); ?>"
                                       placeholder="LevelMinds">
                            </div>

                            <div class="mb-3">
                                <label for="title_suffix" class="form-label fw-semibold">Title Suffix</label>
                                <input type="text" id="title_suffix" name="title_suffix" class="form-control"
                                       value="<?php echo e(old('title_suffix', $settings->title_suffix)); ?>"
                                       placeholder="| LevelMinds">
                                <small class="text-muted">Appended to page titles when not overridden.</small>
                            </div>

                            <div class="mb-3">
                                <label for="default_description" class="form-label fw-semibold">Default Meta Description</label>
                                <textarea id="default_description" name="default_description" rows="3" class="form-control"
                                          placeholder="Description used when specific pages do not provide one."><?php echo e(old('default_description', $settings->default_description)); ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="default_keywords" class="form-label fw-semibold">Default Keywords</label>
                                <textarea id="default_keywords" name="default_keywords" rows="2" class="form-control"
                                          placeholder="Comma separated keywords"><?php echo e(old('default_keywords', $settings->default_keywords)); ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="twitter_handle" class="form-label fw-semibold">Twitter Handle</label>
                                <input type="text" id="twitter_handle" name="twitter_handle" class="form-control"
                                       value="<?php echo e(old('twitter_handle', $settings->twitter_handle)); ?>"
                                       placeholder="@levelminds">
                            </div>

                            <div class="mb-3">
                                <label for="facebook_app_id" class="form-label fw-semibold">Facebook App ID</label>
                                <input type="text" id="facebook_app_id" name="facebook_app_id" class="form-control"
                                       value="<?php echo e(old('facebook_app_id', $settings->facebook_app_id)); ?>"
                                       placeholder="Optional">
                            </div>

                            <div class="mb-3">
                                <label for="default_og_image" class="form-label fw-semibold">Default Open Graph Image</label>
                                <input type="file" id="default_og_image" name="default_og_image" class="form-control"
                                       accept=".jpg,.jpeg,.png,.webp">
                                <small class="text-muted d-block mt-1">Used when pages do not supply their own sharing image (1200×630 px recommended).</small>
                                <?php if($settings->default_og_image_url): ?>
                                    <div class="mt-3">
                                        <span class="d-block fw-semibold mb-2">Current default image</span>
                                        <img src="<?php echo e($settings->default_og_image_url); ?>" alt="Default OG" class="img-fluid rounded shadow-sm">
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="form-check form-switch mb-4">
                                <input class="form-check-input" type="checkbox" role="switch" id="index_site"
                                       name="index_site" value="1" <?php if(old('index_site', $settings->index_site)): echo 'checked'; endif; ?>>
                                <label class="form-check-label fw-semibold" for="index_site">Allow search engines to index the site</label>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary px-4">Save Settings</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\levelminds-laravel\resources\views/admin/seo/edit.blade.php ENDPATH**/ ?>