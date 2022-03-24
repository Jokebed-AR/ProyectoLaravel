<?php

namespace App\Nova;

use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Tecnotanques\QuestionOptions\QuestionOptions;


class Question extends Resource
{
    /**
     * Indicates if the resource should be displayed in the sidebar.
     *
     * @var bool
     */
    public static $displayInNavigation = false;

    public static $perPageOptions = 20;

    public static $perPageViaRelationship = 20;

    public static function label()
    {
        return __('Questions');
    }

    public static function singularLabel()
    {
        return __('Question');
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Question';

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
        'id',
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
            Text::make(__('Name'), 'name')
                ->sortable()
                ->rules('required'),
            Select::make(__('Question Type'), 'field_type')->options([
                'radio' => __('Single option'),
                'check' => __('Multiple option'),
                'textarea' => __('Text Area'),
                'input' => __('Text'),
                'date' => __('Date'),
                'datetime' => __('Datetime')
            ])
                ->rules('required')
                ->displayUsingLabels(),

            NovaDependencyContainer::make([
                QuestionOptions::make(__('Options'), 'options'),
            ])->dependsOn('field_type', 'radio'),

            NovaDependencyContainer::make([
                QuestionOptions::make(__('Options'), 'options'),
            ])->dependsOn('field_type', 'check'),

            Boolean::make(__('Required'), 'is_required'),

            BelongsTo::make('Form')
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

    /**
     * Build an "index" query for the given resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        $query->when(empty($request->get('orderBy')), function ($q) {
            $q->getQuery()->orders = [];
            return $q->orderBy(static::$model::orderColumnName());
        });

        return $query;
    }

    /**
     * Prepare the resource for JSON serialization.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param \Illuminate\Support\Collection $fields
     *
     * @return array
     */
    public function serializeForIndex(NovaRequest $request, $fields = null)
    {
        return array_merge(parent::serializeForIndex($request, $fields), [
            'sortable' => true
        ]);
    }
}
