<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class ExportSearchLogs extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Експотувати логи';

    public function handle(ActionFields $fields, Collection $models)
    {
        //
    }

    public function fields()
    {
        return [];
    }
}
