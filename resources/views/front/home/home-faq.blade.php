@extends(homePageLayout())
@section('title')
    {{ __('messages.faqs.faqs') }}
@endsection
@section('content')
    <!-- start hero section -->
    <section class="hero-section pt-100 pb-60" style="background-size:auto;height:400px;">
        <div class="container pt-60 mt-5">
            <div class="row">
                <div class="col-12 text-center">
                    {{-- <h2 class="fs-40 text-white"> {{ __('messages.vcards_templates') }} </h2> --}}
                    <h2 class="fs-40 text-white"> {{ __('messages.faqs.faqs') }} </h2>
                </div>
            </div>
        </div>
    </section>
    <!-- end hero section -->

    <!--start Faqs-section -->
    @if (checkFrontLanguageSession() != 'ar')
        <div class="container w-50 my-5">
        <div class="accordion" id="accordionExample">
            @foreach ($faq as $faqs)
                <div class="accordion-item my-3">
                    <h2 class="accordion-header" id="heading{{ $faqs->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faq{{ $faqs->id }}" aria-expanded="false"
                            aria-controls="faq{{ $faqs->id }}">
                            {{ $faqs->title }}
                        </button>
                    </h2>
                    <div id="faq{{ $faqs->id }}" class="accordion-collapse collapse"
                        aria-labelledby="heading{{ $faqs->id }}" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            {{ $faqs->description }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        </div>
        @else
        <div class="container w-50 my-5" dir="rtl">
            <div class="accordion" id="accordionExample">
                @foreach ($faq as $faqs)
                    <div class="accordion-item my-3">
                        <h2 class="accordion-header" id="heading{{ $faqs->id }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq{{ $faqs->id }}" aria-expanded="false"
                                aria-controls="faq{{ $faqs->id }}">
                                {{ $faqs->title }}
                            </button>
                        </h2>
                        <div id="faq{{ $faqs->id }}" class="accordion-collapse collapse"
                            aria-labelledby="heading{{ $faqs->id }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                {{ $faqs->description }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    <!-- end Faqs-section -->
@endsection
