<div>
    <div class="badge bg-primary">
        <div class="mb-2">
            {{ getUserSettingValue('time_format', getLogInUserId()) == 1 ? date('H:i', strtotime($row->from_time)) . ' - ' . date('H:i', strtotime($row->to_time)) : date('h:i A', strtotime($row->from_time)) . ' - ' . date('h:i A', strtotime($row->to_time)) }}
        </div>
        <div class="">{{ getFormattedDateTime($row->date)}}

        </div>
    </div>
</div>
