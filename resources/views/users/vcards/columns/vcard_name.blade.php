<div>
    <div class="d-flex align-items-center">
        <a href="#">
            <div class="image image-circle image-mini me-3">
                <img src="{{ empty($row->template) ? asset('assets/images/default_cover_image.jpg') : $row->template->template_url }}"
                    alt="user" class="user-img">
            </div>
        </a>
        <div class="d-flex flex-column">
            <a href="#" class="mb-1 text-decoration-none fs-6">
                {{ $row->name }}
            </a>
        </div>
    </div>  
</div>
