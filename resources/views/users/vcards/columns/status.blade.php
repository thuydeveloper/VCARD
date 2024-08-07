<div>
    @if ($row->status == 1)
        <span class="badge bg-success">{{ __('messages.common.active') }}</span>
    @else
        <span class="badge bg-danger">{{ __('messages.deactivate') }}</span>
    @endif
</div>
