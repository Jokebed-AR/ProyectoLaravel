<?php

namespace App\Nova\Filters;

use App\Models\Brand;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class ProductBrand extends Filter
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
        return $query->where('brand_id', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        $brands = Brand::all();
        $data = [];
        foreach ($brands as $brand){
            $data[$brand->name] = $brand->id;
        }
        return $data;
    }

    public function name()
    {
        return 'Marca';
    }
}
