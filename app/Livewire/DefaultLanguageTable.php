<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Language;
use Illuminate\Database\Eloquent\Builder;
use App\Livewire\LivewireTableComponent;

class DefaultLanguageTable extends LivewireTableComponent
{
    protected $model = Language::class;

    public bool $showButtonOnHeader = false;

    protected $listeners = ['refresh' => '$refresh', 'resetPageTable'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('language-table');
        $this->setDefaultSort('created_at','desc');
        $this->setColumnSelectStatus(false);
        $this->setSortingPillsStatus(false);
        $this->setQueryStringStatus(false);
        $this->resetPage('language-table');

        $this->setThAttributes(function (Column $column) {
            if ($column->isField('id') || $column->isField('status')) {
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
            Column::make(__('messages.common.name'), 'name')
                ->sortable()->searchable(),
            Column::make(__('messages.languages.iso_code'), 'iso_code')
                ->sortable(),
            Column::make(__('messages.common.is_active'), 'status')->view('sadmin.languages.columns.is_active'),
        ];
    }
    public function builder(): Builder
    {
        return Language::query()->select('languages.*');
    }

    public function resetPageTable($pageName = 'language-table')
    {
        $rowsPropertyData = $this->getRows()->toArray();
        $prevPageNum = $rowsPropertyData['current_page'] - 1;
        $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
        $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

        $this->setPage($pageNum, $pageName);
    }
  public function placeholder()
    {
         return view('lazy_loading.without-listing-skelecton');
    }
}
