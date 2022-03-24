<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Tecnotanques\StringLimit\StringLimit;

class SeoPage extends Resource
{

    public static function label()
    {
        return __('SEO Pages');
    }

    public static function singularLabel()
    {
        return __('SEO Page');
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\SeoPage';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'meta_title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'meta_title', 'type'
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
                'home' => __('Home'),
                'contact' => __('Contact'),
                'ours' => __('Ours'),
                'default' => __('Default')
            ])
                ->displayUsingLabels()
                ->rules('required'),
            StringLimit::make(__('Meta Title'), 'meta_title')
                ->rules('required', 'max:50')
                ->max(50),
            StringLimit::make(__('Meta Description'), 'meta_description')
                ->rules('required', 'max:150')
                ->max(150),
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
