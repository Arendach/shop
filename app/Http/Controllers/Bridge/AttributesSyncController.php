<?php

namespace App\Http\Controllers\Bridge;

use App\Library\BaseConnection;
use App\Models\Attribute;

class AttributesSyncController extends BridgeController
{
    public function section_main(BaseConnection $connection)
    {
        $characteristics = $connection->requestParse('settings', 'attribute_sync');

        Attribute::truncate();

        foreach ($characteristics as $item) {
            Attribute::create((array)$item);
        }

        return redirect()
            ->route('bridge')
            ->with('message', 'Атрибути вдало синхронізовані!');
    }

}