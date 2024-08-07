<div>
    @php
        $slider_view = false;
        $slider_view = App\Models\Vcard::where('id', $this->vcardId)->value('services_slider_view');
    @endphp
    <div class="d-flex align-items-center">
        <div class="form-check form-switch m-0 pe-5 d-flex align-items-center">
            <label class="form-check-label" for="vcard-services-slider-view" style="margin-right: 50px">{{__('messages.vcard.view_one_by_one')}}</label>
            <input data-id="{{ $this->vcardId }}" id="vcard-services-slider-view" name="services_slider_view" class="form-check-input" type="checkbox" role="switch" {{ $slider_view ? 'checked' : '' }}>
        </div>
        <a type="button" class="btn btn-primary ms-auto" id="addServiceBtn">{{__('messages.vcard.add_service')}}</a>
    </div>
</div>
