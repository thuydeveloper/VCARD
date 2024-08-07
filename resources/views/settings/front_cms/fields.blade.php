<div class="row">
    <div class="col-lg-6">
        <div class="mb-3" io-image-input="true">
            <label class="form-label"><span class="required">{{__('messages.front_cms.banner')}}:</span>
                <span data-bs-toggle="tooltip"
                      data-placement="top"
                      data-bs-original-title="{{__('messages.tooltip.home_image')}} 620x522">
                                <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" ></i>
                        </span>
            </label>
            <div class="d-block">
                <div class="image-picker">
                    <div class="image previewImage"
                         style="background-image: url('{{ !empty($setting['home_page_banner']) ? $setting['home_page_banner'] :
                            asset('assets/images/infyom-logo.png') }}')">
                    </div>
                         <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                               data-placement="top" data-bs-original-title="{{__('messages.tooltip.profile')}}">
                    <label>
                        <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                        <input type="file"  name="home_page_banner" class="image-upload file-validation d-none" accept=".png, .jpg, .jpeg"/>
                    </label>
                </span>
                </div>
            </div>
        </div>
        @if(!isset($setting))
            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                  data-bs-toggle="tooltip" title=""
                  data-bs-original-title="Remove profile">
                        <i class="bi bi-x fs-2"></i>
            </span>
        @endif
        <div class="form-text">{{__('messages.allowed_file_types')}}</div>
    <div class="col-lg-12">
        <div class="mb-5">
            {{ Form::label('title', __('messages.front_cms.title').':', ['class' => 'form-label required']) }}
            <span data-bs-toggle="tooltip"
                  data-placement="top"
                  data-bs-original-title="{{__('messages.tooltip.banner_title')}}">
                                <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" ></i>
                        </span>
            {{ Form::text('home_page_title', $setting['home_page_title'], ['class' => 'form-control', 'placeholder' => __('messages.front_cms.title'), 'required', 'maxlength'=>'34']) }}
            <input type="hidden" name="front_cms_form" value="1">
        </div>
        <div class="mb-5">
            {{ Form::label('home_page_tagline', __('messages.common.sub_text').':', ['class' => 'form-label required']) }}
            <span data-bs-toggle="tooltip"
                  data-placement="top"
                  data-bs-original-title="{{__('messages.tooltip.sub_text')}}">
                                <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
                        </span>
            {{ Form::text('sub_text', $setting['sub_text'], ['class' => 'form-control', 'id' => 'settingSubText','placeholder'=> __('messages.common.sub_text'),'required','maxlength'=>'60']) }}
        </div>
    </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('extra_js_front', __('messages.extra_scripts').':', ['class' => 'form-label']) }}
            <small class="form-text">{{__('messages.type_in_script')}}</small>
            {{ Form::textarea('extra_js_front',$setting['extra_js_front'], ['class' => 'form-control', 'id' => 'extraJsFront','placeholder'=>  __('messages.extra_scripts'),'rows'=>'9']) }}
        </div>
    </div>
</div>

