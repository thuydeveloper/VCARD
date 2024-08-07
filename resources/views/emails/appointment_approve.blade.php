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
            <h2>{{ __('messages.mail.hello') }} <b>{{ $input['name'] }}</b></h2>
            <p> {{ __('messages.mail.approved_successfully') }} {{ $input['date'] }} {{ __('messages.mail.between') }}
                {{ $input['from_time'] }}
                {{ __('messages.common.to') }} {{ $input['to_time'] }}</p>
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
