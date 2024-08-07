<?php

namespace App\Repositories;

use App\Mail\SubscriptionPaymentSuccessMail;
use App\Models\AffiliateUser;
use App\Models\CouponCode;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laracasts\Flash\Flash;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use WpOrg\Requests\Exception;

/**
 * Class SubscriptionRepository
 */
class SubscriptionRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'user_id',
        'stripe_id',
        'stripe_status',
        'stripe_plan',
        'subscription_plan_id',
        'start_date',
        'end_date',
        'status',
    ];

    /**
     * {@inheritDoc}
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * {@inheritDoc}
     */
    public function model()
    {
        return Subscription::class;
    }

    public function purchaseSubscriptionForStripe($input): array
    {
        $data = $this->manageSubscription($input);

        if (! isset($data['plan'])) { // 0 amount plan or try to switch the plan if it is in trial mode
            return $data;
        }

        $result = $this->manageStripeData(
            $data['plan'],
            [
                'amountToPay' => $data['amountToPay'],
                'sub_id' => $data['subscription']->id, ]
        );

        return $result;
    }

    /**
     * @param $input
     */
    public function manageSubscription($planData): bool|array
    {
        $planId = $planData['planId'];
        $customFieldId = $planData['customFieldId'] ?? null;
        if (isset($planData['couponCodeId'])) {
            $couponId = $planData['couponCodeId'];
            $coupon = CouponCode::find($couponId);
            if ($coupon) {
                if ($coupon->coupon_limit != null) {
                    $newLimit = $coupon->coupon_limit_left - 1;
                    CouponCode::where('id', $couponId)->update(['coupon_limit_left' => $newLimit]);
                }
            }
        }
        /** @var Plan $subscriptionPlan */
        $subscriptionPlan = Plan::findOrFail($planId);
        if ($subscriptionPlan->frequency == Plan::MONTHLY) {
            $newPlanDays = 30;
        } else {
            if ($subscriptionPlan->frequency == Plan::YEARLY) {
                $newPlanDays = 365;
            } else {
                $newPlanDays = 36500;
            }
        }
        $startsAt = Carbon::now();
        $endsAt = $startsAt->copy()->addDays($newPlanDays);

        $usedTrialBefore = Subscription::whereTenantId(getLogInUser()->tenant_id)->whereNotNull('trial_ends_at')->exists();

        // if the user did not have any trial plan then give them a trial

        if (! $usedTrialBefore && $subscriptionPlan->trial_days > 0) {
            $endsAt = $startsAt->copy()->addDays($subscriptionPlan->trial_days);
        }
//         if($planData['customFieldId'] != null){
//          $amountToPay = $subscriptionPlan->planCustomFields()->where('id', $planData['customFieldId'])->value('custom_vcard_price');
//         }
//         else{
//          $amountToPay = $subscriptionPlan->price;
//         }

         $amountToPay = $customFieldId ? $subscriptionPlan->planCustomFields()->where('id', $customFieldId)->value('custom_vcard_price') : $subscriptionPlan->price;

        /** @var Subscription $currentSubscription */
        $currentSubscription = getCurrentSubscription();

        $usedDays = Carbon::parse($currentSubscription->starts_at)->diffInDays($startsAt);
        $planIsInTrial = checkIfPlanIsInTrial($currentSubscription);
        // switching the plan -- Manage the pro-rating
        if (! $currentSubscription->isExpired() && $amountToPay != 0 && ! $planIsInTrial) {
            $usedDays = Carbon::parse($currentSubscription->starts_at)->diffInDays($startsAt);
            $currentSubsTotalDays = Carbon::parse($currentSubscription->starts_at)->diffInDays($currentSubscription->ends_at);

            $currentPlan = $currentSubscription->plan; // TODO: take fields from subscription

            // checking if the current active subscription plan has the same price and frequency in order to process the calculation for the proration
            $planPrice = $currentPlan->price;
            $planFrequency = $currentPlan->frequency;
            if ($planPrice != $currentSubscription->plan_amount || $planFrequency != $currentSubscription->plan_frequency) {
                $planPrice = $currentSubscription->plan_amount;
                $planFrequency = $currentSubscription->plan_frequency;
            }

            //            $frequencyDays = $planFrequency == Plan::MONTHLY ? 30 : 365;
            $perDayPrice = round($planPrice / $currentSubsTotalDays, 2);
            $isJPYCurrency = ! empty($subscriptionPlan->currency) && isJPYCurrency($subscriptionPlan->currency->currency_code);

            $remainingBalance = $planPrice - ($perDayPrice * $usedDays);
            $remainingBalance = $isJPYCurrency
                ? round($remainingBalance) : $remainingBalance;

            if ($remainingBalance < $amountToPay) { // adjust the amount in plan i.e. you have to pay for it

                  $payableAmount = $isJPYCurrency
                    ? round($amountToPay - $remainingBalance)
                    : round($amountToPay - $remainingBalance, 2);

            } else {

                $perDayPriceOfNewPlan = round($amountToPay / $newPlanDays, 5);

                $totalDays = round($remainingBalance / $perDayPriceOfNewPlan);
                $endsAt = Carbon::now()->addDays($totalDays);
                $payableAmount = 0;
            }

        } else {
            $payableAmount = $amountToPay;
        }

        // check that if try to switch the plan
        if (! $currentSubscription->isExpired()) {
            if ((checkIfPlanIsInTrial($currentSubscription) || ! checkIfPlanIsInTrial($currentSubscription)) &&  $amountToPay <= 0) {
                return ['status' => false, 'subscriptionPlan' => $subscriptionPlan];
            }
        }

        if ($usedDays <= 0) {
            $startsAt = $currentSubscription->starts_at;
        }

        $input = [
            'user_id' => getLogInUser()->id,
            'plan_id' => $subscriptionPlan->id,
            'plan_amount' => $amountToPay,
            'payable_amount' => $payableAmount,
            'plan_frequency' => $subscriptionPlan->frequency,
            'starts_at' => $startsAt,
            'ends_at' => $endsAt,
            'status' => Subscription::INACTIVE,
            'no_of_vcards' => $customFieldId ? $subscriptionPlan->planCustomFields()->where('id', $customFieldId)->value('custom_vcard_number') : $subscriptionPlan->no_of_vcards,
            'tenant_id' => getLogInUser()->tenant_id,
            'payment_type' => Subscription::STRIPE,
        ];

        if (isset($planData['notes'])) {
            $input['notes'] = $planData['notes'];
        }

        //apply coupon code if exists
        if (! empty($planData['couponCodeId'])) {
            $couponCode = CouponCode::whereId($planData['couponCodeId'])
                ->whereCouponName($planData['couponCode'])
                ->whereStatus(CouponCode::ACTIVE)
                ->firstOrFail();
            if ($couponCode->is_expired) {
                Flash::error('Invalid Coupon code');

                return [];
            }

            $couponCodeRepo = App(CouponCodeRepository::class);
            $data['planId'] = $subscriptionPlan->id;
            $data['planPrice'] = $amountToPay;
            $data['couponCode'] = $planData['couponCode'];
            $data['customFieldId'] = $customFieldId;
            $couponData = $couponCodeRepo->getAfterDiscountData($data);
            $payableAmount = $input['payable_amount'] = $couponData['afterDiscount']['amountToPay'];
            $input['coupon_code_meta'] = $couponData['afterDiscount'];
            $input['coupon_code_meta']['discount'] = $couponCode->discount;
            unset($input['coupon_code_meta']['amountToPay']);
            $input['discount'] = $couponData['afterDiscount']['discount'];
        }
        $subscription = Subscription::create($input);

        if (isset($planData['attachment']) && ! empty($planData['attachment'])) {
            $subscription->addMedia($planData['attachment'])->toMediaCollection(Subscription::ATTACHMENT_PATH,
                config('app.media_disc'));
        }

        if ($amountToPay <= 0 || $payableAmount == 0) {
            // De-Active all other subscription
            Subscription::whereTenantId(getLogInTenantId())
                ->where('id', '!=', $subscription->id)
                ->update([
                    'status' => Subscription::INACTIVE,
                ]);
            Subscription::findOrFail($subscription->id)->update(['status' => Subscription::ACTIVE]);

            return ['status' => true, 'subscriptionPlan' => $subscriptionPlan];
        }

        session(['subscription_plan_id' => $subscription->id]);
        session(['from_pricing' => request()->get('from_pricing')]);

        return [
            'plan' => $subscriptionPlan,
            'amountToPay' => $payableAmount,
            'subscription' => $subscription,
        ];
    }

    public function manageStripeData($subscriptionPlan, $data): array
    {
        $amountToPay = $data['amountToPay'];
        $subscriptionID = $data['sub_id'];
        if (! empty($subscriptionPlan->currency) && in_array($subscriptionPlan->currency->currency_code,
            zeroDecimalCurrencies())) {
            $planAmount = intval($amountToPay);
        } else {
            $planAmount = $amountToPay * 100;
        }

        setStripeApiKey();

        $session = Session::create([
            'payment_method_types' => ['card'],
            'customer_email' => Auth::user()->email,
            'line_items' => [
                [
                    'price_data' => [
                        'product_data' => [
                            'name' => $subscriptionPlan->name,
                            'description' => 'Subscribing for the plan named '.$subscriptionPlan->name,
                        ],
                        'unit_amount' => $planAmount,
                        'currency' => $subscriptionPlan->currency->currency_code,
                    ],
                    'quantity' => 1,
                ],
            ],
            'client_reference_id' => $subscriptionID,
            'metadata' => [
                'payment_type' => Transaction::STRIPE,
                'amount' => $planAmount,
                'plan_currency' => $subscriptionPlan->currency->currency_code,
            ],
            'mode' => 'payment',
            'success_url' => url('payment-success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => url('failed-payment?error=payment_cancelled'),
        ]);

        $result = [
            'sessionId' => $session['id'],
        ];

        return $result;
    }

    /**
     * @throws ApiErrorException
     */
    public function paymentUpdate($request)
    {
        try {
            setStripeApiKey();
            // Current User Subscription

            // New Plan Subscribe
            $stripe = new \Stripe\StripeClient(
                getSelectedPaymentGateway('stripe_secret')
            );
            $sessionData = $stripe->checkout->sessions->retrieve(
                $request->session_id,
                []
            );

            // where, $sessionData->client_reference_id = the subscription id
            Subscription::findOrFail($sessionData->client_reference_id)->update(['status' => Subscription::ACTIVE]);
            // De-Active all other subscription
            Subscription::whereTenantId(getLogInTenantId())
                ->where('id', '!=', $sessionData->client_reference_id)
                ->where('status', '!=', Subscription::REJECT)
                ->update([
                    'status' => Subscription::INACTIVE,
                ]);

            $paymentAmount = null;
            if ($sessionData->metadata->plan_currency != null && in_array($sessionData->metadata->plan_currency,
                zeroDecimalCurrencies())) {
                $paymentAmount = $sessionData->amount_total;
            } else {
                $paymentAmount = $sessionData->amount_total / 100;
            }

            $transaction = Transaction::create([
                'transaction_id' => $request->session_id,
                'type' => $sessionData->metadata->payment_type,
                'amount' => $paymentAmount,
                'tenant_id' => getLogInTenantId(),
                'status' => Transaction::SUCCESS,
                'meta' => json_encode($sessionData),
            ]);

            $subscription = Subscription::findOrFail($sessionData->client_reference_id);
            $subscription->update(['transaction_id' => $transaction->id]);

            $affiliateAmount = getSuperAdminSettingValue('affiliation_amount');
            $affiliateAmountType = getSuperAdminSettingValue('affiliation_amount_type');
            if($affiliateAmountType == 1){
                AffiliateUser::whereUserId(getLogInUserId())->where('amount', 0)->withoutGlobalScopes()->update(['amount' => $affiliateAmount,'is_verified' => 1]);
            }else if($affiliateAmountType == 2){
                $amount = $paymentAmount * $affiliateAmount / 100;
                AffiliateUser::whereUserId(getLogInUserId())->where('amount', 0)->withoutGlobalScopes()->update(['amount' => $amount,'is_verified' => 1]);
            }

            $userEmail = getLogInUser()->email;
            $planName = $subscription->plan->name;
            $firstName = getLogInUser()->first_name;
            $lastName =  getLogInUser()->last_name;
            $emailData = [
                'subscriptionId' => $sessionData->client_reference_id,
                'subscriptionAmount' => $paymentAmount,
                'transactionID' => $request->session_id,
                'planName' => $planName,
                'first_name' => $firstName,
                'last_name' => $lastName,
            ];

            Mail::to($userEmail)->send(new SubscriptionPaymentSuccessMail($emailData));

            DB::commit();
            $subscription->load('plan');

            return $subscription;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function paymentFailed($planId)
    {
        $subscriptionPlan = Subscription::findOrFail($planId);
        $subscriptionPlan->delete();
    }

    public function downloadAttachment($subscription): array
    {
        try {
            $documentMedia = $subscription->media[0];
            $documentPath = $documentMedia->getPath();

            if (config('app.media_disc') === 'public') {
                $documentPath = (Str::after($documentMedia->getUrl(), '/uploads'));
            }

            $file = Storage::disk(config('app.media_disc'))->get($documentPath);

            $headers = [
                'Content-Type' => $subscription->media[0]->mime_type,
                'Content-Description' => 'File Transfer',
                'Content-Disposition' => "attachment; filename={$subscription->media[0]->file_name}",
                'filename' => $subscription->media[0]->file_name,
            ];

            return [$file, $headers];
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
