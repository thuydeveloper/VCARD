<html lang="en">
<head>
    <link>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ getFaviconUrl() }}" type="image/png">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">
    <title>vcard</title>

    {{--css link--}}
    <link rel="stylesheet" href="{{ asset('assets/css/vcard1.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/blog.css')}}">

    {{--font-awesome--}}
    <link href="{{ asset('backend/css/all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    {{--google font--}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>
<div class="container">
    <div class="vcard-one main-content w-100 mx-auto
    @if($product1->vcard->template_id == 1)
            vcard-one-bg
    @elseif($product1->vcard->template_id == 2)
            vcard-two-bg
    @elseif($product1->vcard->template_id == 3)
            vcard-three-bg
    @elseif($product1->vcard->template_id == 4)
            vcard-four-bg
    @elseif($product1->vcard->template_id == 5)
            vcard-five-bg
    @elseif($product1->vcard->template_id == 6)
            vcard-six-bg
    @elseif($product1->vcard->template_id == 7)
            vcard-seven-bg
    @elseif($product1->vcard->template_id == 8)
            vcard-eight-bg
    @elseif($product1->vcard->template_id == 9)
            vcard-nine-bg
    @elseif($product1->vcard->template_id == 10)
            vcard-ten-bg
    @endif">
        <div class="vcard-one-main-section p-3">
            <div class="d-flex justify-content-between align-items-center py-3">
                <h2 class="blog-title
             @if($product1->vcard->template_id == 1)
                        vcard-one-title
            @elseif($product1->vcard->template_id == 2)
                        vcard-two-title
@elseif($product1->vcard->template_id == 3)
                        vcard-three-title
@elseif($product1->vcard->template_id == 4)
                        vcard-four-title
@elseif($product1->vcard->template_id == 5)
                        vcard-five-title
@elseif($product1->vcard->template_id == 6)
                        vcard-six-title
@elseif($product1->vcard->template_id == 7)
                        vcard-seven-title
@elseif($product1->vcard->template_id == 8)
                        vcard-eight-title
@elseif($product1->vcard->template_id == 9)
                        vcard-nine-title
@elseif($product1->vcard->template_id == 10)
                        vcard-ten-title
@endif">{{$product1->title}}</h2>
                <div class="blog-hover-btn">
                    <a class="btn btn-outline-primary
                    @if($product1->vcard->template_id == 1)
                            vcard-one-back
                    @elseif($product1->vcard->template_id == 2)
                            vcard-two-back
                    @elseif($product1->vcard->template_id == 3)
                            vcard-three-back
                    @elseif($product1->vcard->template_id == 4)
                            vcard-four-back
                    @elseif($product1->vcard->template_id == 5)
                            vcard-five-back
                    @elseif($product1->vcard->template_id == 6)
                            vcard-six-back
                    @elseif($product1->vcard->template_id == 7)
                            vcard-seven-back
                    @elseif($product1->vcard->template_id == 8)
                            vcard-eight-back
                    @elseif($product1->vcard->template_id == 9)
                            vcard-nine-back
                    @elseif($product1->vcard->template_id == 10)
                            vcard-ten-back
                    @endif" href="{{ url()->previous() }}" role="button">
                        {{__('messages.common.back')}}
                    </a>
                </div>
            </div>


            <div class="details mt-4">
                <div class="vcard-one__product py-3 mb-10 mt-0">
                    <h4 class="vcard-one-heading text-center pb-4">{{ __('messages.vcard.products') }}</h4>
                    <div class="container">
                        <div class="row g-4 product-slider overflow-hidden">
                            @foreach ($products as $product)
                                <div class="col-6 mb-2">
                                    <a @if ($product->product_url) href="{{ $product->product_url }}" @endif
                                        target="_blank" class="text-decoration-none fs-6">
                                        <div class="card product-card p-2 border-0 w-100 h-100">
                                            <div class="product-profile">
                                                <img src="{{ $product->product_icon }}" alt="profile"
                                                    class="w-100" height="208px" />
                                            </div>
                                            <div class="product-details mt-3">
                                                <h4>{{ $product->name }}</h4>
                                                <p class="mb-2">
                                                    {{ $product->description }}
                                                </p>
                                                @if ($product->currency_id && $product->price)
                                                    <span
                                                        class="text-black">{{ $product->currency->currency_icon }}{{ number_format($product->price, 2) }}</span>
                                                @elseif($product->price)
                                                    <span class="text-black">{{ $product->price }}</span>
                                                @endif
                                                    <div class="my-5 text-center ">
                                                        <a class="btn btn-primary" href="#" role="button">Buy</a>
                                                    </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="blog-hover-btn-mobile fw-light">
                    <a class="btn btn-outline-primary float-end
                    @if($product1->vcard->template_id == 1)
                            vcard-one-back
                    @elseif($product1->vcard->template_id == 2)
                            vcard-two-back
                    @elseif($product1->vcard->template_id == 3)
                            vcard-three-back
                    @elseif($product1->vcard->template_id == 4)
                            vcard-four-back
                    @elseif($product1->vcard->template_id == 5)
                            vcard-five-back
                    @elseif($product1->vcard->template_id == 6)
                            vcard-six-back
                    @elseif($product1->vcard->template_id == 7)
                            vcard-seven-back
                    @elseif($product1->vcard->template_id == 8)
                            vcard-eight-back
                    @elseif($product1->vcard->template_id == 9)
                            vcard-nine-back
                    @elseif($product1->vcard->template_id == 10)
                            vcard-ten-back
                    @endif" href="{{ url()->previous() }}" role="button">
                        {{__('messages.common.back')}}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('backend/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
