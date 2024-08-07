<div>
    @if ($row->status)
        <a id="vcardUrl{{ $row->id }}" target="_blank" class="<text-primary></text-primary>"
            href="{{ route('vcard.show', ['alias' => $row->url_alias]) }}">
            {{ route('vcard.show', ['alias' => $row->url_alias]) }} </a>
    @else
        <span id="vcardUrl{{ $row->id }}" target="_blank" class="">
            {{ route('vcard.show', ['alias' => $row->url_alias]) }} </span>
    @endif
</div>
