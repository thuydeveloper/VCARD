@extends('layouts.app')
@section('title')
    {{__('messages.subscriber')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column table-striped">
            @include('flash::message')
            <livewire:email-subscription-table lazy/>
        </div>
    </div>
@endsection
