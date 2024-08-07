<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class VcardProductTable extends LivewireTableComponent
{
    protected $model = Product::class;

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'vcards.products.add-button';

    protected $listeners = ['refresh' => '$refresh', 'resetPageTable'];

    public $vcardId;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('vcard-product-table');
        $this->setDefaultSort('created_at','desc');
        $this->setColumnSelectStatus(false);
        $this->setQueryStringStatus(false);
        $this->resetPage('vcard-product-table');

        $this->setThAttributes(function(Column $column) {
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
            Column::make(__('messages.common.icon'),'created_at')
            ->view('vcards.products.columns.icon'),
            Column::make(__('messages.common.name'), 'name')
            ->sortable()->searchable(),
            Column::make(__('messages.common.product_url'), 'product_url')
            ->view('vcards.products.columns.product-url'),
            Column::make(__('messages.plan.price'), 'price')
            ->sortable()->searchable(),
            Column::make(__('messages.common.action'),'id')->view('vcards.products.columns.action'),

        ];
    }
    public function builder(): Builder
    {
        return Product::with('currency')->whereVcardId($this->vcardId);
    }

    public function resetPageTable($pageName = 'vcard-product-table')
    {
        $rowsPropertyData = $this->getRows()->toArray();
        $prevPageNum = $rowsPropertyData['current_page'] - 1;
        $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
        $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

        $this->setPage($pageNum, $pageName);
    }
    public function placeholder()
    {
        return view('lazy_loading.without-filter-skelecton');
    }
}
