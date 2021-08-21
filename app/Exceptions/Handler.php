<?php

namespace App\Exceptions;

use App\Notifications\Telegram\ErrorReport;
use App\Traits\ErrorExceptionNotify;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Throwable;

class Handler extends ExceptionHandler
{
    use ErrorExceptionNotify;

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
        if (!$this->shouldntReport($exception) && /*config('app.env', 'production') == 'production' &&*/
            !str_starts_with(trim($exception), 'Symfony\Component\Console\Exception\CommandNotFoundException') &&
            !str_starts_with(trim($exception), 'Symfony\Component\Console\Exception\NamespaceNotFoundException')) {

            $this->sendTelegramMessage($exception);
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
