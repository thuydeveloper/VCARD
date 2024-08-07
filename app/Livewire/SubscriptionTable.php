<?php

namespace App\Livewire;

use App\Models\Plan;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class SubscriptionTable extends LivewireTableComponent
{
    protected $model = Subscription::class;

    public function configure(): void
    {
        $this->setPrimaryKey('subscription_id');
        $this->setPageName('subscription-table');
        $this->setDefaultSort('id', 'desc');
        $this->setColumnSelectStatus(false);
        $this->setQueryStringStatus(false);
        $this->resetPage('subscription-table');

        $this->setTdAttributes(function (Column $column) {
            if ($column->isField('id')) {
                return [
                    'class' => 'justify-content-center d-flex',
                ];
            }
            return [];
        });

        $this->setThAttributes(function (Column $column) {
            if ($column->isField('id')) {
                return [
                    'class' => 'justify-content-center d-flex',
                ];
            }
            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.vcard.user_name'), 'tenant.user.first_name')
                ->sortable(function (Builder $query, $direction) {
                    return $query->orderBy(
                        User::select('first_name')->whereColumn('subscriptions.tenant_id', 'users.tenant_id'),
                        $direction
                    );
                })->searchable(
                    function (Builder $query, $direction) {
                        return $query->whereHas('tenant.user', function (Builder $q) use ($direction) {
                            $q->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$direction}%'");
                        });
                    }
                )->view('sadmin.subscriptionPlan.columns.user_name'),
            Column::make(__('messages.vcard.user_name'), 'tenant.user.last_name')
                ->sortable(function (Builder $query, $direction) {
                    return $query->orderBy(
                        User::select('first_name')->whereColumn('subscriptions.tenant_id', 'users.tenant_id'),
                        $direction
                    );
                })->searchable()->hideIf(1)->view('sadmin.subscriptionPlan.columns.user_name'),
            Column::make(__('messages.subscription.plan_name'), 'plan.name')
                ->sortable(function (Builder $query, $direction) {
                    return $query->orderBy(
                        Plan::select('name')->whereColumn('id', 'plan_id'),
                        $direction
                    );
                })->searchable()->view('sadmin.subscriptionPlan.columns.plan_name'),
            Column::make(__('messages.subscription.start_date'), 'starts_at')
                ->sortable()->view('sadmin.subscriptionPlan.columns.start_date'),
            Column::make(__('messages.subscription.end_date'), 'ends_at')
                ->sortable()->view('sadmin.subscriptionPlan.columns.end_date'),
            Column::make(__('messages.common.status'), 'status')->view('sadmin.subscriptionPlan.columns.status'),
            Column::make(__('messages.common.action'), 'id')->view('sadmin.subscriptionPlan.columns.action'),
            Column::make('plan_id', 'plan_id')->hideIf(1),
            Column::make('tenant_id', 'tenant_id')->hideIf(1)
        ];
    }

    public function builder(): Builder
    {
        return Subscription::with(['tenant.user', 'plan.currency'])->where(
            'subscriptions.status',
            Subscription::ACTIVE
        );
    }
    public function placeholder()
    {
        return view('lazy_loading.without-listing-skelecton');
    }

}
