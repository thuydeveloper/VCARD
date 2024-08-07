<?php

use App\Models\VcardSubscribers;
use Carbon\Carbon;
use Stripe\Stripe;
use App\Models\Nfc;
use App\Models\Plan;
use App\Models\User;
use App\Models\State;
use App\Models\Vcard;
use App\Models\Country;
use App\Models\Setting;
use App\Models\Currency;
use App\Models\Language;
use App\Models\Template;
use App\Models\Gallery;
use App\Models\Testimonial;
use App\Models\VcardService;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Carbon\CarbonPeriod;
use App\Models\SocialIcon;
use App\Models\Withdrawal;
use App\Models\Appointment;
use App\Models\UserSetting;
use Illuminate\Support\Str;
use App\Models\Subscription;
use App\Models\AffiliateUser;
use App\Models\PaymentGateway;
use Intervention\Image\Gd\Font;
use LaravelQRCode\Facades\QRCode;
use App\Models\Role as CustomRole;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\App;
use App\Mail\PlanExpirationReminder;
use App\Models\Product;
use App\Models\SocialLink;
use App\Models\VcardBlog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider;
use Berkayk\OneSignal\OneSignalFacade;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Stancl\Tenancy\Database\TenantScope;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Support\Arr;


function getFormattedDateTime($date)
{
    $formate = Setting::where('key', 'datetime_method')->value('value');

    if ($formate == 1) {
        return date('d M, Y', strtotime($date));
    }

    if ($formate == 2) {
        return date('M d, Y', strtotime($date));
    }

    if ($formate == 3) {
        return date('d/m/Y', strtotime($date));
    }

    if ($formate == 4) {
        return date('Y/m/d', strtotime($date));
    }

    if ($formate == 5) {
        return  date('m/d/Y', strtotime($date));
    }

    if ($formate == 6) {
        return date('Y-m-d', strtotime($date));
    }

    return;
}


function getNfcCard()
{

    return Nfc::all();
}

/**
 * @return Authenticatable|null
 */


function getLogInUser()
{
    return Auth::user();
}

/**
 * @return string[]
 */
function getLanguages()
{
    return User::LANGUAGES;
}

/**
 * @return mixed
 */
function getAppName()
{
    $record = getSuperAdminSettingValue('app_name');

    return (!empty($record)) ? $record : config('app.name');
}

/**
 * @return mixed
 */
function getLogoUrl()
{
    static $settings;

    if (empty($settings)) {
        $settings = Setting::all()->keyBy('key');
    }

    $appLogo = $settings['app_logo'];

    return $appLogo->logo_url;
}

function getDashboardLogoUrl()
{
    static $settings;

    if (empty($settings)) {
        $settings = Setting::all()->keyBy('key');
    }

    if (!empty($settings['dashboard_logo'])) {
        $appLogo = $settings['dashboard_logo'];

        return $appLogo->logo_url;
    }

    return '';
}

/**
 * @return mixed
 */
function getFaviconUrl()
{
    static $settings;

    if (empty($settings)) {
        $settings = Setting::all()->keyBy('key');
    }

    $favicon = $settings['favicon'];

    return $favicon->favicon_url;
}

/**
 * @param  array  $input
 * @param  string  $key
 * @return string|null
 */
function preparePhoneNumber($input, $key)
{
    return (!empty($input[$key])) ? '+' . $input['prefix_code'] . $input[$key] : null;
}

/**
 * @return mixed
 */
function getSuperAdminRoleId()
{
    static $admin;

    if (empty($admin)) {
        $admin = Role::whereName(CustomRole::ROLE_SUPER_ADMIN)->first()->id;
    }

    return $admin;
}

/**
 * @return int
 */
function getLogInUserId()
{
    return Auth::user()->id;
}

/**
 * @return mixed
 */
function getLogInTenantId()
{
    return Auth::user()->tenant_id;
}

/**
 * @return mixed
 */
function getLoggedInUserRoleId()
{
    static $userRoles;

    if (!isset($userRoles[Auth::id()]) && Auth::check()) {
        $roleID = Auth::user()->roles->first()->id;

        $userRoles[Auth::id()] = $roleID;
    }

    return (Auth::check()) ? $userRoles[Auth::id()] : false;
}

/**
 * @return string
 */
function getDashboardURL()
{
    if (Auth::user()->hasRole(CustomRole::ROLE_SUPER_ADMIN)) {
        return RouteServiceProvider::DASHBOARD;
    } elseif (Auth::user()->hasRole(CustomRole::ROLE_ADMIN)) {
        return RouteServiceProvider::ADMIN_DASHBOARD;
    }

    return RouteServiceProvider::HOME;
}

/**
 * @return array
 */
function getCurrencies()
{
    $currencies = Currency::all();
    foreach ($currencies as $currency) {
        $currencyList[$currency->id] = $currency->currency_icon . ' - ' . $currency->currency_name;
    }

    return $currencyList;
}

function getUserCurrencyIcon($userId)
{
    $currencyId = getUserSettingValue('currency_id', $userId);
    $currencyIcon = Currency::whereId($currencyId)->first()->currency_icon;
    return $currencyIcon;
}

function getCurrenciesCode()
{
    $currencies = Currency::all();
    foreach ($currencies as $currency) {
        $currencyCodeList[$currency->currency_code] = $currency->currency_icon . ' - ' . $currency->currency_name;
    }

    return $currencyCodeList;
}

function currencyFormat($number, $precision = 0, $currencyCode = null)
{

    try {
        $currency = new Gerardojbaez\Money\Currency($currencyCode ?? getSuperAdminSettingValue('default_currency'));
        $currency->setPrecision($precision);
        $currency->setThousandSeparator(',');
        $currency->setDecimalSeparator('.');
        $currency->setSymbolPlacement(getSuperAdminSettingValue('currency_after_amount') ? 'after' : 'before');

        try {
            $amount = new Gerardojbaez\Money\Money($number, $currency);
        } catch (Exception $e) {
            $amount = new Gerardojbaez\Money\Money($number, 'USD');
        }
        $formattedAmount = number_format(settype($amount->format(), 'float'), 2);
    } catch (Exception $e) {
        $currencyCode = $currencyCode ?? getSuperAdminSettingValue('default_currency');
        $currency = Currency::whereCurrencyCode($currencyCode)->first();
        $formattedAmount = ($currency->currency_icon === '$') ? $currency->currency_icon . number_format($number, 2) : getCurrencyAmount(number_format($number, 2), $currency->currency_icon);
    }

    return $formattedAmount;
}

/**
 * @return mixed
 */
function getCountry()
{
    $country = Country::orderBy('name')->pluck('name', 'id')->toArray();

    return $country;
}

/**
 * @return mixed
 */
function getState()
{
    $state = State::orderBy('name')->pluck('name', 'id')->toArray();

    return $state;
}

/**
 * @return string[]
 */
function getPayPalSupportedCurrencies()
{
    return [
        'AUD', 'BRL', 'CAD', 'CNY', 'CZK', 'DKK', 'EUR', 'HKD', 'HUF', 'ILS', 'JPY', 'MYR', 'MXN', 'TWD', 'NZD', 'NOK',
        'PHP', 'PLN', 'GBP', 'RUB', 'SGD', 'SEK', 'CHF', 'THB', 'USD',
    ];
}

function getPayStackSupportedCurrencies()
{
    return ['NGN', 'GHS', 'ZAR', 'KES'];
}

/**
 * @param  null  $templates
 */
function getTemplateUrls($templates = null): array
{
    if (!$templates) {
        $templates = Template::orderBy('id', 'desc')->get();
    }

    $templateUrls = [];
    foreach ($templates as $template) {
        $templateUrls[$template->id] = asset($template->path);
    }

    return $templateUrls;
}

function getPlanFeature($plan): array
{
    $features = $plan->planFeature->getFillable();
    $planFeatures = [];
    foreach ($features as $feature) {
        $planFeatures[$feature] = $plan->planFeature->$feature;
    }
    arsort($planFeatures);

    return Arr::except($planFeatures, 'plan_id');
}

function getSocialLink($vcard): array
{
    $socialLink = array_values(array_diff($vcard->socialLink->getFillable(), ['vcard_id']));
    $socialLinkAdd = SocialIcon::whereSocialLinkId($vcard->socialLink->id)->get();

    $vcardSocials = [];
    foreach ($socialLinkAdd as $social) {
        if ($url = parse_url($social->link, PHP_URL_SCHEME) === null ?
            'https://' . $social->link : $social->link
        ) {

            $vcardSocials[$social->link] =
                '<a href="' . $url . '" target="_blank">
                        <img src="' . $social->social_icon . '" alt="" class="" style="width: 30px">
                    </a>';
        }
    }
    foreach ($socialLink as $social) {
        if ($vcard->socialLink->$social) {
            if ($social == 'social_links') {
                foreach (json_decode($vcard->socialLink->$social) as $links) {
                    if ($url = parse_url($links->name, PHP_URL_SCHEME) === null ?
                        'https://' . $links->name : $links->name
                    ) {
                        $vcardSocials[$links->name] =
                            '<a href="' . $url . '" target="_blank">
                        <i class="fas fa-globe icon fa-2x" title="' . __('messages.social.website') . '"></i>
                    </a>';
                    }
                }
            }
            if ($social != 'website') {
                if ($social != 'social_links') {
                    if ($url = parse_url($vcard->socialLink->$social, PHP_URL_SCHEME) === null ?
                        'https://' . $vcard->socialLink->$social : $vcard->socialLink->$social
                    ) {
                        if ($social == 'twitter') {
                            $vcardSocials[$social] = '<a href="' . $url . '" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" class="twitter_icon" viewBox="0 0 512 512" fill="currentColor">
                                    <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/>
                                </svg>
                            </a>';
                        } else {
                            $vcardSocials[$social] = '<a href="' . $url . '" target="_blank">
                                <i class="fab fa-' . $social . ' ' . $social . '-icon icon fa-2x" title="' . __('messages.social.' . ucfirst($social)) . '"></i>
                            </a>';
                        }
                    }
                }
            } else {
                if ($url = parse_url($vcard->socialLink->$social, PHP_URL_SCHEME) === null ?
                    'https://' . $vcard->socialLink->$social : $vcard->socialLink->$social
                ) {
                    $vcardSocials[$social] =
                        '<a href="' . $url . '" target="_blank">
                        <i class="fas fa-globe icon fa-2x" title="' . __('messages.social.website') . '"></i>

                    </a>';
                }
            }
        }

        if ($vcard->location_url != null) {
            $vcardSocials['map'] =
                '<a href="' . $vcard->location_url . '" target="_blank">
                        <i class="fas fa-map-marked-alt icon fa-2x" title="' . __('messages.social.map') . '"></i>
                    </a>';
        }
    }

    return $vcardSocials;
}

/**
 * @return string[]
 */
function zeroDecimalCurrencies(): array
{
    return [
        'BIF', 'CLP', 'DJF', 'GNF', 'JPY', 'KMF', 'KRW', 'MGA', 'PYG', 'RWF', 'UGX', 'VND', 'VUV', 'XAF', 'XOF', 'XPF',
    ];
}

function getAppLogo()
{
    return getSuperAdminSettingValue('app_logo');
}

/**
 * @return mixed|string|string[]
 */
function removeCommaFromNumbers($number)
{
    return (gettype($number) == 'string' && !empty($number)) ? str_replace(',', '', $number) : $number;
}

function setStripeApiKey()
{
    Stripe::setApiKey(getSelectedPaymentGateway('stripe_secret'));
}

function getRandomColor($index): string
{
    $badgeColors = [
        'bg-primary',
        'bg-success',
        'bg-info',
        'bg-secondary',
        'bg-dark',
        'bg-danger',
        'bg-warning',
    ];
    $number = ceil($index % 7);

    if (getLogInUser()->theme_mode == 1) {
        array_splice($badgeColors, 4, 1);
        array_push($badgeColors, 'bg-dark-white');
    }

    return $badgeColors[$number];
}

/**
 * @return mixed
 */
function getCurrentSubscription()
{
    $subscription = Subscription::with(['plan'])
        ->whereTenantId(getLogInTenantId())
        ->where('status', Subscription::ACTIVE)->latest()->first();

    return $subscription;
}

