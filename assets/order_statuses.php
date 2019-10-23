<?php

/**
 * Всі поля являються обовязковими
 */

return [
    'new_order' => [
        // назва статуса
        'name' => __('assets/order_statuses.new_order'),

        // чи можна після даного статусу обновляти замовлення true|false
        'update' => true,

        // Колір тексту статусу
        'color' => '#0f0',
    ],
    'accepted' => [
        'name' => __('assets/order_statuses.accepted'),
        'update' => true,
        'color' => '#0f0',
    ],
    'awaiting_payment' => [
        'name' => __('assets/order_statuses.awaiting_payment'),
        'update' => true,
        'color' => '#0f0',
    ],
    'paid' => [
        'name' => __('assets/order_statuses.paid'),
        'update' => true,
        'color' => '#0f0',
    ],
    'canceled' => [
        'name' => __('assets/order_statuses.canceled'),
        'update' => true,
        'color' => '#0f0',
    ],
    'success' => [
        'name' => __('assets/order_statuses.success'),
        'update' => true,
        'color' => '#0f0',
    ]
];