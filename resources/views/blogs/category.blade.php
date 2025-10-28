@extends('layouts.app')

@section('title', $category->name . ' Blogs')
@php
    $categoryLead = $blogs->first();
@endphp
@section('meta_description', 'Explore '.$category->name.' articles and insights curated by LevelMinds.')
@section('meta_keywords', strtolower($category->name).', education, levelminds')
@section('og_title', $category->name.' Blogs | LevelMinds')
@section('og_image', optional($categoryLead)->og_image_url ?? optional($categoryLead)->thumbnail_url ?? asset('images/branding/logo.svg'))
@section('og_type', 'website')

@push('styles')
    <style>
        .category-hero {
            border-radius: 28px;
            padding: 3rem;
            background: linear-gradient(135deg,
                {{ $category->accent_color ?? '#3248ad' }} 0%,
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
@endpush

@section('content')
    <section class="container py-5">
        <div class="category-hero mb-4">
            <span class="badge bg-light text-dark text-uppercase fw-semibold mb-2">{{ $category->name }}</span>
            <h1 class="display-5 fw-bold mb-3">{{ $category->name }} Insights</h1>
            <p class="lead mb-0">Curated stories and practical guidance for {{ strtolower($category->name) }} professionals across the LevelMinds network.</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-3">
                <div class="list-group category-nav">
                    <a href="{{ route('blog.index') }}" class="list-group-item">
                        Latest Articles
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('blog.category', $cat->slug) }}"
                           class="list-group-item {{ $cat->id === $category->id ? 'active' : '' }}">
                            {{ $cat->name }}
                            <span class="badge bg-light text-dark ms-2">{{ $cat->blogs_count }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row g-4">
                    @forelse($blogs as $blog)
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
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info mb-0">
                                We are crafting new content for this category. Check back soon or explore other topics.
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="mt-4">
                    {{ $blogs->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>
@endsection
