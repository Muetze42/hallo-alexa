<?php

namespace App\Http\Controllers;

use App\Helpers\iCal;
use App\Helpers\Sitemap;
use App\Models\Date;
use App\Models\DateCategory;
use App\Notifications\Telegram\ErrorReport;
use App\Nova\Metrics\Referrer\ReferrerDomain;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\View;


class DevelopmentController extends Controller
{
    protected string $tomorrow;
    protected string $dayAfterTomorrow;

    public function index()
    {
        (new Sitemap)->create();

        $page = Page::find(2);

        $media = $page->getFirstMediaPath('og', 'og');

        dd($media);
    }

    public function getDomain(?string $url): string
    {
        $pieces = parse_url($url);
        $domain = $pieces['host'] ?? '';
        if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
            return $regs['domain'];
        }
        return $domain;
    }

    public function getColumns(string $table)
    {
        return Schema::getColumnListing($table);
    }
}
