<?php

return [
    translate('Продажі') => [
        [
            'url' => route('admin.get', ['orders', 'default', 'main']),
            'text' => translate('Замовлення'),
            'icon' => 'orders',
            'key' => 'orders'
        ],
        [
            'url' => route('admin.get', ['orders', 'simple_orders', 'main']),
            'text' => translate('Швидкі замовлення'),
            'icon' => 'simple_orders',
            'key' => 'orders'
        ]
    ],
    translate('Каталог') => [
        [
            'url' => route('admin.get', ['category', 'category', 'main']),
            'text' => translate('Категорії'),
            'icon' => 'categories',
            'key' => 'categories'
        ],
        [
            'url' => route('admin.get', ['product', 'product', 'main']),
            'text' => translate('Товари'),
            'icon' => 'products',
            'key' => 'products'
        ],
        [
            'url' => route('admin.get', ['product', 'collection', 'main']),
            'text' => translate('Колекції'),
            'icon' => 'collections',
            'key' => 'products'
        ],

    ],
    translate('Інше') => [
        [
            'url' => route('admin.get', ['banner', 'banner', 'main']),
            'text' => translate('Банер'),
            'icon' => 'banner',
            'key' => 'banner'
        ],
//        [
//            'url' => route('discounts.index'),
//            'text' => __('admin.routes.discounts'),
//            'icon' => 'discounts',
//            'key' => 'banner'
//        ],
        [
            'url' => route('pages.index'),
            'text' => translate('Сторінки'),
            'icon' => 'pages',
            'key' => 'pages'
        ],
        [
            'url' => route('admin.get', ['banner', 'top', 'main']),
            'text' => translate('Верхній банер'),
            'icon' => 'ad',
            'key' => 'banner'
        ],
    ],
    translate('Адміністрування') => [
        [
            'url' => route('bridge'),
            'text' => translate('Синхронізація'),
            'icon' => 'bridge',
            'key' => 'bridge'
        ],
        [
            'url' => '#',
            'text' => translate('Користувачі(адм.)'),
            'icon' => 'users',
            'key' => 'users'
        ],
        [
            'url' => '#',
            'text' => translate('Налаштування сайту'),
            'icon' => 'settings',
            'key' => 'settings'
        ],
    ]
];