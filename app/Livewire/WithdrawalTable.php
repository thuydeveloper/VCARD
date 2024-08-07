<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class WithdrawalTable extends LivewireTableComponent
{
    protected $model = Withdrawal::class;
    protected $listeners = ['refresh' => '$refresh'];
    public bool $showButtonOnHeader = true;
    public string $buttonComponent = 'user-settings.affiliationWithdraw.withdraw-button';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('withdrawal-table');
        $this->setDefaultSort('created_at','desc');
        $this->setColumnSelectStatus(false);
        $this->setQueryStringStatus(false);
        $this->resetPage('withdrawal-table');

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
            Column::make(__('messages.common.user'), 'user_id')
                ->sortable(function (Builder $query, $direction) {
                    return $query->orderBy(
                        User::select('first_name')->whereColumn(
                            'withdrawals.user_id',
                            'users.id'
                        ),
                        $direction
                    );
                })->searchable(function (Builder $query, $direction) {
                    if (!isAdmin()) {
                        return $query->whereHas('user', function (Builder $q) use ($direction) {
                            $q->whereRaw(
                                "TRIM(CONCAT(first_name, ' ', last_name)) like '%{$direction}%'"
                            );
                        });
                    }
                })->hideIf(isAdmin())->view('sadmin.affiliationWithdraw.columns.user'),
            Column::make(__('messages.subscription.amount'), 'amount')
                ->sortable()->searchable()->view('sadmin.affiliationWithdraw.columns.amount'),
            Column::make(__('messages.affiliation.approval_status'), 'is_approved')
                ->sortable()->view('sadmin.affiliationWithdraw.columns.approval_status'),
            Column::make(__('messages.date'), 'created_at')
                ->sortable()->view('sadmin.affiliationWithdraw.columns.date'),
            Column::make(__('messages.common.action'), 'id')->view('sadmin.affiliationWithdraw.columns.action'),
        ];
    }

    public function builder(): Builder
    {
        $query = Withdrawal::with('user');

        if (isAdmin()) {
            $query->whereUserId(getLogInUserId());
        }

        return $query;
    }
    public function placeholder()
    {
        return view('lazy_loading.without-listing-skelecton');
    }

}
