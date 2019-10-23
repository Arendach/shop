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
            Manufacturer::insert((array)$manufacturer);
        }

        return redirect()
            ->route('bridge')
            ->with('message', 'Виробники вдало синхронізовані!');
    }
}
