<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Like;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggle(Request $request, Blog $blog): RedirectResponse
    {
        $userIp = $request->ip();

        $existingLike = Like::where('blog_id', $blog->id)
            ->where('user_ip', $userIp)
            ->first();

        if ($existingLike) {
            $existingLike->delete();
        } else {
            Like::create([
                'blog_id' => $blog->id,
                'user_ip' => $userIp,
            ]);
        }

        $blog->update([
            'likes' => $blog->likes()->count(),
        ]);

        return back()->with('success', $existingLike ? 'You unliked this article.' : 'Thanks for liking!');
    }
}
