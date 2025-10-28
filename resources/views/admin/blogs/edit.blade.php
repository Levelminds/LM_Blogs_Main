@extends('layouts.admin')

@section('title', 'Edit Blog')
@section('page-title', 'Edit Blog Post')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
@endpush

@push('scripts')
    <script src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    <script>
        document.addEventListener('trix-file-accept', function (event) {
            event.preventDefault();
        });

        document.addEventListener('DOMContentLoaded', function () {
            const mediaTypeSelect = document.getElementById('media_type');
            const videoBlocks = document.querySelectorAll('.video-settings');

            if (!mediaTypeSelect) {
                return;
            }

            const toggleVideoFields = () => {
                const isVideo = mediaTypeSelect.value === 'video';
                videoBlocks.forEach(block => block.classList.toggle('d-none', !isVideo));
            };

            mediaTypeSelect.addEventListener('change', toggleVideoFields);
            toggleVideoFields();
        });
    </script>
@endpush

@section('content')
    <div class="container">
        <div class="card shadow-sm border-0">
            <div class="card-body py-4 px-4">
                <h5 class="card-title mb-4 text-primary">Update Blog Post</h5>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.blogs.update', $blog) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="title" class="form-label fw-semibold">Title</label>
                                <input type="text" id="title" name="title"
                                       value="{{ old('title', $blog->title) }}"
                                       class="form-control form-control-lg" required>
                            </div>

                            <div class="mb-3">
                                <label for="excerpt" class="form-label fw-semibold">Excerpt</label>
                                <textarea id="excerpt" name="excerpt" rows="3" class="form-control"
                                          placeholder="Short summary shown on listings (max 400 characters)">{{ old('excerpt', $blog->excerpt) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="content" class="form-label fw-semibold">Body</label>
                                <input id="content" type="hidden" name="content"
                                       value="{{ old('content', $blog->content) }}">
                                <trix-editor input="content" class="bg-white border rounded"></trix-editor>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="category_id" class="form-label fw-semibold">Category</label>
                                <select id="category_id" name="category_id" class="form-select" required>
                                    <option value="">Select category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @selected(old('category_id', $blog->category_id) == $category->id)>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="media_type" class="form-label fw-semibold">Content Type</label>
                                <select id="media_type" name="media_type" class="form-select" required>
                                    <option value="article" @selected(old('media_type', $blog->media_type) === 'article')>Article</option>
                                    <option value="video" @selected(old('media_type', $blog->media_type) === 'video')>Video</option>
                                </select>
                            </div>

                            <div class="mb-3 video-settings {{ old('media_type', $blog->media_type) === 'video' ? '' : 'd-none' }}">
                                <label for="video_file" class="form-label fw-semibold">Upload New Video</label>
                                <input type="file" id="video_file" name="video_file" class="form-control"
                                       accept="video/mp4,video/quicktime,video/x-m4v,video/webm">
                                <small class="text-muted d-block mt-1">Upload to replace the existing video (max 100 MB).</small>
                            </div>

                            <div class="mb-3 video-settings {{ old('media_type', $blog->media_type) === 'video' ? '' : 'd-none' }}">
                                <label for="external_video_url" class="form-label fw-semibold">External Video URL</label>
                                <input type="url" id="external_video_url" name="external_video_url"
                                       value="{{ old('external_video_url', $blog->external_video_url) }}"
                                       class="form-control" placeholder="https://www.youtube.com/watch?v=...">
                                <small class="text-muted d-block mt-1">Leave blank to keep the current link.</small>
                            </div>

                            @if ($blog->is_video)
                                <div class="mb-3 video-settings {{ old('media_type', $blog->media_type) === 'video' ? '' : 'd-none' }}">
                                    <span class="d-block fw-semibold mb-2">Current Video</span>
                                    @if ($blog->video_path)
                                        <video class="w-100 rounded shadow-sm" controls>
                                            <source src="{{ $blog->video_stream_url }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    @elseif ($blog->external_video_url)
                                        <a href="{{ $blog->external_video_url }}" class="btn btn-outline-primary btn-sm" target="_blank" rel="noopener">
                                            View external video
                                        </a>
                                    @endif
                                </div>
                            @endif

                            <div class="mb-4">
                                <h6 class="text-uppercase text-muted small">SEO Settings</h6>
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="meta_title" class="form-label fw-semibold">Meta Title</label>
                                            <input type="text" id="meta_title" name="meta_title"
                                                   value="{{ old('meta_title', $blog->meta_title) }}" class="form-control"
                                                   placeholder="Custom page title for search engines">
                                        </div>
                                        <div class="mb-3">
                                            <label for="meta_description" class="form-label fw-semibold">Meta Description</label>
                                            <textarea id="meta_description" name="meta_description" rows="2"
                                                      class="form-control"
                                                      placeholder="One or two sentences summarising this blog (max ~160 characters)">{{ old('meta_description', $blog->meta_description) }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="meta_keywords" class="form-label fw-semibold">Meta Keywords</label>
                                            <textarea id="meta_keywords" name="meta_keywords" rows="2"
                                                      class="form-control"
                                                      placeholder="Comma separated keywords">{{ old('meta_keywords', $blog->meta_keywords) }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="canonical_url" class="form-label fw-semibold">Canonical URL</label>
                                            <input type="url" id="canonical_url" name="canonical_url"
                                                   value="{{ old('canonical_url', $blog->canonical_url) }}" class="form-control"
                                                   placeholder="https://levelminds.in/blog/example-post">
                                        </div>
                                        <div class="mb-3">
                                            <label for="og_title" class="form-label fw-semibold">Open Graph Title</label>
                                            <input type="text" id="og_title" name="og_title"
                                                   value="{{ old('og_title', $blog->og_title) }}" class="form-control"
                                                   placeholder="Social sharing title (defaults to meta title)">
                                        </div>
                                        <div class="mb-3">
                                            <label for="og_description" class="form-label fw-semibold">Open Graph Description</label>
                                            <textarea id="og_description" name="og_description" rows="2"
                                                      class="form-control"
                                                      placeholder="Social sharing description (defaults to meta description)">{{ old('og_description', $blog->og_description) }}</textarea>
                                        </div>
                                        <div class="mb-0">
                                            <label for="og_image" class="form-label fw-semibold">Open Graph Image</label>
                                            <input type="file" id="og_image" name="og_image" class="form-control"
                                                   accept=".jpg,.jpeg,.png,.webp">
                                            <small class="text-muted d-block mt-1">Recommended 1200×630 px. Upload to override the social sharing image.</small>
                                            @if ($blog->og_image_url)
                                                <div class="mt-3">
                                                    <span class="d-block fw-semibold mb-2">Current sharing image</span>
                                                    <img src="{{ $blog->og_image_url }}" alt="{{ $blog->title }}" class="img-fluid rounded shadow-sm">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="published_at" class="form-label fw-semibold">Publish Date</label>
                                <input type="datetime-local" id="published_at" name="published_at"
                                       class="form-control"
                                       value="{{ old('published_at', optional($blog->published_at)->format('Y-m-d\TH:i')) }}">
                            </div>

                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" role="switch"
                                       id="is_featured" name="is_featured" value="1"
                                       @checked(old('is_featured', $blog->is_featured))>
                                <label class="form-check-label fw-semibold" for="is_featured">Feature on blog hero</label>
                            </div>

                            <div class="mb-3">
                                <label for="thumbnail" class="form-label fw-semibold">Thumbnail</label>
                                <input type="file" id="thumbnail" name="thumbnail" class="form-control"
                                       accept=".jpg,.jpeg,.png,.webp">
                                <small class="text-muted d-block mt-1">Recommended: 1280 x 720 px</small>

                                @if ($blog->thumbnail_url)
                                    <div class="mt-3">
                                        <span class="d-block fw-semibold mb-2">Current image</span>
                                        <img src="{{ $blog->thumbnail_url }}" alt="{{ $blog->title }}"
                                             class="img-fluid rounded shadow-sm">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary px-5">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
