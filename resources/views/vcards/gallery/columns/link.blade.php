@if($row->link == null && ($row->type == 0 || $row->type == 2 || $row->type == 3 || $row->type == 4))
<a href="{{$row->gallery_image}}" target="_blank">{{$row->gallery_image}}</a>
@else
<a href="{{$row->link}}" target="_blank">{{$row->link}}</a>
@endif
