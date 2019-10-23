<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Locale;

class SetUserLocale
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->isMethod('get')) {
            if (is_auth()) {
                $lang = user()->locale;
            } elseif (isset($_COOKIE['locale']) && in_array($_COOKIE['locale'], config('locale.support'))) {
                $lang = $_COOKIE['locale'];
            } else {
                $lang = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
                $lang = in_array($lang, Locale::getSupport()) ? $lang : Locale::getDefault();
            }

            if ($lang != Locale::getLocale()) {
                return redirect(Locale::localizeUrl($lang, $request->url()));
            }
        }

        return $next($request);
    }
}
