<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if (checkFeature('seo') && $vcard->site_title && $vcard->home_title)
        <title>{{ $vcard->home_title }} | {{ $vcard->site_title }}</title>
    @else
        <title>{{ getAppName() }}</title>
    @endif

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="icon" href="{{ getFaviconUrl() }}" type="image/png">

    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('assets/css/vcard22.css') }}">
    <link rel="stylesheet" href="{{ mix('assets/css/vcard1.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/third-party.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom-vcard.css') }}">

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

<body>
    <div class="container p-0 vcard22-main">
        <div class="vcard22-main main-content w-100 mx-auto content-blur allSection collapse show">
            <div class="vcard-one__product py-3 mt-0">
                <div class="row justify-content-between" @if(getLanguage($vcard->default_language) == 'Arabic') dir="rtl" @endif>
                    <div class="col-4">
                        <h4 class="vcard-prodcut-heading p-5">{{ __('messages.vcard.products') }}</h4>
                    </div>
                    <div class="col-4 mt-8 text-center">
                        <a class="back-btn text-decoration-none" id="product-back" href="{{ route('vcard.show', ['alias' => $vcard->url_alias]) }}"
                            data-button-style="{{ isset($vcard->dynamic_vcard) ? $vcard->dynamic_vcard[0]->button_style : 'default' }}" role="button">{{ __('messages.common.back') }}</a>
                    </div>
                </div>
                <div class="product-slider">
                    @foreach ($vcard->products as $product)
                        <div class="px-5">
                            <div class="card product-card product-back px-2 border-0 w-75 w-sm-100 h-100 mx-auto mb-10">
                                <div class="product-img card-img">
                                    <a @if ($product->product_url) href="{{ $product->product_url }}" @endif
                                        target="_blank" class="text-decoration-none fs-6"><img
                                            src="{{ $product->product_icon }}"
                                            class="w-50 mt-3 oobject-fit-contain rounded-2 " height="208px" loading="lazy"></a>
                                </div>
                                <div class="card-body">
                                    <div class="product-desc d-flex justify-content-between align-items-center" @if(getLanguage($vcard->default_language) == 'Arabic') dir="rtl" @endif>
                                        <h3 class="product-head fs-18 fw-5 mb-0 me-2">{{ $product->name }}</h3>
                                        <div class="product-amount fw-bold fs-18">
                                            @if ($product->currency_id && $product->price)
                                                <span
                                                    class="fs-18 fw-6 product-price-{{ $product->id }}">{{ $product->currency->currency_icon }}{{ number_format($product->price, 2) }}</span>
                                            @elseif($product->price)
                                                <span class="fs-18 fw-6  product-price-{{ $product->id }}">{{ getUserCurrencyIcon($vcard->user->id) }}{{ $product->price }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <p class="fs-14 text-gray-100 mb-0 p-5">{{ $product->description }}</p>
                                    @if (!empty($product->price))
                                    <div class="my-5 text-center">
                                        <button class="buy-product text-decoration-none" data-button-style="{{ isset($vcard->dynamic_vcard) ? $vcard->dynamic_vcard[0]->button_style : 'default' }}" data-id="{{ $product->id }}">{{ __('messages.subscription.buy_now') }}</button>
                                    </div>
                                @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @include('vcardTemplates.product-buy')
    <script src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript" src="{{ asset('assets/js/front-third-party.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/slider/js/slick.min.js') }}" type="text/javascript"></script>
    <script>
        @if (checkFeature('seo') && $vcard->google_analytics)
            {!! $vcard->google_analytics !!}
        @endif

        @if (isset(checkFeature('advanced')->custom_js) && $vcard->custom_js)
            {!! $vcard->custom_js !!}
        @endif
    </script>
    @php
        $setting = \App\Models\UserSetting::where('user_id', $vcard->tenant->user->id)
            ->where('key', 'stripe_key')
            ->first();
    @endphp

    <script>
        let stripe = '';
        @if (!empty($setting) && !empty($setting->value))
            stripe = Stripe('{{ $setting->value }}');
        @endif
        let isEdit = false;
        let password = "{{ isset(checkFeature('advanced')->password) && !empty($vcard->password) }}";
        let passwordUrl = "{{ route('vcard.password', $vcard->id) }}";
        let enquiryUrl = "{{ route('enquiry.store', ['vcard' => $vcard->id, 'alias' => $vcard->url_alias]) }}";
        let appointmentUrl = "{{ route('appointment.store', ['vcard' => $vcard->id, 'alias' => $vcard->url_alias]) }}";
        let paypalUrl = "{{ route('paypal.init') }}";
        let slotUrl = "{{ route('appointment-session-time', $vcard->url_alias) }}";
        let appUrl = "{{ config('app.url') }}";
        let vcardId = {{ $vcard->id }};
        let vcardAlias = "{{ $vcard->url_alias }}";
        let languageChange = "{{ url('language') }}";
        let lang = "{{ checkLanguageSession($vcard->url_alias) }}";
    </script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var primaryColor = @json($vcard->dynamic_vcard[0]->primary_color ?? null);
        var backColor = @json($vcard->dynamic_vcard[0]->back_color ?? null);
        var backSecondColor = @json($vcard->dynamic_vcard[0]->back_seconds_color ?? null);
        var buttonTextColor = @json($vcard->dynamic_vcard[0]->button_text_color ?? null);
        var textDescriptionColor = @json($vcard->dynamic_vcard[0]->text_description_color ?? null);
        var textLabelColor = @json($vcard->dynamic_vcard[0]->text_label_color ?? null);
        var cardsBackColor = @json($vcard->dynamic_vcard[0]->cards_back ?? null);

        document.documentElement.style.setProperty('--primary-color', primaryColor);
        document.documentElement.style.setProperty('--green-100', backColor);
        document.documentElement.style.setProperty('--green', backSecondColor);
        document.documentElement.style.setProperty('--black', buttonTextColor);
        document.documentElement.style.setProperty('--gray-100', textDescriptionColor);
        document.documentElement.style.setProperty('--white', textLabelColor);
        document.documentElement.style.setProperty('--light', cardsBackColor);

    });
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    applyDynamicButtonStyle('#product-back');
    applyDynamicButtonStyle('.buy-product');
});
function applyDynamicButtonStyle(buttonId) {
    const buttons = document.querySelectorAll(buttonId);
    buttons.forEach(button => {
        let buttonStyle = button.getAttribute('data-button-style');

        if (buttonStyle === 'default' || !buttonStyle) {
            buttonStyle = '1';
        }

        button.classList.add(`dynamic-btn-${buttonStyle}`);
    });
}
</script>
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

    @routes
    <script src="{{ asset('messages.js') }}"></script>
    <script src="{{ mix('assets/js/custom/helpers.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom.js') }}"></script>
    <script src="{{ mix('assets/js/vcards/vcard-view.js') }}"></script>
    <script src="{{ mix('assets/js/lightbox.js') }}"></script>
</body>

</html>
