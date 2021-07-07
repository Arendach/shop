<?php

namespace App\Http\Controllers\Bridge;

use App\Library\BaseConnection;
use App\Http\Controllers\Controller;
use App\Models\Characteristic;

class CharacteristicsSyncController extends Controller
{
    public function section_main(BaseConnection $connection)
    {
        $characteristics = $connection->requestParse('settings', 'characteristics_sync');

        Characteristic::truncate();

        foreach ($characteristics as $item) {
            Characteristic::create((array)$item);
        }

        return redirect()
            ->route('bridge')
            ->with('message', 'Характеристики вдало синхронізовані!');
    }
}
