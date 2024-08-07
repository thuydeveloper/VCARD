<?php

namespace App\Livewire;

use App\Models\EmailSubscription;
use Rappasoft\LaravelLivewireTables\Views\Column;

class EmailSubscriptionTable extends LivewireTableComponent
{
    protected $model = EmailSubscription::class;

    protected $listeners = ['refresh' => '$refresh', 'resetPageTable'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPrimaryKey('email_subscription_id');
        $this->setPageName('email-subscription-table');
        $this->setDefaultSort('created_at', 'desc');
        $this->setColumnSelectStatus(false);
        $this->setQueryStringStatus(false);
        $this->resetPage('email-subscription-table');

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
            Column::make(__('messages.user.email'), "email")
                ->sortable()->searchable(),
            Column::make(__('messages.common.action'), 'id')
                    ->view('email_subscription.columns.action'),

        ];
    }

    public function resetPageTable($pageName = 'email-subscription-table')
    {
        $rowsPropertyData = $this->getRows()->toArray();
        $prevPageNum = $rowsPropertyData['current_page'] - 1;
        $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
        $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

        $this->setPage($pageNum, $pageName);
    }
    public function placeholder()
    {
        return view('lazy_loading.without-listing-skelecton');
    }
}
