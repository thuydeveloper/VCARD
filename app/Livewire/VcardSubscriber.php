<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use App\Models\VcardEmailSubscription;


class VcardSubscriber extends LivewireTableComponent
{
    protected $model = VcardEmailSubscription::class;

    public bool $showButtonOnHeader = false;

    protected $listeners = ['refresh' => '$refresh', 'resetPageTable'];

    public $vcardId;

    public function mount($vcardId)
    {
        $this->vcardId = $vcardId;
    }


    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('email-subscriber-table');
        $this->setDefaultSort('created_at','desc');
        $this->setColumnSelectStatus(false);
        $this->setQueryStringStatus(false);
        $this->resetPage('email-subscriber-table');

    }

    public function columns(): array
    {
        return [
            Column::make("Email", "email")
                ->sortable()->searchable(),
            Column::make("Created at", "created_at")
                ->sortable(),
        ];
    }
    public function builder(): Builder
    {
         return VcardEmailSubscription::where('vcard_id','=', $this->vcardId);
    }
    public function placeholder()
    {
        return view('lazy_loading/without-listing-skelecton');
    }
}
