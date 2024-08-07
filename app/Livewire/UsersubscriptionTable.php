<?php

namespace App\Livewire;

use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;


class UsersubscriptionTable extends LivewireTableComponent
{

    public function configure(): void
    {
        $this->setPageName('user-subscription-table');
        $this->setPrimaryKey('id');
        $this->setDefaultSort('created_at', 'desc');
        $this->resetPage('user-subscription-table');

        $this->setThAttributes(function (Column $column) {
            if ($column->isField('status')) {
                return [
                    'class' => 'd-flex justify-content-center',
                ];
            }
            return [];
        });

        $this->setTdAttributes(function (Column $column) {
            if ($column->isField('status')) {
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
            Column::make(__('messages.subscription.plan_name'), 'plan.name')
                ->sortable(function (Builder $query, $direction) {
                    return $query->orderBy(Plan::select('name')->whereColumn('subscriptions.plan_id', 'plans.id'),
                        $direction);
                })->searchable(),
            Column::make(__('messages.subscription.amount'), 'plan_amount')
                ->sortable(),
            Column::make(__('messages.subscription.subscribed_date'), 'starts_at')
                ->sortable(),
            Column::make(__('messages.subscription.expired_date'), 'ends_at')->sortable(),
            Column::make(__('messages.common.status'), 'status')->sortable()->view('subscription.columns.status'),

        ];
    }

    public function builder(): Builder
    {
        return Subscription::with(['plan.currency'])->where('tenant_id', getLogInTenantId())->select('subscriptions.*');
    }

}
