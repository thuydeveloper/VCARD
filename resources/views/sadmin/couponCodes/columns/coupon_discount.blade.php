<div>
    {{ $row->discount }}{{ $row->type == \App\Models\CouponCode::PERCENTAGE_TYPE ? '%' : '' }}
</div>
