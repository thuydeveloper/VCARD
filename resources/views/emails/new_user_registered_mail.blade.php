@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
        <img src="{{ getLogoUrl() }}" class="logo" alt="{{ getAppName() }}" style="height:auto!important;width:auto!important;object-fit:cover">
        @endcomponent
    @endslot

    {{-- Body --}}
    <div>
        <h2>{{ __('messages.mail.hello') }}</h2>
        <p>{{ __('messages.user.new_user_add') }}</p>
        <h4>{{ __('messages.mail.name') }} {{ $user->first_name }} {{ $user->last_name }}</h4>
        <h4> {{ __('messages.mail.email') }} {{ $user->email }} </h4>
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
