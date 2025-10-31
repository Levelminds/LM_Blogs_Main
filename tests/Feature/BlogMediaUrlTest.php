<?php

namespace Tests\Feature;

use App\Models\Blog;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
            url('storage/thumbnails/example.jpg'),
            $blog->thumbnail_url
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
}
