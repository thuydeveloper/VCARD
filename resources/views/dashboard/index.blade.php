@extends('layouts.app')
@section('title')
    {{ __('messages.dashboard') }}
@endsection
@section('content')
    @role('super_admin')
        <div class="container-fluid">
            <div class="d-flex flex-column">
                <div class="row">
                    <livewire:sadmin-dashboard lazy :activeUsersCount="$activeUsersCount" :deActiveUsersCount="$deActiveUsersCount" :activeVcard="$activeVcard" :deActiveVcard="$deActiveVcard" />
                    {{-- Plan By User --}}
                    <div class="col-xxl-4 col-12 mb-7 mb-xxl-0">
                        <div class="card">
                            <div class="card-header pb-0 px-10">
                                <h3 class="mb-0">{{ __('messages.sadmin_dashboard.plans_by_users') }}</h3>
                            </div>
                            <div class="card-body">
                                <canvas id="dashboardPlanPieChart"></canvas>
                            </div>
                        </div>
                    </div>

                    {{-- Income Chart --}}
                    <div class="col-xxl-8 col-12 mb-7 mb-xxl-0">
                        <div class="card">
                            <div class="card-header pb-0 px-10">
                                <h3 class="mb-0">{{ __('messages.sadmin_dashboard.income') }}</h3>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-icon btn-outline-primary me-5" title="Switch Chart">
                                        <span class="svg-icon svg-icon-1 m-0 text-center" id="dashboardChangeIncomeChart">
                                            <i class="fa-solid fa-chart-line income-chart"></i>
                                        </span>
                                    </button>
                                    <div id="dashboardIncomeTimeRange"
                                        class="time_range
                        btn btn-outline-primary align-items-center">
                                        <i class="far fa-calendar-alt" aria-hidden="true"></i>
                                        &nbsp;&nbsp<span></span> <b class="caret"></b>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 mx-6">
                                <div id="incomeChartCanvas">
                                    <canvas id="dashboardIncomeChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- Register user table --}}
                    <div class="col-12 mt-7">
                        <div class="d-flex">
                            <h3 class="card-title align-items-start flex-column">
                                <span
                                    class="fw-bolder fs-3 mb-1">{{ __('messages.sadmin_dashboard.recent_users_registration') }}</span>
                            </h3>
                            <div class="card-toolbar ms-auto">
                                <ul class="nav nav-tabs mb-5 pb-1 overflow-auto flex-nowrap text-nowrap" id="overview-tab"
                                    role="tablist">
                                    <li class="nav-item position-relative me-7 mb-3" role="presentation">
                                        <button class="nav-link active p-0" id="dayData" data-bs-toggle="tab"
                                            data-bs-target="#overview" type="button" role="tab" aria-controls="overview"
                                            aria-selected="true">
                                            {{ __('messages.sadmin_dashboard.day') }}
                                        </button>
                                    </li>
                                    <li class="nav-item position-relative me-7 mb-3" role="presentation">
                                        <button class="nav-link p-0" id="weekData" data-bs-toggle="tab"
                                            data-bs-target="#vcards" type="button" role="tab" aria-controls="cases"
                                            aria-selected="false">
                                            {{ __('messages.sadmin_dashboard.week') }}
                                        </button>
                                    </li>
                                    <li class="nav-item position-relative me-7 mb-3" role="presentation">
                                        <button class="nav-link p-0" id="monthData" data-bs-toggle="tab"
                                            data-bs-target="#vcards" type="button" role="tab" aria-controls="cases"
                                            aria-selected="false">
                                            {{ __('messages.sadmin_dashboard.month') }}
                                        </button>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <div class="pb-2">
                            <div class="tab-content">
                                <div class="tab-pane fade active" id="month">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('messages.sadmin_dashboard.name') }}</th>
                                                    <th>{{ __('messages.sadmin_dashboard.email') }}</th>
                                                    <th class="text-nowrap">{{ __('messages.sadmin_dashboard.contact') }}</th>
                                                    <th class="text-nowrap">{{ __('messages.sadmin_dashboard.registered_on') }}
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="monthlyReport" class="text-gray-600 fw-bold">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="week">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('messages.sadmin_dashboard.name') }}</th>
                                                    <th>{{ __('messages.sadmin_dashboard.email') }}</th>
                                                    <th class="text-nowrap">{{ __('messages.sadmin_dashboard.contact') }}</th>
                                                    <th class="text-nowrap">{{ __('messages.sadmin_dashboard.registered_on') }}
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="weeklyReport" class="text-gray-600 fw-bold">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="day">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('messages.sadmin_dashboard.name') }}</th>
                                                    <th>{{ __('messages.sadmin_dashboard.email') }}</th>
                                                    <th class="text-nowrap">{{ __('messages.sadmin_dashboard.contact') }}</th>
                                                    <th class="text-nowrap">{{ __('messages.sadmin_dashboard.registered_on') }}
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="dailyReport" class="text-gray-600 fw-bold">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endrole

    @role('admin')
        <div class="container-fluid">
            <div class="d-flex flex-column">
                <div class="row">
                    <livewire:admin-dashboard lazy :enquiry="$enquiry" :appointment="$appointment" :activeVcard="$activeVcard" :deActiveVcard="$deActiveVcard" />

                    {{-- Vcard Analytic --}}
                    <div class="col-12 mb-4">
                        <div class="card analytics-chart">
                            <div class="card-header pb-0 px-10">
                                <h3 class="mb-0">{{ __('messages.analytic.vcard_analytic') }}</h3>
                                <div class="ms-auto">
                                    <button type="button" class="btn btn-icon btn-outline-primary me-5"
                                        title="Switch Chart">
                                        <span class="svg-icon svg-icon-1 m-0 text-center" id="dashboardChangeChart">
                                            <i class="fa-solid fa-chart-line chart"></i>
                                        </span>
                                    </button>

                                </div>
                                <div id="dashboardTimeRange"
                                    class="time_range
                                    btn btn-outline-primary align-items-center">
                                    <i class="far fa-calendar-alt" aria-hidden="true"></i>
                                    &nbsp;&nbsp<span></span> <b class="caret"></b>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <div id="dashboardWeeklyUserBarChartContainer">
                                        <canvas id="dashboardWeeklyUserBarChart" height="200" width="905"
                                            style="display: block; width: 905px; height: 200px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Today Appointment --}}
                    <div class="col-12">
                        <div class="mt-3 mb-5">
                            <h3>{{ __('messages.common.today_appointments') }}</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap">{{ __('messages.vcard.vcard_name') }}</th>
                                        <th>{{ __('messages.common.name') }}</th>
                                        <th>{{ __('messages.common.phone') }}</th>
                                        <th>{{ __('messages.common.email') }}</th>
                                    </tr>
                                </thead>
                                <tbody id="appointmentReport">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endrole

    @include('dashboard.templates.templates')
    @include('dashboard.templates.userTemplate')
@endsection
