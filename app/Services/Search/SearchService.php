<?php

namespace App\Services\Search;

use App\Abstraction\Repositories\SearchRepositoryInterface;
use Illuminate\Support\Collection;

class SearchService
{
    private SearchRepositoryInterface $searchRepository;
    private array $models;

    public function __construct(SearchRepositoryInterface $searchRepository)
    {
        $this->searchRepository = $searchRepository;
        $this->models = config('services.search.models');
    }

    public function search(string $query): array
    {
        $result = new Collection;
        foreach ($this->models as $model) {
            $items = $this->searchRepository->search(
                $query,
                $model
            );

            $result = $result->merge($items);
        }

        return $result->toArray();
    }
}