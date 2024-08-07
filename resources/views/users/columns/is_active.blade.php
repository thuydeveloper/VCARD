<div>
    @php
        $checked = $row->is_active === 0 ? '' : 'checked';
    @endphp
    <label
        class="form-check form-switch form-check-custom form-check-solid form-switch-sm d-flex justify-content-center cursor-pointer">
        <input type="checkbox" name="is_active" class="form-check-input user-active cursor-pointer"
            data-id="{{ $row->id }}" {{ $checked }}>
        <span class="custom-switch-indicator"></span>
    </label>
</div>
