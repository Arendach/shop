<?php

namespace App\Console\Commands;

use App\Models\NewPostCity;
use App\Models\NewPostWarehouse;
use App\Services\NewPost;
use Illuminate\Console\Command;

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
        try {
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
                                'ref' => $city['Ref'],
                                'prefix' => $city['SettlementTypeDescription'] ?? '',
                            ]);
                        }
                    }
                }

                echo "City: $i \n";
                $i++;
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    private function loadWarehouse()
    {
        $i = 1;
        while ($warehouses = $this->service->getWarehouses($i)) {
            foreach ($warehouses as $warehouse) {
                if (isset($warehouse['Ref']) && $warehouse['Ref'] != '') {
                    if (NewPostWarehouse::where('ref', $warehouse['Ref'])->count()) {
                        try {
                            NewPostWarehouse::where('ref', $warehouse['Ref'])->update([
                                'name_uk'          => $warehouse['Description'],
                                'name_ru'          => $warehouse['DescriptionRu'],
                                'number'           => $warehouse['Number'],
                                'max_weight_place' => $warehouse['PlaceMaxWeightAllowed'],
                                'max_weight_all'   => $warehouse['TotalMaxWeightAllowed'],
                                'phone'            => $warehouse['Phone'],
                            ]);

                        } catch (\Exception $e) {
                            echo $e;
                        }

                    } else {
                        try {
                            $city = NewPostCity::where('ref', $warehouse['CityRef'])->first();

                            NewPostWarehouse::create([
                                'name_uk'          => $warehouse['Description'],
                                'name_ru'          => $warehouse['DescriptionRu'],
                                'ref'              => $warehouse['Ref'],
                                'city_ref'         => $warehouse['CityRef'],
                                'number'           => $warehouse['Number'],
                                'max_weight_place' => $warehouse['PlaceMaxWeightAllowed'],
                                'max_weight_all'   => $warehouse['TotalMaxWeightAllowed'],
                                'phone'            => $warehouse['Phone'],
                                'city_id'          => $city->id
                            ]);
                        } catch (\Exception $exception) {
                            $this->error($exception->getMessage());
                        }
                    }
                }
            }

            echo "Warehouse: $i \n";
            $i++;
        }
    }
}
