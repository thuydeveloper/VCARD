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
    <meta name="theme-color" content="#6777ef"/>
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="manifest" href="{{ asset('pwa/1.json') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ getFaviconUrl() }}" type="image/png">

    {{-- css link --}}
    <link rel="stylesheet" href="{{ asset('assets/css/vcard17.css') }}">
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
        @if(checkFeature('password'))
        @include('vcards.password')
        @endif
        <div class="main-content mx-auto w-100 overflow-hidden border @if (getLanguage($vcard->default_language) == 'Arabic') rtl @endif">
            {{-- support banner --}}
            @if ((isset($managesection) && $managesection['banner']) || empty($managesection))
                @if(isset($banners->title))
                    <div class="support-banner d-flex align-items-center justify-content-center">
                        <button type="button" class="text-start banner-close"><i class="fa-solid fa-xmark"></i></button>
                        <div class="">
                            <h1 class="text-center support_heading">{{ $banners->title }}</h1>
                            <p class="text-center text-dark support_text">{{ $banners->description }}</p>
                            <div class="text-center">
                                <a href="{{ $banners->url }}" class="act-now" target="blank" data-turbo="false">{{ $banners->banner_button }}</a>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            <div class="banner-section position-relative">
                <div class="banner-img">
                    @if (strpos($vcard->cover_url, '.mp4') !== false || strpos($vcard->cover_url, '.mov') !== false || strpos($vcard->cover_url, '.avi') !== false)
                    <video class="cover-video w-100 h-100 object-fit-cover" loop autoplay muted playsinline  alt="background video" id="cover-video">
                        <source src="{{ $vcard->cover_url }}" type="video/mp4">
                    </video>
                    @else
                    <img src="{{ $vcard->cover_url }}" class="w-100 h-100 object-fit-cover" loading="lazy"/>
                    @endif
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
                                                                    <img src="{{ asset($imageValue) }}"
                                                                        class="me-1" />
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
            </div>
            <div class="profile-section px-30">
                <div class="profile-bg">
                    <img src="{{ asset('assets/img/vcard17/profile-bg.png') }}" loading="lazy"/>
                </div>
                <div class="profile-bg-vector">
                    <img src="{{ asset('assets/img/vcard17/profile-bg-vector.png') }}" loading="lazy"/>
                </div>
                <div class="tag-img">
                    <img src="{{ asset('assets/img/vcard17/tag.png') }}" loading="lazy"/>
                </div>
                <div class="card align-items-center mb-3 pb-3">
                    <div class="card-img d-flex justify-content-center align-items-center">
                        <img src="{{ $vcard->profile_url }}" class="w-100 h-100 object-fit-cover" loading="lazy"/>
                    </div>
                    <div class="card-body pt-30 pb-0 px-0 text-center">
                        <div class="profile-name">
                            <h4 class="text-primary mb-0 fw-bold">
                                {{ ucwords($vcard->first_name . ' ' . $vcard->last_name) }}
                                @if ($vcard->is_verified)
                                <i class="verification-icon bi-patch-check-fill"></i>
                                @endif
                            </h4>
                            <p class="fs-18 text-gray-300 mb-0 fw-5">{{ ucwords($vcard->occupation) }}</p>
                            <p class="fs-18 text-gray-300 mb-0 fw-5">{{ ucwords($vcard->job_title) }}</p>
                            <p class="fs-18 text-gray-300 mb-0 fw-5">{{ ucwords($vcard->company) }}</p>
                        </div>
                    </div>
                </div>
                {{-- social media icon --}}
                <div class="vcard-seventeen__social pt-0 py-3 px-sm-3 px-2 position-relative mt-0">
                    @if (checkFeature('social_links') && getSocialLink($vcard))
                        <div
                            class="social-icons d-flex justify-content-center text-decoration-none flex-wrap text-primary bg-gray-100 rounded-pill">
                            @foreach (getSocialLink($vcard) as $value)
                                <span
                                    class="social-back d-flex text-decoration-none bg-gray-100 justify-content-center align-items-center m-sm-2 m-1 text-primary rounded-circle">
                                    {!! $value !!}
                                </span>
                            @endforeach
                        </div>
                    @endif
                </div>
                {{-- profile --}}
                <div class="text-center">
                <p class="text-gray-300 mb-0 text-center profile-desc mt-3">
                    {!! $vcard->description !!}
                </p>
            </div>
            </div>
            @if ((isset($managesection) && ($managesection['contact_list'])) || empty($managesection))
            @if(getLanguage($vcard->default_language) != 'Arabic')
            <div class="contact-section pb-5">
                <div class="px-30">
                    <div class="row">
                        @if ($vcard->email)
                            <div class="col-sm-6 mb-sm-5 mb-40 px-3">
                                <div class="contact-box mb-sm-2">
                                    <div class="contact-icon d-flex justify-content-center align-items-center bg-pink">
                                        <img src="{{ asset('assets/img/vcard17/email.png') }}" />
                                    </div>
                                    <div class="contact-desc">
                                        <p class="text-gray-300 mb-0 fs-12 fw-6">
                                            {{ __('messages.admin.email') }}</p>
                                        <a href="mailto:{{ $vcard->email }}"
                                            class="text-primary fs-14 fw-5">{{ $vcard->email }}</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($vcard->alternative_email)
                            <div class="col-sm-6 mb-sm-5 mb-40 px-3">
                                <div class="contact-box mb-sm-2">
                                    <div class="contact-icon d-flex justify-content-center align-items-center bg-pink">
                                        <img src="{{ asset('assets/img/vcard17/email.png') }}" />
                                    </div>
                                    <div class="contact-desc">
                                        <p class="text-gray-300 mb-0 fs-12 fw-6">
                                            {{ __('messages.vcard.alter_email_address') }}</p>
                                        <a href="mailto:{{ $vcard->alternative_email }}"
                                            class="text-primary fs-14 fw-5">{{ $vcard->alternative_email }}</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($vcard->phone)
                            <div class="col-sm-6 mb-sm-5 mb-40 px-3">
                                <div class="contact-box mb-sm-2">
                                    <div
                                        class="contact-icon d-flex justify-content-center align-items-center bg-orange">
                                        <img src="{{ asset('assets/img/vcard17/phone.png') }}" />
                                    </div>
                                    <div class="contact-desc">
                                        <p class="text-gray-300 mb-0 fs-12 fw-6">
                                            {{ __('messages.vcard.mobile_number') }} </p>
                                        <a href="tel:+{{ $vcard->region_code }}{{ $vcard->phone }}"
                                            class="text-primary fs-14 fw-5">+{{ $vcard->region_code }}
                                            {{ $vcard->phone }}</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($vcard->alternative_phone)
                            <div class="col-sm-6 mb-sm-5 mb-40 px-3">
                                <div class="contact-box mb-sm-2">
                                    <div
                                        class="contact-icon d-flex justify-content-center align-items-center bg-orange">
                                        <img src="{{ asset('assets/img/vcard17/phone.png') }}" />
                                    </div>
                                    <div class="contact-desc">
                                        <p class="text-gray-300 mb-0 fs-12 fw-6">
                                            {{ __('messages.vcard.alter_mobile_number') }}</p>
                                        <a href="tel:+{{ $vcard->alternative_region_code }}{{ $vcard->alternative_phone }}"
                                            class="text-primary fs-14 fw-5">+{{ $vcard->alternative_region_code }}
                                            {{ $vcard->alternative_phone }}</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($vcard->dob)
                        <div class="col-sm-6 mb-sm-0 mb-40 px-3">
                            <div class="contact-box">
                                <div class="contact-icon d-flex justify-content-center align-items-center bg-blue">
                                    <img src="{{ asset('assets/img/vcard17/dob-icon.png') }}" />
                                </div>
                                <div class="contact-desc">
                                    <p class="text-gray-300 mb-0 fs-12 fw-6">{{ __('messages.vcard.dob') }}</p>
                                    <p class="text-primary fs-14 fw-5 mb-0">
                                        {{ $vcard->dob }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if ($vcard->location)
                            <div class="col-sm-6 px-3">
                                <div class="contact-box">
                                    <div
                                        class="contact-icon d-flex justify-content-center align-items-center bg-purple">
                                        <img src="{{ asset('assets/img/vcard17/location.png') }}" />
                                    </div>
                                    <div class="contact-desc">
                                        <p class="text-gray-300 mb-0 fs-12 fw-6">{{ __('messages.setting.address') }}
                                        </p>
                                        <p class="text-primary fs-14 fw-5 mb-0">{!! ucwords($vcard->location) !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(getLanguage($vcard->default_language) == 'Arabic')
            <div class="contact-section pb-5" dir="rtl">
                <div class="px-30">
                    <div class="row">
                        @if ($vcard->email)
                            <div class="col-sm-6 mb-sm-5 mb-40 px-3">
                                <div class="contact-box mb-sm-2">
                                    <div class="contact-icon d-flex justify-content-center align-items-center bg-pink">
                                        <img src="{{ asset('assets/img/vcard17/email.png') }}" />
                                    </div>
                                    <div class="contact-desc">
                                        <p class="text-gray-300 mb-0 fs-12 fw-6">
                                            {{ __('messages.admin.email') }}</p>
                                        <a href="mailto:{{ $vcard->email }}"
                                            class="text-primary fs-14 fw-5">{{ $vcard->email }}</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($vcard->alternative_email)
                            <div class="col-sm-6 mb-sm-5 mb-40 px-3">
                                <div class="contact-box mb-sm-2">
                                    <div class="contact-icon d-flex justify-content-center align-items-center bg-pink">
                                        <img src="{{ asset('assets/img/vcard17/email.png') }}" />
                                    </div>
                                    <div class="contact-desc">
                                        <p class="text-gray-300 mb-0 fs-12 fw-6">
                                            {{ __('messages.vcard.alter_email_address') }}</p>
                                        <a href="mailto:{{ $vcard->alternative_email }}"
                                            class="text-primary fs-14 fw-5">{{ $vcard->alternative_email }}</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($vcard->phone)
                            <div class="col-sm-6 mb-sm-5 mb-40 px-3">
                                <div class="contact-box mb-sm-2">
                                    <div
                                        class="contact-icon d-flex justify-content-center align-items-center bg-orange">
                                        <img src="{{ asset('assets/img/vcard17/phone.png') }}" />
                                    </div>
                                    <div class="contact-desc">
                                        <p class="text-gray-300 mb-0 fs-12 fw-6">
                                            {{ __('messages.vcard.mobile_number') }} </p>
                                        <a href="tel:+{{ $vcard->region_code }}{{ $vcard->phone }}"
                                            class="text-primary fs-14 fw-5">+{{ $vcard->region_code }}
                                            {{ $vcard->phone }}</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($vcard->alternative_phone)
                            <div class="col-sm-6 mb-sm-5 mb-40 px-3">
                                <div class="contact-box mb-sm-2">
                                    <div
                                        class="contact-icon d-flex justify-content-center align-items-center bg-orange">
                                        <img src="{{ asset('assets/img/vcard17/phone.png') }}" />
                                    </div>
                                    <div class="contact-desc">
                                        <p class="text-gray-300 mb-0 fs-12 fw-6">
                                            {{ __('messages.vcard.alter_mobile_number') }}</p>
                                        <a href="tel:+{{ $vcard->alternative_region_code }}{{ $vcard->alternative_phone }}"
                                            class="text-primary fs-14 fw-5">+{{ $vcard->alternative_region_code }}
                                            {{ $vcard->alternative_phone }}</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($vcard->dob)
                        <div class="col-sm-6 mb-sm-0 mb-40 px-3">
                            <div class="contact-box">
                                <div class="contact-icon d-flex justify-content-center align-items-center bg-blue">
                                    <img src="{{ asset('assets/img/vcard17/dob-icon.png') }}" />
                                </div>
                                <div class="contact-desc">
                                    <p class="text-gray-300 mb-0 fs-12 fw-6">{{ __('messages.vcard.dob') }}</p>
                                    <p class="text-primary fs-14 fw-5 mb-0">
                                        {{ $vcard->dob }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if ($vcard->location)
                            <div class="col-sm-6 px-3">
                                <div class="contact-box">
                                    <div
                                        class="contact-icon d-flex justify-content-center align-items-center bg-purple">
                                        <img src="{{ asset('assets/img/vcard17/location.png') }}" />
                                    </div>
                                    <div class="contact-desc">
                                        <p class="text-gray-300 mb-0 fs-12 fw-6">{{ __('messages.setting.address') }}
                                        </p>
                                        <p class="text-primary fs-14 fw-5 mb-0">{!! ucwords($vcard->location) !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @endif
            {{-- qr code --}}
            @if (isset($vcard['show_qr_code']) && $vcard['show_qr_code'] == 1)
                <div class="qr-code-section pt-60">
                    <div class="qr-bg-img">
                        <img src="{{ asset('assets/img/vcard17/qr-bg-img.png') }}" loading="lazy"/>
                    </div>
                    <div class="code-img">
                        <img src="{{ asset('assets/img/vcard17/code.png') }}" loading="lazy"/>
                    </div>
                    <div class="section-heading text-center pb-40 mb-40">
                        <h2 class="text-primary">{{ __('messages.vcard.qr_code') }}</h2>
                    </div>
                    <div class="px-30">
                        <div class="qr-code mt-3 mx-auto position-relative">
                            <div class="qr-profile-img">
                                <img src="{{ $vcard->profile_url }}" class="w-100 h-100 object-fit-cover" loading="lazy"/>
                            </div>
                            <div class="qr-code-img mx-auto" id="qr-code-seventeen">
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
                </div>
            @endif

            {{-- our service --}}
            @if ((isset($managesection) && ($managesection['services'])) || empty($managesection))
            @if (checkFeature('services') && $vcard->services->count())
                <div class="our-services-section px-30 pt-60">
                    <div class="section-heading text-center mb-40">
                        <h2 class="text-primary">{{ __('messages.vcard.our_service') }}</h2>
                    </div>
                    <div class="services">
                        @if ($vcard->services_slider_view)
                        <div class="row services-slider-view">
                            @foreach ($vcard->services as $service)
                                <div>
                                    <div
                                        class="service-card my-1 h-100">
                                            <a href="{{ $service->service_url ?? 'javascript:void(0)' }}"
                                                class="text-decoration-none img {{ $service->service_url ? 'pe-auto' : 'pe-none' }}"
                                                target="{{ $service->service_url ? '_blank' : '' }}">
                                                <img src="{{ $service->service_icon }}"
                                                    class="card-img-top service-new-image" alt="{{ $service->name }}"
                                                    loading="lazy">
                                            </a>
                                        <div class="">
                                            <a href="{{ $service->service_url ?? 'javascript:void(0)' }}"
                                                class="text-decoration-none"
                                                target="{{ $service->service_url ? '_blank' : '' }}">
                                                    <h5 class="card-title title-text">{{ ucwords($service->name) }}</h5>
                                            </a>
                                            <p
                                                class="card-text description-text {{ \Illuminate\Support\Str::length($service->description) > 80 ? 'more' : '' }}">
                                                {!! $service->description !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @else
                        <div class="row">
                            @foreach ($vcard->services as $service)
                                <div class="col-12 mb-40">
                                    <div class="service-card d-flex flex-row" @if(getLanguage($vcard->default_language) == 'Arabic') dir="rtl" @endif>
                                        <div
                                            class="card-img d-flex justify-content-center align-items-center me-sm-4 me-3 ms-3">
                                            <a href="{{ $service->service_url ?? 'javascript:void(0)' }}"
                                                class="w-100 h-100 text-decoration-none {{ $service->service_url ? 'pe-auto' : 'pe-none' }}"
                                                target="{{ $service->service_url ? '_blank' : '' }}">
                                                <img src="{{ $service->service_icon }}"
                                                    class="card-img-top service-new-image w-100 h-100 object-fit-cover"
                                                    alt="{{ $service->name }}" loading="lazy">
                                            </a>
                                        </div>
                                        <div class="card-body p-0">
                                            <h3 class="card-title fs-18 text-primary">{{ ucwords($service->name) }}
                                            </h3>
                                            <p
                                                class="mb-0 text-gray-300 {{ \Illuminate\Support\Str::length($service->description) > 80 ? 'more' : '' }}">
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
            {{-- gallery --}}
            @if ((isset($managesection) && ($managesection['galleries'])) || empty($managesection))
            @if (checkFeature('gallery') && $vcard->gallery->count())
                <div class="gallery-section mt-4 px-sm-0">
                    <div class="phyton-img">
                        <img src="{{ asset('assets/img/vcard17/phyton.png') }}" loading="lazy"/>
                    </div>
                    <div class="section-heading text-center mb-40">
                        <h2 class="text-primary">{{ __('messages.plan.gallery') }}</h2>
                    </div>
                    <div class="">
                        <div class="gallery-slider">
                            @foreach ($vcard->gallery as $file)
                                @php
                                    $infoPath = pathinfo(public_path($file->gallery_image));
                                    $extension = $infoPath['extension'];
                                @endphp
                                <div class="slide">
                                    <div class="gallery-img">
                                        @if ($file->type == App\Models\Gallery::TYPE_IMAGE)
                                            <a href="{{ $file->gallery_image }}" data-lightbox="gallery-images"><img
                                                    src="{{ $file->gallery_image }}" alt="profile"
                                                    class="w-100" loading="lazy"/></a>
                                        @elseif($file->type == App\Models\Gallery::TYPE_FILE)
                                            <a id="file_url" href="{{ $file->gallery_image }}"
                                                class="gallery-link gallery-file-link" target="_blank" loading="lazy">
                                                <div class="gallery-item gallery-file-item"
                                                    @if ($extension == 'pdf') style="background-image: url({{ asset('assets/images/pdf-icon.png') }})"> @endif
                                                    @if ($extension == 'xls') style="background-image: url({{ asset('assets/images/xls.png') }})"> @endif
                                                    @if ($extension == 'csv') style="background-image: url({{ asset('assets/images/csv-file.png') }})"> @endif
                                                    @if ($extension == 'xlsx') style="background-image: url({{ asset('assets/images/xlsx.png') }})"> @endif
                                                    </div>
                                            </a>
                                        @elseif($file->type == App\Models\Gallery::TYPE_VIDEO)
                                            <div class="d-flex align-items-center video-container">
                                                <video width="100%" height="100%" controls>
                                                    <source src="{{ $file->gallery_image }}">
                                                </video>
                                            </div>
                                        @elseif($file->type == App\Models\Gallery::TYPE_AUDIO)
                                            <div class="audio-container mt-2">
                                                <img src="{{ asset('assets/img/music.jpeg') }}" alt="Album Cover"
                                                    class="audio-image">
                                                <audio controls src="{{ $file->gallery_image }}" class="mt-2">
                                                    Your browser does not support the <code>audio</code> element.
                                                </audio>
                                            </div>
                                        @else
                                            <iframe src="https://www.youtube.com/embed/{{ YoutubeID($file->link) }}"
                                                class="w-100" height="315">
                                            </iframe>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            @endif
            {{-- product --}}
            @if ((isset($managesection) && ($managesection['products'])) || empty($managesection))
            @if (checkFeature('products') && $vcard->products->count())
                <div class="product-section pt-60">
                    <div class="java-img">
                        <img src="{{ asset('assets/img/vcard17/java.png') }}" loading="lazy"/>
                    </div>
                    <div class="section-heading text-center mb-40">
                        <h2 class="text-primary fw-bold">{{ __('messages.plan.products') }}</h2>
                    </div>
                    <div class="product-slider pt-2">
                        @foreach ($vcardProducts as $product)
                            <div>
                                <a @if ($product->product_url) href="{{ $product->product_url }}" @endif
                                    target="_blank" class="text-decoration-none fs-6">
                                    <div class="card product-card">
                                        <div class="card-img">
                                            <img src="{{ $product->product_icon }}"
                                                class="h-100 w-100 object-fit-contain" loading="lazy"/>
                                        </div>
                                        <div class="bg-primary-light card-body">
                                            <div class="d-flex justify-content-between">
                                                <div class="product-title">
                                                    <h3 class="text-primary fs-18 fw-5">{{ $product->name }}</h3>
                                                </div>
                                                @if ($product->currency_id && $product->price)
                                                    <span
                                                        class="fs-18 fw-6 text-primary">{{ $product->currency->currency_icon }}{{ number_format($product->price, 2) }}</span>
                                                @elseif($product->price)
                                                    <span class="fs-18 fw-6 text-primary">{{ getUserCurrencyIcon($vcard->user->id) .' '. $product->price }}</span>
                                                @endif
                                            </div>
                                            <p class="text-gray-300 mb-0">
                                                {{ $product->description }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center mb-5 me-3 ms-3">
                            <a class="mb-0 text-decoration-underline p-2 text-dark view-more"
                                href="{{ route('showProducts', ['id' => $vcard->id, 'alias' => $vcard->url_alias]) }}">{{ __('messages.analytics.view_more') }}</a>
                    </div>
                </div>
            @endif
            @endif
            {{-- testimonial --}}
            @if ((isset($managesection) && ($managesection['testimonials'])) || empty($managesection))
            @if (checkFeature('testimonials') && $vcard->testimonials->count())
                <div class="testimonial-section pb-5">
                    <div class="section-heading text-center my-5">
                        <h2 class="text-primary">{{ __('messages.plan.testimonials') }}</h2>
                    </div>
                    <div class="bg">
                        <div class="testimonial-bg">
                            <img src="{{ asset('assets/img/vcard17/testimonial-bg.png') }}"
                                class="w-100 h-100 object-fit-cover" loading="lazy"/>
                        </div>
                        <div class="testimonial-slider mb-0">
                            @foreach ($vcard->testimonials as $testimonial)
                                <div class="d-flex align-items-end">
                                    <div class="card">
                                        <div class="card-img">
                                            <img src="{{ $testimonial->image_url }}"
                                                class="w-100 h-100 object-fit-cover" loading="lazy"/>
                                        </div>
                                        <div class="card-body text-center">
                                            <h4 class="text-primary fs-6">{{ ucwords($testimonial->name) }}</h4>
                                            <p
                                                class="text-dark-300  mb-0 {{ \Illuminate\Support\Str::length($testimonial->description) > 80 ? 'more' : '' }}">
                                                {!! $testimonial->description !!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            @endif
            {{-- insta feed --}}
            @if ((isset($managesection) && $managesection['insta_embed']) || empty($managesection))
            @if (checkFeature('insta_embed') && $vcard->instagramEmbed->count())
            <div class="mt-5">
            <div class="section-heading text-center mb-5">
                        <h2 class="text-primary">{{ __('messages.feature.insta_embed') }}</h2>
                    </div>
                <nav>
                <div class="row insta-toggle">
                <div class="nav nav-tabs border-0 px-0" id="nav-tab" role="tablist">
                    <button class="d-flex align-items-center justify-content-center py-2 active postbtn instagram-btn border-0 text-dark" id="nav-home-tab"
                        data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab"
                        aria-controls="nav-home" aria-selected="true">
                        <svg aria-label="Posts" class="svg-post-icon x1lliihq x1n2onr6 x173jzuc" fill="currentColor" height="24" role="img" viewBox="0 0 24 24" width="24">
                            <title>Posts</title>
                            <rect fill="none" height="18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" width="18" x="3" y="3"></rect>
                            <line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="9.015" x2="9.015" y1="3" y2="21"></line>
                            <line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="14.985" x2="14.985" y1="3" y2="21"></line>
                            <line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="21" x2="3" y1="9.015" y2="9.015"></line>
                            <line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="21" x2="3" y1="14.985" y2="14.985"></line>
                        </svg>
                        </button>
                    <button class="d-flex align-items-center justify-content-center py-2 instagram-btn reelsbtn border-0 text-dark" id="nav-profile-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                        aria-selected="false">
                        <svg class="svg-reels-icon" viewBox="0 0 48 48" width="27" height="27">
                            <path d="m33,6H15c-.16,0-.31,0-.46.01-.7401.04-1.46.17-2.14.38-3.7,1.11-6.4,4.55-6.4,8.61v18c0,4.96,4.04,9,9,9h18c4.96,0,9-4.04,9-9V15c0-4.96-4.04-9-9-9Zm7,27c0,3.86-3.14,7-7,7H15c-3.86,0-7-3.14-7-7V15c0-3.37,2.39-6.19,5.57-6.85.46-.1.94-.15,1.43-.15h18c3.86,0,7,3.14,7,7v18Z" fill="currentColor" class="color000 svgShape not-active-svg"></path>
                            <path d="M21 16h-2.2l-.66-1-4.57-6.85-.76-1.15h2.39l.66 1 4.67 7 .3.45c.11.17.17.36.17.55zM34 16h-2.2l-.66-1-4.67-7-.66-1h2.39l.66 1 4.67 7 .3.45c.11.17.17.36.17.55z" fill="currentColor" class="color000 svgShape not-active-svg"></path>
                            <rect width="36" height="3" x="6" y="15" fill="currentColor" class="color000 svgShape"></rect><path d="m20,35c-.1753,0-.3506-.0459-.5073-.1382-.3052-.1797-.4927-.5073-.4927-.8618v-10c0-.3545.1875-.6821.4927-.8618.3066-.1797.6831-.1846.9932-.0122l9,5c.3174.1763.5142.5107.5142.874s-.1968.6978-.5142.874l-9,5c-.1514.084-.3188.126-.4858.126Zm1-9.3003v6.6006l5.9409-3.3003-5.9409-3.3003Z" fill="currentColor" class="color000 svgShape not-active-svg"></path>
                            <path d="m6,33c0,4.96,4.04,9,9,9h18c4.96,0,9-4.04,9-9v-16H6v16Zm13-9c0-.35.19-.68.49-.86.31-.18.69-.19,1-.01l9,5c.31.17.51.51.51.87s-.2.7-.51.87l-9,5c-.16.09-.3199.13-.49.13-.18,0-.35-.05-.51-.14-.3-.18-.49-.51-.49-.86v-10Zm23-9c0-4.96-4.04-9-9-9h-5.47l6,9h8.47Zm-10.86,0l-6.01-9h-10.13c-.16,0-.31,0-.46.01l5.99,8.99h10.61ZM12.4,6.39c-3.7,1.11-6.4,4.55-6.4,8.61h12.14l-5.74-8.61Z" fill="currentColor" class="color000 svgShape active-svg"></path>
                        </svg>
                    </button>
                </div>
                </div>
            </nav>
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
        </div>
            @endif
            @endif
            {{-- blog --}}
            @if ((isset($managesection) && ($managesection['blogs'])) || empty($managesection))
            @if (checkFeature('blog') && $vcard->blogs->count())
                <div class="blog-section pt-2 pb-5">
                    <div class="c-language-img">
                        <img src="{{ asset('assets/img/vcard17/c++.png') }}" loading="lazy"/>
                    </div>
                    <div class="section-heading text-center mb-40">
                        <h2 class="text-primary">{{ __('messages.feature.blog') }}</h2>
                    </div>
                    <div class="blog-slider pt-3 mt-3">
                        @foreach ($vcard->blogs as $blog)
                            <div class="">
                                <div class="blog-card blog-1 card">
                                    <div class="card-img">
                                        <div class="overlay">
                                            <a href="{{ route('vcard.show-blog', [$vcard->url_alias, $blog->id]) }}">
                                                <img src="{{ $blog->blog_icon }}" alt="profile"
                                                    class="h-100 w-100 blog-img" loading="lazy"/>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body d-flex flex-column justify-content-end">
                                        <a href="{{ route('vcard.show-blog', [$vcard->url_alias, $blog->id]) }}">
                                            <h6 class="card-title text-blue fw-5 fs-20">{{ $blog->title }}</h6>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            @endif
            {{-- buisness hours --}}
            @if ((isset($managesection) && ($managesection['business_hours'])) || empty($managesection))
            @if ($vcard->businessHours->count())
                @php
                    $todayWeekName = strtolower(\Carbon\Carbon::now()->rawFormat('D'));
                @endphp
                <div class="business-hour-section pt-2 px-30 mb-3"  @if(getLanguage($vcard->default_language) == 'Arabic') dir="rtl" @endif>
                    <div class="section-heading text-center mb-40">
                        <h2 class="text-primary">{{ __('messages.business.business_hours') }}</h2>
                    </div>
                    <div class="">
                        <div class="business-hour-card mt-40">
                            <div class="row">
                                @foreach ($businessDaysTime as $key => $dayTime)
                                    <div class="col-12 d-flex justify-content-between mb-2">
                                        <span
                                            class="me-2">{{ __('messages.business.' . \App\Models\BusinessHour::DAY_OF_WEEK[$key]) }}
                                            : </span>
                                        <span
                                            class="text-center">{{ $dayTime ?? __('messages.common.closed') }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @endif
            {{-- make appointment --}}
            @if ((isset($managesection) && ($managesection['appointments'])) || empty($managesection))
            @if (checkFeature('appointments') && $vcard->appointmentHours->count())
                <div class="appointment-section pt-60 pb-60 px-30">
                    <div class="appointment-bg">
                        <img src="{{ asset('assets/img/vcard17/appointment-bg.png') }}" loading="lazy"/>
                    </div>
                    <div class="html-img">
                        <img src="{{ asset('assets/img/vcard17/html.png') }}" loading="lazy"/>
                    </div>
                    <div class="php-tag">
                        <img src="{{ asset('assets/img/vcard17/php.png') }}" loading="lazy"/>
                    </div>
                    <div class="section-heading text-center mb-40">
                        <h2 class="text-primary">{{ __('messages.make_appointments') }}</h2>
                    </div>
                    <div class="appointment">
                        <div class="mb-20">
                            <label for="date"
                                class="appoint-date text-primary fs-20 fw-5 mb-2">{{ __('messages.date') }} :</label>
                            <div class="position-relative">
                                {{ Form::text('date', null, ['class' => 'date appoint-input form-control bg-white appointment-input', 'placeholder' => __('messages.form.pick_date'), 'id' => 'pickUpDate']) }}
                                <span class="calendar-icon">
                                    <img src="{{ asset('assets/img/vcard17/Vector.png') }}" loading="lazy"/>
                                </span>
                            </div>
                        </div>
                        <div class="">
                            <label class="text-primary fs-20 fw-5 mb-2">{{ __('messages.hour') }} :</label>
                            <div class="mb-20">
                                <div id="slotData" class="row">
                                </div>

                            </div>
                            <div class="text-center">
                                <button type="submit"
                                    class="appointmentAdd rounded-2 appoint-btn btn btn-primary w-100">
                                    {{ __('messages.make_appointments') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @include('vcardTemplates.appointment')
            @endif
            @endif

            {{-- iframes --}}
            @if ((isset($managesection) && $managesection['iframe']) || empty($managesection))
            @if (checkFeature('iframes') && $vcard->iframes->count())
            <div class="blog-section  pb-30 mb-3">
                <div class="c-language-img">
                    <img src="{{ asset('assets/img/vcard17/c++.png') }}" loading="lazy"/>
                </div>
                <div class="section-heading text-center mb-40">
                    <h2 class="text-primary">{{ __('messages.vcard.iframe') }}</h2>
                </div>
                <div class="iframe-slider">
                    @foreach ($vcard->iframes as $iframe)
                    <div class="slide">
                            <iframe src="{{ $iframe->url }}" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen width="100%" height="400" loading="lazy">
                            </iframe>
                    </div>
                @endforeach
                </div>
            </div>
        @endif
        @endif

            {{-- contact us --}}
            @php
                $currentSubs = $vcard
                    ->subscriptions()
                    ->where('status', \App\Models\Subscription::ACTIVE)
                    ->latest()
                    ->first();
            @endphp
            @if ($currentSubs && $currentSubs->plan->planFeature->enquiry_form && $vcard->enable_enquiry_form)
                <div class="contact-us-section px-30 mt-3">
                    <div class="section-heading text-center mb-40">
                        <h2 class="text-primary">{{ __('messages.contact_us.inquries') }}</h2>
                    </div>
                    @if(getLanguage($vcard->default_language) != 'Arabic')
                    <div class="contact-form">
                        <div class="contact-icon">
                            <img src="{{ asset('assets/img/vcard17/code.png') }}" />
                        </div>
                        <form action="" id="enquiryForm">
                            @csrf
                            <div class="row">
                                <div id="enquiryError" class="alert alert-danger d-none"></div>
                                <div class="col-12">
                                    <input type="text" name="name" class="form-control"
                                        placeholder="{{ __('messages.form.your_name') }}" />
                                </div>
                                <div class="col-12">
                                    <input type="tel" name="phone" class="form-control"
                                        placeholder="{{ __('messages.form.phone') }}" />
                                </div>
                                <div class="col-12">
                                    <input type="email" name="email" class="form-control"
                                        placeholder="{{ __('messages.form.your_email') }}" />
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control h-100" name="message" placeholder="{{ __('messages.form.type_message') }}"
                                        rows="3"></textarea>
                                </div>
                                @if (!empty($vcard->privacy_policy) || !empty($vcard->term_condition))
                                    <div class="col-12 mt-2">
                                        <input type="checkbox" name="terms_condition"
                                            class="form-check-input terms-condition" id="termConditionCheckbox" placeholder>&nbsp;
                                        <label class="form-check-label" for="privacyPolicyCheckbox">
                                            <span class="text-dark">{{ __('messages.vcard.agree_to_our') }}</span>
                                            <a href="{{ route('vcard.show-privacy-policy', [$vcard->url_alias, $vcard->id]) }}" target="_blank"
                                                class="text-decoration-none link-info fs-6">{!! __('messages.vcard.term_and_condition') !!}</a>
                                            <span class="text-dark">&</span>
                                            <a href="{{ route('vcard.show-privacy-policy', [$vcard->url_alias, $vcard->id]) }}" target="_blank"
                                                class="text-decoration-none link-info fs-6">{{ __('messages.vcard.privacy_policy') }}</a>
                                        </label>
                                    </div>
                                @endif
                                <div class="col-12 text-center mt-4 mb-5">
                                    <button class="btn send-btn contact-btn rounded-2 btn-primary" type="submit">
                                        {{ __('messages.contact_us.send_message') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endif
                    @if(getLanguage($vcard->default_language) == 'Arabic')
                    <div class="contact-form" dir="rtl">
                        <div class="contact-icon">
                            <img src="{{ asset('assets/img/vcard17/code.png') }}" />
                        </div>
                        <form action="" id="enquiryForm">
                            @csrf
                            <div class="row">
                                <div id="enquiryError" class="alert alert-danger d-none"></div>
                                <div class="col-12">
                                    <input type="text" name="name" class="form-control text-start"
                                        placeholder="{{ __('messages.form.your_name') }}" />
                                </div>
                                <div class="col-12">
                                    <input type="tel" name="phone" class="form-control text-start"
                                        placeholder="{{ __('messages.form.phone') }}" />
                                </div>
                                <div class="col-12">
                                    <input type="email" name="email" class="form-control text-start"
                                        placeholder="{{ __('messages.form.your_email') }}" />
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control h-100 text-start" name="message" placeholder="{{ __('messages.form.type_message') }}"
                                        rows="3"></textarea>
                                </div>
                                @if (!empty($vcard->privacy_policy) || !empty($vcard->term_condition))
                                    <div class="col-12 mt-2">
                                        <input type="checkbox" name="terms_condition"
                                            class="form-check-input terms-condition" id="termConditionCheckbox" placeholder>&nbsp;
                                        <label class="form-check-label" for="privacyPolicyCheckbox">
                                            <span class="text-dark">{{ __('messages.vcard.agree_to_our') }}</span>
                                            <a href="{{ route('vcard.show-privacy-policy', [$vcard->url_alias, $vcard->id]) }}" target="_blank"
                                                class="text-decoration-none link-info fs-6">{!! __('messages.vcard.term_and_condition') !!}</a>
                                            <span class="text-dark">&</span>
                                            <a href="{{ route('vcard.show-privacy-policy', [$vcard->url_alias, $vcard->id]) }}" target="_blank"
                                                class="text-decoration-none link-info fs-6">{{ __('messages.vcard.privacy_policy') }}</a>
                                        </label>
                                    </div>
                                @endif
                                <div class="col-12 text-center mt-4 mb-5">
                                    <button class="btn send-btn contact-btn rounded-2 btn-primary" type="submit">
                                        {{ __('messages.contact_us.send_message') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endif
                </div>
            @endif
            {{-- cretae vcard --}}
            @if ($currentSubs && $currentSubs->plan->planFeature->affiliation && $vcard->enable_affiliation)
                <div class="create-vcard-section my-5">
                    <div class="section-heading text-center mb-40">
                        <h2 class="text-primary">{{ __('messages.create_vcard') }}</h2>
                    </div>
                    <div class="px-30 pt-30 pb-30 bg-primary-light">
                        <div class="vcard-link-card card">
                            <div class="d-flex align-items-center justify-content-center">
                                <a target="_blank"
                                    href="{{ route('register', ['referral-code' => $vcard->user->affiliate_code]) }}"
                                    class="text-primary link-text fw-5">{{ route('register', ['referral-code' => $vcard->user->affiliate_code]) }}
                                    <i class="icon fa-solid fa-arrow-up-right-from-square ms-3"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            {{-- map --}}
            @if ((isset($managesection) && ($managesection['map'])) || empty($managesection))
            <div class="container">
                <div class="d-flex  flex-column justify-content-center my-3">
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
            {{-- add to contact --}}
            @if ($vcard->enable_contact)
                <div class="add-to-contact-section px-30">
                    <div class="text-center mb-2" @if(getLanguage($vcard->default_language) == 'Arabic') dir="rtl" @endif>
                        <a href="{{ route('add-contact', $vcard->id) }}"
                            class="vcard17-sticky-btn add-contact-btn  d-flex justify-content-center align-items-center rounded px-5 text-decoration-none py-1  justify-content-center"><i
                                class="fas fa-download fa-address-book"></i>
                            &nbsp;{{ __('messages.setting.add_contact') }}</a>
                    </div>
                </div>
            @endif
            {{-- made by --}}
            <div class="d-flex justify-content-evenly">
                @if (checkFeature('advanced'))
                    @if (checkFeature('advanced')->hide_branding && $vcard->branding == 0)
                        @if ($vcard->made_by)
                            <a @if (!is_null($vcard->made_by_url)) href="{{ $vcard->made_by_url }}" @endif
                                class="text-center text-decoration-none text-dark" target="_blank">
                                <small>{{ __('messages.made_by') }} {{ $vcard->made_by }}</small>
                            </a>
                        @else
                            <div class="text-center">
                                <small class="text-dark">{{ __('messages.made_by') }}
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
                            <small class="text-dark">{{ __('messages.made_by') }}
                                {{ $setting['app_name'] }}</small>
                        </div>
                    @endif
                @endif
                @if (!empty($vcard->privacy_policy) || !empty($vcard->term_condition))
                    <div>
                        <a class="text-decoration-none text-dark cursor-pointer terms-policies-btn"
                            href="{{ route('vcard.show-privacy-policy', [$vcard->url_alias, $vcard->id]) }}"><small>{!! __('messages.vcard.term_policy') !!}</small></a>
                    </div>
                @endif
            </div>
            {{-- sticky btn --}}
            <div class="btn-section cursor-pointer @if (getLanguage($vcard->default_language) == 'Arabic') rtl @endif">
                <div class="fixed-btn-section">
                    @if (empty($vcard->hide_stickybar))
                        <div class="bars-btn developer-bars-btn @if(getLanguage($vcard->default_language) == 'Arabic') vcard-bars-btn-left @endif">
                            <img src="{{ asset('assets/img/vcard17/sticky.png') }}" loading="lazy"/>
                        </div>
                    @endif
                    <div class="sub-btn d-none">
                        <div class="sub-btn-div  @if(getLanguage($vcard->default_language) == 'Arabic') sub-btn-div-left @endif">
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
                                            class="vcard17-sticky-btn vcard17-btn-group d-flex justify-content-center text-dark align-items-center rounded-0 text-decoration-none py-1 rounded-pill justify-content share-wp-btn">
                                            <i class="fa-solid fa-paper-plane"></i> </a>
                                    </div>
                                </div>
                            @endif
                            @if (empty($vcard->hide_stickybar))
                                <div
                                    class="{{ isset($vcard->whatsapp_share) ? 'vcard17-btn-group' : 'stickyIcon' }}">
                                    <button type="button"
                                        class="vcard17-btn-group vcard17-share vcard17-sticky-btn mb-3 px-2 py-1"><i
                                            class="fas fa-share-alt pt-1 fs-4"></i></button>
                                    @if(!empty($vcard->enable_download_qr_code))
                                    <a type="button"
                                        class="vcard17-btn-group vcard17-sticky-btn d-flex justify-content-center text-white align-items-center  px-2 mb-3 py-2"
                                        id="qr-code-btn" download="qr_code.png"><i
                                            class="fa-solid fa-qrcode fs-4 text-dark"></i></a>
                                    @endif
                                    {{-- <a type="button"
                                        class="vcard17-btn-group vcard17-sticky-btn d-flex justify-content-center text-white align-items-center  px-2 mb-3 py-2 d-none"
                                        id="videobtn"><i class="fa-solid fa-video fs-4"
                                            style="color: #eceeed;"></i></a> --}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    @if ((isset($managesection) && $managesection['news_latter_popup']) || empty($managesection))
    <div class="modal fade" id="newsLatterModal" tabindex="-1" aria-labelledby="newsLatterModalLabel" aria-hidden="true">
        <div class="modal-dialog news-modal">
            <div class="modal-content animate-bottom" id="newsLatter-content">
                <div class="newsmodal-header">
                    <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="modal"
                    aria-label="Close" id="closeNewsLatterModal"></button>
                    <h1 class="newsmodal-title text-center mt-5" id="newsLatterModalLabel"><i class="fa-solid fa-envelope-open-text"></i></h1>
                </div>
                <div class="modal-body">
                    <h1 class="content text-center  p-2">{{ __('messages.vcard.subscribe_newslatter') }}</h1>
                    <h3 class="modal-desc text-center">{{ __('messages.vcard.update_directly') }}</h3>
                    <form action="" method="post" id="newsLatterForm">
                    @csrf
                    <input type="hidden" name="vcard_id" value="{{ $vcard->id }}">
                    <div class="input-group mb-3 mt-5">
                        <input type="email" class="text-white form-control bg-dark border-dark" placeholder="{{ __('messages.form.enter_your_email') }}" aria-label="Email" name="email" id="emailSubscription" aria-describedby="button-addon2">
                        <button class="btn" type="submit" id="email-send"><i class="fa-regular fa-envelope"></i></button>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    @endif
    {{-- share modal code --}}
    <div id="vcard17-shareModel" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" @if(getLanguage($vcard->default_language) == 'Arabic') dir="rtl" @endif>
                <div class="">
                    <div class="row align-items-center mt-3">
                        <div class="col-10 text-center">
                            <h5 class="modal-title pl-50">{{ __('messages.vcard.share_my_vcard') }}</h5>
                        </div>
                        <div class="col-2">
                            <button type="button" aria-label="Close"
                                class="btn btn-sm btn-icon btn-active-color-danger border-none p-1"
                                data-bs-dismiss="modal">
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
                                <p class="align-items-center text-dark video">
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

                                <span><svg xmlns="http://www.w3.org/2000/svg" height="2em"
                                        viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                        <path
                                            d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z" />
                                    </svg></span>

                            </div>
                            <div class="col-9 p-1">
                                <p class="align-items-center text-dark">
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
                                <p class="align-items-center text-dark">
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
                                <p class="align-items-center text-dark">
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
                                <p class="align-items-center text-dark">
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
                                <p class="align-items-center text-dark">
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
                                <p class="align-items-center text-dark">
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
                        <div class="input-group">
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
<script src="../js/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/front-third-party.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/slider/js/slick.min.js') }}" type="text/javascript"></script>
@if (checkFeature('seo') && $vcard->google_analytics)
    {!! $vcard->google_analytics !!}
@endif
@if (isset(checkFeature('advanced')->custom_js) && $vcard->custom_js)
    {!! $vcard->custom_js !!}
@endif
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
        $(".product-slider").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            centerMode: true,
            arrows: true,
            dots: false,
            speed: 300,
            centerPadding: "115px",
            infinite: true,
            autoplaySpeed: 5000,
            autoplay: true,
            responsive: [{
                    breakpoint: 575,
                    settings: {
                        centerPadding: "115px",
                        dots: false,
                        arrows: true,
                    },
                },
                {
                    breakpoint: 480,
                    settings: {
                        centerPadding: "0",
                        dots: false,
                        arrows: true,
                    },
                },
            ],
        });
        $(".blog-slider").slick({
            arrows: false,
            infinite: true,
            dots: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            prevArrow: '<button class="slide-arrow prev-arrow"><i class="fa-solid fa-chevron-left"></i></button>',
            nextArrow: '<button class="slide-arrow next-arrow"><i class="fa-solid fa-chevron-right"></i></button>',
            responsive: [{
                breakpoint: 575,
                settings: {
                    dots: true,
                    arrows: false,
                },
            }, ],
        });
        $(".iframe-slider").slick({
            arrows: false,
            infinite: true,
            dots: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: false,
            prevArrow: '<button class="slide-arrow prev-arrow"><i class="fa-solid fa-chevron-left"></i></button>',
            nextArrow: '<button class="slide-arrow next-arrow"><i class="fa-solid fa-chevron-right"></i></button>',
            responsive: [{
                breakpoint: 575,
                settings: {
                    dots: true,
                    arrows: false,
                },
            }, ],
        });
        $(".gallery-slider").slick({
            arrows: true,
            infinite: true,
            dots: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            prevArrow: '<button class="slide-arrow prev-arrow"><i class="fa-solid fa-chevron-left"></i></button>',
            nextArrow: '<button class="slide-arrow next-arrow"><i class="fa-solid fa-chevron-right"></i></button>',
            responsive: [{
                breakpoint: 575,
                settings: {
                    dots: true,
                    arrows: false,
                },
            }, ],
        });
    });
</script>
<script>
    var rev = $(".testimonial-slider");
    rev
        .on("init", function(event, slick, currentSlide) {
            var cur = $(slick.$slides[slick.currentSlide]),
                next = cur.next(),
                prev = cur.prev();
            prev.addClass("slick-sprev");
            next.addClass("slick-snext");
            cur.removeClass("slick-snext").removeClass("slick-sprev");
            slick.$prev = prev;
            slick.$next = next;
        })
        .on("beforeChange", function(event, slick, currentSlide, nextSlide) {
            var cur = $(slick.$slides[nextSlide]);
            slick.$prev.removeClass("slick-sprev");
            slick.$next.removeClass("slick-snext");
            (next = cur.next()), (prev = cur.prev());
            prev.prev();
            prev.next();
            prev.addClass("slick-sprev");
            next.addClass("slick-snext");
            slick.$prev = prev;
            slick.$next = next;
            cur.removeClass("slick-next").removeClass("slick-sprev");
        });

    $(".testimonial-slider").slick({
        speed: 1000,
        arrows: false,
        dots: true,
        infinite: true,
        centerMode: true,
        slidesPerRow: 1,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerPadding: "0",
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
    let userDateFormate = "{{ getSuperAdminSettingValue('datetime_method') ??  1 }}";
    let userlanguage = "{{ getLanguage($vcard->default_language) }}"
</script>
<script>
    const qrCodeSeventeen = document.getElementById("qr-code-seventeen");
    const svg = qrCodeSeventeen.querySelector("svg");
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
