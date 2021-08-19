<?php

namespace App\Exceptions;

use App\Notifications\Telegram\ErrorReport;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Get the URI key for the notification remember cache.
     *
     * @var string
     */
    protected string $cacheNotificationKey = 'error-report-notification';

    /**
     * Report or log an exception.
     *
     * @param  Throwable  $e
     * @return void
     *
     * @throws Throwable
     */
    public function report(Throwable $e): void
    {
        $this->errorReport($e);
        parent::report($e);
    }

    protected function errorReport(Throwable $exception)
    {
        if (!$this->shouldntReport($exception) && config('app.env', 'production') == 'production' &&
            !str_starts_with(trim($exception), 'Symfony\Component\Console\Exception\CommandNotFoundException') &&
            !str_starts_with(trim($exception), 'Symfony\Component\Console\Exception\NamespaceNotFoundException')) {

             $status = Cache::get($this->cacheNotificationKey);

            if ($status != 'send') {
                Notification::send(681791255, new ErrorReport($exception));

                if(!$status) {
                    Cache::add($this->cacheNotificationKey, 'send', config('muetze-site.error-report.throttle', 3600));
                }
            }
        }
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
