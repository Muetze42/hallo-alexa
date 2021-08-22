<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Link;

class HomeController extends Controller
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        $links = Link::where('active', true)->orderBy('order')->get();

        return Inertia::render('Home/Index', [
            'links' => $links,
            'title' => 'hallo_alexa_',
            'desc'  => 'Hi! Mein Name ist Alexa, komme aus Frankfurt am Main und streame seit dem 12. April 2020 auf Twitch. Meine Community ist aufgeschlossen, freundlich und familiär!',
        ])->withViewData([
            'desc'  => 'Hi! Mein Name ist Alexa, komme aus Frankfurt am Main und streame seit dem 12. April 2020 auf Twitch. Meine Community ist aufgeschlossen, freundlich und familiär!',
        ]);
    }
}
