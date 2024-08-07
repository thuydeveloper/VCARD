<?php

namespace App\Livewire;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Builder;
use App\Livewire\LivewireTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PlanTable extends LivewireTableComponent
{
    protected $model = Plan::class;

    public bool $showButtonOnHeader = true;
    protected $listeners = ['refresh' => '$refresh', 'resetPageTable'];

    public string $buttonComponent = 'sadmin.plans.add-button';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('plan-table');
        $this->setDefaultSort('created_at','desc');
        $this->setColumnSelectStatus(false);
        $this->setQueryStringStatus(false);
        $this->resetPage('plan-table');

        $this->setThAttributes(function (Column $column) {
            if ($column->isField('status')) {
              return [
                'class' => 'd-flex justify-content-center',
              ];
            }

            return [
                'class' => 'text-center',
            ];
        });
    }
    public function columns(): array
    {
        return [
            Column::make(__('messages.common.name'), 'name')
                ->sortable()->searchable(),
            Column::make(__('messages.plan.price'), 'price')
                ->sortable()->searchable()
                ->view('sadmin/plans/columns/price'),
            Column::make(__('messages.plan.status'), 'status')
                ->sortable()
                ->view('sadmin/plans/columns/status'),
            Column::make(__('messages.plan.duration'), 'frequency')
                ->sortable()->searchable()
                ->view('sadmin/plans/columns/duration'),
            Column::make(__('messages.plan.make_default'), 'is_default')
                ->sortable()
                ->view('sadmin/plans/columns/is_default'),
            Column::make(__('messages.common.action'), 'id')
                ->view('sadmin/plans/columns/action'),

        ];
    }

    public function builder(): Builder
    {
        return Plan::with(['currency', 'planFeature', 'planCustomFields'])->select('plans.*');
    }

    public function resetPageTable($pageName = 'plan-table')
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
