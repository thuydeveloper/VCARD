<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ getFaviconUrl() }}" type="image/png">
    @if (!empty($metas))
        @if ($metas['meta_description'])
            <meta name="description" content="{{ $metas['meta_description'] }}">
        @endif
        @if ($metas['meta_keyword'])
            <meta name="keywords" content="{{ $metas['meta_keyword'] }}">
        @endif
        @if ($metas['home_title'] && $metas['site_title'])
            <title>{{ $metas['home_title'] }} | {{ $metas['site_title'] }}</title>
        @else
            <title>@yield('title') | {{ getAppName() }}</title>
        @endif
    @else
        <title>@yield('title') | {{ getAppName() }}</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
    @endif

    @if (!empty(getAppLogo()))
        <meta property="og:image" content="{{ getAppLogo() }}" />
    @endif

    <style>
        @if (checkFrontLanguageSession() == 'ar')
            .accordion-button::after {
                margin-right: auto !important;
                margin-left: 0 !important;
            }
        @endif
    </style>

    {{--    <link rel="icon" href="{{ getFaviconUrl() }}" type="image/png"> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ mix('assets/css/public.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/third-party.css') }}">
    {{--    <link href="{{ asset('assets/css/front-custom.css') }}" rel="stylesheet" type="text/css"> --}}
    <link href="{{ asset('assets/css/front/front-custom.css') }}" rel="stylesheet" type="text/css">

    <script src="{{ mix('assets/js/front-third-party.js') }}"></script>
    <script src="{{ asset('messages.js') }}"></script>

    @php
        $langSession = Session::get('languageName');
        $frontLanguage = !isset($langSession) ? getSuperAdminSettingValue('default_language') : $langSession;
    @endphp
    <script>
        let frontLanguage = "{{ $frontLanguage }}"
        Lang.setLocale(frontLanguage)
    </script>
    <script src="{{ mix('assets/js/front-pages.js') }}"></script>

    {!! getSuperAdminSettingValue('extra_js_front') !!}
    @routes

    <script>
        $(document).ready(function() {
            $('html, body').animate({
                scrollTop: $('html').offset().top,
            });
        });
    </script>
    <!--google analytics code-->
    @if (!empty($metas['google_analytics']))
        {!! $metas['google_analytics'] !!}
    @endif
</head>

<body data-bs-offset="71">

    <div class="@if (checkFrontLanguageSession() == 'ar') home-rtl @endif">
        @include('front.layouts.header')
        @yield('content')
        @include('front.layouts.footer')
    </div>
</body>

</html>
