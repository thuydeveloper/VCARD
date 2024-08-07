<div class="justify-content-center d-flex">
    <a href="{{ route('plans.edit', $row->id) }}" title="{{ __('messages.common.edit') }}"
        class="btn px-1 text-primary fs-3">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
    <a href="javascript:void(0)" data-id="{{ $row->id }}" title="{{ __('messages.common.delete') }}"
        class="btn px-1 text-danger fs-3 plan-delete-btn" data-turbolinks="false">
        <i class="fa-solid fa-trash"></i>
    </a>
</div>
