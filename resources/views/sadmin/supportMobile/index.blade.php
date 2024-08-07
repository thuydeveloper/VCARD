@extends('layouts.app')
@section('title')
    {{ __('messages.app_download') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('layouts.errors')
            @include('flash::message')
            <div class="card">
                <form action="{{ route('appUrlStore') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="row">
                                <input type="hidden" name="part" value="">
                                <div class="col-12 form-check form-switch m-3 mt-0">
                                    <input class="form-check-input" name="mobile_app_enable" type="checkbox"
                                        id="mobile_app_enable" value="1"
                                        {{ isset($setting['mobile_app_enable']) && $setting['mobile_app_enable'] == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="mobile_app_enable">{{ __('messages.mobile_app_enable') }}</label>
                                </div>
                                <div class="col-6 mt-5">
                                    {{ Form::label('play_store_link', __('messages.play_store_link') . ':', ['class' => 'form-label']) }}
                                    {{ Form::text('play_store_link', isset($setting['play_store_link']) ? $setting['play_store_link'] : null, ['class' => 'form-control form-control-color w-100 mb-3', 'placeholder' => __('messages.play_store_link'), 'id' => 'play_store_link']) }}
                                </div>
                                <div class="col-6 mt-5">
                                    {{ Form::label('app_store_link', __('messages.app_store_link') . ':', ['class' => 'form-label']) }}
                                    {{ Form::text('app_store_link', isset($setting['app_store_link']) ? $setting['app_store_link'] : null, ['class' => 'form-control form-control-color w-100 mb-3', 'placeholder' => __('messages.app_store_link'), 'id' => 'app_store_link']) }}
                                </div>
                                <div class="col-6 mt-5">
                                    {{ Form::label('app_store_link', __('messages.app_download_section.delete_account_url') . ':', ['class' => 'form-label']) }}
                                    <div class="input-group bg-light border rounded-50px overflow-hidden mb-5">
                                        <input type="text" class="form-control border-0 bg-light fs-13"
                                            value="{{ route('login') . '?redirect=delete' }}" disabled>
                                        <span id="deleteAccountURL" class="d-none" target="_blank">
                                            {{ route('login') . '?redirect=delete' }}
                                        </span>
                                        <button class="btn text-primary copy-delete-account-url px-2"
                                            type="button">{{ __('messages.app_download_section.copy') }}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-5">
                                <div class="col-lg-12 d-flex">
                                    <button type="submit" class="btn btn-primary me-3" id="appDownloadSave">
                                        {{ __('messages.common.save') }}
                                    </button>
                                    <a href="{{ route('appDownload') }}"
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
