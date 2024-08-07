<?php

namespace App\Livewire;

use App\Models\ContactUs;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ContactUsTable extends LivewireTableComponent
{
    protected $model = ContactUs::class;

    protected $listeners = ['refresh' => '$refresh','resetPageTable'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('contact-us-table');
        $this->setDefaultSort('created_at', 'desc');
        $this->setEmptyMessage('messages.common.no_data_available');
        $this->setColumnSelectStatus(false);
        $this->setQueryStringDisabled();
        $this->resetPage('contact-us-table');

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
            Column::make(__('messages.common.email'), 'email')
                ->sortable()->searchable(),
            Column::make(__('messages.common.subject'), 'subject')
                ->sortable()->searchable(),
            Column::make(__('messages.common.message'), 'message')
                ->sortable(),
                Column::make(__('messages.common.action'), 'id')
                ->view('sadmin.contactus.columns.action')

        ];
    }

    public function builder(): Builder
    {
        return ContactUs::query();
    }

    public function resetPageTable($pageName = 'contact-us-table')
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
