<div class="overflow-auto">
    <div class="table-striped w-100">
        <livewire:vcard-service-table lazy :vcard-id="$vcard->id"/>
    </div>
</div>
@include('vcards.services.create')
@include('vcards.services.edit')
@include('vcards.services.show')
