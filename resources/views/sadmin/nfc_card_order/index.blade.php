@extends('layouts.app')
@section('title')
    {{ __('NFC Card Orders') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column table-striped">
            @include('flash::message')
            <livewire:nfc-card-order-table lazy/>
        </div>
    </div>
@endsection
