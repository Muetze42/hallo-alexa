<?php

namespace App\Http\Controllers;

use App\Models\Shorten;
use App\Models\Social;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class FallbackController extends Controller
{
    /**
     * @param string|int|mixed $slug
     * @return Application|RedirectResponse|Redirector|void
     */
    public function slug(mixed $slug)
    {
        $slug = trim($slug, '\\/');
        $shorten = Shorten::where('uri', $slug)->firstOrFail();
        if ($shorten->external) {
            return redirect($shorten->target);
        }

        switch ($shorten->module) {
            case 'latest-youtube':
                $youTube = Social::where('provider', 'youtube')->firstOrFail();

                return redirect('https://www.youtube.com/watch?v='.$youTube->provider_id);
            case 'latest-instagram':
                $insta = Social::where('provider', 'instagram')->firstOrFail();

                return redirect('https://www.instagram.com/p/'.$insta->provider_id);
        }

        abort(404);
    }
}
