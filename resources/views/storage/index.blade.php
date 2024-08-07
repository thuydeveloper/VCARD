@extends('layouts.app')
@section('title')
    {{ 'Storage' }}
@endsection
@section('content')
<div class="container-fluid">
    <div class="d-flex flex-column table-striped">
        @include('flash::message')
    </div>
    <div class="row">
        <!-- Storage Overview -->
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body" style="height:550px">
                    <h5 class="card-title border-bottom pb-3">{{ __('messages.storage_overview') }}</h5>
                    <div>
                        <canvas id="storagePieChart" data-chart-data="{{ json_encode($chartData['data']) }}" data-chart-labels="{{ json_encode($chartData['labels']) }}" style="height: 300px"></canvas>
                    </div>
                    <div class="mt-7">
                        <!-- Legend -->
                        <div class="d-flex flex-wrap justify-content-center gap-4">
                            <div style="min-width:175px;">
                                <span style="background-color: #6571FF;" class="px-5 py-1 rounded-2"></span>
                                <span class="mx-3">{{ __('messages.used_storage') }}</span>
                            </div>
                            <div style="min-width:175px;">
                                <span style="background-color: #C1C6FF;" class="px-5 py-1 rounded-2"></span>
                                <span class="mx-3">{{ __('messages.unused_storage') }}</span>
                            </div>
                        </div>
                        <!-- Storage Usage Progress Bar -->
                        <div class="mt-5 text-end">
                            {{ intval($userLimit) }} {{ __('messages.mb') }} / {{ $storageLimit }} {{ __('messages.mb') }}
                        </div>
                        <div class="progress mt-5">
                            <div class="progress-bar" role="progressbar" style="width: {{ ($userLimit / $storageLimit) * 100 }}%;" aria-valuenow="{{ $userLimit }}" aria-valuemin="0" aria-valuemax="{{ $storageLimit }}"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Storage Used Details -->
        <div class="col-sm-6 mt-sm-0 mt-5">
            <div class="card">
                <div class="card-body" style="height:550px">
                    <!-- Storage Used Details -->
                    <h5 class="card-title border-bottom pb-3">{{ __('messages.storage_used') }}</h5>
                    <!-- Product Storage -->
                    <h5 class="card-title mt-4 mb-4">{{ __('messages.vcards') }}</h5>
                    <div class="overflow-auto">
                        <!-- Table for storage details -->
                        <table class="table w-100 table-borderless" style="white-space: nowrap">
                            <tr>
                                <td class="ps-0">{{ __('messages.vcard.products') }}</td>
                                <td class="pe-0" style="width:120px;">{{ number_format($productStorageMB, 2) }} {{ __('messages.mb') }}</td>
                                <td class="pe-0" style="width:120px;">{{ number_format(($productStorageMB / $storageLimit) * 100, 2) }}%</td>
                            </tr>
                            <tr>
                                <td class="ps-0">{{ __('messages.vcard.services') }}</td>
                                <td class="pe-0" style="width:120px;">{{ number_format($serviceStorageMB, 2) }} {{ __('messages.mb') }}</td>
                                <td class="pe-0" style="width:120px;">{{ number_format(($serviceStorageMB / $storageLimit) * 100, 2) }}%</td>
                            </tr>
                            <tr>
                                <td class="ps-0">{{ __('messages.vcard.testimonials') }}</td>
                                <td class="pe-0" style="width:120px;">{{ number_format($testimonialStorageMB, 2) }} {{ __('messages.mb') }}</td>
                                <td class="pe-0" style="width:120px;">{{ number_format(($testimonialStorageMB / $storageLimit) * 100, 2) }}%</td>
                            </tr>
                            <tr>
                                <td class="ps-0">{{ __('messages.social_icon') }}</td>
                                <td class="pe-0" style="width:120px;">{{ number_format($socialStorageMB, 2) }} {{ __('messages.mb') }}</td>
                                <td class="pe-0" style="width:120px;">{{ number_format(($socialStorageMB / $storageLimit) * 100, 2) }}%</td>
                            </tr>
                            <tr>
                                <td class="ps-0">{{ __('messages.vcard.blogs') }}</td>
                                <td class="pe-0" style="width:120px;">{{ number_format($blogStorageMB, 2) }} {{ __('messages.mb') }}</td>
                                <td class="pe-0" style="width:120px;">{{ number_format(($blogStorageMB / $storageLimit) * 100, 2) }}%</td>
                            </tr>
                            <tr>
                                <td class="ps-0">{{ __('messages.vcard.gallery') }}</td>
                                <td class="pe-0" style="width:120px;">{{ number_format($galleryStorageMB, 2) }} {{ __('messages.mb') }}</td>
                                <td class="pe-0" style="width:120px;">{{ number_format(($galleryStorageMB / $storageLimit) * 100, 2) }}%</td>
                            </tr>
                            <tr>
                                <td class="ps-0">{{ __('messages.profile_and_cover') }}</td>
                                <td class="pe-0" style="width:120px;">{{ number_format($profileStorageMB, 2) }} {{ __('messages.mb') }}</td>
                                <td class="pe-0" style="width:120px;">{{ number_format(($profileStorageMB / $storageLimit) * 100, 2) }}%</td>
                            </tr>
                        </table>

                    </div>
                    <!-- User Settings Details -->
                    <h5 class="card-title mt-5 mb-5">{{ __('messages.user.setting') }}</h5>
                    <div class="overflow-auto">
                        <table class="table w-100 table-borderless" style="white-space: nowrap">
                            <tr>
                                <td class="ps-0">{{ __('messages.pwa.pwa') }}</td>
                                <td class="pe-0" style="width:120px;">{{ number_format($pwaStorageMB, 2) }} {{ __('messages.mb') }}</td>
                                <td class="pe-0" style="width:120px;">{{ number_format(($pwaStorageMB / $storageLimit) * 100, 2) }}%</td>
                            </tr>
                            <tr>
                                <td class="ps-0">{{ __('messages.user.avatar') }}</td>
                                <td class="pe-0" style="width:120px;">{{ number_format($avatarStorageMB, 2) }} {{ __('messages.mb') }}</td>
                                <td class="pe-0" style="width:120px;">{{ number_format(($avatarStorageMB / $storageLimit) * 100, 2) }}%</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
