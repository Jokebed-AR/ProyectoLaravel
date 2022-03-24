<?php

namespace App\Nova;

use Laravel\Nova\Fields\Boolean;

class GroupResourceFields
{
    /**
     * Get the pivot fields for the relationship.
     *
     * @return array
     */
    public function __invoke()
    {
        return [
            Boolean::make(__('Create'), 'create'),
            Boolean::make(__('Read'), 'read'),
            Boolean::make(__('Update'), 'update'),
            Boolean::make(__('Delete'), 'delete'),
            Boolean::make(__('Restore'), 'restore')
        ];
    }
}
