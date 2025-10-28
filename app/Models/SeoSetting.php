<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SeoSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'title_suffix',
        'default_description',
        'default_keywords',
        'default_og_image',
        'twitter_handle',
        'facebook_app_id',
        'index_site',
    ];

    protected $casts = [
        'index_site' => 'boolean',
    ];

    public static function current(): self
    {
        return Cache::rememberForever('seo.settings', function () {
            return static::first() ?? static::create([
                'site_name' => config('app.name', 'LevelMinds'),
                'title_suffix' => null,
                'default_description' => null,
                'default_keywords' => null,
                'default_og_image' => null,
                'twitter_handle' => null,
                'facebook_app_id' => null,
                'index_site' => true,
            ]);
        });
    }

    public function getDefaultOgImageUrlAttribute(): ?string
    {
        if (! $this->default_og_image) {
            return null;
        }

        if (str_starts_with($this->default_og_image, 'http')) {
            return $this->default_og_image;
        }

        $path = ltrim($this->default_og_image, '/');

        if (str_starts_with($path, 'storage/')) {
            return asset($path);
        }

        if (str_starts_with($path, 'public/')) {
            return Storage::url(substr($path, strlen('public/')));
        }

        if (str_starts_with($path, 'app/public/')) {
            return Storage::url(substr($path, strlen('app/public/')));
        }

        return Storage::url($path);
    }

    public static function forgetCache(): void
    {
        Cache::forget('seo.settings');
    }
}
