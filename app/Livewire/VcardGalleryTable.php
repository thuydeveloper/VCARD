<?php

namespace App\Livewire;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class VcardGalleryTable extends LivewireTableComponent
{
    protected $model = Gallery::class;

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'vcards.gallery.add-button';

    protected $listeners = ['refresh' => '$refresh', 'resetPageTable'];

    public $vcardId;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('vcard-gallery-table');
        $this->setDefaultSort('created_at','desc');
        $this->setColumnSelectStatus(false);
        $this->setQueryStringStatus(false);
        $this->resetPage('vcard-gallery-table');

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
            Column::make(__('messages.common.type'), 'type')->view('vcards.gallery.columns.type'),
            Column::make(__('messages.common.link'), 'link')
                ->sortable()->searchable()
                ->view('vcards.gallery.columns.link'),
            Column::make(__('messages.common.action'), 'id')->view('vcards.gallery.columns.action'),

        ];
    }
    public function builder(): Builder
    {
        return Gallery::with('media')->whereVcardId($this->vcardId);
    }

    public function resetPageTable($pageName = 'vcard-gallery-table')
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
