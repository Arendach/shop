<?php

namespace App\Nova;

use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\TabsOnEdit;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Panel;


class Orders extends Resource
{
    use TabsOnEdit;
    public static $group = 'Відділ Замовлень';

    public static $model = 'App\Models\Order';

    public static $title = 'name';

    public static $search = [
        'name',
        'phone',
        'email'
    ];

    public static function label(): string
    {
        return 'Замовлення';
    }

    public function fields(Request $request)
    {
        $fields = [
            new Panel('Загальна інформація', [
                ID::make()->sortable(),
                Text::make('Імя', 'name'),
                Text::make('Електронна пошта', 'email'),
                Text::make('Номер телефону', 'phone'),
                Select::make('Варіант доставки', 'delivery')->options($this->getOrderTypes())->displayUsingLabels(),
                Select::make('Статус', 'status')->options($this->getOrderStatuses())->displayUsingLabels()
            ]),
        ];

        $fields = $this->deliveryFields($fields);
        //$fields = $this->sendingFields($fields);
        $fields = $this->selfFields($fields);


        return [
            new Tabs('Замовлення', $fields)
        ];
    }

    private function getOrderStatuses(): array
    {
        $statuses = asset_data('order_statuses');
        foreach ($statuses as $statusName => $status) {
            $statuses[$statusName] = $status['name'];
        }

        return $statuses;
    }

    private function getOrderTypes(): array
    {
        return [
            'delivery' => 'Доставка по місту',
            'self'     => 'Самовивіз',
            'sending'  => 'Відправка'
        ];
    }

    private function deliveryFields(array $fields): array
    {
        if ($this->resource->id && $this->resource->delivery == 'delivery') {
            return array_merge($fields, [
                new Panel('Доставка', [
                    Text::make('Місто', 'city')->hideFromIndex(),
                    Text::make('Вулиця', 'street')->hideFromIndex(),
                    Text::make('Адреса', 'address')->hideFromIndex(),
                ])
            ]);
        }

        return $fields;
    }


    private function selfFields(array $fields): array
    {
        if ($this->resource->id && $this->resource->delivery == 'self') {
            return array_merge($fields, [
                new Panel('Доставка', [
                    BelongsTo::make('Магазин', 'shop', Shops::class)->hideFromIndex()
                ])
            ]);
        }

        return $fields;
    }
//
//    private function sendingFields(array $fields): array
//    {
//        // if ($this->resource->id) {
//        return array_merge($fields, [
//            new Panel('Доставка', [
//                NovaBelongsToDepend::make('city')
//                    ->placeholder('Optional Placeholder') // Add this just if you want to customize the placeholder
//                    ->options(NewPostCity::all()),
//                NovaBelongsToDepend::make('Department')
//                    ->placeholder('Optional Placeholder') // Add this just if you want to customize the placeholder
//                    ->optionsResolve(function ($company) {
//                        return $company->warehouses()->get(['id', 'name']);
//                    })
//                    ->dependsOn('city')
//            ])
//        ]);
//        // }
//
//        return $fields;
//    }
}
