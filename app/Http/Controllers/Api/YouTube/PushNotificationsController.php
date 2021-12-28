<?php

namespace App\Http\Controllers\Api\YouTube;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PushNotificationsController extends Controller
{
    public function get(Request $request)
    {
        Log::debug('GET: '.print_r($request->all()));

        return true;
    }

    public function post(Request $request)
    {
        Log::debug('POST: '.print_r($request->all()));

        return true;
    }
}
