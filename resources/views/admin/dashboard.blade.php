@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Insights Overview')

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const ctx = document.getElementById('trafficChart');
            if (!ctx) {
                return;
            }

            const trendData = @json($trafficTrend);

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
@endpush

@section('content')
    <div class="container py-4">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <span class="text-muted text-uppercase small">Total Visits</span>
                        <h3 class="mt-2 mb-0">{{ number_format($stats['total_visits']) }}</h3>
                        <small class="text-success">Last 24h: {{ number_format($stats['visits_today']) }}</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <span class="text-muted text-uppercase small">Visits This Week</span>
                        <h3 class="mt-2 mb-0">{{ number_format($stats['visits_this_week']) }}</h3>
                        <small class="text-muted">Rolling 7 days</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <span class="text-muted text-uppercase small">Published Posts</span>
                        <h3 class="mt-2 mb-0">{{ number_format($stats['blogs'] - $stats['drafts']) }}</h3>
                        <small class="text-muted">{{ number_format($stats['drafts']) }} drafts</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <span class="text-muted text-uppercase small">Subscribers</span>
                        <h3 class="mt-2 mb-0">{{ number_format($stats['subscribers']) }}</h3>
                        <small class="text-success">{{ number_format($stats['confirmed_subscribers']) }} confirmed</small>
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
                            @forelse ($topPosts as $post)
                                @php($slug = $post->slug ?? null)
                                @if (blank($slug))
                                    @continue
                                @endif
                                <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                    <div>
                                        <a href="{{ route('blog.show', $slug) }}" class="fw-semibold text-decoration-none" target="_blank">
                                            {{ \Illuminate\Support\Str::limit($post->title, 48) }}
                                        </a>
                                        <div class="text-muted small">{{ number_format($post->views) }} views &bull; {{ number_format($post->likes) }} likes</div>
                                    </div>
                                    <span class="badge text-bg-light">{{ $post->reading_time }}</span>
                                </li>
                            @empty
                                <li class="list-group-item px-0 text-muted">No blog data yet.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
