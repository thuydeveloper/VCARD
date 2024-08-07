<div class="modal fade" id="editiframeModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">{{ __('messages.vcard.edit_iframe') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['id'=>'editiframeForm', 'files' => 'true']) !!}
                <div class="row">
                    <div class="col-sm-12 mb-5">
                        {{ Form::hidden('iframe_id', null,['id' => 'iframe_id']) }}
                        {{ Form::label('URL',__('messages.vcard.url').(':'), ['class' => 'form-label required']) }}
                        {{ Form::text('url', null, ['class' => 'form-control', 'id' => 'editUrl', 'required', 'placeholder' => __('messages.vcard.add_iframe_url')]) }}
                    </div>
                    <div class="modal-footer pt-0">
                        {{ Form::button(__('messages.common.save'),['class' => 'btn btn-primary m-0','id' => 'iframeUpdate','type'=>'submit']) }}
                        {{ Form::button(__('messages.common.discard'),['class' => 'btn btn-secondary my-0 ms-5 me-0','data-bs-dismiss' => 'modal']) }}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
