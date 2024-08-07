@extends('layouts.app')
@section('title')
    {{ __('messages.product_details') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-5">
            <h1 class="mb-0">@yield('title')</h1>
            <div class="text-end mt-4 mt-md-0">
                <a href="{{ route('product-orders.index') }}">
                    <button type="button" class="btn btn-outline-primary float-end">{{ __('messages.common.back') }}</button>
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
                                    <label for="name" class="pb-2 fs-4 text-gray-600">{{__('messages.vcard.product_name') }}:</label>
                                    <span class="fs-4 text-gray-800">{{ $productTransaction->product->name }}</span>
                                </div>
                                <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                    <label for="name" class="pb-2 fs-4 text-gray-600">{{__('messages.mail.name') }}</label>
                                    <span class="fs-4 text-gray-800">{{ $productTransaction->name }}</span>
                                </div>
                                <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                    <label for="name" class="pb-2 fs-4 text-gray-600">{{__('messages.admin.email') }}:</label>
                                    <span class="fs-4 text-gray-800">{{ $productTransaction->email }}</span>
                                </div>
                                @if ($productTransaction->phone)
                                    <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                        <label for="name" class="pb-2 fs-4 text-gray-600">{{__('messages.user.phone') }}:</label>
                                        <span class="fs-4 text-gray-800">{{ $productTransaction->phone }}</span>
                                    </div>
                                @endif
                                <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                    <label for="name" class="pb-2 fs-4 text-gray-600">{{__('messages.payment_type') }}:</label>
                                    <span class="fs-4 text-gray-800">{{ __('messages.'.App\Models\Product::PAYMENT_METHOD[$productTransaction->type]) }}</span>
                                </div>
                                <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                    <label for="name" class="pb-2 fs-4 text-gray-600">{{__('messages.subscription.amount') }}:</label>
                                    <span class="fs-4 text-gray-800">{{ $productTransaction->currency->currency_icon }}{{ number_format($productTransaction->amount, 2) }}</span>
                                </div>
                                <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                    <label for="name" class="pb-2 fs-4 text-gray-600">{{__('messages.setting.address') }}:</label>
                                    <span class="fs-4 text-gray-800">{{ $productTransaction->address }}</span>
                                </div>
                                <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                    <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.vcard.order_at') }}:</label>
                                    <span class="fs-4 text-gray-800">
                                        {{ getFormattedDateTime($productTransaction->created_at)}}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
