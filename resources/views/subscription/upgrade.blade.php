@extends('layouts.app')
@section('title')
    {{ __('messages.subscription.upgrade_plan') }}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="card subscription">
            <div class="card-body">
                <div class="d-flex flex-column">
                    <div class="nav-group mx-auto">
                        <ul class="nav nav-pills">
                            @if ($monthlyPlans->isNotEmpty())
                                <li class="nav-item">
                                    <a data-bs-toggle="tab" href="#monthly" class="nav-link active">
                                        {{ __('messages.plan.monthly') }}</a>
                                </li>
                            @endif
                            @if ($yearlyPlans->isNotEmpty())
                                <li class="nav-item">
                                    <a data-bs-toggle="tab" href="#yearly" class="nav-link {{ ($monthlyPlans->isNotEmpty()) ? '' : 'active' }}">
                                        {{ __('messages.plan.yearly') }}</a>
                                </li>
                            @endif
                            @if ($unLimitedPlans->isNotEmpty())
                                <li class="nav-item">
                                    <a data-bs-toggle="tab" href="#unlimited" class="nav-link {{ ($monthlyPlans->isNotEmpty() || $yearlyPlans->isNotEmpty()) ? '' : 'active' }}">
                                        {{ __('messages.plan.unlimited') }}</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    @php
                         $activeTab = '';
                        if ($monthlyPlans->isNotEmpty()) {
                            $activeTab = 'monthly';
                        } elseif ($yearlyPlans->isNotEmpty()) {
                            $activeTab = 'yearly';
                        } elseif ($unLimitedPlans->isNotEmpty()) {
                            $activeTab = 'unlimited';
                        }
                    @endphp
                    <div class="col-12 text-gray-700 h5 text-center pt-10">
                        <div class="tab-content">
                            @if ($monthlyPlans->isNotEmpty())
                            <div class="tab-pane {{ $activeTab == 'monthly' ? 'show active' : '' }}" id="monthly">
                                <div class="row justify-content-center">
                                    @forelse($monthlyPlans as $plan)
                                        @php
                                            if ($plan->custom_select == 1 && $plan->planCustomFields->isNotEmpty()) {
                                                $plan->price = $plan->planCustomFields[0]->custom_vcard_price;
                                            }
                                        @endphp
                                        <div class="col-xl-4 col-lg-5 col-md-5 col-sm-6">
                                            <div class="card pricing-card bg-light p-5 shadow-lg mb-8">
                                                <h1>{!! $plan->name !!}</h1>
                                                @if ($plan->custom_select == 1 && $plan->planCustomFields->isNotEmpty())
                                                    <h1 class="pricing-amount" id="priceDisplay">
                                                        <span
                                                            id="currentPrice-{{ $plan->id }}">{{ currencyFormat($plan->planCustomFields[0]->custom_vcard_price, 2, $plan->currency->currency_code) }}</span>
                                                    </h1>
                                                @else
                                                    <h1 class="pricing-amount">
                                                        {{ currencyFormat($plan->price, 2, $plan->currency->currency_code) }}
                                                    </h1>
                                                @endif
                                                <div class="card-body p-3 ">
                                                    <div class="pricing-description text-start">
                                                        <div
                                                            class="mb-3 {{ $plan->custom_select == '1' && $plan->planCustomFields->isNotEmpty() ? '' : 'pb-10' }}">
                                                            @if ($plan->custom_select == 1 && $plan->planCustomFields->isNotEmpty())
                                                                <div class="d-flex justify-content-between mb-4">
                                                                    <small class="text-muted" @if(getLogInUser()->language == 'ar') style="margin-left: 30px" @endif>
                                                                        {{ __('messages.plan.no_of_vcards') }}
                                                                    </small>
                                                                    <select id="vcardNumberSelect-{{ $plan->id }}"
                                                                        class="form-select vcard-numbers"
                                                                        style="width: auto;"
                                                                        data-plan-id="{{ $plan->id }}">
                                                                        @foreach ($plan->planCustomFields as $customField)
                                                                            @php
                                                                                $formattedPrice = currencyFormat(
                                                                                    $customField->custom_vcard_price,
                                                                                    2,
                                                                                    $plan->currency->currency_code,
                                                                                );
                                                                            @endphp
                                                                            <option value="{{ $customField->id }}"
                                                                                data-price="{{ $formattedPrice }}"
                                                                                data-currency="{{ $plan->currency->currency_code }}">
                                                                                {{ $customField->custom_vcard_number }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            @else
                                                                <small class="text-muted" @if(getLogInUser()->language == 'ar') style="margin-left: 290px" @endif >
                                                                    {{ __('messages.plan.no_of_vcards') . ' : ' . $plan->no_of_vcards }}</small>
                                                            @endif
                                                        </div>
                                                        <div class="mb-6">
                                                            <small class="text-muted" @if(getLogInUser()->language == 'ar') style="margin-left: 320px" @endif>
                                                                {{ __('messages.plan.storage_limit') . ' : ' . $plan->storage_limit }}</small>
                                                        </div>
                                                        @foreach (getPlanFeature($plan) as $feature => $value)
                                                            <div class="d-flex justify-content-between mb-4">
                                                                <p class="fw-normal">
                                                                    {{ __('messages.feature.' . $feature) }}
                                                                </p>
                                                                @if ($value)
                                                                    <i class="fa-solid fa-circle-check fs-2"></i>
                                                                @else
                                                                    <i class="fa-solid fa-circle-xmark fs-2"></i>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="flex-center flex-row-fluid pt-5">
                                                    @if (
                                                        !empty(getCurrentSubscription()) &&
                                                            $plan->id == getCurrentSubscription()->plan_id &&
                                                            !getCurrentSubscription()->isExpired())
                                                        @if ($plan->price != 0)
                                                            <button type="button"
                                                                class="btn btn-success rounded-pill mx-auto d-block cursor-remove-plan pricing-plan-button-active"
                                                                data-id="{{ $plan->id }}">
                                                                {{ __('messages.subscription.currently_active') }}</button>
                                                        @else
                                                            <button type="button"
                                                                class="btn btn-info rounded-pill mx-auto d-block cursor-remove-plan">
                                                                {{ __('messages.subscription.renew_free_plan') }}
                                                            </button>
                                                        @endif
                                                    @else
                                                        @if (
                                                            !empty(getCurrentSubscription()) &&
                                                                !getCurrentSubscription()->isExpired() &&
                                                                ($plan->price == 0 || $plan->price != 0))
                                                            @if ($plan->hasZeroPlan->count() == 0)
                                                                <a data-turbo="false"
                                                                    href="{{ $plan->price != 0 ? route('choose.payment.type', $plan->id) : 'javascript:void(0)' }}"
                                                                    class="btn btn-primary rounded-pill mx-auto {{ $plan->price == 0 ? 'freePayment' : '' }}"
                                                                    id="planId{{ $plan->id }}"
                                                                    data-id="{{ $plan->id }}"
                                                                    data-plan-price="{{ $plan->price }}">
                                                                    {{ __('messages.subscription.switch_plan') }}</a>
                                                            @else
                                                                <button type="button"
                                                                    class="btn btn-info rounded-pill mx-auto d-block cursor-remove-plan">
                                                                    {{ __('messages.subscription.renew_free_plan') }}
                                                                </button>
                                                            @endif
                                                        @else
                                                            @if ($plan->price != 0 && $plan->hasZeroPlan->count() == 0)
                                                                <a data-turbo="false"
                                                                    href="{{ $plan->price != 0 ? route('choose.payment.type', $plan->id) : 'javascript:void(0)' }}"
                                                                    class="btn btn-primary rounded-pill mx-auto  {{ $plan->price == 0 ? 'freePayment' : '' }}"
                                                                    id="planId{{ $plan->id }}"
                                                                    data-id="{{ $plan->id }}"
                                                                    data-plan-price="{{ $plan->price }}">
                                                                    {{ __('messages.subscription.choose_plan') }}</a>
                                                            @else
                                                                <button type="button"
                                                                    class="btn btn-info rounded-pill mx-auto d-block cursor-remove-plan">
                                                                    {{ __('messages.subscription.renew_free_plan') }}
                                                                </button>
                                                            @endif
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="not-plan">
                                            <span
                                                class="text-muted h1">{{ __('messages.subscription.no_plan_available') }}</span>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            @endif
                            @if ($yearlyPlans->isNotEmpty())
                            <div class="tab-pane {{ $activeTab == 'yearly' ? 'show active' : '' }}" id="yearly">
                                <div class="row justify-content-center">
                                    @forelse($yearlyPlans as $plan)
                                        @php
                                            if ($plan->custom_select == 1 && $plan->planCustomFields->isNotEmpty()) {
                                                $plan->price = $plan->planCustomFields[0]->custom_vcard_price;
                                            }
                                        @endphp
                                        <div class="col-xl-4 col-lg-5 col-md-5 col-sm-6">
                                            <div class="card pricing-card bg-light p-5 shadow-lg mb-8">
                                                <h1>{!! $plan->name !!}</h1>
                                                @if ($plan->custom_select == 1 && $plan->planCustomFields->isNotEmpty())
                                                    <h1 class="pricing-amount priceDisplayclass" id="priceDisplay">
                                                        <span
                                                            id="currentPrice-{{ $plan->id }}">{{ currencyFormat($plan->planCustomFields[0]->custom_vcard_price, 2, $plan->currency->currency_code) }}</span>
                                                    </h1>
                                                @else
                                                    <h1 class="pricing-amount">
                                                        {{--                                                    {{$plan->currency->currency_icon.number_format($plan->price) }} --}}
                                                        {{ currencyFormat($plan->price, 2, $plan->currency->currency_code) }}
                                                    </h1>
                                                @endif
                                                <div class="card-body p-3">
                                                    <div class="pricing-description text-start">
                                                        <div
                                                            class="mb-3 {{ $plan->custom_select == '1' && $plan->planCustomFields->isNotEmpty() ? '' : 'pb-10' }}">
                                                            @if ($plan->custom_select == 1 && $plan->planCustomFields->isNotEmpty())
                                                                <div class="d-flex justify-content-between mb-4">
                                                                    <small class="text-muted" @if(getLogInUser()->language == 'ar') style="margin-left: 30px" @endif>
                                                                        {{ __('messages.plan.no_of_vcards') }}
                                                                    </small>
                                                                    <select id="vcardNumberSelect-{{ $plan->id }}"
                                                                        class="form-select vcard-numbers"
                                                                        style="width: auto;"
                                                                        data-plan-id="{{ $plan->id }}">
                                                                        @foreach ($plan->planCustomFields as $customField)
                                                                            @php
                                                                                $formattedPrice = currencyFormat(
                                                                                    $customField->custom_vcard_price,
                                                                                    2,
                                                                                    $plan->currency->currency_code,
                                                                                );
                                                                            @endphp
                                                                            <option value="{{ $customField->id }}"
                                                                                data-price="{{ $formattedPrice }}"
                                                                                data-currency="{{ $plan->currency->currency_code }}">
                                                                                {{ $customField->custom_vcard_number }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            @else
                                                                <small class="text-muted" @if(getLogInUser()->language == 'ar') style="margin-left: 290px" @endif>
                                                                    {{ __('messages.plan.no_of_vcards') . ' : ' . $plan->no_of_vcards }}
                                                                </small>
                                                            @endif
                                                        </div>
                                                        <div class="mb-6">
                                                            <small class="text-muted" @if(getLogInUser()->language == 'ar') style="margin-left: 320px" @endif>
                                                                {{ __('messages.plan.storage_limit') . ' : ' . $plan->storage_limit }}</small>
                                                        </div>
                                                        @foreach (getPlanFeature($plan) as $feature => $value)
                                                            <div class="d-flex justify-content-between mb-4">
                                                                <p class="fw-normal">
                                                                    {{ __('messages.feature.' . $feature) }}
                                                                </p>
                                                                @if ($value)
                                                                    <i class="fa-solid fa-circle-check fs-2"></i>
                                                                @else
                                                                    <i class="fa-solid fa-circle-xmark fs-2"></i>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="flex-center flex-row-fluid pt-5">
                                                    @if (
                                                        !empty(getCurrentSubscription()) &&
                                                            $plan->id == getCurrentSubscription()->plan_id &&
                                                            !getCurrentSubscription()->isExpired())
                                                        @if ($plan->price != 0)
                                                            <button type="button"
                                                                class="btn btn-success rounded-pill mx-auto d-block cursor-remove-plan pricing-plan-button-active"
                                                                data-id="{{ $plan->id }}">
                                                                {{ __('messages.subscription.currently_active') }}</button>
                                                        @else
                                                            <button type="button"
                                                                class="btn btn-info rounded-pill mx-auto d-block cursor-remove-plan">
                                                                {{ __('messages.subscription.renew_free_plan') }}
                                                            </button>
                                                        @endif
                                                    @else
                                                        @if (
                                                            !empty(getCurrentSubscription()) &&
                                                                !getCurrentSubscription()->isExpired() &&
                                                                ($plan->price == 0 || $plan->price != 0))
                                                            @if ($plan->hasZeroPlan->count() == 0)
                                                                <a data-turbo="false"
                                                                    href="{{ $plan->price != 0 ? route('choose.payment.type', $plan->id) : 'javascript:void(0)' }}"
                                                                    class="btn btn-primary rounded-pill mx-auto {{ $plan->price == 0 ? 'freePayment' : '' }}"
                                                                    id="planId{{ $plan->id }}"
                                                                    data-id="{{ $plan->id }}"
                                                                    data-plan-price="{{ $plan->price }}">
                                                                    {{ __('messages.subscription.switch_plan') }}</a>
                                                            @else
                                                                <button type="button"
                                                                    class="btn btn-info rounded-pill mx-auto d-block cursor-remove-plan">
                                                                    {{ __('messages.subscription.renew_free_plan') }}
                                                                </button>
                                                            @endif
                                                        @else
                                                            @if ($plan->hasZeroPlan->count() == 0)
                                                                <a data-turbo="false"
                                                                    href="{{ $plan->price != 0 ? route('choose.payment.type', $plan->id) : 'javascript:void(0)' }}"
                                                                    class="btn btn-primary rounded-pill mx-auto {{ $plan->price == 0 ? 'freePayment' : '' }}"
                                                                    id="planId{{ $plan->id }}"
                                                                    data-id="{{ $plan->id }}"
                                                                    data-plan-price="{{ $plan->price }}">
                                                                    {{ __('messages.subscription.choose_plan') }}</a>
                                                            @else
                                                                <button type="button"
                                                                    class="btn btn-info rounded-pill mx-auto d-block cursor-remove-plan">
                                                                    {{ __('messages.subscription.renew_free_plan') }}
                                                                </button>
                                                            @endif
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="not-plan">
                                            <span
                                                class="text-muted h1">{{ __('messages.subscription.no_plan_available') }}</span>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            @endif
                            @if ($unLimitedPlans->isNotEmpty())
                            <div class="tab-pane {{ $activeTab == 'unlimited' ? 'show active' : '' }}" id="unlimited">
                                <div class="row justify-content-center">
                                    @forelse($unLimitedPlans as $plan)
                                        @php
                                            if ($plan->custom_select == 1 && $plan->planCustomFields->isNotEmpty()) {
                                                $plan->price = $plan->planCustomFields[0]->custom_vcard_price;
                                            }
                                        @endphp
                                        <div class="col-xl-4 col-lg-5 col-md-5 col-sm-6">
                                            <div class="card pricing-card bg-light p-5 shadow-lg mb-8">
                                                <h1>{!! $plan->name !!}</h1>
                                                @if ($plan->custom_select == 1 && $plan->planCustomFields->isNotEmpty())
                                                    <h1 class="pricing-amount priceDisplayclass" id="priceDisplay">
                                                        <span
                                                            id="currentPrice-{{ $plan->id }}">{{ currencyFormat($plan->planCustomFields[0]->custom_vcard_price, 2, $plan->currency->currency_code) }}</span>
                                                    </h1>
                                                @else
                                                    <h1 class="pricing-amount">
                                                        {{--                                                    {{$plan->currency->currency_icon.number_format($plan->price) }} --}}
                                                        {{ currencyFormat($plan->price, 2, $plan->currency->currency_code) }}
                                                    </h1>
                                                @endif
                                                <div class="card-body p-3">
                                                    <div class="pricing-description text-start">
                                                        <div
                                                            class="mb-3 {{ $plan->custom_select == '1' && $plan->planCustomFields->isNotEmpty() ? '' : 'pb-10' }}">
                                                            @if ($plan->custom_select == 1 && $plan->planCustomFields->isNotEmpty())
                                                                <div class="d-flex justify-content-between mb-4">
                                                                    <small class="text-muted" @if(getLogInUser()->language == 'ar') style="margin-left: 30px" @endif>
                                                                        {{ __('messages.plan.no_of_vcards') }}
                                                                    </small>
                                                                    <select id="vcardNumberSelect-{{ $plan->id }}"
                                                                        class="form-select vcard-numbers"
                                                                        style="width: auto;"
                                                                        data-plan-id="{{ $plan->id }}">
                                                                        @foreach ($plan->planCustomFields as $customField)
                                                                            @php
                                                                                $formattedPrice = currencyFormat(
                                                                                    $customField->custom_vcard_price,
                                                                                    2,
                                                                                    $plan->currency->currency_code,
                                                                                );
                                                                            @endphp
                                                                            <option value="{{ $customField->id }}"
                                                                                data-price="{{ $formattedPrice }}"
                                                                                data-currency="{{ $plan->currency->currency_code }}">
                                                                                {{ $customField->custom_vcard_number }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            @else
                                                                <small class="text-muted" @if(getLogInUser()->language == 'ar') style="margin-left: 290px" @endif>
                                                                    {{ __('messages.plan.no_of_vcards') . ' : ' . $plan->no_of_vcards }}
                                                                </small>
                                                            @endif
                                                        </div>
                                                        <div class="mb-6">
                                                            <small class="text-muted" @if(getLogInUser()->language == 'ar') style="margin-left: 320px" @endif>
                                                                {{ __('messages.plan.storage_limit') . ' : ' . $plan->storage_limit }}</small>
                                                        </div>
                                                        @foreach (getPlanFeature($plan) as $feature => $value)
                                                            <div class="d-flex justify-content-between mb-4">
                                                                <p class="fw-normal">
                                                                    {{ __('messages.feature.' . $feature) }}</p>
                                                                @if ($value)
                                                                    <i class="fa-solid fa-circle-check fs-2"></i>
                                                                @else
                                                                    <i class="fa-solid fa-circle-xmark fs-2"></i>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="flex-center flex-row-fluid pt-5">
                                                    @if (
                                                        !empty(getCurrentSubscription()) &&
                                                            $plan->id == getCurrentSubscription()->plan_id &&
                                                            !getCurrentSubscription()->isExpired())
                                                        @if ($plan->price != 0)
                                                            <button type="button"
                                                                class="btn btn-success rounded-pill mx-auto d-block cursor-remove-plan pricing-plan-button-active"
                                                                data-id="{{ $plan->id }}">
                                                                {{ __('messages.subscription.currently_active') }}</button>
                                                        @else
                                                            <button type="button"
                                                                class="btn btn-info rounded-pill mx-auto d-block cursor-remove-plan">
                                                                {{ __('messages.subscription.renew_free_plan') }}
                                                            </button>
                                                        @endif
                                                    @else
                                                        @if (
                                                            !empty(getCurrentSubscription()) &&
                                                                !getCurrentSubscription()->isExpired() &&
                                                                ($plan->price == 0 || $plan->price != 0))
                                                            @if ($plan->hasZeroPlan->count() == 0)
                                                                <a data-turbo="false"
                                                                    href="{{ $plan->price != 0 ? route('choose.payment.type', $plan->id) : 'javascript:void(0)' }}"
                                                                    class="btn btn-primary rounded-pill mx-auto {{ $plan->price == 0 ? 'freePayment' : '' }}"
                                                                    id="planId{{ $plan->id }}"
                                                                    data-id="{{ $plan->id }}"
                                                                    data-plan-price="{{ $plan->price }}">
                                                                    {{ __('messages.subscription.switch_plan') }}</a>
                                                            @else
                                                                <button type="button"
                                                                    class="btn btn-info rounded-pill mx-auto d-block cursor-remove-plan">
                                                                    {{ __('messages.subscription.renew_free_plan') }}
                                                                </button>
                                                            @endif
                                                        @else
                                                            @if ($plan->hasZeroPlan->count() == 0)
                                                                <a data-turbo="false"
                                                                    href="{{ $plan->price != 0 ? route('choose.payment.type', $plan->id) : 'javascript:void(0)' }}"
                                                                    class="btn btn-primary rounded-pill mx-auto {{ $plan->price == 0 ? 'freePayment' : '' }}"
                                                                    data-id="{{ $plan->id }}"
                                                                    id="planId{{ $plan->id }}"
                                                                    data-plan-price="{{ $plan->price }}">
                                                                    {{ __('messages.subscription.choose_plan') }}</a>
                                                            @else
                                                                <button type="button"
                                                                    class="btn btn-info rounded-pill mx-auto d-block cursor-remove-plan">
                                                                    {{ __('messages.subscription.renew_free_plan') }}
                                                                </button>
                                                            @endif
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="not-plan">
                                            <span
                                                class="text-muted h1">{{ __('messages.subscription.no_plan_available') }}</span>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
