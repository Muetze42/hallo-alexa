<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Browser;


class DevelopmentController extends Controller
{
    public function index()
    {
        // When You call the detect function You will get a result object, from the current user's agent.
        $result = Browser::detect();

//        dd($result);

        // If You wana get browser details from a user agent other then the current user call the parse function.
        $result = Browser::parse('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.131 Safari/537.36');
        dd($result);
    }
}
