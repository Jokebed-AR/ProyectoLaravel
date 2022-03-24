<?php

namespace App\Nova;

use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Ebess\AdvancedNovaMediaLibrary\Fields\Media;
use Emilianotisato\NovaTinyMCE\NovaTinyMCE;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use NovaItemsField\Items;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;
use Slashweb\CommonQuestions\CommonQuestions;
use Tecnotanques\StringLimit\StringLimit;

class Category extends Resource
{

    use HasSortableRows;

    public static function label()
    {
        return __('Categories');
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Category';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

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
            Text::make(__('Name'), 'name')->sortable()
                ->rules('required', 'max:50')
                ->creationRules('unique:categories,name')
                ->updateRules('unique:categories,name,{{resourceId}}'),
            Textarea::make(__('Description'), 'description')
                ->hideFromIndex()
                ->rules('required', 'max:1000')
                ->hideFromIndex(),
            Image::make('Logo')->disk('s3'),
            Image::make(__('Image'), 'image')->disk('s3'),

            BelongsTo::make(__('Classification'), 'classification', Classification::class)
                ->nullable(),
            StringLimit::make(__('Meta Title'), 'meta_title')
                ->rules('required', 'max:50')
                ->max(50),
            StringLimit::make(__('Meta Description'), 'meta_description')
                ->rules('required', 'max:150')
                ->max(150),
            Text::make('Url')
                ->rules('required', 'max:50'),
            Text::make(__('Gallery Title'), 'gallery_title')
                ->rules('max:255')
                ->hideFromIndex()
                ->nullable(),
            Images::make(__('Gallery'), 'gallery')
                ->conversionOnDetailView('thumb')
                ->conversionOnIndexView('thumb')
                ->conversionOnForm('thumb')
                ->fullSize()
                ->nullable()
                ->singleImageRules('dimensions:min_width=100'),
            Text::make(__('Video Title'), 'video_title')
                ->rules('max:255')
                ->hideFromIndex()
                ->nullable(),
            Media::make(__('Videos'))
                ->conversionOnIndexView('thumb')
                ->singleMediaRules('max:500000')
                ->nullable()
                ->hideFromIndex(),
            Items::make(__('URLS Videos'), 'video_urls')
                ->placeholder('Agregar otra url de video')
                ->createButtonValue('+')
                ->hideFromIndex()
                ->nullable(),
            HasMany::make(__('Subcategorias'), 'subcategories', SubCategory::class),
            HasMany::make(__('Productos'), 'products', Product::class),
            Text::make(__('Faq Title'), 'faq_title')
                ->rules('max:255')
                ->hideFromIndex()
                ->nullable(),
            CommonQuestions::make(__('Common questions'), 'questions')->hideFromIndex()->hideFromDetail(),
            Text::make(__('Extra Title'), 'extra_title')
                ->rules('max:255')
                ->hideFromIndex()
                ->nullable(),
            NovaTinyMCE::make(__('Extras'), 'measures')->hideFromIndex()
                ->options([
                    'use_lfm' => true,
                    'plugins' => [
                        'lists preview hr anchor pagebreak image wordcount fullscreen directionality paste textpattern table code'
                    ]
                ])
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
