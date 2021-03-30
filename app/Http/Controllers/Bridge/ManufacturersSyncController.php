<?php

namespace App\Http\Controllers\Bridge;

use App\Library\BaseConnection;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManufacturersSyncController extends Controller
{
    public function section_main(BaseConnection $connection)
    {
        $manufacturers = $connection->request('manufacturer', 'test');

        Manufacturer::truncate();

        foreach (\GuzzleHttp\json_decode($manufacturers) as $manufacturer) {
            $manufactur = new Manufacturer;
            $manufactur->name_uk = $manufacturer->name_uk;
            $manufactur->name_ru = translate($manufacturer->name_uk);
            $manufactur->photo_uk = $manufacturer->photo_uk;
            $manufactur->photo_ru = $manufacturer->photo_ru;
            $manufactur->save();;
        }

        return redirect()
            ->route('bridge')
            ->with('message', 'Виробники вдало синхронізовані!');
    }
}
