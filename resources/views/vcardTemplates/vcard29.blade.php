<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (checkFeature('seo'))
        @if ($vcard->meta_description)
            <meta name="description" content="{{ $vcard->meta_description }}">
        @endif
        @if ($vcard->meta_keyword)
            <meta name="keywords" content="{{ $vcard->meta_keyword }}">
        @endif
    @else
        <meta name="description" content="{{ $vcard->description }}">
        <meta name="keywords" content="">
    @endif
    <meta property="og:image" content="{{ $vcard->cover_url }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @if (checkFeature('seo') && $vcard->site_title && $vcard->home_title)
        <title>{{ $vcard->home_title }} | {{ $vcard->site_title }}</title>
    @else
        <title>{{ $vcard->name }} | {{ getAppName() }}</title>
    @endif
    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="manifest" href="{{ asset('pwa/1.json') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ getFaviconUrl() }}" type="image/png">

    {{-- css link --}}
    <link rel="stylesheet" href="{{ asset('assets/css/vcard29.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slider/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slider/css/slick-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/new_vcard/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/new_vcard/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/new_vcard/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/third-party.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom-vcard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lightbox.css') }}">
    @if ($vcard->font_family || $vcard->font_size || $vcard->custom_css)
        <style>
            @if (checkFeature('custom-fonts'))
                @if ($vcard->font_family)
                    body {
                        font-family: {{ $vcard->font_family }};
                    }
                @endif
                @if ($vcard->font_size)
                    div>h4 {
                        font-size: {{ $vcard->font_size }}px !important;
                    }
                @endif
            @endif
            @if (isset(checkFeature('advanced')->custom_css))
                {!! $vcard->custom_css !!}
            @endif
        </style>
    @endif
</head>

