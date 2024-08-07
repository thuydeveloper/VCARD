<?php

namespace App\Livewire;

use App\Models\Language;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class LanguageTable extends LivewireTableComponent
{
    protected $model = Language::class;

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'sadmin.languages.add-button';

    protected $listeners = ['refresh' => '$refresh', 'resetPageTable'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('language-table');
        $this->setDefaultSort('created_at','desc');
        $this->setColumnSelectStatus(false);
        $this->setQueryStringStatus(false);
        $this->resetPage('language-table');

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
            Column::make(__('messages.common.name'), 'name')
                ->sortable()->searchable(),
            Column::make(__('messages.languages.iso_code'), 'iso_code')
                ->sortable()->searchable(),
            Column::make(__('messages.languages.translation'), 'created_at')
                ->view('sadmin.languages.columns.edit_translation'),
            Column::make(__('messages.common.action'), 'id')
                ->view('sadmin.languages.columns.action'),

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
}