<div class="row social-links-add">
    {{ Form::label('social-links', __('messages.feature.social_links').':', ['class' => 'form-label']) }}
    <div class="col-lg-6 mb-7 mt-1">
        <div class="row">
            <div class="col-sm-1 mb-3 mb-sm-0">
                <i class="fas fa-globe fa-2x text-primary mt-3 me-3"></i>
            </div>
            <div class="col-sm-11">
                {!! Form::text('website_link', $setting['website_link'], ['class' => 'form-control', 'placeholder' => __('messages.form.website')]) !!}
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-7">
        <div class="row">
            <div class="col-sm-1 mb-sm-0 p-2 px-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#000" viewBox="0 0 448 512" width="30"
                    height="30">
                    <path
                        d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm297.1 84L257.3 234.6 379.4 396H283.8L209 298.1 123.3 396H75.8l111-126.9L69.7 116h98l67.7 89.5L313.6 116h47.5zM323.3 367.6L153.4 142.9H125.1L296.9 367.6h26.3z" />
                </svg>
            </div>
            <div class="col-sm-11">
                {!! Form::text('twitter_link', $setting['twitter_link'], ['class' => 'form-control', 'placeholder' => __('messages.form.twitter')]) !!}
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-7">
        <div class="row">
            <div class="col-sm-1 mb-3 mb-sm-0">
                <i class="fab fa-facebook-square fa-2x text-primary mt-3 me-3"></i>
            </div>
            <div class="col-sm-11">
                {!! Form::text('facebook_link', $setting['facebook_link'], ['class' => 'form-control', 'placeholder' => __('messages.form.facebook')]) !!}
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-7">
        <div class="row">
            <div class="col-sm-1 mb-3 mb-sm-0">
                <i class="fab fa-instagram fa-2x text-danger mt-3 me-3"></i>
            </div>
            <div class="col-sm-11">
                {!! Form::text('instagram_link', $setting['instagram_link'], ['class' => 'form-control', 'placeholder' => __('messages.form.instagram')]) !!}
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-7">
        <div class="row">
            <div class="col-sm-1 mb-3 mb-sm-0">
                <i class="fab fa-youtube fa-2x text-danger mt-3 me-3"></i>
            </div>
            <div class="col-sm-11">
                {!! Form::text('youtube_link', $setting['youtube_link'], ['class' => 'form-control', 'placeholder' => __('messages.form.youtube')]) !!}
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-7">
        <div class="row">
            <div class="col-sm-1 mb-3 mb-sm-0">
                <i class="fab fa-tumblr-square fa-2x text-dark mt-3 me-3"></i>
            </div>
            <div class="col-sm-11">
                {!! Form::text('tumbir_link', $setting['tumbir_link'], ['class' => 'form-control', 'placeholder' => __('messages.form.tumblr')]) !!}
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-7">
        <div class="row">
            <div class="col-sm-1 mb-3 mb-sm-0">
                <i class="fab fa-reddit-alien fa-2x text-danger mt-3 me-3"></i>
            </div>
            <div class="col-sm-11">
                {!! Form::text('reddit_link', $setting['reddit_link'], ['class' => 'form-control', 'placeholder' => __('messages.form.reddit')]) !!}
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-7">
        <div class="row">
            <div class="col-sm-1 mb-3 mb-sm-0">
                <i class="fab fa-linkedin fa-2x text-primary mt-3 me-3"></i>
            </div>
            <div class="col-sm-11">
                {!! Form::text('linkedin_link', $setting['linkedin_link'], ['class' => 'form-control', 'placeholder' => __('messages.form.linkedin')]) !!}
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-7">
        <div class="row">
            <div class="col-sm-1 mb-3 mb-sm-0">
                <i class="fab fa-whatsapp fa-2x text-success mt-3 me-3"></i>
            </div>
            <div class="col-sm-11">
                {!! Form::text('whatsapp_link', $setting['whatsapp_link'], ['class' => 'form-control', 'placeholder' => __('messages.form.whatsapp')]) !!}
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-7">
        <div class="row">
            <div class="col-sm-1 mb-3 mb-sm-0">
                <i class="fab fa-pinterest fa-2x text-danger mt-3 me-3"></i>
            </div>
            <div class="col-sm-11">
                {!! Form::text('pinterest_link', $setting['pinterest_link'], ['class' => 'form-control', 'placeholder' => __('messages.form.pinterest')]) !!}
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-7">
        <div class="row">
            <div class="col-sm-1 mb-3 mb-sm-0">
                <i class="fab fa-tiktok fa-2x text-danger mt-3 me-3"></i>
            </div>
            <div class="col-sm-11">
                {!! Form::text('tiktok_link', $setting['tiktok_link'], ['class' => 'form-control', 'placeholder' => __('messages.form.tiktok')]) !!}
            </div>
        </div>
    </div>
    <div class="d-flex">
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-3','id'=>'frontCmsSaveBtn']) }}
        <a href="" type="reset" class="btn btn-secondary">{{__('messages.common.discard')}}</a>
    </div>
</div>

