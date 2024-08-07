<div class="modal fade" id="editNfcModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">{{ __('messages.nfc.edit_nfc_card') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['id'=>'editNfcForm', 'files' => 'true']) !!}
                <div class="row">
                    <div class="col-sm-12 mb-5">
                        {{ Form::hidden('nfc_id', null,['id' => 'nfcId']) }}
                        {{ Form::label('name',__('messages.common.name').(':'), ['class' => 'form-label required']) }}
                        {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'editNfcTitle', 'required', 'placeholder' => __('messages.form.enter_name'), 'maxlength'=>'50']) }}
                    </div>

                    <div class="col-sm-12 mb-5">
                        {{ Form::label('price', __('messages.common.price').':', ['class' => 'form-label required']) }}
                        {{ Form::number('price', null, ['class' => 'form-control','id' => 'editNfcPrice','required','step'=>'0.01', 'min'=>'0', 'placeholder' => __('messages.form.price')]) }}
                    </div>

                    <div class="col-sm-12 mb-5">
                        {{ Form::label('description', __('messages.common.description').':', ['class' => 'form-label required']) }}
                        {{ Form::textarea('description', null, ['class' => 'form-control', 'id' => 'editNfcDescription', 'placeholder' =>__('messages.form.short_description'), 'rows' => '5', 'required']) }}
                    </div>
                    <div class="col-sm-12 mb-5 d-flex">
                        <div class="mb-3" io-image-input="true">
                            <label for="NfcImgId"
                                   class="form-label ">{{ __('messages.nfc.nfc_image'). " : " }} </label>
                            <div class="d-block">
                                <div class="image-picker">
                                    <div class="image previewImage" id="editNfcPreview"
                                         style="background-image: url('{{ asset('assets/img/nfc/card_default.png') }}')"></div>
                                    <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                                          data-placement="top" data-bs-original-title="{{__('messages.tooltip.image')}}">
                                        <label>
                                            <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                            <input type="file" id="editNfcImg" name="nfc_img"
                                                   class="image-upload file-validation d-none" accept="image/*"/> </label>
                                    </span>
                                </div>
                                <div class="form-text">{{__('messages.allowed_file_types')}}</div>
                            </div>
                        </div>
                        <div class="mb-3" io-image-input="true">
                            <label for="NfcImgId"
                                   class="form-label ">{{ __('messages.nfc.nfc_back_image'). " : " }} </label>
                            <div class="d-block">
                                <div class="image-picker">
                                    <div class="image previewImage" id="editNfcBackPreview"
                                         style="background-image: url('{{ asset('assets/img/nfc/card_default.png') }}')"></div>
                                    <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                                          data-placement="top" data-bs-original-title="{{__('messages.tooltip.image')}}">
                                        <label>
                                            <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                            <input type="file" id="editNfcBackImg" name="nfc_back_img"
                                                   class="image-upload file-validation d-none" accept="image/*"/> </label>
                                    </span>
                                </div>
                                <div class="form-text">{{__('messages.allowed_file_types')}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex">
                        {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary me-3','id'=>'serviceUpdate']) }}
                        <button type="button" class="btn btn-secondary cancel-edit-nfc"
                                data-bs-dismiss="modal">{{ __('messages.common.discard') }}</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
