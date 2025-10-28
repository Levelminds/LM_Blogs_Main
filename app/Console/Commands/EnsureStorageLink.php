<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use RuntimeException;
use Throwable;

class EnsureStorageLink extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'storage:ensure-link {--force : Recreate the storage link or directory if it already exists.}';

    /**
     * The console command description.
     */
    protected $description = 'Create the storage symbolic link or copy the storage directory when symlinks are unavailable.';

    /**
     * Execute the console command.
     */
    public function handle(Filesystem $filesystem): int
    {
        $strategy = (string) Str::of(config('filesystems.storage_link_strategy', 'auto'))
            ->trim()
            ->lower();

        if (! in_array($strategy, ['auto', 'copy', 'skip'], true)) {
            $this->components->warn("Unknown STORAGE_LINK_STRATEGY value [{$strategy}]; falling back to 'auto'.");
            $strategy = 'auto';
        }

        if ($strategy === 'skip') {
            $this->components->info('Skipping storage link creation because STORAGE_LINK_STRATEGY=skip.');

            return self::SUCCESS;
        }

        $link = public_path('storage');
        $target = storage_path('app/public');

        if (! $filesystem->exists($target)) {
            $this->components->error("The storage path [{$target}] does not exist.");

            return self::FAILURE;
        }

        try {
            $this->removeExistingLinkOrDirectory($filesystem, $link);
        } catch (RuntimeException $exception) {
            $this->components->error($exception->getMessage());

            return self::FAILURE;
        }

        if ($strategy === 'copy') {
            return $this->copyStorageToPublic($filesystem, $target, $link);
        }

        try {
            $filesystem->link($target, $link);
            $this->components->info('The [public/storage] link has been connected to [storage/app/public].');

            return self::SUCCESS;
        } catch (Throwable $exception) {
            $this->components->warn('Failed to create storage symlink: '.$exception->getMessage());

            return $this->copyStorageToPublic($filesystem, $target, $link);
        }
    }

    protected function removeExistingLinkOrDirectory(Filesystem $filesystem, string $link): void
    {
        if (! file_exists($link)) {
            return;
        }

        if (! $this->option('force')) {
            throw new RuntimeException('The [public/storage] path already exists. Use --force to recreate it.');
        }

        if (is_link($link)) {
            $filesystem->delete($link);

            return;
        }

        $filesystem->deleteDirectory($link);
    }

    protected function copyStorageToPublic(Filesystem $filesystem, string $target, string $link): int
    {
        $filesystem->ensureDirectoryExists($link);
        $filesystem->copyDirectory($target, $link);

        $this->components->info('The storage contents have been copied to [public/storage].');

        return self::SUCCESS;
    }
}
