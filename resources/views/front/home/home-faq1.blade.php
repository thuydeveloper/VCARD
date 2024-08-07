<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> {{ __('messages.faqs.faqs') }} | {{ getAppName() }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="{{ getFaviconUrl() }}" type="image/png">
    {{-- bootstrap --}}
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">
    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/slider/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slider/css/slick-theme.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/new_home/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/new_home/slick-theme.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/new_home/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/new_home/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/faqs/faqs.css') }}">
    <style>
        .accordion-button::after {
            background-image: url('img/Vector.png') !important;
        }
        .accordion-button:not(.collapsed)::after{
            background-image: url('img/Vector2.png') !important;
            height: 5px !important;
        }
        @if (checkFrontLanguageSession() == 'ar')
            .accordion-button::after {
                margin-right: auto !important;
                margin-left: 0 !important;
            }
        @endif
    </style>
    @routes
    <script data-turbo-eval="false">
        window.getLoggedInUserLang = "{{ getCurrentLanguageName() }}"
        let lang = "{{ Illuminate\Support\Facades\Auth::user()->language ?? 'en' }}"
    </script>
    <script src="{{ asset('messages.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/third-party.css') }}">
</head>

<body>
    <div class="vcard-object object-img-1">
        <img src="{{ asset('/assets/img/new_home_page/object-1.png') }}" alt="image">
    </div>
    <div class="vcard-object object-img-2">
        <img src="{{ asset('/assets/img/new_home_page/object-2.png') }}" alt="image">
    </div>
    <div class="vcard-object object-img-3">
        <img src="{{ asset('/assets/img/new_home_page/object-3.png') }}" alt="image">
    </div>
    <div class="vcard-object object-img-4">
        <img src="{{ asset('/assets/img/new_home_page/object-4.png') }}" alt="image">
    </div>
    <div class="vcard-object object-img-5">
        <img src="{{ asset('/assets/img/new_home_page/object-5.png') }}" alt="image">
    </div>
    <div class="vcard-object object-img-6">
        <img src="{{ asset('/assets/img/new_home_page/object-6.png') }}" alt="image">
    </div>
    <div class="vcard-object object-img-7">
        <img src="{{ asset('/assets/img/new_home_page/object-7.png') }}" alt="image">
    </div>
    <div class="vcard-object subscribeBtn">
        <img src="{{ asset('/assets/img/new_home_page/object-8.png') }}" alt="image">
    </div>
    <!-- start header section -->
    @if (checkFrontLanguageSession() != 'ar')
        <header class="header">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-2 col-sm-8 col-5 order-lg-1 order-0">
                    <a class="navbar-brand p-0" href="{{ url('/') }}">
                        <img src="{{ getLogoUrl() }}" alt="company-logo" class="w-auto h-100" />
                    </a>
                </div>
                <div class="col-lg-10 col-sm-1 col-2 order-lg-1 order-2">
                    <nav class="navbar navbar-expand-lg navbar-light justify-content-end">
                        <div class="navbar-toggler mt-2" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation" id="toogler-icon">
                            <span class="navbar-toggler-icon top-bar"></span>
                            <span class="navbar-toggler-icon middle-bar"></span>
                            <span class="navbar-toggler-icon bottom-bar"></span>
                        </div>
                        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                            <ul class="navbar-nav align-items-lg-center">
                                <li class="nav-item">
                                    <a class="nav-link active nav-link-white" aria-current="page"
                                        href="{{ asset('') . '#frontHomeTab' }}"  data-turbo="false">{{ __('auth.home') }}</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link nav-link-white"
                                        href="{{ asset('') . '#frontFeaturesTab' }}">{{ __('auth.features') }}</a>
                                </li> --}}
                                <li class="nav-item">
                                    <a class="nav-link nav-link-white"
                                        href="{{ asset('') . '#frontAboutTabUsTab' }}"  data-turbo="false">{{ __('auth.about') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link nav-link-white"
                                        href="{{ asset('') . '#frontPricingTab' }}"  data-turbo="false">{{ __('auth.pricing') }}</a>
                                </li>
                                <li class="nav-item @if($faqs === null) d-none @endif">
                                    <a class="nav-link nav-link-white"
                                        href="{{ route('fornt-faq') }}">{{ __('messages.faqs.faqs') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link nav-link-white"
                                        href="{{ asset('') . '#frontContactUsTab' }}"  data-turbo="false">{{ __('auth.contact') }} </a>
                                </li>
                                <li class="nav-item">
                                    <div class="dropdown">
                                        <a class="btn dropdown-toggle nav-link-white" href="#" role="button"
                                            id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"  data-turbo="false">
                                            {{ __('messages.language') }}</a>
                                        <ul class="dropdown-menu p-2" aria-labelledby="dropdownMenuLink">
                                            @foreach (getAllLanguageWithFullData() as $key => $language)
                                                <li class="languageSelection {{ checkFrontLanguageSession() == $key ? 'active' : '' }}"
                                                    data-prefix-value="{{ $language->iso_code }}">
                                                    <a href="javascript:void(0)"
                                                        class="nav-link d-flex align-items-center dropdown-item {{ checkFrontLanguageSession() == $key ? 'active' : '' }}">
                                                        @if (array_key_exists($language->iso_code, \App\Models\User::FLAG))
                                                            @foreach (\App\Models\User::FLAG as $imageKey => $imageValue)
                                                                @if ($imageKey == $language->iso_code)
                                                                    <img src="{{ asset($imageValue) }}"
                                                                        class="me-1" />
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            @if (count($language->media) != 0)
                                                                <img src="{{ $language->image_url }}"
                                                                    class="me-1" />
                                                            @else
                                                                <i class="fa fa-flag fa-xl me-3 text-danger"
                                                                    aria-hidden="true"></i>
                                                            @endif
                                                        @endif
                                                        {{ $language->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>

                                @if (empty(getLogInUser()))
                                    <a class="btn btn-white text-decoration-none fs-18 sign-in-btn d-lg-block d-none d-lg-block d-none"
                                        href="{{ route('login') }}" data-turbo="false">
                                        {{ __('auth.sign_in') }}
                                    </a>
                                @else
                                    @if (getLogInUser()->hasrole('admin') || getLogInUser()->hasrole('user'))
                                        <a class="btn btn-white text-decoration-none fs-18 sign-in-btn d-lg-block d-none"
                                            href="{{ route('admin.dashboard') }}" data-turbo="false">
                                            {{ __('messages.dashboard') }}
                                        </a>
                                    @endif
                                    @if (getLogInUser()->hasrole('super_admin'))
                                        <a class="btn btn-white text-decoration-none fs-18 d-lg-block d-none"
                                            href="{{ route('sadmin.dashboard') }}" data-turbo="false">
                                            {{ __('messages.dashboard') }}
                                        </a>
                                    @endif
                                @endif

                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="col-lg-2 col-sm-3 col-5 text-end order-lg-2 order-1 pe-lg-2 pe-0 d-lg-none">

                    @if (empty(getLogInUser()))
                        <a class="btn btn-white fs-18 me-sm-2" href="{{ route('login') }}" data-turbo="false">
                            {{ __('auth.sign_in') }}
                        </a>
                    @else
                        @if (getLogInUser()->hasrole('admin') || getLogInUser()->hasrole('user'))
                            <a class="btn btn-white fs-18 me-sm-2" href="{{ route('admin.dashboard') }}"
                                data-turbo="false">
                                {{ __('messages.dashboard') }}
                            </a>
                        @endif
                        @if (getLogInUser()->hasrole('super_admin'))
                            <a class="btn btn-white fs-18 me-sm-2" href="{{ route('sadmin.dashboard') }}"
                                data-turbo="false">
                                {{ __('messages.dashboard') }}
                            </a>
                        @endif
                    @endif

                </div>
            </div>
        </div>
        </header>
        @else
        <header class="header" dir="rtl">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-2 col-sm-8 col-5 order-lg-1 order-0">
                    <a class="navbar-brand p-0" href="{{ url('/') }}">
                        <img src="{{ getLogoUrl() }}" alt="company-logo" class="w-auto h-100" />
                    </a>
                </div>
                <div class="col-lg-10 col-sm-1 col-2 order-lg-1 order-2">
                    <nav class="navbar navbar-expand-lg navbar-light justify-content-end">
                        <div class="navbar-toggler mt-2" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation" id="toogler-icon">
                            <span class="navbar-toggler-icon top-bar"></span>
                            <span class="navbar-toggler-icon middle-bar"></span>
                            <span class="navbar-toggler-icon bottom-bar"></span>
                        </div>
                        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                            <ul class="navbar-nav align-items-lg-center">
                                <li class="nav-item">
                                    <a class="nav-link active nav-link-white" aria-current="page"
                                        href="{{ asset('') . '#frontHomeTab' }}"  data-turbo="false">{{ __('auth.home') }}</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link nav-link-white"
                                        href="{{ asset('') . '#frontFeaturesTab' }}">{{ __('auth.features') }}</a>
                                </li> --}}
                                <li class="nav-item">
                                    <a class="nav-link nav-link-white"
                                        href="{{ asset('') . '#frontAboutTabUsTab' }}"  data-turbo="false">{{ __('auth.about') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link nav-link-white"
                                        href="{{ asset('') . '#frontPricingTab' }}"  data-turbo="false">{{ __('auth.pricing') }}</a>
                                </li>
                                <li class="nav-item @if($faqs === null) d-none @endif">
                                    <a class="nav-link nav-link-white"
                                        href="{{ route('fornt-faq') }}" data-turbo="false">{{ __('messages.faqs.faqs') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link nav-link-white"
                                        href="{{ asset('') . '#frontContactUsTab' }}"  data-turbo="false">{{ __('auth.contact') }} </a>
                                </li>
                                <li class="nav-item">
                                    <div class="dropdown">
                                        <a class="btn dropdown-toggle nav-link-white" href="#" role="button"
                                            id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"  data-turbo="false">
                                            {{ __('messages.language') }}</a>
                                        <ul class="dropdown-menu p-2" aria-labelledby="dropdownMenuLink">
                                            @foreach (getAllLanguageWithFullData() as $key => $language)
                                                <li class="languageSelection {{ checkFrontLanguageSession() == $key ? 'active' : '' }}"
                                                    data-prefix-value="{{ $language->iso_code }}">
                                                    <a href="javascript:void(0)"
                                                        class="nav-link d-flex align-items-center dropdown-item {{ checkFrontLanguageSession() == $key ? 'active' : '' }}">
                                                        @if (array_key_exists($language->iso_code, \App\Models\User::FLAG))
                                                            @foreach (\App\Models\User::FLAG as $imageKey => $imageValue)
                                                                @if ($imageKey == $language->iso_code)
                                                                    <img src="{{ asset($imageValue) }}"
                                                                        class="me-1" />
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            @if (count($language->media) != 0)
                                                                <img src="{{ $language->image_url }}"
                                                                    class="me-1" />
                                                            @else
                                                                <i class="fa fa-flag fa-xl me-3 text-danger"
                                                                    aria-hidden="true"></i>
                                                            @endif
                                                        @endif
                                                        {{ $language->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>

                                @if (empty(getLogInUser()))
                                    <a class="btn btn-white text-decoration-none fs-18 sign-in-btn d-lg-block d-none d-lg-block d-none"
                                        href="{{ route('login') }}" data-turbo="false">
                                        {{ __('auth.sign_in') }}
                                    </a>
                                @else
                                    @if (getLogInUser()->hasrole('admin') || getLogInUser()->hasrole('user'))
                                        <a class="btn btn-white text-decoration-none fs-18 sign-in-btn d-lg-block d-none"
                                            href="{{ route('admin.dashboard') }}" data-turbo="false">
                                            {{ __('messages.dashboard') }}
                                        </a>
                                    @endif
                                    @if (getLogInUser()->hasrole('super_admin'))
                                        <a class="btn btn-white text-decoration-none fs-18 d-lg-block d-none"
                                            href="{{ route('sadmin.dashboard') }}" data-turbo="false">
                                            {{ __('messages.dashboard') }}
                                        </a>
                                    @endif
                                @endif

                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="col-lg-2 col-sm-3 col-5 text-end order-lg-2 order-1 pe-lg-2 pe-0 d-lg-none">

                    @if (empty(getLogInUser()))
                        <a class="btn btn-white fs-18 me-sm-2" href="{{ route('login') }}" data-turbo="false">
                            {{ __('auth.sign_in') }}
                        </a>
                    @else
                        @if (getLogInUser()->hasrole('admin') || getLogInUser()->hasrole('user'))
                            <a class="btn btn-white fs-18 me-sm-2" href="{{ route('admin.dashboard') }}"
                                data-turbo="false">
                                {{ __('messages.dashboard') }}
                            </a>
                        @endif
                        @if (getLogInUser()->hasrole('super_admin'))
                            <a class="btn btn-white fs-18 me-sm-2" href="{{ route('sadmin.dashboard') }}"
                                data-turbo="false">
                                {{ __('messages.dashboard') }}
                            </a>
                        @endif
                    @endif

                </div>
            </div>
        </div>
        </header>
        @endif
    <!-- end header section -->

    <!-- start hero section -->
    <section class="hero-section bg-primary pt-100 pb-60">
        <div class="container pt-60 mt-3">
            <div class="row">
                <div class="col-12 text-center">
                    {{-- <h2 class="fs-40 text-white"> {{ __('messages.vcards_templates') }} </h2> --}}
                    <h2 class="fs-40 text-white"> {{ __('messages.faqs.faqs') }} </h2>
                </div>
            </div>
        </div>
    </section>

    <!-- end hero section -->
    <!--start Faqs-section -->
    @if (checkFrontLanguageSession() != 'ar')
        <div class="container my-5 faqs-section">
        <div class="accordion" id="accordionExample">
            @foreach ($faq as $faqs)
                <div class="accordion-item my-3">
                    <h2 class="accordion-header" id="heading{{ $faqs->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faq{{ $faqs->id }}" aria-expanded="false" aria-controls="faq{{ $faqs->id }}">
                            {{ $faqs->title }}
                        </button>
                    </h2>
                    <div id="faq{{ $faqs->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $faqs->id }}"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            {{ $faqs->description }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        </div>
        @else
        <div class="container my-5 faqs-section" dir="rtl">
            <div class="accordion" id="accordionExample">
                @foreach ($faq as $faqs)
                    <div class="accordion-item my-3">
                        <h2 class="accordion-header" id="heading{{ $faqs->id }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq{{ $faqs->id }}" aria-expanded="false" aria-controls="faq{{ $faqs->id }}">
                                {{ $faqs->title }}
                            </button>
                        </h2>
                        <div id="faq{{ $faqs->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $faqs->id }}"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                {{ $faqs->description }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    <!-- end Faqs-section -->

    <!-- start footer section -->
    <div class="curve-shape">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
            y="0px" viewBox="0 0 4000 275">
            <path fill="#f3f3ff" d="M4000,125.3V275H0V109.9C1907.2,615.4,2670.5-323.1,4000,125.3z"></path>
        </svg>
    </div>
    @if (checkFrontLanguageSession() != 'ar')
        <footer class="bg-light">
        <div class="container">
            <div class="row align-items-center flex-lg-row flex-column-reverse pt-50 pb-40">
                <div class="col-lg-6">
                    <div class="text-lg-start text-center pe-xxl-5 me-xxl-5">
                        <h3 class="fs-30 mb-20">{{ __('messages.Subscribe_Our_Newsletter') }}</h3>
                        <p class="text-gray-100 fs-18 mb-40 pb-lg-3 pe-xl-5 me-xl-5">
                            {{ __('messages.Receive_latest_news_update_and_many_other_things_every_week') }}</p>
                    </div>
                    <form action="{{ route('email.sub') }}" method="post" id="addEmail">
                        @csrf
                        <div class="email">
                            <input type="email" name="email" class="form-control"
                                placeholder="{{ __('messages.front.enter_your_email') }}" required>
                            <div class=" subscribe-btn text-sm-end text-center mt-sm-0 mt-4">
                                <button type="submit"
                                    class="btn btn-primary h-100 subscribeBtn">{{ __('messages.subscribe') }}</button>
                            </div>
                        </div>
                    </form>
                    <div class="main-social-links my-3">
                        @if (isset($setting['website_link']) && !empty($setting['website_link']))
                            <a class="globe" href="{{ $setting['website_link'] }}"><i class="fas fa-globe"></i></a>
                        @endif
                        @if (isset($setting['twitter_link']) && !empty($setting['twitter_link']))
                            <a class="twitter" href="{{ $setting['twitter_link'] }}">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="19px" height="19px">
                                    <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/>
                                </svg>
                            </a>
                        @endif
                        @if (isset($setting['facebook_link']) && !empty($setting['facebook_link']))
                            <a class="facebook" href="{{ $setting['facebook_link'] }}"><i class="fab fa-facebook-square"></i></a>
                        @endif
                        @if (isset($setting['instagram_link']) && !empty($setting['instagram_link']))
                            <a class="instagram" href="{{ $setting['instagram_link'] }}"><i class="fab fa-instagram"></i></a>
                        @endif
                        @if (isset($setting['youtube_link']) && !empty($setting['youtube_link']))
                            <a class="youtube" href="{{ $setting['youtube_link'] }}"><i class="fab fa-youtube"></i></a>
                        @endif
                        @if (isset($setting['tumbir_link']) && !empty($setting['tumbir_link']))
                            <a class="tumblr" href="{{ $setting['tumbir_link'] }}"><i class="fab fa-tumblr-square"></i></a>
                        @endif
                        @if (isset($setting['reddit_link']) && !empty($setting['reddit_link']))
                            <a class="reddit" href="{{ $setting['reddit_link'] }}"><i class="fab fa-reddit-alien"></i></a>
                        @endif
                        @if (isset($setting['linkedin_link']) && !empty($setting['linkedin_link']))
                            <a class="linkedin" href="{{ $setting['linkedin_link'] }}"><i class="fab fa-linkedin"></i></a>
                        @endif
                        @if (isset($setting['whatsapp_link']) && !empty($setting['whatsapp_link']))
                            <a class="whatsapp" href="{{ $setting['whatsapp_link'] }}"><i class="fab fa-whatsapp"></i></a>
                        @endif
                        @if (isset($setting['pinterest_link']) && !empty($setting['pinterest_link']))
                            <a class="pinterest" href="{{ $setting['pinterest_link'] }}"><i class="fab fa-pinterest"></i></a>
                        @endif
                        @if (isset($setting['tiktok_link']) && !empty($setting['tiktok_link']))
                            <a class="tiktok" href="{{ $setting['tiktok_link'] }}"><i class="fab fa-tiktok"></i></a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 text-lg-end text-center mb-lg-0 mb-40">
                    <div class="footer-img ">
                        <img src="{{ asset('assets/img/new_home_page/footer-img.png') }}"
                            class="zoom-in-zoom-out img-fluid w-auto h-100" alt="img">
                    </div>

                </div>
            </div>
            <div class="row align-items-center pb-md-4 pb-3">
                <div class="col-md-7 text-md-start text-center mb-md-0 mb-2">
                    <p class="text-black fw-light mb-0">
                        © {{ \Carbon\Carbon::now()->year }} {{ __('auth.copyright_by') . ' ' }}<span
                            class="fw-6">{{ $setting['app_name'] }}</span>
                    </p>
                </div>
                <div class="col-md-5 text-md-end">
                    <div class="d-flex justify-content-md-end justify-content-center">
                        <a href="{{ route('terms.conditions') }}"
                            class="text-black text-decoration-none me-4">{!! __('messages.vcard.term_condition') !!}</a>
                        <a href="{{ route('privacy.policy') }}"
                            class="text-black text-decoration-none">{{ __('messages.vcard.privacy_policy') }}</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </footer>
    @else
        <footer class="bg-light" dir="rtl">
            <div class="container">
                <div class="row align-items-center flex-lg-row flex-column-reverse pt-50 pb-40">
            <div class="col-lg-6">
                <div class="text-lg-end text-center pe-xxl-5 me-xxl-5">
                    <h3 class="fs-30 mb-20">{{ __('messages.Subscribe_Our_Newsletter') }}</h3>
                    <p class="text-gray-100 fs-18 mb-40 pb-lg-3 text-end">
                        {{ __('messages.Receive_latest_news_update_and_many_other_things_every_week') }}</p>
                </div>
                <form action="{{ route('email.sub') }}" method="post" id="addEmail">
                    @csrf
                    <div class="email">
                        <input type="email" name="email" class="form-control"
                            placeholder="{{ __('messages.front.enter_your_email') }}" required>
                        <div class=" subscribe-btn text-sm-end text-center mt-sm-0 mt-4">
                            <button type="submit"
                                class="btn btn-primary h-100 subscribeBtn">{{ __('messages.subscribe') }}</button>
                        </div>
                    </div>
                </form>
                <div class="main-social-links my-3">
                    @if (isset($setting['website_link']) && !empty($setting['website_link']))
                        <a class="globe" href="{{ $setting['website_link'] }}"><i class="fas fa-globe"></i></a>
                    @endif
                    @if (isset($setting['twitter_link']) && !empty($setting['twitter_link']))
                        <a class="twitter" href="{{ $setting['twitter_link'] }}">
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="19px" height="19px">
                                <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/>
                            </svg>
                        </a>
                    @endif
                    @if (isset($setting['facebook_link']) && !empty($setting['facebook_link']))
                        <a class="facebook" href="{{ $setting['facebook_link'] }}"><i class="fab fa-facebook-square"></i></a>
                    @endif
                    @if (isset($setting['instagram_link']) && !empty($setting['instagram_link']))
                        <a class="instagram" href="{{ $setting['instagram_link'] }}"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if (isset($setting['youtube_link']) && !empty($setting['youtube_link']))
                        <a class="youtube" href="{{ $setting['youtube_link'] }}"><i class="fab fa-youtube"></i></a>
                    @endif
                    @if (isset($setting['tumbir_link']) && !empty($setting['tumbir_link']))
                        <a class="tumblr" href="{{ $setting['tumbir_link'] }}"><i class="fab fa-tumblr-square"></i></a>
                    @endif
                    @if (isset($setting['reddit_link']) && !empty($setting['reddit_link']))
                        <a class="reddit" href="{{ $setting['reddit_link'] }}"><i class="fab fa-reddit-alien"></i></a>
                    @endif
                    @if (isset($setting['linkedin_link']) && !empty($setting['linkedin_link']))
                        <a class="linkedin" href="{{ $setting['linkedin_link'] }}"><i class="fab fa-linkedin"></i></a>
                    @endif
                    @if (isset($setting['whatsapp_link']) && !empty($setting['whatsapp_link']))
                        <a class="whatsapp" href="{{ $setting['whatsapp_link'] }}"><i class="fab fa-whatsapp"></i></a>
                    @endif
                    @if (isset($setting['pinterest_link']) && !empty($setting['pinterest_link']))
                        <a class="pinterest" href="{{ $setting['pinterest_link'] }}"><i class="fab fa-pinterest"></i></a>
                    @endif
                    @if (isset($setting['tiktok_link']) && !empty($setting['tiktok_link']))
                        <a class="tiktok" href="{{ $setting['tiktok_link'] }}"><i class="fab fa-tiktok"></i></a>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 text-lg-start text-center mb-lg-0 mb-40">
                <div class="footer-img ">
                    <img src="{{ asset('assets/img/new_home_page/footer-img.png') }}"
                        class="zoom-in-zoom-out img-fluid w-auto h-100" alt="img">
                </div>

            </div>
        </div>
        <div class="row align-items-center pb-md-4 pb-3">
            <div class="col-md-7 text-md-end text-center mb-md-0 mb-2">
                <p class="text-black fw-light mb-0">
                    © {{ \Carbon\Carbon::now()->year }} {{ __('auth.copyright_by') . ' ' }}<span
                        class="fw-6">{{ $setting['app_name'] }}</span>
                </p>
            </div>
            <div class="col-md-5 text-md-end">
                <div class="d-flex justify-content-md-end justify-content-center">
                    <a href="{{ route('terms.conditions') }}"
                        class="text-black text-decoration-none me-4">{!! __('messages.vcard.term_condition') !!}</a>
                    <a href="{{ route('privacy.policy') }}"
                        class="text-black text-decoration-none">{{ __('messages.vcard.privacy_policy') }}</a>
                </div>
            </div>
        </div>
        </div>
    </div>
</footer>
@endif
    <!-- end footer section -->

    {{-- <script type="text/javascript" src="{{ asset('assets/js/third-party.js') }}"></script> --}}
    <script src="{{ mix('assets/js/front-third-party.js') }}"></script>
    <script src="{{ mix('assets/js/front-pages.js') }}"></script>
    @php
        $langSession = Session::get('languageName');
        $frontLanguage = !isset($langSession) ? getSuperAdminSettingValue('default_language') : $langSession;
    @endphp
    <script>
        let frontLanguage = "{{ $frontLanguage }}"
        Lang.setLocale(frontLanguage)
    </script>
    <script>
        $("#toogler-icon").click(function() {
            $(this).toggleClass("open");
        });
    </script>
</body>

</html>
