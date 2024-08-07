@extends('layouts.app')
@section('title')
    {{__('messages.contact_us.inquries')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column table-striped">
            @include('flash::message')
            <livewire:contact-us-table lazy/>
        </div>
    </div>
@endsection
