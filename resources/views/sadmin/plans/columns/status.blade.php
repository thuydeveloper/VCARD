@php
$checked = $row->status == 0
 ? ''
 : 'checked';
@endphp
<label class="form-check form-switch form-check-custom form-check-solid form-switch-sm d-flex justify-content-center cursor-pointer">
<input type="checkbox" name="status" class="form-check-input cursor-pointer plan-status"
       data-id="{{$row->id}}" {{$checked}}>
<span class="custom-switch-indicator"></span>
</label>
