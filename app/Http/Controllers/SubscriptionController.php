<?php

namespace App\Http\Controllers;

use App\Mail\SubscriptionPaymentSuccessMail;
use App\Models\PlanCustomField;
use Carbon\Carbon;
use App\Models\Plan;
use App\Models\User;
use App\Models\Setting;
use Laracasts\Flash\Flash;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\AffiliateUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Mail\ManualPaymentGuideMail;
use App\Mail\PlanExpirationReminder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\View\Factory;
use Stripe\Exception\ApiErrorException;
use Illuminate\Support\Facades\Redirect;
use App\Mail\SuperAdminManualPaymentMail;
use App\Models\CouponCode;
use App\Repositories\SubscriptionRepository;
use Illuminate\Contracts\Foundation\Application;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class SubscriptionController extends AppBaseController
{
    private SubscriptionRepository $subscriptionRepo;

    public function __construct(SubscriptionRepository $subscriptionRepo)
    {
        $this->subscriptionRepo = $subscriptionRepo;
    }

    /**
     * @return Application|Factory|View
     */
    public function index(Request $request): \Illuminate\View\View
    {
        $currentPlan = getCurrentSubscription();


        $days = $remainingDay = '';
        if ($currentPlan->ends_at > Carbon::now()) {
            $days = Carbon::parse($currentPlan->ends_at)->diffInDays();
            $remainingDay = $days.' Days';
        }

        if ($days >= 30 && $days <= 365) {
            $remainingDay = '';
            $months = floor($days / 30);
            $extraDays = $days % 30;
            if ($extraDays > 0) {
                $remainingDay .= $months.' Month '.$extraDays.' Days';
            } else {
                $remainingDay .= $months.' Month ';
            }
        }

        if ($days >= 365) {
            $remainingDay = '';
            $years = floor($days / 365);
            $extraMonths = floor($days % 365 / 30);
            $extraDays = floor($days % 365 % 30);
            if ($extraMonths > 0 && $extraDays < 1) {
                $remainingDay .= $years.' Years '.$extraMonths.' Month ';
            } elseif ($extraDays > 0 && $extraMonths < 1) {
                $remainingDay .= $years.' Years '.$extraDays.' Days';
            } elseif ($years > 0 && $extraDays > 0 && $extraMonths > 0) {
                $remainingDay .= $years.' Years '.$extraMonths.' Month '.$extraDays.' Days';
            } else {
                $remainingDay .= $years.' Years ';
            }
        }

        return view('subscription.index', compact('currentPlan', 'remainingDay'));
    }

    public function choosePaymentType($planId, $context = null, $fromScreen = null)
    {
         $currentSubscription = getCurrentSubscription();
         $customSelectId = request()->get('customFieldId');
         $customField = PlanCustomField::find($customSelectId);
         if($customField){
                  if (! $currentSubscription->isExpired()) {
                           if ((checkIfPlanIsInTrial($currentSubscription) || ! checkIfPlanIsInTrial($currentSubscription)) &&   $customField->custom_vcard_price <= 0) {
                                    Flash::error(__('messages.placeholder.cannot_switch_to_zero'));
                                    return Redirect::back();
                           }
                       }
         }

        $cashPaymentPlan = Subscription::where('tenant_id',Auth::user()->tenant_id)->where('payment_type','cash')->where('status',Subscription::PENDING)->first();

        if($cashPaymentPlan){
            Flash::error(__('messages.wait_for_apporove_of_cash_payment_by_admin'));

            return Redirect::back();
        }

        // code for checking the current plan is active or not, if active then it should not allow to choose that plan
        $subscriptionsPricingPlan = Plan::findOrFail($planId);
        $paymentTypes = getPaymentGateway();


            return view('subscription.payment_for_plan', compact('subscriptionsPricingPlan', 'paymentTypes','customSelectId','customField'));
    }

    /**
     * @return Application|Factory|View
     */
    public function upgrade()
    {
        $cashPaymentPlan = Subscription::where('tenant_id',Auth::user()->tenant_id)->where('payment_type','cash')->where('status',Subscription::PENDING)->first();

        if($cashPaymentPlan && !$cashPaymentPlan->isExpired()){
            Flash::error(__('messages.wait_for_apporove_of_cash_payment_by_admin'));

            return Redirect::back();
        }
        $plans = Plan::with(['currency', 'planFeature'])->whereStatus(Plan::IS_ACTIVE)->whereIsDefault(Plan::IS_DEACTIVE)->get();

        $monthlyPlans = $plans->where('frequency', Plan::MONTHLY);
        $yearlyPlans = $plans->where('frequency', Plan::YEARLY);
        $unLimitedPlans = $plans->where('frequency', Plan::UNLIMITED);

        return view(
            'subscription.upgrade',
            compact('monthlyPlans', 'yearlyPlans', 'unLimitedPlans')
        );
    }

    public function setPlanZero(Plan $plan): JsonResponse
    {
        try {
            DB::beginTransaction();

            Subscription::whereTenantId(getLogInTenantId())
                ->whereIsActive(true)->update(['is_active' => false]);

            $expiryDate = setExpiryDate($plan);
            Subscription::create([
                'plan_id' => $plan->id,
                'ends_at' => $expiryDate,
                'status' => true,
            ]);

            DB::commit();

            return $this->sendSuccess(__('messages.placeholder.subscribed_plan'));
        } catch (\Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function manualPay(Request $request)
    {
        $input = $request->all();
        if (isset($input['couponCodeId'])) {
            $couponId = $input['couponCodeId'];
            $coupon = CouponCode::find($couponId);
            if ($coupon) {
                if ($coupon->coupon_limit != null) {
                    $newLimit = $coupon->coupon_limit_left - 1;
                    CouponCode::where('id', $couponId)->update(['coupon_limit_left' => $newLimit]);
                }
            }
        }
        if (isset($input['attachment']) && $input['attachment']->getClientMimeType() == 'text/php') {

            return $this->sendError('PHP file is not valid type for attachment');
        }
        $this->subscriptionRepo->manageSubscription($input);
        $data = Subscription::whereTenantId(getLogInTenantId())->orderBy('created_at', 'desc')->first();
        Subscription::whereId($data->id)->update(['payment_type' => 'Cash','status' => Subscription::PENDING]);
        $is_on = Setting::where('key', 'is_manual_payment_guide_on')->first();
        $manual_payment_guide_step = Setting::where('key', 'manual_payment_guide')->first();
        $user = \Illuminate\Support\Facades\Auth::user();
        $super_admin_data = [
            'super_admin_msg' => $user->full_name.' created request for payment of '.$data->plan->currency->currency_icon.''.$data->payable_amount,
            'attachment' => $data->attachment ?? '',
            'notes' => $data->notes ?? '',
            'id' => $data->id,
        ];

        if ($is_on['value'] == '1') {
            Mail::to($user['email'])
                ->send(new ManualPaymentGuideMail($manual_payment_guide_step['value'], $user));
            $email = getSuperAdminSettingValue('email');
            Mail::to($email)
                ->send(new SuperAdminManualPaymentMail($super_admin_data, $email));
        }

        return $this->sendSuccess(__('messages.placeholder.subscribed_plan_wait'));
    }

    public function downloadAttachment($id): \Illuminate\Http\Response|Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $subscription = Subscription::findOrFail($id);

        [$file, $headers] = $this->subscriptionRepo->downloadAttachment($subscription);

        return response($file, 200, $headers);
    }

    public function downloadMailAttachment($id): BinaryFileResponse
    {
        $subscription = Subscription::whereTenantId(getLogInTenantId())->findOrFail($id);

        $headers = [
            'Content-Type' => $subscription->media[0]->mime_type,
            'Content-Description' => 'File Transfer',
            'Content-Disposition' => "attachment; filename={$subscription->media[0]->file_name}",
            'filename' => $subscription->media[0]->file_name,
        ];

        return response()->download($subscription->media[0]->getPath(), $subscription->media[0]->file_name, $headers);
    }

    /**
     * @return Application|Factory|View
     */
    public function cashPlan(): \Illuminate\View\View
    {
        return view('sadmin.planPyment.index');
    }

    public function planStatus(Request $request): JsonResponse
    {
        if($request->status == Subscription::ACTIVE) {
            $user = User::whereTenantId($request->tenant_id)->latest()->first();
            if ($user) {
                // send mail notification
                $subscription = Subscription::findOrFail($request->id);
                $planName = $subscription->plan->name;
                $paymentAmount = $subscription->payable_amount;
                $userEmail = $user->email;
                $planName = $subscription->plan->name;
                $firstName = $user->first_name;
                $lastName =  $user->last_name;
                $emailData = [
                'subscriptionId' => $request->id,
                'subscriptionAmount' => $paymentAmount,
                'transactionID' => $request->session_id,
                'planName' => $planName,
                'first_name' => $firstName,
                'last_name' => $lastName,
                ];

                Mail::to($userEmail)->send(new SubscriptionPaymentSuccessMail($emailData));

                $affiliateAmount = getSuperAdminSettingValue('affiliation_amount');
                $affiliateAmountType = getSuperAdminSettingValue('affiliation_amount_type');
                if($affiliateAmountType == 1){
                    AffiliateUser::where('user_id', $user->id)->where('amount', 0)->withoutGlobalScopes()->update(['amount' => $affiliateAmount,'is_verified' => 1]);

                }else if($affiliateAmountType == 2){
                    $amount = $paymentAmount * $affiliateAmount / 100;
                    AffiliateUser::where('user_id', $user->id)->where('amount', 0)->withoutGlobalScopes()->update(['amount' => $amount,'is_verified' => 1]);
                }
            }
            Subscription::whereTenantId($request->tenant_id)->where('id', '!=', $request->id)->where('status', '!=', Subscription::REJECT)->update(['status' => Subscription::INACTIVE]);
        }
        Subscription::where('id', $request->id)->update([
            'status' => $request->status,
        ]);

        $user = User::whereTenantId($request->tenant_id)->first();
        manageVcards($user);
        return $this->sendSuccess(__('messages.placeholder.payment_received'));
    }

    public function purchaseSubscription(Request $request)
    {

        $input = $request->all();
        $result = $this->subscriptionRepo->purchaseSubscriptionForStripe($input);

        // returning from here if the plan is free.
        if (isset($result['status']) && $result['status'] == true) {
           manageVcards();
            return $this->sendSuccess($result['subscriptionPlan']->name.' '.__('messages.subscription.has_been_subscribed'));
        } else {
            if (isset($result['status']) && $result['status'] == false) {
                return $this->sendError(__('messages.placeholder.cannot_switch_to_zero'));
            }
        }
        return $this->sendResponse($result, 'Session created successfully.');
    }

    /**
     * @return Application|Factory|View
     *
     * @throws ApiErrorException
     */
    public function paymentSuccess(Request $request): \Illuminate\View\View
    {
        AffiliateUser::whereUserId(getLogInUserId())->withoutGlobalScopes()
            ->update(['is_verified' => 1]);

        /** @var SubscriptionRepository $subscriptionRepo */
        $subscriptionRepo = app(SubscriptionRepository::class);
        $subscription = $subscriptionRepo->paymentUpdate($request);
        manageVcards();
        Flash::success($subscription->plan->name.' '.__('messages.subscription.has_been_subscribed'));

        return view('sadmin.plans.payment.paymentSuccess');
    }

    public function handleFailedPayment(): \Illuminate\View\View
    {
        $subscriptionPlanId = session('subscription_plan_id');
        /** @var SubscriptionRepository $subscriptionRepo */
        $subscriptionRepo = app(SubscriptionRepository::class);
        $subscriptionRepo->paymentFailed($subscriptionPlanId);
        Flash::error(__('messages.placeholder.unable_to_process_payment'));

        return view('sadmin.plans.payment.paymentcancel');
    }

    /**
     * @return Application|Factory|View
     */
    public function userSubscribedPlan(): \Illuminate\View\View
    {
        return view('sadmin.subscriptionPlan.index');
    }

    public function userSubscribedPlanEdit(Request $request): JsonResponse
    {
        $subscription = Subscription::with([
            'plan:id,name,currency_id', 'tenant.user', 'plan.currency',
        ])->whereId($request->id)->first();

        $paymentTypeName = Subscription::PAYMENT_GATEWAY[$subscription->payment_type] ?? '';

        return $this->sendResponse($subscription, $paymentTypeName, 'Subscription successfully retrieved.');
    }

    public function userSubscribedPlanUpdate(Request $request): JsonResponse
    {
        $endDate = $request->end_date;
        $format = getSuperAdminSettingValue('datetime_method');

        if(empty($request->end_date)){
            return $this->sendError(__('messages.subscription.end_date_required'));
        }

        $endDate = $request->end_date;
        $format = getSuperAdminSettingValue('datetime_method');

        $formattedDate = ($format == 1)
            ? Carbon::createFromFormat('d M, Y', $endDate)->format('Y-m-d H:i:s')
            : (($format == 2)
                ? Carbon::createFromFormat('M d, Y', $endDate)->format('Y-m-d H:i:s')
                : (($format == 3)
                    ? Carbon::createFromFormat('d/m/Y', $endDate)->format('Y-m-d H:i:s')
                    : (($format == 4)
                        ? Carbon::createFromFormat('Y/m/d', $endDate)->format('Y-m-d H:i:s')
                        : (($format == 5)
                            ? Carbon::createFromFormat('m/d/Y', $endDate)->format('Y-m-d H:i:s')
                            : (($format == 6)
                                ? Carbon::createFromFormat('Y-m-d', $endDate)->format('Y-m-d H:i:s')
                                : Carbon::parse($endDate)->format('Y-m-d H:i:s')
                            )
                        )
                    )
                    )
                );

        $subscription = Subscription::where('id', $request->id)->update([
            'ends_at' =>  $formattedDate,
            'status' => Subscription::ACTIVE,
        ]);

        return $this->sendResponse($subscription, __('messages.placeholder.subscription_date_updated'));
    }
}
