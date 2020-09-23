<?php

use App\Services\DeliveryService;

return [
    'delivery' => [
        'name' => translate('Доставка по місту'),
        // 'form' => app(DeliveryService::class)->getDeliveryForm()
    ],
    'sending'  => [
        'name' => translate('Відправка Новою Поштою'),
        // 'form' => app(DeliveryService::class)->getSendingForm()
    ],
    'self'     => [
        'name' => translate('Самовивіз'),
        //  'form' => app(DeliveryService::class)->getSelfForm()
    ],
];