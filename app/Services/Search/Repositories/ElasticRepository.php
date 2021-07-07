<?php

namespace App\Services\Search\Repositories;

use App\Abstraction\Repositories\SearchRepositoryInterface;
use App\Abstraction\Models\SearchableInterface;
use Elasticsearch\Client;

class ElasticRepository implements SearchRepositoryInterface
{
    private $elasticsearch;
    private $models;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
        $this->models = config('services.search.models');
    }

    public function search(string $query, string $model): array
    {
        if (!$this->validationModel($model)) {
            return [];
        }

        /** @var SearchableInterface $model */
        $model = new $model;

        $result = $this->elasticsearch->search([
            'index' => $model->getSearchIndex(),
            'type'  => $model->getSearchType(),
            'size'  => 10,
            'body'  => [
                'query' => [
                    'function_score' => [
                        'query' => [
                            'dis_max' => [
                                'queries' => [
                                    'multi_match' => [
                                        'fields'               => [
                                            'name_uk^3',
                                            'name_ru^3',
                                            'description_uk^3',
                                            'description_ru^3',
                                            'model_uk^3',
                                            'model_ru^3',
                                            'article^2'
                                        ],
                                        'query'                => $query,
                                        'fuzziness'            => 'AUTO',
                                        'minimum_should_match' => '35%',
                                        'tie_breaker'          => 0.3,
                                        'operator'             => 'OR'
                                    ]
                                ]
                            ]
                        ],
                    ]
                ],
            ],
        ]);

        return $this->mappingData($result['hits']['hits']);
    }

    private function mappingData(array $hits): array
    {
        $result = [];
        foreach ($hits as $hit) {
            $result[] = $hit['_source'];
        }

        return $result;
    }

    private function validationModel(string $model): bool
    {
        return in_array($model, $this->models);
    }
}