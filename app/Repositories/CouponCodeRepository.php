<?php

namespace App\Repositories;

use App\Models\CouponCode;
use App\Models\PlanCustomField;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class featureRepository
 */
class CouponCodeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'coupon_name', 'type',
    ];

    /**
     * Return searchable fields
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CouponCode::class;
    }

    public function getAfterDiscountData($input)
    {
        $planId = $input['planId'];
        $planPrice = $input['planPrice'];
        $couponCode = $input['couponCode'];
        $customFieldId = $input['customFieldId'] ?? null;

        $newPlan = getProratedPlanData($planId);

        if($customFieldId != null){
         $customPlan = PlanCustomField::where('id',$customFieldId)->first();
         $newPlanPrice = intval($customPlan->custom_vcard_price);
        }else{
         $newPlanPrice = $newPlan['amountToPay'] + $newPlan['remainingBalance'];
        }

        if($customFieldId == null){
        if (intval($newPlanPrice) != intval($planPrice)) {
            return false;
        }
         }

        if (empty($couponCode)) {
         if($customFieldId){
         $newPlan['amountToPay'] = $newPlanPrice - $newPlan['remainingBalance'];
         $newPlan['amountToPay'] = round($newPlan['amountToPay'] , 2);
            return $newPlan;
         }
         else{
             return $newPlan;
         }
        }


        $couponCode = strtoupper($couponCode);
        $coupon = CouponCode::whereCouponName($couponCode)->whereStatus(CouponCode::ACTIVE)->first();
        if (empty($coupon)) {
            throw new UnprocessableEntityHttpException(__('validation.coupon_code.not_found'));
        }
        if ($coupon->is_expired) {
            throw new UnprocessableEntityHttpException(__('validation.coupon_code.expired'));
        }

        if ($coupon->type == CouponCode::FIXED_TYPE) {
            $discount = $coupon->discount;
            $priceAfterDiscount = $newPlanPrice - $discount;
        } else {
            $discount = round(($newPlanPrice * $coupon->discount) / 100);
            $priceAfterDiscount = $newPlanPrice - $discount;
        }
        $amountToPay = $priceAfterDiscount - $newPlan['remainingBalance'];

        if ($priceAfterDiscount < 0) {
            $priceAfterDiscount = $amountToPay = 0;
            $discount = $newPlanPrice;
        }

        $amountToPay = ($amountToPay < 0) ? 0 : $amountToPay;

        $discountData['discountType'] = $coupon->type;
        $discountData['priceAfterDiscount'] = $priceAfterDiscount;
        $discountData['amountToPay'] = $amountToPay;
        $discountData['discount'] = $discount;
        $discountData['couponCode'] = $couponCode;
        $discountData['couponId'] = $coupon->id;
        $newPlan['afterDiscount'] = $discountData;

        return $newPlan;
    }
}
