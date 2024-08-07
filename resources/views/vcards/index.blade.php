@extends('layouts.app')
@section('title')
    {{__('messages.vcards')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column table-striped">
            @include('flash::message')
            @if(getLogInUser()->vcard_table_view_type == 0)
            <livewire:user-vcard-table lazy/>
            @else
            <livewire:vcard-lists lazy/>
            @endif
        </div>
    </div>

    @include('layouts.templates.actions')
    @include('vcards.templates.templates')
    @include('vcards.templates.analytics')
@endsection
