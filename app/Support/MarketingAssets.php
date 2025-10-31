<?php

namespace App\Support;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MarketingAssets
{
    /**
     * Resolve the URL for a marketing asset image.
     */
    public function url(string $path): string
    {
        $path = ltrim($path, '/');

        if ($path === '') {
            return $this->placeholderUrl();
        }

        if (Str::startsWith($path, ['http://', 'https://', '//'])) {
            return $path;
        }

        $publicCandidates = [
            "images/marketing/{$path}",
            "images/{$path}",
        ];

        foreach ($publicCandidates as $candidate) {
            if (File::exists(public_path($candidate))) {
                return asset($candidate);
            }
        }

        $disk = Storage::disk('public');
        $storageCandidates = [
            $path,
            "marketing/{$path}",
            "assets/img/{$path}",
        ];

        foreach ($storageCandidates as $candidate) {
            if ($disk->exists($candidate)) {
                return $disk->url($candidate);
            }
        }

        $baseUrl = rtrim((string) config('marketing.asset_base_url', ''), '/');

        if ($baseUrl !== '') {
            return $baseUrl.'/'.$path;
        }

        return $this->placeholderUrl();
    }

    protected function placeholderUrl(): string
    {
        $placeholder = ltrim((string) config('marketing.placeholder_path', 'images/branding/marketing-placeholder.svg'), '/');

        if ($placeholder === '') {
            return asset('images/branding/logo.svg');
        }

        if (File::exists(public_path($placeholder))) {
            return asset($placeholder);
        }

        return asset('images/branding/logo.svg');
    }
}
