@extends('layouts.app')
@section('title')
    {{ __('messages.plan.affiliation') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="col-12">
                @include('flash::message')
                <div class="d-flex justify-content-between align-items-end mb-5">
                    <h1>{{ __('messages.plan.affiliation') }}</h1>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="urlLink" placeholder="Copy Url"
                                aria-label="Recipient's username" aria-describedby="basic-addon2" readonly
                                value="{{ config('app.url') }}/register?referral-code={{ getLogInUser()->affiliate_code }}">
                            <button onclick="copyClipboardUrl()" class="btn btn-primary" id="copyLinkBtn">
                                <span class="copy-link-btn"></span>{{ __('messages.copy_text') }}</button>
                        </div>
                        {{-- <h3 >You will get <b> {{ currencyFormat(getSuperAdminSettingValue('affiliation_amount'))  }}</b> for each affiliation referral</h3> --}}
                    </div>
                    <div class="col">
                        <div class="card-toolbar custom-toolbar ms-auto">
                            <div class="d-flex justify-content-end">
                                <a type="button" class="btn btn-warning me-2" data-bs-target="#adminGuideAffiliationModal" id="adminGuideAffiliation" >{{ __('messages.affiliation.how_it_works') }}</a>
                                <a type="button" class="btn btn-primary sendInviteBtn">{{ __('messages.plan.sendinvite') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 widget">
                                <div
                                    class="bg-info shadow-md rounded-10 p-xxl-10 px-7 py-10 d-flex align-items-center
                            justify-content-between my-3">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <h2 class="fw-bolder text-white">
                                            {{ __('messages.affiliation.total_affiliation_amount') }}</h2>
                                    </div>
                                    <div class="text-end text-white">
                                        <h3 class="mb-0 fs-3 ">{{ currencyFormat($totalAmount, 2) }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 widget">
                                <div
                                    class="bg-success shadow-md rounded-10 p-xxl-10 px-7 py-10 d-flex align-items-center justify-content-between my-3">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <h2 class="fw-bolder text-white">{{ __('messages.affiliation.current_amount') }}
                                        </h2>
                                    </div>
                                    <div class="text-end text-white">
                                        <h3 class="mb-0 fs-3"> {{ currencyFormat($currentAmount, 2) }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3 class="text-primary">
                            {{ __('messages.affiliation.affiliate_note') }}
                            @if(getSuperAdminSettingValue('affiliation_amount_type') ==1){{ currencyFormat(getSuperAdminSettingValue('affiliation_amount')) }}
                            @else {{ getSuperAdminSettingValue('affiliation_amount') }}%
                            @endif
                        </h3>
                    </div>
                </div>
                <ul class="nav nav-pills my-5 products-detail__nav-pills position-relative" id="affiliationWithdraw">
                    <li class="nav-item">
                        <button class="nav-link active position-relative" id="affiliation-tab" data-bs-toggle="pill"
                            data-bs-target="#affiliation" type="button" role="tab" aria-controls="affiliation"
                            aria-selected="true">{{ __('messages.feature.affiliation') }}
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link position-relative" id="withdrawal-tab" data-bs-toggle="pill"
                            data-bs-target="#withdrawal" type="button" role="tab" aria-controls="withdrawal"
                            aria-selected="false">{{ __('messages.affiliation.withdrawal') }}
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="affiliation" role="tabpanel"
                        aria-labelledby="affiliation-tab">
                        <div class="">
                            <livewire:affiliate-user-table />
                        </div>
                    </div>
                    <div class="tab-pane fade " id="withdrawal" role="tabpanel" aria-labelledby="withdrawal-tab">
                        <div class="">
                            <livewire:withdrawal-table />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('user-settings.affiliationWithdraw.guide_affiliation')
    @include('user-settings.affiliationWithdraw.withdraw-modal')
    @include('user-settings.affiliationWithdraw.sendmail-modal')
    @include('sadmin.affiliationWithdraw.show-withdraw-modal')
@endsection
