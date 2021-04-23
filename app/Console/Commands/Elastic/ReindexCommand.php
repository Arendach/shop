<?php

namespace App\Console\Commands\Elastic;

use App\Abstraction\Models\SearchableInterface;
use Illuminate\Console\Command;
use Elasticsearch\Client;

class ReindexCommand extends Command
{
    protected $signature = 'elastic:reindex';

    protected $description = 'Indexes all articles to Elasticsearch';

    private $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        parent::__construct();
        $this->elasticsearch = $elasticsearch;
    }

    public function handle(): void
    {
        $this->info('Indexing all articles. This might take a while...');

        foreach (config('services.search.models') as $model) {
            $this->info("Start index model {$model}");
            (new $model)->prepareSearch()->get()->each(function (SearchableInterface $item) {
                $this->elasticsearch->index([
                    'index' => $item->getSearchIndex(),
                    'type'  => $item->getSearchType(),
                    'id'    => $item->getKey(),
                    'body'  => $item->toSearchArray(),
                ]);

                $this->output->write('.');
            });
            $this->info("\nFinish index model {$model}");
        }
        $this->info("\nDone!");
    }
}
