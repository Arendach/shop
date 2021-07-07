<?php

namespace App\Console\Commands\Elastic;

use App\Services\Search\ElasticConfigurator;
use Illuminate\Console\Command;
use Elasticsearch\Client;

class CreateIndexCommand extends Command
{
    protected $signature = 'elastic:create-index';

    protected $description = 'Create Elasticsearch indexes';

    private $elasticsearch;
    private $configurator;

    public function __construct(Client $elasticsearch, ElasticConfigurator $configurator)
    {
        parent::__construct();
        $this->elasticsearch = $elasticsearch;
        $this->configurator = $configurator;
    }

    public function handle(): void
    {
        $this->info('Start');

        $this->elasticsearch->indices()->create(
            $this->configurator->getConfigs('products')
        );

        $this->info('Created index for Products');

        $this->info('\nDone!');
    }
}
