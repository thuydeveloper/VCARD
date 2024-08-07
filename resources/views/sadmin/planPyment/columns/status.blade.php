@if ($row->status == App\Models\Subscription::PENDING)
    <div class="btn-group">
        <div>
            <div class="btn-group">
                <button type="button" class="btn btn-warning text-dark dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    {{ __('messages.common.pending') }}
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item subscriptionPlanStatus" href="#" name="is_active"
                            data-tenant="{{ $row->tenant_id }}" data-id="{{ $row->id }}"
                            data-status={{ App\Models\Subscription::ACTIVE }}>{{ __('messages.affiliation.approved') }}</a></li>

                    <li><a class="dropdown-item subscriptionPlanStatus" href="#" name="is_active"
                            data-tenant="{{ $row->tenant_id }}" data-id="{{ $row->id }}"
                            data-status={{ App\Models\Subscription::REJECT }}>{{ __('messages.affiliation.reject') }}</a></li>
                </ul>
            </div>
        </div>
    </div>
@elseif ($row->status == App\Models\Subscription::REJECT)
    <span class="badge bg-light-danger">{{ __('messages.affiliation.rejected') }}</span>
@else
    <span class="badge bg-light-success">{{ __('messages.affiliation.approved') }}</span>
@endif
