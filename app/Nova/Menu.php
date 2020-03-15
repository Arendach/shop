<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;

class Menu extends Resource
{
    use HasSortableRows;

    public static $model = 'App\Models\Menu';

    public static $title = 'name_uk';

    public static function label()
    {
        return translate('Меню');
    }

    public function fields(Request $request)
    {
        return [
            new Panel(translate('Загальна інформація'), [
                ID::make()->sortable(),
                Select::make(translate('Тип'), 'role')->options([
                    'link'     => translate('Посилання'),
                    'menu'     => translate('Меню'),
                    'megamenu' => translate('Мегаменю')
                ]),
                Text::make(translate('Посилання'), 'url'),
                Text::make(translate('Назва (ук)'), 'name_uk'),
                Text::make(translate('Назва (рос)'), 'name_ru')
            ]),
            new Panel(translate('Пункти'), [
                HasMany::make( translate(''), 'items', MenuItems::class)
            ])
        ];
    }
}
