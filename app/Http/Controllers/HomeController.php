<?php

namespace App\Http\Controllers;

use App\Traits\ClickCount;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Link;

class HomeController extends Controller
{
    use ClickCount;

    /**
     * @return Response
     */
    public function index(): Response
    {
        $links = Link::where('active', true)->orderBy('order')->get();

        return Inertia::render('Home/Index', [
            'links' => $links,
        ]);
    }

    /**
     * Handle the count stat for a link
     *
     * @param Link $link
     * @param Request $request
     */
    public function count(Link $link, Request $request)
    {
        if ($request->ajax() && $link->active) {
            $this->clickCount($link);
        }
    }
}
