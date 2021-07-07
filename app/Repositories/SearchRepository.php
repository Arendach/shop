<?php

namespace App\Repositories;

use App\Abstraction\Repositories\SearchRepositoryInterface;

class SearchRepository implements SearchRepositoryInterface
{
    public function search(string $query): array
    {
        return [];
    }
}