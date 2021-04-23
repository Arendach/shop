<?php

namespace App\Services\Search\Repositories;

use App\Abstraction\Repositories\SearchRepositoryInterface;

class EloquentRepository implements SearchRepositoryInterface
{
    public function search(string $query, string $model): array
    {
        return [];
    }
}