<?php

namespace App\Http\Controllers;

use App\Models\Shorten;
use App\Models\Social;
use App\Traits\ClickCount;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class FallbackController extends Controller
{
    use ClickCount;

    /**
     * @param string|int|mixed $slug
     * @return Application|RedirectResponse|Redirector|void
     */
    public function slug(mixed $slug)
    {
        $redirect = null;
        $slug = trim($slug, '\\/');
        $shorten = Shorten::where('uri', $slug)->firstOrFail();

        $shorten->disableLogging();
        $shorten->timestamps = false;

        if ($shorten->external) {
            $redirect = $shorten->target;
        } else {
            switch ($shorten->module) {
                case 'latest-youtube':
                    $youTube = Social::where('provider', 'youtube')->firstOrFail();

                    $redirect = 'https://www.youtube.com/watch?v='.$youTube->provider_id;
                    break;
                case 'latest-instagram':
                    $insta = Social::where('provider', 'instagram')->firstOrFail();

                    $redirect = 'https://www.instagram.com/p/'.$insta->provider_id;
                    break;
                case 'latest-tiktok':
                    $tikTok = Social::where('provider', 'tiktok')->firstOrFail();

                    $redirect = sprintf(
                        'https://www.tiktok.com/@%s/video/%d',
                        config('services.tiktok.user_name'),
                        $tikTok->provider_id,
                    );
            }
        }

        $this->clickCount($shorten);

        return redirect($redirect);
    }
}