function getCurrentPlanDetails()
{
    $currentSubscription = getCurrentSubscription();
    $isExpired = $currentSubscription->isExpired();
    $currentPlan = $currentSubscription->plan;

    if ($currentPlan->price != $currentSubscription->plan_amount) {
        $currentPlan->price = $currentSubscription->plan_amount;
    }

    $startsAt = Carbon::now();
    $totalDays = Carbon::parse($currentSubscription->starts_at)->diffInDays($currentSubscription->ends_at);
    $usedDays = Carbon::parse($currentSubscription->starts_at)->diffInDays($startsAt);
    if ($totalDays > $usedDays) {
        $usedDays = Carbon::parse($currentSubscription->starts_at)->diffInDays($startsAt);
    } else {
        $usedDays = $totalDays;
    }
    if ($totalDays > $usedDays) {
        $remainingDays = $totalDays - $usedDays;
    } else {
        $remainingDays = 0;
    }

    if ($totalDays == 0) {
        $totalDays = 1;
    }

    $frequency = $currentSubscription->plan_frequency == Plan::MONTHLY ? __('messages.plan.monthly') : __('messages.plan.yearly');

    //    $days = $currentSubscription->plan_frequency == Plan::MONTHLY ? 30 : 365;

    $perDayPrice = round($currentPlan->price / $totalDays, 2);
    if (!empty($currentSubscription->trial_ends_at) || $isExpired) {
        $remainingBalance = 0.00;
        $usedBalance = 0.00;
    } else {
        $isJPYCurrency = !empty($currentPlan->currency) && isJPYCurrency($currentPlan->currency->currency_code);
        $remainingBalance = $currentPlan->price - ($perDayPrice * $usedDays);
        $remainingBalance = $isJPYCurrency ? round($remainingBalance) : $remainingBalance;
        $usedBalance = $currentPlan->price - $remainingBalance;
        $usedBalance = $isJPYCurrency ? round($usedBalance) : $usedBalance;
    }

    return [
        'name' => $currentPlan->name . ' / ' . $frequency,
        'trialDays' => $currentPlan->trial_days,
        'startAt' => Carbon::parse($currentSubscription->starts_at)->format('jS M, Y'),
        'endsAt' => Carbon::parse($currentSubscription->ends_at)->format('jS M, Y'),
        'usedDays' => $usedDays,
        'remainingDays' => $remainingDays,
        'totalDays' => $totalDays,
        'usedBalance' => $usedBalance,
        'remainingBalance' => $remainingBalance,
        'isExpired' => $isExpired,
        'currentPlan' => $currentPlan,
    ];
}

function checkIfPlanIsInTrial($currentSubscription)
{
    $now = Carbon::now();
    if (!empty($currentSubscription->trial_ends_at)) {
        return true;
    }

    return false;
}

/**
 * @return array
 */
function getProratedPlanData($planIDChosenByUser)
{
    /** @var Plan $subscriptionPlan */
    $subscriptionPlan = Plan::findOrFail($planIDChosenByUser);
    if ($subscriptionPlan->custom_select == 1 && $subscriptionPlan->planCustomFields->isNotEmpty()) {
         $subscriptionPlan->price = $subscriptionPlan->planCustomFields[0]->custom_vcard_price;
     }

    if ($subscriptionPlan->frequency == Plan::MONTHLY) {
        $newPlanDays = 30;
        $frequency = __('messages.plan.monthly');
    } else {
        if ($subscriptionPlan->frequency == Plan::YEARLY) {
            $newPlanDays = 365;
            $frequency = __('messages.plan.yearly');
        } else {
            $newPlanDays = 36500;
            $frequency = __('messages.plan.unlimited');
        }
    }
    $currentSubscription = getCurrentSubscription();
    $startsAt = Carbon::now();

    $carbonParseStartAt = Carbon::parse($currentSubscription->starts_at);
    $currentSubsTotalDays = $carbonParseStartAt->diffInDays($currentSubscription->ends_at);
    $usedDays = $carbonParseStartAt->copy()->diffInDays($startsAt);
    $totalExtraDays = 0;
    $totalDays = $newPlanDays;

    $endsAt = Carbon::now()->addDays($newPlanDays);

    $startsAt = $startsAt->copy()->format('jS M, Y');
    if ($usedDays <= 0) {
        $startsAt = $carbonParseStartAt->copy()->format('jS M, Y');
    }

    if (!$currentSubscription->isExpired() && !checkIfPlanIsInTrial($currentSubscription)) {
        $amountToPay = 0;

        $currentPlan = $currentSubscription->plan; // TODO: take fields from subscription

        // checking if the current active subscription plan has the same price and frequency in order to process the calculation for the proration
        $planPrice = $currentPlan->price;
        $planFrequency = $currentPlan->frequency;
        if ($planPrice != $currentSubscription->plan_amount || $planFrequency != $currentSubscription->plan_frequency) {
            $planPrice = $currentSubscription->plan_amount;
            $planFrequency = $currentSubscription->plan_frequency;
        }

        //        $frequencyDays = $planFrequency == Plan::MONTHLY ? 30 : 365;
        $perDayPrice = round($planPrice / $currentSubsTotalDays, 2);
        $isJPYCurrency = !empty($subscriptionPlan->currency) && isJPYCurrency($subscriptionPlan->currency->currency_code);

        $remainingBalance = $isJPYCurrency
            ? round($planPrice - ($perDayPrice * $usedDays))
            : round($planPrice - ($perDayPrice * $usedDays), 2);

        if ($remainingBalance < $subscriptionPlan->price) { // adjust the amount in plan
            $amountToPay = $isJPYCurrency
                ? round($subscriptionPlan->price - $remainingBalance)
                : round($subscriptionPlan->price - $remainingBalance, 2);
        } else {
            $perDayPriceOfNewPlan = round($subscriptionPlan->price / $newPlanDays, 5);
            $totalExtraDays = round($remainingBalance / $perDayPriceOfNewPlan);

            $endsAt = Carbon::now()->addDays($totalExtraDays);
            $totalDays = $totalExtraDays;
        }

        $currency = $subscriptionPlan->currency->currency_icon;

        return [
            'startDate' => $startsAt,
            'name' => $subscriptionPlan->name . ' / ' . $frequency,
            'trialDays' => $subscriptionPlan->trial_days,
            'remainingBalance' => $remainingBalance,
            'endDate' => $endsAt->format('jS M, Y'),
            'amountToPay' => $amountToPay,
            'usedDays' => $usedDays,
            'totalExtraDays' => $totalExtraDays,
            'totalDays' => $totalDays,
            'currency' => $currency,
        ];
    }

    return [
        'name' => $subscriptionPlan->name . ' / ' . $frequency,
        'trialDays' => $subscriptionPlan->trial_days,
        'startDate' => $startsAt,
        'endDate' => $endsAt->format('jS M, Y'),
        'remainingBalance' => 0,
        'amountToPay' => $subscriptionPlan->price,
        'usedDays' => $usedDays,
        'totalExtraDays' => $totalExtraDays,
        'totalDays' => $totalDays,
    ];
}

function YoutubeID($url)
{
    if (strlen($url) > 11) {
        if (preg_match(
            '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',
            $url,
            $match
        )) {
            return $match[1];
        } else {
            return false;
        }
    }

    return $url;
}

function isSubscriptionExpired(): array
{
    $subscription = Subscription::with(['plan'])
        ->whereTenantId(getLogInTenantId())
        ->where('status', Subscription::ACTIVE)->latest()->first();

    if ($subscription == null) {
        return [
            'status' => true,
            'message' => 'Please choose a plan to continue the service.',
        ];
    }

    /** @var Subscription $subscription */
    $subscriptionEndDate = Carbon::parse($subscription->trial_ends_at);

    if ($subscription->trial_ends_at == null) {
        $subscriptionEndDate = Carbon::parse($subscription->ends_at);
    }
    $startsAt = Carbon::now();
    $totalDays = Carbon::parse($subscription->starts_at)->diffInDays($subscriptionEndDate);
    $usedDays = Carbon::parse($subscription->starts_at)->diffInDays($startsAt);
    $diffInDays = $totalDays - $usedDays;

    $expirationMessage = null;
    if ($diffInDays <= getSuperAdminSettingValue('plan_expire_notification') && $diffInDays > 0) {
        $expirationMessage = __('messages.your') . " '{$subscription->plan->name}' " . __('messages.expire_in') . " {$diffInDays} " . __('messages.plan.days');
    } else {
        $expirationMessage = __('messages.your') . " '{$subscription->plan->name}' " . __('messages.plan_expire');
    }

    return [
        'status' => $diffInDays <= getSuperAdminSettingValue('plan_expire_notification'),
        'message' => $expirationMessage,
    ];
}

function setExpiryDate($plan): ?Carbon
{
    $expiryDate = '';
    if ($plan->frequency == Plan::MONTHLY) {
        $date = Carbon::now()->addMonths($plan->valid_upto);
    } elseif ($plan->frequency == Plan::YEARLY) {
        $date = Carbon::now()->addYears($plan->valid_upto);
    } else {
        $expiryDate = null;
    }

    $currentSubs = getCurrentSubscription();
    $remainingDays = '';
    if ($currentSubs->ends_at > Carbon::now()) {
        $remainingDays = Carbon::parse($currentSubs->ends_at)->diffInDays();
    }
    if (isset($date)) {
        $expiryDate = $date->addDays($remainingDays);
    }

    return $expiryDate;
}

/**
 * @return bool
 */
function checkFeature($partName)
{
    if (Auth::check() && getLoggedInUserRoleId() != getSuperAdminRoleId()) {
        $currentPlan = getCurrentSubscription()->plan;
    } else {
        $urlAlias = Route::current()->parameters['alias'];
        $vcard = Vcard::whereUrlAlias($urlAlias)->first();
        if ($vcard) {
            $currentPlan = $vcard->subscriptions()->get()->where('status', 1)->first()->plan;
        } else {
            return false;
        }
    }

    if ($partName == 'services' && !$currentPlan->planFeature->products_services) {
        return false;
    }
    if ($partName == 'products' && !$currentPlan->planFeature->products) {
        return false;
    }
    if ($partName == 'appointments' && !$currentPlan->planFeature->appointments) {
        return false;
    }
    if ($partName == 'testimonials' && !$currentPlan->planFeature->testimonials) {
        return false;
    }
    if ($partName == 'social_links' && !$currentPlan->planFeature->social_links) {
        return false;
    }
    if ($partName == 'custom-fonts' && !$currentPlan->planFeature->custom_fonts) {
        return false;
    }
    if ($partName == 'gallery' && !$currentPlan->planFeature->gallery) {
        return false;
    }
    if ($partName == 'seo' && !$currentPlan->planFeature->seo) {
        return false;
    }
    if ($partName == 'blog' && !$currentPlan->planFeature->blog) {
        return false;
    }
    if ($partName == 'privacy-policy' && !$currentPlan->planFeature->privacy_policy) {
        return false;
    }
    if ($partName == 'term-condition' && !$currentPlan->planFeature->term_condition) {
        return false;
    }
    if ($partName == 'affiliation' && !$currentPlan->planFeature->affiliation) {
        return false;
    }
    if ($partName == 'qrcode-customize' && !$currentPlan->planFeature->custom_qrcode) {
        return false;
    }

    if ($partName == 'order-nfc' && !$currentPlan->planFeature->order_nfc_card) {
        return false;
    }
    if ($partName == 'iframes' && !$currentPlan->planFeature->iframes) {
        return false;
    }
    if ($partName == 'dynamic_vcard' && !$currentPlan->planFeature->dynamic_vcard) {
        return false;
    }
    if ($partName == 'insta_embed' && !$currentPlan->planFeature->insta_embed) {
        return false;
    }
    if ($partName == 'enquiry_form' && !$currentPlan->planFeature->enquiry_form) {
        return false;
    }
    if ($partName == 'password' && !$currentPlan->planFeature->password) {
        return false;
    }

    if ($partName == 'advanced') {
        $feature = $currentPlan->planFeature;
        if (!$feature->password && !$feature->hide_branding && !$feature->custom_css && !$feature->custom_js) {
            return false;
        }

        return $feature;
    }

    return true;
}

