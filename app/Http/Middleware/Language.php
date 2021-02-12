<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $defaultLocale = \Config::get('constant.web.locale.default');
        $localeKey = \Config::get('constant.web.locale.key');
        $locale = $request->cookie($localeKey, $defaultLocale);
        \App::setLocale($locale);
        return $next($request);
    }
}
