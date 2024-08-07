<div class="overflow-auto">
<div class="table-striped w-100">
    <livewire:vcard-testimonial-table lazy :vcard-id="$vcard->id" />
</div>
</div>
@include('vcards.testimonials.create')
@include('vcards.testimonials.edit')
@include('vcards.testimonials.show')
