<?php

namespace App\Console\Commands\App;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AssignedRoutes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assigned:routes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get assigned routes and save data to `storage/data/routes.json`';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        if (!is_dir(storage_path('data'))) {
            mkdir(storage_path('data'));
        }

        $uris = [];
        Artisan::call('route:list --compact --method=GET');

        $lines = explode("\n", Artisan::output());
        foreach ($lines as $line) {
            $column = explode('|', $line);
            if (!empty($column[1]) && trim($column[1]) == 'GET') {
                $parts = explode('/', trim($column[3]));
                if (!empty($parts[0])) {
                    //$uris[] = $parts[0];
                    array_push($uris, $parts[0]);
                }
            }
        }

        $data = array_unique(array_values($uris));

        $file = storage_path('data/routes.json');
        file_put_contents($file, json_encode(array_values($data)));

        return 0;
    }
}
