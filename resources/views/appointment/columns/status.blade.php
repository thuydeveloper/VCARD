<div>
    @if ($row->status == \App\Models\ScheduleAppointment::COMPLETED)
        <span class="badge bg-success">{{ __('messages.common.completed') }}</span>
    @else
        <a href="javascript:void(0)" data-id="{{ $row->id }}" class="completed-appointment" data-turbolinks="false">
            <span class="badge bg-warning ">{{ __('messages.common.pending') }} <i class="fa fa-check"
                    aria-hidden="true"></i> </span>
        </a>
    @endif
</div>
