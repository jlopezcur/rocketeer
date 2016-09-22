<?php

namespace App\Http\Middleware;

use Closure;
use App;

class LocaleMiddleware
{

    private $default = 'en';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Default language
        $locale = $this->default;

        // Browser language
        $locale = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);

        // User selection language
        if (!empty(session('locale'))) $locale = session('locale');

        App::setLocale($locale);
        return $next($request);
    }
}
