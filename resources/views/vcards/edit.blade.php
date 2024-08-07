@extends('layouts.app')
@section('title')
    {{ __('messages.vcard.edit_vcard') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <h1>{{ __('messages.vcard.edit_vcard') }}</h1>
            <a class="btn btn-outline-primary float-end"
                href="{{ route('vcards.index') }}">{{ __('messages.common.back') }}</a>
        </div>
        <div class="col-12">
            @if (Session::has('success'))
                <p class="alert alert-success">{{ getSuccessMessage(Request::query('part')) . Session::get('success') }}</p>
            @endif
            @if (Session::has('error'))
                <p class="alert alert-danger">{{ getSuccessMessage(Request::query('part')) . Session::get('error') }}</p>
            @endif
            @include('layouts.errors')
            @include('flash::message')
        </div>
        <div class="card">
            <div class="card-body d-sm-flex position-relative px-2">
                <div class="">
                    <div class="">
                        @include('vcards.sub_menu')
                    </div>
                </div>
                <div class="ps-sm-3 pt-lg-auto pt-0 w-100 overflow-auto px-1" id="main">
                    <button type="button"
                        class="btn px-0 aside-menu-container__aside-menubar d-block d-xl-none d-lg-none d-block edit-menu"
                        onclick="openNav()">
                        <i class="fa-solid fa-bars fs-1"></i>
                    </button>
                    {{ Form::hidden('is_true', Request::query('part') == 'business_hours', ['id' => 'vcardCreateEditIsTrue']) }}
                    @if (
                        $partName != 'services' &&
                            $partName != 'blogs' &&
                            $partName != 'testimonials' &&
                            $partName != 'products' &&
                            $partName != 'galleries' &&
                            $partName != 'instagram-embed' &&
                            $partName != 'banners' &&
                            $partName != 'iframes')
                        {!! Form::open([
                            'route' => ['vcards.update', $vcard->id],
                            'id' => 'editForm',
                            'method' => 'put',
                            'files' => 'true',
                        ]) !!}
                        @include('vcards.fields')
                        {{ Form::close() }}
                    @else
                        @if ($partName === 'blogs')
                            @include('vcards.blogs.index')
                        @elseif($partName === 'services')
                            @include('vcards.services.index')
                        @elseif($partName === 'products')
                            @include('vcards.products.index')
                        @elseif($partName === 'banners')
                            @include('vcards.banner.index')
                        @elseif($partName === 'galleries')
                            @include('vcards.gallery.index')
                        @elseif($partName === 'instagram-embed')
                            @include('vcards.instagram-embed.index')
                        @elseif($partName === 'iframes')
                            @include('vcards.iframes.index')
                        @else
                            @include('vcards.testimonials.index')
                        @endif
                    @endif
                    {{-- @if ($partName !== 'services' && $partName !== 'products' && $partName !== 'testimonials' && $partName !== 'galleries' && $partName !== 'blogs' && $partName !== 'iframes') --}}
                </div>
            </div>
        </div>
    </div>

@endsection
