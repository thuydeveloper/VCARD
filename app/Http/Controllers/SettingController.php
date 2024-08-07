<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBannerRequest;
use App\Http\Requests\HomeBannerRequest;
use App\Http\Requests\HomePageSettingRrequest;
use App\Http\Requests\MobileRequest;
use App\Http\Requests\UpdateFrontCmsRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Meta;
use App\Models\PaymentGateway;
use App\Models\Plan;
use App\Models\Setting;
use App\Repositories\SettingRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class SettingController extends AppBaseController
{
    private SettingRepository $settingRepository;

    /**
     * SettingController constructor.
     */
    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index(Request $request): \Illuminate\View\View
    {
        $setting = Setting::pluck('value', 'key')->toArray();
        $paymentGateways = Plan::PAYMENT_METHOD;
        $paypalMode = Plan::PAYPAL_MODE;
        $selectedPaymentGateways = PaymentGateway::pluck('payment_gateway_id', 'payment_gateway')->toArray();

        $metas = Meta::first();
        $sectionName = ($request->get('section') === null) ? 'general' : $request->get('section');
        if (! empty($metas)) {
            $metas = $metas->toArray();
        }

        return view(
            "settings.$sectionName",
            compact('setting', 'selectedPaymentGateways', 'metas', 'sectionName', 'paymentGateways', 'paypalMode')
        );
    }

    public function update(UpdateSettingRequest $request): RedirectResponse
    {

        if ($request->favicon) {
            $imageSize = getimagesize($request->favicon);
            $width = $imageSize[0];
            $height = $imageSize[1];

            if ($width > 16 && $height > 16) {
                Flash::error(__('messages.placeholder.favicon_invalid'));

                return redirect()->back();
            }
        }

        $id = Auth::id();
        $this->settingRepository->update($request->all(), $id);

        Flash::success(__('messages.flash.setting_update'));

        return redirect(route('setting.index'));
    }

    /**
     * @return Application|Factory|View
     */
    public function frontCmsIndex(): \Illuminate\View\View
    {
        $setting = Setting::pluck('value', 'key')->toArray();

        return view('settings.front_cms.index', compact('setting'));
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function frontCmsUpdate(UpdateFrontCmsRequest $request): RedirectResponse
    {
        $id = Auth::id();

        $this->settingRepository->update($request->all(), $id);

        Flash::success(__('messages.flash.front_cms'));

        return redirect(route('setting.front.cms'));
    }

    public function settingTermsConditions(Request $request): RedirectResponse
    {
        $inputs = $request->all();
        $inputs = Arr::except($inputs, ['_token']);
        $inputs['terms_conditions'] = json_decode($inputs['terms_conditions']);
        $inputs['privacy_policy'] = json_decode($inputs['privacy_policy']);

        foreach ($inputs as $key => $value) {

            /** @var FrontCMSSetting $cmsSetting */
            $termsConditions = Setting::where('key', $key)->first();

            $termsConditions->update(['value' => $value]);
        }
        Flash::success(__('messages.vcard.term-condition').' '.__('messages.flash.vcard_update'));

        return Redirect::back();
    }

    public function updateManualPaymentGuide(Request $request): RedirectResponse
    {
        $input = $request->all();

        $input = Arr::except($input, ['_token']);
        $input['manual_payment_guide'] = json_decode($input['manual_payment_guide']);
        $input['is_manual_payment_guide_on'] = isset($input['is_manual_payment_guide_on']);

        foreach ($input as $key => $value) {
            $manualPaymentGuide = Setting::where('key', $key)->first();
            $manualPaymentGuide->update(['value' => $value]);
        }

        Flash::success(__('messages.vcard.manual_payment_guide').' '.__('messages.flash.vcard_update'));

        return redirect()->back();
    }

    public function updateMobileValidation()
    {
        $setting = Setting::where('key', 'mobile_validation')->firstOrFail();
        $setting->update([
            'value' => $setting->value ? 0 : 1,
        ]);
        Flash::success(__('messages.flash.mobile_validation'));

        return $this->sendSuccess('messages.flash.mobile_validation');
    }

    public function updateGoogleAnalytics(Request $request): RedirectResponse
    {
        Meta::query()->delete();

        if (isset($request->site_title) || isset($request->site_title) || isset($request->site_title) || isset($request->site_title) || isset($request->google_analytics)) {
            Meta::updateOrCreate([
                'site_title' => $request->site_title,
                'home_title' => $request->home_title,
                'meta_keyword' => $request->meta_keyword,
                'meta_description' => $request->meta_description,
                'google_analytics' => $request->google_analytics,
            ]);
        }

        Flash::success(__('messages.vcard.google_config').' '.__('messages.flash.vcard_update'));

        return Redirect::back();
    }

    public function updatePaymentMethod(UpdatePaymentRequest $request): RedirectResponse
    {
        $paymentGateways = $request->payment_gateway;
        $input = $request->all();

        PaymentGateway::query()->delete();

        if (isset($paymentGateways)) {
            foreach ($paymentGateways as $paymentGateway) {
                PaymentGateway::updateOrCreate(
                    ['payment_gateway_id' => $paymentGateway],
                    [
                        'payment_gateway' => Plan::PAYMENT_METHOD[$paymentGateway],
                    ]
                );
            }
        }

        $paymentMethodKeys = [
            'stripe_key', 'stripe_secret', 'flutterwave_key', 'flutterwave_secret', 'paypal_client_id', 'paypal_secret','paypal_mode', 'razorpay_key', 'razorpay_secret', 'paystack_key', 'paystack_secret', 'phonepe_merchant_id', 'phonepe_merchant_user_id', 'phonepe_env', 'phonepe_salt_key', 'phonepe_salt_index', 'manual_payment_guide',
        ];
            foreach ($paymentMethodKeys as $key) {
                    $setting = Setting::where('key', $key)->first();
                    $setting->update(['value' => $input[$key]]);
            }

        Flash::success(__('messages.vcard.payment_config').' '.__('messages.flash.vcard_update'));

        return Redirect::back();
    }

    public function updateTheme(Request $request){

        $themeSetting = Setting::where('key','home_page_theme')->first();
        $themeSetting->update(['value'=>$request->theme_id]);

        Flash::success(__('messages.flash.success_theme_update'));
        return Redirect::back();
    }

    public function upgradeDatabase(){

        Artisan::call('migrate', ['--force' => true]);
        Flash::success(__('messages.flash.database_upgrade_succesfully'));

        return Redirect::back();
    }

    public function generateSitemap(){

        Artisan::call('sitemap:generate');
        Flash::success(__('messages.sitemap_generated'));

        return Redirect::back();
    }

    public function bannerStore(HomeBannerRequest $request)
    {
        $requestData = $request->all();
        $this->settingRepository->updateBanner($requestData);
        Flash::success(__('messages.flash.banner_data_update'));
        return Redirect::back();
    }

    public function appUrlStore(MobileRequest $request)
    {
        $requestData = $request->all();
        $this->settingRepository->updateAppUrl($requestData);
        Flash::success(__('messages.app_download_url'));
        return Redirect::back();
    }

    public function homePageUpdate(Request $request): RedirectResponse
    {
        if ($request->favicon) {
            $imageSize = getimagesize($request->favicon);
            $width = $imageSize[0];
            $height = $imageSize[1];

            if ($width > 16 && $height > 16) {
                Flash::error(__('messages.placeholder.favicon_invalid'));

                return redirect()->back();
            }
        }

        $id = Auth::id();
        $this->settingRepository->homePageUpdate($request->all(), $id);

        Flash::success(__('messages.flash.setting_update'));

        return redirect()->back();
    }
}
