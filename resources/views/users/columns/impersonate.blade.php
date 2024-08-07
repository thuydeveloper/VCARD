<div>
    <div class="d-flex text-center">
        @if ($row->email_verified_at)
            <a data-turbo="false" href="javascript:void(0)" data-id="{{ $row->id }}"
                class="btn btn-sm btn-info user-impersonate">
                {{ __('messages.user.impersonate') }}
            </a>
        @else
            <a data-turbo="false" href="javascript:void(0)" data-id="{{ $row->id }}"
                style="pointer-events: none;
   cursor: default;" class="btn btn-sm btn-secondary user-impersonate">
                {{ __('messages.user.impersonate') }}
            </a>
        @endif
    </div>
</div>
