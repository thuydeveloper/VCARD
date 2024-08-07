<?php

namespace App\Livewire;

use App\Models\CouponCode;
use Illuminate\Database\Eloquent\Builder;
use App\Livewire\LivewireTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CouponCodeTable extends LivewireTableComponent
{
    protected $model = CouponCode::class;

    protected $listeners = ['refresh' => '$refresh', 'resetPageTable'];

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'sadmin.couponCodes.columns.add-button';


    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('coupon-code-table');
        $this->setDefaultSort('created_at', 'desc');
        $this->setColumnSelectStatus(false);
        $this->setFilterPillsDisabled();
        $this->setQueryStringStatus(false);
        $this->resetPage('coupon-code-table');

        $this->setThAttributes(function (Column $column) {
            if ($column->isField('id')) {
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
            Column::make(__('messages.coupon_code.coupon_name'), 'coupon_name')
                ->sortable()
                ->searchable()->view('sadmin.couponCodes.columns.coupon_name'),
            Column::make(__('messages.coupon_code.coupon_type'), 'type')
                ->sortable()->view('sadmin.couponCodes.columns.coupon_type'),
            Column::make(__('messages.coupon_code.coupon_discount'), 'discount')
                ->sortable()->view('sadmin.couponCodes.columns.coupon_discount'),
            Column::make(__('messages.coupon_code.expire_at'), 'expire_at')
                ->sortable()->view('sadmin.couponCodes.columns.expire_at'),
            Column::make(__('messages.common.status'), 'status')->view('sadmin.couponCodes.columns.status'),
            Column::make(__('messages.common.action'), 'id')->view('sadmin.couponCodes.columns.action'),
        ];
    }

    public function builder(): Builder
    {
        return CouponCode::query();
    }

    public function resetPageTable($pageName = 'coupon-code-table')
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