function analyticsFeature(): bool
{
    $currentPlan = getCurrentSubscription()->plan;

    if ($currentPlan->planFeature->analytics) {
        return true;
    }

    return false;
}

/**
 * @return int
 */
function planfeaturecount()
{
    $cntcount = 0;
    $planstatus = \App\Models\PlanFeature::wherePlanId(getCurrentSubscription()->plan->id)->first();

    foreach (getPlanFeature(getCurrentSubscription()->plan) as $feature => $value) {
        if ($value) {
            $cntcount++;
        }
    }

    if ($planstatus->enquiry_form == 1) {
        $cntcount--;
    }
    if ($planstatus->hide_branding == 1) {
        $cntcount--;
    }
    if ($planstatus->password == 1) {
        $cntcount--;
    }
    if ($planstatus->custom_js == 1) {
        $cntcount--;
    }
    if ($planstatus->custom_css == 1) {
        $cntcount--;
    }

    return $cntcount;
}

/**
 * @return array
 */

function getSchedulesTimingSlot()
{
    $user = UserSetting::where('user_id', getLogInUser()->id)->get()->pluck('value', 'key');
    $period = new CarbonPeriod('00:00', '15 minutes', '24:00'); // corrected end time to be within 24-hour format
    $slots = [];
    $defaultFormat = 'h:i A'; // Default format is 12-hour

    if (isset($user['time_format'])) {
        if ($user['time_format'] == UserSetting::HOUR_24) {
            $defaultFormat = 'H:i'; // Use 24-hour format if specified
        }
    }

    foreach ($period as $item) {
        $formattedTime = $item->format($defaultFormat);
        $slots[$formattedTime] = $formattedTime;
    }

return $slots;
}

function getBusinessHours(): array
{
    $user = UserSetting::where('user_id', getLogInUser()->id)->get()->pluck('value', 'key');

    $period = new CarbonPeriod('00:00', '15 minutes', '24:00'); // for create use 24 hours format later change format
    $times = [];
    if (isset($user['time_format'])) {
        if ($user['time_format'] == UserSetting::HOUR_12) {
            foreach ($period as $item) {
                $times[$item->format('h:i A')] = $item->format('h:i A');
            }
        } else {
            if ($user['time_format'] == UserSetting::HOUR_24) {
                foreach ($period as $item) {
                    $times[$item->format('H:i')] = $item->format('H:i');
                }
            }
        }
    } else {
        foreach ($period as $item) {
            $times[$item->format('h:i A')] = $item->format('h:i A');
        }
    }

    return $times;
}

/**
 * @return mixed|string
 *
 * @throws Exception
 */
function getTime($time)
{
    if (getUserSettingValue('time_format', getLogInUserId()) == UserSetting::HOUR_12) {
        if (str_contains('AM', $time) || str_contains('PM', $time)) {
            return $time;
        }

        $date = new DateTime($time);

        return $date->format('h:i A');
    } else {
        if (str_contains('AM', $time) || str_contains('PM', $time)) {
            $date = new DateTime($time);

            return $date->format('H:i');
        }
    }

    return $time;
}

/**
 * @return mixed
 */
function getSuperAdminSettingValue($key)
{
    static $settings;
    try {
        DB::connection()->getPdo();
        if (empty($settings)) {
            $settings = Setting::all()->keyBy('key');
        }
        return $settings[$key]->value;
    } catch (\Exception $e) {
    }
}

/**
 * @return array|Application|Translator|string|null
 */
function getSuccessMessage($part)
{
    if ($part == null) {
        return __('messages.vcard.basic_details');
    } else {
        if ($part == 'basic') {
            return __('messages.vcard.basic_details');
        } else {
            return __('messages.vcard.' . $part);
        }
    }
}

/**
 * @return \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed|string|null
 */
function getCurrentLanguageName()
{
    if (Auth::user()) {
        return Auth::user()->language;
    }

    return 'en';
}

/**
 * @return mixed
 */
function getSuperAdminEmail()
{
    static $admin;

    if (empty($admin)) {
        $admin = User::role(CustomRole::ROLE_SUPER_ADMIN)->value('email');
    }

    return $admin;
}

/**
 * @return mixed|string
 */
function checkLanguageSession($alias)
{
    if (Session::has('languageChange_' . $alias)) {
        return Session::get('languageChange_' . $alias);
    }

    return 'en';
}

/**
 * @return string
 */
function getCountryShortCode($countryName)
{
    $country = Country::whereName($countryName)->first();

    return isset($country) ? strtolower($country['short_code']) : '';
}
function getDefaultPhoneCode()
{
    $code = Country::where('short_code', getSuperAdminSettingValue('default_country_code'))->value('phone_code');

    return isset($code) ? '+'.$code : null;
}
/**
 * @return string[]
 */
function getPaymentGateway()
{
    $paymentGateway = Subscription::PAYMENT_GATEWAY;
    $selectedPaymentGateways = PaymentGateway::pluck('payment_gateway')->toArray();

    return array_intersect($paymentGateway, $selectedPaymentGateways);
}

function getRandColor(): string
{
    $bgColors = [
        'success',
        'primary',
        'info',
        'success',
        'dark',
        'secondary',
        'danger',
        'warning',
    ];

    $number = ceil(rand() % 7);

    return $bgColors[$number];
}

/**
 * @return mixed|string
 */
function checkFrontLanguageSession()
{
    if (Session::has('languageName')) {
        return Session::get('languageName');
    }

    return getSuperAdminSettingValue('default_language');
}

/**
 * @return Language[]|Collection
 */
function getAllLanguage()
{
    return Language::where('status', 1)->pluck('name', 'iso_code')->toArray();
}

function getAllLanguageWithFullData()
{
    return Language::where('status', 1)->get();
}

function getBGColors($index): string
{
    $colors = [
        'rgb(245, 158, 11',
        'rgb(77, 124, 15',
        'rgb(254, 199, 2',
        'rgb(80, 205, 137',
        'rgb(16, 158, 247',
        'rgb(241, 65, 108',
        'rgb(80, 205, 137',
        'rgb(245, 152, 28',
        'rgb(13, 148, 136',
        'rgb(59, 130, 246',
        'rgb(162, 28, 175',
        'rgb(190, 18, 60',
        'rgb(244, 63, 94',
        'rgb(30, 30, 45',
    ];

    return $colors[$index % count($colors)];
}

/**
 * @param $index
 * @return string
 */
function getStatusClassName($status)
{
    $classNames = [
        'bg-status-canceled',
        'bg-status-booked',
        'bg-status-checkIn',
        'bg-status-checkOut',
    ];

    $index = $status % 4;

    return $classNames[$index];
}

/**
 * @return mixed
 */
function getMaximumCurrencyCode($getIcon = false)
{
    $plan = Plan::all()->groupBy('currency_id');

    if ($plan->isEmpty()) {
        return;
    }
    if ($getIcon) {
        return $plan->first()->first()->currency->currency_icon;
    }

    return $plan->first()->first()->currency->currency_code;
}

/**
 * @return bool
 */
function isJPYCurrency($code)
{
    return Currency::JPY_CODE == $code;
}

/**
 * @return null
 */
function getUserSettingValue($key, $userId)
{
    $value = '';

    $keyExist = UserSetting::where('key', '=', $key)->where('user_id', $userId)->exists();

    if ($keyExist) {
        $value = UserSetting::where('key', '=', $key)->where('user_id', $userId)->first()->value;
    }

    return $value;
}

function getPaymentMethod($userSetting)
{
    $stripeEnable = $userSetting['stripe_enable'] ?? false;
    $paypalEnable = $userSetting['paypal_enable'] ?? false;
    $flutterwaveEnable = $userSetting['flutterwave_enable'] ?? false;
    $paystackEnable = $userSetting['paytack_enable'] ?? false;
    $phonepeEnable = $userSetting['phonepe_enable'] ?? false;
    $manuallyEnable = $userSetting['manually_payment'] ?? false;
    $paymentTypes = [];
    if (!empty($stripeEnable) && $stripeEnable) {
        $paymentTypes[1] = 'Stripe';
    }
    if (!empty($paypalEnable) && $paypalEnable) {
        $paymentTypes[2] = 'Paypal';
    }
    if (!empty($paystackEnable) && $paystackEnable) {
        $paymentTypes[3] = 'Paystack';
    }
    if (!empty($phonepeEnable) && $phonepeEnable) {
        $paymentTypes[4] = 'PhonePe';
    }
    if (!empty($manuallyEnable) && $manuallyEnable) {
        $paymentTypes[7] = 'Manually';
    }
    if (!empty($flutterwaveEnable) && $flutterwaveEnable) {
        $paymentTypes[8] = 'Flutterwave';
    }
    return $paymentTypes;
}

function setUserStripeApiKey($userId)
{
    $setting = UserSetting::where('user_id', $userId)->where('key', 'stripe_secret')->first();
    if (!empty($setting)) {
        $secretKey = $setting->value;
    }

    Stripe::setApiKey($secretKey);
}

function setLocalLang($localeLanguage): bool
{
    if (!isset($localeLanguage)) {
        App::setLocale('en');
    } else {
        App::setLocale($localeLanguage);
    }

    return true;
}

function getVcardDefaultLanguage(): string
{
    $language = 'en';

    $vcard = Vcard::where('url_alias', request()->alias)->first();

    if (!empty($vcard) && !empty($vcard->default_language)) {
        return $vcard->default_language;
    }

    return $language;
}

/**
 * @return mixed
 */
function getLanguage($language)
{
    $languageIsoCode = Session::get('languageChange_' . request()->alias);

    if (!empty($languageIsoCode)) {
        $language = $languageIsoCode;
    }

    $language = Language::whereIsoCode($language)->first();

    if (!empty($language)) {
        return $language->name;
    }

    return 'English';
}

/**
 * @return mixed
 */
function getLanguageIsoCode($isoCode)
{
    $languageIsoCode = Session::get('languageChange_' . request()->alias);

    if (!empty($languageIsoCode)) {
        return $languageIsoCode;
    }

    return $isoCode;
}

/**
 * @return mixed
 */
function getLocalLanguage()
{
    $languageIsoCode = Session::get('languageChange_' . request()->alias);

    return $languageIsoCode;
}

/**
 * @return mixed
 */
function getCurrentVersion()
{
    $composerFile = file_get_contents(base_path('composer.json'));
    $composerData = json_decode($composerFile, true);
    $currentVersion = $composerData['version'];

    return $currentVersion;
}

function checkPaymentGateway($paymentGateway): bool
{
    if ($paymentGateway == Plan::STRIPE) {
        if (config('services.stripe.key') && config('services.stripe.secret_key')) {
            return true;
        }

        return false;
    }

    if ($paymentGateway == Plan::PAYPAL) {
        if (config('paypal.mode') == 'sandbox') {
            if (config('paypal.sandbox.client_id') && config('paypal.sandbox.client_secret')) {
                return true;
            } else {
                if (config('paypal.live.client_id') && config('paypal.live.client_secret')) {
                    return true;
                }
            }
        }
        if (config('paypal.mode') == 'live') {
            if (config('paypal.sandbox.client_id') && config('paypal.sandbox.client_secret')) {
                return true;
            } else {
                if (config('paypal.live.client_id') && config('paypal.live.client_secret')) {
                    return true;
                }
            }
        }

        return false;
    }

    if ($paymentGateway == Plan::RAZORPAY) {
        if (config('payments.razorpay.key') && config('payments.razorpay.secret')) {
            return true;
        }

        return false;
    }

    if ($paymentGateway == Plan::PAYSTACK) {
        if (config('paystack.publicKey') && config('paystack.secretKey')) {
            return true;
        }

        return false;
    }
    return true;
}

function getSelectedPaymentGateway($keyName)
{
    $key = $keyName;
    static $settingValues;

    if (isset($settingValues[$key])) {
        return $settingValues[$key];
    }
    /** @var Setting $setting */
    $setting = Setting::where('key', '=', $keyName)->first();

    if ($setting->value !== '') {
        $settingValues[$key] = $setting->value;
    } else {
        $envKey = strtoupper($key);
        $settingValues[$key] = env($envKey);
    }

    return $settingValues[$key];
}

