@if($row->nfcOrders)
<span class="badge badge-circle bg-info">{{$row->nfcOrders->count()}}</span>
@else
<span>{{__('messages.common.notUsed')}}</span>
@endif


