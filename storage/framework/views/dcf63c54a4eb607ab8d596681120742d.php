<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        try {
            $seoSettings = \App\Models\SeoSetting::current();
        } catch (\Throwable $e) {
            $seoSettings = new \App\Models\SeoSetting([
                'site_name' => config('app.name', 'LevelMinds'),
                'title_suffix' => null,
                'default_description' => null,
                'default_keywords' => null,
                'default_og_image' => null,
                'twitter_handle' => null,
                'facebook_app_id' => null,
                'index_site' => true,
            ]);
        }
        $legacyTitle = trim($__env->yieldContent('title'));
        $rawMetaTitle = trim($__env->yieldContent('meta_title'));
        $metaTitle = $rawMetaTitle !== '' ? $rawMetaTitle : ($legacyTitle !== '' ? $legacyTitle : ($seoSettings->site_name ?? config('app.name', 'LevelMinds')));
        $titleSuffix = $seoSettings->title_suffix ?? '';
        if ($titleSuffix && ! \Illuminate\Support\Str::endsWith($metaTitle, $titleSuffix)) {
            $metaTitle = trim($metaTitle.' '.$titleSuffix);
        }
        $metaDescription = trim($__env->yieldContent('meta_description')) ?: ($seoSettings->default_description ?? '');
        $metaKeywords = trim($__env->yieldContent('meta_keywords')) ?: ($seoSettings->default_keywords ?? '');
        $metaCanonical = trim($__env->yieldContent('canonical_url')) ?: url()->current();
        $metaOgTitle = trim($__env->yieldContent('og_title')) ?: $metaTitle;
        $metaOgDescription = trim($__env->yieldContent('og_description')) ?: $metaDescription;
        $metaOgType = trim($__env->yieldContent('og_type')) ?: 'website';
        $metaOgImage = trim($__env->yieldContent('og_image')) ?: ($seoSettings->default_og_image_url ?? asset('images/branding/logo.svg'));
        if (! \Illuminate\Support\Str::startsWith($metaOgImage, ['http://', 'https://'])) {
            $metaOgImage = url($metaOgImage);
        }
        if (! \Illuminate\Support\Str::startsWith($metaCanonical, ['http://', 'https://'])) {
            $metaCanonical = url($metaCanonical);
        }
        $robots = ($seoSettings->index_site ?? true) ? 'index,follow' : 'noindex,nofollow';
        $twitterHandle = $seoSettings->twitter_handle ? '@'.ltrim($seoSettings->twitter_handle, '@') : null;
    ?>
    <title><?php echo e($metaTitle); ?></title>
    <meta name="robots" content="<?php echo e($robots); ?>">
    <link rel="canonical" href="<?php echo e($metaCanonical); ?>">
    <?php if($metaDescription !== ''): ?>
        <meta name="description" content="<?php echo e($metaDescription); ?>">
    <?php endif; ?>
    <?php if($metaKeywords !== ''): ?>
        <meta name="keywords" content="<?php echo e($metaKeywords); ?>">
    <?php endif; ?>
    <meta property="og:title" content="<?php echo e($metaOgTitle); ?>">
    <?php if($metaOgDescription !== ''): ?>
        <meta property="og:description" content="<?php echo e($metaOgDescription); ?>">
    <?php endif; ?>
    <meta property="og:type" content="<?php echo e($metaOgType); ?>">
    <meta property="og:url" content="<?php echo e($metaCanonical); ?>">
    <meta property="og:image" content="<?php echo e($metaOgImage); ?>">
    <?php if(!empty($seoSettings->site_name)): ?>
        <meta property="og:site_name" content="<?php echo e($seoSettings->site_name); ?>">
    <?php endif; ?>
    <?php if(!empty($seoSettings->facebook_app_id)): ?>
        <meta property="fb:app_id" content="<?php echo e($seoSettings->facebook_app_id); ?>">
    <?php endif; ?>
    <meta name="twitter:card" content="summary_large_image">
    <?php if($twitterHandle): ?>
        <meta name="twitter:site" content="<?php echo e($twitterHandle); ?>">
        <meta name="twitter:creator" content="<?php echo e($twitterHandle); ?>">
    <?php endif; ?>
    <meta name="twitter:title" content="<?php echo e($metaOgTitle); ?>">
    <?php if($metaOgDescription !== ''): ?>
        <meta name="twitter:description" content="<?php echo e($metaOgDescription); ?>">
    <?php endif; ?>
    <meta name="twitter:image" content="<?php echo e($metaOgImage); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="<?php echo e(asset('images/branding/favicon.svg')); ?>">
    <link rel="apple-touch-icon" href="<?php echo e(asset('images/branding/favicon.svg')); ?>">
    <?php echo $__env->yieldPushContent('meta'); ?>
    <?php echo $__env->yieldPushContent('styles'); ?>
    <style>
        :root {
            --brand-950: #111c4d;
            --brand-900: #182764;
            --brand-800: #22317d;
            --brand-700: #3248ad;
            --brand-600: #3f97d5;
            --neutral-900: #121c36;
            --neutral-600: #445068;
            --neutral-400: #818ca3;
            --neutral-200: #d7deef;
            --neutral-100: #f5f7fc;
            --surface: #ffffff;
        }

        body {
            font-family: 'Manrope', sans-serif;
            background-color: var(--neutral-100);
            color: var(--neutral-900);
        }

        .site-navbar {
            background-color: var(--surface);
            box-shadow: 0 2px 14px rgba(17, 28, 77, 0.06);
        }

        .site-navbar .nav-link {
            font-weight: 600;
            color: var(--neutral-600);
            padding: 0.75rem 1rem;
        }

        .site-navbar .nav-link.active,
        .site-navbar .nav-link:hover {
            color: var(--brand-700);
        }

        .btn-primary {
            background-color: var(--brand-700);
            border-color: var(--brand-700);
        }

        .btn-primary:hover {
            background-color: var(--brand-800);
            border-color: var(--brand-800);
        }

        footer {
            background: var(--surface);
            color: var(--neutral-600);
            border-top: 1px solid var(--neutral-200);
            padding: 2rem 0;
            margin-top: 4rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg site-navbar sticky-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold text-decoration-none" href="<?php echo e(url('/')); ?>">
                <img src="<?php echo e(asset('images/branding/logo.svg')); ?>" alt="LevelMinds logo" class="me-2" style="height:36px" onerror="this.remove();">
                <span class="text-primary"><?php echo e($seoSettings->site_name ?? 'LevelMinds'); ?></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#primaryNav" aria-controls="primaryNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="primaryNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link <?php if(request()->routeIs('home')): ?> active <?php endif; ?>" href="<?php echo e(url('/')); ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link <?php if(request()->is('team')): ?> active <?php endif; ?>" href="<?php echo e(url('/team')); ?>">Team</a></li>
                    <li class="nav-item"><a class="nav-link <?php if(request()->is('tour')): ?> active <?php endif; ?>" href="<?php echo e(url('/tour')); ?>">Tour</a></li>
                    <li class="nav-item"><a class="nav-link <?php if(request()->is('careers')): ?> active <?php endif; ?>" href="<?php echo e(url('/careers')); ?>">Careers</a></li>
                    <li class="nav-item"><a class="nav-link <?php if(request()->is('contact')): ?> active <?php endif; ?>" href="<?php echo e(url('/contact')); ?>">Contact</a></li>
                    <li class="nav-item"><a class="nav-link <?php if(request()->is('blog') || request()->routeIs('blog.*')): ?> active <?php endif; ?>" href="<?php echo e(url('/blog')); ?>">Blog</a></li>
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <a class="btn btn-primary rounded-pill px-4" href="https://lmap.in/signup" target="_blank" rel="noopener">
                            Login / Sign Up
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer>
        <div class="container text-center">
            <p class="mb-0">&copy; <?php echo e(now()->year); ?> <?php echo e($seoSettings->site_name ?? 'LevelMinds'); ?>. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\levelminds-laravel\resources\views/layouts/app.blade.php ENDPATH**/ ?>