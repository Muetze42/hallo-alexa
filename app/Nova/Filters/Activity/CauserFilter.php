<?php

namespace App\Nova\Filters\Activity;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class CauserFilter extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    /**
     * Get the displayable name of the filter.
     *
     * @return string
     */
    public function name(): string
    {
        return __('Causer');
    }

    /**
     * Apply the filter to the given query.
     *
     * @param Request $request
     * @param Builder $query
     * @param mixed $value
     * @return Builder
     */
    public function apply(Request $request, $query, $value): Builder
    {
        if (!$value) {
            return $query->whereNull('causer_id');
        }
        return $query->where(function ($query) use ($value) {
            $parts = explode('|', $value);

            $query->where('causer_type', $parts[0])->where('causer_id', $parts[1]);
        });
    }

    /**
     * Get the filter's available options.
     *
     * @param Request $request
     * @return array
     */
    public function options(Request $request): array
    {
        $causers = Activity::whereNotNull('causer_type')->whereNotNull('causer_id')->get(['causer_type', 'causer_id']);

        foreach ($causers as $causer) {
            $resource = 'App\Nova\Resources\\'.class_basename($causer->causer_type);
            $key = !empty($resource::$title) ? $resource::$title : null;

            if (!$key) {
                $array[__('Deleted').'?'] = $causer->causer_type.'|'.$causer->causer_id;
                continue;
            }

            $label = $resource::singularLabel();
            $model = app($causer->causer_type)->find($causer->causer_id);

            $arrayKey = $label.': ';
            $arrayKey .= !empty($model->$key) ? $model->$key : __('Deleted').'?';
            $array[$arrayKey] = $causer->causer_type.'|'.$causer->causer_id;
        }

        if (!empty($array)) {
            ksort($array);
        }

        $array[__('System')] = 0;

        return $array;
    }
}
