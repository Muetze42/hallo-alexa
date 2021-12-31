<?php

namespace App\Console\Commands\App;

use Illuminate\Foundation\Console\DownCommand as Command;
use Illuminate\Foundation\Exceptions\RegisterErrorViewPaths;

class DownCommand extends Command
{
    /**
     * Get the payload to be placed in the "down" file.
     *
     * @return array
     */
    protected function getDownFilePayload(): array
    {
        return [
            'except' => $this->excludedPaths(),
            'redirect' => $this->redirectPath(),
            'retry' => $this->getRetryTime(),
            'refresh' => $this->option('refresh'),
            'secret' => $this->option('secret'),
            'status' => (int) $this->option('status', 503),
            'template' => $this->prerenderView(),
        ];
    }

    /**
     * Prerender the specified view so that it can be rendered even before loading Composer.
     *
     * @return string
     */
    protected function prerenderView(): string
    {
        (new RegisterErrorViewPaths)();

        return view(($this->option('render') ? $this->option('render') : 'errors::503'), [
            'retryAfter' => $this->option('retry'),
        ])->render();
    }
}
