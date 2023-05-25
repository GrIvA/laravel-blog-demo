<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class LanguageURI
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $lang = $request->route('lang');
        $languages = array_keys(Cache::get('languages'));

        $lang = !empty($lang) && strlen($lang) == 2 && in_array($lang, $languages)
                ? $lang
                : config('app.locale'); //

        $request->session()->put('current_language', $lang);
        $request->session()->save();
        App::setLocale($lang);

        return $next($request);
    }
}
