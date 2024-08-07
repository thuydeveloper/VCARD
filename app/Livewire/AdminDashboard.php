<?php

namespace App\Livewire;

use Livewire\Component;

class AdminDashboard extends Component
{
    public $enquiry,$appointment,$activeVcard,$deActiveVcard;
    public function mount($enquiry,$appointment,$activeVcard,$deActiveVcard){
         $this->enquiry = $enquiry;
         $this->appointment = $appointment;
         $this->activeVcard = $activeVcard;
         $this->deActiveVcard = $deActiveVcard;
    }
    public function placeholder(){
         return view('lazy_loading.admin-dashboard');
    }
    public function render()
    {
        return view('livewire.admin-dashboard');
    }
}
