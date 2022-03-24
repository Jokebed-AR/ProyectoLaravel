<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Classification;
use App\Models\Catalog;
use App\Models\Product;
use App\Observers\ProductObserver;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $clasifications = [];
        $categories = [];
        $brands = [];
        $catalog = null;
        Paginator::useBootstrap();
        if (Schema::hasTable('classifications')) {
            $clasifications = Classification::all();
        }
        if (Schema::hasTable('categories')) {
            $categories = Category::all();
        }

        if (Schema::hasTable('brands')) {
            $brands = Brand::all();
        }

        if (Schema::hasTable('catalogs')) {
            $catalog = Catalog::where('type', 'home')->first();
        }

        View::share('categoriesNavbar', $categories);
        View::share('brands', $brands);
        View::share('clasifications', $clasifications);
        View::share('catalog', $catalog);
    }
}
