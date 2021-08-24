<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Link;
use App\Models\Page;

class HomeController extends Controller
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        $links = Link::where('active', true)->orderBy('order')->get();

        $meta = Page::where('route', 'home')->first();

        return Inertia::render('Home/Index', [
            'links'     => $links,
            'metaTitle' => $meta->title,
            'metaDesc'  => $meta->description,
        ])->withViewData([
            'metaTitle'  => $meta->title,
            'metaDesc'   => $meta->description,
            'metaRobots' => Page::ROBOTS[$meta->robots],
        ]);
    }
}
