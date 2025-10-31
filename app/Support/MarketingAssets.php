<?php

namespace App\Support;

class MarketingAssets
{
    /**
     * Resolve the URL for a marketing asset image.
     */
    public function url(string $path): string
    {
        $path = ltrim($path, '/');
        $relativePath = "images/marketing/{$path}";
        $localPath = public_path($relativePath);

        if (is_file($localPath)) {
            return asset($relativePath);
        }

        $baseUrl = rtrim((string) config('marketing.asset_base_url', ''), '/');

        if ($baseUrl === '') {
            return asset($relativePath);
        }

        return $baseUrl . '/' . $path;
    }
}
