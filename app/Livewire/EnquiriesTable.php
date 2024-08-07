<?php

namespace App\Livewire;

use App\Models\Enquiry;
use App\Models\Vcard;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class EnquiriesTable extends LivewireTableComponent
{
    protected $model = Enquiry::class;

    public bool $showButtonOnHeader = false;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('enquiries-table');
        $this->setDefaultSort('created_at', 'desc');
        $this->setColumnSelectStatus(false);
        $this->setQueryStringStatus(false);
        $this->resetPage('enquiries-table');

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
            Column::make(__('messages.vcard.vcard_name'), 'vcard.name')->searchable()->sortable(function (
                Builder $query,
                $direction
            ) {
                return $query->orderBy(
                    vcard::select('name')->whereColumn('vcards.id', 'enquiries.vcard_id'),
                    $direction
                );
            }),
            Column::make(__('messages.common.name'), 'name')->sortable()->searchable(),
            Column::make(__('messages.common.email'), 'email')->searchable()->sortable()->view('enquiry.columns.email'),
            Column::make(__('messages.common.phone'), 'phone')->searchable(),
            Column::make(__('messages.vcard.created_on'), 'created_at')->sortable()->searchable()->view('enquiry.columns.date'),
            Column::make(__('messages.common.action'), 'id')->view('enquiry.columns.action'),

        ];
    }

    public function builder(): Builder
    {
        $vcardIds = Vcard::whereTenantId(getLogInTenantId())->pluck('id')->toArray();

        return Enquiry::with('vcard')->whereIn('vcard_id', $vcardIds);
    }
    public function placeholder()
    {
        return view('lazy_loading.without-listing-skelecton');
    }
}
