@extends('layouts.app')
@section('title')
    {{ __('messages.language') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column table-striped">
            @include('flash::message')
            <livewire:default-language-table lazy/>
        </div>
    </div>
@endsection