function getALlPlanName()
{
    $allPlanName = Plan::where('status', 1)->pluck('name', 'id')->toArray();
    return $allPlanName;
}

function getLanguageByKey($key)
{
    $languageName = Language::where('iso_code', $key)->first();

    if (!empty($languageName['name'])) {
        return $languageName['name'];
    }

    return 'English';
}

function generateUniqueAffiliateCode(): string
{
    $code = strtoupper(Str::random(10));
    $ifAlreadyExists = User::where('affiliate_code', $code)->first();
    if ($ifAlreadyExists) {
        return generateUniqueAffiliateCode();
    }

    return $code;
}

function isAdmin($user = null)
{
    if (empty($user)) {
        $user = Auth::user();
    }

    return $user->hasrole('admin');
}

function currentAffiliateAmount($userId = null)
{
    if (empty($userId)) {
        $userId = getLogInUserId();
    }

    $withdrawAmount = Withdrawal::whereUserId($userId)->whereIsApproved(Withdrawal::APPROVED)->sum('amount');
    $totalAmount = AffiliateUser::whereAffiliatedBy($userId)->sum('amount');

    return $totalAmount - $withdrawAmount;
}

function getCurrencyAmount($amount, $currency_icon)
{
    static $currencyPosition;
    if (empty($currencyPosition)) {
        $currencyPosition = getSuperAdminSettingValue('currency_after_amount');
    }

    if ($currencyPosition) {
        return $amount . '' . $currency_icon;
    }

    return $currency_icon . '' . $amount;
}

function getUniqueVcardUrlAlias()
{

    $urlAlias = strtolower(Str::random(12));
    $vcardWithSameUrl = Vcard::whereUrlAlias($urlAlias)->first();
    if ($vcardWithSameUrl) {
        $urlAlias = getUniqueVcardUrlAlias();
    }

    return $urlAlias;
}

function isUniqueVcardUrlAlias($urlAlias)
{
    $vcardWithSameUrl = Vcard::withoutGlobalScope(TenantScope::class)->whereUrlAlias($urlAlias)->first();
    if ($vcardWithSameUrl) {
        return $vcardWithSameUrl->id;
    }

    return true;
}

function retriveH1Card($input)
{
    $vcard = Vcard::whereId($input['vcard_id'])->first();

    $fullName = $input['first_name'] . ' ' . $input['last_name'];
    $phoneNumber = '+' . $input['region_code'] . ' ' . $input['phone'];
    $vcardUrl = route('vcard.show', ['alias' => $vcard->url_alias]);
    $QRCodePath = public_path('ecard/' . $vcard->id . '-qr.png');
    QRCode::url($vcardUrl)->setSize(5)->setOutfile($QRCodePath)->png();

    $fonts = public_path('fonts/Poppins-Medium.ttf');
    $fontsRegular = public_path('fonts/Poppins-Regular.ttf');
    $imageH1Front = asset('assets/img/ecards/H-Vcard/H-1/BG/Front.png');
    $imageH1AppLogo = asset('web/media/avatars/user.png');

    $im = imagecreatetruecolor(400, 30);
    [$width, $height] = getimagesize($imageH1AppLogo);
    $imageH1Front = imagecreatefromstring(file_get_contents($imageH1Front));
    $imageH1AppLogo = imagecreatefromstring(file_get_contents($input['ecard-logo']));
    $white = imagecolorallocate($im, 255, 255, 255);

    $img = Image::make($imageH1Front);
    $img->insert($imageH1AppLogo, 'center');
    $FrontImgPath = asset('uploads/ecard/' . $vcard->id);

    if (!Storage::exists($FrontImgPath)) {
        Storage::disk('public')->makeDirectory('ecard/' . $vcard->id);
    }

    $frontPAth = public_path('uploads/ecard/' . $vcard->id . '/Front.png');

    imagepng($imageH1Front, $frontPAth);

    $imageH1Back = asset('assets/img/ecards/H-Vcard/H-1/BG/Back.png');
    $imageH1QrCode = public_path('ecard/' . $vcard->id . '-qr.png');

    $im = imagecreatetruecolor(400, 30);
    [$width, $height] = getimagesize($imageH1QrCode);
    $imageH1Back = imagecreatefromstring(file_get_contents($imageH1Back));
    $imageH1QrCode = imagecreatefromstring(file_get_contents($imageH1QrCode));
    $white = imagecolorallocate($im, 255, 255, 255);
    $blueColor = imagecolorallocate($im, 0, 82, 126);
    $grayColor = imagecolorallocate($im, 133, 134, 135);

    insertTextInImg($imageH1Back, $fullName, 1098 / 4, 162, 25, $fonts, $blueColor);
    insertTextInImg($imageH1Back, $input['occupation'], 1098 / 4, 200, 16, $fontsRegular, $grayColor);

    imagecopy($imageH1Back, $imageH1QrCode, 800, 90, 0, 0, $width, $height);
    imagettftext($imageH1Back, 16, 0, 233, 465, $white, $fontsRegular, $input['email']);
    imagettftext($imageH1Back, 16, 0, 233, 566, $white, $fontsRegular, $phoneNumber);
    imagettftext($imageH1Back, 16, 0, 737, 455, $white, $fontsRegular, wordwrap($input['location'], 30, "\n"));
    imagettftext($imageH1Back, 16, 0, 737, 556, $white, $fontsRegular, wordwrap($input['website'], 27, "\n", true));
    $backPAth = public_path('uploads/ecard/' . $vcard->id . '/Back.png');
    imagepng($imageH1Back, $backPAth);
    $fineName = storeImage($vcard);

    return $fineName;
}

function retriveH2Card($input)
{

    $fonts = public_path('fonts/Poppins-Medium.ttf');
    $fontsRegular = public_path('fonts/Poppins-Regular.ttf');
    $vcard = Vcard::whereId($input['vcard_id'])->first();
    $fullName = $input['first_name'] . ' ' . $input['last_name'];
    $phoneNumber = '+' . $input['region_code'] . ' ' . $input['phone'];
    $vcardUrl = route('vcard.show', ['alias' => $vcard->url_alias]);
    $QRCodePath = public_path('ecard/' . $vcard->id . '-qr.png');
    QRCode::url($vcardUrl)->setSize(4)->setOutfile($QRCodePath)->png();

    $imageH1Front = asset('assets/img/ecards/H-Vcard/H-2/BG/Front.png');
    $imageH1QrCode = asset('assets/img/ecards/qr_code.png');
    $imageH1AppLogo = asset('web/media/avatars/user.png');

    $im = imagecreatetruecolor(400, 30);
    [$width, $height] = getimagesize($imageH1AppLogo);
    $imageH1Front = imagecreatefromstring(file_get_contents($imageH1Front));
    $imageH1AppLogo = imagecreatefromstring(file_get_contents($input['ecard-logo']));
    $white = imagecolorallocate($im, 255, 255, 255);

    $img = Image::make($imageH1Front);
    $img->insert($imageH1AppLogo, 'center');
    $FrontImgPath = asset('uploads/ecard/' . $vcard->id);

    if (!Storage::exists($FrontImgPath)) {
        Storage::disk('public')->makeDirectory('ecard/' . $vcard->id);
    }

    $frontPAth = public_path('uploads/ecard/' . $vcard->id . '/Front.png');

    imagepng($imageH1Front, $frontPAth);

    $imageH1Back = asset('assets/img/ecards/H-Vcard/H-2/BG/Back.png');
    $imageH1QrCode = public_path('ecard/' . $vcard->id . '-qr.png');

    $im = imagecreatetruecolor(400, 30);
    [$width, $height] = getimagesize($imageH1QrCode);
    $imageH1Back = imagecreatefromstring(file_get_contents($imageH1Back));
    $imageH1QrCode = imagecreatefromstring(file_get_contents($imageH1QrCode));
    $color = imagecolorallocate($im, 237, 205, 146);

    imagecopy($imageH1Back, $imageH1QrCode, 175, 250, 0, 0, $width, $height);
    imagettftext($imageH1Back, 25, 0, 609, 275, $color, $fonts, $fullName);
    imagettftext($imageH1Back, 20, 0, 609, 338, $color, $fonts, $input['occupation']);
    imagettftext($imageH1Back, 20, 0, 609, 400, $color, $fontsRegular, $phoneNumber);
    header('Content-Type: image/png');

    $backPAth = public_path('uploads/ecard/' . $vcard->id . '/Back.png');

    imagepng($imageH1Back, $backPAth);

    $fineName = storeImage($vcard);

    return $fineName;
}
function retriveH3Card($input)
{
    $vcard = Vcard::whereId($input['vcard_id'])->first();
    $fullName = $input['first_name'] . ' ' . $input['last_name'];
    $phoneNumber = '+' . $input['region_code'] . ' ' . $input['phone'];
    $vcardUrl = route('vcard.show', ['alias' => $vcard->url_alias]);
    $QRCodePath = public_path('ecard/' . $vcard->id . '-qr.png');
    QRCode::url($vcardUrl)->setSize(4)->setOutfile($QRCodePath)->png();

    $fonts = public_path('fonts/Poppins-Medium.ttf');
    $fontsRegular = public_path('fonts/Poppins-Regular.ttf');

    $imageH1Front = asset('assets/img/ecards/H-Vcard/H-3/BG/Front.png');
    $imageH1AppLogo = asset('web/media/avatars/user.png');

    [$width, $height] = getimagesize($imageH1AppLogo);
    $imageH1Front = imagecreatefromstring(file_get_contents($imageH1Front));
    $imageH1AppLogo = imagecreatefromstring(file_get_contents($input['ecard-logo']));

    $img = Image::make($imageH1Front);
    $img->insert($imageH1AppLogo, 'center');
    $FrontImgPath = asset('uploads/ecard/' . $vcard->id);

    if (!Storage::exists($FrontImgPath)) {
        Storage::disk('public')->makeDirectory('ecard/' . $vcard->id);
    }

    $frontPAth = public_path('uploads/ecard/' . $vcard->id . '/Front.png');

    imagepng($imageH1Front, $frontPAth);

    $imageH1Back = asset('assets/img/ecards/H-Vcard/H-3/BG/Back.png');
    $imageH1QrCode = public_path('ecard/' . $vcard->id . '-qr.png');

    [$width, $height] = getimagesize($imageH1QrCode);
    $imageH1Back = imagecreatefromstring(file_get_contents($imageH1Back));
    $imageH1QrCode = imagecreatefromstring(file_get_contents($imageH1QrCode));

    insertTextInImg($imageH1Back, $fullName, 1098 / 2, 370, 25, $fonts, '#343434');
    insertTextInImg($imageH1Back, $phoneNumber, 1098 / 2, 429, 20, $fontsRegular, '#454748');
    insertTextInImg($imageH1Back, $input['occupation'], 1098 / 2, 477, 20, $fontsRegular, '#454748');

    $backgroundWidth = imagesx($imageH1Back);

    $qrCodeWidth = imagesx($imageH1QrCode);
    $qrCodeHeight = imagesy($imageH1QrCode);

    $x = ($backgroundWidth - $qrCodeWidth) / 2;

    $y = $height;

    imagecopy($imageH1Back, $imageH1QrCode, $x, $y, 0, 0, $qrCodeWidth, $qrCodeHeight);

    $backPAth = public_path('uploads/ecard/' . $vcard->id . '/Back.png');
    imagepng($imageH1Back, $backPAth);
    $fineName = storeImage($vcard);

    return $fineName;
}

