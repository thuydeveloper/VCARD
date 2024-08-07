<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\URL;

class FreshInstall
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$this->alreadyInstalled()) {
            try {
                DB::connection()->getPdo();
            } catch (\Exception $e) {
                return redirect(route('installs'));
            }
        }
        $response = $next($request);
        return $response;
    }

    public function alreadyInstalled()
    {
        return file_exists(storage_path('installed'));
    }
}
