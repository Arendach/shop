<?php

namespace App\Repositories;

use App\Models\Shop;
use Illuminate\Database\Eloquent\Collection;

class ShopRepository
{
    public function getAllShops(): Collection
    {
        return Shop::all();
    }
}