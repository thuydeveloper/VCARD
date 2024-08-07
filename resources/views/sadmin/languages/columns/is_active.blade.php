<div class="p-3">
    @if ($row->iso_code !== getSuperAdminSettingValue('default_language'))
        <div>
            @php
                $checked = $row->status === 0 ? '' : 'checked';
            @endphp
            <label
                class="form-check  form-switch form-check-custom form-check-solid form-switch-sm d-flex justify-content-center cursor-pointer">
                <input type="checkbox" name="is_active" class="form-check-input language-active cursor-pointer langauge-value"
                    data-id="{{ $row->id }}" {{ $checked }}>
                <span class="custom-switch-indicator"></span>
            </label>
        </div>
    @else
        <div class="text-center">
            <span class="badge bg-light-success">{{ __('messages.common.default') }}</span>
        </div>
    @endif
</div>
