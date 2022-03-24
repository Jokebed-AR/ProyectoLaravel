<?php

namespace App\Nova;


use App\Nova\Filters\ProductBrand;
use App\Nova\Filters\ProductCategory;
use App\Nova\Filters\ProductSubcategory;
use Ebess\AdvancedNovaMediaLibrary\Fields\Files;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Ebess\AdvancedNovaMediaLibrary\Fields\Media;
use Emilianotisato\NovaTinyMCE\NovaTinyMCE;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Illuminate\Http\Request;
use Johnathan\NovaTrumbowyg\NovaTrumbowyg;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Panel;
use Orlyapps\NovaBelongsToDepend\NovaBelongsToDepend;
use NovaAttachMany\AttachMany;
use NovaItemsField\Items;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;
use Slashweb\ProductVariants\ProductVariants;
use Tecnotanques\CurrencyField\CurrencyField;
use Tecnotanques\StringLimit\StringLimit;
use Tecnotanques\TabsAdditionalCharacteristics\TabsAdditionalCharacteristics;

class Product extends Resource
{

    use HasSortableRows;

    public static function singularLabel()
    {
        return __('Product');
    }

    public static function label()
    {
        return __('Products');
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Product';

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
        'id', 'name', 'url'
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

            new Panel(__('Basic information'), $this->basicAdjustments()),

            new Panel(__('SEO'), $this->seo()),

            new Panel(__('Price'), $this->price()),

            new Panel(__('Discount'), $this->discounts()),

            new Panel(__('Variants'), $this->variants()),


            new Panel(__('Additional Characteristics'), $this->additionalCharacteristics()),

            Images::make(__('Images'), 'products') // second parameter is the media collection name
            ->customPropertiesFields([
                Text::make('Alt')->rules('required')
            ])
                ->conversionOnPreview('thumb') // conversion used to display the "original" image
                ->conversionOnDetailView('thumb') // conversion used on the model's view
                ->conversionOnIndexView('thumb') // conversion used to display the image on the model's index page
                ->conversionOnForm('thumb') // conversion used to display the image on the model's form
                ->fullSize() // full size column
                ->rules('required') // validation rules for the collection of images
                ->setFileName(function($originalFilename, $extension, $model){
                    return md5($originalFilename) . '.' . $extension;
                })
                ->hideFromIndex(),

            Items::make(__('URLS Videos'), 'video_urls')->placeholder('Agregar otra url de video')
                ->createButtonValue('+')
                ->hideFromIndex(),


            Media::make(__('Videos'))
                ->conversionOnIndexView('thumb')
                ->singleMediaRules('max:500000')
                ->hideFromIndex(),

            Files::make(__('Documents'))
                ->customPropertiesFields([
                    Text::make('Name')->rules('required')
                ])
                ->singleMediaRules('max:500000')
                ->hideFromIndex(),


        ];
    }

    protected function basicAdjustments()
    {
        return [
            StringLimit::make(__('Name'), 'name')
                ->rules('required', 'max:50')
                ->max(50),
            StringLimit::make('Sku')
                ->rules('required', 'max:50')
                ->max(50),

            Number::make(__('Quantity'), 'quantity')
                ->rules('numeric', 'required', 'min:0'),

            NovaBelongsToDepend::make(__('Category'), 'category', Category::class)
                ->options(\App\Models\Category::all()),
//            BelongsTo::make(__('Subcategory'), 'subcategory', SubCategory::class),
            NovaBelongsToDepend::make(__('Subcategory'), 'subcategory', SubCategory::class)
                ->optionsResolve(function ($category) {
                    return $category->subcategories()->get(['id', 'name']);
                })
                ->dependsOn('Category')
                ->rules('required'),


            BelongsTo::make(__('Brand'), 'brand', Brand::class),
            NovaTinyMCE::make(__('Description'), 'description')->hideFromIndex()
                ->options([
                    'use_lfm' => true,
                    'plugins' => [
                        'lists preview hr anchor pagebreak image wordcount fullscreen directionality paste textpattern table code'
                    ]
                ]),
            NovaTrumbowyg::make(__('Resume'), 'resum')->hideFromIndex(),
            Text::make('Url')
                ->rules('required', 'alpha_dash')
//                ->creationRules('unique:products,url')
//                ->updateRules('unique:products,url,{{resourceId}}')
                ->hideFromIndex(),
            Text::make(__('Redirect'), 'redirect')
                ->nullable()
                ->help('En caso que desees que el producto mande a una página en específico')
                ->hideFromIndex(),

            AttachMany::make(__('Characteristics'), 'Characteristics'),

            Boolean::make(__('Show In Home'), 'show_in_home')
                ->nullable(),

            BelongsToMany::make('Characteristics')
        ];
    }

    protected function variants()
    {
        return [
            Boolean::make(__('Has Variants'), 'has_variants')
                ->nullable(),

            NovaDependencyContainer::make([
                ProductVariants::make(__('Variants'), 'variants')
                    ->withMeta([
                        'attributes' => \App\Models\Attribute::with('options')->get(),
                        'variants' => $this->getVariants(),
                        'optionsSelected' => $this->optionsSelected()
                    ])
                    ->hideFromIndex()
                    ->hideFromDetail()
            ])->dependsOn('has_variants', true),
        ];
    }

    protected function seo()
    {
        return [
            Text::make(__('Meta title'), 'meta_title')
                ->rules('required')
                ->hideFromIndex(),
            Text::make(__('Meta description'), 'meta_description')
                ->rules('required')
                ->hideFromIndex(),
        ];
    }

    protected function price()
    {
        return [
            CurrencyField::make(__('Price'), 'normal_price')
                ->nullable(),
            CurrencyField::make(__('Price with taxes'), 'price_tax')
                ->nullable(),
        ];
    }

    protected function discounts()
    {
        return [
            Number::make(__('Discounts'), 'discount')
                ->hideFromIndex(),
            Number::make(__('Discount in delivery'), 'discount_delivery')
                ->hideFromIndex(),
//            HasOne::make('Accesorio gratis', 'free_accesory', 'App\Nova\Product')
        ];
    }

    protected function additionalCharacteristics()
    {
        return [
            TabsAdditionalCharacteristics::make(__('Additional Characteristics'), 'additional_characteristics')
                ->hideFromIndex()
                ->rules('required', 'json')
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
        return [
            new ProductCategory,
            new ProductSubcategory,
            new ProductBrand
        ];
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
