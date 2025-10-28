<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'route_name',
        'blog_id',
        'ip_address',
        'user_agent',
        'referrer',
        'visited_at',
        'visited_date',
        'fingerprint',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
        'visited_date' => 'date',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
