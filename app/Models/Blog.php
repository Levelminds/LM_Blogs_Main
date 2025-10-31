<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'category_id',
        'thumbnail',
        'views',
        'likes',
        'published_at',
        'is_featured',
        'reading_time',
        'metadata',
        'media_type',
        'video_path',
        'external_video_url',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'og_title',
        'og_description',
        'og_image',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
        'metadata' => 'array',
        'media_type' => 'string',
    ];

    protected $appends = [
        'thumbnail_url',
        'video_stream_url',
        'video_embed_url',
        'og_image_url',
        'is_video',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->resolvePublicAssetUrl($this->thumbnail);
    }

    public function getVideoStreamUrlAttribute(): ?string
    {
        if ($this->external_video_url) {
            return $this->isStreamableFileUrl($this->external_video_url)
                ? $this->external_video_url
                : null;
        }

        return $this->resolvePublicAssetUrl($this->video_path);
    }

    public function getVideoEmbedUrlAttribute(): ?string
    {
        if (! $this->external_video_url || $this->isStreamableFileUrl($this->external_video_url)) {
            return null;
        }

        $url = $this->external_video_url;

        if (Str::contains($url, ['youtube.com', 'youtu.be'])) {
            if (preg_match('/(youtu\.be\/|v=)([^&]+)/', $url, $matches)) {
                $videoId = $matches[2];
            } elseif (preg_match('/embed\/([^?]+)/', $url, $matches)) {
                $videoId = $matches[1];
            } else {
                $videoId = null;
            }

            return $videoId ? 'https://www.youtube.com/embed/'.$videoId : $url;
        }

        if (Str::contains($url, 'vimeo.com')) {
            if (preg_match('/vimeo\.com\/(\d+)/', $url, $matches)) {
                return 'https://player.vimeo.com/video/'.$matches[1];
            }
        }

        return $url;
    }

    public function getOgImageUrlAttribute(): ?string
    {
        return $this->resolvePublicAssetUrl($this->og_image, $this->thumbnail_url);
    }

    public function getIsVideoAttribute(): bool
    {
        return $this->media_type === 'video';
    }

    public function isVideo(): bool
    {
        return $this->getIsVideoAttribute();
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopePublished($query)
    {
        return $query->where(function ($query) {
            $query->whereNull('published_at')
                ->orWhere('published_at', '<=', now());
        });
    }

    protected function resolvePublicAssetUrl(?string $value, ?string $fallback = null): ?string
    {
        if (! $value) {
            return $fallback;
        }

        if (Str::startsWith($value, ['http://', 'https://', '//'])) {
            return $value;
        }

        $stripPrefixes = static function (string $path, array $prefixes): string {
            do {
                $originalPath = $path;

                foreach ($prefixes as $prefix) {
                    if (Str::startsWith($path, $prefix)) {
                        $path = substr($path, strlen($prefix));
                    }
                }
            } while ($path !== $originalPath);

            return $path;
        };

        $trimmedPath = ltrim(str_replace('\\', '/', $value), '/');

        $normalizedPath = ltrim($stripPrefixes($trimmedPath, ['public/', 'app/public/']), '/');

        if ($normalizedPath !== '' && File::exists(public_path($normalizedPath))) {
            return asset($normalizedPath);
        }

        $storagePath = ltrim($stripPrefixes($trimmedPath, ['storage/', 'public/', 'app/public/']), '/');

        if ($storagePath === '') {
            return $fallback;
        }

        $disk = Storage::disk('public');
        $diskDriver = config('filesystems.disks.public.driver');

        try {
            $url = $disk->url($storagePath);
        } catch (\Throwable $exception) {
            $url = null;
        }

        if ($url) {
            $url = str_replace('\\', '/', $url);
        }

        if ($diskDriver === 'local' && $disk->exists($storagePath)) {
            return asset('storage/'.$storagePath);
        }

        if ($url) {
            if (Str::startsWith($url, ['http://', 'https://', '//'])) {
                return $url;
            }

            return url('/'.ltrim($url, '/'));
        }

        if ($disk->exists($storagePath)) {
            return asset('storage/'.$storagePath);
        }

        return $fallback;
    }

    protected function isStreamableFileUrl(string $url): bool
    {
        if (! filter_var($url, FILTER_VALIDATE_URL)) {
            return false;
        }

        $path = parse_url($url, PHP_URL_PATH) ?? '';

        if (! $path) {
            return false;
        }

        $extensions = ['.mp4', '.webm', '.ogg', '.ogv', '.mov', '.m4v', '.m3u8'];

        $path = strtolower($path);

        foreach ($extensions as $extension) {
            if (str_ends_with($path, $extension)) {
                return true;
            }
        }

        return false;
    }
}
