<?php

namespace App\Http\Controllers;

use App\Helpers\iCal;
use App\Models\Date;
use App\Models\DateCategory;
use App\Notifications\Telegram\ErrorReport;
use App\Nova\Metrics\Referrer\ReferrerDomain;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;


class DevelopmentController extends Controller
{
    protected string $tomorrow;
    protected string $dayAfterTomorrow;

    public function index()
    {
        $this->tomorrow = now()->addDay()->toDateString();
        $this->dayAfterTomorrow = now()->addDays(2)->toDateString();
        $content = null;

        $categories = DateCategory::whereHas('dates', function ($query) {
            $query->where('date', $this->tomorrow);
        })->get()->pluck('name')->implode(', ');

        dd(lastAnd(($categories)));

        if ($categories) {
            $content = 'Morgen wird '.lastAnd($categories).' abgeholt';
        }

        $categories = DateCategory::whereHas('dates', function ($query) {
            $query->where('date', $this->dayAfterTomorrow);
        })->get()->pluck('name')->implode(', ');

        dd(lastAnd(($categories)));

//        $categories->dates()->update('notified');

//        Notification::send(681791255, new HtmlText($content));

        Date::where('date', $now)->orWhere('date', $now2)->update(['notified' => true]);

        dd($categories);
        dd($dates->category);
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
