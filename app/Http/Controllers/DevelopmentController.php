<?php

namespace App\Http\Controllers;

use App\Models\Referrer;
use Illuminate\Http\Request;


class DevelopmentController extends Controller
{
    public function index()
    {
        $ref = Referrer::find(7);

        dd($ref->host->name);
    }
}
