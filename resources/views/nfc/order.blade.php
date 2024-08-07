@extends('layouts.app')
@section('title')
    {{ __('messages.nfc.order_nfc') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            @include('layouts.errors')
        </div>
        <div class="d-flex justify-content-between align-items-end mb-5">
            <h1>{{ __('messages.nfc.order_nfc') }}</h1>
            <a class="btn btn-outline-primary float-end"
                href="{{ route('user.orders') }}">{{ __('messages.common.back') }}</a>
        </div>

        <div class="card">
            <div class="card-body">
                <form data-turbo="false" method="post" id="orderNfcForm" class="order-nfc-card-form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label required">{{ __('messages.nfc.nfc_card_type') }}</label>
                        </div>
                        @foreach ($nfcCards as $nfcCard)
                        <div class="col-md-4 col-sm-6 g-5 nfccard" data-id="{{ $nfcCard['id'] }}">
                            <div class="flip-card">
                                <div class="flip-card-inner">
                                    <div class="flip-card-front">
                                        <div class="card nfc-img-radio img-fluid" data-id="{{ $nfcCard['id'] }}">
                                            @if (!empty($nfcCard['media']) && count($nfcCard['media']) > 0)
                                            <img src="{{ $nfcCard->nfc_image }}"
                                                class="card-img-top rounded nfc-card-img"
                                                alt="{{ $nfcCard['media'][0]['original_url'] }}" />
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flip-card-back">
                                        <div class="card nfc-img-radio img-fluid" data-id="{{ $nfcCard['id'] }}">
                                        @if (!empty($nfcCard['media']) && count($nfcCard['media']) > 0)
                                            <img src="{{ $nfcCard->nfc_back_image }}"
                                                class="card-img-top rounded nfc-card-img"
                                                alt="{{ $nfcCard['media'][0]['original_url'] }}" />
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="row mt-5 nfc-price fs-3" id="nfc-price">
                                    <div class="col-sm-8 p-0">{{ $nfcCard['name'] }}</div>
                                    <div class="col-sm-4 text-primary p-0">
                                        {{ $currency . number_format($nfcCard['price'], 2) }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                        <input type="hidden" name="card_type" id="card-id">
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="nfcCardDetailModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="nfc-details">
                                <div class="modal-body p-0">
                                    <input type="hidden" id="selectedNfcCardData">
                                    <div class="row">
                                        <div class="col-12 col-lg-6 image-section">
                                            <div class="text-end">
                                                <button type="button" class="px-3 image-btn-close d-none" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="nfc-flip-card">
                                                <div class="nfc-flip-card-inner">
                                                    <div class="nfc-flip-card-front">
                                                        <div class="h-100 w-100">
                                                            <img id="nfcProductImg" class="w-100">
                                                        </div>
                                                    </div>
                                                    <div class="nfc-flip-card-back">
                                                        <div class="card" data-id="{{ $nfcCard['id'] }}">
                                                            <div class="h-100 w-100">
                                                                <img id="nfcProductBackImg" class="w-100">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6 p-8 nfc-form-section">
                                            <div class="text-end">
                                                <button type="button" class="px-3 btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <p id="name" class="fs-2 fw-bold"></p>
                                            <p id="description" class="text-secondary fs-6"></p>
                                            <p id="price" class="text-primary fs-2"></p>
                                            <div class="counter">
                                                <span class="down decreaseCount">-</span>
                                                <input type="number" value="1" name="quantity" class="quantity">
                                                <span class="up increaseCount">+</span>
                                            </div>
                                            <div class="text-center">
                                                <button type="button" class="btn btn-primary text-center buy-now"
                                                    data-bs-toggle="modal" data-bs-target="#nfcOrderFormModal">{{ __('messages.subscription.buy_now') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- order form modal --}}
                    <div class="modal fade" id="nfcOrderFormModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="nfc-form">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 mt-4">
                                            <label
                                                class="form-label required">{{ __('messages.vcard.vcard_name') }}</label>
                                            <select id="vcard-id" name="vcard_id" required>
                                                <option selected disabled>{{ __('messages.nfc.select_vcard') }}</option>
                                                @foreach ($vcards as $id => $vcard)
                                                    <option value="{{ $id }}" @selected(old('vcard_id'))>
                                                        {{ $vcard }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 mt-4">
                                            <label
                                                class="form-label required">{{ __('messages.nfc.company_name') }}</label>
                                            <input type="text" class="form-control" name="company_name" id="companyName"
                                                required value="{{ old('company_name') }}"
                                                placeholder="{{ __('messages.form.company') }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mt-4">
                                            <label class="form-label required">{{ __('messages.common.name') }}</label>
                                            <input type="text" class="form-control" name="name" id="e-card-name"
                                                required value="{{ old('name') }}"
                                                placeholder="{{ __('messages.form.enter_name') }}">
                                        </div>
                                        <div class="col-md-6 mt-4">
                                            <label class="form-label required">{{ __('messages.common.email') }}</label>
                                            <input type="text" class="form-control" name="email" id="e-card-email"
                                                required value="{{ old('email') }}"
                                                placeholder="{{ __('messages.form.enter_email') }}">
                                        </div>
                                        <div class="col-md-6  mt-4">
                                            <div class="form-group">
                                                {{ Form::label('phone', __('messages.common.phone') . ':', ['class' => 'form-label required']) }}
                                                {{ Form::text('phone', old('phone'), ['class' => 'form-control',  'placeholder' => __('messages.form.phone'), 'required' , 'id' => 'phoneNumber', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
                                                {{ Form::hidden('region_code', null, ['id' => 'regionCode']) }}
                                                <div class="mt-2">
                                                    <span id="valid-msg" class="text-success d-none fw-400 fs-small mt-2">{{ __('messages.placeholder.valid_number') }}</span>
                                                    <span id="error-msg" class="text-danger d-none fw-400 fs-small mt-2">{{__('messages.placeholder.invalid_number')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-4">
                                            <label
                                                class="form-label required">{{ __('messages.nfc.designation') }}</label>
                                            <input type="text" class="form-control" name="designation"
                                                id="e-card-occupation" required value="{{ old('designation') }}"
                                                placeholder="{{ __('messages.form.designation') }}">
                                        </div>
                                        <div class="col-md-6 mt-4">
                                            <label
                                                class="form-label required">{{ __('messages.setting.shipping_address') }}</label>
                                            <input type="text" class="form-control" name="address"
                                                id="e-card-location" required value="{{ old('address') }}"
                                                placeholder="{{ __('messages.nfc.enter_address') }}">
                                        </div>
                                        @php
                                            $translatedPaymentTypes = collect($paymentTypes)->map(function ($value) {
                                                return trans('messages.' . $value);
                                            });
                                        @endphp
                                        <div class="col-md-6 mt-4">
                                            <label
                                            class="form-label required">{{ __('messages.select_payment_type') }}</label>
                                            {{ Form::select('payment_method', $translatedPaymentTypes, null, ['class' => 'form-select paymentType', 'required', 'id' => 'paymentType', 'data-control' => 'select2', 'placeholder' => __('messages.select_payment_type')]) }}
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-3">
                                        <div class="row">
                                            <div class="form-group col-sm-6 mb-3">
                                                <div class="mb-3" io-image-input="true">
                                                    <label for="appLogoPreview"
                                                        class="form-label required">{{ __('messages.nfc.logo') }}</label>
                                                    <div class="d-block">
                                                        <div class="image-picker">
                                                            <div class="image previewImage" id="appLogoPreview"
                                                                style="background-image: url('{{ asset('assets/img/nfc/nfc_default_logo.png') }}')">
                                                            </div>
                                                            <span class="picker-edit rounded-circle text-gray-500 fs-small"
                                                                data-bs-toggle="tooltip" data-placement="top"
                                                                data-bs-original-title="{{ '' }}">
                                                                <label>
                                                                    <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                                                    <input type="file" id="compan" name="logo"
                                                                        class="image-upload d-none" accept="image/*" />
                                                                </label>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                    @if (getSuperAdminSettingValue('is_manual_payment_guide_on'))
                                    <div class="col-12 d-none mt-5 plan-controls manuallyPayAttachment">
                                        {!! getSuperAdminSettingValue('manual_payment_guide') !!}
                                    </div>
                                    @endif
                                </div>
                                    <div class="">
                                        <div class="row row-cols-4 text-center">
                                            <div class="col-2"></div>
                                            <div class="col-4"><button type="submit" class="btn btn-primary order-btn"
                                                    id="order-btn">
                                                    {{ __('messages.nfc.order') }}
                                                </button></div>
                                            <div class="col-4"> <a href="{{ route('user.orders') }}"
                                                    class="btn btn-secondary discard-btn">{{ __('messages.common.discard') }}</a>
                                            </div>
                                            <div class="col-2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@pushOnce('scripts')
    <script>
        let options = {
            'key': "{{ getSelectedPaymentGateway('razorpay_key') }}",
            'amount': 0, //  100 refers to 1
            'currency': 'INR',
            'name': "{{ getAppName() }}",
            'order_id': '',
            'description': '',
            'image': '{{ asset(getAppLogo()) }}', // logo here
            'callback_url': "{{ route('nfc.razorpay.success') }}",
            'prefill': {
                'email': '', // recipient email here
                'name': '', // recipient name here
                'contact': '', // recipient phone here
            },
            'readonly': {
                'name': 'true',
                'email': 'true',
                'contact': 'true',
            },
            'theme': {
                'color': '#0ea6e9',
            },
            'modal': {
                'ondismiss': function() {
                    $('#paymentGatewayModal').modal('hide');
                    displayErrorMessage(Lang.get('js.payment_not_complete'));
                    setTimeout(function() {
                        Turbo.visit(window.location.href);
                    }, 1000);
                },
            },
        };
    </script>
@endPushOnce
