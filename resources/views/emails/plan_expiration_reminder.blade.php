 @component('mail::layout')
    {{-- Header --}}
     @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{ asset(getAppLogo()) }}" class="logo" style="height:auto!important;width:auto!important;object-fit:cover" alt="{{ getAppName() }}">
        @endcomponent
    @endslot

   <p>{{ __('messages.mail.hello') }} {{ $data['first_name']}} {{ $data['last_name'] }}</p>

   <p>{{ __('messages.mail.plan_expire') }}</p>

   <p>{{ __('messages.mail.thanks_regard') }}</p>
    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            <h6>© {{ date('Y') }} {{ getAppName() }}.</h6>
        @endcomponent
    @endslot
@endcomponent
