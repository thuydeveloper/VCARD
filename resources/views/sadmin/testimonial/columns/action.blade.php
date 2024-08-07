<div class="justify-content-center d-flex">
    <a title = "{{ __('messages.common.view') }}" href="javascript:void(0)"
       data-id="{{ $row->id }}" class="btn px-1 text-info fs-3 view-testimonial-btn ">
        <i class="fa-solid fa-eye"></i>
    </a>

    <a href="javascript:void(0)" title="{{ __('messages.common.edit') }}"
        class="btn px-1 text-primary fs-3 front-testimonial-edit-btn" data-id="{{$row->id}}">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>

    <a href="javascript:void(0)" data-id="{{ $row->id }}" title="{{ __('messages.common.delete') }}"
       class="btn px-1 text-danger fs-3 front-testimonial-delete-btn">
        <i class="fa-solid fa-trash"></i>
    </a>
    </div>
