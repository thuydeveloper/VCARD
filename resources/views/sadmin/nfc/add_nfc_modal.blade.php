<div class="modal fade" id="addNfcModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('messages.nfc.new_nfc_card') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'addNfcForm', 'files' => 'true']) }}
            <div class="modal-body">
                <div class="alert alert-danger fs-4 text-white d-flex align-items-center  d-none" role="alert" id="NfcValidationErrorsBox">
                    <i class="fa-solid fa-face-frown me-5"></i>
                </div>
                <div class="mb-5">
                    {{ Form::label('name',__('messages.common.name').':', ['class' => 'form-label required']) }}
                    {{ Form::text('name', null, ['class' => 'form-control', 'required','placeholder' => __('messages.common.name'),'id' => 'Name','autofocus']) }}
                </div>
                <div>
                        {{ Form::label('price', __('messages.common.price').':', ['class' => 'form-label required']) }}
                        {{ Form::number('price', null, ['class' => 'form-control','required','step'=>'0.01', 'min'=>'0', 'placeholder' => __('messages.form.price')]) }}
                </div>

            <div>
                <div class="col-sm-12 mb-5 mt-5">
                    {{ Form::label('description', __('messages.common.description').':', ['class' => 'form-label required']) }}
                    {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => __('messages.form.short_description'), 'rows' => '5', 'required']) }}
                </div>
            </div>
                <div class="col-sm-12 mb-5 mt-5 d-flex">
                    <div class="mb-3" io-image-input="true">
                        <label for="nfcImgId"
                               class="form-label required">{{ __('messages.nfc.nfc_image'). " : " }}</label>
                        <div class="d-block">
                            <div class="image-picker">
                                <div class="image previewImage" id="nfcPreview"
                                     style="background-image: url('{{ asset('assets/img/nfc/card_default.png') }}')"></div>
                                <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                                      data-placement="top" data-bs-original-title="{{__('messages.tooltip.image')}}">
                                    <label>
                                        <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                        <input type="file" id="nfc_img" name="nfc_img"
                                               class="image-upload file-validation  d-none" accept="image/*"/> </label>
                                </span>
                            </div>
                            <div class="form-text">{{__('messages.allowed_file_types')}}</div>
                        </div>
                        <input type="hidden" id="defaultNfcImgUrl" value="{{ asset('assets/img/nfc/card_default.png') }}" />
                    </div>
                    <div class="mb-3" io-image-input="true">
                        <label for="nfcImgId"
                               class="form-label required">{{ __('messages.nfc.nfc_back_image'). " : " }}</label>
                        <div class="d-block">
                            <div class="image-picker">
                                <div class="image previewImage" id="nfcPreview"
                                     style="background-image: url('{{ asset('assets/img/nfc/card_default.png') }}')"></div>
                                <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                                      data-placement="top" data-bs-original-title="{{__('messages.tooltip.image')}}">
                                    <label>
                                        <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                        <input type="file" id="nfc_back_img" name="nfc_back_img"
                                               class="image-upload file-validation  d-none" accept="image/*"/> </label>
                                </span>
                            </div>
                            <div class="form-text">{{__('messages.allowed_file_types')}}</div>
                        </div>
                        <input type="hidden" id="defaultNfcImgUrl" value="{{ asset('assets/img/nfc/card_default.png') }}" />
                    </div>
                </div>

            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary m-0','id'=>'btnSave']) }}
                <button type="button" class="btn btn-secondary my-0 ms-5 me-0"
                        data-bs-dismiss="modal">{{ __('messages.common.discard') }}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
