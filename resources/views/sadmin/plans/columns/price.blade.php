@if ($row->custom_select == 1)
    {{ $row->planCustomFields[0]->custom_vcard_price }}
@else
    <div>
        {{ $row->price }}
    </div>
@endif
