<?php

namespace App\Nova;

use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Emilianotisato\NovaTinyMCE\NovaTinyMCE;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use NovaItemsField\Items;
use Ebess\AdvancedNovaMediaLibrary\Fields\Media;

class LandingPage extends Resource
{

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\LandingPage::class;

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
        'title',
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
            Text::make(__('Título de la url'), 'title')
                ->rules('max:255')
                ->help('Este título se parsea a formato url automáticamente')
                ->nullable(),

            Text::make(__('Título inicial'), 'website_title')
                ->rules('max:255')
                ->help('Título que aparecerá en la página')
                ->nullable(),

            Text::make(__('SEO Name'), 'seo_name')
                ->hideWhenUpdating()
                ->hideWhenCreating(),

            Text::make(__('Meta title'), 'meta_title')
                ->rules('required')
                ->hideFromIndex(),
            Text::make(__('Meta description'), 'meta_description')
                ->rules('required')
                ->hideFromIndex(),

            NovaTinyMCE::make(__('Description 1'), 'description_1')->hideFromIndex()
                ->options([
                    'use_lfm' => true,
                    'plugins' => [
                        'lists advlist preview hr anchor pagebreak image wordcount fullscreen directionality paste textpattern table code '
                    ]
                ]),
            NovaTinyMCE::make(__('Description 2'), 'description_2')->hideFromIndex()
                ->options([
                    'use_lfm' => true,
                    'plugins' => [
                        'lists advlist preview hr anchor pagebreak image wordcount fullscreen directionality paste textpattern table code '
                    ]
                ]),

            Images::make(__('Image 1'), 'image_1')
                ->hideFromIndex()
                ->nullable(),

            Images::make(__('Image 2'), 'image_2')
                ->hideFromIndex()
                ->nullable(),

            Boolean::make(__('Es página de contacto?'), 'is_contact')
                ->nullable()
                ->help('Para saber si es página de ccontacto')
                ->default(true),

            Boolean::make(__('Has Form'), 'has_form')
                ->nullable()
                ->help('Para saber si lleva formulario de contacto')
                ->default(true),

            NovaDependencyContainer::make([
                Text::make(__('Form Title'), 'form_title')
                    ->rules('max:255')
                    ->nullable(),
            ])->dependsOn('has_form', true),

            Text::make(__('Related Products Title'), 'related_products_title')
                ->rules('max:255')
                ->nullable(),

            Text::make(__('Videos Title'), 'videos_title')
                ->rules('max:255')
                ->nullable(),
            Items::make(__('URLS Videos'), 'video_urls')->placeholder('Agregar otra url de video')
                ->createButtonValue('+')
                ->hideFromIndex(),

            BelongsToMany::make(__('Products'), 'products', Product::class)
                ->nullable()

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
        return [
            (new DownloadExcel())->withHeadings()
        ];
    }

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Landing Pages');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Landing Page');
    }
}
