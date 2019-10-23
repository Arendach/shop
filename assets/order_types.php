<?php

return [
    'delivery' => [
        'name' => __('assets/order_types.delivery'),
        'form' => Delivery::getDeliveryForm()
    ],
    'sending' => [
        'name' => __('assets/order_types.sending'),
        'form' => Delivery::getSendingForm()
    ],
    'self' => [
        'name' => __('assets/order_types.self'),
        'form' => Delivery::getSelfForm()
    ],
];