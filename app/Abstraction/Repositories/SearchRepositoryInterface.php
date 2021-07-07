<?php

namespace App\Abstraction\Repositories;

interface SearchRepositoryInterface
{
    public function search(string $query, string $model): array;
}