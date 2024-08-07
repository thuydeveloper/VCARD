@extends(homePageLayout())
@section('title')
    {!! __('messages.vcard.term_condition') !!}
@endsection
@section('content')
    <section class="top-margin" >
        <div class="container p-t-100 padding-top-0">
            <div class="mt-100">{!! $setting['terms_conditions'] !!}</div>
        </div>
    </section>
@endsection