<body>
    <div class="container p-0">
        @if (checkFeature('password'))
            @include('vcards.password')
        @endif
        <div class="main-content mx-auto w-100 overflow-hidden bg-green @if (getLanguage($vcard->default_language) == 'Arabic') rtl @endif">
            {{-- support banner --}}
            @if ((isset($managesection) && $managesection['banner']) || empty($managesection))
                @if (isset($banners->title))
                    <div class="support-banner d-flex align-items-center justify-content-center">
                        <button type="button" class="text-start banner-close"><i
                                class="fa-solid fa-xmark"></i></button>
                        <div class="">
                            <h1 class="text-center support_heading">{{ $banners->title }}</h1>
                            <p class="text-center text-dark support_text">{{ $banners->description }} </p>
                            <div class="text-center mt-3">
                                <a href="{{ $banners->url }}" class="act-now" target="blank"
                                    data-turbo="false">{{ $banners->banner_button }}</a>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            <div class="banner-section position-relative">
                <div class="banner-img">
                    @if (strpos($vcard->cover_url, '.mp4') !== false ||
                            strpos($vcard->cover_url, '.mov') !== false ||
                            strpos($vcard->cover_url, '.avi') !== false)
                        <video class="cover-video w-100 h-100 object-fit-cover" loop autoplay muted playsinline
                            alt="background video" id="cover-video">
                            <source src="{{ $vcard->cover_url }}" type="video/mp4">
                        </video>
                    @else
                        <img src="{{ $vcard->cover_url }}" class="w-100 h-100 object-fit-cover" loading="lazy" />
                    @endif
                </div>
                <div class="d-flex justify-content-end position-absolute top-0 end-0 me-3 language-btn">
                    @if ($vcard->language_enable == \App\Models\Vcard::LANGUAGE_ENABLE)
                        <div class="language pt-4 me-2">
                            <ul class="text-decoration-none">
                                <li class="dropdown1 dropdown lang-list">
                                    <a class="dropdown-toggle lang-head text-decoration-none" data-toggle="dropdown"
                                        role="button" aria-haspopup="true" aria-expanded="false">
                                        <i
                                            class="fa-solid fa-language me-2"></i>{{ getLanguage($vcard->default_language) }}
                                    </a>
                                    <ul class="dropdown-menu start-0 top-dropdown lang-hover-list top-100 mt-0">
                                        @foreach (getAllLanguageWithFullData() as $language)
                                            <li
                                                class="{{ getLanguageIsoCode($vcard->default_language) == $language->iso_code ? 'active' : '' }}">
                                                <a href="javascript:void(0)" id="languageName"
                                                    data-name="{{ $language->iso_code }}">
                                                    @if (array_key_exists($language->iso_code, \App\Models\User::FLAG))
                                                        @foreach (\App\Models\User::FLAG as $imageKey => $imageValue)
                                                            @if ($imageKey == $language->iso_code)
                                                                <img src="{{ asset($imageValue) }}" class="me-1" />
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        @if (count($language->media) != 0)
                                                            <img src="{{ $language->image_url }}" class="me-1" />
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
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="overlay"></div>
            </div>
            {{-- profile section --}}
            <div class="profile-section px-40">
                @if(getLanguage($vcard->default_language) != 'Arabic')
                <div class="card d-flex mb-30">
                    <div class="card-img">
                        <img src="{{ $vcard->profile_url }}" class="w-100 h-100 object-fit-cover" />
                    </div>
                    <div class="card-body pt-sm-3 pt-5 mt-sm-0 mt-40 p-0 text-sm-start text-center">
                        <div class="profile-name">
                            <h2 class="text-white mb-0 fs-30">
                                {{ ucwords($vcard->first_name . ' ' . $vcard->last_name) }}
                                @if ($vcard->is_verified)
                                    <i class="verification-icon bi-patch-check-fill text-blue"></i>
                                @endif
                            </h2>
                            <p class="fs-18 text-primary mb-0">{{ ucwords($vcard->occupation) }}</p>
                            <p class="fs-18 text-primary mb-0">{{ ucwords($vcard->job_title) }}</p>
                            <p class="fs-18 text-primary mb-0">{{ ucwords($vcard->company) }}</p>
                        </div>
                    </div>
                </div>
                @endif
                @if(getLanguage($vcard->default_language) == 'Arabic')
                <div class="card d-flex mb-30" dir="rtl">
                    <div class="card-img">
                        <img src="{{ $vcard->profile_url }}" class="w-100 h-100 object-fit-cover" />
                    </div>
                    <div class="card-body pt-sm-3 pt-5 mt-sm-0 mt-40 p-0 text-sm-start text-center">
                        <div class="profile-name">
                            <h2 class="text-white mb-0 fs-30">
                                {{ ucwords($vcard->first_name . ' ' . $vcard->last_name) }}
                                @if ($vcard->is_verified)
                                    <i class="verification-icon bi-patch-check-fill text-blue"></i>
                                @endif
                            </h2>
                            <p class="fs-18 text-primary mb-0">{{ ucwords($vcard->occupation) }}</p>
                            <p class="fs-18 text-primary mb-0">{{ ucwords($vcard->job_title) }}</p>
                            <p class="fs-18 text-primary mb-0">{{ ucwords($vcard->company) }}</p>
                        </div>
                    </div>
                </div>
                @endif
                <div class="text-gray-100 profile-desc mb-30 fs-14 text-sm-start text-center">
                    {!! $vcard->description !!}
                </div>
            </div>
            {{-- social icons --}}
            <div class="social-media-section px-40">
                <div class="d-flex flex-wrap justify-content-center pt-4">
                    @if (checkFeature('social_links') && getSocialLink($vcard))
                        {{-- <div
                        class="d-flex justify-content-center text-decoration-none flex-wrap text-primary bg-gray-100 rounded-pill"> --}}
                        @foreach (getSocialLink($vcard) as $value)
                            <span class="social-icon d-flex justify-content-center align-items-center">
                                {!! $value !!}
                            </span>
                        @endforeach
                        {{-- </div> --}}
                    @endif
                    {{-- <a href="" class="social-icon d-flex justify-content-center align-items-center">
                        <svg width="26" height="26" viewBox="0 0 26 26" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M14.9704 25.4998C14.9704 22.5882 14.9704 19.6825 14.9704 16.7413C15.9436 16.7413 16.8934 16.7413 17.8667 16.7413C18.0543 15.5188 18.2361 14.3257 18.4237 13.0973C17.2628 13.0973 16.1254 13.0973 15.0114 13.0973C15.0114 12.0992 14.941 11.1365 15.029 10.1857C15.1052 9.35292 15.797 8.83319 16.6706 8.78594C17.1866 8.75641 17.7084 8.76823 18.2243 8.76823C18.3299 8.76823 18.4354 8.76823 18.5527 8.76823C18.5527 7.71696 18.5527 6.70113 18.5527 5.66168C17.2335 5.50222 15.9319 5.28961 14.6127 5.53175C12.6779 5.89202 11.3353 7.28583 11.1359 9.27023C11.0245 10.4042 11.0714 11.5499 11.048 12.6898C11.048 12.8138 11.048 12.9378 11.048 13.0973C9.97505 13.0973 8.93729 13.0973 7.88781 13.0973C7.88781 14.3257 7.88781 15.5188 7.88781 16.7413C8.94315 16.7413 9.97505 16.7413 11.0245 16.7413C11.0245 19.6766 11.0245 22.5823 11.0245 25.4939C6.61553 25.0097 0.969417 20.8873 0.529689 13.9064C0.0723718 6.71885 5.53673 0.877845 12.3203 0.51758C19.6432 0.127786 25.4652 6.00423 25.5062 13.0028C25.5414 19.9423 20.1826 24.8502 14.9704 25.4998Z"
                                fill="white" />
                        </svg>
                    </a> --}}
                </div>
            </div>
            {{-- contact section --}}
            <div class="contact-section pt-60 px-40">
                <div class="contact-bg img-1">
                    <img src="{{ asset('assets/img/vcard29/contact-bg1.png') }}" alt="bg" />
                </div>
                <div class="contact-bg img-2 text-end">
                    <img src="{{ asset('assets/img/vcard29/contact-bg2.png') }}" alt="bg" />
                </div>
                <div class="section-heading">
                    <div class="heading-img">
                        <img src="{{ asset('assets/img/vcard29/contact-heading.png') }}" class="w-100"
                            alt="img" />
                    </div>
                    <h2 class="mb-0">{{ __('messages.contact_us.contact') }}</h2>
                </div>
                @if(getLanguage($vcard->default_language) != 'Arabic')
                <div class="row">
                    @if ($vcard->email)
                        <div class="col-sm-6 mb-40">
                            <div class="contact-box d-flex align-items-center">
                                <div class="contact-icon d-flex justify-content-center align-items-center">
                                    <img src="{{ asset('assets/img/vcard29/email.png') }}" />
                                </div>
                                <div class="contact-desc">
                                    <a href="mailto:{{ $vcard->email }}"
                                        class="text-white fw-5">{{ $vcard->email }}</a>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($vcard->alternative_email)
                        <div class="col-sm-6 mb-40">
                            <div class="contact-box d-flex align-items-center">
                                <div class="contact-icon d-flex justify-content-center align-items-center">
                                    <img src="{{ asset('assets/img/vcard29/email.png') }}" />
                                </div>
                                <div class="contact-desc">
                                    <a href="mailto:{{ $vcard->alternative_email }}"
                                        class="text-white fw-5">{{ $vcard->alternative_email }}</a>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($vcard->phone)
                        <div class="col-sm-6 mb-40">
                            <div class="contact-box d-flex align-items-center">
                                <div class="contact-icon d-flex justify-content-center align-items-center">
                                    <img src="{{ asset('assets/img/vcard29/phone.png') }}" />
                                </div>
                                <div class="contact-desc">
                                    <a href="tel:+{{ $vcard->region_code }}{{ $vcard->phone }}"
                                        class="text-white fw-5">+{{ $vcard->region_code }}{{ $vcard->phone }}</a>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($vcard->alternative_phone)
                        <div class="col-sm-6 mb-40">
                            <div class="contact-box d-flex align-items-center">
                                <div class="contact-icon d-flex justify-content-center align-items-center">
                                    <img src="{{ asset('assets/img/vcard29/phone.png') }}" />
                                </div>
                                <div class="contact-desc">
                                    <a href="tel:+{{ $vcard->alternative_region_code }}{{ $vcard->alternative_phone }}"
                                        class="text-white fw-5">+{{ $vcard->alternative_region_code }}{{ $vcard->alternative_phone }}</a>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($vcard->dob)
                        <div class="col-sm-6 mb-40">
                            <div class="contact-box d-flex align-items-center">
                                <div class="contact-icon d-flex justify-content-center align-items-center">
                                    <img src="{{ asset('assets/img/vcard29/dob.png') }}" />
                                </div>
                                <div class="contact-desc">
                                    <p class="mb-0 text-white fw-5"> {{ $vcard->dob }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($vcard->location)
                        <div class="col-sm-6 mb-40">
                            <div class="contact-box d-flex align-items-center">
                                <div class="contact-icon d-flex justify-content-center align-items-center">
                                    <img src="{{ asset('assets/img/vcard29/location.png') }}" />
                                </div>
                                <div class="contact-desc">
                                    <p class="mb-0 text-white fw-5"> {!! ucwords($vcard->location) !!}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                @endif
                @if(getLanguage($vcard->default_language) == 'Arabic')
                <div class="row" dir="rtl">
                    @if ($vcard->email)
                        <div class="col-sm-6 mb-40">
                            <div class="contact-box d-flex align-items-center">
                                <div class="contact-icon d-flex justify-content-center align-items-center">
                                    <img src="{{ asset('assets/img/vcard29/email.png') }}" />
                                </div>
                                <div class="contact-desc">
                                    <a href="mailto:{{ $vcard->email }}"
                                        class="text-white fw-5">{{ $vcard->email }}</a>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($vcard->alternative_email)
                        <div class="col-sm-6 mb-40">
                            <div class="contact-box d-flex align-items-center">
                                <div class="contact-icon d-flex justify-content-center align-items-center">
                                    <img src="{{ asset('assets/img/vcard29/email.png') }}" />
                                </div>
                                <div class="contact-desc">
                                    <a href="mailto:{{ $vcard->alternative_email }}"
                                        class="text-white fw-5">{{ $vcard->alternative_email }}</a>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($vcard->phone)
                        <div class="col-sm-6 mb-40">
                            <div class="contact-box d-flex align-items-center">
                                <div class="contact-icon d-flex justify-content-center align-items-center">
                                    <img src="{{ asset('assets/img/vcard29/phone.png') }}" />
                                </div>
                                <div class="contact-desc">
                                    <a href="tel:+{{ $vcard->region_code }}{{ $vcard->phone }}"
                                        class="text-white fw-5">+{{ $vcard->region_code }}{{ $vcard->phone }}</a>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($vcard->alternative_phone)
                        <div class="col-sm-6 mb-40">
                            <div class="contact-box d-flex align-items-center">
                                <div class="contact-icon d-flex justify-content-center align-items-center">
                                    <img src="{{ asset('assets/img/vcard29/phone.png') }}" />
                                </div>
                                <div class="contact-desc">
                                    <a href="tel:+{{ $vcard->alternative_region_code }}{{ $vcard->alternative_phone }}"
                                        class="text-white fw-5">+{{ $vcard->alternative_region_code }}{{ $vcard->alternative_phone }}</a>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($vcard->dob)
                        <div class="col-sm-6 mb-40">
                            <div class="contact-box d-flex align-items-center">
                                <div class="contact-icon d-flex justify-content-center align-items-center">
                                    <img src="{{ asset('assets/img/vcard29/dob.png') }}" />
                                </div>
                                <div class="contact-desc">
                                    <p class="mb-0 text-white fw-5"> {{ $vcard->dob }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($vcard->location)
                        <div class="col-sm-6 mb-40">
                            <div class="contact-box d-flex align-items-center">
                                <div class="contact-icon d-flex justify-content-center align-items-center">
                                    <img src="{{ asset('assets/img/vcard29/location.png') }}" />
                                </div>
                                <div class="contact-desc">
                                    <p class="mb-0 text-white fw-5"> {!! ucwords($vcard->location) !!}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                @endif
            </div>
            {{-- our service --}}
            @if ((isset($managesection) && $managesection['services']) || empty($managesection))
                @if (checkFeature('services') && $vcard->services->count())
                    <div class="our-services-section pt-60 pb-40 px-40">
                        <div class="services-bg img-1">
                            <img src="{{ asset('assets/img/vcard29/services-bg1.png') }}" alt="bg" />
                        </div>
                        <div class="services-bg img-2 text-end">
                            <img src="{{ asset('assets/img/vcard29/services-bg2.png') }}" alt="bg" />
                        </div>
                        <div class="section-heading">
                            <div class="heading-img">
                                <img src="{{ asset('assets/img/vcard29/services-heading.png') }}" class="w-100"
                                    alt="img" />
                            </div>
                            <h2 class="mb-0">{{ __('messages.vcard.our_service') }}</h2>
                        </div>
                        <div class="services">
                            @if ($vcard->services_slider_view)
                            <div class="row services-slider-view">
                                @foreach ($vcard->services as $service)
                                    <div class="col-sm-6 mb-sm-0 mb-40 mt-3">
                                            <div class="service-card text-start h-100">
                                                <div class="card-img mb-20">
                                                <a href="{{ $service->service_url ?? 'javascript:void(0)' }}"
                                                    class="{{ $service->service_url ? 'pe-auto' : 'pe-none' }}"
                                                    target="{{ $service->service_url ? '_blank' : '' }}">
                                                    <img src="{{ $service->service_icon }}" alt="branding"
                                                        loading="lazy" class="h-100 w-100" />
                                                </a>
                                            </div>
                                            <div class="card-body p-0">
                                                <h3 class="card-title fs-18 text-white mb-10">
                                                    {{ ucwords($service->name) }}
                                                </h3>
                                                <p
                                                    class="mb-0 fs-14 text-gray-100 {{ \Illuminate\Support\Str::length($service->description) > 80 ? 'more' : '' }}">
                                                    {!! $service->description !!}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @else
                            <div class="row pt-30">
                                @foreach ($vcard->services as $service)
                                <div class="col-sm-6 mb-sm-0 mb-40 mt-3">
                                            <div class="service-card text-start h-100">
                                                <div class="card-img mb-20">
                                            <a href="{{ $service->service_url ?? 'javascript:void(0)' }}"
                                                class="{{ $service->service_url ? 'pe-auto' : 'pe-none' }}"
                                                target="{{ $service->service_url ? '_blank' : '' }}">
                                                <img src="{{ $service->service_icon }}" alt="branding"
                                                    loading="lazy" class="h-100 w-100" />
                                            </a>
                                        </div>
                                        <div class="card-body p-0">
                                            <h3 class="card-title fs-18 text-white mb-10">
                                                {{ ucwords($service->name) }}
                                            </h3>
                                            <p
                                                class="mb-0 fs-14 text-gray-100 {{ \Illuminate\Support\Str::length($service->description) > 80 ? 'more' : '' }}">
                                                {!! $service->description !!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                @endif
            @endif
            {{-- make appointment --}}
            @if ((isset($managesection) && $managesection['appointments']) || empty($managesection))
                @if (checkFeature('appointments') && $vcard->appointmentHours->count())
                    <div class="appointment-section pt-40 pb-40 px-40">
                        <div class="appointment">
                            <div class="section-heading">
                                <div class="heading-img">
                                    <img src="{{ asset('assets/img/vcard29/appointment-heading.png') }}"
                                        class="w-100" alt="img" />
                                </div>
                                <h2 class="mb-0">{{ __('messages.make_appointments') }}</h2>
                            </div>
                            <div>
                                <div class="row mb-20">
                                    <div class="col-12">
                                        <div class="position-relative">
                                            {{ Form::text('date', null, ['class' => 'date appoint-input form-control appointment-input text-start', 'placeholder' => __('messages.form.pick_date'), 'id' => 'pickUpDate']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div id="slotData" class="row ">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit"
                                        class="appoint-btn appointmentAdd btn btn-primary w-100 rounded-2">
                                        {{ __('messages.make_appointments') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('vcardTemplates.appointment')
                @endif
            @endif
            {{-- gallery --}}
            @if ((isset($managesection) && $managesection['galleries']) || empty($managesection))
                @if (checkFeature('gallery') && $vcard->gallery->count())
                    <div class="gallery-section pt-60">
                        <div class="gallery-bg img-1">
                            <img src="{{ asset('assets/img/vcard29/gallery-bg1.png') }}" alt="bg" />
                        </div>
                        <div class="gallery-bg img-2 text-end">
                            <img src="{{ asset('assets/img/vcard29/gallery-bg2.png') }}" alt="bg" />
                        </div>
                        <div class="section-heading px-40">
                            <div class="heading-img">
                                <img src="{{ asset('assets/img/vcard29/gallery-heading.png') }}" class="w-100"
                                    alt="img" />
                            </div>
                            <h2 class="mb-0">{{ __('messages.plan.gallery') }}</h2>
                        </div>
                        <div class="gallery-slider px-sm-0 px-30">
                            @foreach ($vcard->gallery as $file)
                                @php
                                    $infoPath = pathinfo(public_path($file->gallery_image));
                                    $extension = $infoPath['extension'];
                                @endphp
                                <div>
                                    <div class="gallery-img">
                                        @if ($file->type == App\Models\Gallery::TYPE_IMAGE)
                                            <a href="{{ $file->gallery_image }}"
                                                data-lightbox="gallery-images h1"><img
                                                    src="{{ $file->gallery_image }}" alt="profile"
                                                    class="w-100 h-100" loading="lazy" /></a>
                                        @elseif($file->type == App\Models\Gallery::TYPE_FILE)
                                            <a id="file_url" href="{{ $file->gallery_image }}"
                                                class="gallery-link gallery-file-link" target="_blank"
                                                loading="lazy">
                                                <div class="gallery-item gallery-file-item"
                                                    @if ($extension == 'pdf') style="background-image: url({{ asset('assets/images/pdf-icon.png') }})"> @endif
                                                    @if ($extension == 'xls') style="background-image: url({{ asset('assets/images/xls.png') }})"> @endif
                                                    @if ($extension == 'csv') style="background-image: url({{ asset('assets/images/csv-file.png') }})"> @endif
                                                    @if ($extension == 'xlsx') style="background-image: url({{ asset('assets/images/xlsx.png') }})"> @endif
                                                    </div>
                                            </a>
                                        @elseif($file->type == App\Models\Gallery::TYPE_VIDEO)
                                            <video width="100%" height="100%" class="object-fit-cover" controls>
                                                <source src="{{ $file->gallery_image }}">
                                            </video>
                                        @elseif($file->type == App\Models\Gallery::TYPE_AUDIO)
                                            <div class="audio-container mt-2">
                                                <img src="{{ asset('assets/img/music.jpeg') }}" alt="Album Cover"
                                                    class="audio-image">
                                                <audio controls src="{{ $file->gallery_image }}"
                                                    class="audio-control">
                                                    Your browser does not support the <code>audio</code> element.
                                                </audio>
                                            </div>
                                        @else
                                            <iframe src="https://www.youtube.com/embed/{{ YoutubeID($file->link) }}"
                                                class="w-100 h-100">
                                            </iframe>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif
            {{-- product --}}
            @if ((isset($managesection) && $managesection['products']) || empty($managesection))
                @if (checkFeature('products') && $vcard->products->count())
                    <div class="product-section pt-60 mb-10 pb-60 px-30">
                        <div class="product-bg img-1">
                            <img src="{{ asset('assets/img/vcard29/product-bg1.png') }}" alt="bg" />
                        </div>
                        <div class="product-bg img-2 text-end">
                            <img src="{{ asset('assets/img/vcard29/product-bg2.png') }}" alt="bg" />
                        </div>
                        <div class="section-heading px-3">
                            <div class="heading-img">
                                <img src="{{ asset('assets/img/vcard29/product-heading.png') }}" class="w-100"
                                    alt="img" />
                            </div>
                            <h2 class="mb-0">{{ __('messages.plan.products') }}</h2>
                        </div>
                        <div class="product-slider">
                            @foreach ($vcard->products as $product)
                                <div>
                                    <div class="product-card card mb-2">
                                        <div class="product-img card-img">
                                            <a @if ($product->product_url) href="{{ $product->product_url }}" @endif
                                                target="_blank"
                                                class="text-decoration-none fs-6 object-fit-cover"><img
                                                    src="{{ $product->product_icon }}"
                                                    class="w-100 h-100 object-fit-contain" loading="lazy"></a>
                                        </div>
                                        <div class="product-desc card-body p-3">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <h3 class="text-white fs-6 fw-5 mb-0">{{ $product->name }}</h3>
                                                <p class="amount fs-6 mb-0 fw-5 text-primary">
                                                    @if ($product->currency_id && $product->price)
                                                        <span
                                                            class="fs-18 fw-6 text-purple">{{ $product->currency->currency_icon }}{{ number_format($product->price, 2) }}</span>
                                                    @elseif($product->price)
                                                        <span
                                                            class="fs-18 fw-6 text-purple">{{ getUserCurrencyIcon($vcard->user->id) . ' ' . $product->price }}</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <p class="fs-14 text-gray-100 mb-0">
                                                {{ $product->description }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="me-5 text-center view-more">
                            <a class="fs-6 text text-decoration-underline text-primary ms-5"
                                href="{{ route('showProducts', ['id' => $vcard->id, 'alias' => $vcard->url_alias]) }}">{{ __('messages.analytics.view_more') }}</a>
                        </div>
                    </div>
                @endif
            @endif
            {{-- testimonial --}}
            @if ((isset($managesection) && $managesection['testimonials']) || empty($managesection))
                @if (checkFeature('testimonials') && $vcard->testimonials->count())
                    <div class="testimonial-section pb-60 px-40">
                        <div class="testimonial-bg img-1">
                            <img src="{{ asset('assets/img/vcard29/testimonial-bg1.png') }}" alt="bg" />
                        </div>
                        <div class="section-heading px-3">
                            <div class="heading-img">
                                <img src="{{ asset('assets/img/vcard29/testimonial-heading.png') }}" class="w-100"
                                    alt="img" />
                            </div>
                            <h2 class="mb-0">{{ __('messages.plan.testimonials') }}</h2>
                        </div>
                        <div class="testimonial-slider">
                            @foreach ($vcard->testimonials as $testimonial)
                                <div>
                                    <div class="testimonial-card card">
                                        <div class="card-img testimonial-profile-img mb-20">
                                            <img src="{{ $testimonial->image_url }}"
                                                class="w-100 h-100 object-fit-cover" />
                                        </div>
                                        <div class="card-body p-0 text-center">
                                            <p
                                                class="desc text-gray-100 fs-14  {{ \Illuminate\Support\Str::length($testimonial->description) > 80 ? 'more' : '' }}">
                                                {!! $testimonial->description !!}
                                            </p>
                                            <h3 class="text-white fs-18 mb-0">{{ ucwords($testimonial->name) }}</h3>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif
            {{-- insta feed --}}
            @if ((isset($managesection) && $managesection['insta_embed']) || empty($managesection))
                @if (checkFeature('insta_embed') && $vcard->instagramEmbed->count())
                    <div class="">
                        <div class="section-heading px-40">
                            <div class="heading-img">
                                <img src="{{ asset('assets/img/vcard29/blog-heading.png') }}" class="w-100"
                                    alt="img" />
                            </div>
                            <h2 class="mb-0">{{ __('messages.feature.insta_embed') }}</h2>
                        </div>
                        <nav>
                            <div class="row insta-toggle">
                                <div class="nav nav-tabs border-0 px-0" id="nav-tab" role="tablist">
                                    <button
                                        class="d-flex align-items-center justify-content-center py-2 active postbtn instagram-btn  border-0 text-dark"
                                        id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                                        type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                                        <svg aria-label="Posts"
                                            class="svg-post-icon x1lliihq x1n2onr6 x173jzuc stroke-none"
                                            fill="currentColor" height="24" role="img" viewBox="0 0 24 24"
                                            width="24">
                                            <title>Posts</title>
                                            <rect fill="none" height="18" stroke="currentColor"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                width="18" x="3" y="3"></rect>
                                            <line fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2" x1="9.015"
                                                x2="9.015" y1="3" y2="21"></line>
                                            <line fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2" x1="14.985"
                                                x2="14.985" y1="3" y2="21"></line>
                                            <line fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2" x1="21"
                                                x2="3" y1="9.015" y2="9.015"></line>
                                            <line fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2" x1="21"
                                                x2="3" y1="14.985" y2="14.985"></line>
                                        </svg>
                                    </button>
                                    <button
                                        class="d-flex align-items-center justify-content-center py-2 instagram-btn reelsbtn  border-0 text-dark mr-0"
                                        id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                                        type="button" role="tab" aria-controls="nav-profile"
                                        aria-selected="false">
                                        <svg class="svg-reels-icon" viewBox="0 0 48 48" width="27"
                                            height="27">
                                            <path
                                                d="m33,6H15c-.16,0-.31,0-.46.01-.7401.04-1.46.17-2.14.38-3.7,1.11-6.4,4.55-6.4,8.61v18c0,4.96,4.04,9,9,9h18c4.96,0,9-4.04,9-9V15c0-4.96-4.04-9-9-9Zm7,27c0,3.86-3.14,7-7,7H15c-3.86,0-7-3.14-7-7V15c0-3.37,2.39-6.19,5.57-6.85.46-.1.94-.15,1.43-.15h18c3.86,0,7,3.14,7,7v18Z"
                                                fill="currentColor" class="color000 svgShape not-active-svg"></path>
                                            <path
                                                d="M21 16h-2.2l-.66-1-4.57-6.85-.76-1.15h2.39l.66 1 4.67 7 .3.45c.11.17.17.36.17.55zM34 16h-2.2l-.66-1-4.67-7-.66-1h2.39l.66 1 4.67 7 .3.45c.11.17.17.36.17.55z"
                                                fill="currentColor" class="color000 svgShape not-active-svg"></path>
                                            <rect width="36" height="3" x="6" y="15" fill="currentColor"
                                                class="color000 svgShape"></rect>
                                            <path
                                                d="m20,35c-.1753,0-.3506-.0459-.5073-.1382-.3052-.1797-.4927-.5073-.4927-.8618v-10c0-.3545.1875-.6821.4927-.8618.3066-.1797.6831-.1846.9932-.0122l9,5c.3174.1763.5142.5107.5142.874s-.1968.6978-.5142.874l-9,5c-.1514.084-.3188.126-.4858.126Zm1-9.3003v6.6006l5.9409-3.3003-5.9409-3.3003Z"
                                                fill="currentColor" class="color000 svgShape not-active-svg"></path>
                                            <path
                                                d="m6,33c0,4.96,4.04,9,9,9h18c4.96,0,9-4.04,9-9v-16H6v16Zm13-9c0-.35.19-.68.49-.86.31-.18.69-.19,1-.01l9,5c.31.17.51.51.51.87s-.2.7-.51.87l-9,5c-.16.09-.3199.13-.49.13-.18,0-.35-.05-.51-.14-.3-.18-.49-.51-.49-.86v-10Zm23-9c0-4.96-4.04-9-9-9h-5.47l6,9h8.47Zm-10.86,0l-6.01-9h-10.13c-.16,0-.31,0-.46.01l5.99,8.99h10.61ZM12.4,6.39c-3.7,1.11-6.4,4.55-6.4,8.61h12.14l-5.74-8.61Z"
                                                fill="currentColor" class="color000 svgShape active-svg"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <div id="postContent" class="insta-feed">
                        <div class="row overflow-hidden m-0 mt-2" loading="lazy">
                            <!-- "Post" content -->
                            @foreach ($vcard->InstagramEmbed as $InstagramEmbed)
                                @if ($InstagramEmbed->type == 0)
                                    <div class="col-12 col-sm-6 insta-feed-iframe">
                                        {!! $InstagramEmbed->embedtag !!}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="d-none insta-feed" id="reelContent">
                        <div class="row overflow-hidden m-0 mt-2">
                            <!-- "Reel" content -->
                            @foreach ($vcard->InstagramEmbed as $InstagramEmbed)
                                @if ($InstagramEmbed->type == 1)
                                    <div class="col-12 col-sm-6 insta-feed-iframe">
                                        {!! $InstagramEmbed->embedtag !!}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif
            {{-- blog --}}
            @if ((isset($managesection) && $managesection['blogs']) || empty($managesection))
                @if (checkFeature('blog') && $vcard->blogs->count())
                    <div class="blog-section pt-60">
                        <div class="blog-bg img-1">
                            <img src="{{ asset('assets/img/vcard29/blog-bg1.png') }}" alt="bg" />
                        </div>
                        <div class="blog-bg img-2 text-end">
                            <img src="{{ asset('assets/img/vcard29/blog-bg2.png') }}" alt="bg" />
                        </div>
                        <div class="section-heading px-40">
                            <div class="heading-img">
                                <img src="{{ asset('assets/img/vcard29/blog-heading.png') }}" class="w-100"
                                    alt="img" />
                            </div>
                            <h2 class="mb-0">{{ __('messages.feature.blog') }}</h2>
                        </div>
                        <div class="blog-slider px-sm-0 px-40">
                            @foreach ($vcard->blogs as $blog)
                                <div>
                                    <div class="blog-card card">
                                        <div class="card-img">
                                            <a href="{{ route('vcard.show-blog', [$vcard->url_alias, $blog->id]) }}">
                                                <img src="{{ $blog->blog_icon }}"
                                                    class="w-100 h-100 object-fit-contain" loading="lazy" />
                                            </a>
                                        </div>
                                        <div class="card-body text-start">
                                            <h2 class="fs-18 fw-5 text-white">{{ $blog->title }}</h2>
                                            <p class="text-white blog-desc fw-5 fs-14 mb-0">
                                                {{ Illuminate\Support\Str::words(strip_tags($blog->description), 100, '...') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif
            {{-- buisness hours --}}
            @if ((isset($managesection) && $managesection['business_hours']) || empty($managesection))
                @if ($vcard->businessHours->count())
                    @php
                        $todayWeekName = strtolower(\Carbon\Carbon::now()->rawFormat('D'));
                    @endphp
                    <div class="business-hour-section pt-60 pb-40 px-40">
                        <div class="hour-bg img-1">
                            <img src="{{ asset('assets/img/vcard29/hour-bg1.png') }}" alt="bg" />
                        </div>
                        <div class="hour-bg img-2 text-end">
                            <img src="{{ asset('assets/img/vcard29/hour-bg2.png') }}" alt="bg" />
                        </div>
                        <div class="section-heading">
                            <div class="heading-img">
                                <img src="{{ asset('assets/img/vcard29/hour-heading.png') }}" class="w-100"
                                    alt="img" />
                            </div>
                            <h2 class="mb-0">{{ __('messages.business.business_hours') }}</h2>
                        </div>
                        <div class="business-hour-card row justify-content-center" @if(getLanguage($vcard->default_language) == 'Arabic') dir="rtl" @endif>
                            @foreach ($businessDaysTime as $key => $dayTime)
                                <div class="col-sm-6 mb-3 pe-sm-2">
                                    <div class="business-hour">
                                        <span
                                            class="me-2">{{ __('messages.business.' . \App\Models\BusinessHour::DAY_OF_WEEK[$key]) }}:</span>
                                        <span>{{ $dayTime ?? __('messages.common.closed') }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif
            {{-- qr code --}}
            @if (isset($vcard['show_qr_code']) && $vcard['show_qr_code'] == 1)
                <div class="qr-code-section pt-40 pb-40 px-40">
                    <div class="qr-bg img-1">
                        <img src="{{ asset('assets/img/vcard29/qr-bg1.png') }}" alt="bg" />
                    </div>
                    <div class="section-heading">
                        <div class="heading-img">
                            <img src="{{ asset('assets/img/vcard29/qr-heading.png') }}" class="w-100"
                                alt="img" />
                        </div>
                        <h2 class="mb-0">{{ __('messages.vcard.qr_code') }}</h2>
                    </div>
                    <div class="qr-code gap-3 mb-20" @if(getLanguage($vcard->default_language) == 'Arabic') dir="rtl" @endif>
                        <div class="qr-profile-img">
                            <img src="{{ $vcard->profile_url }}"
                                class="w-100 h-100 object-fit-cover rounded-circle" />
                        </div>
                        <div class="qr-code-img" id="qr-code-twentynine">
                            @if (isset($customQrCode['applySetting']) && $customQrCode['applySetting'] == 1)
                                {!! QrCode::color(
                                    $qrcodeColor['qrcodeColor']->red(),
                                    $qrcodeColor['qrcodeColor']->green(),
                                    $qrcodeColor['qrcodeColor']->blue(),
                                )->backgroundColor(
                                        $qrcodeColor['background_color']->red(),
                                        $qrcodeColor['background_color']->green(),
                                        $qrcodeColor['background_color']->blue(),
                                    )->style($customQrCode['style'])->eye($customQrCode['eye_style'])->size(130)->format('svg')->generate(Request::url()) !!}
                            @else
                                {!! QrCode::size(130)->format('svg')->generate(Request::url()) !!}
                            @endif
                        </div>
                    </div>
                </div>
            @endif
            {{-- iframe --}}
            @if ((isset($managesection) && $managesection['iframe']) || empty($managesection))
                @if (checkFeature('iframes') && $vcard->iframes->count())
                    <div class="blog-section pt-40">
                        <div class="section-heading text-center">
                            <div class="heading-img">
                                <img src="{{ asset('assets/img/vcard29/blog-heading.png') }}" class="w-100"
                                    alt="img" />
                            </div>
                            <h2>{{ __('messages.vcard.iframe') }}</h2>
                        </div>
                        <div class="iframe-slider">
                            @foreach ($vcard->iframes as $iframe)
                                <div class="slide p-3">
                                    <div class="iframe-card">
                                        <div class="overlay">
                                            <iframe src="{{ $iframe->url }}" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                allowfullscreen width="100%" height="400">
                                            </iframe>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif
            {{-- inquiry --}}
            @php
                $currentSubs = $vcard
                    ->subscriptions()
                    ->where('status', \App\Models\Subscription::ACTIVE)
                    ->latest()
                    ->first();
            @endphp
            @if ($currentSubs && $currentSubs->plan->planFeature->enquiry_form && $vcard->enable_enquiry_form)
                <div class="contact-us-section pt-60 pb-40 px-40">
                    <div class="contact-us-bg img-1 text-end">
                        <img src="{{ asset('assets/img/vcard29/contact-us-bg1.png') }}" alt="bg" />
                    </div>
                    <div class="section-heading">
                        <div class="heading-img">
                            <img src="{{ asset('assets/img/vcard29/contact-us-heading.png') }}" class="w-100"
                                alt="img" />
                        </div>
                        <h2 class="mb-0">{{ __('messages.contact_us.inquries') }}</h2>
                    </div>
                    @if(getLanguage($vcard->default_language) != 'Arabic')
                    <div class="contact-form">
                        <form action="" id="enquiryForm">
                            @csrf
                            <div class="row">
                                <div id="enquiryError" class="alert alert-danger d-none"></div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control"
                                        placeholder="{{ __('messages.form.your_name') }}" name="name" />
                                </div>
                                <div class="col-sm-6">
                                    <input type="tel" class="form-control"
                                        placeholder="{{ __('messages.form.phone') }}" name="phone" />
                                </div>
                                <div class="col-12">
                                    <input type="email" class="form-control"
                                        placeholder="{{ __('messages.form.your_email') }}" name="email" />
                                </div>
                                <div class="col-12 mb-30">
                                    <textarea class="form-control h-100" placeholder="{{ __('messages.form.type_message') }}" rows="3"
                                        name="message"></textarea>
                                </div>
                                @if (!empty($vcard->privacy_policy) || !empty($vcard->term_condition))
                                    <div class="col-12 mb-4">
                                        <input type="checkbox" name="terms_condition"
                                            class="form-check-input terms-condition" id="termConditionCheckbox"
                                            placeholder>&nbsp;
                                        <label class="form-check-label" for="privacyPolicyCheckbox">
                                            <span class="text-primary">{{ __('messages.vcard.agree_to_our') }}</span>
                                            <a href="{{ route('vcard.show-privacy-policy', [$vcard->url_alias, $vcard->id]) }}"
                                                target="_blank"
                                                class="text-decoration-none link-info fs-6">{!! __('messages.vcard.term_and_condition') !!}</a>
                                            <span class="text-primary">&</span>
                                            <a href="{{ route('vcard.show-privacy-policy', [$vcard->url_alias, $vcard->id]) }}"
                                                target="_blank"
                                                class="text-decoration-none link-info fs-6">{{ __('messages.vcard.privacy_policy') }}</a>
                                        </label>
                                    </div>
                                @endif
                                <div class="col-12 text-center">
                                    <button class="send-btn btn btn-primary rounded-2 contact-btn" type="submit">
                                        {{ __('messages.contact_us.send_message') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endif
                    @if(getLanguage($vcard->default_language) == 'Arabic')
                    <div class="contact-form" dir="rtl">
                        <form action="">
                            <div class="row">
                                <div class="col-sm-6">
                                        <input type="text" class="form-control text-start"
                                        placeholder="{{ __('messages.form.your_name') }}" name="name" />
                                </div>
                                <div class="col-sm-6">
                                        <input type="tel" class="form-control text-start"
                                        placeholder="{{ __('messages.form.phone') }}" name="phone" />
                                </div>
                                <div class="col-12">
                                        <input type="email" class="form-control text-start"
                                        placeholder="{{ __('messages.form.your_email') }}" name="email" />
                                </div>
                                <div class="col-12 mb-30">
                                        <textarea class="form-control text-start h-100" placeholder="{{ __('messages.form.type_message') }}" rows="3"
                                        name="message"></textarea>
                                </div>
                                @if (!empty($vcard->privacy_policy) || !empty($vcard->term_condition))
                                    <div class="col-12 mb-4">
                                        <input type="checkbox" name="terms_condition"
                                            class="form-check-input terms-condition" id="termConditionCheckbox"
                                            placeholder>&nbsp;
                                        <label class="form-check-label" for="privacyPolicyCheckbox">
                                            <span class="text-primary">{{ __('messages.vcard.agree_to_our') }}</span>
                                            <a href="{{ route('vcard.show-privacy-policy', [$vcard->url_alias, $vcard->id]) }}"
                                                target="_blank"
                                                class="text-decoration-none link-info fs-6">{!! __('messages.vcard.term_and_condition') !!}</a>
                                            <span class="text-primary">&</span>
                                            <a href="{{ route('vcard.show-privacy-policy', [$vcard->url_alias, $vcard->id]) }}"
                                                target="_blank"
                                                class="text-decoration-none link-info fs-6">{{ __('messages.vcard.privacy_policy') }}</a>
                                        </label>
                                    </div>
                                @endif
                                <div class="col-12 text-center">
                                    <button class="send-btn btn btn-primary rounded-2" type="submit">
                                        {{ __('messages.contact_us.send_message') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endif
                </div>
            @endif
            {{-- map --}}
            @if ((isset($managesection) && $managesection['map']) || empty($managesection))
                <div class="container">
                    <div class="d-flex  flex-column justify-content-center mt-2 mb-sm-5">
                        @if ($vcard->location_url && isset($url[5]))
                            <div class="m-2 mb-10 mt-0">
                                <iframe width="100%" height="300px"
                                    src='https://maps.google.de/maps?q={{ $url[5] }}/&output=embed'
                                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                                    style="border-radius: 10px;"></iframe>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
            {{-- craete your vcard --}}
            @if ($currentSubs && $currentSubs->plan->planFeature->affiliation && $vcard->enable_affiliation)
                <div class="create-vcard-section pt-40 pb-60 px-40">
                    <div class="create-vcard-bg img-1">
                        <img src="{{ asset('assets/img/vcard29/create-vcard-bg1.png') }}" alt="bg" />
                    </div>
                    <div class="create-vcard-bg img-2 text-end">
                        <img src="{{ asset('assets/img/vcard29/create-vcard-bg2.png') }}" alt="bg" />
                    </div>
                    <div class="overlay"></div>
                    <div class="content">
                        <div class="section-heading">
                            <div class="heading-img">
                                <img src="{{ asset('assets/img/vcard29/create-vcard-heading.png') }}" class="w-100"
                                    alt="img" />
                            </div>
                            <h2 class="mb-0">{{ __('messages.create_vcard') }}</h2>
                        </div>
                        <div class="pb-4">
                            <div class="pb-5 mb-5">
                                <div class="vcard-link-card card mx-sm-3 mb-5">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a href="{{ route('register', ['referral-code' => $vcard->user->affiliate_code]) }}"
                                            class="text-secondary link-text fw-5">{{ route('register', ['referral-code' => $vcard->user->affiliate_code]) }}</a>
                                        <i class="icon fa-solid fa-arrow-up-right-from-square ms-3 text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            {{-- add to contact --}}
            @if ($vcard->enable_contact)
            <div class="add-to-contact-section">
                <div class="text-center d-flex align-items-center justify-content-center" @if(getLanguage($vcard->default_language) == 'Arabic') dir="rtl" @endif>
                    <a href="{{ route('add-contact', $vcard->id) }}"
                        class="add-contact-btn rounded-2 btn-primary"><i
                            class="fas fa-download fa-address-book"></i>
                        &nbsp;{{ __('messages.setting.add_contact') }}</a>
                </div>
            </div>
            @endif
            {{-- made by --}}
            <div class="d-flex justify-content-evenly made-by-section">
                @if (checkFeature('advanced'))
                    @if (checkFeature('advanced')->hide_branding && $vcard->branding == 0)
                        @if ($vcard->made_by)
                            <a @if (!is_null($vcard->made_by_url)) href="{{ $vcard->made_by_url }}" @endif
                                class="text-center text-decoration-none text-light" target="_blank">
                                <small>{{ __('messages.made_by') }} {{ $vcard->made_by }}</small>
                            </a>
                        @else
                            <div class="text-center">
                                <small class="text-light">{{ __('messages.made_by') }}
                                    {{ $setting['app_name'] }}</small>
                            </div>
                        @endif
                    @endif
                @else
                    @if ($vcard->made_by)
                        <a @if (!is_null($vcard->made_by_url)) href="{{ $vcard->made_by_url }}" @endif
                            class="text-center text-decoration-none text-dark" target="_blank">
                            <small>{{ __('messages.made_by') }} {{ $vcard->made_by }}</small>
                        </a>
                    @else
                        <div class="text-center">
                            <small class="text-light">{{ __('messages.made_by') }}
                                {{ $setting['app_name'] }}</small>
                        </div>
                    @endif
                @endif
                @if (!empty($vcard->privacy_policy) || !empty($vcard->term_condition))
                    <div>
                        <a class="text-decoration-none text-light cursor-pointer terms-policies-btn"
                            href="{{ route('vcard.show-privacy-policy', [$vcard->url_alias, $vcard->id]) }}"><small>{!! __('messages.vcard.term_policy') !!}</small></a>
                    </div>
                @endif
            </div>
            {{-- sticky buttons --}}
            <div class="btn-section cursor-pointer  @if(getLanguage($vcard->default_language) == 'Arabic') rtl @endif">
                <div class="fixed-btn-section">
                    @if (empty($vcard->hide_stickybar))
                        <div class="bars-btn social-media-bars-btn @if(getLanguage($vcard->default_language) == 'Arabic') vcard-bars-btn-left @endif">
                            <img src="{{ asset('assets/img/vcard29/sticky.png') }}" loading="lazy">
                        </div>
                    @endif
                    <div class="sub-btn d-none">
                        <div class="sub-btn-div @if(getLanguage($vcard->default_language) == 'Arabic') sub-btn-div-left @endif">
                            @if ($vcard->whatsapp_share)
                                <div class="icon-search-container mb-3" data-ic-class="search-trigger">
                                    <div class="wp-btn">
                                        <i class="fab text-light  fa-whatsapp fa-2x" id="wpIcon"></i>
                                    </div>
                                    <input type="number" class="search-input" id="wpNumber"
                                        data-ic-class="search-input"
                                        placeholder="{{ __('messages.setting.wp_number') }}" />
                                    <div class="share-wp-btn-div">
                                        <a href="javascript:void(0)"
                                            class="vcard29-sticky-btn vcard29-btn-group d-flex justify-content-center text-primary align-items-center rounded-0 text-decoration-none py-1 rounded-pill justify-content share-wp-btn">
                                            <i class="fa-solid fa-paper-plane"></i> </a>
                                    </div>
                                </div>
                            @endif
                            @if (empty($vcard->hide_stickybar))
                                <div
                                    class="{{ isset($vcard->whatsapp_share) ? 'vcard29-btn-group' : 'stickyIcon' }}">
                                    <button type="button"
                                        class="vcard29-btn-group vcard29-share vcard29-sticky-btn mb-3 px-2 py-1"><i
                                            class="fas fa-share-alt fs-4 pt-1"></i></button>
                                    @if (!empty($vcard->enable_download_qr_code))
                                        <a type="button"
                                            class="vcard29-btn-group vcard29-sticky-btn d-flex justify-content-center  align-items-center  px-2 mb-3 py-2"
                                            id="qr-code-btn" download="qr_code.png"><i
                                                class="fa-solid fa-qrcode fs-4 text-primary"></i></a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- newslatter modal --}}
            @if ((isset($managesection) && $managesection['news_latter_popup']) || empty($managesection))
                <div class="modal fade" id="newsLatterModal" tabindex="-1" aria-labelledby="newsLatterModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog news-modal">
                        <div class="modal-content animate-bottom" id="newsLatter-content">
                            <div class="newsmodal-header">
                                <button type="button" class="btn-close text-light position-absolute top-0 end-0"
                                    data-bs-dismiss="modal" aria-label="Close" id="closeNewsLatterModal"></button>
                                <h1 class="newsmodal-title text-center mt-5" id="newsLatterModalLabel"><i
                                        class="fa-solid fa-envelope-open-text"></i></h1>
                            </div>
                            <div class="modal-body">
                                <h1 class="content text-center p-lg-0">
                                    {{ __('messages.vcard.subscribe_newslatter') }}</h1>
                                <h3 class="modal-desc text-center">{{ __('messages.vcard.update_directly') }}</h3>
                                <form action="" method="post" id="newsLatterForm">
                                    @csrf
                                    <input type="hidden" name="vcard_id" value="{{ $vcard->id }}">
                                    <div class="input-group mb-3 mt-5">
                                        <input type="email" class="form-control bg-dark border-0 text-light"
                                            placeholder="{{ __('messages.form.enter_your_email') }}" name="email"
                                            id="emailSubscription" aria-label="Email"
                                            aria-describedby="button-addon2">
                                        <button class="btn" type="submit" id="email-send"><i
                                                class="fa-regular fa-envelope"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
   {{-- share modal code --}}
   <div id="vcard29-shareModel" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" @if(getLanguage($vcard->default_language) == 'Arabic') dir="rtl" @endif>
            <div class="">
                <div class="row align-items-center mt-3">
                    <div class="col-10 text-center">
                        <h5 class="modal-title pl-50">{{ __('messages.vcard.share_my_vcard') }}</h5>
                    </div>

                        <button type="button" aria-label="Close"
                            class="btn btn-sm btn-icon btn-active-color-danger border-none" data-bs-dismiss="modal">
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                    viewBox="0 0 24 24" version="1.1">
                                    <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                                        fill="#000000">
                                        <rect fill="#000000" x="0" y="7" width="16" height="2"
                                            rx="1" />
                                        <rect fill="#000000" opacity="0.5"
                                            transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)"
                                            x="0" y="7" width="16" height="2" rx="1" />
                                    </g>
                                </svg>
                            </span>
                        </button>

                    </div>
                </div>
                @php
                    $shareUrl = route('vcard.show', ['alias' => $vcard->url_alias]);
                @endphp
                <div class="modal-body">
                    <a href="http://www.facebook.com/sharer.php?u={{ $shareUrl }}" target="_blank"
                        class="text-decoration-none share" title="Facebook">
                        <div class="row">
                            <div class="col-2">
                                <i class="fab fa-facebook fa-2x" style="color: #1B95E0"></i>

                        </div>
                        <div class="col-9 p-1">
                            <p class="align-items-center text-dark fw-bolder">
                                {{ __('messages.social.Share_on_facebook') }}</p>
                        </div>
                        <div class="col-1 p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="arrow" version="1.0" height="16px"
                                viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">
                                <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                                    fill="#000000" stroke="none">
                                    <path
                                        d="M1277 4943 l-177 -178 1102 -1102 1103 -1103 -1103 -1103 -1102 -1102 178 -178 177 -177 1280 1280 1280 1280 -1280 1280 -1280 1280 -178 -177z" />
                                </g>
                            </svg>
                        </div>
                    </div>
                </a>
                <a href="http://twitter.com/share?url={{ $shareUrl }}&text={{ $vcard->name }}&hashtags=sharebuttons"
                    target="_blank" class="text-decoration-none share" title="Twitter">
                    <div class="row">
                        <div class="col-2">

                                <span class="fa-2x"><svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                        viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                        <path
                                            d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z" />
                                    </svg></span>

                        </div>
                        <div class="col-9 p-1">
                            <p class="align-items-center text-dark fw-bolder">
                                {{ __('messages.social.Share_on_twitter') }}</p>
                        </div>
                        <div class="col-1 p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="arrow" version="1.0" height="16px"
                                viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">
                                <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                                    fill="#000000" stroke="none">
                                    <path
                                        d="M1277 4943 l-177 -178 1102 -1102 1103 -1103 -1103 -1103 -1102 -1102 178 -178 177 -177 1280 1280 1280 1280 -1280 1280 -1280 1280 -178 -177z" />
                                </g>
                            </svg>
                        </div>
                    </div>
                </a>
                <a href="http://www.linkedin.com/shareArticle?mini=true&url={{ $shareUrl }}" target="_blank"
                    class="text-decoration-none share" title="Linkedin">
                    <div class="row">
                        <div class="col-2">
                            <i class="fab fa-linkedin fa-2x" style="color: #1B95E0"></i>
                        </div>
                        <div class="col-9 p-1">
                            <p class="align-items-center text-dark fw-bolder">
                                {{ __('messages.social.Share_on_linkedin') }}</p>
                        </div>
                        <div class="col-1 p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="arrow" version="1.0" height="16px"
                                viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">
                                <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                                    fill="#000000" stroke="none">
                                    <path
                                        d="M1277 4943 l-177 -178 1102 -1102 1103 -1103 -1103 -1103 -1102 -1102 178 -178 177 -177 1280 1280 1280 1280 -1280 1280 -1280 1280 -178 -177z" />
                                </g>
                            </svg>
                        </div>
                    </div>
                </a>
                <a href="mailto:?Subject=&Body={{ $shareUrl }}" target="_blank"
                    class="text-decoration-none share" title="Email">
                    <div class="row">
                        <div class="col-2">
                            <i class="fas fa-envelope fa-2x" style="color: #191a19  "></i>
                        </div>
                        <div class="col-9 p-1">
                            <p class="align-items-center text-dark fw-bolder">
                                {{ __('messages.social.Share_on_email') }}</p>
                        </div>
                        <div class="col-1 p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="arrow" version="1.0" height="16px"
                                viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">
                                <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                                    fill="#000000" stroke="none">
                                    <path
                                        d="M1277 4943 l-177 -178 1102 -1102 1103 -1103 -1103 -1103 -1102 -1102 178 -178 177 -177 1280 1280 1280 1280 -1280 1280 -1280 1280 -178 -177z" />
                                </g>
                            </svg>
                        </div>
                    </div>
                </a>
                <a href="http://pinterest.com/pin/create/link/?url={{ $shareUrl }}" target="_blank"
                    class="text-decoration-none share" title="Pinterest">
                    <div class="row">
                        <div class="col-2">
                            <i class="fab fa-pinterest fa-2x" style="color: #bd081c"></i>
                        </div>
                        <div class="col-9 p-1">
                            <p class="align-items-center text-dark fw-bolder">
                                {{ __('messages.social.Share_on_pinterest') }}</p>
                        </div>
                        <div class="col-1 p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="arrow" version="1.0" height="16px"
                                viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">
                                <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                                    fill="#000000" stroke="none">
                                    <path
                                        d="M1277 4943 l-177 -178 1102 -1102 1103 -1103 -1103 -1103 -1102 -1102 178 -178 177 -177 1280 1280 1280 1280 -1280 1280 -1280 1280 -178 -177z" />
                                </g>
                            </svg>
                        </div>
                    </div>
                </a>
                <a href="http://reddit.com/submit?url={{ $shareUrl }}&title={{ $vcard->name }}"
                    target="_blank" class="text-decoration-none share" title="Reddit">
                    <div class="row">
                        <div class="col-2">
                            <i class="fab fa-reddit fa-2x" style="color: #ff4500"></i>
                        </div>
                        <div class="col-9 p-1">
                            <p class="align-items-center text-dark fw-bolder">
                                {{ __('messages.social.Share_on_reddit') }}</p>
                        </div>
                        <div class="col-1 p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="arrow" version="1.0" height="16px"
                                viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">
                                <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                                    fill="#000000" stroke="none">
                                    <path
                                        d="M1277 4943 l-177 -178 1102 -1102 1103 -1103 -1103 -1103 -1102 -1102 178 -178 177 -177 1280 1280 1280 1280 -1280 1280 -1280 1280 -178 -177z" />
                                </g>
                            </svg>
                        </div>
                    </div>
                </a>
                <a href="https://wa.me/?text={{ $shareUrl }}" target="_blank"
                    class="text-decoration-none share" title="Whatsapp">
                    <div class="row">
                        <div class="col-2">
                            <i class="fab fa-whatsapp fa-2x" style="color: limegreen"></i>
                        </div>
                        <div class="col-9 p-1">
                            <p class="align-items-center text-dark fw-bolder">
                                {{ __('messages.social.Share_on_whatsapp') }}</p>
                        </div>
                        <div class="col-1 p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="arrow" version="1.0" height="16px"
                                viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">
                                <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                                    fill="#000000" stroke="none">
                                    <path
                                        d="M1277 4943 l-177 -178 1102 -1102 1103 -1103 -1103 -1103 -1102 -1102 178 -178 177 -177 1280 1280 1280 1280 -1280 1280 -1280 1280 -178 -177z" />
                                </g>
                            </svg>
                        </div>
                    </div>
                </a>
                <div class="col-12 justify-content-between social-link-modal">
                    <div class="input-group" dir="rtl">
                        <input type="text" class="form-control" placeholder="{{ request()->fullUrl() }}"
                            disabled>
                        <span id="vcardUrlCopy{{ $vcard->id }}" class="d-none" target="_blank">
                            {{ route('vcard.show', ['alias' => $vcard->url_alias]) }} </span>
                        <button class="copy-vcard-clipboard btn btn-dark" title="Copy Link"
                            data-id="{{ $vcard->id }}">
                            <i class="fa-regular fa-copy fa-2x"></i>
                        </button>
                    </div>
                </div>
                <div class="text-center">

                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
@include('vcardTemplates.template.templates')
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript" src="{{ asset('assets/js/front-third-party.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/slider/js/slick.min.js') }}" type="text/javascript"></script>
@php
$setting = \App\Models\UserSetting::where('user_id', $vcard->tenant->user->id)
    ->where('key', 'stripe_key')
    ->first();
@endphp
<script>
          let stripe = ''
        @if (!empty($setting) && !empty($setting->value))
            stripe = Stripe('{{ $setting->value }}');
        @endif
    $().ready(function() {
        $(".gallery-slider").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            centerMode: true,
            arrows: false,
            dots: true,
            speed: 300,
            centerPadding: "145px",
            infinite: true,
            autoplaySpeed: 5000,
            autoplay: true,
            responsive: [{
                    breakpoint: 768,
                    settings: {
                        centerPadding: "125px",
                    },
                },
                {
                    breakpoint: 575,
                    settings: {
                        centerPadding: "0",
                    },
                },
            ],
        });
        $(".product-slider").slick({
            arrows: true,
            infinite: true,
            dots: false,
            slidesToShow: 2,
            slidesToScroll: 1,
            autoplay: true,
            responsive: [{
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                    dots: true,
                },
            }, ],
        });
        $(".testimonial-slider").slick({
            arrows: true,
            infinite: true,
            dots: false,
            slidesToShow: 1,
            autoplay: true,
            prevArrow: '<button class="slide-arrow prev-arrow"><i class="fa-solid fa-arrow-left"></i></button>',
            nextArrow: '<button class="slide-arrow next-arrow"><i class="fa-solid fa-arrow-right"></i></button>',
            responsive: [{
                breakpoint: 575,
                settings: {
                    arrows: false,
                    dots: true,
                },
            }, ],
        });
        $(".blog-slider").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            centerMode: true,
            arrows: false,
            dots: true,
            speed: 300,
            centerPadding: "55px",
            infinite: true,
            autoplay: true,
            responsive: [{
                    breakpoint: 768,
                    settings: {
                        centerPadding: "40px",
                    },
                },
                {
                    breakpoint: 575,
                    settings: {
                        centerPadding: "0",
                    },
                },
            ],
        });
        @if ($vcard->services_slider_view)
            $('.services-slider-view').slick({
                dots: true,
                infinite: true,
                speed: 300,
                centerMode: true,
                centerPadding: '60px',
                slidesToShow: 1,
                autoplay: false,
                slidesToScroll: 1,
                arrows: false,
                adaptiveHeight: true,
                responsive: [{
                    breakpoint: 500,
                    settings: {
                        centerMode: false,
                    },
                }, ],
            });
        @endif
        $(".iframe-slider").slick({
            arrows: false,
            infinite: true,
            dots: true,
            slidesToShow: 1,
            autoplay: true,
            responsive: [{
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    arrows: false,
                },
            }, ],
        });
    });
</script>
<script>
    let isEdit = false
    let password = "{{ isset(checkFeature('advanced')->password) && !empty($vcard->password) }}"
    let passwordUrl = "{{ route('vcard.password', $vcard->id) }}";
    let enquiryUrl = "{{ route('enquiry.store', ['vcard' => $vcard->id, 'alias' => $vcard->url_alias]) }}";
    let appointmentUrl = "{{ route('appointment.store', ['vcard' => $vcard->id, 'alias' => $vcard->url_alias]) }}";
    let slotUrl = "{{ route('appointment-session-time', $vcard->url_alias) }}";
    let appUrl = "{{ config('app.url') }}";
    let vcardId = {{ $vcard->id }};
    let vcardAlias = "{{ $vcard->url_alias }}";
    let languageChange = "{{ url('language') }}";
    let paypalUrl = "{{ route('paypal.init') }}"
    let lang = "{{ checkLanguageSession($vcard->url_alias) }}";
    let userDateFormate = "{{ getSuperAdminSettingValue('datetime_method') ?? 1 }}";
    let userlanguage = "{{ getLanguage($vcard->default_language) }}"
</script>
<script>
    const qrCodeTwentynine = document.getElementById("qr-code-twentynine");
    const svg = qrCodeTwentynine.querySelector("svg");
    const blob = new Blob([svg.outerHTML], {
        type: 'image/svg+xml'
    });
    const url = URL.createObjectURL(blob);
    const image = document.createElement('img');
    image.src = url;
    image.addEventListener('load', () => {
        const canvas = document.createElement('canvas');
        canvas.width = canvas.height = {{ $vcard->qr_code_download_size }};
        const context = canvas.getContext('2d');
        context.drawImage(image, 0, 0, canvas.width, canvas.height);
        const link = document.getElementById('qr-code-btn');
        link.href = canvas.toDataURL();
        URL.revokeObjectURL(url);
    });
</script>
@routes
<script src="{{ asset('messages.js') }}"></script>
<script src="{{ mix('assets/js/custom/helpers.js') }}"></script>
<script src="{{ mix('assets/js/custom/custom.js') }}"></script>
<script src="{{ mix('assets/js/vcards/vcard-view.js') }}"></script>
<script src="{{ mix('assets/js/lightbox.js') }}"></script>
<script src="{{ asset('/sw.js') }}"></script>
<script>
    if ("serviceWorker" in navigator) {
        // Register a service worker hosted at the root of the
        // site using the default scope.
        navigator.serviceWorker.register("/sw.js").then(
            (registration) => {
                console.log("Service worker registration succeeded:", registration);
            },
            (error) => {
                console.error(`Service worker registration failed: ${error}`);
            },
        );
    } else {
        console.error("Service workers are not supported.");
    }
</script>
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" defer></script>

</html>
