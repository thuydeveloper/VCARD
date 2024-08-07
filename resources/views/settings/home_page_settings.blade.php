@extends('settings.edit')
@section('section')
    <div class="card w-100">
        <div class="card-body d-md-flex">
            @include('settings.setting_menu')
            <div class="w-100">
                <div class="card-header px-0">
                    <div class="d-flex align-items-center justify-content-center">
                        <h3 class="m-0">{{ __('messages.vcard.homepage_settings') }}
                        </h3>
                    </div>
                </div>
                <div class="card-body border-top p-3">
                    {{ Form::open(['route' => ['home.page.setting.update'], 'method' => 'post', 'files' => true, 'id' => 'homePageSetting']) }}
                <div class="row mb-5 mt-10">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class=" col-sm-6 col-12">
                                    <div class="form-group mb-3">
                                        {{ Form::label('is_front_page', __('messages.common.enable_page') . ':', ['class' => 'form-label']) }}
                                        <label
                                            class="form-check form-switch form-check-solid form-switch-sm d-flex cursor-pointer">
                                            <input type="checkbox" name="is_front_page" class="form-check-input"
                                                value="1"
                                                {{ $setting['is_front_page'] == '1' ? 'checked' : '' }}>&nbsp;
                                            <span class="form-check-label text-gray-600"
                                                for="mobileValidation">{{ __('messages.common.enable_page') }}</span>&nbsp;&nbsp;
                                            <span class="custom-switch-indicator"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="form-group mb-3">
                                        {{ Form::label('is_cookie_banner', __('messages.common.cookie_banner_enabled') . ':', ['class' => 'form-label']) }}
                                        <label
                                            class="form-check form-switch form-check-solid form-switch-sm d-flex cursor-pointer">
                                            <input type="checkbox" name="is_cookie_banner" class="form-check-input"
                                                value="1"
                                                {{ $setting['is_cookie_banner'] == '1' ? 'checked' : '' }}>&nbsp;
                                            <span class="form-check-label text-gray-600"
                                                for="mobileValidation">{{ __('messages.common.enable_cookie_banner') }}</span>&nbsp;&nbsp;
                                            <span class="custom-switch-indicator"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="form-group mb-3">
                                        {{ Form::label('registerEnable', __('messages.common.register_enable') . ':', ['class' => 'form-label mb-3']) }}
                                        <label class="form-check form-switch form-switch-sm cursor-pointer">
                                            <input type="checkbox" name="register_enable" class="form-check-input"
                                                value="1" {{ $setting['register_enable'] == '1' ? 'checked' : '' }}
                                                id="registerEnable">
                                            <span class="form-check-label text-gray-600"
                                                for="registerEnable">{{ __('messages.common.enable_register') }}</span>&nbsp;&nbsp;
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="form-group mb-3">
                                        {{ Form::label('userVerfiedEnable', __('messages.common.email_verification') . ':', ['class' => 'form-label mb-3']) }}
                                        <label class="form-check form-switch form-switch-sm cursor-pointer">
                                            <input type="checkbox" name="user_verified_email" class="form-check-input"
                                                value="1" {{ $setting['user_verified_email'] == '1' ? 'checked' : '' }}
                                                id="userVerfiedEnable">
                                            <span class="form-check-label text-gray-600"
                                                for="userVerfiedEnable">{{ __('messages.common.email_verification') }}</span>&nbsp;&nbsp;
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="form-group mb-3">
                                        {{ Form::label('captchaEnable', __('messages.common.captcha_enable') . ':', ['class' => 'form-label mb-3']) }}
                                        <label class="form-check form-switch form-switch-sm cursor-pointer">
                                            <input type="checkbox" name="captcha_enable" class="form-check-input"
                                                value="1" {{ $setting['captcha_enable'] == '1' ? 'checked' : '' }}
                                                id="">
                                            <span class="form-check-label text-gray-600"
                                                for="">{{ __('messages.common.captcha_enable') }}</span>&nbsp;&nbsp;
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="form-group mb-3">
                                        {{ Form::label('registerMail', __('messages.common.register_mail') . ':', ['class' => 'form-label mb-3']) }}
                                        <label class="form-check form-switch form-switch-sm cursor-pointer">
                                            <input type="checkbox" name="register_mail" class="form-check-input"
                                                value="1" {{ $setting['register_mail'] == '1' ? 'checked' : '' }}
                                                id="">
                                            <span class="form-check-label text-gray-600"
                                                for="">{{ __('messages.common.register_mail') }}</span>&nbsp;&nbsp;
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3" io-image-input="true">
                                        <label for="appLogoPreview"
                                            class="form-label required">{{ __('messages.setting.app_logo') . ':' }}</label>
                                        <span data-bs-toggle="tooltip" data-placement="top"
                                            data-bs-original-title="{{ __('messages.tooltip.app_logo') }}">
                                            <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
                                        </span>
                                        <div class="d-block">
                                            <div class="image-picker">
                                                <div class="image previewImage" id="appLogoPreview"
                                                    style="background-image: url('{{ isset($setting['app_logo']) ? $setting['app_logo'] : asset('assets/images/infyom-logo.png') }}')">
                                                </div>
                                                <span class="picker-edit rounded-circle text-gray-500 fs-small"
                                                    data-bs-toggle="tooltip" data-placement="top"
                                                    data-bs-original-title="{{ __('messages.tooltip.change_app_logo') }}">
                                                    <label>
                                                        <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                                        <input type="file" id="appLogo" name="app_logo"
                                                            class="image-upload d-none" accept="image/*" />
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3" io-image-input="true">
                                        <label for="faviconPreview" class="form-label required">
                                            {{ __('messages.setting.favicon') . ':' }}</label>
                                        <span data-bs-toggle="tooltip" data-placement="top"
                                            data-bs-original-title="{{ __('messages.tooltip.favicon_logo') }}">
                                            <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
                                        </span>
                                        <div class="d-block">
                                            <div class="image-picker">
                                                <div class="image previewImage" id="faviconPreview"
                                                    style="background-image: url('{{ isset($setting['favicon']) ? $setting['favicon'] : asset('web/media/logos/favicon-infyom.png') }}');">
                                                </div>
                                                <span class="picker-edit rounded-circle text-gray-500 fs-small"
                                                    data-bs-toggle="tooltip" data-placement="top"
                                                    data-bs-original-title="{{ __('messages.tooltip.change_favicon_logo') }}">
                                                    <label>
                                                        <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                                        <input type="file" id="favicon" name="favicon"
                                                            class="image-upload d-none" accept="image/*" />
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-4 mb-3">
                                    <div class="mb-3" io-image-input="true">
                                        <label for="reigisterPreview" class="form-label required">
                                            {{ __('messages.setting.register_image') . ':' }}</label>
                                        <span data-bs-toggle="tooltip" data-placement="top"
                                            data-bs-original-title="{{ __('messages.tooltip.favicon_logo') }}">
                                            <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
                                        </span>
                                        <div class="d-block">
                                            <div class="image-picker">
                                                <div class="image previewImage" id="faviconPreview"
                                                    style="background-image: url('{{ isset($setting['register_image']) ? $setting['register_image'] : asset('web/media/logos/favicon-infyom.png') }}');">
                                                </div>
                                                <span class="picker-edit rounded-circle text-gray-500 fs-small"
                                                    data-bs-toggle="tooltip" data-placement="top"
                                                    data-bs-original-title="{{ __('messages.tooltip.change_favicon_logo') }}">
                                                    <label>
                                                        <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                                        <input type="file" id="registerImage" name="register_image"
                                                            class="image-upload d-none" accept="image/*" />
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3" io-image-input="true">
                                        <label for="appLogoPreview"
                                            class="form-label required">{{ __('messages.setting.dashboard_logo') . ':' }}</label>
                                        <span data-bs-toggle="tooltip" data-placement="top"
                                            data-bs-original-title="{{ __('messages.tooltip.dashboard_logo') }}">
                                            <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
                                        </span>
                                        <div class="d-block">
                                            <div class="image-picker">
                                                <div class="image previewImage" id="appLogoPreview"
                                                    style="background-image: url('{{ isset($setting['dashboard_logo']) ? $setting['dashboard_logo'] : asset('assets/images/infyom-logo.png') }}')">
                                                </div>
                                                <span class="picker-edit rounded-circle text-gray-500 fs-small"
                                                    data-bs-toggle="tooltip" data-placement="top"
                                                    data-bs-original-title="{{ __('messages.tooltip.change_dashboard_logo') }}">
                                                    <label>
                                                        <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                                        <input type="file" id="dashboardLogo" name="dashboard_logo"
                                                            class="image-upload d-none" accept="image/*" />
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3']) }}
                    <a href="{{ route('setting.index',['section' => 'home_page_settings']) }}"
                        class="btn btn-secondary">{{ __('messages.common.discard') }}</a>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    </div>
@endsection
