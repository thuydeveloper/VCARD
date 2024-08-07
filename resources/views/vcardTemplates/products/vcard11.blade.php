@extends('vcardTemplates.vcard11.app')
@section('title')
    {!! __('messages.vcard.term-condition')!!}
@endsection
@section('page_css')
    <link href="{{ asset('assets/css/portfolio.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/home.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('page_name')
    {!! __('messages.vcard.term-condition')!!}
@endsection
@section('content')
    <div class="tab-content p-sm-4 p-3" id="v-pills-tabContent">
        <section class="services-section pt-30">
            <div class="section-heading mb-5">
                <h2 class="fs-22 text-white ps-4">{{ __('messages.feature.products') }}</h2>
                <div class="text-end ">
                    <a class="btn btn-primary" href="{{ route('vcard.show', ['alias' => $vcard->url_alias]) }}"
                        role="button">{{ __('messages.common.back') }}</a>
                </div>
            </div>
            <?php $ProductCount = 1; ?>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-6 mb-sm-5 mb-4">
                        <a @if ($product->product_url) href="{{ $product->product_url }}" @endif>
                            <div class="card  p-sm-4 p-3 h-100">
                                <div class="tag d-flex justify-content-center align-items-center">
                                    <span class="fs-6 text-white">{{ $ProductCount++ }}</span>
                                </div>
                                <div class="card-img-top mb-3">
                                    <a
                                        @if ($product->product_url) href="{{ $product->product_url }}"
                                           target="_blank" @endif>
                                        <div class="card-img-top mx-auto">
                                            <img src="{{ $product->product_icon }}"
                                                class="w-100 h-100 object-fit-cover custom-border-radius" loading="lazy">
                                        </div>
                                </div>
                                <div class="card-body p-0 ps-sm-4 pt-sm-0 pt-3">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="card-title fs-18">{{ $product->name }}</h5>
                                        @if (!empty($product->price))
                                        <a class="btn btn-primary text-decoration-none buy-product" data-id="{{ $product->id }}" {{ $vcard->products->count() <= 6 ? 'd-none' : '' }}
                                            href="" role="button">{{ __('messages.subscription.buy_now') }}</a>
                                        @endif
                                    </div>
                                    @if ($product->currency_id && $product->price)
                                        <p class=" fs-14 pb-4 mb-0  product-price-{{ $product->id }}">
                                            {{ $product->currency->currency_icon }}{{ number_format($product->price, 2) }}
                                        </p>
                                    @elseif($product->price)
                                        <p class=" fs-14 pb-4 mb-0  product-price-{{ $product->id }}">{{ getUserCurrencyIcon($vcard->user->id) }}{{ $product->price }}</p>
                                    @endif
                                    <p class="card-text fs-14 pb-4 mb-0">
                                        {!! $product->description !!}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
        @include('vcardTemplates.product-buy')
    </div>
@endsection
