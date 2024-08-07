<?php

namespace App\Livewire;

use App\Models\Vcard;
use Livewire\Component;
use Livewire\WithPagination;

class VcardLists extends Component
{
    public $search;
    protected $listeners = ['refresh' => '$refresh', 'resetPageTable', 'deleteVcard'];
    protected $queryString = ['search'];

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public function placeholder(){
         return view('lazy_loading.user_vcards');
    }

    public function render()
    {
        $vcards = Vcard::with(['tenant.user', 'template'])
                      ->where('name', 'like', '%' . $this->search . '%')
                      ->where('tenant_id', getLogInTenantId())
                      ->orderBy('created_at', 'desc')
                      ->paginate(9);

        return view('livewire.vcard-lists', compact('vcards'));
    }
}
