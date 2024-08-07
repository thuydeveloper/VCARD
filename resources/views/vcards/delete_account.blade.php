@extends('layouts.app')
@section('title')
    {{ __('messages.dashboard') }}
@endsection
@section('content')
<div class="container-fluid">
    <div class="col-12">
        @if(Session::has('success'))
            <p class="alert alert-success">{{ getSuccessMessage(Request::query('part')).Session::get('success') }}</p>
        @endif
        @if(Session::has('error'))
            <p class="alert alert-danger">{{ getSuccessMessage(Request::query('part')).Session::get('error') }}</p>
        @endif
        @include('layouts.errors')
        @include('flash::message')
    </div>
    <div class="card h-100">
        <div class="d-flex align-items-center justify-content-center h-100">
        <div class="card-body d-flex flex-column position-relative align-items-center">
            <div class="ps-sm-3 pt-lg-auto pt-0 w-100 h-100 overflow-auto text-center" id="main">
                    <div class="text-center">
                        <h1 class="confirmation-text p-5">{{ __('messages.common.user_delete') }}</h1>
                        <h3 class="warning-message"><strong class="text-warning">{{__('messages.vcard.warning') }}: </strong>{{__('messages.common.user_delete_warning') }}</h3>
                        <button type="button" class="btn btn-danger mt-5" data-bs-toggle="modal" data-bs-target="#userDeleteModal">
                            {{__('messages.common.account_delete') }}
                        </button>
                        <div class="modal fade" id="userDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="text-end px-3 pt-2">
                                        <button type="button " class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body pb-0 pt-2">
                                        <img src="{{ asset('images/Alert.png') }}" alt="">
                                        <h3 class="p-5 pb-0">{{__('messages.common.user_delete') }}</h3>
                                    </div>
                                    <div class="p-5 text-center">
                                        <form method="POST" action="{{ route('delete-user', ['user' => auth()->user()->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" data-turbo="false">{{__('messages.common.account_delete') }}</button>
                                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">{{ __('messages.common.cancel') }} </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @include('dashboard.templates.templates')
    @include('dashboard.templates.userTemplate')
@endsection
