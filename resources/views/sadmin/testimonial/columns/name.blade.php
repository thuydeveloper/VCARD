<div class="d-flex align-items-center">
    <div class="image image-circle image-mini me-3">
        <img src="{{$row->testimonial_url}}" alt="user" class="user-img">
    </div>
    <div class="d-flex flex-column">
        <span class="fs-6">{{ \Illuminate\Support\Str::limit($row->name, 30) }}</span>
    </div>
</div>
