<?php

namespace App\Nova\Fields;

use Illuminate\Mail\Markdown;
use Laravel\Nova\Card;

class HtmlCard extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/3';

    /**
     * Create a new element.
     *
     * @param string|null $component
     * @return void
     */
    public function __construct($component = null)
    {
        parent::__construct($component);

        $this->withMeta([
            'center'            => false,
            'withoutCardStyles' => false,
            'forceFullWidth'    => false,
            'content'           => '',
        ]);
    }

    /**
     * @return string
     */
    public function component(): string
    {
        return 'html-card';
    }

    /**
     * Set HTML code to display in a card
     *
     * @param string $htmlContent
     *
     * @return HtmlCard
     */
    public function html(string $htmlContent): HtmlCard
    {
        return $this->withMeta(['content' => $htmlContent]);
    }

    /**
     * Use blade view file to render Card content.
     *
     * @param string $view
     * @param array $viewData
     *
     * @return HtmlCard
     */
    public function view(string $view, array $viewData = []): HtmlCard
    {
        $htmlContent = view($view, $viewData);

        return $this->html($htmlContent);
    }

    /**
     * Set Markdown code to display in a card (converted into HTML)
     *
     * @param string $view
     * @param array $viewData
     * @return HtmlCard
     */
    public function markdown(string $view, array $viewData = []): HtmlCard
    {
        $htmlContent = Markdown::parse(view($view, $viewData));

        return $this->html($htmlContent);
    }

    /**
     * Center card's content
     *
     * @param bool $centerContent
     *
     * @return HtmlCard
     */
    public function center(bool $centerContent = true): HtmlCard
    {
        return $this->withMeta(['center' => $centerContent]);
    }

    /**
     * Force Nova to apply full width for a card.
     * Nova has undocumented feature to auto-order cards based on width and put
     * full-width cards at the bottom. If you want to display full-width cards
     * not at the end, you should use with=1/3 or 2/3 and this method.
     * @see https://github.com/laravel/nova-issues/issues/1895#issuecomment-543684472
     *
     * @param bool $forceFullWidth
     *
     * @return HtmlCard
     */
    public function forceFullWidth(bool $forceFullWidth = true): HtmlCard
    {
        return $this->withMeta(['forceFullWidth' => $forceFullWidth]);
    }

    /**
     * Whether to use standard Nova Card styles for a card (background, padding, etc)
     *
     * @param bool $withoutStyles
     *
     * @return HtmlCard
     */
    public function withoutCardStyles(bool $withoutStyles = true): HtmlCard
    {
        return $this->withMeta(['withoutCardStyles' => $withoutStyles]);
    }
}
