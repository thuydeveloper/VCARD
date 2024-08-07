<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Iframe;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class IframesTable extends LivewireTableComponent
{
    protected $model = Iframe::class;

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'vcards.iframes.add-button';

    protected $listeners = ['refresh' => '$refresh', 'resetPageTable'];

    public $vcardId;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('vcard-iframes-table');
        $this->setDefaultSort('created_at','desc');
        $this->setColumnSelectStatus(false);
        $this->setQueryStringStatus(false);
        $this->resetPage('vcard-iframes-table');

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
            Column::make(__('url'), 'url')
                ->sortable()->searchable(),
            Column::make(__('messages.common.action'), 'id')->view('vcards.iframes.action'),

        ];
    }
    public function builder(): Builder
    {
        return Iframe::whereVcardId($this->vcardId)->select('iframes.*');
    }
    public function placeholder()
    {
        return view('lazy_loading.without-filter-skelecton');
    }
}
