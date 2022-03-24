<?php

namespace App\Nova;

use Ebess\AdvancedNovaMediaLibrary\Fields\Files;
use Illuminate\Http\Request;
use Johnathan\NovaTrumbowyg\NovaTrumbowyg;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

class
LegalDocument extends Resource
{
    public static function label()
    {
        return __('Legal Documents');
    }

    public static function singularLabel()
    {
        return __('Legal Document');
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\LegalDocument';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name'
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
            ID::make()->hideFromIndex()->sortable(),

            Text::make('Name')
                ->sortable()
                ->rules('required')
                ->creationRules('unique:legal_documents,name')
                ->updateRules('unique:legal_documents,name,{{resourceId}}'),

            Text::make('Url')
                ->rules('required', 'max:50'),

            NovaTrumbowyg::make('Contenido', 'content')
                ->rules('required')
                ->hideFromIndex(),

            Files::make(__('Document'))
                ->singleMediaRules('max:500000')
                ->hideFromIndex()
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
