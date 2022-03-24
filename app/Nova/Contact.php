<?php

namespace App\Nova;

use App\Nova\Actions\ExportContacts;
use Bissolli\NovaPhoneField\PhoneNumber;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Contact extends Resource
{
    public static function label()
    {
        return __('Contacts');
    }

    public static function singularLabel()
    {
        return __('Contact');
    }

    const DEFAULT_INDEX_ORDER = 'created_at';


    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Contact';

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
        'id', 'name', 'phone', 'email', 'cellphone', 'shipping_place', 'substance_to_store', 'quantity'
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
            ID::make()->sortable()->hideFromIndex(),
            Text::make(__('Name'), 'name')
                ->rules('required', 'max:255'),
            Text::make('Email', 'email')
                ->rules('required', 'email', 'max:254'),
            PhoneNumber::make(__('Phone'), 'phone')
                ->withCustomFormats('####-####')
                ->rules('required'),
//            PhoneNumber::make(__('Cellphone'), 'cellphone')
//                ->onlyCountries('US', 'MX')
//                ->rules('required'),
            Text::make(__('Shipping place'), 'shipping_place')
                ->rules('required', 'max:255'),
            Text::make(__('Substance to store'), 'substance_to_store')
                ->rules('required', 'max:255'),
//            Text::make(__('Capacity'), 'capacity')
//                ->rules('required', 'max:255'),
            Number::make(__('Quantity'), 'quantity')
                ->step(0.1)
                ->rules('required', 'numeric'),
            Text::make(__('Sector'), 'sector')
                ->rules('required', 'max:255'),
            Text::make(__('Message'), 'message')
                ->rules('required', 'max:5000'),

//            BelongsToManyField::make(__('Products'), 'products', Product::class)
//                ->showAsListInDetail()
//                ->rules('required'),

            Date::make(__('Created At'), 'created_at')
                ->sortable()
                ->onlyOnIndex(),
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
            (new ExportContacts())->withHeadings('Id', 'Name', 'E-mail', 'Teléfono', 'Lugar de envío', 'Sustancia a almacenar', 'Cantidad', 'Sector', 'Mensaje', 'Productos', 'Fecha'),
        ];
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        $query->when(empty($request->get('orderBy')), function (Builder $q) {
            $q->getQuery()->orders = [];

            return $q->orderBy(static::DEFAULT_INDEX_ORDER, 'desc');
        });
    }

}
