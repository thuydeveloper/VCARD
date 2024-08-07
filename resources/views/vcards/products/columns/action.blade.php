<div class="justify-content-center d-flex">
    <a title="{{__('messages.common.view')}}" class="btn px-1 text-info product-view-btn fs-3" href="javascript:void(0)"
       data-id="{{$row->id}}">
        <i class="fa-solid fa-eye"></i>
    </a>

    <a href="javascript:void(0)" class="btn px-1 text-primary product-edit-btn fs-3"
       data-id="{{$row->id}}" title="{{__('messages.common.edit')}}">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>

    <a href="#" title="<?php echo __('messages.common.delete'); ?>" data-id="{{$row->id}}"
       class="product-delete-btn btn px-1 text-danger fs-3" data-turbo="false">
        <i class="fa-solid fa-trash"></i>
    </a>
    </div>
