<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use ScssPhp\ScssPhp\Exception\SassException;

class AdditionalExists
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws SassException
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (!file_exists(public_path('css/buttons.css'))) {
            gerateAdditionalStylesheet();
        }

        return $next($request);
    }
}