function retriveH4Card($input)
{
    $vcard = Vcard::whereId($input['vcard_id'])->first();
    $fullName = $input['first_name'] . ' ' . $input['last_name'];
    $phoneNumber = '+' . $input['region_code'] . ' ' . $input['phone'];
    $vcardUrl = route('vcard.show', ['alias' => $vcard->url_alias]);
    $QRCodePath = public_path('ecard/' . $vcard->id . '-qr.png');
    QRCode::url($vcardUrl)->setSize(3)->setOutfile($QRCodePath)->png();

    $fonts = public_path('fonts/Poppins-Medium.ttf');
    $fontsRegular = public_path('fonts/Poppins-Regular.ttf');

    $imageH1Front = asset('assets/img/ecards/H-Vcard/H-4/BG/Front.png');
    $imageH1AppLogo = asset('web/media/avatars/user.png');

    $im = imagecreatetruecolor(400, 30);
    [$width, $height] = getimagesize($imageH1AppLogo);
    $imageH1Front = imagecreatefromstring(file_get_contents($imageH1Front));
    $imageH1AppLogo = imagecreatefromstring(file_get_contents($input['ecard-logo']));
    $white = imagecolorallocate($im, 255, 255, 255);

    $logoWidth = imagesx($imageH1AppLogo);
    $logoHeight = imagesy($imageH1AppLogo);

    $maxWidth = 200;
    $maxHeight = 200;

    $newWidth = min($maxWidth, $logoWidth);
    $newHeight = min($maxHeight, $logoHeight);

    imagecopy($imageH1Front, $imageH1AppLogo, 725, 255, 0, 0, $newWidth, $newHeight);
    header('Content-Type: image/png');

    $FrontImgPath = asset('uploads/ecard/' . $vcard->id);

    if (!Storage::exists($FrontImgPath)) {
        Storage::disk('public')->makeDirectory('ecard/' . $vcard->id);
    }

    $frontPAth = public_path('uploads/ecard/' . $vcard->id . '/Front.png');

    imagepng($imageH1Front, $frontPAth);

    $imageH1Back = asset('assets/img/ecards/H-Vcard/H-4/BG/Back.png');
    $imageH1QrCode = public_path('ecard/' . $vcard->id . '-qr.png');
    $im = imagecreatetruecolor(400, 30);
    [$width, $height] = getimagesize($imageH1QrCode);
    $imageH1Back = imagecreatefromstring(file_get_contents($imageH1Back));
    $imageH1QrCode = imagecreatefromstring(file_get_contents($imageH1QrCode));
    $white = imagecolorallocate($im, 255, 255, 255);

    imagecopy($imageH1Back, $imageH1QrCode, 895, 260, 0, 0, $width, $height);
    imagettftext($imageH1Back, 25, 0, 90, 175, 000, $fonts, $fullName);
    imagettftext($imageH1Back, 16, 0, 90, 210, 000, $fontsRegular, $input['occupation']);
    if (strlen($input['location']) > 60) {
        imagettftext($imageH1Back, 16, 0, 160, 310, 000, $fontsRegular, wordwrap($input['location'], 45, "\n"));
    } else {
        imagettftext($imageH1Back, 16, 0, 160, 324, 000, $fontsRegular, wordwrap($input['location'], 45, "\n"));
    }
    imagettftext($imageH1Back, 16, 0, 160, 385, 000, $fontsRegular, $phoneNumber);
    imagettftext($imageH1Back, 16, 0, 160, 435, 000, $fontsRegular, $input['email']);
    imagettftext($imageH1Back, 16, 0, 160, 490, 000, $fontsRegular, wordwrap($input['website'], 45, "\n", true));

    header('Content-Type: image/png');
    $backPAth = public_path('uploads/ecard/' . $vcard->id . '/Back.png');
    imagepng($imageH1Back, $backPAth);
    $fineName = storeImage($vcard);

    return $fineName;
}

function retriveH5Card($input)
{
    $vcard = Vcard::whereId($input['vcard_id'])->first();
    $fullName = $input['first_name'] . ' ' . $input['last_name'];
    $phoneNumber = '+' . $input['region_code'] . ' ' . $input['phone'];
    $vcardUrl = route('vcard.show', ['alias' => $vcard->url_alias]);
    $QRCodePath = public_path('ecard/' . $vcard->id . '-qr.png');
    QRCode::url($vcardUrl)->setSize(4)->setOutfile($QRCodePath)->png();

    $fonts = public_path('fonts/Poppins-Medium.ttf');
    $fontsRegular = public_path('fonts/Poppins-Regular.ttf');

    $imageH1Front = asset('assets/img/ecards/H-Vcard/H-5/BG/Front.png');
    $imageH1QrCode = asset('assets/img/ecards/qr_code.png');
    $imageH1AppLogo = asset('web/media/avatars/user.png');

    [$width, $height] = getimagesize($imageH1AppLogo);
    $imageH1Front = imagecreatefromstring(file_get_contents($imageH1Front));
    $imageH1AppLogo = imagecreatefromstring(file_get_contents($input['ecard-logo']));

    $logoWidth = imagesx($imageH1AppLogo);
    $logoHeight = imagesy($imageH1AppLogo);

    $maxWidth = 200;
    $maxHeight = 200;

    $newWidth = min($maxWidth, $logoWidth);
    $newHeight = min($maxHeight, $logoHeight);

    imagecopy($imageH1Front, $imageH1AppLogo, 700, 250, 0, 0, $newWidth, $newHeight);

    $FrontImgPath = asset('uploads/ecard/' . $vcard->id);

    if (!Storage::exists($FrontImgPath)) {
        Storage::disk('public')->makeDirectory('ecard/' . $vcard->id);
    }

    $frontPAth = public_path('uploads/ecard/' . $vcard->id . '/Front.png');

    imagepng($imageH1Front, $frontPAth);

    $imageH1Back = asset('assets/img/ecards/H-Vcard/H-5/BG/Back.png');
    $imageH1QrCode = public_path('ecard/' . $vcard->id . '-qr.png');

    $im = imagecreatetruecolor(400, 30);
    [$width, $height] = getimagesize($imageH1QrCode);
    $imageH1Back = imagecreatefromstring(file_get_contents($imageH1Back));
    $imageH1QrCode = imagecreatefromstring(file_get_contents($imageH1QrCode));
    $color = imagecolorallocate($im, 134, 42, 137);

    insertTextInImg($imageH1Back, $fullName, 400, 140, 25, $fonts, $color);
    insertTextInImg($imageH1Back, $input['occupation'], 400, 175, 16, $fontsRegular, '000');

    imagecopy($imageH1Back, $imageH1QrCode, 830, 75, 0, 0, $width, $height);
    imagettftext($imageH1Back, 16, 0, 308, 316, 000, $fontsRegular, wordwrap($input['location'], 65, "\n"));
    imagettftext($imageH1Back, 16, 0, 308, 375, 000, $fontsRegular, $phoneNumber);
    imagettftext($imageH1Back, 16, 0, 308, 424, 000, $fontsRegular, $input['email']);
    imagettftext($imageH1Back, 16, 0, 308, 478, 000, $fontsRegular, wordwrap($input['website'], 45, "\n", true));

    $backPAth = public_path('uploads/ecard/' . $vcard->id . '/Back.png');
    imagepng($imageH1Back, $backPAth);
    $fineName = storeImage($vcard);

    return $fineName;
}

function retriveH6Card($input)
{
    $vcard = Vcard::whereId($input['vcard_id'])->first();
    $fullName = $input['first_name'] . ' ' . $input['last_name'];
    $phoneNumber = '+' . $input['region_code'] . ' ' . $input['phone'];
    $vcardUrl = route('vcard.show', ['alias' => $vcard->url_alias]);
    $QRCodePath = public_path('ecard/' . $vcard->id . '-qr.png');
    QRCode::url($vcardUrl)->setSize(4)->setOutfile($QRCodePath)->png();

    $fonts = public_path('fonts/Poppins-Medium.ttf');
    $fontsRegular = public_path('fonts/Poppins-Regular.ttf');

    $imageH1Front = asset('assets/img/ecards/H-Vcard/H-6/BG/Front.png');
    $imageH1QrCode = asset('assets/img/ecards/qr_code.png');
    $imageH1AppLogo = asset('web/media/avatars/user.png');

    $im = imagecreatetruecolor(400, 30);
    [$width, $height] = getimagesize($imageH1AppLogo);

    $maxWidth = 150;
    $maxHeight = 150;

    $newWidth = min($maxWidth, $width);
    $newHeight = min($maxHeight, $height);

    $imageH1Front = imagecreatefromstring(file_get_contents($imageH1Front));
    $imageH1AppLogo = imagecreatefromstring(file_get_contents($input['ecard-logo']));
    $white = imagecolorallocate($im, 255, 255, 255);

    imagecopy($imageH1Front, $imageH1AppLogo, 50, 490, 0, 0, $maxWidth, $maxHeight);
    header('Content-Type: image/png');

    $FrontImgPath = asset('uploads/ecard/' . $vcard->id);

    if (!Storage::exists($FrontImgPath)) {
        Storage::disk('public')->makeDirectory('ecard/' . $vcard->id);
    }

    $frontPAth = public_path('uploads/ecard/' . $vcard->id . '/Front.png');

    imagepng($imageH1Front, $frontPAth);

    $imageH1Back = asset('assets/img/ecards/H-Vcard/H-6/BG/Back.png');
    $imageH1QrCode = public_path('ecard/' . $vcard->id . '-qr.png');

    $im = imagecreatetruecolor(400, 30);
    [$width, $height] = getimagesize($imageH1QrCode);
    $imageH1Back = imagecreatefromstring(file_get_contents($imageH1Back));
    $imageH1QrCode = imagecreatefromstring(file_get_contents($imageH1QrCode));
    $white = imagecolorallocate($im, 212, 204, 210);

    insertTextInImg($imageH1Back, $fullName, 760, 395, 25, $fonts, $white);
    insertTextInImg($imageH1Back, $input['occupation'], 760, 430, 16, $fontsRegular, $white);

    imagecopy($imageH1Back, $imageH1QrCode, 690, 220, 0, 0, $width, $height);
    $backPAth = public_path('uploads/ecard/' . $vcard->id . '/Back.png');
    imagepng($imageH1Back, $backPAth);
    $fineName = storeImage($vcard);

    return $fineName;
}

function retriveH7Card($input)
{
    $vcard = Vcard::whereId($input['vcard_id'])->first();
    $fullName = $input['first_name'] . ' ' . $input['last_name'];
    $phoneNumber = '+' . $input['region_code'] . ' ' . $input['phone'];
    $vcardUrl = route('vcard.show', ['alias' => $vcard->url_alias]);
    $QRCodePath = public_path('ecard/' . $vcard->id . '-qr.png');
    QRCode::url($vcardUrl)->setSize(3)->setOutfile($QRCodePath)->png();

    $fonts = public_path('fonts/Poppins-Medium.ttf');
    $fontsRegular = public_path('fonts/Poppins-Regular.ttf');

    $imageH1Front = asset('assets/img/ecards/H-Vcard/H-7/BG/Front.png');
    $imageH1QrCode = asset('assets/img/ecards/qr_code.png');
    $imageH1AppLogo = asset('web/media/avatars/user.png');

    $im = imagecreatetruecolor(400, 30);
    [$logoWidth, $logoHeight] = getimagesize($imageH1AppLogo);
    $imageH1Front = imagecreatefromstring(file_get_contents($imageH1Front));
    $imageH1AppLogo = imagecreatefromstring(file_get_contents($input['ecard-logo']));
    $white = imagecolorallocate($im, 255, 255, 255);

    $img = Image::make($imageH1Front);
    $img->insert($imageH1AppLogo, 'center');
    header('Content-Type: image/png');
    $FrontImgPath = asset('uploads/ecard/' . $vcard->id);

    if (!Storage::exists($FrontImgPath)) {
        Storage::disk('public')->makeDirectory('ecard/' . $vcard->id);
    }

    $frontPAth = public_path('uploads/ecard/' . $vcard->id . '/Front.png');

    imagepng($imageH1Front, $frontPAth);

    $imageH1Back = asset('assets/img/ecards/H-Vcard/H-7/BG/Back.png');
    $imageH1QrCode = public_path('ecard/' . $vcard->id . '-qr.png');

    $im = imagecreatetruecolor(400, 30);
    [$width, $height] = getimagesize($imageH1QrCode);
    $imageH1Back = imagecreatefromstring(file_get_contents($imageH1Back));
    $imageH1QrCode = imagecreatefromstring(file_get_contents($imageH1QrCode));

    insertTextInImg($imageH1Back, $fullName, 200, 160, 25, $fonts, '000');
    insertTextInImg($imageH1Back, $input['occupation'], 200, 200, 16, $fontsRegular, '000');

    $maxWidth = 150;
    $maxHeight = 150;

    $newWidth = min($maxWidth, $logoWidth);
    $newHeight = min($maxHeight, $logoHeight);

    imagecopy($imageH1Back, $imageH1AppLogo, 792, 91, 0, 0, $newWidth, $newHeight);
    imagecopy($imageH1Back, $imageH1QrCode, 850, 450, 0, 0, $width, $height);
    imagettftext($imageH1Back, 16, 0, 160, 320, 000, $fontsRegular, $phoneNumber);
    imagettftext($imageH1Back, 16, 0, 160, 410, 000, $fontsRegular, wordwrap($input['website'], 75, "\n", true));
    imagettftext($imageH1Back, 16, 0, 160, 492, 000, $fontsRegular, wordwrap($input['location'], 60, "\n"));

    $backPAth = public_path('uploads/ecard/' . $vcard->id . '/Back.png');
    imagepng($imageH1Back, $backPAth);
    $fineName = storeImage($vcard);

    return $fineName;
}

