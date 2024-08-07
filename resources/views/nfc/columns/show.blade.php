@extends('layouts.app')
@section('title')
    {{ __('messages.nfc.nfc_card_order_details') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-5">
            <h1 class="mb-0">@yield('title')</h1>
            <div class="text-end mt-4 mt-md-0">
                <a href="{{ route('user.orders') }}">
                    <button type="button"
                        class="btn btn-outline-primary float-end mb-5">{{ __('messages.common.back') }}</button>
                </a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="card card-check">
                <div class="card-body card-body-check">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="overview" role="tabpanel"
                            aria-labelledby="overview-tab">
                            <div class="row">
                                <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                    <label for="name"
                                        class="pb-2 fs-4 text-gray-600">{{ __('messages.vcard.user_name') }}:</label>
                                    <span class="fs-4 text-gray-800">{{ $nfcCardOrder->name }}</span>
                                </div>
                                <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                    <label for="name"
                                        class="pb-2 fs-4 text-gray-600">{{ __('messages.nfc.nfc_card_type') }}:</label>
                                    <span class="fs-4 text-gray-800">{{ $nfcCardOrder->nfcCard->name }}</span>
                                </div>
                                @if (!@empty($nfcCardOrder->vcard->name))
                                    <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                        <label for="name"
                                            class="pb-2 fs-4 text-gray-600">{{ __('messages.vcard.vcard') }}:</label>
                                        <span class="fs-4"><a
                                                href="{{ route('vcard.show', ['alias' => $nfcCardOrder->vcard->url_alias]) }}"
                                                class="text-info-800 text-decoration-none"
                                                target="_blank">{{ $nfcCardOrder->vcard->name }}</a></span>
                                    </div>
                                @endif
                                <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                    <label for="name"
                                        class="pb-2 fs-4 text-gray-600">{{ __('messages.nfc.company_name') }}:</label>
                                    <span class="fs-4 text-gray-800">{{ $nfcCardOrder->company_name }}</span>
                                </div>
                                <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                    <label for="name"
                                        class="pb-2 fs-4 text-gray-600">{{ __('messages.setting.shipping_address') }}:</label>
                                    <span class="fs-4 text-gray-800">{{ $nfcCardOrder->address }}</span>
                                </div>
                                <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                    <label for="name"
                                        class="pb-2 fs-4 text-gray-600">{{ __('messages.nfc.order_status') }}:</label>
                                    <div>
                                        @if ($nfcCardOrder->order_status == '0')
                                            <span class="badge bg-light-info">{{ __('messages.nfc.Pending') }}</span>
                                        @elseif ($nfcCardOrder->order_status == '1')
                                            <span
                                                class="badge bg-light-warning">{{ __('messages.nfc.Ready To Ship') }}</span>
                                        @elseif ($nfcCardOrder->order_status == '2')
                                            <span class="badge bg-light-primary">{{ __('messages.nfc.Shipped') }}</span>
                                        @elseif ($nfcCardOrder->order_status == '3')
                                            <span class="badge bg-light-success">{{ __('messages.nfc.Delivered') }}</span>
                                        @else
                                            <span class="badge bg-light-danger">{{ __('messages.nfc.Cancelled') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                    <label for="name"
                                        class="pb-2 fs-4 text-gray-600">{{ __('messages.vcard.created_at') }}:</label>
                                    <span
                                        class="fs-4 text-gray-800">  {{ (getFormattedDateTime($nfcCardOrder->created_at))}}</span>
                                </div>

                                <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                    <label for="name"
                                        class="pb-2 fs-4 text-gray-600">{{ __('messages.nfc.payment_status') }}:</label>

                                    <span class="fs-4 text-gray-800">
                                        @if (empty($nfcCardOrder->nfcTransaction) || $nfcCardOrder->nfcTransaction->status == App\Models\NfcOrders::FAIL)
                                            <span class="badge bg-light-danger">{{ __('messages.nfc.failed') }}</span>
                                        @else
                                            @if ($nfcCardOrder->nfcTransaction->status == App\Models\NfcOrders::PENDING)
                                                <span
                                                    class="badge bg-light-primary">{{ __('messages.nfc.Pending') }}</span>
                                            @else
                                                <span class="badge bg-light-success">{{ __('messages.nfc.paid') }}</span>
                                            @endif
                                        @endif
                                    </span>
                                </div>
                                <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                    <label for="name"
                                        class="pb-2 fs-4 text-gray-600">{{ __('messages.payment_type') }}:</label>
                                    @if (empty($nfcCardOrder->nfcTransaction->type))
                                        <span>{{ __('messages.nfc.failed') }}</span>
                                    @else
                                        <span
                                            class="fs-4 text-gray-800">{{ __('messages.setting.' . App\Models\NfcOrders::PAYMENT_TYPE_ARR[$nfcCardOrder->nfcTransaction->type]) }}</span>
                                    @endif
                                </div>
                                <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                    <label for="name"
                                        class="pb-2 fs-4 text-gray-600">{{ __('messages.nfc.logo') }}:</label>
                                    @if ($nfcCardOrder->getMedia('nfc_order_logo')->isNotEmpty())
                                        <img class="object-contain" src="{{ $nfcCardOrder->getMedia('nfc_order_logo')->first()->getFullUrl() }}"
                                            width="150" height="100" alt="Company Logo">
                                    @else
                                        <p>{{ __('messages.no_data') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
