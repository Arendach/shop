<?php

namespace App\Console\Commands\Elastic;

use App\Models\Product;
use Illuminate\Console\Command;
use Elasticsearch\Client;

class ClearCommand extends Command
{
    protected $signature = 'elastic:clear';

    protected $description = 'Delete All index';

    private $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        parent::__construct();
        $this->elasticsearch = $elasticsearch;
    }

    public function handle(): void
    {
        $this->elasticsearch->deleteByQuery([
            'index' => 'products',
            'type'  => '_doc',
            'body'  => [
                'query' => [
                    'match_all' => (object)[]
                ]
            ]
        ]);
    }
}
