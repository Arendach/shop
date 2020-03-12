<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class Orders extends Resource
{
    public static $model = 'App\Models\Order';

    public static $title = 'name';

    public static $search = [
        'name',
        'phone',
        'email'
    ];

    public static function label(): string
    {
        return translate('Замовлення');
    }

    public function fields(Request $request)
    {
        return [
            new Panel(translate('Загальна інформація'), [
                ID::make()->sortable(),
                Text::make(translate('Імя'), 'name'),
                Text::make(translate('Електронна пошта'), 'email'),
                Text::make(translate('Номер телефону'), 'phone'),
                Select::make(translate('Варіант доставки'), 'delivery')->options([
                    'delivery' => translate('Доставка по місту'),
                    'self'     => translate('Самовивіз'),
                    'sending'  => translate('Відправка')
                ]),
                Select::make(translate('Статус'), 'status')->options($this->getOrderStatuses())
            ]),

            new Panel(translate(''), [
                HasMany::make('products')
            ])
        ];
    }

    public function cards(Request $request)
    {
        return [];
    }

    public function filters(Request $request)
    {
        return [];
    }

    public function lenses(Request $request)
    {
        return [];
    }

    public function actions(Request $request)
    {
        return [];
    }

    private function getOrderStatuses()
    {
        $statuses = asset_data('order_statuses');
        foreach ($statuses as $statusName => $status) {
            $statuses[$statusName] = $status['name'];
        }

        return $statuses;
    }
}
