@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{ asset(getAppLogo()) }}" class="logo" style="height:auto!important;width:auto!important;object-fit:cover"
                 alt="{{ getAppName() }}">
        @endcomponent
    @endslot
    <h2>Hello, </h2>
    <p>{{__('messages.mail.new_manual_payment_request')}}</p>
    {!! $input['super_admin_msg'] !!}
    <div style="margin-top: 10px; display:inline-block;">
        @if($input['notes'])
            <p>Notes :- {{ $input['notes'] ?? 'N/A' }}</p>
        @endif
    </div>
    <p style="margin-top: 15px">{{ __('messages.mail.thanks_regard') }}</p>
    <p>{{ getAppName() }}</p>
    @slot('footer')
        @component('mail::footer')
            <h6>© {{ date('Y') }} {{ getAppName() }}.</h6>
        @endcomponent
    @endslot
@endcomponent
