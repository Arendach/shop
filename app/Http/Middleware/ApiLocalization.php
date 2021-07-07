<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Application;

class ApiLocalization
{
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function handle($request, Closure $next)
    {
        $locale = $request->header('Content-Language');

        if (!$locale) {
            $locale = config('locale.default');
        }

        if (!in_array($locale, config('locale.support'))) {
            return abort(403, 'Language not supported.');
        }

        $this->app->setLocale($locale);
        config()->set('locale.current', $locale);

        $response = $next($request);
        $response->headers->set('Content-Language', $locale);

        return $response;
    }
}
