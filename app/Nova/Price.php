<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Panel;



class Price extends Resource
{
    public static $model = 'App\Models\Price';

    public static $title = 'name';

    public static $search = [
        'name'
    ];

    public static function label()
    {
        return translate('Вартість доставки');
    }

    public function fields(Request $request)
    {
                artisan('cache:clear');

        return [
            new Panel(translate('Загальна інформація'), [
                Text::make(translate('День(сума < 1000)'), 'day_no_one'),
                Text::make(translate('День(сума >= 1000'), 'day_one'),
                Text::make(translate('Ніч(сума < 1000)'), 'night_no_one'),
                Text::make(translate('Ніч(сума >= 1000)'), 'night_one'),
                Text::make(translate('Ранок, Вечір (сума < 1000)'), 'morning_no_one'),
                Text::make(translate('Ранок, Вечір (сума >= 1000)'), 'morning_one'),
            ])

        ];
    }
}
