<?php
$defaultTemplate = asset('assets/images/default_cover_image.jpg');
?>
<div class="d-flex align-items-center">
<div class="image image-circle image-mini me-3">
    <img src="{{ empty($row->template) ? $defaultTemplate : $row->template->template_url }}" alt="Vcard">
</div>
<div class="d-flex flex-column">
    <a href="{{ route('vcards.edit', $row->id) }}" class="mb-1 text-decoration-none fs-6">
        {{ $row->name }}
    </a>
    <span class="fs-6">{{ $row->occupation }}</span>
</div>
</div>
