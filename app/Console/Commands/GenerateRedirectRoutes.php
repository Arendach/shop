<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\Redirect;
use Illuminate\Console\Command;

class GenerateRedirectRoutes extends Command
{
    protected $signature = 'generate:redirect-routes';

    protected $description = 'Generate redirect routes from products table';

    public function handle(): void
    {
        $routesByProducts = $this->routesByProducts();
        $routesByRedirectTable = $this->routesByRedirectTable();

        $content = "<?php\n\n/** Routes by Products */\n\n{$routesByProducts}\n\n/** Routes by Redirects Table */\n\n{$routesByRedirectTable}";

        file_put_contents(base_path('routes/redirects.php'), $content);
    }

    private function getRouteText(string $old, string $new, int $status = 301): string
    {
        return "Route::redirect('{$old}', '{$new}', {$status});";
    }

    private function routesByProducts(): string
    {
        return Product::all()->map(function (Product $product) {
            if ($product->old_url) {
                return $this->getRouteText($product->old_url, $product->url);
            }

            return '';
        })->filter(function ($item) {
            return $item != '';
        })->implode("\n");
    }

    private function routesByRedirectTable(): string
    {
        return Redirect::all()->map(function (Redirect $redirect) {
            return $this->getRouteText($redirect->old_link, $redirect->new_link, $redirect->status);
        })->implode("\n");
    }

}
