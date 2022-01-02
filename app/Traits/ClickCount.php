<?php

namespace App\Traits;

use App\Models\Link;
use App\Models\Shorten;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait ClickCount
{
    use ErrorExceptionNotify;

    /**
     * @param Link|Shorten $model
     */
    protected function clickCount(Link|Shorten $model)
    {
        $model->disableLogging();
        $model->timestamps = false;

        try {
            $model->update(['real_count' => DB::raw('real_count+1')]);

            $delay = config('site.count_delay', 240);

            $data = [
                'os'      => getClientOS(),
                'client'  => request()->userAgent(),
                'ip'      => md5(getClientIp()),
            ];

            $model->clicksAll()->create($data);

            $count = $model->clicks()->where($data)->where('created_at', '>', now()->subMinutes($delay))->first();
            if (!$count) {
                $model->update(['count' => DB::raw('count+1')]);
                $model->clicks()->create($data);
            }
        } catch (Exception $exception) {
            Log::error($exception);
            $this->sendTelegramErrorMessage($exception);
        }
    }
}
