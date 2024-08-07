<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

/**
 * Class LivewireTableComponent
 */
class LivewireTableComponent extends DataTableComponent
{
         public $enabled = false;
    protected bool $columnSelectStatus = false;

    protected $listeners = ['resetPageTable'];

    public bool $sortingPillsStatus = false;

    public bool $filterPillsStatus = false;

    public string $emptyMessage = ('messages.common.no_data_available');

    // for table header button
    public bool $showButtonOnHeader = false;

    public string $buttonComponent = '';
    public function configure(): void
    {

    }

    public function mountWithPerPagePagination(): void
    {
        // TODO: Implement configure() method.
    }

    public function columns(): array

    {
        // TODO: Implement columns() method.
    }

    public function resetPageTable($pageName = 'page')
    {
        $rowsPropertyData = $this->getRows()->toArray();
        $prevPageNum = $rowsPropertyData['current_page'] - 1;
        $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
        $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

        $this->setPage($pageNum, $pageName);
    }
}
