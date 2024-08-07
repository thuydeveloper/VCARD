<?php

namespace App\Livewire;

use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;


class StateTable extends LivewireTableComponent
{
    protected $model = State::class;

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'sadmin.states.add-button';

    protected $listeners = ['refresh' => '$refresh', 'resetPageTable'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('state-table');
        $this->setDefaultSort('created_at', 'desc');
        $this->setColumnSelectStatus(false);
        $this->setQueryStringStatus(false);
        $this->resetPage('state-table');

        $this->setThAttributes(function (Column $column) {
            if ($column->isField('id')) {
                return [
                    'class' => 'd-flex justify-content-center',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.state.state_name'), 'name')
                ->sortable()->searchable(),
            Column::make(__('messages.state.country_name'), 'country_id')
                ->sortable(function (Builder $query, $direction) {
                    return $query->orderBy(
                        Country::select('name')->whereColumn('id', 'country_id'),
                        $direction
                    );
                })->searchable()->view('sadmin/states/columns/country_name'),
            Column::make(__('messages.common.action'), 'id')
                ->view('sadmin/states/columns/action'),
        ];
    }

    public function builder(): Builder
    {
        return State::with('country')->select('states.*');
    }

    public function resetPageTable($pageName = 'state-table')
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
