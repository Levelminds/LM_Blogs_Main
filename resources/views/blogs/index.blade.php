@extends('layouts.app')

@section('title', 'LevelMinds Blog')
@php
    $hero = $heroPosts->first();
@endphp
@section('meta_description', 'Discover the latest LevelMinds insights for schools, educators, and hiring teams.')
@section('meta_keywords', 'education, schools, teachers, hiring, insights, levelminds')
@section('og_title', 'LevelMinds Blog')
@section('og_image', optional($hero)->og_image_url ?? optional($hero)->thumbnail_url ?? asset('images/branding/logo.svg'))
@section('og_type', 'website')

@push('styles')
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
        .hero-media video,
        .hero-media iframe {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .hero-media .ratio {
            width: 100%;
            height: 100%;
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
        .blog-card .card-img-wrap video,
        .blog-card .card-img-wrap iframe {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }
        .blog-card .card-img-wrap .ratio {
            width: 100%;
        }
        .blog-card .card-img-wrap .ratio iframe {
            height: 100%;
            border: 0;
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
@endpush

@section('content')
    <section class="container py-5">
        <h1 class="display-5 fw-bold text-center text-lg-start mb-4">LevelMinds Blogs</h1>

        @if($heroPosts->isNotEmpty())
            <div class="blog-hero-wrapper mb-4">
                <div id="blogHeroCarousel" class="carousel slide blog-hero" data-bs-ride="carousel">
                    @if($heroPosts->count() > 1)
                        <div class="carousel-indicators">
                            @foreach($heroPosts as $index => $post)
                                <button type="button"
                                        data-bs-target="#blogHeroCarousel"
                                        data-bs-slide-to="{{ $index }}"
                                        class="{{ $index === 0 ? 'active' : '' }}"
                                        aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                        aria-label="Slide {{ $index + 1 }}"></button>
                            @endforeach
                        </div>
                    @endif

                    <div class="carousel-inner">
                        @foreach($heroPosts as $index => $post)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <div class="row g-0 align-items-stretch">
                                    <div class="col-lg-5 hero-media">
                                        @if ($post->thumbnail_url)
                                            <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}">
                                        @elseif ($post->is_video && $post->video_embed_url)
                                            <div class="ratio ratio-16x9">
                                                <iframe src="{{ $post->video_embed_url }}" title="{{ $post->title }} video"
                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                        allowfullscreen loading="lazy"></iframe>
                                            </div>
                                        @elseif ($post->is_video && $post->video_stream_url)
                                            <video src="{{ $post->video_stream_url }}" muted playsinline loop></video>
                                        @else
                                            <img src="https://via.placeholder.com/720x520?text=LevelMinds+Blog" alt="{{ $post->title }}">
                                        @endif
                                        @if ($post->is_video)
                                            <span class="video-badge">
                                                <span class="video-icon-dot"></span> Video
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-lg-7 hero-content d-flex flex-column justify-content-center">
                                        <div class="hero-meta mb-3">
                                            @if($post->category)
                                                <span>{{ $post->category->name }}</span>
                                            @endif
                                            <span>{{ optional($post->published_at)->format('d M Y') }}</span>
                                            <span>{{ $post->reading_time }}</span>
                                        </div>
                                        <h2 class="fw-bold mb-3">{{ $post->title }}</h2>
                                        <p class="text-muted mb-4">{{ \Illuminate\Support\Str::limit($post->excerpt, 220) }}</p>
                                        <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-primary rounded-pill px-4 align-self-start">
                                            Continue Reading
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($heroPosts->count() > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#blogHeroCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#blogHeroCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @endif
                </div>
            </div>

            @if($highlightPosts->isNotEmpty())
                <div class="row g-4 mb-5">
                    @foreach($highlightPosts as $highlight)
                        <div class="col-md-6 col-xl-3">
                            <div class="card blog-card h-100">
                                <div class="card-img-wrap">
                                    @if ($highlight->thumbnail_url)
                                        <img src="{{ $highlight->thumbnail_url }}" alt="{{ $highlight->title }}">
                                    @elseif ($highlight->is_video && $highlight->video_embed_url)
                                        <div class="ratio ratio-16x9">
                                            <iframe src="{{ $highlight->video_embed_url }}" title="{{ $highlight->title }} video"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen loading="lazy"></iframe>
                                        </div>
                                    @elseif ($highlight->is_video && $highlight->video_stream_url)
                                        <video src="{{ $highlight->video_stream_url }}" muted playsinline loop></video>
                                    @else
                                        <img src="https://via.placeholder.com/480x320?text=LevelMinds" alt="{{ $highlight->title }}">
                                    @endif
                                    @if ($highlight->is_video)
                                        <span class="video-badge">
                                            <span class="video-icon-dot"></span> Video
                                        </span>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <span class="badge rounded-pill text-bg-light text-uppercase fw-semibold mb-2">
                                        {{ $highlight->category->name ?? 'General' }}
                                    </span>
                                    <h5 class="card-title">
                                        <a href="{{ route('blog.show', $highlight->slug) }}" class="stretched-link text-decoration-none text-dark">
                                            {{ \Illuminate\Support\Str::limit($highlight->title, 60) }}
                                        </a>
                                    </h5>
                                    <p class="card-text text-muted">{{ \Illuminate\Support\Str::limit($highlight->excerpt, 100) }}</p>
                                </div>
                                <div class="card-footer bg-white border-0 text-muted small d-flex justify-content-between">
                                    <span>{{ optional($highlight->published_at)->format('d M Y') }}</span>
                                    <span>{{ $highlight->reading_time }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif
    </section>

    <section class="container pb-5">
        <div class="row g-4 align-items-start">
            <div class="col-lg-3">
                <h3 class="fw-bold mb-3">Discover Blogs by Categories</h3>
                <div class="list-group category-nav">
                    <a href="{{ route('blog.index') }}"
                       class="list-group-item {{ request()->routeIs('blog.index') ? 'active' : '' }}">
                        Latest Articles
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('blog.category', $category->slug) }}"
                           class="list-group-item {{ request()->routeIs('blog.category') && request()->route('slug') === $category->slug ? 'active' : '' }}">
                            {{ $category->name }}
                            <span class="badge bg-light text-dark ms-2">{{ $category->blogs_count }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row g-4">
                    @foreach($blogs as $blog)
                        <div class="col-md-6 col-xl-4">
                            <div class="card blog-card h-100">
                                <div class="card-img-wrap">
                                    @if ($blog->thumbnail_url)
                                        <img src="{{ $blog->thumbnail_url }}" alt="{{ $blog->title }}">
                                    @elseif ($blog->is_video && $blog->video_embed_url)
                                        <div class="ratio ratio-16x9">
                                            <iframe src="{{ $blog->video_embed_url }}" title="{{ $blog->title }} video"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen loading="lazy"></iframe>
                                        </div>
                                    @elseif ($blog->is_video && $blog->video_stream_url)
                                        <video src="{{ $blog->video_stream_url }}" muted playsinline loop></video>
                                    @else
                                        <img src="https://via.placeholder.com/640x420?text=LevelMinds" alt="{{ $blog->title }}">
                                    @endif
                                    @if ($blog->is_video)
                                        <span class="video-badge">
                                            <span class="video-icon-dot"></span> Video
                                        </span>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <span class="badge rounded-pill text-bg-light text-uppercase fw-semibold mb-2">
                                        {{ $blog->category->name ?? 'General' }}
                                    </span>
                                    <h5 class="card-title">
                                        <a href="{{ route('blog.show', $blog->slug) }}" class="stretched-link text-decoration-none text-dark">
                                            {{ $blog->title }}
                                        </a>
                                    </h5>
                                    <p class="card-text text-muted">{{ \Illuminate\Support\Str::limit($blog->excerpt, 110) }}</p>
                                </div>
                                <div class="card-footer bg-white border-0 d-flex justify-content-between text-muted small">
                                    <span>{{ optional($blog->published_at)->format('d M Y') }}</span>
                                    <span>{{ $blog->reading_time }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    {{ $blogs->withQueryString()->links('pagination::bootstrap-5') }}
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
                    <form action="{{ route('subscribe') }}" method="POST" class="row g-3">
                        @csrf
                        <div class="col-md-7">
                            <input type="email" name="email" class="form-control form-control-lg"
                                   placeholder="you@example.com" required>
                        </div>
                        <div class="col-md-5">
                            <select name="category_id" class="form-select form-select-lg">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-auto">
                            <button type="submit" class="btn btn-light btn-lg text-primary fw-semibold px-4">
                                Subscribe
                            </button>
                        </div>
                    </form>
                    @if(session('success'))
                        <div class="alert alert-success mt-3 mb-0">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
