<?php

namespace App\Http\Middleware;

use App\Models\Blog;
use App\Models\SiteVisit;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class TrackSiteVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $deviceId = $request->cookie('lm_device_id');
        $isNewDevice = false;

        if (! $deviceId) {
            $deviceId = (string) Str::uuid();
            $isNewDevice = true;
        }

        $request->attributes->set('lm_device_id', $deviceId);

        $response = $next($request);

        if ($isNewDevice) {
            $response->headers->setCookie(cookie()->forever('lm_device_id', $deviceId));
        }

        if ($this->shouldTrack($request)) {
            $this->storeVisit($request, $deviceId);
        }

        return $response;
    }

    protected function shouldTrack(Request $request): bool
    {
        if (app()->runningUnitTests()) {
            return false;
        }

        if (! $request->isMethod('get')) {
            return false;
        }

        if ($request->expectsJson()) {
            return false;
        }

        $path = $request->path();

        $ignoredPrefixes = [
            'admin',
            'nova',
            'horizon',
            'storage',
            'vendor',
            'livewire',
            'telescope',
        ];

        foreach ($ignoredPrefixes as $prefix) {
            if ($request->is($prefix) || str_starts_with($path, $prefix.'/')) {
                return false;
            }
        }

        return true;
    }

    protected function storeVisit(Request $request, string $fingerprint): void
    {
        try {
            if (blank($fingerprint)) {
                $fingerprint = hash(
                    'sha256',
                    ($request->ip() ?? '0.0.0.0').'|'.$request->userAgent()
                );
            }

            $path = '/'.ltrim($request->path(), '/');
            $visitedAt = now();
            $visitedDate = $visitedAt->toDateString();

            if ($this->visitAlreadyLogged($fingerprint, $path, $visitedDate)) {
                return;
            }

            SiteVisit::create([
                'path' => $path,
                'route_name' => optional($request->route())->getName(),
                'blog_id' => $this->resolveBlogId($request),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'referrer' => $request->headers->get('referer'),
                'fingerprint' => $fingerprint,
                'visited_at' => $visitedAt,
                'visited_date' => $visitedDate,
            ]);
        } catch (\Throwable $exception) {
            report($exception);
        }
    }

    protected function visitAlreadyLogged(string $fingerprint, string $path, string $visitedDate): bool
    {
        if (! $fingerprint) {
            return false;
        }

        $cacheKey = "visit:{$fingerprint}:{$path}:{$visitedDate}";

        if (Cache::has($cacheKey)) {
            return true;
        }

        $exists = SiteVisit::where('fingerprint', $fingerprint)
            ->where('path', $path)
            ->where('visited_date', $visitedDate)
            ->exists();

        Cache::put($cacheKey, true, now()->addDay());

        return $exists;
    }

    protected function resolveBlogId(Request $request): ?int
    {
        $route = $request->route();

        if (! $route) {
            return null;
        }

        if ($route->named('blog.show')) {
            $slug = $route->parameter('slug');

            if ($slug) {
                return Blog::where('slug', $slug)->value('id');
            }
        }

        if ($route->parameter('blog')) {
            $blog = $route->parameter('blog');

            return is_object($blog) ? $blog->getKey() : (int) $blog;
        }

        return null;
    }
}
