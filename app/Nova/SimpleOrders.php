<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Text;


class SimpleOrders extends Resource
{
    public static $group = 'Відділ Замовлень';

    public static $model = 'App\Models\SimpleOrder';

    public static $title = 'name';

    public static function label(): string
    {
        return 'Швидкі замовлення';
    }

    public function fields(Request $request): array
    {
        return [
            Text::make('Імя', 'name'),
            Text::make('Номер телефону', 'phone'),
            Text::make('ІП адреса', 'ip')->hideFromIndex(),
            Text::make('Юзер агент', 'user_agent')->hideFromIndex(),
            Boolean::make('Прийнято', 'accepted')->hideFromIndex(),
            DateTime::make('Створено', 'created_at')->hideFromIndex(),
            DateTime::make('Оновлено', 'updated_t')->hideFromIndex(),
            BelongsTo::make('Товар', 'product', Products::class)->showOnIndex()
        ];
    }
}
