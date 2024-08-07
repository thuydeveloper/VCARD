@extends('settings.edit')
@section('section')
    <div class="card w-100">
        <div class="card-body d-md-flex">
            @include('settings.setting_menu')
            <div class="">
                {{ Form::open(['route' => ['setting.update'], 'method' => 'post', 'files' => true, 'id' => 'createSetting']) }}
                <div class="row">
                    <!-- App Name Field -->
                    <div class="form-group col-sm-6 mb-3">
                        {{ Form::label('app_name', __('messages.setting.app_name') . ':', ['class' => 'form-label required']) }}
                        {{ Form::text('app_name', $setting['app_name'], ['class' => 'form-control', 'id' => 'settingAppName', 'placeholder' => __('messages.setting.app_name')]) }}
                    </div>
                    <!-- Email Field -->
                    <div class="form-group col-sm-6 mb-3">
                        {{ Form::label('email', __('messages.user.email') . ':', ['class' => 'form-label required']) }}
                        {{ Form::email('email', $setting['email'], ['class' => 'form-control', 'required', 'id' => 'settingEmail', 'placeholder' => __('messages.user.email')]) }}
                    </div>
                    <!-- Phone Field -->
                    <div class="form-group col-md-6 col-lg-6 col-sm-6 col-12 mb-3">
                        {{ Form::label('phone', __('messages.user.phone') . ':', ['class' => 'form-label required']) }}
                        <br>
                        {{ Form::tel('phone', '+' . $setting['prefix_code'] . $setting['phone'], ['class' => 'form-control', 'placeholder' => __('messages.form.contact'), 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'id' => 'phoneNumber']) }}
                        {{ Form::hidden('prefix_code', '+' . $setting['prefix_code'], ['id' => 'prefix_code']) }}
                        <p id="valid-msg" class="text-success d-block fw-400 fs-small mt-2 d-none">
                            {{ __('messages.placeholder.valid_number') }}</p>
                        <p id="error-msg" class="text-danger d-block fw-400 fs-small mt-2 d-none"></p>
                    </div>

                    <div class="col-md-6 col-lg-6 col-sm-6 col-12 form-group mb-3">
                        {{ Form::label('plan_expire_notification', __('messages.plan_expire_notification') . ':', ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::number('plan_expire_notification', $setting['plan_expire_notification'], ['class' => 'form-control', 'min' => 0, 'onKeyPress' => 'if(this.value.length==2) return false;', 'required', 'id' => 'settingPlanExpireNotification', 'placeholder' => __('messages.plan_expire_notification')]) }}
                    </div>

                    <div class="col-md-6 col-lg-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            {{ Form::label('address', __('messages.setting.address') . ':', ['class' => 'form-label']) }}
                            <span class="required"></span>
                            {{ Form::text('address', $setting['address'], ['class' => 'form-control', 'min' => 0, 'id' => 'settingAddress', 'required', 'placeholder' => __('messages.setting.address')]) }}
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            {{ Form::label('default_language', __('messages.setting.default_language') . ':', ['class' => 'form-label']) }}
                            {{ Form::select('default_language', getAllLanguage(), $setting['default_language'], ['class' => 'form-control', 'data-control' => 'select2']) }}
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            {{ Form::label('datetime_method', __('messages.setting.datetime_formate') . ':', ['class' => 'form-label']) }}
                            {{ Form::select('datetime_method', \App\Models\Setting::DATE_FORMATE, $setting['datetime_method'], ['class' => 'form-control', 'data-control' => 'select2']) }}
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            {{ Form::label('user_default_language', __('messages.setting.user_default_language') . ':', ['class' => 'form-label']) }}
                            {{ Form::select('user_default_language', getAllLanguage(), $setting['user_default_language'], ['class' => 'form-control', 'data-control' => 'select2']) }}
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            {{ Form::label('default_country_code', __('messages.common.default_country_code') . ':', ['class' => 'form-label']) }}
                            <span class="required"></span>
                            {{ Form::text('default_country_data', null, ['class' => 'form-control', 'placeholder' => __('messages.common.default_country_code'), 'id' => 'defaultCountryData']) }}
                            {{ Form::hidden('default_country_code', $setting['default_country_code'], ['id' => 'defaultCountryCode']) }}
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            {{ Form::label('default_currency_format', __('messages.setting.default_currency_format') . ':', ['class' => 'form-label']) }}
                            {{ Form::select('default_currency', getCurrenciesCode(), $setting['default_currency'], ['class' => 'form-control', 'data-control' => 'select2']) }}
                        </div>
                    </div>
                    <div class="form-group col-sm-6 mb-3">
                        {{ Form::label('affiliation_amount', __('messages.setting.affiliation_amount') . ':', ['class' => 'form-label required']) }}
                        {{ Form::text('affiliation_amount', $setting['affiliation_amount'], ['class' => 'form-control', 'id' => 'affiliationAmount', 'placeholder' => __('messages.setting.affiliation_amount')]) }}
                        <span id="affiliationAmountError" class="text-danger"></span>
                    </div>
                    <div class="form-group col-sm-6 mb-3">
                        {{ Form::label('affiliation_format', __('messages.setting.affiliation_format') . ':', ['class' => 'form-label']) }}
                        {{ Form::select('affiliation_amount_type', \App\Models\Setting::AFFILIATION_FORMATE, $setting['affiliation_amount_type'], ['class' => 'form-control', 'data-control' => 'select2', 'id' => 'affiliationAmountType']) }}
                    </div>
                    <div class="row m-0">
                        <div class="col-lg-6 ps-0 pe-3">
                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <div class="form-group mb-3">
                                        {{ Form::label('currency_after_amount', __('messages.common.currency_position') . ':', ['class' => 'form-label mb-3']) }}
                                        <label class="form-check form-switch form-switch-sm cursor-pointer">
                                            <input type="checkbox" name="currency_after_amount" class="form-check-input"
                                                id="currencyAfterAmount" value="1"
                                                {{ $setting['currency_after_amount'] == '1' ? 'checked' : '' }}>
                                            <span class="form-check-label text-gray-600"
                                                for="currencyAfterAmount">{{ __('messages.common.show_currency_behind') }}</span>&nbsp;&nbsp;
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="form-group mb-3">
                                        {{ Form::label('mobileValidation', __('messages.common.phone_validation') . ':', ['class' => 'form-label mb-3']) }}
                                        <label class="form-check form-switch form-switch-sm cursor-pointer">
                                            <input type="checkbox" name="mobile_validation" class="form-check-input"
                                                value="1" {{ $setting['mobile_validation'] == '1' ? 'checked' : '' }}
                                                id="mobileValidation">
                                            <span class="form-check-label text-gray-600"
                                                for="mobileValidation">{{ __('messages.common.enable_validation') }}</span>&nbsp;&nbsp;
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="form-group mb-3">
                                        {{ Form::label('urlAlias', __('messages.common.url_alias_edit') . ':', ['class' => 'form-label mb-3']) }}
                                        <label class="form-check form-switch form-switch-sm cursor-pointer">
                                            <input type="checkbox" name="url_alias" class="form-check-input" value="1"
                                                {{ $setting['url_alias'] == '1' ? 'checked' : '' }} id="">
                                            <span class="form-check-label text-gray-600"
                                                for="">{{ __('messages.common.url_alias_enable') }}</span>&nbsp;&nbsp;
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 px-lg-3 px-0">
                            <a href="{{ route('setting.upgradeDatabase') }}" class="btn btn-warning mb-5"><i
                                    class="fa-solid fa-database"></i> {{ __('messages.setting.upgrade_database') }}</a>
                            <a href="{{ route('generateSitemap') }}" class="btn btn-primary mb-5"><i
                                    class="fa-solid fa-sitemap"></i> {{ __('messages.gnerate_sitemap') }}</a>
                        </div>
                    </div>
                </div>
                <div>
                    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3']) }}
                    <a href="{{ route('setting.index') }}"
                        class="btn btn-secondary">{{ __('messages.common.discard') }}</a>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
