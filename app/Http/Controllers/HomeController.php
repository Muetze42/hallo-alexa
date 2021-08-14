<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Link;
use App\Models\LinkMemory;

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

    public function redirect(Link $link, Request $request)
    {
        if (!$link->active) {
            abort(404);
        }

        $this->countClicks($link, $request);

        return redirect($link->target);
    }

    private function countClicks(Link $link, Request $request)
    {
        try {
            $link->update(['real_count' => DB::raw('real_count+1')]);

            $data = [
                'link_id' => $link->id,
                'os'      => getClientOS(),
                'client'  => request()->userAgent(),
                'ip'      => getClientIp(),
            ];
            $memory = LinkMemory::where($data)->where('updated_at', '>', now()->subHours(4))->first();

            if (!$memory) {
                $link->update(['count' => DB::raw('count+1')]);
                $memory = $link->memories()->updateOrCreate($data);
                $memory->touch();
            }
        } catch (\Exception $exception) {
            Log::error($exception);
        }
    }
}
