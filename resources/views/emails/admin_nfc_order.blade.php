@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{ asset(getAppLogo()) }}" class="logo" style="height:auto!important;width:auto!important;object-fit:cover" alt="{{ getAppName() }}">
        @endcomponent
    @endslot


    {{-- Body --}}
    <div>
        <h2>{{ __('messages.mail.hello') }}</h2>
        <p> {{ __('messages.mail.new_nfc_order') }} {{$nfcOrder['name']}}
        <p> {{ __('messages.nfc.card_type') }} : {{$cardType}}
        <p> {{ __('messages.nfc.vcard_name') }} : {{$vcardName}}
        <p> {{ __('messages.setting.shipping_address') }} : {{$nfcOrder['address']}}
        <p>{{ __('messages.nfc.order_date') }} : {{ date('Y-m-d', strtotime($nfcOrder['created_at'])) }}</p>
        <p>{{ __('messages.mail.thanks_regard') }}</p>
        <p>{{ getAppName() }}</p>
    </div>


    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            <h6>© {{ date('Y') }} {{ getAppName() }}.</h6>
        @endcomponent
    @endslot
@endcomponent
