<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class GenerateMinify extends Command
{
    protected $signature = 'generate:minify';

    protected $description = 'Generate minify';

    public function handle()
    {
        Product::all()->each(function (Product $product) {
            $product->update([
                'small' => $product->big
            ]);
        });
    }
}
