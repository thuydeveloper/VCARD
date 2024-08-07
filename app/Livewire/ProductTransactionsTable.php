<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\ProductTransaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ProductTransactionsTable extends LivewireTableComponent
{
    protected $model = ProductTransaction::class;
    protected $paymentType;
    public bool $showButtonOnHeader = true;
    protected $listeners = ['refresh' => '$refresh','changeFilter'];
    public string $buttonComponent = 'product_transactions.filter';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('product-transactions-table');
        $this->setDefaultSort('created_at', 'desc');
        $this->setSortingPillsStatus(false);
        $this->setQueryStringStatus(false);
        $this->resetPage('product-transactions-table');

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
            Column::make(__('messages.vcard.product_name'), 'product.name')->searchable()->sortable(),
            Column::make(__('messages.common.name'), 'name')->sortable()->searchable(),
            Column::make(__('messages.vcard.order_at'), 'created_at')->sortable()->searchable()->view('product_transactions.column.date'),
            Column::make(__('messages.payment_type'), 'type')->view('product_transactions.column.type')->sortable()->searchable(),
            Column::make(__('messages.subscription.amount'), 'amount')->view('product_transactions.column.amount')->sortable()->searchable(),
            Column::make(__('messages.common.action'), 'id')->view('product_transactions.column.action'),
        ];
    }

    public function changeFilter($type)
    {
        $this->paymentType = $type;
        $this->setBuilder($this->builder());
    }

    public function builder(): Builder
    {
        $paymentType = $this->paymentType;
        $tenantId = Auth::user()->tenant_id;
        $query = ProductTransaction::whereHas('product.vcard', function($q) use ($tenantId){
            $q->whereTenantId($tenantId);
        });

        $query->when($paymentType != "", function ($q) use ($paymentType) {
            if ($paymentType == Product::STRIPE) {
                $q->where('type', Product::STRIPE);
            }

            if ($paymentType == Product::PAYPAL) {
                $q->where('type', Product::PAYPAL);
            }

            if ($paymentType == Product::MANUALLY) {
                $q->where('type', Product::MANUALLY);
            }
            if ($paymentType == Product::RAZORPAY) {
                  $q->where('type', Product::RAZORPAY);
              }
              if ($paymentType == Product::PHONEPE) {
                  $q->where('type', Product::PHONEPE);
              }
              if ($paymentType == Product::PAYSTACK) {
                  $q->where('type', Product::PAYSTACK);
              }
              if ($paymentType == Product::FLUTTERWAVE) {
                  $q->where('type', Product::FLUTTERWAVE);
              }

        });
        return $query->select('product_transactions.*');
    }

    public function resetPageTable($pageName = 'product-transactions-table')
    {
        $rowsPropertyData = $this->getRows()->toArray();
        $prevPageNum = $rowsPropertyData['current_page'] - 1;
        $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
        $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

        $this->setPage($pageNum, $pageName);
    }
    public function placeholder()
    {
        return view('lazy_loading.user-product-order');
    }

}