function retriveH8Card($input)
{
    $vcard = Vcard::whereId($input['vcard_id'])->first();
    $fullName = $input['first_name'] . ' ' . $input['last_name'];
    $phoneNumber = '+' . $input['region_code'] . ' ' . $input['phone'];
    $vcardUrl = route('vcard.show', ['alias' => $vcard->url_alias]);
    $QRCodePath = public_path('ecard/' . $vcard->id . '-qr.png');
    QRCode::url($vcardUrl)->setSize(3)->setOutfile($QRCodePath)->png();

    $fonts = public_path('fonts/Poppins-Medium.ttf');
    $fontsRegular = public_path('fonts/Poppins-Regular.ttf');

    $imageH1Front = asset('assets/img/ecards/V-Vcard/V-8/BG/Front.png');
    $imageH1QrCode = asset('assets/img/ecards/qr_code.png');
    $imageH1AppLogo = asset('web/media/avatars/user.png');

    $im = imagecreatetruecolor(400, 30);
    [$logoWidth, $logoHeight] = getimagesize($imageH1AppLogo);
    $imageH1Front = imagecreatefromstring(file_get_contents($imageH1Front));
    $imageH1AppLogo = imagecreatefromstring(file_get_contents($input['ecard-logo']));
    $white = imagecolorallocate($im, 255, 255, 255);

    $logoWidth = imagesx($imageH1AppLogo);
    $logoHeight = imagesy($imageH1AppLogo);

    $maxWidth = 200;
    $maxHeight = 200;

    $newWidth = min($maxWidth, $logoWidth);
    $newHeight = min($maxHeight, $logoHeight);

    imagecopy($imageH1Front, $imageH1AppLogo, 250, 300, 0, 0, $newWidth, $newHeight);
    header('Content-Type: image/png');
    $FrontImgPath = asset('uploads/ecard/' . $vcard->id);

    if (!Storage::exists($FrontImgPath)) {
        Storage::disk('public')->makeDirectory('ecard/' . $vcard->id);
    }

    $frontPAth = public_path('uploads/ecard/' . $vcard->id . '/Front.png');

    imagepng($imageH1Front, $frontPAth);

    $imageH1Back = asset('assets/img/ecards/V-Vcard/V-8/BG/Back.png');
    $imageH1QrCode = public_path('ecard/' . $vcard->id . '-qr.png');

    $im = imagecreatetruecolor(400, 30);

    $file = public_path('qr/qr.png');
    $tempDirectory = public_path('ecard/tempQRCode' . $vcard->id);
    if (!is_dir($tempDirectory)) {
        File::makeDirectory($tempDirectory, 0777, true);
    }

    $QRCodeName = 'QR.png';
    $frontImageFilePath2 = $tempDirectory . '/' . $QRCodeName;

    file_put_contents($frontImageFilePath2, $imageH1QrCode);

    [$width, $height] = getimagesize($imageH1QrCode);
    $imageH1Back = imagecreatefromstring(file_get_contents($imageH1Back));
    $imageH1QrCode = imagecreatefromstring(file_get_contents($imageH1QrCode));
    // $imageH1QrCode = imagecreatefromstring($qrCode);
    $white = imagecolorallocate($im, 255, 255, 255);
    header('Content-Type: image/png');

    imagecopy($imageH1Back, $imageH1AppLogo, 245, 140, 0, 0, $logoWidth, $logoHeight);
    imagecopy($imageH1Back, $imageH1QrCode, 450, 870, 0, 0, $width, $height);
    // imagecopy($imageH1Back, $qrCode, 434, 800, 0, 0, $width, $height);
    imagettftext($imageH1Back, 16, 0, 94, 670, 000, $fonts, $fullName);
    imagettftext($imageH1Back, 14, 0, 94, 695, 000, $fontsRegular, $input['occupation']);
    imagettftext($imageH1Back, 14, 0, 121, 791, 000, $fontsRegular, wordwrap($input['location'], 50, "\n"));
    imagettftext($imageH1Back, 14, 0, 121, 852, 000, $fontsRegular, $phoneNumber);
    imagettftext($imageH1Back, 14, 0, 121, 907, 000, $fontsRegular, $input['email']);
    imagettftext($imageH1Back, 14, 0, 121, 971, 000, $fontsRegular, wordwrap($input['website'], 30, "\n", true));
    $backPAth = public_path('uploads/ecard/' . $vcard->id . '/Back.png');
    imagepng($imageH1Back, $backPAth);
    $fineName = storeImage($vcard);

    return $fineName;
}

function retriveH9Card($input)
{
    $vcard = Vcard::whereId($input['vcard_id'])->first();
    $fullName = $input['first_name'] . ' ' . $input['last_name'];
    $phoneNumber = '+' . $input['region_code'] . ' ' . $input['phone'];
    $vcardUrl = route('vcard.show', ['alias' => $vcard->url_alias]);
    $QRCodePath = public_path('ecard/' . $vcard->id . '-qr.png');
    QRCode::url($vcardUrl)->setSize(3)->setOutfile($QRCodePath)->png();

    $fonts = public_path('fonts/Poppins-Medium.ttf');
    $fontsRegular = public_path('fonts/Poppins-Regular.ttf');

    $imageH1Front = asset('assets/img/ecards/V-Vcard/V-9/BG/Front.png');
    $imageH1QrCode = asset('assets/img/ecards/qr_code.png');
    $imageH1AppLogo = asset('web/media/avatars/user.png');

    $im = imagecreatetruecolor(400, 30);
    [$logoWidth, $logoHeight] = getimagesize($imageH1AppLogo);
    $imageH1Front = imagecreatefromstring(file_get_contents($imageH1Front));
    $imageH1AppLogo = imagecreatefromstring(file_get_contents($input['ecard-logo']));
    $white = imagecolorallocate($im, 255, 255, 255);

    $logoWidth = imagesx($imageH1AppLogo);
    $logoHeight = imagesy($imageH1AppLogo);

    $maxWidth = 200;
    $maxHeight = 200;

    $newWidth = min($maxWidth, $logoWidth);
    $newHeight = min($maxHeight, $logoHeight);

    imagecopy($imageH1Front, $imageH1AppLogo, 255, 400, 0, 0, $newWidth, $newHeight);
    $img = Image::make($imageH1Front);

    $img->text($input['website'], 261, 1061, function ($font) use ($fontsRegular, $white) {
        $font->file($fontsRegular);
        $font->size(14);
        $font->color($white);
        $font->align('left');
    });
    header('Content-Type: image/png');

    $FrontImgPath = asset('uploads/ecard/' . $vcard->id);

    if (!Storage::exists($FrontImgPath)) {
        Storage::disk('public')->makeDirectory('ecard/' . $vcard->id);
    }

    $frontPAth = public_path('uploads/ecard/' . $vcard->id . '/Front.png');

    imagepng($imageH1Front, $frontPAth);

    $imageH1Back = asset('assets/img/ecards/V-Vcard/V-9/BG/Back.png');
    $imageH1QrCode = public_path('ecard/' . $vcard->id . '-qr.png');

    $im = imagecreatetruecolor(400, 30);
    [$width, $height] = getimagesize($imageH1QrCode);
    $imageH1Back = imagecreatefromstring(file_get_contents($imageH1Back));
    $imageH1QrCode = imagecreatefromstring(file_get_contents($imageH1QrCode));
    $color = imagecolorallocate($im, 255, 153, 0);

    imagecopy($imageH1Back, $imageH1AppLogo, 238, 100, 0, 0, $logoWidth, $logoHeight);
    imagecopy($imageH1Back, $imageH1QrCode, 430, 940, 0, 0, $width, $height);
    imagettftext($imageH1Back, 16, 0, 125, 440, $color, $fonts, $fullName);
    imagettftext($imageH1Back, 14, 0, 125, 470, 000, $fontsRegular, $input['occupation']);
    imagettftext($imageH1Back, 14, 0, 125, 620, 000, $fontsRegular, $phoneNumber);
    imagettftext($imageH1Back, 14, 0, 125, 720, 000, $fontsRegular, wordwrap($input['website'], 40, "\n", true));
    imagettftext($imageH1Back, 14, 0, 125, 817, 000, $fontsRegular, wordwrap($input['location'], 45, "\n"));

    $backPAth = public_path('uploads/ecard/' . $vcard->id . '/Back.png');
    imagepng($imageH1Back, $backPAth);
    $fineName = storeImage($vcard);

    return $fineName;
}

function retriveH10Card($input)
{
    $vcard = Vcard::whereId($input['vcard_id'])->first();
    $fullName = $input['first_name'] . ' ' . $input['last_name'];
    $phoneNumber = '+' . $input['region_code'] . ' ' . $input['phone'];
    $vcardUrl = route('vcard.show', ['alias' => $vcard->url_alias]);
    $QRCodePath = public_path('ecard/' . $vcard->id . '-qr.png');
    QRCode::url($vcardUrl)->setSize(5)->setOutfile($QRCodePath)->png();

    $fonts = public_path('fonts/Poppins-Medium.ttf');
    $fontsRegular = public_path('fonts/Poppins-Regular.ttf');

    $imageH1Front = asset('assets/img/ecards/V-Vcard/V-10/BG/Front.png');
    $imageH1QrCode = asset('assets/img/ecards/qr_code.png');
    $imageH1AppLogo = asset('web/media/avatars/user.png');

    $im = imagecreatetruecolor(400, 30);
    [$width, $height] = getimagesize($imageH1AppLogo);
    $imageH1Front = imagecreatefromstring(file_get_contents($imageH1Front));
    $imageH1AppLogo = imagecreatefromstring(file_get_contents($input['ecard-logo']));
    $white = imagecolorallocate($im, 255, 255, 255);

    $img = Image::make($imageH1Front);
    $img->insert($imageH1AppLogo, 'center');
    header('Content-Type: image/png');

    $FrontImgPath = asset('uploads/ecard/' . $vcard->id);

    if (!Storage::exists($FrontImgPath)) {
        Storage::disk('public')->makeDirectory('ecard/' . $vcard->id);
    }

    $frontPAth = public_path('uploads/ecard/' . $vcard->id . '/Front.png');

    imagepng($imageH1Front, $frontPAth);

    $imageH1Back = asset('assets/img/ecards/V-Vcard/V-10/BG/Back.png');
    $imageH1QrCode = public_path('ecard/' . $vcard->id . '-qr.png');

    $im = imagecreatetruecolor(400, 30);
    [$width, $height] = getimagesize($imageH1QrCode);
    $imageH1Back = imagecreatefromstring(file_get_contents($imageH1Back));
    $imageH1QrCode = imagecreatefromstring(file_get_contents($imageH1QrCode));
    $white = imagecolorallocate($im, 255, 255, 255);
    $color = imagecolorallocate($im, 7, 151, 144);

    insertTextInImg($imageH1Back, $fullName, 648 / 2, 130, 25, $fonts, $color);
    insertTextInImg($imageH1Back, $input['occupation'], 648 / 2, 170, 16, $fontsRegular, '000');

    $backgroundWidth = imagesx($imageH1Back);

    $qrCodeWidth = imagesx($imageH1QrCode);
    $qrCodeHeight = imagesy($imageH1QrCode);

    $x = ($backgroundWidth - $qrCodeWidth) / 2;

    $y = $height;

    imagecopy($imageH1Back, $imageH1QrCode, $x, $y, 0, 0, $qrCodeWidth, $qrCodeHeight);
    // imagecopy($imageH1Back, $imageH1QrCode, 250, 260, 0, 0, $width, $height);
    imagettftext($imageH1Back, 14, 0, 170, 743, $white, $fontsRegular, wordwrap($input['location'], 45, "\n"));
    imagettftext($imageH1Back, 14, 0, 170, 823, $white, $fontsRegular, $phoneNumber);
    imagettftext($imageH1Back, 14, 0, 170, 880, $white, $fontsRegular, $input['email']);
    imagettftext($imageH1Back, 14, 0, 170, 945, $white, $fontsRegular, wordwrap($input['website'], 40, "\n", true));

    $backPAth = public_path('uploads/ecard/' . $vcard->id . '/Back.png');
    imagepng($imageH1Back, $backPAth);
    $fineName = storeImage($vcard);

    return $fineName;
}

