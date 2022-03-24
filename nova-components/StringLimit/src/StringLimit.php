<?php

namespace Tecnotanques\StringLimit;

use Laravel\Nova\Fields\Field;

class StringLimit extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'StringLimit';

    public function max($value)
    {
        return $this->withMeta([
            'maxLength' => $value
        ]);
    }
}
