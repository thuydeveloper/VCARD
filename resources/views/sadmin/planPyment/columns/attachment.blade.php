@if($row->attachment)
<a href="{{ url('download-attachment'.'/' .$row->id) }}" target="_blank" class="text-decoration-none">Download</a>
@else
N/A
@endif
