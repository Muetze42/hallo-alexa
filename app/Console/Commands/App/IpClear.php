<?php

namespace App\Console\Commands\App;

use Illuminate\Console\Command;
use App\Models\Browser;
use App\Models\Click;
use App\Models\Referrer;

class IpClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ip:clear';

    /**
     * The console command description.#
     *
     * @var string
     */
    protected $description = 'Set not longer needed IPs to null';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $delay = config('site.count_delay', 240);
        Click::where('created_at', '<', now()->subMinutes($delay))->update(['ip' => null]);

        Referrer::where('created_at', '<', now()->subHour())->update(['ip' => null]);
        Browser::where('created_at', '<', now()->subDay())->update(['ip' => null]);

        return 0;
    }
}
