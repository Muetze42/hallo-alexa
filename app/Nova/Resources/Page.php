<?php

namespace App\Nova\Resources;

use ElevateDigital\CharcountedFields\TextareaCounted;
use ElevateDigital\CharcountedFields\TextCounted;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Page extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\Page::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label(): string
    {
        return __('SEO');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel(): string
    {
        return __('SEO');
    }

    /**
     * Get the logical group associated with the resource.
     *
     * @return string
     */
    public static function group(): string
    {
        return __('System');
    }

    /**
     * Custom priority level of the resource.
     *
     * @var int
     */
    public static int $priority = 10;

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'route',
        'title',
        'description',
        'og_title',
        'og_description',
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
            TextCounted::make('Meta title', 'title')
                ->maxChars(60)
                ->warningAt(50)
                ->withMeta(['extraAttributes' => ['maxlength' => '65']])
                ->required()
                ->rules('required'),

            Text::make('Meta Description', 'description', function () {
                return e($this->description);
            })->asHtml()->exceptOnForms(),
            TextareaCounted::make('Meta Description', 'description')
                ->maxChars(250)
                ->warningAt(155)
                ->withMeta(['extraAttributes' => [
                    'maxlength' => '250',
                    'rows' => 2,
                ]])
                ->help(__('Dieser Text wird bei Suchmaschinen unter den Links angezeigt. Die optimale Länger dieser Beschreibung ist <strong>zwischen 120 und 156</strong> Zeichen lang.'))
                ->required()
                ->rules('required')
                ->onlyOnForms(),

            Select::make(__('Robots'), 'robots')->options([
                3 => __(static::$model::ROBOTS[3]),
                2 => __(static::$model::ROBOTS[2]),
                1 => __(static::$model::ROBOTS[1]),
                0 => __(static::$model::ROBOTS[0]),
            ])->displayUsingLabels(),

            Heading::make(__('OpenGraph <small>(Aussehen, wenn die Seite geteilt wird)</small>'))->asHtml(),

            TextareaCounted::make('Meta Description', 'description')
                ->maxChars(300)
                ->warningAt(100)
                ->withMeta(['extraAttributes' => [
                    'maxlength' => '300',
                    'rows' => 2,
                ]])
                ->help(__('Optional. Es das Feld leer bleibt wird die Meta Description genutzt. Dieser Text kann ruhig länger sein. Dieser wird in Kommentare bei 110- & als Post bei 300 Zeichen abgeschnitten.'))
                ->onlyOnForms(),
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
