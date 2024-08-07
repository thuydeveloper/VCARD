<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Vcard;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class UserShowVCardTable extends LivewireTableComponent
{
    protected $model = Vcard::class;
    public $userId;
    public function configure(): void
    {
        $this->setPageName('user-vcard-table');
        $this->setPrimaryKey('id');
        $this->setDefaultSort('created_at', 'desc');
        $this->resetPage('user-vcard-table');

        $this->setThAttributes(function (Column $column) {
            if ($column->getField() == 'status') {
                return [
                    'class' => 'text-center',
                ];
            }

            return [];
        });

        $this->setTdAttributes(function (Column $column) {
            if ($column->getField() == 'status') {
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
            Column::make(__('messages.vcard.vcard_name'), 'name')->sortable()->searchable()->view('users.vcards.columns.vcard_name'),
            Column::make(__('messages.vcard.occupation'), 'occupation')->sortable()->searchable()->view('users.vcards.columns.occupation'),
            Column::make(__('messages.vcard.preview_url'), 'url_alias')->view('users.vcards.columns.preview_url'),
            Column::make(__('messages.vcard.status'), 'status')->view('users.vcards.columns.status'),
        ];
    }

    public function builder(): Builder
    {
        $tenantId = User::where('id', $this->userId)->first()->tenant_id;

        return Vcard::where('tenant_id', $tenantId)->select('vcards.*');
    }

}
