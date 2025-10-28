<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\SiteVisit;
use App\Models\Subscription;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $stats = [
            'blogs' => Blog::count(),
            'drafts' => Blog::whereNull('published_at')->count(),
            'categories' => Category::count(),
            'subscribers' => Subscription::count(),
            'confirmed_subscribers' => Subscription::where('confirmed', true)->count(),
            'visits_today' => SiteVisit::whereDate('visited_at', $today)->count(),
            'visits_this_week' => SiteVisit::whereBetween('visited_at', [$startOfWeek, $endOfWeek])->count(),
            'total_visits' => SiteVisit::count(),
        ];

        $topPosts = Blog::whereNotNull('slug')
            ->orderByDesc('views')
            ->take(5)
            ->get(['id', 'title', 'slug', 'views', 'likes', 'reading_time']);

        $trafficTrend = SiteVisit::selectRaw('DATE(visited_at) as date, COUNT(*) as total')
            ->where('visited_at', '>=', Carbon::now()->subDays(14))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.dashboard', [
            'stats' => $stats,
            'topPosts' => $topPosts,
            'trafficTrend' => $trafficTrend,
        ]);
    }
}
