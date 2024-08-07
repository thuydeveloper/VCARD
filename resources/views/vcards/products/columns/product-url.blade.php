@if($row->product_url != null)
<a href="{{ $row->product_url }}" id="productUrl{{ $row->id }}"
   target="_blank" class="text-decoration-none fs-6 product_url">{{ $row->product_url }}</a>
@endif
