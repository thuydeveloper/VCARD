<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    @if (checkFeature('seo'))
        @if ($vcard->meta_description)
            <meta name="description" content="{{ $vcard->meta_description }}">
        @endif
        @if ($vcard->meta_keyword)
            <meta name="keywords" content="{{ $vcard->meta_keyword }}">
        @endif
    @endif
    <meta property="og:image" content="{{ $vcard->cover_url }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if (checkFeature('seo') && $vcard->site_title && $vcard->home_title)
        <title>{{ $vcard->home_title }} | {{ $vcard->site_title }}</title>
    @else
        <title>{{ $vcard->name }} | {{ getAppName() }}</title>
    @endif

    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef"/>
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="manifest" href="{{ asset('pwa/1.json') }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ getFaviconUrl() }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/slider/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slider/css/slick-theme.min.css') }}">
    <link href="{{ asset('assets/css/layout.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/third-party.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom-vcard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lightbox.css') }}">

    @yield('page_css')
    {{-- google font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    @if (checkFeature('custom-fonts') && $vcard->font_family)
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family={{ $vcard->font_family }}">
    @endif
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

<body id="body">
    @if(checkFeature('password'))
        @include('vcards.password')
    @endif
    <div class="main-bg" @if (getLanguage($vcard->default_language) == 'Arabic') dir="rtl" @endif>

        @if ($vcard->whatsapp_share)
            <div class="vcard11-icon-container icon-search-container  mb-3" data-ic-class="search-trigger">
                <div class="wp-btn">
                    <i class="fab text-light  fa-whatsapp fa-2x" id="wpIcon"></i>
                </div>
                <input type="number" class="search-input" id="wpNumber" data-ic-class="search-input"
                    placeholder="{{ __('messages.setting.wp_number') }}">
                <div class="share-wp-btn-div">
                    <a href="javascript:void(0)"
                        class="vcard11-wp-btn d-flex justify-content-center align-items-center text-light rounded-0 text-decoration-none py-1 rounded-pill justify-content share-wp-btn">
                        <i class="fa-solid fa-paper-plane"></i> </a>
                </div>
            </div>
        @endif
        {{-- support banner --}}
        @if ((isset($managesection) && $managesection['banner']) || empty($managesection))
            @if(isset($banners->title))
                <div class="mb-10 mt-0">
                    <div class="support-banner d-flex align-items-center justify-content-center">
                        <button type="button" class="text-start banner-close"><i class="fa-solid fa-xmark"></i></button>
                        <div class="">
                            <h1 class="text-center support_heading">{{ $banners->title }}</h1>
                            <p class="text-center support_text text-dark">{{ $banners->description }} </p>
                            <div class="text-center">
                                <a href="{{ $banners->url }}" class="act-now text-light" target="blank"
                                    data-turbo="false">{{ $banners->banner_button }} </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
        @include('vcardTemplates.vcard11.header')
        @yield('content')
    </div>
    @include('vcardTemplates.template.templates')
    <!-- end tab-content-section -->
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('assets/js/vcard11/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/front-third-party-vcard11.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/slider/js/slick.min.js') }}" type="text/javascript"></script>
    @yield('page_js')
    <script>
        let password = "{{ isset(checkFeature('advanced')->password) && !empty($vcard->password) }}";
        let passwordUrl = "{{ route('vcard.password', $vcard->id) }}"

        $('.counter').each(function() {
            var $this = $(this),
                countTo = $this.attr('data-countto')
            countDuration = parseInt($this.attr('data-duration'))
            $({
                counter: $this.text()
            }).animate({
                counter: countTo,
            }, {
                duration: countDuration,
                easing: 'linear',
                step: function() {
                    $this.text(Math.floor(this.counter))
                },
                complete: function() {
                    $this.text(this.counter)
                },
            }, )
        })
    </script>
    <script>
        var os = navigator.platform;
        if (os == 'MacIntel' || 'ios' || 'macos') {
            $("#videobtn").removeClass('d-none');
        }
        listenClick('#videobtn', function() {
            window.location.href = "facetime://";
        });
    </script>
    <script>
        $('.slick-slider').slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            dots: true,
            arrows: true,
            prevArrow: '<button class="slide-arrow prev-arrow"><i class="fa-solid fa-chevron-left"></i></button>',
            nextArrow: '<button class="slide-arrow next-arrow"><i class="fa-solid fa-chevron-right"></i></button>',
            responsive: [{
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            }, ],
            @if (getLanguage($vcard->default_language) == 'Arabic')
                rtl: true,
            @endif
        })
        $('.services-slider-view').slick({
            dots: true,
            infinite: true,
            speed: 300,
            slidesToShow: 2,
            autoplay: false,
            slidesToScroll: 1,
            centerMode: false,
            arrows: true,
            prevArrow: '<button class="slide-arrow prev-arrow"><i class="fa-solid fa-chevron-left"></i></button>',
            nextArrow: '<button class="slide-arrow next-arrow"><i class="fa-solid fa-chevron-right"></i></button>',
            adaptiveHeight: true,
            responsive: [
                {
                    breakpoint: 800,
                    settings: {
                        centerMode: true,
                        centerPadding: '60px',
                        slidesToShow: 1,
                    },
                },
                {
                    breakpoint: 400,
                    settings: {
                        centerMode: false,
                        slidesToShow: 1,
                    }
                }
            ],
            @if (getLanguage($vcard->default_language) == 'Arabic')
                rtl: true,
            @endif
        });
        $('.iframe-slider').slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 2000,
            dots: true,
            arrows: true,
            prevArrow: '<button class="slide-arrow prev-arrow"><i class="fa-solid fa-chevron-left"></i></button>',
            nextArrow: '<button class="slide-arrow next-arrow"><i class="fa-solid fa-chevron-right"></i></button>',
            responsive: [{
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            }, ],
            @if (getLanguage($vcard->default_language) == 'Arabic')
                rtl: true,
            @endif
        })
    </script>
    <script>
        function openbars() {
            document.getElementById('v-pills-tab').style.display = 'none'
            document.getElementById('pages-menu').style.display = 'block'
        }

        function closebars() {
            document.getElementById('v-pills-tab').style.display = 'block'
            document.getElementById('pages-menu').style.display = 'none'
        }

        function openbars1() {
            document.getElementById('v-pills-tab1').style.display = 'none'
            document.getElementById('pages-menu1').style.display = 'block'
        }

        function closebars1() {
            document.getElementById('v-pills-tab1').style.display = 'block'
            document.getElementById('pages-menu1').style.display = 'none'
        }
    </script>

    <script>
        $(document).ready(function() {
            $('.dropbtn').click(function() {
                $('.dropdown-content').toggleClass('show')
            })
            // $(document).click(function (event) {
            //     if (!$(event.target).is('.dropbtn')) {
            //         $('.dropdown-content').removeClass('show')
            //     }
            // })
        })
    </script>

    <script>
        $(document).ready(function() {
            $('.sharedropdown .sharedropbtn').click(function() {
                $('.sharedropdown-content').toggleClass('activetab')
            })
        })
    </script>
    @php
        $setting = \App\Models\UserSetting::where('user_id', $vcard->tenant->user->id)
            ->where('key', 'stripe_key')
            ->first();
    @endphp
    <script>
     @if (isset(checkFeature('advanced')->custom_js) && $vcard->custom_js)
    {!! $vcard->custom_js !!}
    @endif
