<div class="row">
    <div class="col-lg-4">
        <div class="row">
            <div class="col-lg-12 col-md-6 col-12 mb-7">
                {{ Form::label('name', __('messages.common.name') . ':', ['class' => 'form-label required']) }}
                {{ Form::text('name', isset($plan) ? $plan->name : null, ['class' => 'form-control', 'placeholder' => __('messages.form.plan_name'), 'required']) }}
            </div>
            <div class="col-lg-12 col-md-6 col-12 mb-7">
                {{ Form::label('frequency', __('messages.plan.frequency') . ':', ['class' => 'form-label required']) }}
                {{ Form::select('frequency', \App\Models\Plan::DURATION, isset($plan) ? $plan->frequency : null, ['class' => 'form-control', 'required', 'data-control' => 'select2']) }}
            </div>
            <div class="col-lg-12 col-md-6 col-12 mb-7">
                {{ Form::label('currency_id', __('messages.plan.currency') . ':', ['class' => 'form-label required']) }}
                {{ Form::select('currency_id', getCurrencies(), isset($plan) ? $plan->currency_id : null, ['class' => 'form-control select2Selector', 'required', 'placeholder' => __('messages.form.select_currency'), 'data-control' => 'select2', 'required']) }}
            </div>
            <div class="col-lg-12 col-md-6 col-12 mb-7">
                {!! Form::label('price', __('messages.plan.price') . ':', ['class' => 'form-label required']) !!}
                {!! Form::text('price', isset($plan) ? $plan->price : null, [
                    'class' => 'form-control price-format-input',
                    'min' => '0',
                    'step' => '0.01',
                    'placeholder' => __('messages.form.price'),
                    'required',
                    isset($plan) && $plan->is_trial ? 'disabled' : '',
                ]) !!}
            </div>
            <div class="col-lg-12 col-md-6 col-12 mb-7">
                {!! Form::label('no_of_vcards', __('messages.plan.no_of_vcards') . ':', ['class' => 'form-label required']) !!}
                {!! Form::number('no_of_vcards', isset($plan) ? $plan->no_of_vcards : null, [
                    'class' => 'form-control',
                    'min' => '1',
                    'placeholder' => __('messages.form.allowed_vcard'),
                    'required',
                ]) !!}
            </div>
            <div class="col-lg-12 col-md-6 col-12 mb-7">
                {!! Form::label('trial_days', __('messages.plan.trial_days') . ':', ['class' => 'form-label']) !!}
                {!! Form::number('trial_days', isset($plan) ? $plan->trial_days : null, [
                    'class' => 'form-control',
                    'placeholder' => __('messages.form.enter_trial'),
                ]) !!}
            </div>

            <div class="col-lg-12 col-md-6 col-12 mb-7">
                {!! Form::label('storage_limit', __('messages.plan.storage_limit') . ':', ['class' => 'form-label required']) !!}
                <span data-bs-toggle="tooltip" data-placement="top"
                    data-bs-original-title="{{ __('messages.tooltip.storage_limit_mb') }}">
                    <i class="fas fa-question-circle general-question-mark"></i>
                </span>
                {!! Form::number('storage_limit', isset($plan) ? $plan->storage_limit : 200, [
                    'class' => 'form-control',
                    'placeholder' => __('messages.plan.storage_limit'),
                ]) !!}
            </div>
            <div class="d-flex">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <label
                        class="form-check form-switch form-check-custom form-check-solid form-switch-sm d-flex justify-content-start cursor-pointer">
                        <input type="checkbox" name="custom_select"
                            class="form-check-input cursor-pointer custom-select me-2 " id="customField" value="1"
                            {{ isset($plan) && $plan->custom_select && (count($planCustomFields) != 0) == 1 ? 'checked' : '' }}>
                        {{ __('messages.plan.custom_select') }}
                    </label>
                </div>
                <div class="col-lg-6 col-md-6 col-6 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" id="addFieldsButton"
                        style="display: {{ isset($plan) && $plan->custom_select == 1 && count($planCustomFields) != 0 ? 'block' : 'none' }};">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <div id="customFieldsSection"
                style="display: {{ isset($plan) && $plan->custom_select == 1 ? 'block' : 'none' }};">
                <div class="row d-flex align-items-end" id="fieldsContainer">
                </div>
                @if (isset($planCustomFields))
                    @foreach ($planCustomFields as $key => $planCustomField)
                        <div class="row d-flex align-items-end " id="fieldsContainer">
                            <div class="col-lg-6 col-md-2 col-5 mt-7">
                                {!! Form::label('custom_vcard_number', __('messages.plan.custom_vcard_number') . ':', ['class' => 'form-label required']) !!}
                                {!! Form::number('custom_vcard_number[]', $planCustomField->custom_vcard_number, [
                                    'class' => 'form-control',
                                    'placeholder' => __('messages.plan.custom_vcard_number'),
                                    'required',
                                ]) !!}
                            </div>
                            <div class="col-lg-5 col-md-2 col-5 mt-7">
                                {!! Form::label('custom_vcard_price', __('messages.plan.custom_vcard_price') . ':', ['class' => 'form-label required']) !!}
                                {!! Form::number('custom_vcard_price[]', $planCustomField->custom_vcard_price, [
                                    'class' => 'form-control',
                                    'placeholder' => __('messages.plan.custom_vcard_price'),
                                    'required',
                                ]) !!}
                            </div>
                            <div class="col-lg-1 col-md-2 col-1 mb-2 trash">
                                <a href="javascript:void(0)"><i class="fas fa-trash text-danger fs-2"></i></a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

        </div>
        <div class="row mt-7">
            <div class="mb-10 d-flex justify-content-between flex-wrap">
                {{ Form::label('feature', __('messages.plan.features') . ':', ['class' => 'form-label required']) }}
                <label class="form-label form-check ps-0">
                    {{ __('messages.plan.select_all_feature') }}
                    <input class="form-check-input mx-2" type="checkbox" id="featureAll" />
                </label>
            </div>
            <div class="row mb-5 plan-features">
                <div class="col-xxl-6 col-lg-12 col-md-4 col-6 mb-5 col-xs p-0">
                    <label class="form-label form-check p-0">
                        <input class="form-check-input feature mx-2" type="checkbox" value="1"
                            name="products_services"
                            {{ isset($feature) && $feature->products_services == 1 ? 'checked' : '' }} />
                        {{ __('messages.plan.services') }}
                    </label>
                </div>
                <div class="col-xxl-6 col-lg-12 col-md-4 col-6 mb-5 col-xs p-0">
                    <label class="form-label form-check p-0">
                        <input class="form-check-input feature mx-2" type="checkbox" value="1" name="testimonials"
                            {{ isset($feature) && $feature->testimonials == 1 ? 'checked' : '' }} />
                        {{ __('messages.plan.testimonials') }}
                    </label>
                </div>
                <div class="col-xxl-6 col-lg-12 col-md-4 col-6 mb-5 col-xs p-0">
                    <label class="form-label form-check p-0">
                        <input class="form-check-input feature mx-2" type="checkbox" value="1" name="hide_branding"
                            {{ isset($feature) && $feature->hide_branding == 1 ? 'checked' : '' }} />
                        <div>
                            {{ __('messages.plan.hide_branding') }}
                            <span data-bs-toggle="tooltip" data-placement="top"
                                data-bs-original-title="{{ __('messages.tooltip.hide_branding') }}">
                                <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
                            </span>
                        </div>
                    </label>
                </div>
                <div class="col-xxl-6 col-lg-12 col-md-4 col-6 mb-5 col-xs p-0">
                    <label class="form-label form-check p-0">
                        <input class="form-check-input feature mx-2" type="checkbox" value="1" name="enquiry_form"
                            {{ isset($feature) && $feature->enquiry_form == 1 ? 'checked' : '' }} />
                        {{ __('messages.plan.enquiry_form') }}
                    </label>
                </div>
                <div class="col-xxl-6 col-lg-12 col-md-4 col-6 mb-5 col-xs p-0">
                    <label class="form-label form-check p-0">
                        <input class="form-check-input feature mx-2" type="checkbox" value="1" name="social_links"
                            {{ isset($feature) && $feature->social_links == 1 ? 'checked' : '' }} />
                        {{ __('messages.social.social_links') }}
                    </label>
                </div>
                <div class="col-xxl-6 col-lg-12 col-md-4 col-6 mb-5 col-xs p-0">
                    <label class="form-label form-check p-0">
                        <input class="form-check-input feature mx-2" type="checkbox" value="1" name="password"
                            {{ isset($feature) && $feature->password == 1 ? 'checked' : '' }} />
                        <div>
                            {{ __('messages.plan.password_protection') }}
                            <span data-bs-toggle="tooltip" data-placement="top"
                                data-bs-original-title="{{ __('messages.tooltip.password_protection') }}">
                                <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
                            </span>
                        </div>
                    </label>
                </div>
                <div class="col-xxl-6 col-lg-12 col-md-4 col-6 mb-5 col-xs p-0">
                    <label class="form-label form-check p-0">
                        <input class="form-check-input feature mx-2" type="checkbox" value="1" name="custom_css"
                            {{ isset($feature) && $feature->custom_css == 1 ? 'checked' : '' }} />
                        <div>
                            {{ __('messages.plan.custom_css') }}
                            <span data-bs-toggle="tooltip" data-placement="top"
                                data-bs-original-title="{{ __('messages.tooltip.custom_css') }}">
                                <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
                            </span>
                        </div>
                    </label>
                </div>
                <div class="col-xxl-6 col-lg-12 col-md-4 col-6 mb-5 col-xs p-0">
                    <label class="form-label form-check p-0">
                        <input class="form-check-input feature mx-2" type="checkbox" value="1" name="custom_js"
                            {{ isset($feature) && $feature->custom_js == 1 ? 'checked' : '' }} />
                        <div>
                            {{ __('messages.plan.custom_js') }}
                            <span data-bs-toggle="tooltip" data-placement="top"
                                data-bs-original-title="{{ __('messages.tooltip.custom_js') }}">
                                <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
                            </span>
                        </div>
                    </label>
                </div>
                <div class="col-xxl-6 col-lg-12 col-md-4 col-6 mb-5 col-xs p-0">
                    <label class="form-label form-check p-0">
                        <input class="form-check-input feature mx-2" type="checkbox" value="1"
                            name="custom_fonts"
                            {{ isset($feature) && $feature->custom_fonts == 1 ? 'checked' : '' }} />
                        <div>
                            {{ __('messages.feature.custom_fonts') }}
                            <span data-bs-toggle="tooltip" data-placement="top"
                                data-bs-original-title="{{ __('messages.tooltip.custom_fonts') }}">
                                <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
                            </span>
                        </div>
                    </label>
                </div>
                <div class="col-xxl-6 col-lg-12 col-md-4 col-6 mb-5 col-xs p-0">
                    <label class="form-label form-check p-0">
                        <input class="form-check-input feature mx-2" type="checkbox" value="1" name="products"
                            {{ isset($feature) && $feature->products == 1 ? 'checked' : '' }} />
                        {{ __('messages.plan.products') }}
                    </label>
                </div>
                <div class="col-xxl-6 col-lg-12 col-md-4 col-6 mb-5 col-xs p-0">
                    <label class="form-label form-check p-0">
                        <input class="form-check-input feature mx-2" type="checkbox" value="1"
                            name="appointments"
                            {{ isset($feature) && $feature->appointments == 1 ? 'checked' : '' }} />
                        {{ __('messages.vcard.appointments') }}
                    </label>
                </div>
                <div class="col-xxl-6 col-lg-12 col-md-4 col-6 mb-5 col-xs p-0">
                    <label class="form-label form-check p-0">
                        <input class="form-check-input feature mx-2" type="checkbox" value="1" name="gallery"
                            {{ isset($feature) && $feature->gallery == 1 ? 'checked' : '' }} />
                        {{ __('messages.plan.gallery') }}
                    </label>
                </div>
                <div class="col-xxl-6 col-lg-12 col-md-4 col-6 mb-5 col-xs p-0">
                    <label class="form-label form-check p-0">
                        <input class="form-check-input feature mx-2" type="checkbox" value="1" name="analytics"
                            {{ isset($feature) && $feature->analytics == 1 ? 'checked' : '' }} />
                        {{ __('messages.plan.analytics') }}
                    </label>
                </div>
                <div class="col-xxl-6 col-lg-12 col-md-4 col-6 mb-5 col-xs p-0">
                    <label class="form-label form-check p-0">
                        <input class="form-check-input feature mx-2" type="checkbox" value="1" name="seo"
                            {{ isset($feature) && $feature->seo == 1 ? 'checked' : '' }} />
                        {{ __('messages.plan.seo') }}
                    </label>
                </div>
                <div class="col-xxl-6 col-lg-12 col-md-4 col-6 mb-5 col-xs p-0">
                    <label class="form-label form-check p-0">
                        <input class="form-check-input feature mx-2" type="checkbox" value="1" name="blog"
                            {{ isset($feature) && $feature->blog == 1 ? 'checked' : '' }} />
                        {{ __('messages.plan.blog') }}
                    </label>
                </div>
                <div class="col-xxl-6 col-lg-12 col-md-4 col-6 mb-5 col-xs p-0">
                    <label class="form-label form-check p-0">
                        <input class="form-check-input feature mx-2" type="checkbox" value="1"
                            name="affiliation" {{ isset($feature) && $feature->affiliation == 1 ? 'checked' : '' }} />
                        {{ __('messages.plan.affiliation') }}
                    </label>
                </div>
                <div class="col-xxl-6 col-lg-12 col-md-4 col-6 mb-5 col-xs p-0">
                    <label class="form-label form-check p-0">
                        <input class="form-check-input feature mx-2" type="checkbox" value="1"
                            name="custom_qrcode"
                            {{ isset($feature) && $feature->custom_qrcode == 1 ? 'checked' : '' }} />
                        {{ __('messages.plan.custom_qrcode') }}
                    </label>
                </div>
                <div class="col-xxl-6 col-lg-12 col-md-4 col-6 mb-5 col-xs p-0">
                    <label class="form-label form-check p-0">
                        <input class="form-check-input feature mx-2" type="checkbox" value="1"
                            name="insta_embed" {{ isset($feature) && $feature->insta_embed == 1 ? 'checked' : '' }} />
                        {{ __('messages.feature.insta_embed') }}
                    </label>
                </div>
                <div class="col-xxl-6 col-lg-12 col-md-4 col-6 mb-5 col-xs p-0">
                    <label class="form-label form-check p-0">
                        <input class="form-check-input feature mx-2" type="checkbox" value="1" name="iframes"
                            {{ isset($feature) && $feature->iframes == 1 ? 'checked' : '' }} />
                        {{ __('messages.vcard.iframe') }}
                    </label>
                </div>
                <div class="col-xxl-6 col-lg-12 col-md-4 col-6 mb-5 col-xs p-0">
                    <label class="form-label form-check p-0">
                        <input class="form-check-input feature mx-2" type="checkbox" value="1"
                            name="dynamic_vcard"
                            {{ isset($feature) && $feature->dynamic_vcard == 1 ? 'checked' : '' }} />
                        {{ __('messages.Dynamic_vcard') }}
                        <span data-bs-toggle="tooltip" data-placement="top"
                            data-bs-original-title="{{ __('messages.tooltip.dynamic_vcard') }}">
                            <i class="fas fa-question-circle ml-1 general-question-mark"></i>
                        </span>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="mb-2 d-flex justify-content-between flex-wrap">
            {{ Form::label('template', __('messages.plan.multi_templates') . ':', ['class' => 'form-label required']) }}
            <label class="form-label form-check ps-0">
                {{ __('messages.plan.select_all_templates') }}
                <input class="form-check-input mx-2" type="checkbox" id="multiTemplatesAll" />
            </label>
        </div>
        <div class="form-group mb-10">
            <div class="row">
                @foreach (getTemplateUrls() as $id => $url)
                    <div class="col-custom img-box mb-2">
                        <input type="checkbox" name="template_ids[]" class="templateIds template-input"
                            value="{{ $id }}" @if ($id == 1 && Request::is('sadmin/plans/create')) checked @endif
                            {{ isset($templates) && in_array($id, $templates) ? 'checked' : '' }}>
                        <div
                            class="screen image
                            @if ($id == 11) vcard_11 @endif
                            @if ($id == 22) ribbon @endif
                            @if ($id == 1 && Request::is('sadmin/plans/create')) template-border @endif
                            {{ isset($templates) && in_array($id, $templates) ? 'template-border' : '' }}">
                            <img src="{{ $url }}" alt="Template {{ $id }}">
                            @if ($id == 22)
                                <div class="ribbon-wrapper">
                                    <div class="ribbon fw-bold">{{ __('messages.feature.dynamic_vcard') }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div>
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3', 'id' => 'planFormSubmit']) }}
        <a href="{{ route('plans.index') }}" class="btn btn-secondary">{{ __('messages.common.discard') }}</a>
    </div>
</div>
