<?php

namespace App\Nova\Metrics;

use App\Models\LinkRealCount;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Trend;
use Laravel\Nova\Metrics\TrendResult;

class LinkRealCountTrend extends Trend
{
    /**
     * Calculate the value of the metric.
     *
     * @param NovaRequest $request
     * @return TrendResult
     */
    public function calculate(NovaRequest $request): TrendResult
    {
        return $this->countByDays($request, LinkRealCount::where('link_id', $request->resourceId));
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges(): array
    {
        return [
            7 => __(':days Days', ['days' => 7]),
            'TODAY' => __('Today'),
            2 => __(':days Days', ['days' => 2]),
            3 => __(':days Days', ['days' => 3]),
            4 => __(':days Days', ['days' => 4]),
            5 => __(':days Days', ['days' => 5]),
            30 => __(':days Days', ['days' => 30]),
            60 => __(':days Days', ['days' => 60]),
            365 => __(':days Days', ['days' => 365]),
            'MTD' => __('Month To Date'),
            'QTD' => __('Quarter To Date'),
            'YTD' => __('Year To Date'),
        ];
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return void
     */
    public function cacheFor(): void
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey(): string
    {
        return 'link-real-count-trend';
    }
}