</script>
    <script>
        let stripe = '';
        @if (!empty($setting) && !empty($setting->value))
            stripe = Stripe('{{ $setting->value }}');
        @endif
        let isEdit = false
        let enquiryUrl = "{{ route('enquiry.store', ['vcard' => $vcard->id, 'alias' => $vcard->url_alias]) }}"
        let appointmentUrl =
            "{{ route('appointment.store.vcard11', ['vcard' => $vcard->id, 'alias' => $vcard->url_alias]) }}"

        let paypalUrl = "{{ route('paypal.init') }}"
        let slotUrl = "{{ route('appointment-session-time', $vcard->url_alias) }}"
        let appUrl = "{{ config('app.url') }}"
        let vcardId = {{ $vcard->id }};
        let vcardAlias = "{{ $vcard->url_alias }}"
        let languageChange = "{{ url('language') }}"
        let lang = "{{ checkLanguageSession($vcard->url_alias) }}"
        let userDateFormate = "{{ getSuperAdminSettingValue('datetime_method') ??  1 }}"
        let template = 'vcard11'
        let passwordSet = "{{ Session::get('password_') }}"
        @if (!empty($userSetting['stripe_key']))
            stripe = Stripe('{{ $userSetting['stripe_key'] }}');
        @endif
    </script>
    <script>
        const qrCodeEleven = document.getElementById("qr-code-eleven");
        const svg = qrCodeEleven.querySelector("svg");
        const blob = new Blob([svg.outerHTML], {
            type: 'image/svg+xml'
        })
        const url = URL.createObjectURL(blob)
        const image = document.createElement('img')
        image.src = url
        image.addEventListener('load', () => {
            const canvas = document.createElement('canvas')
            canvas.width = canvas.height = {{ $vcard->qr_code_download_size }};
            const context = canvas.getContext('2d')
            context.drawImage(image, 0, 0, canvas.width, canvas.height);
            const link = document.getElementById('qr-code-btn')
            link.href = canvas.toDataURL()
            URL.revokeObjectURL(url)
        })
    </script>
    @routes
    <script src="{{ asset('messages.js') }}"></script>
    <script src="{{ mix('assets/js/custom/helpers.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom.js') }}"></script>
    <script src="{{ mix('assets/js/vcards/vcard-view.js') }}"></script>
    <script src="{{ mix('assets/js/lightbox.js') }}"></script>
    <script>
        let options = {
            'key': "{{ getSelectedPaymentGateway('razorpay_key') }}",
            'amount': 0, //  100 refers to 1
            'currency': 'INR',
            'name': "{{ getAppName() }}",
            'order_id': '',
            'description': '',
            'image': '{{ asset(getAppLogo()) }}', // logo here
            'callback_url': "{{ route('product.razorpay.success') }}",
            'prefill': {
                'email': '', // recipient email here
                'name': '', // recipient name here
                'contact': '', // recipient phone here
            },
            'readonly': {
                'name': 'true',
                'email': 'true',
                'contact': 'true',
            },
            'theme': {
                'color': '#0ea6e9',
            },
            'modal': {
                'ondismiss': function() {
                    $('#paymentGatewayModal').modal('hide');
                    displayErrorMessage(Lang.get('js.payment_not_complete'));
                    setTimeout(function() {
                        Turbo.visit(window.location.href);
                    }, 1000);
                },
            },
        };
    </script>
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
</body>

</html>
