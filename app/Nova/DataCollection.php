<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class DataCollection extends Resource
{
    public static function label()
    {
        return __('Data Collections');
    }

    public static function singularLabel()
    {
        return __('Data collection');
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\DataCollection';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'section';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'section',
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

            Text::make(__('Section'), 'section')
                ->sortable()
                ->rules('required'),

            Text::make(__('Notify to'), 'notify_to'),

            Select::make(__('Every'), 'every')
                ->options([
                    'month' => __('Month'),
                    'week' => __('Week'),
                    'day' => __('Day'),
                    'hour' => __('Hour'),
                    'minute' => __('Minute'),
                    'session' => __('Session'),
                ])
                ->rules('required')
                ->hideFromIndex(),

            Number::make(__('Period'), 'period')
                ->rules('required')
                ->hideFromIndex(),

            Text::make(__('Message'), 'message'),

            Boolean::make(__('Recive call'), 'receive_call'),

            BelongsTo::make(__('Form'), 'form', Form::class)
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
