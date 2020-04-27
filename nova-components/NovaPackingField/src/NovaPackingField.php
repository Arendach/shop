<?php

namespace Arendach\NovaPackingField;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class NovaPackingField extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-packing-field';
}
