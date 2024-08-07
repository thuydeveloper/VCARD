<div class="justify-content-center d-flex">
    <a href="javascript:void(0)" class="btn px-1 text-primary instagramembed-edit-btn fs-3" data-id="{{$row->id}}"
       title="{{__('messages.common.edit')}} ">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>

    <a href="javascript:void(0)" title="{{__('messages.common.delete')}}" data-id="{{$row->id}}"
       class="btn px-1 text-danger fs-3 instagramembed-delete-btn">
        <i class="fa-solid fa-trash"></i>
    </a>
</div>
