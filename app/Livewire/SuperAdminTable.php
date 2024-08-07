<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;


class SuperAdminTable extends LivewireTableComponent
{
    protected $model = User::class;
    public bool $showButtonOnHeader = true;
    public string $buttonComponent = 'admin_users.add-button';
    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPageTable'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('user-table');
        $this->setDefaultSort('created_at', 'desc');
        $this->setColumnSelectStatus(false);
        $this->setQueryStringStatus(false);
        $this->resetPage('user-table');

        $this->setThAttributes(function (Column $column) {
            if ($column->isField('email_verified')) {
                return [
                    'class' => 'd-flex justify-content-center',
                ];
            }

            return [
                'class' => 'text-center',
            ];
        });
    }
    public function columns(): array
    {
        return [
            Column::make(__('messages.common.name'), 'first_name')->sortable()
                ->searchable(function (Builder $query, $direction) {
                    $query->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$direction}%'");
                })->view('admin_users.columns.name'),
            Column::make(__('messages.user.full_name'), 'last_name')->sortable()->searchable()->hideIf(1),
            Column::make(__('messages.user.email_verified'), 'id')
                ->view('admin_users.columns.email_verified'),
            Column::make(__('messages.common.is_active'), 'id')
                ->view('admin_users.columns.is_active'),
            Column::make(__('messages.common.action'), 'id')
                ->view('admin_users.columns.action'),
            Column::make('email','email')->hideIf(1)->searchable(),
            Column::make('email_verified_at','email_verified_at')->hideIf(1),
        ];
    }

    public function builder(): Builder
    {
        return User::role('super_admin')->with(['media', 'subscriptions.plan'])->where('id', '!=', getLogInUserId());
    }

    public function resetPageTable($pageName = 'user-table')
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
