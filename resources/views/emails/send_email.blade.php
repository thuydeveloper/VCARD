@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
<img src="{{ getLogoUrl() }}" class="logo" alt="{{ getAppName() }}" style="height:auto!important;width:auto!important;object-fit:cover">
@endcomponent
@endslot
{{-- Body --}}
<div>
<h2>{{ __('messages.mail.hello') }} <b>{{ $data['email'] }}</b></h2>
<p>{!! $data['description'] !!}</p>
</div>
{{-- Footer --}}
@slot('footer')
@component('mail::footer')
<h6>© {{ date('Y') }} {{ getAppName() }}.</h6>
@endcomponent
@endslot
@endcomponent
