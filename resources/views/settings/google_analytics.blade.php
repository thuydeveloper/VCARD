@extends('settings.edit')
@section('section')
    <div class="card w-100">
        <div class="card-body d-flex">
            @include('settings.setting_menu')
            <div class=" w-100">
            <div class="card-header px-0">
                <div class="d-flex align-items-center justify-content-center">
                    <h3 class="m-0">{{ __('messages.plan.seo') }}
                    </h3>
                </div>
            </div>
            {{ Form::open(['route' => ['google_analytics.update'], 'method' => 'post']) }}
            <div class="row border-top p-4">
                <div class="col-lg-6 mb-3">
                    {{ Form::label('Site title', __('messages.vcard.site_title') . ':', ['class' => 'form-label']) }}
                    {{ Form::text('site_title', isset($metas) ? $metas['site_title'] : null, ['class' => 'form-control', 'placeholder' => __('messages.form.site_title')]) }}
                </div>
                <div class="col-lg-6 mb-3">
                    {{ Form::label('Home title', __('messages.vcard.home_title') . ':', ['class' => 'form-label']) }}
                    {{ Form::text('home_title', isset($metas) ? $metas['home_title'] : null, ['class' => 'form-control', 'placeholder' => __('messages.form.home_title')]) }}
                </div>
                <div class="col-lg-6 mb-3">
                    {{ Form::label('Meta keyword', __('messages.vcard.meta_keyword') . ':', ['class' => 'form-label']) }}
                    {{ Form::text('meta_keyword', isset($metas) ? $metas['meta_keyword'] : null, ['class' => 'form-control', 'placeholder' => __('messages.form.meta_keyword')]) }}
                </div>
                <div class="col-lg-6 mb-3">
                    {{ Form::label('Meta Description', __('messages.vcard.meta_description') . ':', ['class' => 'form-label']) }}
                    {{ Form::text('meta_description', isset($metas) ? $metas['meta_description'] : null, ['class' => 'form-control', 'placeholder' => __('messages.form.meta_description')]) }}
                </div>
            </div>
            <div class="card-header px-0">
                <div class="d-flex align-items-center justify-content-center">
                    <h3 class="m-0">{{ __('messages.vcard.google_analytics') }}
                    </h3>
                </div>
            </div>
            <div class="col-lg-12 border-top pt-4 mb-3">
                {{ Form::label('Google Analytics', __('messages.vcard.google_analytics') . ':', ['class' => 'form-label']) }}
                {{ Form::textarea('google_analytics', isset($metas) ? $metas['google_analytics'] : null, ['class' => 'form-control', 'placeholder' => __('messages.form.google_analytics')]) }}
            </div>
            {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-3']) }}
            {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

