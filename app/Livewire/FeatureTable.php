<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Feature;
use Illuminate\Database\Eloquent\Builder;

class FeatureTable extends LivewireTableComponent
{
    protected $model = Feature::class;

    protected $listeners = ['refresh' => '$refresh'];

    public bool $showButtonOnHeader = false;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('feature-table');
        $this->setDefaultSort('id', 'desc');
        $this->setColumnSelectStatus(false);
        $this->setFilterPillsDisabled();
        $this->setQueryStringStatus(false);
        $this->resetPage('feature-table');

        $this->setTdAttributes(function (Column $column) {
            if ($column->isField('id')) {
                return [
                    'class' => 'justify-content-center',
                ];
            }

            return [];
        });

    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.feature.name'), 'name')
                ->sortable()->searchable()->view('settings.features.columns.name'),
            Column::make(__('messages.feature.image'),'id')->view('settings.features.columns.image'),
            Column::make(__('messages.feature.description'), 'description')
                ->sortable()->searchable()->view('settings.features.columns.description'),
            Column::make(__('messages.common.action'),'id')->view('settings.features.columns.action'),

        ];
    }

    public function builder(): Builder
    {
        return Feature::query();
    }
    public function placeholder()
    {
        return view('lazy_loading.without-listing-skelecton');
    }
}
