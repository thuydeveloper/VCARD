<?php

namespace App\Livewire;

use Livewire\Component;

class SadminDashboard extends Component
{
    public $activeUsersCount,$deActiveUsersCount,$activeVcard,$deActiveVcard;
    public function mount($activeUsersCount,$deActiveUsersCount,$activeVcard,$deActiveVcard){
         $this->activeUsersCount = $activeUsersCount;
         $this->deActiveUsersCount = $deActiveUsersCount;
         $this->activeVcard = $activeVcard;
         $this->deActiveVcard = $deActiveVcard;
    }
    public function placeholder(){
         return view('lazy_loading.sadmin-dashboard');
    }
    public function render()
    {
        return view('livewire.sadmin-dashboard');
    }
}
