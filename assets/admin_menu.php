<?php

return [
    'Продажі' => [
        [
            'url' => '#',
            'text' => __('admin.routes.orders'),
            'icon' => 'orders',
            'key' => 'orders'
        ],
        [
            'url' => route('admin.get', ['orders', 'simple_orders', 'main']),
            'text' => __('admin.routes.simple_orders'),
            'icon' => 'simple_orders',
            'key' => 'orders'
        ]
    ],
    'Каталог' => [
        [
            'url' => route('admin.get', ['category', 'category', 'main']),
            'text' => __('admin.routes.categories'),
            'icon' => 'categories',
            'key' => 'categories'
        ],
        [
            'url' => route('admin.get', ['product', 'product', 'main']),
            'text' => __('admin.routes.products'),
            'icon' => 'products',
            'key' => 'products'
        ]
    ],
    'Інше' => [
        [
            'url' => route('admin.get', ['banner', 'banner', 'main']),
            'text' => __('admin.routes.banner'),
            'icon' => 'banner',
            'key' => 'banner'
        ],
        [
            'url' => route('discounts.index'),
            'text' => __('admin.routes.discounts'),
            'icon' => 'discounts',
            'key' => 'banner'
        ],
        [
            'url' => route('pages.index'),
            'text' => __('admin.routes.pages'),
            'icon' => 'pages',
            'key' => 'pages'
        ],
        [
            'url' => route('admin.get', ['banner', 'top', 'main']),
            'text' => __('admin.routes.banner_top'),
            'icon' => 'ad',
            'key' => 'banner'
        ],
    ],
    'Адміністрування' => [
        [
            'url' => route('bridge'),
            'text' => __('admin.routes.bridge'),
            'icon' => 'bridge',
            'key' => 'bridge'
        ],
        [
            'url' => '#',
            'text' => __('admin.routes.users'),
            'icon' => 'users',
            'key' => 'users'
        ],
        [
            'url' => '#',
            'text' => __('admin.routes.settings'),
            'icon' => 'settings',
            'key' => 'settings'
        ],
    ]
];