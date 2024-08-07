@extends('settings.edit')
@section('section')
    <div class="card w-100">
        <div class="card-body d-flex">
            @include('settings.setting_menu')
            <div class="w-100">
            <div class="card-header px-0">
                <div class="d-flex align-items-center justify-content-center">
                    <h3 class="m-0">{{ __('messages.payment_method') }}
                    </h3>
                </div>
            </div>
            <div class="card-body border-top p-3">
                {{ Form::open(['route' => ['payment.method.update'], 'method' => 'post','id' =>'SuperAdminCredentialsSettings']) }}
                <div class="">
                    <div class="form-group mb-5 mt-10">
                        <label class="form-check form-switch form-check-custom ">
                            <input class="form-check-input" type="checkbox" value="{{ \App\Models\Plan::STRIPE }}"
                                name="payment_gateway[{{ \App\Models\Plan::STRIPE }}]"
                                {{ isset($selectedPaymentGateways['Stripe']) ? 'checked' : '' }} id="stripe_payment">
                            <span class="form-check-label fw-bold"
                                for="flexSwitchCheckDefault">{{ __('messages.setting.stripe') }}</span>&nbsp;&nbsp;
                        </label>
                    </div>
                    <div class="col-lg-10 row stripe-cred {{ !isset($selectedPaymentGateways['Stripe']) ? 'd-none' : '' }}">
                        <div class="form-group col-lg-6 mb-5">
                            {{ Form::label('stripe_key', __('messages.setting.stripe_key') . ':', ['class' => 'form-label mb-3 required']) }}
                            {{ Form::text('stripe_key', $setting['stripe_key'], ['class' => 'form-control  stripe-key ', 'placeholder' => __('messages.setting.stripe_key')]) }}
                        </div>
                        <div class="form-group col-lg-6 mb-5">
                            {{ Form::label('stripe_secret', __('messages.setting.stripe_secret') . ':', ['class' => 'form-label stripe-secret-label mb-3 required']) }}
                            {{ Form::text('stripe_secret', $setting['stripe_secret'], ['class' => 'form-control stripe-secret ', 'placeholder' => __('messages.setting.stripe_secret')]) }}
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="form-group mb-5 mt-10">
                        <label class="form-check form-switch form-check-custom ">
                            <input class="form-check-input" type="checkbox" value="{{ \App\Models\Plan::PAYPAL }}"
                                name="payment_gateway[{{ \App\Models\Plan::PAYPAL }}]" id="paypal_payment"
                                {{ isset($selectedPaymentGateways['Paypal']) ? 'checked' : '' }}>
                            <span class="form-check-label fw-bold"
                                for="flexSwitchCheckDefault">{{ __('messages.setting.paypal') }}</span>&nbsp;&nbsp;
                        </label>
                    </div>
                    <div
                        class="col-lg-10 row paypal-cred {{ !isset($selectedPaymentGateways['Paypal']) ? 'd-none' : '' }}">
                        <div class="form-group col-lg-6 mb-5">
                            {{ Form::label('paypal_client_id', __('messages.setting.paypal_client_id') . ':', ['class' => 'form-label paypal-client-id-label mb-3 required']) }}
                            {{ Form::text('paypal_client_id', $setting['paypal_client_id'], ['class' => 'form-control  paypal-client-id ', 'placeholder' => __('messages.setting.paypal_client_id')]) }}
                        </div>
                        <div class="form-group col-lg-6 mb-5">
                            {{ Form::label('paypal_secret', __('messages.setting.paypal_secret') . ':', ['class' => 'form-label paypal-secret-label mb-3 required']) }}
                            {{ Form::text('paypal_secret', $setting['paypal_secret'], ['class' => 'form-control paypal-secret ', 'placeholder' => __('messages.setting.paypal_secret')]) }}
                        </div>
                        <div class="form-group col-lg-4 mb-5">
                            {{ Form::label('paypal_mode', __('messages.setting.paypal_mode') . ':', ['class' => 'form-label paypal-secret-label mb-3 required']) }}
                            {{ Form::select('paypal_mode', $paypalMode, $setting['paypal_mode'], ['class' => 'form-control paypal-secret ', 'data-control' => 'select2', 'data-minimum-results-for-search' => 'Infinity']) }}
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="form-group mb-5 mt-10">
                        <label class="form-check form-switch form-check-custom ">
                            <input class="form-check-input" type="checkbox" value="{{ \App\Models\Plan::RAZORPAY }}"
                                name="payment_gateway[{{ \App\Models\Plan::RAZORPAY }}]" id="razorpay_payment"
                                {{ isset($selectedPaymentGateways['Razorpay']) ? 'checked' : '' }}>
                            <span class="form-check-label fw-bold"
                                for="razorpay">{{ __('messages.setting.razorpay') }}</span>&nbsp;&nbsp;
                        </label>
                    </div>
                    <div
                        class="col-lg-10 row razorpay-cred {{ !isset($selectedPaymentGateways['Razorpay']) ? 'd-none' : '' }}">
                        <div class="form-group col-lg-6 mb-5">
                            {{ Form::label('razorpay_key', __('messages.setting.razorpay_key') . ':', ['class' => 'form-label razorpay-key-label mb-3 required']) }}
                            {{ Form::text('razorpay_key', $setting['razorpay_key'], ['class' => 'form-control razorpay-key ', 'placeholder' => __('messages.setting.razorpay_key')]) }}
                        </div>
                        <div class="form-group col-lg-6 mb-5">
                            {{ Form::label('razorpay_secret', __('messages.setting.razorpay_secret') . ':', ['class' => 'form-label razorpay-secret-label mb-3 required']) }}
                            {{ Form::text('razorpay_secret', $setting['razorpay_secret'], ['class' => 'form-control razorpay-secret ', 'placeholder' => __('messages.setting.razorpay_secret')]) }}
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="form-group mb-5 mt-10">
                        <label class="form-check form-switch form-check-custom ">
                            <input class="form-check-input" type="checkbox" value="{{ \App\Models\Plan::FLUTTERWAVE }}"
                                name="payment_gateway[{{ \App\Models\Plan::FLUTTERWAVE }}]" id="flutterwave_payment"
                                {{ isset($selectedPaymentGateways['Flutterwave']) ? 'checked' : '' }}>
                            <span class="form-check-label fw-bold"
                                for="flutterwave">{{ __('messages.setting.flutterwave') }}</span>&nbsp;&nbsp;
                        </label>
                    </div>
                    <div
                        class="col-lg-10 row flutterwave-cred {{ !isset($selectedPaymentGateways['Flutterwave']) ? 'd-none' : '' }}">
                        <div class="form-group col-lg-6 mb-5">
                            {{ Form::label('flutterwave_key', __('messages.setting.flutterwave_key') . ':', ['class' => 'form-label razorpay-key-label mb-3 required']) }}
                            {{ Form::text('flutterwave_key', $setting['flutterwave_key'], ['class' => 'form-control flutterwave-key ', 'placeholder' => __('messages.setting.flutterwave_key')]) }}
                        </div>
                        <div class="form-group col-lg-6 mb-5">
                            {{ Form::label('flutterwave_secret', __('messages.setting.flutterwave_secret') . ':', ['class' => 'form-label razorpay-secret-label mb-3 required']) }}
                            {{ Form::text('flutterwave_secret', $setting['flutterwave_secret'], ['class' => 'form-control flutterwave-secret ', 'placeholder' => __('messages.setting.flutterwave_secret')]) }}
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="form-group mb-5 mt-10">
                        <label class="form-check form-switch form-check-custom">
                            <input class="form-check-input" type="checkbox" value="{{ \App\Models\Plan::PAYSTACK }}"
                                name="payment_gateway[{{ \App\Models\Plan::PAYSTACK }}]"
                                {{ isset($selectedPaymentGateways['Paystack']) ? 'checked' : '' }} id="paystack_payment">
                            <span class="form-check-label fw-bold"
                                for="manually_payment">{{ __('messages.setting.paystack') }}</span>&nbsp;&nbsp;
                        </label>
                    </div>
                    <div class="col-lg-10 row paystack-cred {{ !isset($selectedPaymentGateways['Paystack']) ? 'd-none' : '' }}">
                        <div class="form-group col-lg-6 mb-5">
                            {{ Form::label('paystack_key', __('messages.setting.paystack_key') . ':', ['class' => 'form-label mb-3 required']) }}
                            {{ Form::text('paystack_key', $setting['paystack_key'], ['class' => 'form-control  paystack-key ', 'placeholder' => __('messages.setting.paystack_key')]) }}
                        </div>
                        <div class="form-group col-lg-6 mb-5">
                            {{ Form::label('paystack_secret', __('messages.setting.paystack_secret') . ':', ['class' => 'form-label stripe-secret-label mb-3 required']) }}
                            {{ Form::text('paystack_secret', $setting['paystack_secret'], ['class' => 'form-control paystack-secret ', 'placeholder' => __('messages.setting.paystack_secret')]) }}
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="form-group mb-5 mt-10">
                        <label class="form-check form-switch form-check-custom">
                            <input class="form-check-input" type="checkbox" value="{{ \App\Models\Plan::PHONEPE }}"
                                name="payment_gateway[{{ \App\Models\Plan::PHONEPE }}]"
                                {{ isset($selectedPaymentGateways['PhonePe']) ? 'checked' : '' }} id="phonepe_payment">
                            <span class="form-check-label fw-bold"
                                for="phonepe_payment">{{ __('messages.setting.phonepe') }}</span>&nbsp;&nbsp;
                        </label>
                    </div>
                    <div class="col-lg-10 row phonepe-cred {{ !isset($selectedPaymentGateways['PhonePe']) ? 'd-none' : '' }}">
                        <div class="form-group col-lg-6 mb-5">
                            {{ Form::label('phonepe_merchant_id', __('messages.setting.phonepe_merchant_id') . ':', ['class' => 'form-label mb-3 required']) }}
                            {{ Form::text('phonepe_merchant_id', $setting['phonepe_merchant_id'], ['class' => 'form-control  phonepe_merchant_id ', 'placeholder' => __('messages.setting.phonepe_merchant_id')]) }}
                        </div>
                        <div class="form-group col-lg-6 mb-5">
                            {{ Form::label('phonepe_merchant_user_id', __('messages.setting.phonepe_merchant_user_id') . ':', ['class' => 'form-label stripe-secret-label mb-3 required']) }}
                            {{ Form::text('phonepe_merchant_user_id', $setting['phonepe_merchant_user_id'], ['class' => 'form-control phonepe_merchant_user_id ', 'placeholder' => __('messages.setting.phonepe_merchant_user_id')]) }}
                        </div>
                        <div class="form-group col-lg-6 mb-5">
                            {{ Form::label('phonepe_env', __('messages.setting.phonepe_env') . ':', ['class' => 'form-label mb-3 required']) }}
                            {{ Form::text('phonepe_env', $setting['phonepe_env'], ['class' => 'form-control  phonepe_env ', 'placeholder' => __('messages.setting.phonepe_env')]) }}
                        </div>
                        <div class="form-group col-lg-6 mb-5">
                            {{ Form::label('phonepe_salt_key', __('messages.setting.phonepe_salt_key') . ':', ['class' => 'form-label stripe-secret-label mb-3 required']) }}
                            {{ Form::text('phonepe_salt_key', $setting['phonepe_salt_key'], ['class' => 'form-control phonepe_salt_key ', 'placeholder' => __('messages.setting.phonepe_salt_key')]) }}
                        </div>
                        <div class="form-group col-lg-6 mb-5">
                            {{ Form::label('phonepe_salt_index', __('messages.setting.phonepe_salt_index') . ':', ['class' => 'form-label mb-3 required']) }}
                            {{ Form::text('phonepe_salt_index', $setting['phonepe_salt_index'], ['class' => 'form-control  phonepe_salt_index ', 'placeholder' => __('messages.setting.phonepe_salt_index')]) }}
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="form-group mb-5 mt-10">
                        <label class="form-check form-switch form-check-custom">
                            <input class="form-check-input" type="checkbox" value="{{ \App\Models\Plan::MANUALLY }}"
                                name="payment_gateway[{{ \App\Models\Plan::MANUALLY }}]"
                                {{ isset($selectedPaymentGateways['Manually']) ? 'checked' : '' }} id="manually_payment">
                            <span class="form-check-label fw-bold"
                                for="manually_payment">{{ __('messages.setting.manually') }}</span>&nbsp;&nbsp;
                        </label>
                    </div>
                    <div class="col-lg-10 row manually-cred{{ !isset($selectedPaymentGateways['Manually']) ? ' d-none' : '' }}">
                        {{ Form::hidden('manual_payment_guide', $setting['manual_payment_guide'], ['id' => 'manualPaymentGuideData']) }}
                        {{ Form::hidden('is_manual_payment_guide_on',$setting['is_manual_payment_guide_on'],['id' => 'isManualPaymentGuideOnData']) }}
                        <div class="col-lg-12">
                            <div class="mb-5">
                                {{ Form::label('manual_payment_guide', __('messages.vcard.manual_payment_guide').':', ['class' => 'form-label']) }}
                                <div id="manualPaymentGuideId" class="editor-height" style="height: 200px"></div>
                                {{ Form::hidden('manual_payment_guide', null, ['id' => 'guideData']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3', 'data-turbo' => 'false']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
    </div>
@endsection
