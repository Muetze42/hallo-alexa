<?php

namespace App\Http\Controllers;

use App\Models\Referrer;
use App\Models\ReferrerHost;
use Illuminate\Http\Request;
use Browser;


class DevelopmentController extends Controller
{
    public function index()
    {
        $browser = Browser::detect();

        dd($browser);
    }
}
