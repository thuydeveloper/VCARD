<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" id="planStatus" name="is_active"
           {{ $row->status == 1 ? 'disabled checked' : ''}} data-id="{{$row->id}}"
           data-tenant="{{$row->tenant_id}}">
</div>
