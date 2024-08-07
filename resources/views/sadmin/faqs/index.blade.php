@extends('layouts.app')
@section('title')
    {{__('messages.faqs.faqs')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column table-striped">
            @include('layouts.errors')
            <livewire:front-faqs-table lazy/>
        </div>
    </div>

    @include('sadmin.faqs.create')
    @include('sadmin.faqs.edit')
    @include('sadmin.faqs.show')
@endsection
