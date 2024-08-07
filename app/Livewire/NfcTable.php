<?php

namespace App\Livewire;

use App\Models\Nfc;
use App\Livewire\LivewireTableComponent;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class NfcTable extends LivewireTableComponent
{

    public bool $showButtonOnHeader = true;
    protected $listeners = ['refresh' => '$refresh', 'resetPageTable'];
    public string $buttonComponent = 'sadmin.nfc.columns.add_button';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('nfc-table');
        $this->setDefaultSort('created_at','desc');
        $this->setQueryStringStatus(false);
        $this->resetPage('nfc-table');

        $this->setThAttributes(function (Column $column) {
            if ($column->isField('created_at')) {
                return [
                    'class' => 'text-center',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.common.name'), "name")
                ->sortable()->searchable()->view('sadmin.nfc.columns.name'),
           Column::make(__('messages.nfc.orders_count'),'id')
                ->view('sadmin.nfc.columns.count'),
           Column::make(__('messages.common.price'), "price")
                ->sortable()->view('sadmin.nfc.columns.price'),
            Column::make(__('messages.common.action'), "created_at")->view('sadmin.nfc.columns.action'),
        ];
    }
    public function builder(): Builder
    {
        return Nfc::with(['nfcOrders'])->select('nfcs.*');
    }
    public function placeholder()
    {
        return view('lazy_loading.sadmin-sell-nfc-cards');
    }
}
