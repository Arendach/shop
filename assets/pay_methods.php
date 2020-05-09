<?php


/**
 * Способи оплати
 *
 * Обовязкові поля @name, @simple
 */
return [
    'privat24' => [
        /**
         * Назва способу оплати, відображається на сайті при оформленні замовлення
         */
        'name'   => translate('Оплата на карту ПБ'),

        /**
         * Константа визначає чи потрібен обробник для цього способу(приймає true | false)
         */
        'simple' => false,

        /**
         * Клас який буде обробляти логіку, вид та всі решту операцій
         *
         * Обовязково повинен імплементувати інтерфейс App\Pays\PayInterface
         */
        // 'classHandler' => \App\Pays\PrivateBank24::class,

        /**
         * Показувати на сайті (true | false)
         */
        'active' => false
    ],
    'cash'     => [
        'name'   => translate('Оплата при доставці'),
        'simple' => true,
        'active' => true
    ],

    'cashless'     => [
        'name'   => translate('Безготівкова оплата'),
        'simple' => true,
        'active' => true
    ],

    'cashless-with-pdv'     => [
        'name'   => translate('Безготівкова оплата з ПДВ'),
        'simple' => true,
        'active' => true
    ]
];