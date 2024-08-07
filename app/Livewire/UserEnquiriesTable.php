<?php

namespace App\Livewire;

use App\Models\Enquiry;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;


class UserEnquiriesTable extends LivewireTableComponent
{
    protected $model = Enquiry::class;

    public bool $showButtonOnHeader = false;

    protected $listeners = ['refresh' => '$refresh', 'resetPageTable'];

    public $vcardId;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('enquiry-table');
        $this->setDefaultSort('created_at','desc');
        $this->setColumnSelectStatus(false);
        $this->setQueryStringStatus(false);
        $this->resetPage('enquiry-table');

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
            Column::make(__('messages.common.name'), 'name')->sortable()->searchable(),
            Column::make(__('messages.common.email'), 'email')->searchable()->sortable()->view('enquiry.columns.email'),
            Column::make(__('messages.common.phone'), 'phone')->searchable(),
            Column::make(__('messages.vcard.created_on'), 'created_at')->sortable()->searchable(),
            Column::make(__('messages.common.action'),'id')->view('enquiry.columns.action'),
        ];
    }

    public function builder(): Builder
    {
        return Enquiry::query()->where('vcard_id', '=', $this->vcardId);
    }

    public function resetPageTable($pageName = 'enquiry-table')
    {
        $rowsPropertyData = $this->getRows()->toArray();
        $prevPageNum = $rowsPropertyData['current_page'] - 1;
        $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
        $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

        $this->setPage($pageNum, $pageName);
    }
    public function placeholder()
    {
        return view('lazy_loading/without-listing-skelecton');
    }
}
