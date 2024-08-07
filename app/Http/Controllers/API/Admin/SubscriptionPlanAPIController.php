<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Mail\ManualPaymentGuideMail;
use App\Mail\SuperAdminManualPaymentMail;
use App\Models\Plan;
use App\Models\Setting;
use App\Models\Subscription;
use App\Repositories\SubscriptionRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SubscriptionPlanAPIController extends AppBaseController
{
    private SubscriptionRepository $subscriptionRepo;

    public function __construct(SubscriptionRepository $subscriptionRepo)
    {
        $this->subscriptionRepo = $subscriptionRepo;
    }

    Public function subscriptionPlan()
    {
        $plans = Plan::with(['currency', 'planFeature'])->whereStatus(Plan::IS_ACTIVE)->get();

        $data = [];
        foreach($plans as $plan){
            $data[] = [
                'id' => $plan->id,
                'name' => $plan->name,
                'currency' => $plan->currency->currency_code,
                'no_of_vcards' => $plan->no_of_vcards,
                'trial_days' => $plan->trial_days,
                'frequency' => $plan->frequency,
                'price' => $plan->price,
                'features' => getPlanFeature($plan),
                'current_active_subscription' => (!empty(getCurrentSubscription()) && $plan->id == getCurrentSubscription()->plan_id && !getCurrentSubscription()->isExpired()),
            ];
        }

        return $this->sendResponse($data, 'Subscription data retrieved successfully.');
    }

    public function paymentStatus()
    {
        $tenantId = getLogInTenantId();

        $plan = Subscription::whereTenantId($tenantId)->latest()->first();

        $data =  ($plan->status == Subscription::PENDING) ? 'Pending' : 'Approved';

        return $this->sendResponse($data, 'Subscription data retrieved successfully.');
    }

    public function buyPlan(Plan $plan)
    {
        $existingSubscription = Subscription::where('tenant_id', getLogInTenantId())
        ->where('status', Subscription::PENDING)
        ->first();

        if ($existingSubscription) {
            return $this->sendError('There is already a pending subscription request.');
        }

        if ($plan->frequency == Plan::MONTHLY) {
            $newPlanDays = 30;
        } else {
            if ($plan->frequency == Plan::YEARLY) {
                $newPlanDays = 365;
            } else {
                $newPlanDays = 36500;
            }
        }
        $startsAt = Carbon::now();

        $input = [
            'tenant_id' => getLogInTenantId(),
            'plan_id' => $plan->id,
            'plan_amount' => $plan->price,
            'payable_amount' => $plan->price,
            'plan_frequency' => $plan->frequency,
            'starts_at' =>  Carbon::now(),
            'ends_at' => $startsAt->copy()->addDays($newPlanDays),
            'status' => Subscription::PENDING,
            'no_of_vcards' => $plan->no_of_vcards,
            'payment_type' => 'Cash',
        ];

        $subscription = Subscription::create($input);

        return $this->sendSuccess('Subscription Plan purchase Successfully.');
    }
}
