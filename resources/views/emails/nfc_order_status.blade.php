@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{ asset(getAppLogo()) }}" class="logo" style="height:auto!important;width:auto!important;object-fit:cover"
                alt="{{ getAppName() }}">
        @endcomponent
    @endslot

    {{-- Body --}}
    <div>
        <div>
            <h2>{{ __('messages.mail.hello') }} <b>{{ $order['name'] }}</b></h2>
            <p> {{ __('messages.nfc.your_order_status_changed') }}</p>
                <p><b>{{  __('messages.nfc.order_status').': ' }}</b>{{ __('messages.nfc.'.App\Models\NfcOrders::ORDER_STATUS_ARR[$status]) }}</p>
            <p>{{ __('messages.mail.thanks_regard') }}</p>
            <p>{{ getAppName() }}</p>
        </div>
    </div>

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            <h6>© {{ date('Y') }} {{ getAppName() }}.</h6>
        @endcomponent
    @endslot
@endcomponent
