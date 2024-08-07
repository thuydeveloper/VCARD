<?php

namespace App\Livewire;

use App\Models\VcardService;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;


class VcardServiceTable extends LivewireTableComponent
{
    protected $model = VcardService::class;

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'vcards.services.add-button';

    protected $listeners = ['refresh' => '$refresh', 'resetPageTable'];

    public $vcardId;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('service-vcard-table');
        $this->setDefaultSort('created_at','desc');
        $this->setColumnSelectStatus(false);
        $this->resetPage('service-vcard-table');

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
            Column::make(__('messages.common.icon'), 'created_at')->view('vcards.services.columns.name'),
            Column::make(__('messages.common.name'), 'name')
                ->sortable()->searchable(),
            Column::make(__('messages.common.service_url'), 'service_url'),
            Column::make(__('messages.common.action'), 'id')->view('vcards.services.columns.action'),
        ];
    }
    public function builder(): Builder
    {
        return VcardService::whereVcardId($this->vcardId)->select('vcard_services.*');
    }

    public function resetPageTable($pageName = 'service-vcard-table')
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
