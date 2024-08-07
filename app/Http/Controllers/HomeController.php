<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContactRequest;
use App\Mail\LandingContactUsMail;
use App\Models\AboutUs;
use App\Models\ContactUs;
use App\Models\Feature;
use App\Models\FrontFAQs;
use App\Models\FrontTestimonial;
use App\Models\Meta;
use App\Models\Plan;
use App\Models\Setting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class HomeController extends AppBaseController
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $testimonials = FrontTestimonial::with('media')->get();
        $faqs =  FrontFAQs::first();
        $metas = Meta::first();

        if (! empty($metas)) {
            $metas = $metas->toArray();
        }

        $setting = Setting::pluck('value', 'key')->toArray();

        $aboutUS = AboutUs::with('media')->get()->toArray();

        $features = Feature::all();

        $plans = Plan::with(['currency', 'planFeature', 'hasZeroPlan', 'planCustomFields'])->whereIsDefault(Plan::IS_DEACTIVE)->whereStatus(Plan::IS_ACTIVE)->get();

        $homePage = getSuperAdminSettingValue('home_page_theme') == 1 ? 'home' : 'home1';
        $view = getSuperAdminSettingValue('is_front_page') ? view("front.home.$homePage", compact('plans', 'setting', 'features', 'testimonials', 'aboutUS', 'metas', 'faqs')) : redirect(route('login'));

        return $view;
    }

    public function store(CreateContactRequest $request)
    {
        $input = $request->all();
        $user = getSuperAdminEmail();

        ContactUs::create($input);
        Mail::to($user)
            ->send(new LandingContactUsMail(
                $input,
                __('messages.placeholder.message_sent')
            ));

        return $this->sendSuccess(__('messages.placeholder.message_sent'));
    }

    /**
     * @return Application|Factory|View
     */
    public function showContactUs(): \Illuminate\View\View
    {
        return view('sadmin.contactus.index');
    }

    public function destroyContactUs(ContactUs $enquiry): JsonResponse
    {
        $enquiry->delete();
        return $this->sendSuccess(__('messages.flash.enquiry_delete'));
    }

    public function themeConfiguration(): \Illuminate\View\View
    {
        $setting = Setting::all()->pluck('value', 'key');

        $view = view('settings.theme_config.index', compact('setting'));

        return $view;
    }

    public function changeLanguage(Request $request): RedirectResponse
    {
        Session::put('languageName', $request->input('languageName'));

        return redirect()->back();
    }


    public function banner(Request $request): \Illuminate\View\View
    {
        $setting = Setting::all()->pluck('value', 'key');

        return view('sadmin.supportBanner.index', compact('setting'));
    }
    public function appDownload(Request $request): \Illuminate\View\View
    {
        $setting = Setting::all()->pluck('value', 'key');

        return view('sadmin.supportMobile.index', compact('setting'));
    }

    /**
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function termCondition()
    {
        $setting = Setting::all()->pluck('value', 'key');
        $faqs =  FrontFAQs::first();

        $view = view('front.terms_conditions', compact('setting', 'faqs'));

        return $view;
    }

    /**
     * @return Application|Factory|View
     */
    public function privacyPolicy(): \Illuminate\View\View
    {
        $setting = Setting::all()->pluck('value', 'key');
        $faqs =  FrontFAQs::first();

        return view('front.privacy_policy', compact('setting', 'faqs'));
    }

    public function declineCookie()
    {
        session(['declined' => 1]);
    }

    public function vcardTemplates(){

        $setting = Setting::pluck('value', 'key')->toArray();
        $faqs =  FrontFAQs::first();
        return view('front.home.vcards-templates', compact('setting','faqs'));
    }

    public function forntFaq(){

        $setting = Setting::pluck('value', 'key')->toArray();
        $faq = FrontFAQs::all();
        $faqs =  FrontFAQs::first();
        if(getSuperAdminSettingValue('home_page_theme') == 2){
            return view('front.home.home-faq1', compact('setting', 'faq', 'faqs'));
        }else{

            return view('front.home.home-faq', compact('setting', 'faq', 'faqs'));
        }

    }

}
