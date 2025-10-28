<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('page-title', 'Insights Overview'); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const ctx = document.getElementById('trafficChart');
            if (!ctx) {
                return;
            }

            const trendData = <?php echo json_encode($trafficTrend, 15, 512) ?>;

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: trendData.map(item => item.date),
                    datasets: [{
                        label: 'Visits',
                        data: trendData.map(item => item.total),
                        fill: false,
                        borderColor: '#3248ad',
                        backgroundColor: '#3f97d5',
                        tension: 0.25,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <span class="text-muted text-uppercase small">Total Visits</span>
                        <h3 class="mt-2 mb-0"><?php echo e(number_format($stats['total_visits'])); ?></h3>
                        <small class="text-success">Last 24h: <?php echo e(number_format($stats['visits_today'])); ?></small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <span class="text-muted text-uppercase small">Visits This Week</span>
                        <h3 class="mt-2 mb-0"><?php echo e(number_format($stats['visits_this_week'])); ?></h3>
                        <small class="text-muted">Rolling 7 days</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <span class="text-muted text-uppercase small">Published Posts</span>
                        <h3 class="mt-2 mb-0"><?php echo e(number_format($stats['blogs'] - $stats['drafts'])); ?></h3>
                        <small class="text-muted"><?php echo e(number_format($stats['drafts'])); ?> drafts</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <span class="text-muted text-uppercase small">Subscribers</span>
                        <h3 class="mt-2 mb-0"><?php echo e(number_format($stats['subscribers'])); ?></h3>
                        <small class="text-success"><?php echo e(number_format($stats['confirmed_subscribers'])); ?> confirmed</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-1">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <span class="fw-semibold text-primary">Traffic last 14 days</span>
                        <small class="text-muted">Site-wide</small>
                    </div>
                    <div class="card-body">
                        <canvas id="trafficChart" height="160"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white">
                        <span class="fw-semibold text-primary">Top performing blogs</span>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <?php $__empty_1 = true; $__currentLoopData = $topPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php ($slug = $post->slug ?? null); ?>
                                <?php if(blank($slug)): ?>
                                    <?php continue; ?>
                                <?php endif; ?>
                                <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                    <div>
                                        <a href="<?php echo e(route('blog.show', $slug)); ?>" class="fw-semibold text-decoration-none" target="_blank">
                                            <?php echo e(\Illuminate\Support\Str::limit($post->title, 48)); ?>

                                        </a>
                                        <div class="text-muted small"><?php echo e(number_format($post->views)); ?> views &bull; <?php echo e(number_format($post->likes)); ?> likes</div>
                                    </div>
                                    <span class="badge text-bg-light"><?php echo e($post->reading_time); ?></span>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <li class="list-group-item px-0 text-muted">No blog data yet.</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\levelminds-laravel\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>