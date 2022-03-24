<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class Catalog extends Resource
{
    public static function label()
    {
        return __('Catalogs');
    }

    public static function singularLabel()
    {
        return __('Catalog');
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Catalog';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'type';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'type',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->hideFromIndex()->hideFromDetail()->sortable(),
            Select::make(__('Type'), 'type')->options([
                'home' => __('Home')
            ])
                ->displayUsingLabels()
                ->rules('required'),
//            Files::make(__('File'))
//                ->singleMediaRules('max:500000')
//                ->hideFromIndex(),
            Text::make(__('Url'), 'url')
                ->rules('required'),
            HasMany::make(__('Downloads'), 'catalogDownloads', CatalogDownload::class)
                ->rules('required')
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
