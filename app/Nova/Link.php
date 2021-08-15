<?php

namespace App\Nova;

use Bernhardh\NovaIconSelect\IconProviders\FontAwesomeIconProvider;
use Bernhardh\NovaIconSelect\NovaIconSelect;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Text;
use App\Traits\HasSortableRows;
use Timothyasp\Color\Color;
use App\Nova\Metrics\LinkCountTrend;
use App\Nova\Metrics\LinkRealCountTrend;
use App\Nova\Metrics\LinkCounts;
use App\Nova\Metrics\LinkRealCounts;

class Link extends Resource
{
    use HasSortableRows;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\Link::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * Get the search result subtitle for the resource.
     *
     * @return string
     */
    public function subtitle(): string
    {
        return $this->target;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
        'target',
        'icon',
        'color',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param Request $request
     * @return array
     */
    public function fields(Request $request): array
    {
        return [
            Boolean::make(__('Active'), 'active')
                ->sortable(),

            NovaIconSelect::make('Icon')
                ->setIconProvider(new FontAwesomeIconProvider(['solid', 'regular', 'brands']))->nullable(),

            Text::make(__('Name'), 'name')
                ->sortable()->required()->rules('required', 'max:50'),

            Text::make(__('Link'), 'target')
                ->sortable()->required()->rules('required', 'url'),

            Color::make('Button Color', 'color')
                ->required()->rules('required'),

            Text::make(__('Count'), 'count', function () {
                return number_format($this->real_count, 0, ',', '.');
            })
                ->exceptOnForms()->sortable(),

            Text::make(__('Real Count'), 'real_count', function () {
                return number_format($this->real_count, 0, ',', '.');
            })->exceptOnForms()->sortable(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param Request $request
     * @return array
     */
    public function cards(Request $request): array
    {
        return [
            (new LinkCountTrend)->onlyOnDetail(),
            (new LinkRealCountTrend)->onlyOnDetail(),
            new LinkCounts,
            new LinkRealCounts,
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param Request $request
     * @return array
     */
    public function filters(Request $request): array
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param Request $request
     * @return array
     */
    public function lenses(Request $request): array
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param Request $request
     * @return array
     */
    public function actions(Request $request): array
    {
        return [];
    }
}
