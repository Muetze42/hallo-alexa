<?php

namespace App\Console\Commands\App;

class CleanCacheMonthly extends CleanCacheDaily
{
    protected array $cacheKeys = [
        'instagram-best-experience',
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:cache:monthly';
}
