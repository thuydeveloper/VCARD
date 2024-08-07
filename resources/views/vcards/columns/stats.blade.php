@if (analyticsFeature())
<a href="{{ route('vcard.analytics', $row->id)}}">
    <i class="fa-solid fa-chart-line fs-2"></i>
</a>
@endif
