<?php

namespace App\Http\Middleware;

use App\Models\Subscription;
use App\Models\Vcard;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
{
    public function handle(Request $request, Closure $next): Response
    {
        $request = $next($request);

        $subscription = Subscription::with('plan')
            ->where('status', Subscription::ACTIVE)
            ->where('tenant_id', getLogInUser()->tenant_id)
            ->first();

        if (! $subscription) {
            Vcard::where('tenant_id', getLogInUser()->tenant_id)->update([
                'status' => 0,
            ]);

            return redirect(route('subscription.upgrade'))
                ->withErrors('Your plan is expired. Please choose a plan to continue the services');
        }

        if ($subscription->isExpired()) {
            Vcard::where('tenant_id', getLogInUser()->tenant_id)->update([
                'status' => 0,
            ]);

            return redirect(route('subscription.upgrade'))
                ->withErrors('Your plan is expired. Please choose a plan to continue the services');
        }

        return $request;
    }
}
