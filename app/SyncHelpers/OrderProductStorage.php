<?php

namespace App\SyncHelpers;

use App\Services\BaseConnectionService;
use Illuminate\Support\Collection;

class OrderProductStorage
{
    private $connection;

    public function __construct(BaseConnectionService $baseConnectionService)
    {
        $this->connection = $baseConnectionService;
    }

    public function exec($products)
    {
        $ids = $products->pluck('product_key')->toArray();

        $result = $this->connection->exec('storage', 'count_products', ['ids' => $ids]);

        foreach ($result as $k => $v){
            $result->$k = collect($v)->sortByDesc('count');
        }

        return ($result);
    }
}