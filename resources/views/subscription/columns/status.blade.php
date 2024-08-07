@if (\Carbon\Carbon::now() > $row->ends_at)
    <span class="badge bg-light-danger">{{ __('messages.common.expired') }}</span>
@elseif ($row->status == App\Models\Subscription::PENDING)
    <span class="badge bg-light-warning">{{ __('messages.common.pending') }}</span>
@elseif ($row->status == App\Models\Subscription::ACTIVE)
    <span class="badge bg-light-success">{{ __('messages.common.active') }}</span>
@elseif($row->status == App\Models\Subscription::REJECT)
    <span class="badge bg-light-danger">{{ __('messages.affiliation.rejected') }}</span>
@else
    <span class="badge bg-light-info">{{ __('messages.common.closed') }}</span>
@endif
