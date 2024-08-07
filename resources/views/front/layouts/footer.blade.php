<!-- start subscribe section -->
{{--<section class="subscribe-section padding-t-100px padding-b-100px">--}}
{{--    <div class="container">--}}
{{--        <div class="subscribe-section__subscribe-inner position-relative rounded-20">--}}
{{--            <div class="position-relative subscribe-section__subscribe-block text-center mx-auto">--}}
{{--                <h2 class="text-white">{{__('auth.subscribe_here')}}</h2>--}}
{{--                <p class="text-blue-100 fs-18">--}}
{{--                  {{__('messages.placeholder.receive_latest_news')}}--}}
{{--                </p>--}}
{{--                <form action="{{route('email.sub')}}" method="post" id="addEmail">--}}
{{--                    @csrf()--}}
{{--                    <div class="subscribe-inputgrp position-relative">--}}
{{--                        <input name="email" type="email" class="form-control" placeholder="{{ __('messages.front.your_email_address') }}">--}}
{{--                        <div class="subscribe-btn d-flex align-items-center">--}}
{{--                            <button type="submit" class="btn btn-primary">{{ __('messages.subscribe') }}</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
<!-- end subscribe section -->


<!-- start footer section -->
{{--<footer>--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-lg-6 col-12  mb-md-5 mb-3 text-center">--}}
{{--                @if($setting['terms_conditions'] !== '' || $setting['privacy_policy'] !== '')--}}
{{--                <h3 class="mb-4 pb-1">{{__('messages.services')}}</h3>--}}
{{--                @endif--}}
{{--                <ul class="ps-0">--}}
{{--                    <li>--}}
{{--                        @if($setting['terms_conditions'] !== '')--}}
{{--                            <a href="{{ route('terms.conditions') }}"--}}
{{--                               class="text-decoration-none  mb-3 d-block fw-light {{ request()->routeIs('terms.conditions') ? 'active' : 'text-secondary' }}">{!! __('messages.vcard.term_condition') !!}</a>--}}
{{--                        @endif--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        @if($setting['privacy_policy'] !== '')--}}
{{--                            <a href="{{ route('privacy.policy') }}"--}}
{{--                               class="text-decoration-none  mb-3 d-block fw-light {{ request()->routeIs('privacy.policy') ? 'active' : 'text-secondary' }}">{{(__('messages.vcard.privacy_policy'))}}</a>--}}
{{--                        @endif--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--           --}}
{{--            <div class=" col-12 {{$setting['terms_conditions'] !== '' || $setting['privacy_policy'] !== '' ? 'col-lg-6' : 'col-12'}} text-center ">--}}
{{--                <h3 class="mb-4 pb-1">{{__('messages.setting.address')}}</h3>--}}
{{--                <div class="footer-info ">--}}
{{--                    <div class="d-flex footer-info__block mb-3 pb-1 text-center justify-content-center">--}}
{{--                        <i class="fa-solid fa-house text-success fs-5 me-3"></i>--}}
{{--                        <a--}}
{{--                                class="text-decoration-none text-secondary fs-6">--}}
{{--                            {{ $setting['address'] }}--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="d-flex align-items-center footer-info__block mb-3 pb-1 text-center justify-content-center">--}}
{{--                        <i class="fa-solid fa-envelope text-success fs-5 me-3"></i>--}}
{{--                        <a href="mailto:{{ $setting['email'] }}"--}}
{{--                           class="text-decoration-none text-secondary fs-6">--}}
{{--                            {{ $setting['email'] }}--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="d-flex align-items-center footer-info__block mb-3 pb-1 text-center justify-content-center">--}}
{{--                        <i class="fa-solid fa-phone text-success fs-5 me-3"></i>--}}
{{--                        <a href="tel:+ {{ $setting['phone'] }}"--}}
{{--                           class="text-decoration-none text-secondary fs-6">--}}
{{--                            {{ $setting['phone'] }}--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--            <div class="container text-center mt-lg-5 copy-right">--}}
{{--                <p class="mb-0 text-gray-100 pt-4">©--}}
{{--                    {{ \Carbon\Carbon::now()->year }}--}}
{{--                    {{__('auth.copyright_by')." "}} <span class="text-success">{{ $setting['app_name'] }}</span></p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</footer>--}}
<!-- end footer section -->



<!-- start subscribe section -->
@if (checkFrontLanguageSession() != 'ar')
<section class="subscribe-section pt-80 pb-80 ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="mb-40">
                    <h2 class="text-dark text-center mb-3">{{__('auth.subscribe_here')}}</h2>
                    <p class="text-gray-400 fs-18"> {{__('messages.placeholder.receive_latest_news')}}
                    </p>
                </div>
                <form action="{{route('email.sub')}}" method="post" id="addEmail">
                    @csrf()
                    <div class="subscribe-inputgrp position-relative">
                        <input name="email" type="email" class="form-control bg-white"
                               placeholder="{{ __('messages.front.enter_your_email') }}">
                        <div class="subscribe-btn d-flex align-items-center">
                            <button type="submit" class="btn btn-pink">{{ __('messages.subscribe') }}</button>
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
        </div>
    </div>
</section>
@else
<section class="subscribe-section-rtl pt-80 pb-80 " dir="rtl">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="mb-40">
                    <h2 class="text-dark text-center mb-3">{{__('auth.subscribe_here')}}</h2>
                    <p class="text-gray-400 fs-18"> {{__('messages.placeholder.receive_latest_news')}}
                    </p>
                </div>
                <form action="{{route('email.sub')}}" method="post" id="addEmail">
                    @csrf()
                    <div class="subscribe-inputgrp position-relative">
                        <input name="email" type="email" class="form-control bg-white"
                               placeholder="{{ __('messages.front.enter_your_email') }}">
                        <div class="subscribe-btn d-flex align-items-center">
                            <button type="submit" class="btn btn-pink">{{ __('messages.subscribe') }}</button>
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
        </div>
    </div>
</section>
@endif
<!-- end subscribe section -->

<!-- start footer section -->
@if (checkFrontLanguageSession() != 'ar')
<footer class="pt-4 pb-4 bg-light">
    <div class="container text-center">
        <div class="row text-center mb-sm-auto mb-0 text-gray-300 fw-5 overflow-hidden">
            <div class="col-6"> © {{ \Carbon\Carbon::now()->year }} {{ __('auth.copyright_by') . ' ' }}<span
                    class="text-blue">{{ $setting['app_name'] }}</span></div>
            <div class="col-6"> <a href="{{ route('terms.conditions') }}" target="_blank"
                    class="text-decoration-none link-info fs-6">{!! __('messages.vcard.term_condition') !!}</a>
              <span class="slash">|</span>
                <a href="{{ route('privacy.policy') }}" target="_blank"
                    class="text-decoration-none link-info fs-6">{{ __('messages.vcard.privacy_policy') }}</a>
            </div>
        </div>
    </div>
    </div>
</footer>
@else
<footer class="pt-4 pb-4 bg-light" dir="rtl">
    <div class="container text-center">
        <div class="row text-center mb-sm-auto mb-0 text-gray-300 fw-5 overflow-hidden">
            <div class="col-6"> © {{ \Carbon\Carbon::now()->year }} {{ __('auth.copyright_by') . ' ' }}<span
                    class="text-blue">{{ $setting['app_name'] }}</span></div>
            <div class="col-6"> <a href="{{ route('terms.conditions') }}" target="_blank"
                    class="text-decoration-none link-info fs-6">{!! __('messages.vcard.term_condition') !!}</a>
              <span class="slash">|</span>
                <a href="{{ route('privacy.policy') }}" target="_blank"
                    class="text-decoration-none link-info fs-6">{{ __('messages.vcard.privacy_policy') }}</a>
            </div>
        </div>
    </div>
    </div>
</footer>
@endif
<!-- end footer section -->

<!--support banner -->
    @if(isset($setting['banner_enable']) && $setting['banner_enable'] == 1)
        <section class="banner-section banner-cookie d-none">
            <div class="main-banner top-0 left-curve-1">
                <img src="{{ asset('/images/hero-bg.png') }}" class="w-100 h-auto" alt="image">
            </div>
            <div class="main-banner close-btn bg-transparent">
                <button type="button" class="border-0 bg-transparent"><i class="fa-solid fa-xmark text-white"></i></button>
            </div>
            <div class="container">
                <div class="row mt-5 pt-4 pb-3">
                    <div class="text-center text-white">
                    <h3>{{ $setting['banner_title'] }}</h3>
                    <p class="">{{ $setting['banner_description'] }}</p>
                    </div>
                    <div class="text-center pt-2">
                        <a href="{{ $setting['banner_url'] }}" class="btn btn-pink act-now " target="blank" data-turbo="false">{{ $setting['banner_button'] }}</a>
                    </div>
                </div>
            </div>
        </section>
    @endif
<!-- end footer section -->
