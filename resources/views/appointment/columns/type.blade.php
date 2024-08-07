<div>
    @if ($row->appointmentTransaction && $row->appointmentTransaction->type == App\Models\Appointment::MANUALLY)
    <div class="btn-group">
        <div>
            <div class="btn-group">
                <button type="button" class="btn btn-warning text-dark dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    {{ __('Manual') }}
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item appointmentPaymentStatus" href="#" name="is_active"
                            data-tenant="{{ $row->tenant_id }}" data-id="{{ $row->id }}"
                            data-status={{ App\Models\Appointment::APPROVED }} data-turbo='false'>{{ __('messages.affiliation.approved') }}</a></li>

                    <li><a class="dropdown-item appointmentPaymentStatus" href="#" name="is_active"
                            data-tenant="{{ $row->tenant_id }}" data-id="{{ $row->id }}"
                            data-status={{ App\Models\Appointment::REJECT }} data-turbo="false">{{ __('messages.affiliation.reject') }}</a></li>
                </ul>
            </div>
        </div>
    </div>
    @endif
    @if ($row->appointmentTransaction && $row->appointmentTransaction->type == App\Models\Appointment::APPROVED)
    <span class="badge bg-success">{{__('messages.appointment.paid')  . ' ' . $row->paid_amount}}</span>

    @elseif ($row->appointmentTransaction && $row->appointmentTransaction->type == App\Models\Appointment::REJECT)
    <span class="badge bg-light-danger">{{ __('messages.affiliation.rejected') }}</span>

    @elseif($row->appointment_tran_id && $row->appointmentTransaction && $row->appointmentTransaction->type != App\Models\Appointment::MANUALLY)
    <span class="badge bg-success">{{ __('messages.appointment.paid')  . ' ' . $row->paid_amount}}</span>
    @endif
    @if(!$row->appointment_tran_id)
    <span class="badge bg-primary">{{ __('messages.appointment.free') }}</span>
    @endif
</div>


