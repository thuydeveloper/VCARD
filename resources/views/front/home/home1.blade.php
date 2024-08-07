@extends('front.layouts.app1')
@section('title')
    {{ getAppName() }}
@endsection
@section('content')

    <!-- start hero section -->
    <section class="hero-section position-relative pb-60" @if (checkFrontLanguageSession() == 'ar') dir="rtl" @endif>
        <div class="container"> @include('flash::message') </div>
        <div class="hero-bg-img text-end">
            <img src="{{ asset('assets/img/new_home_page/hero-bg.png') }}" class="w-100 h-100" alt="hero-img" />
        </div>
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-6 text-lg-start text-center mb-lg-0 mb-md-5 mb-4">
                    <div class="hero-content">
                        <h1 class="text-black mb-2">{{ $setting['home_page_title'] }}</h1>
                        <p class="text-gray-100 fs-18 mb-40 ">
                            {{ $setting['sub_text'] ?? '' }}
                        </p>
                        <a href="{{ route('register') }}" class="btn btn-primary" role="button" data-turbo="false">
                            {{ __('auth.get_started') }}</a>
                    </div>
                </div>
                <div class="col-lg-6 text-center mt-lg-0 mt-4">
                    <div class="hero-img mx-auto">
                        <img src="{{ isset($setting['home_page_banner']) ? $setting['home_page_banner'] : asset('assets/img/new_front/hero-img.png') }}"
                            alt="Vcard" class="zoom-in-zoom-out w-100 h-auto" />
                    </div>

                </div>
            </div>
        </div>
        <div class="main-banner banner-img-1">
            <img src="{{ asset('assets/img/new_home_page/shape-1.png') }}" class="w-100 h-auto" alt="image">
        </div>
        <div class="main-banner banner-img-2">
            <img src="{{ asset('assets/img/new_home_page/shape-2.png') }}" class="w-100 h-auto" alt="image">
        </div>
        <div class="main-banner banner-img-3">
            <img src="{{ asset('assets/img/new_home_page/shape-3.png') }}" class="w-100 h-auto" alt="image">
        </div>
        <div class="main-banner banner-img-4">
            <img src="{{ asset('assets/img/new_home_page/shape-4.png') }}" class="w-100 h-auto" alt="image">
        </div>
        <div class="main-banner banner-img-5">
            <img src="{{ asset('assets/img/new_home_page/shape-5.png') }}" class="w-100 h-auto" alt="image">
        </div>
        <div class="main-banner banner-img-6">
            <img src="{{ asset('assets/img/new_home_page/shape-6.png') }}" class="w-100 h-auto" alt="image">
        </div>
        <div class="main-banner banner-img-7">
            <img src="{{ asset('assets/img/new_home_page/shape-7.png') }}" class="w-100 h-auto" alt="image">
        </div>
        <div class="main-banner banner-img-8">
            <img src="{{ asset('assets/img/new_home_page/shape-8.png') }}" class="w-100 h-auto" alt="image">
        </div>
    </section>
    <!-- end hero section -->
    <div class="vcard-template-section pt-60 pb-100 position-relative">
        <div class="vcard-bg position-absolute">
            <img src="{{ asset('assets/img/new_home_page/vcard-template-bg.png') }}" alt="vcard-bg" class="w-100 h-auto">
        </div>
        <div class="plus-vector1 position-absolute">
            <img src="{{ asset('assets/img/new_home_page/plus-vector.png') }}" alt="vector" class="w-100 h-auto">
        </div>
        <div class="plus-vector2 position-absolute">
            <img src="{{ asset('assets/img/new_home_page/plus-vector.png') }}" alt="vector" class="w-100 h-auto">
        </div>
        <div class="plus-vector3 position-absolute">
            <img src="{{ asset('assets/img/new_home_page/plus-vector2.png') }}" alt="vector" class="w-100 h-auto">
        </div>
        {{-- vcard slider --}}
        <section class="vcard-section pb-100" id="">
            <div class="container w-100">
                <div class="section-heading text-center mb-60">
                    <h2 class="d-inline-block"> {{ __('messages.vcards_templates') }}</h2>
                </div>
                <div class="center-slider">
                    <div>
                        <div class="vcard-card">
                            <img src="{{ asset('assets/img/templates/home/vcard22.png') }}" class="w-100 vcard-img"
                                alt="vcard-img">
                        </div>
                    </div>
                    <div>
                        <div class="vcard-card">
                            <img src="{{ asset('assets/img/templates/home/vcard12.png') }}" class="img-fluid vcard-img"
                                alt="vcard-img">
                        </div>
                    </div>
                    <div>
                        <div class="vcard-card">
                            <img src="{{ asset('assets/img/templates/home/vcard13.png') }}" class="w-100 vcard-img "
                                alt="vcard-img">
                        </div>
                    </div>
                    <div>
                        <div class="vcard-card">
                            <img src="{{ asset('assets/img/templates/home/vcard14.png') }}" class="w-100 vcard-img"
                                alt="vcard-img">
                        </div>
                    </div>
                    <div>
                        <div class="vcard-card">
                            <img src="{{ asset('assets/img/templates/home/vcard15.png') }}" class="w-100 vcard-img"
                                alt="vcard-img">
                        </div>
                    </div>
                    <div>
                        <div class="vcard-card">
                            <img src="{{ asset('assets/img/templates/home/vcard16.png') }}" class="w-100 vcard-img"
                                alt="vcard-img">
                        </div>
                    </div>
                    <div>
                        <div class="vcard-card">
                            <img src="{{ asset('assets/img/templates/home/vcard17.png') }}" class="w-100 vcard-img"
                                alt="vcard-img">
                        </div>
                    </div>

                </div>
                <div class="col-12 text-center mt-5">
                    <a href="{{ route('vcard-templates') }}" class="btn btn-primary-light" role="button"
                        data-turbo="false">{{ __('messages.common.view_more') }}</a>
                </div>
            </div>
        </section>
    </div>
    <!-- start features section -->
    <section class="features-section overflow-hidden @if (checkFrontLanguageSession() == 'ar') rtl @endif" id="frontFeaturesTab">
        <div class="container">
            <div class="section-heading text-start mb-60">
                <h2 class="d-inline-block">{{ __('messages.plan.features') }}</h2>
            </div>
            <div class="feature-slider">
                @foreach ($features as $feature)
                    <div class="">
                        <div class="feature-card">
                            <div class="card-img overflow-hidden">
                                <img src="{{ $feature->profile_image }}" class="w-100 h-100 object-fit-cover"
                                    alt="feature-img">
                            </div>
                            <div class="card-body p-0">
                                <h3 class="fs-18 mb-3">{{ $feature->name }}</h3>
                                <p class="text-gray-100 mb-0">{!! $feature->description !!}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- end features section -->

    <!-- start modern & powerful-interface section -->
    <section class="modern-interface-section overflow-hidden pb-100" id="frontAboutTabUsTab"
        @if (checkFrontLanguageSession() == 'ar') dir="rtl" @endif>
        <div class="container">
            <div class="section-heading text-center mb-60">
                <h2 class="d-inline-block">{{ __('auth.modern_&_powerful_interface') }}</h2>
            </div>
            <div class="interface-card mb-40">
                <div class="row m-0 pb-2 justify-content-between align-items-center">
                    <div class="col-lg-5 col-md-6 mb-md-0 mb-40">
                        <div class="interface-img">
                            <img class="h-auto w-100"
                                src="{{ isset($aboutUS[0]['about_url']) ? $aboutUS[0]['about_url'] : asset('front/images/about-1.png') }}"
                                alt="interface-img">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="card-desc ps-lg-0 ps-md-4">
                            <h3 class="card-title fs-20 fw-6 mb-3">
                                {{ $aboutUS[0]['title'] }}
                            </h3>
                            <p class="card-text text-gray-100">
                                {!! nl2br(e($aboutUS[0]['description'])) !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="interface-card mb-40">
                <div class="row pb-2 m-0 flex-md-row flex-column-reverse justify-content-between align-items-center">
                    <div class="col-lg-6 col-md-6 pe-lg-0 pe-md-4">
                        <div class="card-desc">
                            <h3 class="card-title fs-20 fw-6 mb-3">
                                {{ $aboutUS[1]['title'] }}
                            </h3>
                            <p class="card-text text-gray-100">
                                {!! nl2br(e($aboutUS[1]['description'])) !!}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6 mb-md-0 mb-40">
                        <div class="interface-img">
                            <img class="h-auto w-100"
                                src="{{ isset($aboutUS[1]['about_url']) ? $aboutUS[1]['about_url'] : asset('front/images/about-2.png') }}"
                                alt="interface img" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="interface-card">
                <div class="row m-0 pb-2 justify-content-between align-items-center">
                    <div class="col-lg-5 col-md-6 mb-md-0 mb-40">
                        <div class="interface-img">
                            <img class="h-auto w-100"
                                src="{{ isset($aboutUS[2]['about_url']) ? $aboutUS[2]['about_url'] : asset('front/images/about-3.png') }}"
                                alt="interface img" />
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="card-desc ps-lg-0 ps-md-4">
                            <h3 class="card-title fs-20 fw-6 mb-3">
                                {{ $aboutUS[2]['title'] }}
                            </h3>
                            <p class="card-text text-gray-100">
                                {!! nl2br(e($aboutUS[2]['description'])) !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end modern & powerful-interface section  -->

    <!-- start pricing section -->
    <section class="pricing-plan-section pb-100 @if (checkFrontLanguageSession() == 'ar') rtl @endif" id="frontPricingTab">
        <div class="container">
            <div class="section-heading text-center mb-60">
                <h2 class="d-inline-block"> {{ __("auth.choose_a_plan_that's_right_for_you") }}</h2>
            </div>
            <div class="pricing-slider">
                @foreach ($plans as $plan)
                    <div class="">
                        <div class="pricing-card h-100">
                            <div class="text-center">
                                <h3 class="card-title text-primary">{!! $plan->name !!}</h3>
                                <div
                                    class="{{ getLoggedInUserRoleId() != getSuperAdminRoleId() ? '' : 'd-flex justify-content-center align-items-center mb-4' }}">
                                    @if ($plan->custom_select == 1 && $plan->planCustomFields->isNotEmpty())
                                        <h2 class="price text-center fw-5 mb-30">
                                            {{ $plan->currency->currency_icon }} <span
                                                class="custom-price-{{ $plan->id }}">{{ $plan->planCustomFields[0]->custom_vcard_price }}</span>
                                            @if ($plan->frequency == 1)
                                                <span class="fs-18">/ {{ __('messages.plan.monthly') }}</span>
                                            @elseif($plan->frequency == 2)
                                                <span class="fs-18">/ {{ __('messages.plan.yearly') }}</span>
                                            @endif
                                        </h2>
                                    @else
                                        <h2 class="price text-center fw-5 mb-30" id="price_{{ $plan->id }}">
                                            {{ $plan->currency->currency_icon }} {{ $plan->price }}
                                            @if ($plan->frequency == 1)
                                                <span class="fs-18">/ {{ __('messages.plan.monthly') }}</span>
                                            @elseif($plan->frequency == 2)
                                                <span class="fs-18">/ {{ __('messages.plan.yearly') }}</span>
                                            @endif
                                        </h2>
                                    @endif
                                    <div
                                        class="d-flex justify-content-center align-items-center {{ getLoggedInUserRoleId() != getSuperAdminRoleId() ? 'mb-4' : 'ms-2' }}">
                                        @if ($plan->custom_select == 1 && $plan->planCustomFields->isNotEmpty())
                                            {{-- <label
                                             class="fs-18 mb-3 text-gray-100">{{ __('messages.plan.custom_no_of_vcards') }}</label> --}}
                                            <select id="vcardNumber-{{ $plan->id }}"
                                                class="form-select customSelect me-2" data-plan-id="{{ $plan->id }}"
                                                style="{{ getLoggedInUserRoleId() != getSuperAdminRoleId() ? 'width:30% !important; padding: 10px 30px' : 'width:100% !important; padding: 10px 30px' }}">
                                                @foreach ($plan->planCustomFields as $customField)
                                                    @php
                                                        $formattedPrice = $customField->custom_vcard_price;
                                                    @endphp
                                                    <option value="{{ $customField->id }}"
                                                        data-price="{{ $formattedPrice }}"
                                                        data-currency="{{ $plan->currency->currency_code }}">
                                                        {{ $customField->custom_vcard_number }} </option>
                                                @endforeach
                                            </select>
                                        @endif
                                        <div class="text-center">
                                            @if (getLoggedInUserRoleId() != getSuperAdminRoleId())
                                                @if (getLogInUser() && getLoggedInUserRoleId() != getSuperAdminRoleId())
                                                    <div class="mx-auto">
                                                        @if (
                                                            !empty(getCurrentSubscription()) &&
                                                                $plan->id == getCurrentSubscription()->plan_id &&
                                                                !getCurrentSubscription()->isExpired())
                                                            @if ($plan->price != 0)
                                                                <button type="button"
                                                                    class="btn btn-success rounded-3  mx-auto w-100 d-block cursor-remove-plan pricing-plan-button-active"
                                                                    data-id="{{ $plan->id }}" data-turbo="false">
                                                                    {{ __('messages.subscription.currently_active') }}</button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn btn-info rounded-3  mx-auto d-block cursor-remove-plan"
                                                                    data-turbo="false">
                                                                    {{ __('messages.subscription.renew_free_plan') }}
                                                                </button>
                                                            @endif
                                                        @else
                                                            @if (
                                                                !empty(getCurrentSubscription()) &&
                                                                    !getCurrentSubscription()->isExpired() &&
                                                                    ($plan->price == 0 || $plan->price != 0))
                                                                @if ($plan->hasZeroPlan->count() == 0)
                                                                    <a href="{{ $plan->price != 0 ? route('choose.payment.type', $plan->id) : 'javascript:void(0)' }}"
                                                                        class="btn btn-primary rounded-3 mx-auto w-100 {{ $plan->price == 0 ? 'freePayment' : '' }}"
                                                                        data-id="{{ $plan->id }}"
                                                                        id="planId{{ $plan->id }}"
                                                                        data-plan-price="{{ $plan->price }}"
                                                                        data-turbo="false">
                                                                        {{ __('messages.subscription.switch_plan') }}</a>
                                                                @else
                                                                    <button type="button"
                                                                        class="btn btn-info rounded-3 mx-auto d-block cursor-remove-plan"
                                                                        data-turbo="false">
                                                                        {{ __('messages.subscription.renew_free_plan') }}
                                                                    </button>
                                                                @endif
                                                            @else
                                                                @if ($plan->hasZeroPlan->count() == 0)
                                                                    <a href="{{ $plan->price != 0 ? route('choose.payment.type', $plan->id) : 'javascript:void(0)' }}"
                                                                        class="btn btn-primary rounded-3 mx-auto w-100 {{ $plan->price == 0 ? 'freePayment' : '' }}"
                                                                        data-id="{{ $plan->id }}"
                                                                        id="planId{{ $plan->id }}"
                                                                        data-plan-price="{{ $plan->price }}"
                                                                        data-turbo="false">
                                                                        {{ __('messages.subscription.choose_plan') }}</a>
                                                                @else
                                                                    <button type="button"
                                                                        class="btn btn-info rounded-3 mx-auto d-block cursor-remove-plan"
                                                                        data-turbo="false">
                                                                        {{ __('messages.subscription.renew_free_plan') }}
                                                                    </button>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    </div>
                                                @else
                                                    <div class="mx-auto">
                                                        @if ($plan->hasZeroPlan->count() == 0)
                                                            <a href="{{ $plan->price != 0 ? route('choose.payment.type', $plan->id) : 'javascript:void(0)' }}"
                                                                class="btn btn-primary rounded-3 mx-auto w-100 {{ $plan->price == 0 ? 'freePayment' : '' }}"
                                                                data-id="{{ $plan->id }}"
                                                                data-plan-price="{{ $plan->price }}"
                                                                id="planId{{ $plan->id }}" data-turbo="false">
                                                                {{ __('messages.subscription.choose_plan') }}</a>
                                                        @else
                                                            <button type="button"
                                                                class="btn btn-info rounded-3 mx-auto d-block cursor-remove-plan"
                                                                data-turbo="false">
                                                                {{ __('messages.subscription.renew_free_plan') }}
                                                            </button>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="pricing-plan-list ps-xl-4 ps-lg-3 ps-md-4 ps-3 mb-60">
                                @if ($plan->custom_select == 0 && $plan->planCustomFields->isEmpty())
                                    <li class="active-check">
                                        <span class="check-box">
                                            <i class="fa-solid fa-check"
                                                style="font-size: 18px; color: #7638f9; margin-right: 20px"></i>
                                        </span>
                                        <label class="">{{ __('messages.plan.no_of_vcards') }}
                                            : {{ $plan->no_of_vcards }}</label>
                                    </li>
                                @endif
                                <li class="active-check">
                                    <span class="check-box">
                                        <i class="fa-solid fa-check"
                                            style="font-size: 18px; color: #7638f9; margin-right: 20px"></i>
                                    </span>
                                    <label class="">{{ __('messages.plan.storage_limit') }}:
                                        {{ $plan->storage_limit }} {{ __('messages.mb') }}</label>
                                </li>
                                @php
                                    $skipCount =
                                        $plan->custom_select == 0 && $plan->planCustomFields->isEmpty() ? 9 : 10;
                                @endphp
                                @foreach (collect(getPlanFeature($plan))->take($skipCount) as $feature => $value)
                                    <li class="{{ $value == 1 ? 'active-check' : 'unactive-check' }}"
                                        @if (checkFrontLanguageSession() == 'ar') style="text-align: right !important" @endif>
                                        @if (checkFrontLanguageSession() == 'ar')
                                            {{ __('messages.feature.' . $feature) }}
                                            <span class="check-box">
                                                <i class="fa-solid {{ $value == 1 ? 'fa-check' : 'fa-xmark' }}"></i>
                                            </span>
                                        @else
                                            <span class="check-box">
                                                <i class="fa-solid {{ $value == 1 ? 'fa-check' : 'fa-xmark' }}"></i>
                                            </span>
                                            {{ __('messages.feature.' . $feature) }}
                                        @endif
                                    </li>
                                @endforeach
                                <div class="all-features d-none" style="display: none;">

                                    @foreach (collect(getPlanFeature($plan))->skip($skipCount) as $feature => $value)
                                        <li class="{{ $value == 1 ? 'active-check' : 'unactive-check' }}"
                                            @if (checkFrontLanguageSession() == 'ar') style="text-align: right !important" @endif>
                                            @if (checkFrontLanguageSession() == 'ar')
                                                {{ __('messages.feature.' . $feature) }}
                                                <span class="check-box">
                                                    <i class="fa-solid {{ $value == 1 ? 'fa-check' : 'fa-xmark' }}"></i>
                                                </span>
                                            @else
                                                <span class="check-box">
                                                    <i class="fa-solid {{ $value == 1 ? 'fa-check' : 'fa-xmark' }}"></i>
                                                </span>
                                                {{ __('messages.feature.' . $feature) }}
                                            @endif
                                        </li>
                                    @endforeach
                                </div>
                            </ul>
                            <div class="text-center show-plan-features" id="seeMorePlanFeatures">
                                <i class="fa-solid fa-circle-chevron-down show-plan-icon-btn"></i>
                            </div>
                            <div class="text-center d-none less-plan-features" id="lessMorePlanFeatures">
                                <i class="fa-solid fa-circle-chevron-up less-plan-icon-btn"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- end pricing section -->

    <!-- start testimonial section -->
    @if (!$testimonials->isEmpty())
        <section class="testimonial-section @if (checkFrontLanguageSession() == 'ar') rtl @endif">
            <div class="section-heading text-center mb-60">
                <h2 class="d-inline-block">{{ __('auth.stories_from_our_customers') }}</h2>
            </div>
            <div class="testimonial bg-light pt-50 pb-50">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="testimonial-slider">
                                @foreach ($testimonials as $testimonial)
                                    <div class="">
                                        <div class="testimonial-card mb-60">
                                            <div class="quote-img">
                                                <img src="{{ asset('assets/img/new_home_page/quote-img.png') }}"
                                                    alt="quotation" class="w-sm-100 w-50 h-auto">
                                            </div>
                                            <div class="profile-img">
                                                <img src="{{ $testimonial->testimonial_url }}" alt="profile-img"
                                                    class="w-100 h-100 object-fit-cover">
                                            </div>
                                            <div class="profile-desc ps-3">
                                                <p class="fs-20 mb-0 fw-6">{{ $testimonial->name }}</p>
                                            </div>
                                            <p class="mt-4 mb-0 profile-text text-gray-100">{!! $testimonial->description !!}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    @endif
    <!-- end testimonial section -->

    <!-- start contact section -->
    <section class="contact-section pt-100 pb-100" id="frontContactUsTab"
        @if (checkFrontLanguageSession() == 'ar') dir="rtl" @endif>
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="contact-info">
                        <div class="section-heading ms-0 mb-60">
                            <h2 class="d-inline-block">{{ __('messages.vcard_11.get_in_touch') }}</h2>
                        </div>
                        <div class="d-flex align-items-center contact-info__block">
                            <div class="contact-icon fs-2 d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-location-dot icon-purpul"></i>
                            </div>
                            <p class="address-text text-secondary mb-0">
                                {{ $setting['address'] }}
                            </p>
                        </div>
                        <div class="d-flex align-items-center contact-info__block">
                            <div class="contact-icon fs-2 d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-at icon-purpul"></i>
                            </div>
                            <a href="mailto:{{ $setting['email'] }}"
                                class="text-decoration-none text-secondary">{{ $setting['email'] }}</a>
                        </div>
                        <div class="d-flex align-items-center contact-info__block">
                            <div class="contact-icon fs-2 d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-phone icon-purpul"></i>
                            </div>
                            <a href=" tel:{{ $setting['phone'] }}"
                                class="text-decoration-none text-secondary">{{ '+' . $setting['prefix_code'] . ' ' . $setting['phone'] }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <form class="contact-form" id="myForm">
                        @csrf
                        <div id="contactError" class="alert alert-danger d-none"></div>

                        <p class="text-center mb-40 fs-4 fw-6">{{ __('messages.contact_us.send_message') }}</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input name="name" id="name" type="text" class="form-control front-input"
                                        placeholder="{{ __('messages.front.enter_your_name') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input name="email" id="email" type="email" class="form-control front-input"
                                        placeholder="{{ __('messages.front.enter_your_email') }}" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <input name="subject" id="subject" type="text" class="form-control front-input"
                                        placeholder="{{ __('messages.common.subject') }}" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <textarea name="message" id="message" rows="4" class="form-control h-100 form-textarea front-input"
                                        placeholder="{{ __('messages.front.enter_your_message') }}" required></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                <input type="submit" id="submit" name="send"
                                    class="contact-section-submit-btn btn btn-primary w-auto front-input "
                                    value="{{ __('messages.contact_us.send_message') }}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- end contact section -->
@endsection
