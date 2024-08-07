<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCouponCodeRequest;
use App\Http\Requests\UpdateCouponCodeRequest;
use App\Models\CouponCode;
use App\Models\Setting;
use App\Repositories\CouponCodeRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CouponCodeController extends AppBaseController
{
    public function index(): View
    {
        return view('sadmin.couponCodes.index');
    }

    public function store(AddCouponCodeRequest $request)
    {

        $input = $request->all();
        $couponLimit = $input['coupon_limit'];
        $input['coupon_limit_left'] = $couponLimit;

        $endDate =  $input['expire_at'];
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
        $input['expire_at'] =  $formattedDate;
        $input['status'] = isset($input['status']);
        CouponCode::create($input);

        return $this->sendSuccess(__('messages.coupon_code.coupon_code_created'));
    }

    public function edit($couponCodeId)
    {
        $couponCode = CouponCode::findOrFail($couponCodeId);

        return $this->sendResponse($couponCode, 'Coupon Code Retrieved Successfully.');
    }

    public function update(UpdateCouponCodeRequest $request, $id)
    {

        $input = $request->all();
        $couponCode = CouponCode::findOrFail($id);
        $couponCodeLimit = $couponCode->coupon_limit_left;
        $input['coupon_limit'] = isset($input['coupon_limit'])? $input['coupon_limit']: null;

        if($input['coupon_limit'] ==  $couponCodeLimit ){
            $input['coupon_limit_left'] = $input['coupon_limit'];
        }else{
            $input['coupon_limit_left'] = $couponCodeLimit - ($input['coupon_limit'] ) ;
        }
        if($input['coupon_limit'] > $couponCodeLimit ){
            $input['coupon_limit_left'] = $input['coupon_limit'];
        }
        if($input['coupon_limit'] < $couponCodeLimit ){
            $input['coupon_limit_left'] = $input['coupon_limit'];
        }
        if($input['coupon_limit'] == null){
            $input['coupon_limit_left'] = null;
        }

        $endDate =  $input['expire_at'];
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
        $input['expire_at'] = $formattedDate;
        $input['status'] = isset($input['status']);
        $couponCode->update($input);

        return $this->sendSuccess(__('messages.coupon_code.coupon_code_updated'));
    }

    public function destroy($couponCodeId)
    {
        $couponCode = CouponCode::findOrFail($couponCodeId);
        $couponCode->delete();

        return $this->sendSuccess('Coupon Code deleted Successfully.');
    }

    public function changeCouponCodeStatus(Request $request, $couponCodeId)
    {
        $couponCode = CouponCode::findOrFail($couponCodeId);
        $couponCode->status = $request->get('status') == 'true' ? 1 : 0;
        $couponCode->update();

        return $this->sendSuccess(__('messages.coupon_code.coupon_code_status_updated'));
    }

    public function applyCouponCode(Request $request, $couponCode = null)
    {
        $input = $request->all();
        $input['couponCode'] = $couponCode;
        $couponCodeRepo = App(CouponCodeRepository::class);
        $newPlan = $couponCodeRepo->getAfterDiscountData($input);

        if (isset($newPlan['afterDiscount'])) {
            $couponId = $newPlan['afterDiscount']['couponId'];
            $coupon = CouponCode::find($couponId);

            if ($coupon) {
                if ($coupon->coupon_limit != null) {
                    if ($coupon->coupon_limit_left <= 0) {
                        return $this->sendError(__('messages.coupon_code.coupon_limit_reached'));
                    }
                }
            }
        }
        return $this->sendResponse($newPlan, __('messages.coupon_code.coupon_code_applied'));
    }
}
