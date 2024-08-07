<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\AffiliateUser;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class AffiliateUserTable extends LivewireTableComponent
{
    protected $model = AffiliateUser::class;

    public bool $showButtonOnHeader = true;
    public string $buttonComponent = 'sadmin.affiliateUsers.columns.guide';
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('affiliate-user-table');
        $this->setDefaultSort('created_at', 'desc');
        $this->setColumnSelectStatus(false);
        $this->setQueryStringStatus(false);
        $this->resetPage('affiliate-user-table');
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.affiliation.affiliated_by'), "affiliated_by")
            ->sortable(function (Builder $query, $direction) {
                return $query->orderBy(User::select('first_name')->whereColumn('affiliate_users.affiliated_by',
                    'users.id'),
                    $direction);
            })->hideIf(isAdmin())->view('sadmin.affiliateUsers.columns.affilated_by'),
            Column::make(__('messages.common.user'), "user_id")
            ->sortable(function (Builder $query, $direction) {
                return $query->orderBy(User::select('first_name')->whereColumn('affiliate_users.user_id',
                    'users.id'),
                    $direction);
            })->searchable(function (Builder $query, $direction) {
                return $query->whereHas('user', function (Builder $q) use ($direction) {
                    $q->whereRaw(
                        "TRIM(CONCAT(first_name, ' ', last_name)) like '%{$direction}%'"
                    );
                });
            })->view('sadmin.affiliateUsers.columns.user'),
            Column::make(__('messages.setting.affiliation_amount'), "amount")
                ->sortable()->searchable()->view('sadmin.affiliateUsers.columns.affilation_amount'),
            Column::make(__('messages.date'), "created_at")
                ->sortable()->view('sadmin.affiliateUsers.columns.date'),

        ];
    }


    public function builder(): Builder
    {
        $query = AffiliateUser::with('user', 'affiliated_by_user');

        if (isAdmin()) {
            $query->whereAffiliatedBy(getLogInUserId());
        }

        return $query;
    }
    public function placeholder()
    {
        return view('lazy_loading.without-listing-skelecton');
    }


}
