@extends('layouts.app')
@section('title')
{{ __('messages.send_mail.send_mail') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            @include('layouts.errors')
            <div class="d-flex justify-content-between align-items-end mb-5">
                <h1>{{ __('messages.send_mail.send_mail') }}</h1>
            </div>
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['route' => ['send.mail.store'], 'method' => 'post', 'id' => 'emailForm']) }}
                    <div class="form-group mb-3">
                        {{ Form::label('subject', __('messages.send_mail.subject') . ':', ['class' => 'form-label required']) }}
                        {{ Form::text('subject', null, ['class' => 'form-control', 'id' => 'subjectFiled', 'placeholder' => __('messages.send_mail.subject')]) }}
                    </div>

                    <div class="form-group mb-3">
                        <div class="col-lg-12">
                            <div class="mb-5">
                                {{ Form::label('description', __('messages.send_mail.description') .':', ['class' => 'form-label required']) }}
                                <div id="descriptionEditor" class="editor-height" style="height: 200px" data-turbo="false"></div>
                                {{ Form::hidden('description', null, ['id' => 'sendEmailData']) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        {{ Form::label('email', __('messages.send_mail.send_mail') . ':', ['class' => 'form-label required']) }}
                        {{ Form::select('custom_email[]', $newEmail, null, ['class' => 'form-control', 'data-control' => 'select2', 'multiple' => 'multiple', 'id'=> 'customEmailSelect']) }}
                    </div>
                    <div class="form-group mb-3">
                        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3', 'id' => 'submitSendMailBtn']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
