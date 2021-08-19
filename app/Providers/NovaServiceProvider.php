<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use App\Nova\Metrics\Browser\BrowserEngine;
use App\Nova\Metrics\Browser\BrowserFamily;
use App\Nova\Metrics\Browser\DeviceOs;
use App\Nova\Metrics\Browser\DeviceFamily;
use App\Nova\Metrics\Browser\DeviceModel;
use App\Nova\Metrics\Browser\DeviceType;
use App\Nova\Metrics\Browser\MobileGrade;
use App\Nova\Metrics\Browser\PlatformFamily;
use App\Nova\Metrics\Browser\PlatformName;
use App\Nova\Metrics\Referrer\ReferrerDomain;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        parent::boot();
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes(): void
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate(): void
    {
        Gate::define('viewNova', function ($user) {
            return true;
//            return in_array($user->email, [
//                //
//            ]);
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards(): array
    {
        return [
            new DeviceType,
            new ReferrerDomain,
            new DeviceOs,
            new BrowserFamily,
            new PlatformFamily,
            new BrowserEngine,
            new PlatformName,
            new DeviceFamily,
            new MobileGrade,
            new DeviceModel,
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards(): array
    {
        return [];
    }

    /**
     * Register the application's Nova resources.
     *
     * @return void
     */
    protected function resources(): void
    {
        Nova::resourcesIn(app_path('Nova/Resources'));
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools(): array
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        Nova::sortResourcesBy(function ($resource) {
            return $resource::$priority ?? 99999;
        });
    }
}
