<div id="editLanguageModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3>{{ __('messages.languages.edit_language') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'editLanguageForm','files' => 'true']) }}
            <div class="modal-body">
                {{ Form::hidden('languageId',null,['id'=>'languageId']) }}

                <div class="mb-5">
                    {{ Form::label('name',__('messages.languages.language').(':'), ['class' => 'form-label']) }}
                    {{ Form::text('name', null, ['id'=>'editLanguage','class' => 'form-control','placeholder' => __('messages.languages.language')]) }}
                </div>
                <div>
                    {{ Form::label('iso_code',__('messages.languages.iso_code').(':'),['class' => 'form-label required']) }}
                    {{ Form::text('iso_code', '', ['class' => 'form-control', 'id' => 'editIso','placeholder' => __('messages.languages.iso_code')]) }}
                </div>
                <div class="mb-5" io-image-input="true">
                    <label for="editlanguagePreview"
                           class="form-label mt-5">{{ __('messages.vcard.flag').':' }}</label>
                    <div class="d-block">
                        <div class="image-picker">
                            <div class="image previewImage" id="editlanguagePreview"
                                 style="background-image: url('{{ asset('web/media/avatars/redflag.jpeg') }}')"></div>
                            <span class="picker-edit rounded-circle text-gray-500 fs-small edit-btn"
                                  data-bs-toggle="tooltip"
                                  data-placement="top"
                                  data-bs-original-title="{{__('messages.tooltip.image')}}">
                                <label>
                                    <i class="fa-solid fa-pen" id="languageImageIcon"></i>
                                    <input type="file" id="editlanguageImg" name="flag"
                                           class="image-upload file-validation d-none" accept="image/*"/> </label>
                            </span>
                        </div>
                        <div class="form-text">{{__('messages.allowed_file_types')}}</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary m-0','id' => 'btnEditSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" class="btn btn-secondary my-0 ms-5 me-0" id="btnEditCancel"
                        data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

