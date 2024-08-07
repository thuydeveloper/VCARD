<div>
    <span class="badge {{ $row->is_expired ? 'bg-danger' : 'bg-secondary' }}  me-2">
        {{ getFormattedDateTime($row->expire_at)}}
    </span>
</div>
