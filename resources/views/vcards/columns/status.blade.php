<label class="form-check form-switch d-flex justify-content-center">
    <input name="is_active" data-id="{{$row->id}}" class="form-check-input vcardStatus"
           type="checkbox" value="1" {{ $row->status == 1 ? 'checked': ''}}>
</label>
