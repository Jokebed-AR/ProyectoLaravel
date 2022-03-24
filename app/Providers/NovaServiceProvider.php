<?php

namespace App\Providers;

use App\Nova\Metrics\ContactPerDay;
use App\Nova\Metrics\ProductPerBrand;
use App\Nova\Metrics\ProductPerCategory;
use App\Nova\Metrics\ProductPerSubcategory;
use DmitryBubyakin\NovaMedialibraryField\Resources\Media;
use Illuminate\Support\Facades\App;
use Laravel\Nova\Nova;
use Laravel\Nova\Cards\Help;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::serving(function () {
            App::setLocale('es');
        });

        Nova::resources([
            Media::class
        ]);
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
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
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            if( !$user->canAccessToDashboard() ) {
                abort(redirect('/')->with('warning', 'No tienes permisos para acceder a esta página.'));
                Auth::logout();
            }
            return true;
        });
    }

    /**
     * Get the cards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            ( new ContactPerDay() )->width('full'),
            ( new ProductPerBrand() )->width('1/3'),
            ( new ProductPerCategory() )->width('1/3'),
            ( new ProductPerSubcategory() )->width('1/3'),
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
