@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
        <img src="{{ getLogoUrl() }}" class="logo" alt="{{ getAppName() }}" style="height:auto!important;width:auto!important;object-fit:cover">
        @endcomponent
    @endslot

    {{-- Body --}}
    <div>
        <h2>{{ __('messages.mail.hello') }} <b>{{ $data['user']['first_name'] . ' ' . $data['user']['last_name'] }}</b></h2>
        <p> {{ __('messages.mail.please_click') }}</p>
        @component('mail::button', ['url' => $data['url']])
            {{ __('messages.mail.verify_email') }}
        @endcomponent
        <p>{{ __('messages.mail.action_required') }}</p>
        <p>{{ __('messages.mail.thanks_regard') }}</p>
        <p>{{ getAppName() }}</p>
        <hr>
        <p>{{ __('messages.mail.slot_text') }}: <a href="{{ $data['url'] }}">{!! $data['url'] !!}</a></p>
    </div>

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            <h6>© {{ date('Y') }} {{ getAppName() }}.</h6>
        @endcomponent
    @endslot
@endcomponent
