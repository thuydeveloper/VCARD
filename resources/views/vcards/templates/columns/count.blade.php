@if($row->vcards)
<span class="badge badge-circle bg-info">{{$row->vcards->count()}}</span>
@else
<span>{{__('messages.common.notUsed')}}</span>
@endif
