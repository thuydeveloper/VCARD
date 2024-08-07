<div>
    @php
        $checked = $row->email_verified_at == null ? '' : 'checked disabled';
    @endphp

    <label class="form-check form-switch d-flex justify-content-center cursor-pointer">
        <input name="email_verified" data-id="{{ $row->id }}" class="form-check-input user-is-verified cursor-pointer"
            type="checkbox" value="1" {{ $checked }}>
        <span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
    </label>

</div>
