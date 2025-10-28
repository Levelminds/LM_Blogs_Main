<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BlogController extends Controller
{
    public function index()
    {
        $heroPosts = Blog::with('category')
            ->published()
            ->orderByDesc('published_at')
            ->take(5)
            ->get();

        $excludedIds = $heroPosts->pluck('id');

        $blogs = Blog::with('category')
            ->published()
            ->when($excludedIds->isNotEmpty(), fn ($query) => $query->whereNotIn('id', $excludedIds))
            ->orderByDesc('published_at')
            ->paginate(9);

        $categories = Category::withCount(['blogs as blogs_count' => function ($query) {
            $query->published();
        }])->orderBy('name')->get();

        return view('blogs.index', [
            'heroPosts' => $heroPosts,
            'highlightPosts' => $heroPosts->slice(1),
            'blogs' => $blogs,
            'categories' => $categories,
        ]);
    }

    public function category(string $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $blogs = $category->blogs()
            ->published()
            ->with('category')
            ->orderByDesc('published_at')
            ->paginate(9);

        $categories = Category::withCount(['blogs as blogs_count' => function ($query) {
            $query->published();
        }])->orderBy('name')->get();

        return view('blogs.category', [
            'category' => $category,
            'blogs' => $blogs,
            'categories' => $categories,
        ]);
    }

    public function show(Request $request, string $slug)
    {
        $blog = Blog::with(['category', 'likes'])
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        $this->registerUniqueView($request, $blog);

        $related = Blog::with('category')
            ->published()
            ->where('id', '!=', $blog->id)
            ->where('category_id', $blog->category_id)
            ->orderByDesc('published_at')
            ->take(4)
            ->get();

        return view('blogs.show', [
            'blog' => $blog->fresh(['category', 'likes']),
            'related' => $related,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    protected function registerUniqueView(Request $request, Blog $blog): void
    {
        $fingerprint = $request->attributes->get('lm_device_id')
            ?? $request->cookie('lm_device_id')
            ?? sha1(($request->ip() ?? '0.0.0.0').'|'.$request->userAgent());

        $cacheKey = sprintf(
            'blog:viewed:%s:%s:%s',
            $blog->id,
            $fingerprint,
            now()->toDateString()
        );

        if ($fingerprint && ! Cache::has($cacheKey)) {
            $blog->increment('views');
            Cache::put($cacheKey, true, now()->addDay());
        }
    }
}
