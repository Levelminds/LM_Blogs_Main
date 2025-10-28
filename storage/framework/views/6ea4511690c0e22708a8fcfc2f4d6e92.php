<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LevelMinds Admin - <?php echo $__env->yieldContent('title'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="<?php echo e(asset('images/branding/favicon.svg')); ?>">
    <?php echo $__env->yieldPushContent('styles'); ?>
    <style>
        body {
            background-color: #f5f7fc;
        }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #111c4d 0%, #182764 60%, #22317d 100%);
            color: #e6ebf7;
        }
        .sidebar a {
            color: #d7deef;
            display: block;
            padding: 12px 18px;
            text-decoration: none;
            border-radius: 10px;
            transition: background .2s ease, transform .2s ease;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: rgba(50, 72, 173, 0.25);
            color: #fff;
            transform: translateX(4px);
        }
        .navbar {
            background-color: #fff;
            border-bottom: 1px solid #dee2e6;
        }
        .content {
            padding: 20px;
        }
        .brand-pill {
            background-color: rgba(63, 151, 213, 0.15);
            color: #3f97d5;
            font-weight: 600;
            border-radius: 999px;
            padding: 6px 12px;
        }
    </style>
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar p-3">
        <h4 class="text-center mb-4 d-flex align-items-center justify-content-center gap-2">
            <img src="<?php echo e(asset('images/branding/logo.svg')); ?>" alt="LevelMinds logo" style="height:32px" onerror="this.remove();">
            <span class="brand-pill">LevelMinds Admin</span>
        </h4>
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="<?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">Dashboard</a>
        <a href="<?php echo e(route('admin.blogs.index')); ?>" class="<?php echo e(request()->routeIs('admin.blogs.*') ? 'active' : ''); ?>">Blogs</a>
        <a href="<?php echo e(route('admin.seo.edit')); ?>" class="<?php echo e(request()->routeIs('admin.seo.*') ? 'active' : ''); ?>">SEO Settings</a>
        
        

        <hr>
        <form method="POST" action="<?php echo e(route('admin.logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn btn-danger w-100 mt-2">Logout</button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1">
        <nav class="navbar px-4">
            <div class="d-flex justify-content-between w-100">
                <h5 class="mb-0"><?php echo $__env->yieldContent('page-title'); ?></h5>
                <a href="<?php echo e(url('/')); ?>" class="btn btn-outline-primary btn-sm" target="_blank">View Site</a>
            </div>
        </nav>

        <div class="content">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\levelminds-laravel\resources\views/layouts/admin.blade.php ENDPATH**/ ?>