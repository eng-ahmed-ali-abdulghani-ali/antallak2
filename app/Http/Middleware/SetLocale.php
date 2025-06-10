<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle($request, Closure $next)
  {
    $locale = Session::get('langs', config('app.locale'));

    if (in_array($locale, ['en', 'ar'])) {
      App::setLocale($locale);
    }

    return $next($request);
  }
}
