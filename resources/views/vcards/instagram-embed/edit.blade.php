<div class="modal fade" id="editInstagramEmbedModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">{{ __('messages.vcard.edit_embedtag') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['id' => 'EditInstaForm', 'files' => 'true']) !!}
                <div class="row">
                    <div class="col-sm-12">
                        {{ Form::hidden('id', null, ['id' => 'editVcard']) }}
                        {{ Form::hidden('id', null, ['id' => 'editEmbedId']) }}

                    </div>

                    <div class="col-sm-12">
                        <div class="">
                            <label
                                class="form-label required fs-6 fw-bolder text-gray-700">{{ __('messages.gallery.type') . ':' }}</label>
                        </div>
                        {{ Form::select('type', \App\Models\InstagramEmbed::TYPE, null, [
                            'class' => 'form-control form-select form-select-solid fw-bold',
                            'data-control' => 'select2',
                            'data-dropdown-parent' => '#editInstagramEmbedModal',
                            'id' => 'editTypeId',
                        ]) }}
                    </div>

                    <div class="col-sm-12 mb-4">
                        <div class="mt-3">
                            <label
                                class="form-label required fs-6 fw-bolder text-gray-700">{{ __('messages.vcard.embedtag').':' }}</label>
                        </div>
                        {{ Form::textarea('embedtag', null, ['class' => 'form-control', 'placeholder' => __('messages.form.short_description'), 'rows' => '5', 'required', 'id' => 'editEmbedtag']) }}
                    </div>
                </div>



                <div class="d-flex">
                    {{ Form::button(__('messages.common.save'), ['type' => 'submit', 'class' => 'btn btn-primary me-3', 'id' => 'editInstagramEmbedSave']) }}
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('messages.common.discard') }}</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
