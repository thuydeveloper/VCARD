<div class="overflow-auto">
<div class="table-striped w-100">
    <livewire:vcard-product-table lazy :vcard-id="$vcard->id"/>
</div>
</div>
@include('vcards.products.create')
@include('vcards.products.edit')
@include('vcards.products.show')
