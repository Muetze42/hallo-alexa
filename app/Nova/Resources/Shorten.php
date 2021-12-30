<?php

namespace App\Nova\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use DigitalCreative\ConditionalContainer\ConditionalContainer;
use DigitalCreative\ConditionalContainer\HasConditionalContainer;

class Shorten extends Resource
{
    use HasConditionalContainer;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\Shorten::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'uri';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'uri',
        'target',
        'module',
        'description',
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
            Text::make(config('app.url').'/', 'uri')
                ->rules('required', function ($attribute, $value, $fail) use ($request) {
                    $id = !empty($this->id) ? $this->id : 0;
                    $realValue = Str::slug(trim($value), '-', 'de');
                    $routes = json_decode(file_get_contents(storage_path('data/routes.json')));

                    if (in_array($realValue, $routes) || app(static::$model)::where($attribute, $realValue)->where('id', '!=', $id)->first()) {
                        return $fail(__('validation.unique', ['attribute' => __('Uri').' ('.$realValue.')']));
                    }

                    return true;

                })->onlyOnForms()->placeholder('my-uri')->help(__('Allowed characters: <strong>a-z</strong> and <strong>-</strong>')),
            Text::make(__('URL'), 'url', function () {
                return config('app.url').'/'.$this->uri;
            })->sortable()->exceptOnForms(),

            Boolean::make(__('External link'), 'external'),

            ConditionalContainer::make([
                Text::make(__('Link'), 'target')
                    ->onlyOnForms()->rules('required', 'string', 'url'),
            ])->if('external == 1')->onlyOnForms(),
            ConditionalContainer::make([
                Select::make(__('Module'), 'module')
                    ->onlyOnForms()->rules('required')->options([
                        'latest-youtube'   => __('Current YouTube Video'),
                        'latest-instagram' => __('Current Instagram Post'),
                        'latest-tiktok'    => __('Current TikTok'),
                    ])->displayUsingLabels(),
            ])->if('external != 1')->onlyOnForms(),

            Text::make(__('Target'), 'target')
                ->sortable()->exceptOnForms()->canSee(function () {
                    return $this->external;
                }),
            Text::make(__('Target'), 'module')
                ->sortable()->exceptOnForms()->canSee(function () {
                    return !$this->external;
                }),

            Text::make(__('Description'), 'description')
                ->sortable()->help(__('Optional'))
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
        return [];
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
