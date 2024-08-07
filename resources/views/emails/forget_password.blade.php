@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
        <img src="{{ getLogoUrl() }}" class="logo" alt="{{ getAppName() }}" style="height:auto!important;width:auto!important;object-fit:cover">
        @endcomponent
    @endslot

    {{-- Body --}}
    <div>
        <h2>{{ __('messages.mail.hello') }} <b>{{ $user->first_name . ' ' . $user->last_name }}</b></h2>
        <p> {{ __('messages.mail.you_are_receiving_mail') }}</p>
        @component('mail::button', ['url' => $url])
            {{ __('messages.user.change_password') }}
        @endcomponent
        <p>{{ __('messages.mail.passsword_reset_link') }}</p>
        <p>{{ __('messages.mail.you_not_request_password_reset') }}</p>
        <p>{{ getAppName() }}</p>
        <hr>
        <p>{{ __('messages.mail.having_trouble_clicking') }}: <a href="{{ $url }}">{!! $url !!}</a></p>
    </div>

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            <h6>© {{ date('Y') }} {{ getAppName() }}.</h6>
        @endcomponent
    @endslot
@endcomponent     
