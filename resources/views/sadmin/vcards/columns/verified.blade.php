<div>

    @php
        $checked = $row->is_verified == 1 ? 'checked' : '';
    @endphp

    <label class="form-check form-switch justify-content-center cursor-pointer">
        <input name="is_verified" data-id="{{ $row->id }}" class="form-check-input vcards-verified cursor-pointer"
            type="checkbox" value="1" {{ $checked }}>
        <span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
    </label>

</div>
