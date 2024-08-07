<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UserTable extends LivewireTableComponent
{
protected $model = User::class;
    public bool $showButtonOnHeader = true;
    public string $buttonComponent = 'users.add-button';

    protected $listeners = ['statusFilter', 'resetPageTable'];
    protected $status;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('user-table');
        $this->setDefaultSort('created_at', 'desc');
        $this->setSortingPillsStatus(false);
        $this->setQueryStringStatus(false);
        $this->resetPage('user-table');

        $this->setThAttributes(function (Column $column) {

            if ($column->isField('first_name')) {
                return [
                    'class' => 'bg-red',
                ];
            }
            
            // if ($column->getTitle() == __('messages.subscription.current_plan')) {
            //     return [
            //         'class' => 'text-start',
            //     ];
            // }

            if ($column->isField('email_verified_at')  || $column->isField('is_active') || $column->isField('created_at')) {
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
            Column::make(__('messages.user.full_name'), 'first_name')
                ->searchable(function (Builder $query, $direction) {
                    $query->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$direction}%'");
                })->sortable()->view('users.columns.full_name'),
            Column::make(__('messages.user.full_name'), 'last_name')->sortable()->searchable()->hideIf(1),
            Column::make(
                __('messages.subscription.current_plan'),
                'id'
            )->searchable()->view('users.columns.current_plan'),
            Column::make('email','email')->hideIf(1)->searchable(),
            Column::make(__('messages.user.tenant_id'), 'tenant_id')->hideIf(1),
            Column::make(__('messages.user.email_verified'), 'email_verified_at')->view('users.columns.email_verified'),
            Column::make(__('messages.user.impersonate'), 'id')->view('users.columns.impersonate'),
            Column::make(__('messages.common.is_active'), 'is_active')->view('users.columns.is_active'),
            Column::make(__('messages.common.action'), 'created_at')->view('users.columns.action'),

        ];
    }

    public function statusFilter($status)
    {
        $this->status = $status;
        $this->setBuilder($this->builder());
    }

    public function builder(): Builder
    {
        $status = $this->status;
        $query =  User::role('admin')->with(['media', 'subscriptions.plan'])->where('users.id', '!=', getLogInUserId());

        $query->when($status != "", function ($q) use ($status) {
            if ($status == User::IS_ACTIVE) {
                $q->where('is_active', User::IS_ACTIVE);
            }
            if ($status == User::DEACTIVATE) {
                $q->where('is_active', User::DEACTIVATE);
            }
        });

        return $query->select('users.*');
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
        return view('lazy_loading.listing-skelecton');
    }
}
