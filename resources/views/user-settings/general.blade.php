@extends('settings.edit')
@section('section')
    <div class="card w-100">
        <div class="card-body d-flex">
            <div class="">
                <div class="">
                    @include('user-settings.setting_menu')
                </div>
            </div>
            <div class="w-100">
                <button type="button"
                    class="btn px-0 aside-menu-container__aside-menubar d-block d-xl-none d-lg-none d-block edit-menu"
                    onclick="openNav()">
                    <i class="fa-solid fa-bars fs-1"></i>
                </button>
                <div class="card-body p-3">
                    {{ Form::open(['route' => 'user.setting.update', 'id' => 'UserCredentialsSettings', 'files' => true, 'class' => 'form']) }}
                    {{ Form::hidden('sectionName', $sectionName) }}
                    <div class="row">
                        {{--  PAYPAL --}}
                        <div class="row">
                            @if (checkFeature('affiliation'))
                                <div class="form-group col-sm-6 mb-5">
                                    {{ Form::label('paypal_email', __('messages.setting.paypal_payout_email') . ':') }}
                                    {{ Form::email('paypal_email', !empty($setting['paypal_email']) ? $setting['paypal_email'] : null, ['class' => 'form-control mt-2', 'id' => 'paypalEmail', 'placeholder' => __('messages.setting.paypal_payout_email')]) }}
                                </div>
                            @endif
                            <div class="form-group col-sm-6 mb-5">
                                {{ Form::label('currency', __('messages.setting.currency') . ':', ['class' => 'form-label required']) }}
                                <div class="input-group ">
                                    {{ Form::select('currency_id', getCurrencies(), !empty($setting['currency_id']) ? $setting['currency_id'] : null, ['class' => 'form-control', 'required', 'data-control' => 'select2', 'id' => 'userCurrencySettingId', 'placeholder' => __('messages.setting.select_currency')]) }}
                                </div>
                            </div>
                            <div class="form-group col-sm-6 mb-5">
                                {{ Form::label('subscription_model_time', __('messages.setting.subscription_time') . ':', ['class' => 'form-label']) }}
                                {{ Form::text('subscription_model_time', isset($setting['subscription_model_time']) ? $setting['subscription_model_time'] : 5, ['class' => 'form-control', 'id' => 'subscription_model_time', 'placeholder' => __('messages.setting.subscription_time')]) }}
                            </div>
                            <div class="form-group col-sm-6 mb-5">
                                <label for="time_format"
                                    class="form-label required  text-gray-700 mb-3">{{ __('messages.placeholder.time_format') }}
                                    :</label>
                                <div class="radio-button-group">
                                    <div class="btn-group btn-group-toggle m-0" data-toggle="buttons">
                                        <input type="radio" name="time_format" id="time_format-0" value="0"
                                            checked=""
                                            {{ !empty($setting['time_format']) == \App\Models\UserSetting::HOUR_12 ? 'checked' : '' }}>
                                        <label for="time_format-0" class="me-2"
                                            role="button">{{ __('messages.placeholder.12_hour') }}</label>
                                        <input type="radio" name="time_format" id="time_format-1" value="1"
                                            {{ !empty($setting['time_format']) == \App\Models\UserSetting::HOUR_24 ? 'checked' : '' }}>
                                        <label for="time_format-1"
                                            role="button">{{ __('messages.placeholder.24_hour') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-3 mb-5">
                                    <div class="form-group mb-3">
                                        {{ Form::label('pwaEnable', __('messages.setting.enable_pwa') . ':', ['class' => 'form-label mb-3']) }}
                                        <label class="form-check form-switch form-switch-sm cursor-pointer">
                                            <input type="checkbox" name="enable_pwa" class="form-check-input pwa-enable"
                                                value="1" {{ !empty($setting['enable_pwa']) == '1' ? 'checked' : '' }}
                                                id="pwaEnable">
                                            <span class="form-check-label text-gray-600"
                                                for="pwaEnable">{{ __('messages.setting.enable_pwa') }}</span>&nbsp;&nbsp;
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-sm-3 mb-3 pwa-div {{ !empty($setting['enable_pwa']) == '1' ? '' : 'd-none' }}">
                                    <div class="mb-3" io-image-input="true">
                                        <label for="pwaPreview" class="form-label fw-bolder">
                                            {{ __('messages.pwa.pwa_icon') . ':' }}</label>
                                        <span data-bs-toggle="tooltip" data-placement="top"
                                            data-bs-original-title="{{ __('messages.pwa.pwa_icon_size') }}">
                                            <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
                                        </span>
                                        <div class="d-block">
                                            <div class="image-picker">
                                                <div class="image previewImage" id="pwaPreview"
                                                    style="background-image: url('{{ isset($setting['pwa_icon']) ? $setting['pwa_icon'] : asset('web/media/logo/favicon-infyom.png') }}');">
                                                </div>
                                                <span class="picker-edit rounded-circle text-gray-500 fs-small"
                                                    data-bs-toggle="tooltip" data-placement="top"
                                                    data-bs-original-title="{{ __('messages.pwa.pwa_icon_change') }}">
                                                    <label>
                                                        <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                                        <input type="file" id="favicon" name="pwa_icon"
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
                    <button type="submit" class="btn btn-primary"
                        id="userCredentialSettingBtn">{{ __('messages.common.save') }}</button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
