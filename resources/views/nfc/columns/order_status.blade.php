<div>
    @if ($row->order_status == '0')
    <span class="badge bg-info">{{ __('messages.nfc.Pending') }}</span>
@elseif ($row->order_status == '1')
    <span
        class="badge bg-warning">{{ __('messages.nfc.Ready To Ship') }}</span>
@elseif ($row->order_status == '2')
    <span class="badge bg-primary">{{ __('messages.nfc.Shipped') }}</span>
@elseif ($row->order_status == '3')
    <span class="badge bg-success">{{ __('messages.nfc.Delivered') }}</span>
@else
    <span class="badge bg-danger">{{ __('messages.nfc.Cancelled') }}</span>
@endif
</div>
