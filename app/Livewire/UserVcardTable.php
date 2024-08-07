<?php

namespace App\Livewire;

use App\Models\Vcard;
use Illuminate\Database\Eloquent\Builder;
use App\Livewire\LivewireTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UserVcardTable extends LivewireTableComponent
{
    protected $model = Vcard::class;
    public $selectedRecordId;

    public bool $showButtonOnHeader = true;

    protected $listeners = ['refresh' => '$refresh', 'resetPageTable', 'deleteVcard'];

    public string $buttonComponent = 'vcards.add-button';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('user-vcard-table');
        $this->setDefaultSort('created_at', 'desc');
        $this->setColumnSelectStatus(false);
        $this->setQueryStringStatus(false);
        $this->resetPage('user-vcard-table');

        $this->setThAttributes(function(Column $column) {
            if ($column->isField('updated_at')) {
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
            Column::make(__('messages.vcard.vcard_name'), 'name')
                ->sortable()->searchable()
                ->view('vcards.columns.name'),
            Column::make(__('messages.vcard.preview_url'), 'id')->view('vcards.columns.preview'),
            Column::make(__('messages.vcard.preview_url'), 'url_alias')
                ->hideIf('url_alias')
                ->searchable(),

            analyticsFeature() ?
            Column::make(__('messages.vcard.stats'), 'created_at')->view('vcards.columns.stats')
            : null,
            Column::make(__('messages.vcard.subsribers'), 'created_at')->view('vcards.columns.subscribers'),
            Column::make(__('messages.vcard.status'), 'id')
                ->sortable()
                ->view('vcards.columns.status'),
            Column::make(__('messages.vcard.created_at'), 'created_at')->sortable()->view('vcards.columns.created_at'),
            Column::make(__('messages.common.action'), 'updated_at')
                ->view('vcards.columns.action'),

        ];
    }

    public function builder(): Builder
    {
        return Vcard::with(['tenant.user', 'template'])->where('tenant_id', getLogInTenantId())->select('vcards.*');
    }

    public function resetPageTable($pageName = 'user-vcard-table')
    {
        $rowsPropertyData = $this->getRows()->toArray();
        $prevPageNum = $rowsPropertyData['current_page'] - 1;
        $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
        $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

        $this->setPage($pageNum, $pageName);
    }

    public array $bulkActions = [
        'bulkDelete' => 'Delete',
    ];
    public function setSelectedRecord($recordId)
{
    $this->selectedRecordId = $recordId;
}
    public function bulkDelete()
    {
        if (count($this->getSelected()) > 0) {
            $vcardIds = $this->getSelected();
            $this->dispatch('bulk-delete-vcard', $vcardIds);
        } else {
            $this->dispatch('bulk-delete-error');
        }
    }
    public function deleteVcard($vcardIds)
    {
            Vcard::whereIn('id', $vcardIds)->delete();
            $this->setBuilder($this->builder());
            $this->dispatch('delete-vcard-success');
            $this->clearSelected();
    }

    public function updatedSelected():void
    {
        $this->selectAll = count($this->selected) === Vcard::with(['tenant.user', 'template'])->where('tenant_id', getLogInTenantId())->select('vcards.*')->count();
    }
    public function placeholder()
    {
        return view('lazy_loading.without-filter-skelecton');
    }

}
