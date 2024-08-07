@if ($row->status == 1)
<a href="{{ route('vcard.show', ['alias' => $row->url_alias]) }}" id="vcardUrl{{ $row->id }}"
   target="_blank" class="text-decoration-none fs-6">{{ route('vcard.show', ['alias' => $row->url_alias]) }}</a>
<button class="btn px-2 text-primary fs-2 user-edit-btn copy-clipboard"
        data-id="{{ $row->id }}" title="{{'copy'}}">
    <i class="fa-regular fa-copy fs-2"></i>
</button>
@else
<span id="vcardUrl{{$row->id}}" target="_blank"> {{ route('vcard.show', ['alias' => $row->url_alias]) }} </span>
@endif
