<div>
@php
    $paymentType = collect(\App\Models\WithdrawalTransaction::PAID_BY[$row->paid_by])->map(function ($value) {

    return trans('messages.affiliation.' . $value);
})->implode(', ');
@endphp
    <span class="badge bg-primary me-2">
        {{ $paymentType }}
    </span>
</div>
