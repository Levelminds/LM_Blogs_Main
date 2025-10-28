@extends('layouts.admin')

@section('title', 'Blogs')
@section('page-title', 'Manage Blogs')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0">All Blog Posts</h4>
                <small class="text-muted">Track performance and manage publishing</small>
            </div>
            <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">
                <span class="me-1">+</span> New Blog
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Views</th>
                        <th class="text-center">Likes</th>
                        <th>Published</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($blogs as $blog)
                    <tr>
                        <td>{{ $blogs->firstItem() + $loop->index }}</td>
                        <td>
                            <div class="fw-semibold">{{ $blog->title }}</div>
                            <div class="d-flex gap-2 align-items-center flex-wrap">
                                <small class="text-muted">{{ $blog->reading_time }}</small>
                                @if ($blog->is_video)
                                    <span class="badge text-bg-primary">Video</span>
                                @endif
                            </div>
                        </td>
                        <td>{{ $blog->category->name ?? 'Uncategorized' }}</td>
                        <td class="text-center">
                            @if ($blog->published_at && $blog->published_at->isPast())
                                <span class="badge text-bg-success">Published</span>
                            @else
                                <span class="badge text-bg-warning text-dark">Draft</span>
                            @endif
                        </td>
                        <td class="text-center">{{ number_format($blog->views) }}</td>
                        <td class="text-center">{{ number_format($blog->likes) }}</td>
                        <td>{{ optional($blog->published_at)->format('d M Y, H:i') ?? '—' }}</td>
                        <td class="text-end">
                            <a href="{{ route('blog.show', $blog->slug) }}" class="btn btn-sm btn-outline-secondary me-2" target="_blank">
                                View
                            </a>
                            <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-sm btn-warning me-2">
                                Edit
                            </a>
                            <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete this blog?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">No blog posts yet.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <small class="text-muted">
                Showing {{ $blogs->firstItem() ?? 0 }}-{{ $blogs->lastItem() ?? 0 }} of {{ $blogs->total() }} posts
            </small>
            {{ $blogs->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
