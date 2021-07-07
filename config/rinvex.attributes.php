<?php

declare(strict_types=1);

return [

    // Attributes Database Tables
    'tables' => [

        'attributes' => 'eav_attributes',
        'attribute_entity' => 'eav_attribute_entity',
        'attribute_boolean_values' => 'eav_attribute_boolean_values',
        'attribute_datetime_values' => 'eav_attribute_datetime_values',
        'attribute_integer_values' => 'eav_attribute_integer_values',
        'attribute_text_values' => 'eav_attribute_text_values',
        'attribute_varchar_values' => 'eav_attribute_varchar_values',

    ],

    // Attributes Models
    'models' => [

        'attribute' => \Rinvex\Attributes\Models\Attribute::class,
        'attribute_entity' => \Rinvex\Attributes\Models\AttributeEntity::class,

    ],

];
