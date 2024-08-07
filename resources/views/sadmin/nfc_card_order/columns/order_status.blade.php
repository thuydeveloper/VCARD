<div>
    @if($row->order_status!=App\Models\NfcOrders::DELIVERED && $row->order_status!=App\Models\NfcOrders::CANCEL )
    <div class="btn-group">
        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ __('messages.nfc.'.App\Models\NfcOrders::ORDER_STATUS_ARR[$row->order_status]) }}
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item order-status" data-status={{ App\Models\NfcOrders::PENDING }}   href="javascript:">{{ __('messages.nfc.Pending') }}</a></li>
            <li><a class="dropdown-item order-status" data-status={{ App\Models\NfcOrders::READY_TO_SHIP }}  href="javascript:">{{ __('messages.nfc.Ready To Ship') }}</a></li>
            <li><a class="dropdown-item order-status" data-status={{ App\Models\NfcOrders::SHIPPED }}  href="javascript:">{{ __('messages.nfc.Shipped') }}</a></li>
            <li><a class="dropdown-item order-status" data-status={{ App\Models\NfcOrders::DELIVERED }} href="javascript:">{{ __('messages.nfc.Delivered') }}</a></li>
            <li><a class="dropdown-item order-status" data-status={{ App\Models\NfcOrders::CANCEL }} href="javascript:">{{__('messages.nfc.Cancelled')}}</a></li>
        </ul>
    @elseif($row->order_status==App\Models\NfcOrders::DELIVERED)
    <span class="badge bg-light-success">{{ __('messages.nfc.Delivered') }}</span>
    @elseif($row->order_status==App\Models\NfcOrders::CANCEL )
    <span class="badge bg-light-danger">{{__('messages.nfc.Cancelled')}}</span>
    @endif
        <input type="hidden" name="order_id" class="order_id" value="{{ $row->id }}">
    </div>
</div>

