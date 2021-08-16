<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
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
        ]);
    }

    /**
     * @param Link $link
     * @param Request $request
     * @return Redirector|Application|RedirectResponse
     */
    public function redirect(Link $link, Request $request): Redirector|Application|RedirectResponse
    {
        if (!$link->active) {
            abort(404);
        }

        $this->countClicks($link, $request);

        return redirect($link->target);
    }

    /**
     * Handle the count stat for a link
     *
     * @param Link $link
     * @param Request $request
     */
    private function countClicks(Link $link, Request $request)
    {
        try {
            $link->update(['real_count' => DB::raw('real_count+1')]);

            $delay = config('muetze-site.count_delay', 240);

            $data = [
                'link_id' => $link->id,
                'os'      => getClientOS(),
                'client'  => request()->userAgent(),
                'ip'      => md5(getClientIp()),
            ];

            $link->realCounts()->create($data);

            $count = $link->counts()->where($data)->where('created_at', '>', now()->subMinutes($delay))->first();

            if (!$count) {
                $link->update(['count' => DB::raw('count+1')]);

                $link->counts()->create($data);
            }
        } catch (Exception $exception) {
            Log::error($exception);
        }
    }
}
