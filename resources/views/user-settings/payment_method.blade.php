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
                <div class="card-header px-0">
                    <div class="d-flex align-items-center justify-content-center">
                        <h3 class="m-0">{{ __('messages.payment_method') }}
                        </h3>
                    </div>
                </div>
                <div class="card-body border-top p-3">
                    {{ Form::open(['route' => 'user.setting.update', 'id' => 'UserCredentialsSettings', 'files' => true, 'class' => 'form']) }}
                    {{ Form::hidden('sectionName', $sectionName) }}
                    <div class="row">

                        {{--  STRIPE --}}
                        <div class="col-12 d-flex align-items-center">
                            <span class="fs-3 my-3 me-3">{{ __('messages.setting.stripe') }}</span>
                            <label class="form-switch">
                                <input type="checkbox" name="stripe_enable" class="form-check-input stripe-enable"
                                    value="1" {{ !empty($setting['stripe_enable']) == '1' ? 'checked' : '' }}
                                    id="stripeEnable">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </div>
                        <div class="stripe-div {{ !empty($setting['stripe_enable']) == '1' ? '' : 'd-none' }} col-12">
                            <div class="row">
                                <div class="form-group col-sm-6 mb-5">
                                    {{ Form::label('stripe_key', __('messages.setting.stripe_key') . ':', ['class' => 'form-label required']) }}
                                    {{ Form::text('stripe_key', isset($setting['stripe_key']) ? $setting['stripe_key'] : null, ['class' => 'form-control', 'id' => 'stripeKey', 'placeholder' => __('messages.setting.stripe_key')]) }}
                                </div>
                                <div class="form-group col-sm-6 mb-5">
                                    {{ Form::label('stripe_secret', __('messages.setting.stripe_secret') . ':', ['class' => 'form-label required']) }}
                                    {{ Form::text('stripe_secret', isset($setting['stripe_secret']) ? $setting['stripe_secret'] : null, ['class' => 'form-control', 'id' => 'stripeSecret', 'placeholder' => __('messages.setting.stripe_secret')]) }}
                                </div>
                            </div>
                        </div>
                        {{--  PAYSTACK --}}
                        <div class="col-12 d-flex align-items-center">
                            <span class="fs-3 my-3 me-3">{{ __('messages.setting.paystack') }}</span>
                            <label class="form-switch">
                                <input type="checkbox" name="paytack_enable" class="form-check-input paystack-enable"
                                    value="1" {{ !empty($setting['paytack_enable']) == '1' ? 'checked' : '' }}
                                    id="paystackEnable">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </div>
                        <div class="paystack-div {{ !empty($setting['paytack_enable']) == '1' ? '' : 'd-none' }} col-12">
                            <div class="row">
                                <div class="form-group col-sm-6 mb-5">
                                    {{ Form::label('paystack_key', __('messages.setting.paystack_key') . ':', ['class' => 'form-label required']) }}
                                    {{ Form::text('paystack_key', isset($setting['paystack_key']) ? $setting['paystack_key'] : null, ['class' => 'form-control', 'id' => 'paystackKey', 'placeholder' => __('messages.setting.paystack_key')]) }}
                                </div>
                                <div class="form-group col-sm-6 mb-5">
                                    {{ Form::label('paystack_secret', __('messages.setting.paystack_secret') . ':', ['class' => 'form-label required']) }}
                                    {{ Form::text('paystack_secret', isset($setting['paystack_secret']) ? $setting['paystack_secret'] : null, ['class' => 'form-control', 'id' => 'paystackSecret', 'placeholder' => __('messages.setting.paystack_secret')]) }}
                                </div>
                            </div>
                        </div>
                        {{--  flutterwave --}}
                        <div class="col-12 d-flex align-items-center">
                            <span class="fs-3 my-3 me-3">{{ __('messages.setting.flutterwave') }}</span>
                            <label class="form-switch">
                                <input type="checkbox" name="flutterwave_enable" class="form-check-input flutterwave-enable"
                                    value="1" {{ !empty($setting['flutterwave_enable']) == '1' ? 'checked' : '' }}
                                    id="flutterwaveEnable">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </div>
                        <div
                            class="flutterwave-div {{ !empty($setting['flutterwave_enable']) == '1' ? '' : 'd-none' }} col-12">
                            <div class="row">
                                <div class="form-group col-sm-6 mb-5">
                                    {{ Form::label('flutterwave_key', __('messages.setting.flutterwave_key') . ':', ['class' => 'form-label required']) }}
                                    {{ Form::text('flutterwave_key', isset($setting['flutterwave_key']) ? $setting['flutterwave_key'] : null, ['class' => 'form-control', 'id' => 'flutterwaveKey', 'placeholder' => __('messages.setting.flutterwave_key')]) }}
                                </div>
                                <div class="form-group col-sm-6 mb-5">
                                    {{ Form::label('flutterwave_secret', __('messages.setting.flutterwave_secret') . ':', ['class' => 'form-label required']) }}
                                    {{ Form::text('flutterwave_secret', isset($setting['flutterwave_secret']) ? $setting['flutterwave_secret'] : null, ['class' => 'form-control', 'id' => 'flutterwaveSecret', 'placeholder' => __('messages.setting.flutterwave_secret')]) }}
                                </div>
                            </div>
                        </div>
                        {{-- ROZOR PAY --}}
                        <div class="">
                            <div class="col-12 d-flex align-items-center">
                                <span class="fs-3 my-3">{{ __('messages.setting.razorpay') }}</span>
                                <label class="form-check form-switch ms-3">
                                    <input class="form-check-input" type="checkbox" value="1"
                                        {{ !empty($setting['rozorpay_enable']) == '1' ? 'checked' : '' }}
                                        name="rozorpay_enable" id="rozorpayEnable">
                                    <span class="custom-switch-indicator"></span>
                                </label>
                            </div>
                            <div
                                class="razorpay-cred {{ !empty($setting['rozorpay_enable']) == '1' ? '' : 'd-none' }} col-12">
                                <div class="row">
                                    <div class="form-group col-lg-6 mb-5">
                                        {{ Form::label('razorpay_key', __('messages.setting.razorpay_key') . ':', ['class' => 'form-label razorpay-key-label mb-3 required']) }}
                                        {{ Form::text('razorpay_key', isset($setting['razorpay_key']) ? $setting['razorpay_key'] : null, ['class' => 'form-control', 'id' => 'razorpayKey', 'placeholder' => __('messages.setting.razorpay_key')]) }}
                                    </div>
                                    <div class="form-group col-lg-6 mb-5">
                                        {{ Form::label('razorpay_secret', __('messages.setting.razorpay_secret') . ':', ['class' => 'form-label razorpay-secret-label mb-3 required']) }}
                                        {{ Form::text('razorpay_secret', isset($setting['razorpay_secret']) ? $setting['razorpay_secret'] : null, ['class' => 'form-control', 'id' => 'razorpaySecret', 'placeholder' => __('messages.setting.razorpay_secret')]) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--  Phonepe --}}
                        <div class="col-12 d-flex align-items-center">
                            <span class="fs-3 my-3">{{ __('messages.setting.phonepe') }}</span>
                            <label class="form-check form-switch ms-3">
                                <input type="checkbox" name="phonepe_enable" class="form-check-input phonepe-enable"
                                    value="1" {{ !empty($setting['phonepe_enable']) == '1' ? 'checked' : '' }}
                                    id="phonepeEnable">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </div>
                        <div class="phonepe-div {{ !empty($setting['phonepe_enable']) == '1' ? '' : 'd-none' }} col-12">
                            <div class="row">
                                <div class="form-group col-lg-6 mb-5">
                                    {{ Form::label('phonepe_merchant_id', __('messages.setting.phonepe_merchant_id') . ':', ['class' => 'form-label mb-3 required']) }}
                                    {{ Form::text('phonepe_merchant_id', isset($setting['phonepe_merchant_id']) ? $setting['phonepe_merchant_id'] : null, ['class' => 'form-control  phonepe_merchant_id', 'id' => 'phonepeMerchantId', 'placeholder' => __('messages.setting.phonepe_merchant_id')]) }}
                                </div>
                                <div class="form-group col-lg-6 mb-5">
                                    {{ Form::label('phonepe_merchant_user_id', __('messages.setting.phonepe_merchant_user_id') . ':', ['class' => 'form-label stripe-secret-label mb-3 required']) }}
                                    {{ Form::text('phonepe_merchant_user_id', isset($setting['phonepe_merchant_user_id']) ? $setting['phonepe_merchant_user_id'] : null, ['class' => 'form-control phonepe_merchant_user_id ', 'id' => 'phonepeMerchantUserId', 'placeholder' => __('messages.setting.phonepe_merchant_user_id')]) }}
                                </div>
                                <div class="form-group col-lg-6 mb-5">
                                    {{ Form::label('phonepe_env', __('messages.setting.phonepe_env') . ':', ['class' => 'form-label mb-3 required']) }}
                                    {{ Form::text('phonepe_env', isset($setting['phonepe_env']) ? $setting['phonepe_env'] : null, ['class' => 'form-control  phonepe_env ', 'id' => 'phonepeEnv', 'placeholder' => __('messages.setting.phonepe_env')]) }}
                                </div>
                                <div class="form-group col-lg-6 mb-5">
                                    {{ Form::label('phonepe_salt_key', __('messages.setting.phonepe_salt_key') . ':', ['class' => 'form-label stripe-secret-label mb-3 required']) }}
                                    {{ Form::text('phonepe_salt_key', isset($setting['phonepe_salt_key']) ? $setting['phonepe_salt_key'] : null, ['class' => 'form-control phonepe_salt_key ', 'id' => 'phonepeSaltKey', 'placeholder' => __('messages.setting.phonepe_salt_key')]) }}
                                </div>
                                <div class="form-group col-lg-6 mb-5">
                                    {{ Form::label('phonepe_salt_index', __('messages.setting.phonepe_salt_index') . ':', ['class' => 'form-label mb-3 required']) }}
                                    {{ Form::text('phonepe_salt_index', isset($setting['phonepe_salt_index']) ? $setting['phonepe_salt_index'] : null, ['class' => 'form-control  phonepe_salt_index ', 'id' => 'phonepeSaltIndex', 'placeholder' => __('messages.setting.phonepe_salt_index')]) }}
                                </div>
                            </div>
                        </div>
                        {{--  PAYPAL --}}
                        <div class="col-12 d-flex align-items-center">
                            <span class="fs-3 my-3">{{ __('messages.setting.paypal') }}</span>
                            <label class="form-check form-switch ms-3">
                                <input type="checkbox" name="paypal_enable" class="form-check-input paypal-enable"
                                    value="1" {{ !empty($setting['paypal_enable']) == '1' ? 'checked' : '' }}
                                    id="paypalEnable">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </div>
                        <div class="row">
                            <div
                                class="form-group col-sm-6 mb-5 paypal-div {{ !empty($setting['paypal_enable']) == '1' ? '' : 'd-none' }} col-12">
                                {{ Form::label('paypal_client_id', __('messages.setting.paypal_client_id') . ':', ['class' => 'form-label required']) }}
                                {{ Form::text('paypal_client_id', !empty($setting['paypal_client_id']) ? $setting['paypal_client_id'] : null, ['class' => 'form-control', 'id' => 'paypalKey', 'placeholder' => __('messages.setting.paypal_client_id')]) }}
                            </div>
                            <div
                                class="form-group col-sm-6 mb-5 paypal-div {{ !empty($setting['paypal_enable']) == '1' ? '' : 'd-none' }} col-12">
                                {{ Form::label('paypal_secret', __('messages.setting.paypal_secret') . ':', ['class' => 'form-label required']) }}
                                {{ Form::text('paypal_secret', !empty($setting['paypal_secret']) ? $setting['paypal_secret'] : null, ['class' => 'form-control', 'id' => 'paypalSecret', 'placeholder' => __('messages.setting.paypal_secret')]) }}
                            </div>
                            <div
                                class="form-group col-sm-6 mb-5 paypal-div {{ !empty($setting['paypal_enable']) == '1' ? '' : 'd-none' }} col-12">
                                {{ Form::label('paypal_mode', __('messages.setting.paypal_mode') . ':', ['class' => 'form-label required']) }}
                                {{ Form::text('paypal_mode', !empty($setting['paypal_mode']) ? $setting['paypal_mode'] : null, ['class' => 'form-control', 'id' => 'paypalMode', 'placeholder' => __('messages.setting.paypal_mode')]) }}
                            </div>
                        </div>
                        {{-- MANUALLY --}}
                        <div class="col-12 d-flex align-items-center">
                            <span class="fs-3 my-3">{{ __('messages.setting.manually') }}</span>
                            <label class="form-check form-switch ms-3">
                                <input type="checkbox" name="manually_payment"
                                    class="form-check-input manually-payment-enable" value="1"
                                    {{ !empty($setting['manually_payment']) == '1' ? 'checked' : '' }}
                                    id="userManualPaymentSetting">
                                <span class="custom-switch-indicator"></span>&nbsp;&nbsp;
                            </label>
                        </div>
                        <div
                            class="col-lg-10 row user-manually-cred{{ (isset($setting['manually_payment']) && $setting['manually_payment'] == false) || empty($setting['manually_payment']) ? ' d-none' : '' }}">
                            {{ Form::hidden('manual_payment_guide', isset($setting['manual_payment_guide']) ? $setting['manual_payment_guide'] : '', ['id' => 'manualPaymentGuideData']) }}
                            <div class="col-lg-12">
                                <div class="mb-5">
                                    {{ Form::label('manual_payment_guide', __('messages.vcard.manual_payment_guide') . ':', ['class' => 'form-label']) }}
                                    <div id="manualPaymentGuideId" class="editor-height" style="height: 200px">
                                    </div>
                                    {{ Form::hidden('manual_payment_guide', null, ['id' => 'guideData']) }}
                                </div>
                            </div>
                        </div>
                        {{--  Notifation --}}
                        {{-- <div class="col-12 d-flex align-items-center">
                            <span class="fs-3 my-3 me-3">{{ __('messages.setting.notification') }}</span>
                            <label class="form-switch">
                                <input type="checkbox" name="notifation_enable" class="form-check-input notifation-enable"
                                    value="1" {{ !empty($setting['notifation_enable']) == '1' ? 'checked' : '' }}
                                    id="notifationEnable">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </div>
                        <div class="notifation-div {{ !empty($setting['notifation_enable']) == '1' ? '' : 'd-none' }} col-12">
                            <div class="row">
                                <div class="form-group col-sm-6 mb-5">
                                    {{ Form::label('onesignal_app_id', __('messages.setting.onesignal_app_id') . ':', ['class' => 'form-label']) }}
                                    {{ Form::text('onesignal_app_id', isset($setting['onesignal_app_id']) ? $setting['onesignal_app_id'] : null, ['class' => 'form-control', 'id' => 'onesignalAppId', 'placeholder' => __('messages.setting.onesignal_app_id')]) }}
                                </div>
                                <div class="form-group col-sm-6 mb-5">
                                    {{ Form::label('onesignal_rest_api_key', __('messages.setting.onesignal_rest_api_key') . ':', ['class' => 'form-label']) }}
                                    {{ Form::text('onesignal_rest_api_key', isset($setting['onesignal_rest_api_key']) ? $setting['onesignal_rest_api_key'] : null, ['class' => 'form-control', 'id' => 'onesignalRestApiKey', 'placeholder' => __('messages.setting.onesignal_rest_api_key')]) }}
                                </div>
                            </div>
                        </div> --}}
                    </div>

                    <button type="submit" class="btn btn-primary"
                        id="userCredentialSettingBtn">{{ __('messages.common.save') }}</button>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    @endsection
