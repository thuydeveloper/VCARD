@if(!isAdmin())
	<div class="d-flex align-items-center">
		<a href="{{ !isAdmin() ? route('users.show', $row->affiliated_by_user->id) : 'javascript:void(0)' }}">
			<div class="image image-circle image-mini me-3">
				<img src="{{$row->affiliated_by_user->profile_image}}" alt="user" class="user-img">
			</div>
		</a>
		<div class="d-flex flex-column">
			<a href="{{ !isAdmin() ? route('users.show', $row->affiliated_by_user->id) : 'javascript:void(0)' }}"
			   class="mb-1 text-decoration-none fs-6">
				{!! $row->affiliated_by_user->full_name !!}
			</a>
			<span class="fs-6">{{$row->affiliated_by_user->email}}</span>
		</div>
	</div>
@endif
