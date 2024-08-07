<?php

namespace App\Livewire;

use App\Models\FrontTestimonial;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;


class FrontTestimonialTable extends LivewireTableComponent
{
    protected $model = FrontTestimonial::class;

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'sadmin.testimonial.add-button';

    protected $listeners = ['refresh' => '$refresh', 'resetPageTable'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('front-testimonial-table');
        $this->setDefaultSort('created_at','desc');
        $this->setColumnSelectStatus(false);
        $this->setQueryStringStatus(false);
        $this->resetPage('front-testimonial-table');

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
            Column::make(__('messages.common.name'), 'name')
                ->view('sadmin.testimonial.columns.name')
                ->sortable()->searchable(),
            Column::make(__('messages.common.action'), 'id')
                ->view('sadmin.testimonial.columns.action'),
        ];
    }

    public function resetPageTable($pageName = 'front-testimonial-table')
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
