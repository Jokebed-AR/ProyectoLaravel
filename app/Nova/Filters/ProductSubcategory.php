<?php

namespace App\Nova\Filters;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class ProductSubcategory extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        return $query->where('subcategory_id', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        $categories = SubCategory::all();
        $data = [];
        foreach ($categories as $category){
            $data[$category->name] = $category->id;
        }
        return $data;
    }

    public function name()
    {
        return 'Subcategoría';
    }
}
