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
        'name'   => translate('Приват 24'),

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
    ]
];