<?php

namespace App\Services;

use Illuminate\Support\Collection;
use LisDev\Delivery\NovaPoshtaApi2;

class NewPostService
{
    /**
     * @var NovaPoshtaApi2
     */
    private $np;

    /**
     * NewPostService constructor.
     */
    public function __construct()
    {
        $this->np = new NovaPoshtaApi2(
            config('app.post_api'),
            config('locale.current') == 'uk' ? 'ua' : 'ru',
            // env('APP_DEBUG', false),
            false,
            'curl'
        );

        $this->boot();
    }

    /**
     * @return void
     */
    private function boot(): void
    {

    }

    /**
     * @param string $query
     * @return array
     */
    public function getCityList(string $query): array
    {
        // Робимо запит на сайт нової пошти
        $request = $this->np
            ->model('Address')
            ->method('getCities')
            ->params([
                'FindByString' => $query,
                'Limit' => '10',
            ])
            ->execute();

        // Якщо були якісь помилки то вертаємо порожню колекцію
        if (count($request['errors']) > 0) return [];

        $result = [];
        foreach ($request['data'] as $item) {
            $description = config('locale.current') == 'uk'
                ? $item['SettlementTypeDescription'] . ' ' . $item['Description']
                : $item['SettlementTypeDescriptionRu'] . ' ' . $item['DescriptionRu'];

            $name = config('locale.current') == 'uk'
                ? $item['Description']
                : $item['DescriptionRu'];

            $result[] = collect([
                'description' => $description,
                'name' => $name,
                'key' => $item['Ref'],
            ]);
        }

        return $result;
    }

    /**
     * @param string $key
     * @return string
     */
    public function getCityName(string $key): string
    {
        $city_name = $this->getCityNameLocale($key);

        return $city_name[config('locale.current')];
    }

    /**
     * @param string $city
     * @return array
     */
    public function getWarehousesLocale(string $city): array
    {
        $request = $this->np
            ->model('AddressGeneral')
            ->method('getWarehouses')
            ->params(['CityRef' => $city])
            ->execute();

        if ($request['success'] == false || count($request['data']) == 0) return [];

        $result = [];
        foreach ($request['data'] as $item) {
            $result[] = [
                'name_uk' => $item['Description'],
                'name_ru' => $item['DescriptionRu'],
                'key' => $item['Ref'],
                'max_weight' => $item['TotalMaxWeightAllowed']
            ];
        }

        return $result;
    }

    /**
     * @param string $city
     * @return array
     */
    public function getWarehouses(string $city): array
    {
        $warehouses = $this->getWarehousesLocale($city);

        $result = [];
        foreach ($warehouses as $warehouse) {
            $result[] = [
                'name' => $warehouse["name_" . config('locale.current')],
                'key' => $warehouse['key'],
                'max_weight' => $warehouse['max_weight']
            ];
        }

        return $result;
    }

    /**
     * @param string $city
     * @param string $warehouse
     * @return int
     */
    public function maxWeight(string $city, string $warehouse): int
    {
        $warehouses = $this->getWarehouses($city);

        $warehouses = collect($warehouses);

        $find = $warehouses->where('key', $warehouse)->first();

        return ((int)$find['max_weight']);
    }

    /**
     * @param string $city
     * @param string $warehouse
     * @return array
     */
    public function getWarehouseNameLocale(string $city, string $warehouse): array
    {
        $warehouses = $this->getWarehousesLocale($city);

        $warehouses = collect($warehouses);


        $find = $warehouses->where('key', $warehouse)->first();

        return ([
            'name_uk' => $find['name_uk'],
            'name_ru' => $find['name_ru']
        ]);
    }

    /**
     * @param string $city
     * @return array
     */
    public function getCityNameLocale(string $city): array
    {
        $request = $this->np
            ->model('Address')
            ->method('getCities')
            ->params(['Ref' => $city])
            ->execute();

        // Якщо не знайдено
        if ($request['success'] == false)
            return [
                'name_uk' => 'undefined',
                'name_ru' => 'undefined'
            ];

        // Получаємо масив даних з інф. про місто
        $city = $request['data'][0];

        return [
            'name_uk' => $city['SettlementTypeDescription'] . ' ' . $city['Description'],
            'name_ru' => $city['SettlementTypeDescriptionRu'] . ' ' . $city['DescriptionRu']
        ];
    }

}