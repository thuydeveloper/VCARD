@extends('layouts.auth')
@section('title')
    Reset Password
@endsection
@section('content')
<div class="reset-password-section bg-white overflow-hidden position-relative h-100">
    <div class="top-vector">
        <img src="{{ asset('assets/images/top-vector.png') }}">
    </div>
    <div class="bottom-vector">
        <img src="{{ asset('assets/images/bottom-vector.png') }}">
    </div>
<div class="row">
    <div class="col-md-6 col-12 p-0 ">
        <div class="register-img d-sm-block d-none">
        <img src="{{ asset($registerImage) }}" alt="Register Image" class="w-100">
    </div>
    </div>
    <div class="col-md-6 col-12 p-0 d-flex flex-column justify-content-center reset-password-section" @if(getLanguageByKey(checkFrontLanguageSession()) == 'Arabic') dir="rtl" @endif>
    <div class="d-flex flex-column flex-column-fluid align-items-center p-4 reset-password-form">
        <div class="col-12 text-center mt-0">
            <a href="{{ route('home') }}" class="image mb-7 mb-sm-10">
                <img alt="Logo" src="{{ getLogoUrl() }}" class="img-fluid logo-fix-size">
            </a>
        </div>
        <div class="width-540">
            @include('layouts.errors')
        </div>
        <div class="bg-white width-540 px-5 px-sm-7 py-10 mx-auto">
            <h1 class="text-center mb-7">{{__('messages.common.forgot_password').' ?'}}</h1>
            <form class="form w-100" method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div class="row">
                    <div class="mb-10">
                        <label class="form-label" for="email">{{ __('messages.user.email') }}</label>
                        <input id="email" class="form-control" value="{{ old('email', $request->email) }}"
                               type="email" name="email" required autocomplete="off" autofocus/>

                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-10">
                        <label class="form-label" for="password">{{__('messages.user.password')}}</label>
                        <input id="password" class="form-control"
                               type="password"
                               name="password"
                               required  autocomplete="off" />
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-5">
                        <label class="form-label" for="password_confirmation">{{__('messages.user.confirm_password')}}</label>
                        <input class="form-control" type="password"
                               id="password_confirmation" name="password_confirmation" autocomplete="off"/>
                        <div class="invalid-feedback">
                            {{ $errors->first('password_confirmation') }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Submit Field -->
                    <div class="form-group col-sm-12 d-flex text-start align-items-center btn-section">
                        <button type="submit" class="btn btn-primary reset-link">
                            <span class="indicator-label">{{ __('messages.reset_password') }}</span>
                        </button>
                        <a href="{{ route('login') }}"
                           class="btn btn-secondary my-0 ms-5 me-0">{{__('messages.common.cancel')}}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <footer>
        <div class="container-fluid padding-0 mb-10 copy-right">
            <div class="row align-items-center justify-content-center">
                <div class="col-xl-6 w-100">
                    <div class="copyright text-center text-muted">
                        {{ __('messages.placeholder.all_rights_reserve') }} &copy; {{ date('Y') }} <a
                            href="{{ route('home') }}" class="font-weight-bold ml-1"
                            target="_blank">{{ getAppName() }}</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    </div>
</div>
</div>
@endsection

@push('scripts')
    <script type="text/javascript" id="zsiqchat">
        var $zoho = $zoho || {};
        $zoho.salesiq = $zoho.salesiq || {
            widgetcode: 'f2e92e58c41f499182d7ab0aa52668889d66adc7a843882454c2869ab82b8b8e',
            values: {},
            ready: function () {},
        };
        var d = document;
        s = d.createElement('script');
        s.type = 'text/javascript';
        s.id = 'zsiqscript';
        s.defer = true;
        s.src = 'https://salesiq.zoho.com/widget';
        t = d.getElementsByTagName('script')[0];
        t.parentNode.insertBefore(s, t);
    </script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-BLPPF2NWL3"></script>

    <script>

        window.dataLayer = window.dataLayer || [];

        function gtag(){dataLayer.push(arguments);}

        gtag('js', new Date());

        gtag('config', 'G-BLPPF2NWL3');

    </script>
@endpush
