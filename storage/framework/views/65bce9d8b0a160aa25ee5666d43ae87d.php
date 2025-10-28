<?php $__env->startSection('title', 'LevelMinds Blog'); ?>
<?php
    $hero = $heroPosts->first();
?>
<?php $__env->startSection('meta_description', 'Discover the latest LevelMinds insights for schools, educators, and hiring teams.'); ?>
<?php $__env->startSection('meta_keywords', 'education, schools, teachers, hiring, insights, levelminds'); ?>
<?php $__env->startSection('og_title', 'LevelMinds Blog'); ?>
<?php $__env->startSection('og_image', optional($hero)->og_image_url ?? optional($hero)->thumbnail_url ?? asset('images/branding/logo.svg')); ?>
<?php $__env->startSection('og_type', 'website'); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .blog-hero-wrapper {
            border-radius: 32px;
            overflow: hidden;
            box-shadow: 0 24px 48px rgba(17, 28, 77, 0.08);
        }
        .blog-hero .carousel-item {
            padding: 0;
        }
        .hero-media {
            position: relative;
            height: 100%;
        }
        .hero-media img,
        .hero-media video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .video-badge {
            position: absolute;
            top: 16px;
            left: 16px;
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
        .carousel-indicators [data-bs-target] {
            background-color: var(--brand-700);
        }
        .carousel-control-prev,
        .carousel-control-next {
            width: 4rem;
            opacity: 0.75;
        }
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            filter: invert(1);
        }
        .hero-content {
            padding: 3rem;
            background: var(--surface);
        }
        .hero-meta span {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            background-color: rgba(50, 72, 173, 0.12);
            color: var(--brand-700);
            font-weight: 600;
            border-radius: 999px;
            padding: 6px 14px;
            margin-right: 0.6rem;
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
        .blog-card .card-img-wrap .video-badge {
            top: 12px;
            left: 12px;
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
        .subscribe-panel {
            background: linear-gradient(135deg, rgba(50, 72, 173, 0.95), rgba(63, 151, 213, 0.95));
            border-radius: 28px;
            color: #fff;
            padding: 3rem;
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
        <h1 class="display-5 fw-bold text-center text-lg-start mb-4">LevelMinds Blogs</h1>

        <?php if($heroPosts->isNotEmpty()): ?>
            <div class="blog-hero-wrapper mb-4">
                <div id="blogHeroCarousel" class="carousel slide blog-hero" data-bs-ride="carousel">
                    <?php if($heroPosts->count() > 1): ?>
                        <div class="carousel-indicators">
                            <?php $__currentLoopData = $heroPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <button type="button"
                                        data-bs-target="#blogHeroCarousel"
                                        data-bs-slide-to="<?php echo e($index); ?>"
                                        class="<?php echo e($index === 0 ? 'active' : ''); ?>"
                                        aria-current="<?php echo e($index === 0 ? 'true' : 'false'); ?>"
                                        aria-label="Slide <?php echo e($index + 1); ?>"></button>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>

                    <div class="carousel-inner">
                        <?php $__currentLoopData = $heroPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="carousel-item <?php echo e($index === 0 ? 'active' : ''); ?>">
                                <div class="row g-0 align-items-stretch">
                                    <div class="col-lg-5 hero-media">
                                        <?php if($post->thumbnail_url): ?>
                                            <img src="<?php echo e($post->thumbnail_url); ?>" alt="<?php echo e($post->title); ?>">
                                        <?php elseif($post->is_video && $post->video_path): ?>
                                            <video src="<?php echo e($post->video_stream_url); ?>" muted playsinline loop></video>
                                        <?php else: ?>
                                            <img src="https://via.placeholder.com/720x520?text=LevelMinds+Blog" alt="<?php echo e($post->title); ?>">
                                        <?php endif; ?>
                                        <?php if($post->is_video): ?>
                                            <span class="video-badge">
                                                <span class="video-icon-dot"></span> Video
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-lg-7 hero-content d-flex flex-column justify-content-center">
                                        <div class="hero-meta mb-3">
                                            <?php if($post->category): ?>
                                                <span><?php echo e($post->category->name); ?></span>
                                            <?php endif; ?>
                                            <span><?php echo e(optional($post->published_at)->format('d M Y')); ?></span>
                                            <span><?php echo e($post->reading_time); ?></span>
                                        </div>
                                        <h2 class="fw-bold mb-3"><?php echo e($post->title); ?></h2>
                                        <p class="text-muted mb-4"><?php echo e(\Illuminate\Support\Str::limit($post->excerpt, 220)); ?></p>
                                        <a href="<?php echo e(route('blog.show', $post->slug)); ?>" class="btn btn-primary rounded-pill px-4 align-self-start">
                                            Continue Reading
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <?php if($heroPosts->count() > 1): ?>
                        <button class="carousel-control-prev" type="button" data-bs-target="#blogHeroCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#blogHeroCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    <?php endif; ?>
                </div>
            </div>

            <?php if($highlightPosts->isNotEmpty()): ?>
                <div class="row g-4 mb-5">
                    <?php $__currentLoopData = $highlightPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $highlight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-6 col-xl-3">
                            <div class="card blog-card h-100">
                                <div class="card-img-wrap">
                                    <?php if($highlight->thumbnail_url): ?>
                                        <img src="<?php echo e($highlight->thumbnail_url); ?>" alt="<?php echo e($highlight->title); ?>">
                                    <?php elseif($highlight->is_video && $highlight->video_path): ?>
                                        <video src="<?php echo e($highlight->video_stream_url); ?>" muted playsinline loop></video>
                                    <?php else: ?>
                                        <img src="https://via.placeholder.com/480x320?text=LevelMinds" alt="<?php echo e($highlight->title); ?>">
                                    <?php endif; ?>
                                    <?php if($highlight->is_video): ?>
                                        <span class="video-badge">
                                            <span class="video-icon-dot"></span> Video
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="card-body">
                                    <span class="badge rounded-pill text-bg-light text-uppercase fw-semibold mb-2">
                                        <?php echo e($highlight->category->name ?? 'General'); ?>

                                    </span>
                                    <h5 class="card-title">
                                        <a href="<?php echo e(route('blog.show', $highlight->slug)); ?>" class="stretched-link text-decoration-none text-dark">
                                            <?php echo e(\Illuminate\Support\Str::limit($highlight->title, 60)); ?>

                                        </a>
                                    </h5>
                                    <p class="card-text text-muted"><?php echo e(\Illuminate\Support\Str::limit($highlight->excerpt, 100)); ?></p>
                                </div>
                                <div class="card-footer bg-white border-0 text-muted small d-flex justify-content-between">
                                    <span><?php echo e(optional($highlight->published_at)->format('d M Y')); ?></span>
                                    <span><?php echo e($highlight->reading_time); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </section>

    <section class="container pb-5">
        <div class="row g-4 align-items-start">
            <div class="col-lg-3">
                <h3 class="fw-bold mb-3">Discover Blogs by Categories</h3>
                <div class="list-group category-nav">
                    <a href="<?php echo e(route('blog.index')); ?>"
                       class="list-group-item <?php echo e(request()->routeIs('blog.index') ? 'active' : ''); ?>">
                        Latest Articles
                    </a>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('blog.category', $category->slug)); ?>"
                           class="list-group-item <?php echo e(request()->routeIs('blog.category') && request()->route('slug') === $category->slug ? 'active' : ''); ?>">
                            <?php echo e($category->name); ?>

                            <span class="badge bg-light text-dark ms-2"><?php echo e($category->blogs_count); ?></span>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row g-4">
                    <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="mt-4">
                    <?php echo e($blogs->withQueryString()->links('pagination::bootstrap-5')); ?>

                </div>
            </div>
        </div>
    </section>

    <section class="container pb-5">
        <div class="subscribe-panel">
            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    <h3 class="fw-bold mb-2">Stay ahead with LevelMinds insights</h3>
                    <p class="mb-0">Subscribe and receive curated stories for school leaders, educators, and hiring teams.</p>
                </div>
                <div class="col-lg-6">
                    <form action="<?php echo e(route('subscribe')); ?>" method="POST" class="row g-3">
                        <?php echo csrf_field(); ?>
                        <div class="col-md-7">
                            <input type="email" name="email" class="form-control form-control-lg"
                                   placeholder="you@example.com" required>
                        </div>
                        <div class="col-md-5">
                            <select name="category_id" class="form-select form-select-lg">
                                <option value="">All Categories</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-auto">
                            <button type="submit" class="btn btn-light btn-lg text-primary fw-semibold px-4">
                                Subscribe
                            </button>
                        </div>
                    </form>
                    <?php if(session('success')): ?>
                        <div class="alert alert-success mt-3 mb-0">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\levelminds-laravel\resources\views/blogs/index.blade.php ENDPATH**/ ?>