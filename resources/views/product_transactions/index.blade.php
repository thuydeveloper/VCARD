@extends('layouts.app')
@section('title')
    {{ __('Product Transactions') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column table-striped">
            <livewire:product-transactions-table lazy/>
        </div>
    </div>
@endsection
