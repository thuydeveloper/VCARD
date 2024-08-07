<?php

namespace App\Livewire;

use App\Models\NfcOrders;
use App\Livewire\LivewireTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class NfcOrdersTable extends LivewireTableComponent
{

    protected $model = NfcOrders::class;
    protected $type;
    public bool $showButtonOnHeader = true;
    public string $buttonComponent = 'nfc.columns.add_button';

    protected $listeners = ['refresh' => '$refresh','changeFilter','resetPageTable'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('nfc-order-table');
        $this->setDefaultSort('created_at','desc');
        $this->setQueryStringStatus(false);
        $this->resetPage('nfc-order-table');

        $this->setThAttributes(function (Column $column) {
            if ($column->isField('id')) {
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
            Column::make(__('messages.nfc.card_type'), "card_type")
                ->sortable()->view('nfc.columns.card_type'),
            Column::make(__('messages.common.name'), "name")
                ->sortable()->searchable(),
            Column::make(__('messages.nfc.designation'), "designation")
                ->sortable()->searchable(),
            Column::make(__('messages.common.phone'), "phone")
                ->format(function ($value, $row) {
                    return '+' . $row->region_code . ' ' . $row->phone;
                }),
            Column::make(__('messages.vcard.order_at'), "created_at")
                ->sortable()->searchable()->view('nfc.columns.date'),
            Column::make(__('messages.nfc.order_status'), "order_status")
                ->view('nfc.columns.order_status'),
            Column::make(__('messages.common.action'), "id")->view('nfc.columns.action'),
        ];
    }

    public function changeFilter($type)
    {
        $this->type = $type;
        $this->setBuilder($this->builder());
    }

    public function builder(): Builder
    {
        $type = $this->type;
        $orders =  NfcOrders::with('nfcCard')->whereUserId(getLogInUser()->id);
        if($type){
            $orders->where('card_type', $type)->get();
        }
        $orders->select('nfc_orders.*', 'region_code');

        return $orders;
    }
    public function placeholder()
    {
        return view('lazy_loading.user-my-nfc-card');
    }

}
