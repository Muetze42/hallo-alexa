<?php

namespace App\Nova\Metrics\Browser;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;
use Laravel\Nova\Metrics\PartitionResult;
use App\Models\Browser;

class DeviceFamily extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param NovaRequest $request
     * @return PartitionResult
     */
    public function calculate(NovaRequest $request): PartitionResult
    {
        return $this->count($request, Browser::whereNotNull('device_family')
            ->where('device_family', '!=', ''), 'device_family');
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
        return 'browser-device-family';
    }
}
