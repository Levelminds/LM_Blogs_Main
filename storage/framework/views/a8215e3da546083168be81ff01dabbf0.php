<?php $__env->startSection('title', $category->name . ' Blogs'); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .category-hero {
            border-radius: 28px;
            padding: 3rem;
            background: linear-gradient(135deg,
                <?php echo e($category->accent_color ?? '#3248ad'); ?> 0%,
                rgba(63, 151, 213, 0.92) 100%);
            color: #fff;
            box-shadow: 0 24px 48px rgba(17, 28, 77, 0.15);
        }
        .category-nav .list-group-item {
            border: none;
            background: transparent;
            border-radius: 14px;
            padding: 0.85rem 1.25rem;
            font-weight: 600;
            color: var(--neutral-600);
        }
        .category-nav .list-group-item.active {
            background: var(--brand-700);
            color: #fff;
            box-shadow: 0 10px 24px rgba(50, 72, 173, 0.35);
        }
        .blog-card {
            border-radius: 24px;
            border: none;
            box-shadow: 0 12px 32px rgba(17, 28, 77, 0.08);
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .blog-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(17, 28, 77, 0.12);
        }
        .blog-card .card-img-wrap {
            position: relative;
            overflow: hidden;
            border-top-left-radius: 24px;
            border-top-right-radius: 24px;
        }
        .blog-card .card-img-wrap img,
        .blog-card .card-img-wrap video {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }
        .video-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: rgba(17, 28, 77, 0.85);
            color: #fff;
            border-radius: 999px;
            padding: 6px 14px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }
        .video-icon-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: currentColor;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="container py-5">
        <div class="category-hero mb-4">
            <span class="badge bg-light text-dark text-uppercase fw-semibold mb-2"><?php echo e($category->name); ?></span>
            <h1 class="display-5 fw-bold mb-3"><?php echo e($category->name); ?> Insights</h1>
            <p class="lead mb-0">Curated stories and practical guidance for <?php echo e(strtolower($category->name)); ?> professionals across the LevelMinds network.</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-3">
                <div class="list-group category-nav">
                    <a href="<?php echo e(route('blog.index')); ?>" class="list-group-item">
                        Latest Articles
                    </a>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('blog.category', $cat->slug)); ?>"
                           class="list-group-item <?php echo e($cat->id === $category->id ? 'active' : ''); ?>">
                            <?php echo e($cat->name); ?>

                            <span class="badge bg-light text-dark ms-2"><?php echo e($cat->blogs_count); ?></span>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row g-4">
                    <?php $__empty_1 = true; $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-md-6 col-xl-4">
                            <div class="card blog-card h-100">
                                <div class="card-img-wrap">
                                    <?php if($blog->thumbnail_url): ?>
                                        <img src="<?php echo e($blog->thumbnail_url); ?>" alt="<?php echo e($blog->title); ?>">
                                    <?php elseif($blog->is_video && $blog->video_path): ?>
                                        <video src="<?php echo e($blog->video_stream_url); ?>" muted playsinline loop></video>
                                    <?php else: ?>
                                        <img src="https://via.placeholder.com/640x420?text=LevelMinds" alt="<?php echo e($blog->title); ?>">
                                    <?php endif; ?>
                                    <?php if($blog->is_video): ?>
                                        <span class="video-badge">
                                            <span class="video-icon-dot"></span> Video
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="card-body">
                                    <span class="badge rounded-pill text-bg-light text-uppercase fw-semibold mb-2">
                                        <?php echo e($blog->category->name ?? 'General'); ?>

                                    </span>
                                    <h5 class="card-title">
                                        <a href="<?php echo e(route('blog.show', $blog->slug)); ?>" class="stretched-link text-decoration-none text-dark">
                                            <?php echo e($blog->title); ?>

                                        </a>
                                    </h5>
                                    <p class="card-text text-muted"><?php echo e(\Illuminate\Support\Str::limit($blog->excerpt, 110)); ?></p>
                                </div>
                                <div class="card-footer bg-white border-0 d-flex justify-content-between text-muted small">
                                    <span><?php echo e(optional($blog->published_at)->format('d M Y')); ?></span>
                                    <span><?php echo e($blog->reading_time); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-12">
                            <div class="alert alert-info mb-0">
                                We are crafting new content for this category. Check back soon or explore other topics.
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mt-4">
                    <?php echo e($blogs->withQueryString()->links('pagination::bootstrap-5')); ?>

                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\levelminds-laravel\resources\views/blogs/category.blade.php ENDPATH**/ ?>