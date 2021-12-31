<?php

namespace App\Nova\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\MorphMany;
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
            Text::make(__('URL'), 'uri', function () {
                return '<span class="whitespace-no-wrap">'.e(config('app.url')).'/<span class="font-bold">'.e($this->uri).'</span></span>';
            })->sortable()->exceptOnForms()->asHtml(),

            Boolean::make(__('External link'), 'external')->sortable(),

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

            Text::make(__('Target'), 'target', function () {
                return '<a href="'.e($this->target).'" rel="noopener" class="'.config('muetze-site.nova.external_link_class').'">'.e($this->target).'</a><i class="'.config('muetze-site.nova.external_link_icon').'"></i>';
            })->sortable()->exceptOnForms()->canSee(function () {
                return $this->external;
            })->asHtml(),
            Text::make(__('Target'), 'module', function () {
                return match ($this->module) {
                    'latest-youtube' => '<span>'.__('Current YouTube Video').'</span>',
                    'latest-instagram' => '<span>'.__('Current Instagram Post').'</span>',
                    'latest-tiktok' => '<span>'.__('Current TikTok').'</span>',
                    default => $this->module,
                };
            })->sortable()->exceptOnForms()->canSee(function () {
                return !$this->external;
            })->asHtml(),

            Text::make(__('Description'), 'description')
                ->sortable()->help(__('Optional')),

            MorphMany::make(__('Activities'), 'activities', Activity::class),
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
