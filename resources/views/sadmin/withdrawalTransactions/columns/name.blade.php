<div class="d-flex align-items-center">
    <a href="{{ route('users.show', $row->withdrawal->user->id)}}">
        <div class="image image-circle image-mini me-3">
            <img src="{{$row->withdrawal->user->profile_image}}" alt="user" class="user-img">
        </div>
    </a>
    <div class="d-flex flex-column">
        <a href="{{route('users.show' ,$row->withdrawal->user->id)}}"
           class="mb-1 text-decoration-none fs-6">
            {!! $row->withdrawal->user->full_name !!}
        </a>
        <span class="fs-6">{{$row->withdrawal->user->email}}</span>
    </div>
</div>
