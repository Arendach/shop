<?php

/**
 * Всі поля являються обовязковими
 */
return [
    'new_order'  => [
        // назва статуса
        'name'   => translate('Нове замовлення'),

        // чи можна після даного статусу обновляти замовлення true|false
        'update' => true,

        // Колір тексту статусу
        'color'  => '#fff',
    ],
    'in_process' => [
        'name'   => translate('Обробляється менеджером'),
        'update' => true,
        'color'  => '#ffe9e9'
    ],
    'accepted'   => [
        'name'   => translate('Прийнято менеджером'),
        'update' => true,
        'color'  => '#fff',
    ],
    'canceled'   => [
        'name'   => translate('Відмінено'),
        'update' => true,
        'color'  => '#fff',
    ],
    'success'    => [
        'name'   => translate('Виконано'),
        'update' => true,
        'color'  => '#fff',
    ]
];