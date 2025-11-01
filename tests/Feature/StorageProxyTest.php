<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StorageProxyTest extends TestCase
{
    public function test_it_streams_existing_files_from_public_disk(): void
    {
        Storage::fake('public');

        Storage::disk('public')->put('images/example.txt', 'stored content');

        $response = $this->get('/storage/images/example.txt');

        $response->assertOk();
        $this->assertSame('stored content', $response->streamedContent());
        $this->assertTrue($response->headers->has('Content-Type'));
    }

    public function test_it_returns_not_found_for_missing_files(): void
    {
        Storage::fake('public');

        $response = $this->get('/storage/images/missing.txt');

        $response->assertNotFound();
    }

    public function test_it_blocks_path_traversal_attempts(): void
    {
        Storage::fake('public');

        $response = $this->get('/storage/../.env');

        $response->assertNotFound();
    }
}
