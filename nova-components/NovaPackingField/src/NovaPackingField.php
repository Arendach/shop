<?php

namespace Arendach\NovaPackingField;

use Laravel\Nova\Fields\Field;

class NovaPackingField extends Field
{
    public $component = 'nova-packing-field';

    public function placeholders(array $placeholders = ['a', 'b', 'c']): self
    {
        return $this->withMeta([
            'placeholders' => $placeholders
        ]);
    }
}
