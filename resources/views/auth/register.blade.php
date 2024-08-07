@extends('layouts.auth')
@section('title')
    {{ __('messages.common.register') }}
@endsection
@section('content')
    <div class="register-section bg-white overflow-hidden position-relative h-100">
        <div class="top-vector">
            <img src="{{ asset('assets/images/top-vector.png') }}">
        </div>
        <div class="bottom-vector">
            <img src="{{ asset('assets/images/bottom-vector.png') }}">
        </div>
        <div class="row">
            <div class="col-md-6 col-12 p-0">
                <div class="register-img d-sm-block d-none">
                    <img src="{{ asset($registerImage) }}" alt="Register Image" class="w-100 h-100">
                </div>
            </div>
            <div class="col-md-6 col-12 p-0 d-flex flex-column justify-content-center register-section" @if(getLanguageByKey(checkFrontLanguageSession()) == 'Arabic') dir="rtl" @endif>
                <div class="register-form">
                    <div class="px-sm-10 px-6 mb-5  h-100 w-100">
                        <div class="text-center d-flex justify-content-center align-items-center">
                            <div class="image image-mini me-3 mb-5">
                                <a href="{{ route('home') }}" class="image">
                                    <img alt="Logo" src="{{ getLogoUrl() }}" class="img-fluid logo-fix-size">
                                </a>
                            </div>
                            <span class="text-gray-900 fs-1 fw-bold">{{ getAppName() }}</span>
                        </div>
                        <div class="row element mt-5">
                            <div class="col-md-12 width-540 mt-5">
                                @include('flash::message')
                                @include('layouts.errors')
                            </div>
                            <h1 class="text-center mb-7 fs-2 fw-bold">{{ __('messages.common.create_an_account') }}
                            </h1>
                            <form method="POST"
                                action="{{ request()->input('referral-code') ? route('register') . '?referral-code=' . request()->input('referral-code') : route('register') }}"
                                id="UserRegisterForm" class="form-horizontal">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="formInputFirstName" class="form-label">
                                            {{ __('messages.user.first_name') . ':' }}<span class="required"></span>
                                        </label>
                                        <input name="first_name" type="text" class="form-control" id="first_name"
                                            placeholder=" {{ __('messages.user.first_name') }}"
                                            aria-describedby="firstName" value="{{ old('first_name') }}" required>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="last_name" class="form-label">
                                            {{ __('messages.user.last_name') . ':' }}<span class="required"></span>
                                        </label>
                                        <input name="last_name" type="text" class="form-control" id="last_name"
                                            placeholder=" {{ __('messages.user.last_name') }}" aria-describedby="lastName"
                                            required value="{{ old('last_name') }}">
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label for="email" class="form-label">
                                            {{ __('messages.user.email') . ':' }}<span class="required"></span>
                                        </label>
                                        <input name="email" type="email" class="form-control" id="email"
                                            aria-describedby="email" placeholder=" {{ __('messages.user.email') }}"
                                            value="{{ old('email') }}" required>
                                        <span id="email-error-msg" class="text-danger fw-400 fs-small mt-2"></span>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label for="phone" class="form-label">
                                            {{ __('messages.common.phone') . ':' }}<span class="required"></span>
                                        </label>
                                        {{ Form::tel('contact', getDefaultPhoneCode() , ['class' => 'form-control text-start', 'placeholder' => __('messages.form.contact'), 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'id' => 'phoneNumber']) }}
                                        {{ Form::hidden('region_code', getDefaultPhoneCode() , ['id' => 'prefix_code']) }}
                                        <span id="valid-msg"
                                            class="text-success d-none fw-400 fs-small mt-2">{{ __('messages.placeholder.valid_number') }}</span>
                                        <span id="error-msg" class="text-danger d-none fw-400 fs-small mt-2">Invalid
                                            Number</span>
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label for="password" class="form-label">
                                            {{ __('messages.user.password') . ':' }}<span class="required"></span>
                                        </label>
                                        <div class="mb-3 position-relative">
                                            <input type="password" name="password" class="form-control" id="password"
                                                placeholder=" {{ __('messages.user.password') }}"
                                                aria-describedby="password" required aria-label="Password"
                                                data-toggle="password">
                                            <span
                                                class="position-absolute d-flex align-items-center top-0 bottom-0 end-0 me-4 input-icon input-password-hide cursor-pointer text-gray-600">
                                                <i class="bi bi-eye-slash-fill"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label for="password_confirmation" class="form-label">
                                            {{ __('messages.user.confirm_password') . ':' }}<span class="required"></span>
                                        </label>
                                        <div class="mb-3 position-relative">
                                            <input name="password_confirmation" type="password" class="form-control"
                                                placeholder=" {{ __('messages.user.confirm_password') }}"
                                                id="password_confirmation" aria-describedby="confirmPassword" required
                                                aria-label="Password" data-toggle="password">
                                            <span
                                                class="position-absolute d-flex align-items-center top-0 bottom-0 end-0 me-4 input-icon input-password-hide cursor-pointer text-gray-600">
                                                <i class="bi bi-eye-slash-fill"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4 element">
                                        <div class="form-check">
                                            <input type="checkbox" name="term_policy_check" class="form-check-input"
                                                id="privacyPolicyCheckbox" placeholder>
                                            <label class="form-check-label" for="privacyPolicyCheckbox">
                                                @lang('messages.by_signing_up_you_agree_to_our')
                                                <a href="{{ route('terms.conditions') }}" target="_blank"
                                                    class="text-decoration-none link-info fs-6">{!! __('messages.vcard.term_condition') !!}</a>
                                                &
                                                <a href="{{ route('privacy.policy') }}" target="_blank"
                                                    class="text-decoration-none link-info fs-6">{{ __('messages.vcard.privacy_policy') }}</a>
                                            </label>
                                        </div>
                                    </div>

                                    @if (getSuperAdminSettingValue('captcha_enable'))
                                        <div class="col-md-12 mb-sm-7 mb-4">
                                            {!! htmlFormSnippet() !!}
                                        </div>
                                    @endif
                                </div>
                                <div class="row element">
                                    <div class="d-grid">
                                        <button type="submit"
                                            class="btn  register-btn px-10">{{ __('messages.common.register') }}</button>
                                    </div>
                                </div>
                                <div class="align-items-center text-center mt-4">
                                    <span
                                        class="text-gray-700 me-2 text-center">{{ __('messages.common.already_have_an_account') . '?' }}</span>
                                    <a href="{{ route('login') }}" class="link-info fs-6 text-decoration-none">
                                        {{ __('messages.common.sign_in_here') }}
                                    </a>
                                </div>
                                <div class="container-fluid padding-0 mt-2 copy-right">
                                    <div class="row align-items-center justify-content-center">
                                        <div class="col-xl-6 w-100">
                                            <div class="copyright text-center text-muted">
                                                {{ __('messages.placeholder.all_rights_reserve') }} &copy;
                                                {{ date('Y') }} <a href="{{ route('home') }}"
                                                    class="font-weight-bold ml-1" target="_blank">{{ getAppName() }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
