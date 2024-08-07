<?php

namespace App\Livewire;

use App\Models\VcardBlog;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class VcardBlogTable extends LivewireTableComponent
{
    protected $model = VcardBlog::class;

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'vcards.blogs.add-button';

    protected $listeners = ['refresh' => '$refresh', 'resetPageTable'];

    public $vcardId;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('blog-vcard-table');
        $this->setDefaultSort('created_at','desc');
        $this->setColumnSelectStatus(false);
        $this->setQueryStringStatus(false);
        $this->resetPage('blog-vcard-table');

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
            Column::make(__('messages.common.icon'), 'created_at')->view('vcards.blogs.columns.icon'),
            Column::make(__('messages.front_cms.title'), 'title')
                ->sortable()->searchable(),
            Column::make(__('messages.common.action'), 'id')->view('vcards.blogs.columns.action'),

        ];
    }

    public function builder(): Builder
    {
        return VcardBlog::whereVcardId($this->vcardId)->select('vcard_blog.*');
    }

    public function resetPageTable($pageName = 'blog-vcard-table')
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
