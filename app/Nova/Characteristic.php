<?php

namespace App\Nova;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class Characteristic extends Resource
{
    use SoftDeletes;

    public static function label()
    {
        return __('Product Characteristics');
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Characteristic';

    /**
     * The multiple value that should be used to represent the resource when being displayed.
     **/
    public function title()
    {
        return $this->name . ': ' . $this->value;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name',
        'value'
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

            Select::make(__('Name'), 'name')->options([
                'Capacidad' => 'Capacidad',
                'Material' => 'Material'
            ])->sortable(),

            Text::make(__('Value'), 'value')->sortable(true),

//            BelongsToMany::make('Product')
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
