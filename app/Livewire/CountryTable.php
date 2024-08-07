<?php

namespace App\Livewire;

use App\Models\Country;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;


class CountryTable extends LivewireTableComponent
{
    protected $model = Country::class;

    public bool $showButtonOnHeader = true;

    protected $listeners = ['refresh' => '$refresh', 'resetPageTable'];

    public string $buttonComponent = 'sadmin.countries.add-button';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('country-table');
        $this->setDefaultSort('created_at', 'desc');
        $this->setColumnSelectStatus(false);
        $this->setQueryStringStatus(false);
        $this->resetPage('country-table');

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
            Column::make(__('messages.common.name'), 'name')
                ->sortable()->searchable(),
            Column::make(__('messages.country.short_code'), 'short_code')
                ->sortable()->searchable(),
            Column::make(__('messages.country.phone_code'), 'phone_code')
                ->sortable()->searchable(),
            Column::make(__('messages.common.action'), 'id')
                ->view('sadmin/countries/columns/action'),


        ];
    }

    public function builder(): Builder
    {
        return Country::query();
    }

    public function resetPageTable($pageName = 'country-table')
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
