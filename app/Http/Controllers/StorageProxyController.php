<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StorageProxyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $path): StreamedResponse
    {
        $decodedPath = rawurldecode($path);

        $normalizedPath = str_replace('\\', '/', $decodedPath);
        $normalizedPath = preg_replace('#/{2,}#', '/', $normalizedPath);
        $normalizedPath = ltrim($normalizedPath, '/');

        if ($this->isInvalidPath($normalizedPath)) {
            abort(404);
        }

        $disk = Storage::disk('public');

        if (! $disk->exists($normalizedPath)) {
            abort(404);
        }

        $stream = $disk->readStream($normalizedPath);

        if (! $stream) {
            abort(404);
        }

        $mimeType = $disk->mimeType($normalizedPath) ?: 'application/octet-stream';

        return Response::stream(function () use ($stream) {
            fpassthru($stream);
            if (is_resource($stream)) {
                fclose($stream);
            }
        }, 200, [
            'Content-Type' => $mimeType,
            'Content-Length' => $disk->size($normalizedPath),
        ]);
    }

    private function isInvalidPath(string $path): bool
    {
        $segments = explode('/', $path);

        foreach ($segments as $segment) {
            if ($segment === '..') {
                return true;
            }
        }

        return str_contains($path, "\0");
    }
}
