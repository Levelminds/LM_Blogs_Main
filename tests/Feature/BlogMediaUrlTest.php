<?php

namespace Tests\Feature;

use App\Models\Blog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BlogMediaUrlTest extends TestCase
{
    use RefreshDatabase;

    public function test_thumbnail_url_uses_public_storage_path(): void
    {
        Storage::fake('public');

        Storage::disk('public')->put('thumbnails/example.jpg', 'test-image');

        $blog = Blog::create([
            'title' => 'Media URL Test',
            'slug' => 'media-url-test-'.uniqid(),
            'content' => '<p>Test content</p>',
            'thumbnail' => 'thumbnails/example.jpg',
            'published_at' => now(),
            'media_type' => 'article',
        ]);

        $this->assertSame(
            route('storage.proxy', ['path' => 'thumbnails/example.jpg']),
            $blog->thumbnail_url
        );
    }

    public function test_thumbnail_url_corrects_missing_storage_prefix_from_public_disk(): void
    {
        config(['filesystems.disks.public.url' => '']);

        Storage::fake('public');

        Storage::disk('public')->put('thumbnails/missing-prefix.jpg', 'test-image');

        $blog = Blog::create([
            'title' => 'Missing Prefix',
            'slug' => 'missing-prefix-'.uniqid(),
            'content' => '<p>Test content</p>',
            'thumbnail' => 'thumbnails/missing-prefix.jpg',
            'published_at' => now(),
            'media_type' => 'article',
        ]);

        $this->assertSame(
            route('storage.proxy', ['path' => 'thumbnails/missing-prefix.jpg']),
            $blog->thumbnail_url
        );
    }

    public function test_video_stream_url_uses_public_storage_path_for_local_files(): void
    {
        Storage::fake('public');

        Storage::disk('public')->put('videos/example.mp4', 'test-video');

        $blog = Blog::create([
            'title' => 'Video URL Test',
            'slug' => 'video-url-test-'.uniqid(),
            'content' => '<p>Video content</p>',
            'video_path' => 'videos/example.mp4',
            'media_type' => 'video',
            'published_at' => now(),
        ]);

        $this->assertSame(
            route('storage.proxy', ['path' => 'videos/example.mp4']),
            $blog->video_stream_url
        );
    }

    public function test_blade_renders_normalized_thumbnail_url(): void
    {
        Storage::fake('public');

        Storage::disk('public')->put('thumbnails/rendered.jpg', 'test-image');

        $blog = Blog::create([
            'title' => 'Blade Render Test',
            'slug' => 'blade-render-test-'.uniqid(),
            'content' => '<p>Render content</p>',
            'thumbnail' => 'thumbnails/rendered.jpg',
            'published_at' => now(),
            'media_type' => 'article',
        ]);

        File::deleteDirectory(public_path('thumbnails'));

        $markup = Blade::render('<img src="{{ $blog->thumbnail_url }}">', [
            'blog' => $blog,
        ]);

        $this->assertStringContainsString(
            'src="'.route('storage.proxy', ['path' => 'thumbnails/rendered.jpg']).'"',
            $markup
        );
    }

    public function test_external_thumbnail_url_is_returned_unchanged(): void
    {
        $blog = new Blog([
            'title' => 'External Thumbnail',
            'slug' => 'external-thumb-'.uniqid(),
            'content' => '<p>External</p>',
            'thumbnail' => 'https://cdn.example.com/image.png',
        ]);

        $this->assertSame('https://cdn.example.com/image.png', $blog->thumbnail_url);
    }

    public function test_public_disk_external_url_prefers_current_host(): void
    {
        $originalDiskUrl = config('filesystems.disks.public.url');

        config(['filesystems.disks.public.url' => 'https://cdn.example.com/storage']);

        Storage::fake('public');

        Storage::disk('public')->put('thumbnails/regression.jpg', 'regression-image');
        Storage::disk('public')->put('videos/regression.mp4', 'regression-video');

        $blog = Blog::create([
            'title' => 'Regression Host Preference',
            'slug' => 'regression-host-preference-'.uniqid(),
            'content' => '<p>Regression</p>',
            'thumbnail' => 'thumbnails/regression.jpg',
            'video_path' => 'videos/regression.mp4',
            'media_type' => 'video',
            'published_at' => now(),
        ]);

        $expectedThumbnailUrl = route('storage.proxy', ['path' => 'thumbnails/regression.jpg']);
        $expectedVideoUrl = route('storage.proxy', ['path' => 'videos/regression.mp4']);

        $this->assertSame($expectedThumbnailUrl, $blog->thumbnail_url);
        $this->assertSame($expectedVideoUrl, $blog->video_stream_url);

        $markup = Blade::render(
            '<img src="{{ $blog->thumbnail_url }}"><video src="{{ $blog->video_stream_url }}"></video>',
            ['blog' => $blog]
        );

        $this->assertStringContainsString('src="'.$expectedThumbnailUrl.'"', $markup);
        $this->assertStringContainsString('src="'.$expectedVideoUrl.'"', $markup);
        $this->assertStringNotContainsString('https://cdn.example.com', $markup);

        config(['filesystems.disks.public.url' => $originalDiskUrl]);
    }
}
