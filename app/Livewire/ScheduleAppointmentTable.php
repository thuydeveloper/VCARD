<?php

namespace App\Livewire;

use App\Models\Vcard;
use App\Models\ScheduleAppointment;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\Builder;
use App\Livewire\LivewireTableComponent;
use Illuminate\Support\Facades\Log;
use Rappasoft\LaravelLivewireTables\Views\Column;


class ScheduleAppointmentTable extends LivewireTableComponent
{
    protected $model = ScheduleAppointment::class;

    protected $type;
    protected $status;

    public bool $showButtonOnHeader = true;

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'changeFilterStatus', 'resetPageTable'];

    public string $buttonComponent = 'appointment.calander-button';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('appointment-table');
        $this->setDefaultSort('id', 'desc');
        $this->setSortingPillsStatus(false);
        $this->setColumnSelectStatus(false);
        $this->setQueryStringStatus(false);
        $this->resetPage('appointment-table');
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.vcard.vcard_name'), 'vcard.name')
                ->sortable(function (Builder $query, $direction) {
                    return $query->orderBy(Vcard::select('name')->whereColumn('id', 'vcard_id'),
                        $direction);
                })->searchable(),
            Column::make(__('messages.common.name'), 'name')
                ->sortable()->searchable(),
            Column::make(__('messages.common.email'), 'email')
                ->sortable()->searchable(),
            Column::make(__('messages.common.phone'), 'phone')
                ->sortable()->searchable()->view('appointment.columns.phone'),
            Column::make(__('messages.mail.appointment_time'), 'date')
                ->sortable()->searchable()->view('appointment.columns.appointment_time'),
            Column::make(__('messages.common.status'), 'status')
                ->sortable()->view('appointment.columns.status'),
            Column::make(__('messages.common.type'), 'id')->view('appointment.columns.type'),
            Column::make(__('messages.common.action'), 'id')->view('appointment.columns.action'),
            Column::make('tran_id','appointment_tran_id')->hideIf(1),
            Column::make('from','from_time')->hideIf(1),
            Column::make('to','to_time')->hideIf(1)
        ];
    }

    public function changeFilter($type)
    {
        $this->type = $type;
        $this->setBuilder($this->builder());
    }

    public function changeFilterStatus($status)
    {
        $this->status = $status;
        $this->setBuilder($this->builder());
    }

    public function builder(): Builder
    {
        $type = $this->type;
        $status = $this->status;
        $vcardIds = Vcard::whereTenantId(getLogInTenantId())->pluck('id')->toArray();

        $scheduleAppointments = ScheduleAppointment::with('vcard','appointmentTransaction')->whereIn('vcard_id', $vcardIds)->select('schedule_appointments.*');

            $scheduleAppointments->when($type != "", function ($q) use ($type) {
                if ($type == ScheduleAppointment::PAID) {
                    $q->whereNotNull('appointment_tran_id');
                }
                if ($type == ScheduleAppointment::FREE) {
                    $q->whereNull('appointment_tran_id');
                }
            });

            $scheduleAppointments->when($status != "", function ($q) use ($status) {
                if ($status == ScheduleAppointment::COMPLETED) {
                    $q->where('schedule_appointments.status', ScheduleAppointment::COMPLETED);
                }
                if ($status == ScheduleAppointment::PENDING) {
                    $q->where('schedule_appointments.status',ScheduleAppointment::PENDING);
                }
            });

        return $scheduleAppointments;
    }

    public function resetPageTable($pageName = 'appointment-table')
    {
        $rowsPropertyData = $this->getRows()->toArray();
        $prevPageNum = $rowsPropertyData['current_page'] - 1;
        $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
        $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

        $this->setPage($pageNum, $pageName);
    }
     public function placeholder()
    {
        return view('lazy_loading.user-appoiments');
    }

}
