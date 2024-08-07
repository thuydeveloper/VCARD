<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\WithdrawalTransaction;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class WithdrawalTransactionTable extends LivewireTableComponent
{
    protected $model = WithdrawalTransaction::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('withdrawal-transaction-table');
        $this->setDefaultSort('created_at','desc');
        $this->setColumnSelectStatus(false);
        $this->setQueryStringStatus(false);
        $this->resetPage('withdrawal-transaction-table');

        $this->setThAttributes(function(Column $column) {
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
            Column::make(__('messages.common.user'), 'withdrawal_id')
                ->sortable(function (Builder $query, $direction) {
                    return $query->whereHas('withdrawal', function ($q) use ($direction) {
                        return $q->orderBy(User::select('first_name')->whereColumn('user_id', 'users.id'),
                            $direction);
                    });
                })->searchable(function (Builder $query, $direction) {
                    return $query->whereHas('withdrawal', function (Builder $q) use ($direction) {
                        $q->whereHas('user', function (Builder $q) use ($direction) {
                            $q->whereRaw(
                                "TRIM(CONCAT(first_name, ' ', last_name)) like '%{$direction}%'"
                            );
                        });
                    });
                })->sortable()->view('sadmin.withdrawalTransactions.columns.name'),
            Column::make(__('messages.subscription.amount'), 'amount')->searchable()->view('sadmin.withdrawalTransactions.columns.amount'),
            Column::make(__('messages.payment_type'), 'paid_by')->view('sadmin.withdrawalTransactions.columns.payment_type'),
            Column::make(__('messages.date'), 'created_at')->view('sadmin.withdrawalTransactions.columns.date'),
        ];
    }

    public function builder(): Builder
        {
            return WithdrawalTransaction::with('withdrawal.user');
        }
        public function placeholder()
        {
            return view('lazy_loading.without-listing-skelecton');
        }
}
