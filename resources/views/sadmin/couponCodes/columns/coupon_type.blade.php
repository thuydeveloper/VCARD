<div>
    @php
        $couponType = collect(\App\Models\CouponCode::TYPE[$row->type])
            ->map(function ($value) {
                return trans('messages.coupon_code.' . $value);
            })
            ->implode(', ');
    @endphp
    <span class="badge {{ $row->type == 1 ? 'bg-success' : 'bg-info' }}  me-2">
        {{ $couponType }}
    </span>
</div>
