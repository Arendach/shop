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
            } elseif ($request->session()->has('locale') && in_array($request->session()->get('locale'), ['uk', 'ru'])) {
                $lang = $request->session()->get('locale');
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
