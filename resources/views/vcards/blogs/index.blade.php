<div class="overflow-auto">
<div class="table-striped w-100">
    <livewire:vcard-blog-table lazy :vcard-id="$vcard->id"/>
</div>
</div>
@include('vcards.blogs.create')
@include('vcards.blogs.edit')
@include('vcards.blogs.show')
