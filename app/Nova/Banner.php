<?php

namespace App\Nova;

use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;

class Banner extends Resource
{
    use HasSortableRows;

    public static function label()
    {
        return __('Banners');
    }

    public static function singularLabel()
    {
        return __('Banner');
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Banner';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'title', 'description'
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

            Text::make(__('Title'), 'title')
                ->sortable()
                ->help('Puede ir vacío para que no se vea en la página')
                ->nullable(),

            Text::make(__('Description'), 'description')
                ->sortable()
                ->help('Puede ir vacío para que no se vea en la página')
                ->nullable(),

            Images::make(__('Image Desktop'), 'image-desktop') // second parameter is the media collection name
            ->fullSize() // full size column
            ->rules('required') // validation rules for the collection of images
            ->setFileName(function($originalFilename, $extension, $model){
                return md5($originalFilename) . '.' . $extension;
            })
            ->hideFromIndex(),

            Images::make(__('Image Mobile'), 'image-mobile') // second parameter is the media collection name
            ->fullSize() // full size column
            ->help('Tamaño 380x550')
            ->rules('required') // validation rules for the collection of images
            ->setFileName(function($originalFilename, $extension, $model){
                return md5($originalFilename) . '.' . $extension;
            })
            ->hideFromIndex(),

//            Text::make(__('Button Text'), 'button_text')
//                ->sortable()
//                ->nullable()
//                ->help('En caso que quieran mostrar algún botón'),

            Text::make(__('Redirect'), 'button_redirect')
                ->sortable()
                ->nullable()
                ->hideFromIndex()
                ->help('En caso que quieran que al dar click mande a una URL'),

            Boolean::make(__('Is Active'), 'is_active')
                ->default(1)
                ->nullable(),

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
