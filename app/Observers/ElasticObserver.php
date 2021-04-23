<?php


namespace App\Observers;

use App\Contracts\SearchableInterface;
use Elasticsearch\Client;

class ElasticObserver
{
    private $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function saved(SearchableInterface $model): void
    {
        $this->elasticsearch->index([
            'index' => $model->getSearchIndex(),
            'type'  => $model->getSearchType(),
            'id'    => $model->getKey(),
            'body'  => $model->toSearchArray(),
        ]);
    }

    public function deleted(SearchableInterface $model): void
    {
        $this->elasticsearch->delete([
            'index' => $model->getSearchIndex(),
            'type'  => $model->getSearchType(),
            'id'    => $model->getKey(),
        ]);
    }
}