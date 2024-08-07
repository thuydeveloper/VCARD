<?php

namespace App\Http\Middleware;

use App\Models\Vcard;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckVcardAnalytics
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $vcards = Vcard::with(['tenant.user', 'template'])->where('tenant_id',
            getLogInTenantId())->pluck('id')->toArray();
        if (in_array($request->vcard->id, $vcards)) {
            return $next($request);
        } else {
            abort('404');
        }
    }
}
