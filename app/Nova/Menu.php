<?php

namespace App\Nova;

use Artisan;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Panel;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;

class Menu extends Resource
{
    use HasSortableRows;

    public static $model = 'App\Models\Menu';

    public static $title = 'name_uk';

    public static function label()
    {
        return 'Меню';
    }

    public function fields(Request $request)
    {
        Artisan::call('cache:clear');

        return [
            new Panel('Загальна інформація', [
                ID::make()->sortable(),
                Select::make('Тип', 'role')->options([
                    'link'     => 'Посилання',
                    'menu'     => 'Меню',
                    'megamenu' => 'Мегаменю'
                ]),
                Text::make('Посилання', 'url'),
                Text::make('Назва (ук)', 'name_uk'),
                Text::make('Назва (рос)', 'name_ru'),
                Image::make('Зображення (для мегаменю)', 'photo')->hideFromIndex()->path('images/megamenu')
            ]),
            new Panel('Пункти', [
                HasMany::make('', 'items', MenuItems::class)
            ])
        ];
    }
}
