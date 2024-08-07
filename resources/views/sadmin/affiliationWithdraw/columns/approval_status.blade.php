@php
$bgColor = $row->is_approved == \App\Models\Withdrawal::APPROVED ? 'bg-success' : ($row->is_approved == \App\Models\Withdrawal::INPROCESS ? 'bg-warning' :'bg-danger');
@endphp
@php
$withdrawalStatus = collect(\App\Models\Withdrawal::APPROVAL_STATUS[$row->is_approved])->map(function ($value) {
    return trans('messages.affiliation.' . $value);
})->implode(', ');
@endphp
<span class="badge {{ $bgColor }} me-2">
{{ $withdrawalStatus }}
</span>
