<?php

use App\Support\MarketingAssets;

if (! function_exists('marketing_asset')) {
    function marketing_asset(string $path): string
    {
        return app(MarketingAssets::class)->url($path);
    }
}
