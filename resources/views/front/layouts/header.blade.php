<!-- start header section -->
@if (checkFrontLanguageSession() != 'ar')
    <header class="header">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-2 col-md-8 col-sm-7 col-5 order-lg-1 order-0">
                    <a class="navbar-brand" href="#">
                        <img src="{{ getLogoUrl() }}" alt="company-logo" class="img-fluid navbar-logo">
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
                            <div class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link active px-3 mt-1" aria-current="page"
                                        href="{{ asset('') . '#frontHomeTab' }}">{{ __('auth.home') }}</a>
                                </li>
                                {{-- <li class="nav-item px-3">
                                <a class="nav-link mt-1"
                                    href="{{ asset('') . '#frontFeaturesTab' }}">{{ __('auth.features') }}</a>
                            </li> --}}
                                <li class="nav-item px-3">
                                    <a class="nav-link mt-1"
                                        href="{{ asset('') . '#frontAboutTabUsTab' }}">{{ __('auth.about') }}</a>
                                </li>
                                <li class="nav-item px-3 @if ($faqs === null) d-none @endif">
                                    <a class="nav-link mt-1"
                                        href="{{ route('fornt-faq') }}">{{ __('messages.faqs.faqs') }}</a>
                                </li>
                                <li class="nav-item px-3">
                                    <a class="nav-link mt-1"
                                        href="{{ asset('') . '#frontPricingTab' }}">{{ __('auth.pricing') }}</a>
                                </li>
                                <li class="nav-item px-3">
                                    <a class="nav-link mt-1"
                                        href="{{ asset('') . '#frontContactUsTab' }}">{{ __('auth.contact') }}</a>
                                </li>
                                <li class="nav-item px-3 mt-1">
                                    <div class="dropdown">
                                        <a class="btn dropdown-toggle" href="#" role="button"
                                            id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ getLanguageByKey(checkFrontLanguageSession()) }}</a>
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
                                    </div>
                                </li>
                                @if (empty(getLogInUser()))
                                    <a class="btn btn-white fs-18 ms-3 d-lg-block d-none" href="{{ route('login') }}"
                                        data-turbo="false">
                                        {{ __('auth.sign_in') }}
                                    </a>
                                @else
                                    @if (getLogInUser()->hasrole('admin') || getLogInUser()->hasrole('user'))
                                        <a class="btn btn-white fs-18 ms-3 d-lg-block d-none"
                                            href="{{ route('admin.dashboard') }}" data-turbo="false">
                                            {{ __('messages.dashboard') }}
                                        </a>
                                    @endif
                                    @if (getLogInUser()->hasrole('super_admin'))
                                        <a class="btn btn-white fs-18 ms-3 d-lg-block d-none"
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
                <div class="col-lg-2 col-md-8 col-sm-7 col-5 order-lg-1 order-0">
                    <a class="navbar-brand" href="#">
                        <img src="{{ getLogoUrl() }}" alt="company-logo" class="img-fluid navbar-logo">
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
                            <div class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link active px-3 mt-1" aria-current="page"
                                        href="{{ asset('') . '#frontHomeTab' }}">{{ __('auth.home') }}</a>
                                </li>
                                {{-- <li class="nav-item px-3">
                                <a class="nav-link mt-1"
                                    href="{{ asset('') . '#frontFeaturesTab' }}">{{ __('auth.features') }}</a>
                            </li> --}}
                                <li class="nav-item px-3">
                                    <a class="nav-link mt-1"
                                        href="{{ asset('') . '#frontAboutTabUsTab' }}">{{ __('auth.about') }}</a>
                                </li>
                                <li class="nav-item px-3 @if ($faqs === null) d-none @endif">
                                    <a class="nav-link mt-1"
                                        href="{{ route('fornt-faq') }}">{{ __('messages.faqs.faqs') }}</a>
                                </li>
                                <li class="nav-item px-3">
                                    <a class="nav-link mt-1"
                                        href="{{ asset('') . '#frontPricingTab' }}">{{ __('auth.pricing') }}</a>
                                </li>
                                <li class="nav-item px-3">
                                    <a class="nav-link mt-1"
                                        href="{{ asset('') . '#frontContactUsTab' }}">{{ __('auth.contact') }}</a>
                                </li>
                                <li class="nav-item px-3 mt-1">
                                    <div class="dropdown">
                                        <a class="btn dropdown-toggle" href="#" role="button"
                                            id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ getLanguageByKey(checkFrontLanguageSession()) }}</a>
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
                                    </div>
                                </li>
                                @if (empty(getLogInUser()))
                                    <a class="btn btn-white fs-18 ms-3 d-lg-block d-none" href="{{ route('login') }}"
                                        data-turbo="false">
                                        {{ __('auth.sign_in') }}
                                    </a>
                                @else
                                    @if (getLogInUser()->hasrole('admin') || getLogInUser()->hasrole('user'))
                                        <a class="btn btn-white fs-18 ms-3 d-lg-block d-none"
                                            href="{{ route('admin.dashboard') }}" data-turbo="false">
                                            {{ __('messages.dashboard') }}
                                        </a>
                                    @endif
                                    @if (getLogInUser()->hasrole('super_admin'))
                                        <a class="btn btn-white fs-18 ms-3 d-lg-block d-none"
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
