<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\LinkCount;

class IpClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ip:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set not longer needed IPs to null of the `link_counts` table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $delay = config('muetze-site.count_delay', 240)+1440;
        LinkCount::where('created_at', '<', now()->subMinutes($delay))->update(['ip' => null]);

        return 0;
    }
}
