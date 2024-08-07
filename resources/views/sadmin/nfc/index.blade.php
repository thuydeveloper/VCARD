@extends('layouts.app')
@section('title')
    {{__('NFC Card Types')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column table-striped">
            @include('flash::message')
            <livewire:nfc-table lazy/>
        </div>
    </div>

    @include('sadmin.nfc.guide_nfc_modal')
    @include('sadmin.nfc.add_nfc_modal')
    @include('sadmin.nfc.edit')
@endsection
