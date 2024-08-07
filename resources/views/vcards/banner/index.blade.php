{{-- <div class="overflow-auto">
    <div class="table-striped w-100">
        <livewire:vcard-product-table :vcard-id="$vcard->id"/>
    </div>
    </div>
    @include('vcards.products.create')
    @include('vcards.products.edit')
    @include('vcards.products.show') --}}

    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="card">
                <form action="{{ route('banner.store') }}" method="post">
                @csrf
                <div class="col-lg-12">
                    <div class="row">
                        {{ Form::hidden('vcard_id', $vcard->id) }}
                        <input type="hidden" name="part" value="{{ $partName }}">
                        <div class="col-6">
                            {{ Form::label('title', __('messages.front_cms.title') . ':', ['class' => 'form-label required']) }}
                            {{ Form::text('title',isset($banners['title']) ? $banners['title'] : null, ['class' => 'form-control form-control-color w-100 mb-3','placeholder' => __('messages.front_cms.title'), 'id' => 'banner_title']) }}
                        </div>
                        <div class="col-6">
                            {{ Form::label('url', __('messages.front_cms.url') . ':', ['class' => 'form-label required']) }}
                            {{ Form::url('url',isset($banners['url']) ? $banners['url'] : null, ['class' => 'form-control form-control-color w-100 mb-3','placeholder' => __('messages.front_cms.url'), 'id' => 'banner_url']) }}
                        </div>
                        <div class="col-6">
                            {{ Form::label('description', __('messages.front_cms.description') . ':', ['class' => 'form-label required']) }}
                            {{ Form::textarea('description', isset($banners['description']) ? $banners['description'] : null, ['class' => 'form-control form-control-color w-100 mb-3','placeholder' => __('messages.form.short_description'), 'id' => 'banner_description']) }}
                        </div>
                        <div class="col-6">
                            {{ Form::label('banner_button', __('messages.front_cms.banner_button') . ':', ['class' => 'form-label required']) }}
                            {{ Form::text('banner_button',isset($banners['banner_button']) ? $banners['banner_button'] : null, ['class' => 'form-control form-control-color w-100 mb-3','placeholder' => __('messages.front_cms.banner_button'), 'id' => 'banner_button']) }}
                        </div>
                    </div>
                    <div class="col-lg-12 mt-5">
                        <div class="col-lg-12 d-flex">
                            <button type="submit" class="btn btn-primary me-3" id="bannerdataSave">
                                {{ __('messages.common.save') }}
                            </button>
                            <a href="{{ route('banner') }}"
                                class="btn btn-secondary">{{ __('messages.common.discard') }}</a>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
