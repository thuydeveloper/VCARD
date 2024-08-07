<div>
    <div class="justify-content-center d-flex">
        <a href="javascript:void(0)" title="{{ __('messages.common.edit') }}"
            class="btn px-1 text-primary fs-3 nfc-view-btn" data-id="{{$row->id}}">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
        <a href="javascript:void(0)" data-id="{{ $row->id }}" title="{{ __('messages.common.delete') }}"
            class="btn px-1 text-danger fs-3 nfc-delete-btn" data-turbolinks="false">
            <i class="fa-solid fa-trash"></i>
        </a>
    </div>
</div>
