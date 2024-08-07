    <!-- start header section -->
    @if (checkFrontLanguageSession() != 'ar')
        <header class="header">
            <div class="container" id="frontHomeTab">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-2 col-md-8 col-sm-7 col-5 order-lg-1 order-0">
                        <a class="navbar-brand  p-0" href="#">
                            <img src="{{ getLogoUrl() }}" alt="company-logo" class="w-auto h-100" />
                        </a>
                    </div>
                    <div class="col-lg-10 col-sm-1 col-2 order-lg-1 order-2">
                        <nav class="navbar navbar-expand-lg navbar-light justify-content-end">
                            <div class="navbar-toggler mt-2 nav-btn" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                                aria-label="Toggle navigation" id="toogler-icon">
                                <span class="navbar-toggler-icon top-bar"></span>
                                <span class="navbar-toggler-icon middle-bar"></span>
                                <span class="navbar-toggler-icon bottom-bar"></span>
                            </div>
                            <div class="navbar-collapse justify-content-end new-home-nav d-none" id="navbarNav">
                                <ul class="navbar-nav align-items-lg-center" data-turbo="false">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" data-turbo="false"
                                            href="{{ asset('') . '#frontHomeTab' }}">{{ __('auth.home') }}</a>
                                    </li>
                                    {{-- <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ asset('') . '#frontFeaturesTab' }}">{{ __('auth.features') }}</a>
                                </li> --}}
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ asset('') . '#frontAboutTabUsTab' }}">{{ __('auth.about') }}</a>
                                    </li>
                                    <li class="nav-item @if ($faqs === null) d-none @endif">
                                        <a class="nav-link"
                                            href="{{ route('fornt-faq') }}">{{ __('messages.faqs.faqs') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ asset('') . '#frontPricingTab' }}">{{ __('auth.pricing') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ asset('') . '#frontContactUsTab' }}">{{ __('auth.contact') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <div class="dropdown">
                                            <a class="btn dropdown-toggle" href="#" role="button"
                                                id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
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
                                        <li>
                                            <a class="btn btn-white fs-18 d-lg-block d-none"
                                                href="{{ route('login') }}" role="button"
                                                data-turbo="false">{{ __('auth.sign_in') }}</a>
                                        </li>
                                    @else
                                        @if (getLogInUser()->hasrole('admin') || getLogInUser()->hasrole('user'))
                                            <li>
                                                <a class="btn btn-white fs-18 d-lg-block d-none"
                                                    href="{{ route('admin.dashboard') }}" role="button"
                                                    data-turbo="false">{{ __('messages.dashboard') }}</a>
                                            </li>
                                        @endif
                                        @if (getLogInUser()->hasrole('super_admin'))
                                            <li>
                                                <a class="btn btn-white fs-18 d-lg-block d-none"
                                                    href="{{ route('sadmin.dashboard') }}" role="button"
                                                    data-turbo="false">{{ __('messages.dashboard') }}</a>
                                            </li>
                                        @endif
                                    @endif
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div
                        class="col-lg-2 col-md-3 col-sm-4 col-5 text-end order-lg-2 order-1 pe-lg-2 pe-0 ps-0 d-lg-none">

                        @if (empty(getLogInUser()))
                            <a class="btn btn-white fs-18 me-sm-2" href="{{ route('login') }}" data-turbo="false"
                                role="button">
                                <span>{{ __('auth.sign_in') }}</span>
                            </a>
                        @else
                            @if (getLogInUser()->hasrole('admin') || getLogInUser()->hasrole('user'))
                                <span> <a class="btn btn-white fs-18 me-sm-2" href="{{ route('admin.dashboard') }}"
                                        data-turbo="false" role="button">
                                        {{ __('messages.dashboard') }}
                                    </a></span>
                            @endif
                            @if (getLogInUser()->hasrole('super_admin'))
                                <span><a class="btn btn-white fs-18 me-sm-2" href="{{ route('sadmin.dashboard') }}"
                                        data-turbo="false" role="button">
                                        {{ __('messages.dashboard') }}
                                    </a></span>
                            @endif
                        @endif

                    </div>
                </div>
            </div>
        </header>
    @endif
    <!-- end header section -->
    <!-- start header section -->
    @if (checkFrontLanguageSession() == 'ar')
        <header class="header" dir="rtl">
            <div class="container" id="frontHomeTab">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-2 col-md-8 col-sm-7 col-5 order-lg-1 order-0">
                        <a class="navbar-brand me-0 p-0" href="#">
                            <img src="{{ getLogoUrl() }}" alt="company-logo" class="w-auto h-100" />
                        </a>
                    </div>
                    <div class="col-lg-10 col-sm-1 col-2 order-lg-1 order-2">
                        <nav class="navbar navbar-expand-lg navbar-light justify-content-end">
                            <div class="navbar-toggler mt-2 nav-btn text-dark" type="button"
                                data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav"
                                aria-expanded="false" aria-label="Toggle navigation" id="toogler-icon">
                                <span class="navbar-toggler-icon top-bar bg-dark"></span>
                                <span class="navbar-toggler-icon middle-bar bg-dark"></span>
                                <span class="navbar-toggler-icon bottom-bar bg-dark"></span>
                            </div>
                            <div class="navbar-collapse justify-content-end new-home-nav d-none" id="navbarNav">
                                <ul class="navbar-nav align-items-lg-center" data-turbo="false">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" data-turbo="false"
                                            href="{{ asset('') . '#frontHomeTab' }}">{{ __('auth.home') }}</a>
                                    </li>
                                    {{-- <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ asset('') . '#frontFeaturesTab' }}">{{ __('auth.features') }}</a>
                                </li> --}}
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ asset('') . '#frontAboutTabUsTab' }}">{{ __('auth.about') }}</a>
                                    </li>
                                    <li class="nav-item @if ($faqs === null) d-none @endif">
                                        <a class="nav-link"
                                            href="{{ route('fornt-faq') }}">{{ __('messages.faqs.faqs') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ asset('') . '#frontPricingTab' }}">{{ __('auth.pricing') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ asset('') . '#frontContactUsTab' }}">{{ __('auth.contact') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <div class="dropdown">
                                            <a class="btn dropdown-toggle" href="#" role="button"
                                                id="dropdownMenuLink" data-bs-toggle="dropdown"
                                                aria-expanded="false">
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
                                        <li>
                                            <a class="btn btn-white fs-18 d-lg-block d-none"
                                                href="{{ route('login') }}" role="button"
                                                data-turbo="false">{{ __('auth.sign_in') }}</a>
                                        </li>
                                    @else
                                        @if (getLogInUser()->hasrole('admin') || getLogInUser()->hasrole('user'))
                                            <li>
                                                <a class="btn btn-white fs-18 d-lg-block d-none"
                                                    href="{{ route('admin.dashboard') }}" role="button"
                                                    data-turbo="false">{{ __('messages.dashboard') }}</a>
                                            </li>
                                        @endif
                                        @if (getLogInUser()->hasrole('super_admin'))
                                            <li>
                                                <a class="btn btn-white fs-18 d-lg-block d-none"
                                                    href="{{ route('sadmin.dashboard') }}" role="button"
                                                    data-turbo="false">{{ __('messages.dashboard') }}</a>
                                            </li>
                                        @endif
                                    @endif
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div
                        class="col-lg-2 col-md-3 col-sm-4 col-5 text-end order-lg-2 order-1 pe-lg-2 pe-0 ps-0 d-lg-none">

                        @if (empty(getLogInUser()))
                            <a class="btn btn-white fs-18 me-sm-2" href="{{ route('login') }}" data-turbo="false"
                                role="button">
                                <span>{{ __('auth.sign_in') }}</span>
                            </a>
                        @else
                            @if (getLogInUser()->hasrole('admin') || getLogInUser()->hasrole('user'))
                                <span> <a class="btn btn-white fs-18 me-sm-2" href="{{ route('admin.dashboard') }}"
                                        data-turbo="false" role="button">
                                        {{ __('messages.dashboard') }}
                                    </a></span>
                            @endif
                            @if (getLogInUser()->hasrole('super_admin'))
                                <span><a class="btn btn-white fs-18 me-sm-2" href="{{ route('sadmin.dashboard') }}"
                                        data-turbo="false" role="button">
                                        {{ __('messages.dashboard') }}
                                    </a></span>
                            @endif
                        @endif

                    </div>
                </div>
            </div>
        </header>
    @endif
    <!-- end header section -->
