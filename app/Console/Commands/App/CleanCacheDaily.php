<?php

namespace App\Console\Commands\App;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CleanCacheDaily extends Command
{
    protected array $cacheKeys = [
        'instagram28',
        'instagram-bulk-profile-scrapper',
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:cache:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear temporary used cache';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        foreach ($this->cacheKeys as $key) {
            Cache::forget($key);
        }

        return 0;
    }
}