function retriveH11Card($input)
{
    $vcard = Vcard::whereId($input['vcard_id'])->first();
    $fullName = $input['first_name'] . ' ' . $input['last_name'];
    $phoneNumber = '+' . $input['region_code'] . ' ' . $input['phone'];
    $vcardUrl = route('vcard.show', ['alias' => $vcard->url_alias]);
    $QRCodePath = public_path('ecard/' . $vcard->id . '-qr.png');
    QRCode::url($vcardUrl)->setSize(4)->setOutfile($QRCodePath)->png();

    $fonts = public_path('fonts/Poppins-Medium.ttf');
    $fontsRegular = public_path('fonts/Poppins-Regular.ttf');

    $imageH1Front = asset('assets/img/ecards/V-Vcard/V-11/BG/Front.png');
    $imageH1QrCode = asset('assets/img/ecards/qr_code.png');
    $imageH1AppLogo = asset('web/media/avatars/user.png');

    $im = imagecreatetruecolor(400, 30);
    [$width, $height] = getimagesize($imageH1AppLogo);
    $imageH1Front = imagecreatefromstring(file_get_contents($imageH1Front));
    $imageH1AppLogo = imagecreatefromstring(file_get_contents($input['ecard-logo']));
    $white = imagecolorallocate($im, 255, 255, 255);

    $logoWidth = imagesx($imageH1AppLogo);
    $logoHeight = imagesy($imageH1AppLogo);

    $maxWidth = 200;
    $maxHeight = 200;

    $newWidth = min($maxWidth, $logoWidth);
    $newHeight = min($maxHeight, $logoHeight);

    imagecopy($imageH1Front, $imageH1AppLogo, 255, 230, 0, 0, $newWidth, $newHeight);
    header('Content-Type: image/png');

    $FrontImgPath = asset('uploads/ecard/' . $vcard->id);

    if (!Storage::exists($FrontImgPath)) {
        Storage::disk('public')->makeDirectory('ecard/' . $vcard->id);
    }

    $frontPAth = public_path('uploads/ecard/' . $vcard->id . '/Front.png');

    imagepng($imageH1Front, $frontPAth);

    $imageH1Back = asset('assets/img/ecards/V-Vcard/V-11/BG/Back.png');
    $imageH1QrCode = public_path('ecard/' . $vcard->id . '-qr.png');

    $im = imagecreatetruecolor(400, 30);
    [$width, $height] = getimagesize($imageH1QrCode);
    $imageH1Back = imagecreatefromstring(file_get_contents($imageH1Back));
    $imageH1QrCode = imagecreatefromstring(file_get_contents($imageH1QrCode));
    $color = imagecolorallocate($im, 0, 174, 169);
    imagecopy($imageH1Back, $imageH1QrCode, 460, 900, 0, 0, $width, $height);
    imagettftext($imageH1Back, 20, 0, 200, 190, $color, $fonts, $fullName);
    imagettftext($imageH1Back, 14, 0, 200, 235, 000, $fontsRegular, $input['occupation']);
    imagettftext($imageH1Back, 14, 0, 200, 425, 000, $fontsRegular, $input['email']);
    if (strlen($input['location']) > 60) {
        imagettftext($imageH1Back, 14, 0, 200, 500, 000, $fontsRegular, wordwrap($input['location'], 45, "\n"));
    } else {
        imagettftext($imageH1Back, 14, 0, 200, 515, 000, $fontsRegular, wordwrap($input['location'], 45, "\n"));
    }
    imagettftext($imageH1Back, 14, 0, 200, 605, 000, $fontsRegular, wordwrap($input['website'], 40, "\n", true));
    imagettftext($imageH1Back, 14, 0, 200, 710, 000, $fontsRegular, $phoneNumber);
    $backPAth = public_path('uploads/ecard/' . $vcard->id . '/Back.png');
    imagepng($imageH1Back, $backPAth);
    $fineName = storeImage($vcard);

    return $fineName;
}

function retriveH12Card($input)
{
    $vcard = Vcard::whereId($input['vcard_id'])->first();
    $fullName = $input['first_name'] . ' ' . $input['last_name'];
    $phoneNumber = '+' . $input['region_code'] . ' ' . $input['phone'];
    $vcardUrl = route('vcard.show', ['alias' => $vcard->url_alias]);
    $QRCodePath = public_path('ecard/' . $vcard->id . '-qr.png');
    QRCode::url($vcardUrl)->setSize(4)->setOutfile($QRCodePath)->png();

    $fonts = public_path('fonts/Poppins-Medium.ttf');
    $fontsRegular = public_path('fonts/Poppins-Regular.ttf');

    $imageH1Front = asset('assets/img/ecards/V-Vcard/V-12/BG/Front.png');
    $imageH1QrCode = asset('assets/img/ecards/qr_code.png');
    $imageH1AppLogo = asset('web/media/avatars/user.png');

    $im = imagecreatetruecolor(400, 30);
    [$width, $height] = getimagesize($imageH1AppLogo);
    $imageH1Front = imagecreatefromstring(file_get_contents($imageH1Front));
    $imageH1AppLogo = imagecreatefromstring(file_get_contents($input['ecard-logo']));
    $white = imagecolorallocate($im, 255, 255, 255);

    $logoWidth = imagesx($imageH1AppLogo);
    $logoHeight = imagesy($imageH1AppLogo);

    $maxWidth = 200;
    $maxHeight = 200;

    $newWidth = min($maxWidth, $logoWidth);
    $newHeight = min($maxHeight, $logoHeight);

    imagecopy($imageH1Front, $imageH1AppLogo, 255, 250, 0, 0, $newWidth, $newHeight);
    header('Content-Type: image/png');

    $FrontImgPath = asset('uploads/ecard/' . $vcard->id);

    if (!Storage::exists($FrontImgPath)) {
        Storage::disk('public')->makeDirectory('ecard/' . $vcard->id);
    }

    $frontPAth = public_path('uploads/ecard/' . $vcard->id . '/Front.png');

    imagepng($imageH1Front, $frontPAth);

    $imageH1Back = asset('assets/img/ecards/V-Vcard/V-12/BG/Back.png');
    $imageH1QrCode = public_path('ecard/' . $vcard->id . '-qr.png');

    $im = imagecreatetruecolor(400, 30);
    [$width, $height] = getimagesize($imageH1QrCode);
    $imageH1Back = imagecreatefromstring(file_get_contents($imageH1Back));
    $imageH1QrCode = imagecreatefromstring(file_get_contents($imageH1QrCode));
    $color = imagecolorallocate($im, 1, 140, 213);

    insertTextInImg($imageH1Back, $fullName, 648 / 2, 770, 30, $fonts, $color);
    insertTextInImg($imageH1Back, $input['occupation'], 648 / 2, 800, 20, $fontsRegular, '000');

    imagecopy($imageH1Back, $imageH1QrCode, 255, 860, 0, 0, $width, $height);
    $backPAth = public_path('uploads/ecard/' . $vcard->id . '/Back.png');
    imagepng($imageH1Back, $backPAth);
    $fineName = storeImage($vcard);

    return $fineName;
}

function retriveH13Card($input)
{
    $vcard = Vcard::whereId($input['vcard_id'])->first();
    $fullName = $input['first_name'] . ' ' . $input['last_name'];
    $phoneNumber = '+' . $input['region_code'] . ' ' . $input['phone'];
    $vcardUrl = route('vcard.show', ['alias' => $vcard->url_alias]);
    $QRCodePath = public_path('ecard/' . $vcard->id . '-qr.png');
    QRCode::url($vcardUrl)->setSize(4)->setOutfile($QRCodePath)->png();

    $fonts = public_path('fonts/Poppins-Medium.ttf');
    $fontsRegular = public_path('fonts/Poppins-Regular.ttf');

    $imageH1Front = asset('assets/img/ecards/V-Vcard/V-13/BG/Front.png');
    $imageH1QrCode = asset('assets/img/ecards/qr_code.png');
    $imageH1AppLogo = asset('web/media/avatars/user.png');

    $im = imagecreatetruecolor(400, 30);
    [$width, $height] = getimagesize($imageH1AppLogo);
    $imageH1Front = imagecreatefromstring(file_get_contents($imageH1Front));
    $imageH1AppLogo = imagecreatefromstring(file_get_contents($input['ecard-logo']));
    $white = imagecolorallocate($im, 255, 255, 255);

    $logoWidth = imagesx($imageH1AppLogo);
    $logoHeight = imagesy($imageH1AppLogo);

    $maxWidth = 200;
    $maxHeight = 200;

    $newWidth = min($maxWidth, $logoWidth);
    $newHeight = min($maxHeight, $logoHeight);

    imagecopy($imageH1Front, $imageH1AppLogo, 255, 620, 0, 0, $newWidth, $newHeight);
    $FrontImgPath = asset('uploads/ecard/' . $vcard->id);

    if (!Storage::exists($FrontImgPath)) {
        Storage::disk('public')->makeDirectory('ecard/' . $vcard->id);
    }

    $frontPAth = public_path('uploads/ecard/' . $vcard->id . '/Front.png');
    imagepng($imageH1Front, $frontPAth);

    $frontPAth = public_path('uploads/ecard/' . $vcard->id . '/Front.png');
    $imageH1Back = asset('assets/img/ecards/V-Vcard/V-13/BG/Back.png');
    $imageH1QrCode = public_path('ecard/' . $vcard->id . '-qr.png');

    $im = imagecreatetruecolor(400, 30);
    [$width, $height] = getimagesize($imageH1QrCode);
    $imageH1Back = imagecreatefromstring(file_get_contents($imageH1Back));
    $imageH1QrCode = imagecreatefromstring(file_get_contents($imageH1QrCode));
    $color = imagecolorallocate($im, 253, 194, 67);

    insertTextInImg($imageH1Back, $fullName, 648 / 2, 180, 30, $fonts, $color);
    insertTextInImg($imageH1Back, $input['occupation'], 648 / 2, 220, 20, $fontsRegular, $white);
    imagecopy($imageH1Back, $imageH1QrCode, 235, 320, 0, 0, $width, $height);
    header('Content-Type: image/png');
    $frontPAth = public_path('uploads/ecard/' . $vcard->id . '/Back.png');
    imagepng($imageH1Back, $frontPAth);
    $fineName = storeImage($vcard);

    return $fineName;
}

function insertTextInImg($image, $text, $x, $y, $fontSize, $fontPath, $color)
{
    $img = Image::make($image);
    $img->text($text, $x, $y, function (Font $font) use ($color, $fontSize, $fontPath) {
        $font->file($fontPath);
        $font->size($fontSize);
        $font->color($color);
        $font->align('center');
    });
}

