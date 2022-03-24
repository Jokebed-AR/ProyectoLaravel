<?php

if (! function_exists('getFilterUri')) {
    function getFilterUri($filters, $newFilterKey, $value)
    {
        $uri = env('APP_URL') . '/productos';

        if ($filters['classification']) {
            $uri = $uri . '/' . $filters['classification']->name;
        }

        $filters[$newFilterKey] = $value;

        $uri = $uri . '/' . $filters['category'] . '/' . $filters['subcategory'] . '/' . $filters['brand'];

        if ($filters['search']) {
            $uri = $uri . '?search=' . $filters['search'] . '&sort_order=' . $filters['order'];
        }

        if ($filters['order'] && !$filters['search']) {
            $uri = $uri . '?' . 'sort_order=' . $filters['order'];
        }

        return $uri;
    }
}
