@extends('layouts.app')
@section('title')
    {{ __('messages.front_cms.banner_title') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('layouts.errors')
            @include('flash::message')
            <div class="card">
                <form action="{{ route('bannerStore') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="row">
                                <input type="hidden" name="part" value="">
                                <div class="col-12 form-check form-switch m-3 mt-0">
                                    <input class="form-check-input" name="banner_enable" type="checkbox"
                                    id="banner_enable" value="1"
                                    {{ isset($setting['banner_enable']) && $setting['banner_enable'] == '1' ? 'checked' : '' }}>
                                <label class="form-check-label"
                                    for="banner_enable">{{ __('messages.front_cms.apply_banner') }}</label>
                                </div>
                                <div class="col-6 mt-5">
                                    {{ Form::label('Title', __('messages.front_cms.title') . ':', ['class' => 'form-label required']) }}
                                    {{ Form::text('banner_title', isset($setting['banner_title']) ? $setting['banner_title'] : null, ['class' => 'form-control form-control-color w-100 mb-3', 'placeholder' => __('messages.front_cms.title'), 'id' => 'banner_title']) }}
                                </div>
                                <div class="col-6 mt-5">
                                    {{ Form::label('URL', __('messages.front_cms.url') . ':', ['class' => 'form-label required']) }}
                                    {{ Form::url('banner_url', isset($setting['banner_url']) ? $setting['banner_url'] : null, ['class' => 'form-control form-control-color w-100 mb-3', 'placeholder' => __('messages.front_cms.url'), 'id' => 'banner_url']) }}
                                </div>
                                <div class="col-6 mt-5">
                                    {{ Form::label('Description', __('messages.front_cms.description') . ':', ['class' => 'form-label required']) }}
                                    {{ Form::textarea('banner_description', isset($setting['banner_description']) ? $setting['banner_description'] : null, ['class' => 'form-control form-control-color w-100 mb-3', 'placeholder' => __('messages.form.short_description'), 'id' => 'banner_description', 'rows' => 5]) }}
                                </div>
                                <div class="col-6 mt-5">
                                    {{ Form::label('banner_button', __('messages.front_cms.banner_button') . ':', ['class' => 'form-label required']) }}
                                    {{ Form::text('banner_button',isset($setting['banner_button']) ? $setting['banner_button'] : null, ['class' => 'form-control form-control-color w-100 mb-3', 'placeholder' => __('messages.front_cms.banner_button'),  'id' => 'banner_button']) }}
                                </div>
                            </div>
                            <div class="col-lg-12 mt-5">
                                <div class="col-lg-12 d-flex">
                                    <button type="submit" class="btn btn-primary me-3" id="bannerdataSave">
                                        {{ __('messages.common.save') }}
                                    </button>
                                    <a href="{{ route('banner') }}"
                                        class="btn btn-secondary">{{ __('messages.common.discard') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