function storeImage($vcard)
{
    $frontImageContents = Storage::disk('public')->get('ecard/' . $vcard->id . '/Front.png');

    $backImageContents = Storage::disk('public')->get('ecard/' . $vcard->id . '/Back.png');

    $tempDirectory = public_path('virtual_backgrounds');
    if (!is_dir($tempDirectory)) {
        File::makeDirectory($tempDirectory, 0777, true);
    }
    $frontName = 'Front.jpg';
    $backName = 'Back.jpg';
    $frontImageFilePath = $tempDirectory . '/' . $frontName;
    $backImageFilePath = $tempDirectory . '/' . $backName;

    file_put_contents($frontImageFilePath, $frontImageContents);
    file_put_contents($backImageFilePath, $backImageContents);
    $zipFilename = 'virtual-backgrounds.zip';
    $zipFilePath = $tempDirectory . '/' . $zipFilename;

    $zip = new \ZipArchive();
    if ($zip->open($zipFilePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($tempDirectory),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );
        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($tempDirectory) + 1);
                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close();
    }

    $zipFilePath = 'virtual_backgrounds/' . $zipFilename;
    $fineName = [$zipFilePath, $zipFilename];

    return $fineName;
}
function getHEXToRGB($color)
{
    // explode(" ",$str)
}

function homePageLayout()
{
    return getSuperAdminSettingValue('home_page_theme') == 2 ? 'front.layouts.app1' : 'front.layouts.app';
}

function checkTotalVcard(): bool
{
    $makeVcard = false;
    $subscription = Subscription::where('tenant_id', getLogInTenantId())->where(
        'status',
        Subscription::ACTIVE
    )->first();

    if (!empty($subscription)) {
        $totalCards = Vcard::whereTenantId(getLogInTenantId())->count();
        $makeVcard = $subscription->no_of_vcards > $totalCards;
    }

    return $makeVcard;
}

function getCurrencyIcon($currencyCode)
{
    return Currency::whereCurrencyCode($currencyCode)->first()->currency_icon;
}
function formatCurrency($price, $currencyIcon)
{
    if ($currencyIcon == '$') {
        return $currencyIcon . number_format($price);
    } else {
        return getCurrencyAmount(number_format($price), $currencyIcon);
    }
}

function sendVcardNotifications($vcardId)
{
    $vcard = Vcard::whereId($vcardId)->first();
    $playerIds = VcardSubscribers::where('vcard_id', $vcard->id)->pluck('player_id')->toArray();
    $params = [];
    if (empty($playerIds)) {
        return;
    }
    $params['include_player_ids'] = $playerIds;
    $params['url'] = url($vcard->url_alias);
    $contents = [
        'en' => "Don't Skip - $vcard->name Click to uncover the latest update - Simple Tap",
    ];
    $params['contents'] = $contents;
    OneSignalFacade::sendNotificationCustom($params);
}

function totalStorage()
{
    $totalStorageData = totalStorageData();
    $totalStorageData = collect($totalStorageData)->sum();
    $totalStorageInMB = $totalStorageData / (1024 * 1024);

    return $totalStorageInMB;
}

function totalStorageData()
{
    $productIds = $blogIds = $serviceIds = $testimonialIds = $socialIds = $galleryIds = $vcardIds = $socialLinkIds = [];
    $totalStorage = [
        'product_storage' => 0,
        'blog_storage' => 0,
        'services_storage' => 0,
        'testimonial_storage' => 0,
        'social_storage' => 0,
        'gallery_storage' => 0,
        'profile_storage' => 0,
        'pwa_storage' => 0,
        'avatar_storage' => 0,
    ];
    $vcard = Vcard::with(['services', 'gallery', 'testimonials', 'products', 'blogs'])
        ->whereTenantId(getLogInTenantId())
        ->get();

    foreach ($vcard as $card) {
        // Sum up product storage
        array_push($vcardIds, $card->id);

        foreach ($card->products as $product) {
            array_push($productIds, $product->id);
        }

        // Sum up blogId storage
        foreach ($card->blogs as $blog) {
            array_push($blogIds, $blog->id);
        }

        // Sum up testimonialIds storage
        foreach ($card->testimonials as $testimonial) {
            array_push($testimonialIds, $testimonial->id);
        }

        // Sum up galleryIds storage
        foreach ($card->gallery as $gallery) {
            array_push($galleryIds, $gallery->id);
        }


        // Sum up serviceIds storage
        foreach ($card->services as $service) {
            array_push($serviceIds, $service->id);
        }
    }

    $totalStorage['product_storage'] = Media::where('model_type', Product::class)
        ->whereIn('model_id', $productIds)
        ->sum('size');

    // Sum up blog storage
    $totalStorage['blog_storage'] = Media::where('model_type', VcardBlog::class)
        ->whereIn('model_id', $blogIds)
        ->sum('size');

    $socialLinkIds = SocialLink::whereIn('vcard_id', $vcardIds)->pluck('id')->toArray();

    // Sum up social storage
    $socialLinks = SocialIcon::whereIn('social_link_id', $socialLinkIds)->get();
    foreach ($socialLinks as $socialLink) {
        array_push($socialIds, $socialLink->id);
    }

    // Sum up social storage
    $totalStorage['social_storage'] = Media::where('model_type', SocialIcon::class)
        ->whereIn('model_id', $socialIds)
        ->sum('size');

    // Sum up services storage
    $totalStorage['services_storage'] = Media::where('model_type', VcardService::class)
        ->whereIn('model_id', $serviceIds)
        ->sum('size');

    // Sum up testimonial storage
    $totalStorage['testimonial_storage'] = Media::where('model_type', Testimonial::class)
        ->whereIn('model_id', $testimonialIds)
        ->sum('size');

    // Sum up gallery storage
    $totalStorage['gallery_storage'] = Media::where('model_type', Gallery::class)
        ->whereIn('model_id', $galleryIds)
        ->sum('size');

    // Sum up profile storage
    $totalStorage['profile_storage'] = Media::where('model_type', Vcard::class)
        ->whereIn('model_id', $vcardIds)
        ->sum('size');

    // Sum up Pwa storage
    $userPwa = UserSetting::where('user_id', getLogInUserId())
        ->where('key', 'pwa_icon')
        ->first();
    if ($userPwa) {
        $totalStorage['pwa_storage'] = Media::where('model_type', UserSetting::class)
            ->where('model_id', $userPwa->id)
            ->sum('size');
    }

    // Sum up avatar storage
    $totalStorage['avatar_storage'] = Media::where('model_type', User::class)
        ->where('model_id', getLogInUserId())
        ->sum('size');

    return $totalStorage;
}
function hasActiveSubscription()
{
    $subscription = Subscription::with('plan')
        ->where('status', Subscription::ACTIVE)
        ->where('tenant_id', getLogInUser()->tenant_id)
        ->first();
    if ($subscription && !$subscription->isExpired()) {
        return true;
    }
    return false;
}
if (! function_exists('getTranslatedData')) {
         function getTranslatedData($data)
         {
             $translatedDataArr = collect($data)->map(function ($value) {
                 return __('messages.'.strtolower($value));
             });

             return $translatedDataArr;
         }
     }
     function existPlan() {

         $subscription = Subscription::with('plan')
             ->where('status', Subscription::ACTIVE)->get();
        return  $subscription;
    }


function totalStorageDataForUsersWithPlans()
{
   $usersWithPlans = User::whereHas('subscriptions', function ($query) {
       $query->where('status', Subscription::ACTIVE);
   })->get();

   $allUsersStorage = [];

   foreach ($usersWithPlans as $user) {
       $productIds = $blogIds = $serviceIds = $testimonialIds = $socialIds = $galleryIds = $vcardIds = $socialLinkIds = [];
       $totalStorage = [
           'product_storage' => 0,
           'blog_storage' => 0,
           'services_storage' => 0,
           'testimonial_storage' => 0,
           'social_storage' => 0,
           'gallery_storage' => 0,
           'profile_storage' => 0,
           'pwa_storage' => 0,
           'avatar_storage' => 0,
       ];

       $vcards = Vcard::with(['services', 'gallery', 'testimonials', 'products', 'blogs'])
           ->where('tenant_id', $user->tenant_id)
           ->get();

       foreach ($vcards as $card) {
           // Sum up product storage
           $vcardIds[] = $card->id;

           foreach ($card->products as $product) {
               $productIds[] = $product->id;
           }

           // Sum up blog storage
           foreach ($card->blogs as $blog) {
               $blogIds[] = $blog->id;
           }

           // Sum up testimonial storage
           foreach ($card->testimonials as $testimonial) {
               $testimonialIds[] = $testimonial->id;
           }

           // Sum up gallery storage
           foreach ($card->gallery as $gallery) {
               $galleryIds[] = $gallery->id;
           }

           // Sum up service storage
           foreach ($card->services as $service) {
               $serviceIds[] = $service->id;
           }
       }

       $totalStorage['product_storage'] = Media::where('model_type', Product::class)
           ->whereIn('model_id', $productIds)
           ->sum('size');

       $totalStorage['blog_storage'] = Media::where('model_type', VcardBlog::class)
           ->whereIn('model_id', $blogIds)
           ->sum('size');

       $socialLinkIds = SocialLink::whereIn('vcard_id', $vcardIds)->pluck('id')->toArray();

       // Sum up social storage
       $socialLinks = SocialIcon::whereIn('social_link_id', $socialLinkIds)->get();
       foreach ($socialLinks as $socialLink) {
           $socialIds[] = $socialLink->id;
       }

       $totalStorage['social_storage'] = Media::where('model_type', SocialIcon::class)
           ->whereIn('model_id', $socialIds)
           ->sum('size');

       $totalStorage['services_storage'] = Media::where('model_type', VcardService::class)
           ->whereIn('model_id', $serviceIds)
           ->sum('size');

       $totalStorage['testimonial_storage'] = Media::where('model_type', Testimonial::class)
           ->whereIn('model_id', $testimonialIds)
           ->sum('size');

       $totalStorage['gallery_storage'] = Media::where('model_type', Gallery::class)
           ->whereIn('model_id', $galleryIds)
           ->sum('size');

       $totalStorage['profile_storage'] = Media::where('model_type', Vcard::class)
           ->whereIn('model_id', $vcardIds)
           ->sum('size');

       // Sum up Pwa storage
       $userPwa = UserSetting::where('user_id', $user->id)
           ->where('key', 'pwa_icon')
           ->first();
       if ($userPwa) {
           $totalStorage['pwa_storage'] = Media::where('model_type', UserSetting::class)
               ->where('model_id', $userPwa->id)
               ->sum('size');
       }

       // Sum up avatar storage
       $totalStorage['avatar_storage'] = Media::where('model_type', User::class)
           ->where('model_id', $user->id)
           ->sum('size');

       $allUsersStorage[$user->id] = $totalStorage;
   }

   return $allUsersStorage;
}
function totalStorageDataForUsers()
{
   $totalStorageUserData = totalStorageDataForUsersWithPlans();
   $totalStorageUserData = collect($totalStorageUserData)->reduce(function ($carry, $item) {
       foreach ($item as $key => $value) {
           if (!isset($carry[$key])) {
               $carry[$key] = 0;
           }
           $carry[$key] += $value;
       }
       return $carry;
   }, []);

   $totalStorageUserDataSum = array_sum($totalStorageUserData);
   $totalStorageUserInMB = $totalStorageUserDataSum / (1024 * 1024);

   return $totalStorageUserInMB;

}
function getMaxStorageUsedByPlan($planId) {
         $usersWithPlan = User::whereHas('subscriptions', function ($query) use ($planId) {
             $query->where('plan_id', $planId)->where('status', Subscription::ACTIVE);
         })->get();

         $maxStorageUsed = 0;

         foreach ($usersWithPlan as $user) {
             $userStorage = totalStorageDataForUsersWithPlans()[$user->id];
             $userTotalStorage = array_sum($userStorage);

             if ($userTotalStorage > $maxStorageUsed) {
                 $maxStorageUsed = $userTotalStorage;
             }
         }

         return $maxStorageUsed / (1024 * 1024); // Convert bytes to MB
     }
     if (! function_exists('manageVcards')) {
         function manageVcards($user = null)
         {
         if(!$user){
            $user = getLogInUser();
         }
            $vCards = Vcard::where('tenant_id', $user->tenant_id)->get();
            $limitOfVcards = Subscription::whereTenantId($user->tenant_id)->where('status', Subscription::ACTIVE)->latest()->first()->no_of_vcards;

            if ($vCards->count() > $limitOfVcards) {
                  $excessVcards = $vCards->sortByDesc('created_at')->skip($limitOfVcards);

                  foreach ($excessVcards as $vCard) {
                      $vCard->update(['status' => '0']);
                  }
              }
         }
     }
