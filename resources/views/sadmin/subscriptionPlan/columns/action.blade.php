<div class="justify-content-center d-flex">
    <a title="{{ __('messages.common.view') }}" href="javascript:void(0)"
       data-id="{{ $row->id }}" class="btn px-1 text-info fs-3 subscribed-user-plan-view-btn">
        <i class="fa-solid fa-eye"></i>
    </a>
    <a title="{{ __('messages.common.edit') }}" class="btn px-1 text-primary fs-3 subscribed-user-plan-edit-btn"
       data-id="{{$row->id}}" data-turbolinks="false">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
</div>
