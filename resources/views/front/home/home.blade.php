@extends('front.layouts.app')
@section('title')
    {{ getAppName() }}
@endsection
@section('content')
    <section class="hero-section" id="frontHomeTab" @if (checkFrontLanguageSession() == 'ar') dir="rtl" @endif>
        <div class="container"> @include('flash::message') </div>
        <div class="bg-img"></div>
        <div class="container">
            <div class="row align-items-center ">
                <div class="col-lg-6">
                    <div class="hero-content ">
                        <h1 class="text-dark mb-1">{{ $setting['home_page_title'] }}</h1>
                        <p class="text-gray-100 fs-20 fw-6 mb-lg-5 mb-4">
                            {{ $setting['sub_text'] ?? '' }}
                        </p>
                        <a class="btn btn-orange " href="{{ route('register') }}" data-turbo="false">
                            {{ __('auth.get_started') }}
                        </a>

                    </div>
                </div>
                <div class="col-lg-6 text-center mt-5 mt-lg-0">
                    <img src=" {{ isset($setting['home_page_banner']) ? $setting['home_page_banner'] : asset('assets/img/new_front/hero-img.png') }}"
                        alt="Vcard" class="img-fluid" />
                </div>
            </div>
        </div>
    </section>
    <!-- end hero section -->

    <!-- start features section -->
    <section class="features-section bg-light pb-60 pt-80" id="frontFeaturesTab"
        @if (checkFrontLanguageSession() == 'ar') dir="rtl" @endif>
        <div class="container">
            <h2 class="text-dark text-center mb-60">
                {{ __('messages.plan.features') }}
            </h2>
            <div class="row">
                @foreach ($features as $feature)
                    <div class="col-md-6 mb-40">
                        <div class="feature-card card h-100 flex-row me-md-2">
                            <div class="feature-icon d-flex justify-content-center align-items-center me-lg-3">
                                <!-- <i class="fa-solid fa-share-nodes fs-1 text-white"></i> -->
                                <img src="{{ $feature->profile_image }}" alt=""
                                    class="feature-image feature-image-card image-object-fit-cover">

                                {{--                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 42 44" fill="none"> --}}
                                {{--                                <path d="M13.4288 25.3893L12.6251 24.9254L11.9484 25.5605C10.7946 26.6435 9.28166 27.2457 7.71153 27.2506C6.61985 27.2526 5.54575 26.9676 4.59459 26.4229C3.64319 25.878 2.84694 25.0916 2.28525 24.1397C1.72352 23.1876 1.4161 22.1034 1.39415 20.9935C1.37219 19.8836 1.63649 18.7877 2.16024 17.8135C2.68395 16.8395 3.44865 16.0213 4.37796 15.4384L3.71371 14.3795L4.37796 15.4384C5.30718 14.8555 6.36948 14.5274 7.46055 14.4854C8.55161 14.4433 9.63531 14.6887 10.6054 15.1981C11.5755 15.7076 12.3993 16.4642 12.9948 17.3947L13.6383 18.4004L14.6725 17.8036L26.9461 10.7206L27.7734 10.2431L27.5301 9.31943C27.3972 8.81523 27.3264 8.29272 27.3186 7.7667C27.3157 6.30608 27.8094 4.89025 28.7149 3.75596C29.6215 2.62021 30.8851 1.83631 32.2924 1.53263C33.6995 1.22898 35.1675 1.4232 36.4509 2.08384C37.7346 2.74462 38.757 3.83279 39.344 5.16837C39.931 6.50417 40.0457 8.00421 39.6681 9.41601C39.2906 10.8277 38.4447 12.0625 37.2754 12.9151C36.1064 13.7675 34.6846 14.1867 33.2484 14.1047C31.8121 14.0226 30.4455 13.444 29.3784 12.4631L28.7025 11.8419L27.9074 12.3009L14.6275 19.9686L14.019 20.3199L14.0029 21.0224C13.9921 21.4927 13.9274 21.9611 13.81 22.4104L13.569 23.3325L14.3944 23.809L27.9119 31.6119L28.7118 32.0737L29.3881 31.4447C30.5117 30.3996 31.9682 29.8002 33.4902 29.753C35.0123 29.7057 36.502 30.2137 37.6866 31.1867C38.8714 32.1599 39.6721 33.5339 39.9386 35.0587C40.2051 36.5835 39.9188 38.1536 39.1337 39.4809C38.3488 40.8079 37.1189 41.8019 35.6718 42.2844C34.2249 42.7668 32.6547 42.7068 31.2477 42.1149C29.8403 41.5229 28.688 40.4372 28.0045 39.0534C27.3208 37.6693 27.1531 36.0816 27.533 34.5818L27.7653 33.6651L26.9462 33.1923L13.4288 25.3893Z" stroke="white" stroke-width="2.5" /> --}}
                                {{--                            </svg> --}}
                            </div>
                            <div class="card-body p-0 ps-4">
                                <h3 class="text-dark fs-20 fw-6">{{ $feature->name }}</h3>
                                <p class="text-gray-300 fs-18 mb-0">
                                    {!! $feature->description !!}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- end features section -->

    <!-- start about section -->
    <section class="about-section overflow-hidden padding-t-100px py-5" id="frontAboutTabUsTab"
        @if (checkFrontLanguageSession() == 'ar') dir="rtl" @endif>
        <div class="container">
            <h2 class="heading text-success text-center margin-b-100px pb-5">
                {{ __('auth.modern_&_powerful_interface') }}
            </h2>
            <div class="row pt-3 pt-lg-0">
                <div class="col-12 margin-b-80px">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-5 position-relative">
                            <img src="{{ isset($aboutUS[0]['about_url']) ? $aboutUS[0]['about_url'] : asset('front/images/about-1.png') }}"
                                alt="About" class="img-fluid d-block mx-auto image-object-fit-cover" />
                        </div>
                        <div class="col-xl-6 col-lg-7">
                            <div class="about-section__about-right-content about-content mt-4 mt-lg-0">
                                <div class="d-flex align-items-center flex-wrap">
                                    <div>
                                        <h3 class="w-100 mb-3"> {{ $aboutUS[0]['title'] }}</h3>
                                        <p class="text-gray-100 fs-18 mb-0"> {!! nl2br(e($aboutUS[0]['description'])) !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 margin-b-80px">
                    <div class="row align-items-center flex-column-reverse flex-lg-row">
                        <div class="col-xl-6 col-lg-7">
                            <div class="about-section__about-left-content about-content mt-4 mt-lg-0">
                                <div class="d-flex align-items-center justify-content-lg-end flex-wrap">
                                    <div>
                                        <h3 class="w-100 mb-3">{{ $aboutUS[1]['title'] }}</h3>
                                        <p class="text-gray-100 fs-18 mb-0">{!! nl2br(e($aboutUS[1]['description'])) !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-5 position-relative">
                            <img src="{{ isset($aboutUS[1]['about_url']) ? $aboutUS[1]['about_url'] : asset('front/images/about-2.png') }}"
                                alt="About" class="img-fluid d-block mx-auto image-object-fit-cover" />
                        </div>
                    </div>
                </div>
                <div class="col-12 margin-b-80px">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-5 position-relative">
                            <img src="{{ isset($aboutUS[2]['about_url']) ? $aboutUS[2]['about_url'] : asset('front/images/about-3.png') }}"
                                alt="About" class="img-fluid d-block mx-auto image-object-fit-cover" />
                        </div>
                        <div class="col-xl-6 col-lg-7">
                            <div class="about-section__about-right-content about-content mt-4 mt-lg-0">
                                <div class="d-flex align-items-center flex-wrap">
                                    <div>
                                        <h3 class="w-100 mb-3">{{ $aboutUS[2]['title'] }}</h3>
                                        <p class="text-gray-100 fs-18 mb-0">{!! nl2br(e($aboutUS[2]['description'])) !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end about section -->

    <!-- start pricing section -->
    <section class="pricing-plan-section pb-100" id="frontPricingTab">
        <div class="container">
            <h2 class="text-dark text-center mb-60">
                {{ __("auth.choose_a_plan_that's_right_for_you") }}
            </h2>
            <div class="pricing-carousel">
                @foreach ($plans as $plan)
                    <div class="pricing-plan-card card">
                        <div class="card-body text-center">
                            <h3 class="mb-1 mt-3 fw-6">{!! $plan->name !!}</h3>
                            @if ($plan->custom_select == 1 && $plan->planCustomFields->isNotEmpty())
                                <label class="fs-18 mt-2 mb-3">{{ __('messages.plan.custom_no_of_vcards') }}</label>
                                <select id="vcardNumber-{{ $plan->id }}" class="form-select customSelect"
                                    data-plan-id="{{ $plan->id }}">
                                    @foreach ($plan->planCustomFields as $customField)
                                        @php
                                            $formattedPrice = $customField->custom_vcard_price;
                                        @endphp
                                        <option value="{{ $customField->id }}" data-price="{{ $formattedPrice }}"
                                            data-currency="{{ $plan->currency->currency_code }}">
                                            {{ $customField->custom_vcard_number }} </option>
                                    @endforeach
                                </select>
                            @else
                                <label class="fs-18 mt-2 mb-4">{{ __('messages.plan.no_of_vcards') }}
                                    : {{ $plan->no_of_vcards }}
                                </label>
                            @endif
                            <br>
                            <label class="fs-18">{{ __('messages.plan.storage_limit') }}
                                : {{ $plan->storage_limit }}</label>
                            <div class="d-flex justify-content-center my-3 mb-5">
                                @if ($plan->custom_select == 1 && $plan->planCustomFields->isNotEmpty())
                                    <h4 class="text-center mb-6 mt-2 pricing">

                                        <span class="fs-1 fw-6">{{ $plan->currency->currency_icon }}</span>
                                        <span
                                            class="fs-1 fw-6 custom-price-{{ $plan->id }}">{{ $plan->planCustomFields[0]->custom_vcard_price }}</span>
                                        @if ($plan->frequency == 1)
                                            <span class="fs-18">/ {{ __('messages.plan.monthly') }}</span>
                                        @elseif($plan->frequency == 2)
                                            <span class="fs-18">/ {{ __('messages.plan.yearly') }}</span>
                                        @endif
                                    </h4>
                                @else
                                    <h4 class="text-center mb-6 mt-2 pricing mt-5 id="price_{{ $plan->id }}"">
                                        <span
                                            class="fs-1 fw-6">{{ $plan->currency->currency_icon }}{{ $plan->price }}</span>
                                        @if ($plan->frequency == 1)
                                            <span class="fs-5 ml-2">/ {{ __('messages.plan.monthly') }}</span>
                                        @elseif($plan->frequency == 2)
                                            <span class="fs-5 ml-2">/ {{ __('messages.plan.yearly') }}</span>
                                        @endif
                                    </h4>
                                @endif
                            </div>
                            <ul class="pricing-plan-features text-dark text-start mx-auto fs-6">
                                @foreach (getPlanFeature($plan) as $feature => $value)
                                    <li class="{{ $value == 1 ? 'active-check' : 'unactive-check' }}"
                                        @if (checkFrontLanguageSession() == 'ar') style="text-align: right !important" @endif>
                                        @if (checkFrontLanguageSession() == 'ar')
                                            {{ __('messages.feature.' . $feature) }}
                                            <span class="check-box"><i class="fa-solid fa-check"></i></span>
                                        @else
                                            <span class="check-box"><i class="fa-solid fa-check"></i></span>
                                            {{ __('messages.feature.' . $feature) }}
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                            @if (getLoggedInUserRoleId() != getSuperAdminRoleId())
                                @if (getLogInUser() && getLoggedInUserRoleId() != getSuperAdminRoleId())
                                    <div class="mx-auto">

                                        @if (
                                            !empty(getCurrentSubscription()) &&
                                                $plan->id == getCurrentSubscription()->plan_id &&
                                                !getCurrentSubscription()->isExpired())
                                            @if ($plan->price != 0)
                                                <button type="button"
                                                    class="btn btn-success rounded-pill mx-auto d-block cursor-remove-plan pricing-plan-button-active"
                                                    data-id="{{ $plan->id }}" data-turbo="false">
                                                    {{ __('messages.subscription.currently_active') }}</button>
                                            @else
                                                <button type="button"
                                                    class="btn btn-info rounded-pill mx-auto d-block cursor-remove-plan"
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
                                                        class="btn btn-primary rounded-pill mx-auto {{ $plan->price == 0 ? 'freePayment' : '' }}"
                                                        data-id="{{ $plan->id }}" id="planId{{ $plan->id }}"
                                                        data-plan-price="{{ $plan->price }}" data-turbo="false">
                                                        {{ __('messages.subscription.switch_plan') }}</a>
                                                @else
                                                    <button type="button"
                                                        class="btn btn-info rounded-pill mx-auto d-block cursor-remove-plan"
                                                        data-turbo="false">
                                                        {{ __('messages.subscription.renew_free_plan') }}
                                                    </button>
                                                @endif
                                            @else
                                                @if ($plan->hasZeroPlan->count() == 0)
                                                    <a href="{{ $plan->price != 0 ? route('choose.payment.type', $plan->id) : 'javascript:void(0)' }}"
                                                        class="btn btn-primary rounded-pill mx-auto  {{ $plan->price == 0 ? 'freePayment' : '' }}"
                                                        data-id="{{ $plan->id }}" id="planId{{ $plan->id }}"
                                                        data-plan-price="{{ $plan->price }}" data-turbo="false">
                                                        {{ __('messages.subscription.choose_plan') }}</a>
                                                @else
                                                    <button type="button"
                                                        class="btn btn-info rounded-pill mx-auto d-block cursor-remove-plan"
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
                                                class="btn btn-primary rounded-pill mx-auto  {{ $plan->price == 0 ? 'freePayment' : '' }}"
                                                data-id="{{ $plan->id }}" data-plan-price="{{ $plan->price }}"
                                                id="planId{{ $plan->id }}" data-turbo="false">
                                                {{ __('messages.subscription.choose_plan') }}</a>
                                        @else
                                            <button type="button"
                                                class="btn btn-info rounded-pill mx-auto d-block cursor-remove-plan"
                                                data-turbo="false">
                                                {{ __('messages.subscription.renew_free_plan') }}
                                            </button>
                                        @endif
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- end pricing section -->

    <!-- start testimonial section -->
    @if (checkFrontLanguageSession() != 'ar')
    @if (!$testimonials->isEmpty())
        <section class="testimonial-section pt-80 pb-80 bg-darkblue">
            <div class="container  col-lg-6">
                <h2 class="text-white text-center mb-60">
                    {{ __('auth.stories_from_our_customers') }}
                </h2>
                <div class="testimonial-section__testimonial-block mx-auto">
                    <div class="testimonial-carousel">
                        @foreach ($testimonials as $testimonial)
                            <div
                                class="testimonial-card testimonial-1 bg-white position-relative {{ $loop->iteration == 1 ? 'active' : '' }}">
                                <p class="text-gray-300 fs-18 mb-4 pb-2">
                                    {!! $testimonial->description !!}
                                </p>
                                <div class="d-flex profile-box align-items-center">
                                    <img src="{{ $testimonial->testimonial_url }}" alt="profile"
                                        class="profile-img rounded-circle img-fluid">
                                    <span class="ms-3">
                                        <h3 class="text-dark profile-name mb-md-2 mb-1 fs-20 fw-6">
                                            {{ $testimonial->name }}</h3>
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </section>
    @endif
    @else
    @if (!$testimonials->isEmpty())
    <section class="testimonial-section pt-80 pb-80 bg-darkblue" dir="rtl">
        <div class="container  col-lg-6">
            <h2 class="text-white text-center mb-60">
                {{ __('auth.stories_from_our_customers') }}
            </h2>
            <div class="testimonial-section__testimonial-block mx-auto">
                <div class="testimonial-carousel">
                    @foreach ($testimonials as $testimonial)
                        <div
                            class="testimonial-card testimonial-1 bg-white position-relative {{ $loop->iteration == 1 ? 'active' : '' }}">
                            <p class="text-gray-300 fs-18 mb-4 pb-2">
                                {!! $testimonial->description !!}
                            </p>
                            <div class="d-flex profile-box align-items-center gap-2">
                                <img src="{{ $testimonial->testimonial_url }}" alt="profile"
                                    class="profile-img rounded-circle img-fluid">
                                <span class="ms-3">
                                    <h3 class="text-dark profile-name mb-md-2 mb-1 fs-20 fw-6">
                                        {{ $testimonial->name }}</h3>
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </section>
@endif
@endif
    <!-- end testimonial section -->

    <!-- start contact section -->

    <!-- start contact section -->
    <section class="contact-section padding-t-100px padding-b-100px pb-80 pt-80 bg-light" id="frontContactUsTab"
        @if (checkFrontLanguageSession() == 'ar') dir="rtl" @endif>
        <h2 class="heading text-success text-center margin-b-80px mb-5">
            {{ __('messages.contact_us.contact') }}
        </h2>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-info">
                        <div class="d-flex align-items-center contact-info__block">
                            <div
                                class="contact-info__contact-icon text-white fs-2 d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-envelope icon-purpul"></i>
                            </div>
                            <a href="mailto:{{ $setting['email'] }}"
                                class="text-decoration-none text-secondary contact-info__contact-label">{{ $setting['email'] }}</a>
                        </div>
                        <div class="d-flex align-items-center contact-info__block">
                            <div
                                class="contact-info__contact-icon text-white fs-2 d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-phone icon-purpul"></i>
                            </div>
                            <a href=" tel:{{ $setting['phone'] }}"
                                class="text-decoration-none text-secondary contact-info__contact-label">{{ '+' . $setting['prefix_code'] . ' ' . $setting['phone'] }}</a>
                        </div>
                        <div class="d-flex align-items-center contact-info__block">
                            <div
                                class="contact-info__contact-icon text-white fs-2 d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-location-dot icon-purpul"></i>
                            </div>
                            <p class="text-secondary contact-info__contact-label mb-0">
                                {{ $setting['address'] }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form class="contact-form" id="myForm">
                        @csrf
                        <div id="contactError" class="alert alert-danger d-none"></div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="contact-form__input-block">
                                    <input name="name" id="name" type="text" class="form-control"
                                        placeholder="{{ __('messages.front.enter_your_name') }}*" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="contact-form__input-block">
                                    <input name="email" id="email" type="email" class="form-control"
                                        placeholder="{{ __('messages.front.enter_your_email') }}*" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="contact-form__input-block">
                                    <input name="subject" id="subject" type="text" class="form-control"
                                        placeholder="{{ __('messages.common.subject') }}*" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="contact-form__input-block">
                                    <textarea name="message" id="message" rows="4" class="form-control form-textarea"
                                        placeholder="{{ __('messages.front.enter_your_message') }}*" required></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 text-end">
                                <input type="submit" id="submit" name="send" class="btn btn-pink"
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
