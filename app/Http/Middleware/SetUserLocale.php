<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Locales;

class SetUserLocale
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->isMethod('get')) {
            if (is_auth()) {
                $lang = user()->locale;
            } elseif ($request->session()->has('locale') && in_array($request->session()->get('locale'), ['uk', 'ru'])) {
                $lang = $request->session()->get('locale');
            } else {
                $lang = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
                $lang = in_array($lang, Locales::getSupport()) ? $lang : Locales::getDefault();
            }

            if ($lang != Locales::getLocale()) {
                return redirect(Locales::localizeUrl($lang, $request->url()));
            }
        }

        return $next($request);
    }
}
