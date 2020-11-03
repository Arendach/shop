<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class GenerateRedirectRoutes extends Command
{
    protected $signature = 'generate:redirect-routes';

    protected $description = 'Generate redirect routes from products table';

    public function handle(): void
    {
        $routes = Product::all()->map(function (Product $product) {
            if ($product->old_url) {
                return "Route::redirect('{$product->old_url}', '{$product->url}');";
            }

            return '';
        })->filter(function ($item){
            return $item != '';
        })->implode("\n");

        $content = "<?php\n{$routes}";

        file_put_contents(base_path('routes/redirects.php'), $content);
    }
}
