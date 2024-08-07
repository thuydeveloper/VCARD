<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class languageChangeMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $localeLanguage = Session::get('languageChange_'.$request->alias);

        if (! empty($localeLanguage)) {
            setLocalLang($localeLanguage);

            return $next($request);
        }

        setLocalLang(getVcardDefaultLanguage());

        return $next($request);
    }
}
