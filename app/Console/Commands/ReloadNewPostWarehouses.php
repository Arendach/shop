<?php

namespace App\Console\Commands;

use App\Models\NewPostCity;
use App\Models\NewPostWarehouse;
use Illuminate\Console\Command;
use App\Services\NewPost;

class ReloadNewPostWarehouses extends Command
{
    protected $signature = 'np:sync';

    protected $description = 'Перезавантаження міст та відділень нової пошти!';

    private $service;

    public function __construct()
    {
        parent::__construct();

        $this->service = new NewPost();
    }

    public function handle()
    {
        $this->loadCity();

        $this->loadWarehouse();
    }

    private function loadCity()
    {
        $i = 1;
        while ($cities = $this->service->getCities($i)) {
            foreach ($cities as $city) {
                if (isset($city['Ref']) && $city['Ref'] != '') {
                    if (NewPostCity::where('ref', $city['Ref'])->count()) {
                        NewPostCity::where('ref', $city['Ref'])->update([
                            'name_uk' => $city['Description'],
                            'name_ru' => $city['DescriptionRu'],
                            'prefix'  => $city['SettlementTypeDescription'] ?? '',
                        ]);
                    } else {
                        NewPostCity::create([
                            'name_uk' => $city['Description'],
                            'name_ru' => $city['DescriptionRu'],
                            'ref'     => $city['Ref'],
                            'prefix'  => $city['SettlementTypeDescription'] ?? '',
                        ]);
                    }
                }
            }

            echo "City: $i \n";
            $i++;
        }
    }

    private function loadWarehouse()
    {
        $i = 1;
        while ($warehouses = $this->service->getWarehouses($i)) {
            foreach ($warehouses as $warehouse) {
                if (isset($warehouse['Ref']) && $warehouse['Ref'] != '') {
                    if (NewPostWarehouse::where('ref', $warehouse['Ref'])->count()) {
                        NewPostWarehouse::where('ref', $warehouse['Ref'])->update([
                            'name_uk'          => $warehouse['Description'],
                            'name_ru'          => $warehouse['DescriptionRu'],
                            'number'           => $warehouse['Number'],
                            'max_weight_place' => $warehouse['PlaceMaxWeightAllowed'],
                            'max_weight_all'   => $warehouse['TotalMaxWeightAllowed'],
                            'phone'            => $warehouse['Phone'],
                        ]);
                    } else {
                        NewPostWarehouse::create([
                            'name_uk'          => $warehouse['Description'],
                            'name_ru'          => $warehouse['DescriptionRu'],
                            'ref'              => $warehouse['Ref'],
                            'city_ref'         => $warehouse['CityRef'],
                            'number'           => $warehouse['Number'],
                            'max_weight_place' => $warehouse['PlaceMaxWeightAllowed'],
                            'max_weight_all'   => $warehouse['TotalMaxWeightAllowed'],
                            'phone'            => $warehouse['Phone'],
                        ]);
                    }
                }
            }

            echo "Warehouse: $i \n";
            $i++;
        }
    }
}
