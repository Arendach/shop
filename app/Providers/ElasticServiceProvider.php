<?php

namespace App\Providers;

use App\Services\Search\Repositories\ElasticRepository;
use App\Services\Search\Repositories\EloquentRepository;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class ElasticServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
    }

    public function register(): void
    {
        $this->app->bind(Client::class, function ($app) {
            return ClientBuilder::create()
                ->setHosts($app['config']->get('services.search.hosts'))
                ->build();
        });

        $this->app->bind(\App\Abstraction\Repositories\SearchRepositoryInterface::class, function () {
            if (!config('services.search.enabled')) {
                return new EloquentRepository();
            }

            return new ElasticRepository(
                $this->app->make(Client::class)
            );
        });
    }
}
