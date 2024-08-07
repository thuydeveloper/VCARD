<?php

namespace App\Livewire;

use App\Models\Plan;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CashPaymentTable extends LivewireTableComponent
{
    protected $model = Subscription::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('cash-payment-table');
        $this->setDefaultSort('created_at', 'desc');
        $this->setColumnSelectStatus(false);
        $this->setQueryStringStatus(false);
        $this->resetPage('cash-payment-table');

        $this->setTdAttributes(function (Column $column) {
            if ($column->isField('status')) {
                return [
                    'class' => 'text-center',
                ];
            }
            return [];
        });

        $this->setThAttributes(function (Column $column) {
            if ($column->isField('status')) {
                return [
                    'class' => 'text-center',
                ];
            }
            if ($column->isField('plan_amount')) {
                return [
                    'class' => 'plan-amount',
                ];
            }

            if ($column->isField('payable_amount')) {
                return [
                    'class' => 'plan-amount px-10',
                ];
            }

            if ($column->isField('starts_at')) {
                return [
                    'class' => 'date-align',
                ];
            }

            if ($column->isField('ends_at')) {
                return [
                    'class' => 'date-align',
                ];
            }

            if ($column->isField('status')) {
                return [
                    'class' => 'text-center',
                ];
            }

            if ($column->isField('status')) {
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
            Column::make(__('messages.vcard.user_name'), 'tenant.user.first_name')
                ->searchable(function (Builder $query, $value) {
                    return $query->whereHas('tenant.user', function ($q) use ($value) {
                        $q->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$value}%'");
                    });
                })->sortable(function (Builder $query, $direction) {
                    return $query->orderBy(
                        User::select('first_name')
                            ->whereColumn('subscriptions.tenant_id', 'users.tenant_id'),
                        $direction
                    );
                }),
            Column::make(__('messages.subscription.plan_name'), 'plan.name')
                ->searchable()
                ->sortable(function (Builder $query, $direction) {
                    return $query->orderBy(
                        Plan::select('name')
                            ->whereColumn('subscriptions.plan_id', 'plans.id'),
                        $direction
                    );
                }),
            Column::make(__('messages.subscription.plan_price'), 'plan_amount')
                ->sortable()->view('sadmin.planPyment.columns.plan_price'),
            Column::make(__('messages.subscription.payable_amount'), 'payable_amount')
                ->sortable()->view('sadmin.planPyment.columns.payable_amount'),
            Column::make(__('messages.subscription.start_date'), 'starts_at')
                ->sortable()->view('sadmin.planPyment.columns.start_date'),
            Column::make(__('messages.subscription.end_date'), 'ends_at')
                ->sortable()->view('sadmin.planPyment.columns.end_date'),
            Column::make('Attachment', 'id')->view('sadmin.planPyment.columns.attachment'),
            Column::make('Notes', 'notes')->view('sadmin.planPyment.columns.notes'),
            Column::make(__('messages.common.status'), 'status')->view('sadmin.planPyment.columns.status'),
            Column::make('payment_type','payment_type')->hideIf(1),
            Column::make('tenant_id','tenant_id')->hideIf(1),
            Column::make('created_at','created_at')->hideIf(1),
        ];
    }
    public function builder(): Builder
    {
        return Subscription::with(['tenant.user', 'plan.currency'])->whereNotNull('payment_type')->select('subscriptions.*');
    }
    public function placeholder()
    {
        return view('lazy_loading.without-listing-skelecton');
    }
}
