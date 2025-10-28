<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category')
            ->orderByDesc('published_at')
            ->paginate(12);

        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = $this->getCategoryOptions();

        return view('admin.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);

        if (blank($validated['excerpt'])) {
            $validated['excerpt'] = Str::limit(strip_tags($validated['content']), 180);
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        if ($request->hasFile('og_image')) {
            $validated['og_image'] = $request->file('og_image')->store('og-images', 'public');
        }

        if ($request->hasFile('video_file')) {
            $validated['video_path'] = $request->file('video_file')->store('videos', 'public');
        } elseif ($validated['media_type'] !== 'video') {
            $validated['video_path'] = null;
        } else {
            $validated['video_path'] = null;
        }

        if ($validated['media_type'] !== 'video') {
            $validated['external_video_url'] = null;
        }

        $validated = $this->applySeoDefaults($validated);

        $validated['slug'] = $this->generateUniqueSlug($validated['title']);
        $validated['reading_time'] = $this->estimateReadingTime($validated['content']);
        $validated['metadata'] = [
            'word_count' => str_word_count(strip_tags($validated['content'])),
        ];

        $blog = Blog::create($validated);

        if (empty($blog->canonical_url)) {
            $blog->update(['canonical_url' => route('blog.show', $blog->slug)]);
        }

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog created successfully!');
    }

    public function edit(Blog $blog)
    {
        $categories = $this->getCategoryOptions();

        return view('admin.blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $this->validateRequest($request, $blog);

        if (blank($validated['excerpt'])) {
            $validated['excerpt'] = Str::limit(strip_tags($validated['content']), 180);
        }

        if ($request->hasFile('thumbnail')) {
            if ($blog->thumbnail && Storage::disk('public')->exists($blog->thumbnail)) {
                Storage::disk('public')->delete($blog->thumbnail);
            }

            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        if ($request->hasFile('og_image')) {
            if ($blog->og_image && Storage::disk('public')->exists($blog->og_image)) {
                Storage::disk('public')->delete($blog->og_image);
            }

            $validated['og_image'] = $request->file('og_image')->store('og-images', 'public');
        }

        $currentVideoPath = $blog->video_path;

        if ($request->hasFile('video_file')) {
            if ($currentVideoPath && Storage::disk('public')->exists($currentVideoPath)) {
                Storage::disk('public')->delete($currentVideoPath);
            }

            $currentVideoPath = $request->file('video_file')->store('videos', 'public');
        }

        if ($validated['media_type'] === 'video' && blank($validated['external_video_url']) && ! $request->hasFile('video_file') && $blog->external_video_url) {
            $validated['external_video_url'] = $blog->external_video_url;
        }

        if ($validated['media_type'] === 'video') {
            $validated['video_path'] = $currentVideoPath;
        } else {
            if ($currentVideoPath && Storage::disk('public')->exists($currentVideoPath)) {
                Storage::disk('public')->delete($currentVideoPath);
            }

            $validated['video_path'] = null;
            $validated['external_video_url'] = null;
        }

        $validated['slug'] = $this->generateUniqueSlug($validated['title'], $blog->id);
        $validated['reading_time'] = $this->estimateReadingTime($validated['content']);
        $validated['metadata'] = array_merge($blog->metadata ?? [], [
            'word_count' => str_word_count(strip_tags($validated['content'])),
        ]);

        $validated = $this->applySeoDefaults($validated, $blog);

        $blog->update($validated);

        if (empty($blog->canonical_url)) {
            $blog->update(['canonical_url' => route('blog.show', $blog->slug)]);
        }

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog updated successfully!');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->thumbnail && Storage::disk('public')->exists($blog->thumbnail)) {
            Storage::disk('public')->delete($blog->thumbnail);
        }

        if ($blog->og_image && Storage::disk('public')->exists($blog->og_image)) {
            Storage::disk('public')->delete($blog->og_image);
        }

        if ($blog->video_path && Storage::disk('public')->exists($blog->video_path)) {
            Storage::disk('public')->delete($blog->video_path);
        }

        $blog->delete();

        return back()->with('success', 'Blog deleted successfully!');
    }

    protected function validateRequest(Request $request, ?Blog $blog = null): array
    {
        $rules = [
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:400',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'published_at' => 'nullable|date',
            'is_featured' => 'sometimes|boolean',
            'media_type' => 'required|in:article,video',
            'external_video_url' => 'nullable|url',
            'video_file' => 'nullable|file|mimetypes:video/mp4,video/quicktime,video/x-m4v,video/webm|max:102400',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'canonical_url' => 'nullable|url|max:255',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string|max:500',
            'og_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ];

        $validator = Validator::make($request->all(), $rules);

        $validator->after(function ($validator) use ($request, $blog) {
            if ($request->input('media_type') === 'video') {
                $hasUpload = $request->hasFile('video_file');
                $hasExternal = filled($request->input('external_video_url'));
                $existing = $blog && ($blog->video_path || $blog->external_video_url);

                if (! $hasUpload && ! $hasExternal && ! $existing) {
                    $validator->errors()->add('video_file', 'Please upload a video file or provide an external video URL for video posts.');
                }
            }
        });

        $validated = $validator->validate();

        unset($validated['video_file'], $validated['og_image']);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['published_at'] = $request->input('published_at') ?: now();

        if ($validated['media_type'] !== 'video') {
            $validated['external_video_url'] = null;
        }

        return $validated;
    }

    protected function getCategoryOptions()
    {
        return Category::query()
            ->orderBy('name')
            ->get(['id', 'name']);
    }

    protected function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $count = 1;

        while (
            Blog::where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$baseSlug}-{$count}";
            $count++;
        }

        return $slug;
    }

    protected function estimateReadingTime(string $content): string
    {
        $wordCount = max(1, str_word_count(strip_tags($content)));
        $minutes = max(1, (int) ceil($wordCount / 200));

        return "{$minutes} min read";
    }

    protected function applySeoDefaults(array $data, ?Blog $blog = null): array
    {
        $title = $data['title'] ?? $blog?->title;

        if (blank($data['meta_title'] ?? null) && $title) {
            $data['meta_title'] = $title;
        }

        $contentSource = $data['excerpt']
            ?? $data['content']
            ?? $blog?->excerpt
            ?? $blog?->content;

        if (blank($data['meta_description'] ?? null) && $contentSource) {
            $data['meta_description'] = Str::limit(strip_tags($contentSource), 160);
        }

        if (blank($data['og_title'] ?? null) && ! blank($data['meta_title'] ?? null)) {
            $data['og_title'] = $data['meta_title'];
        }

        if (blank($data['og_description'] ?? null) && ! blank($data['meta_description'] ?? null)) {
            $data['og_description'] = $data['meta_description'];
        }

        if (blank($data['canonical_url'] ?? null) && $blog) {
            $data['canonical_url'] = route('blog.show', $blog->slug);
        }

        return $data;
    }
}
