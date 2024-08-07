<div class="modal fade" id="addFrontFaqsModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('messages.faqs.newfaqs') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {!! Form::open(['id'=>'addFrontFaqsForm', 'files' => 'true']) !!}
            <div class="modal-body">
                <div class="mb-5">
                    {{ Form::label('title',__('messages.front_cms.title').(':'), ['class' => 'form-label required']) }}
                    {{ Form::text('title', null, ['class' => 'form-control','required', 'placeholder' => __('messages.faqs.titlefaqs')]) }}
                </div>
                <div class="mb-5">
                    {{ Form::label('description', __('messages.common.description').':', ['class' => 'form-label required']) }}
                    {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => __('messages.form.short_description'), 'rows' => '5' , 'required']) }}
                </div>
            </div>

            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary m-0','id'=>'faqsSave']) }}
                <button type="button" class="btn btn-secondary my-0 ms-5 me-0"
                        data-bs-dismiss="modal">{{ __('messages.common.discard') }}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
