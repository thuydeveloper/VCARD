<?php

namespace App\Livewire;

use App\Models\InstagramEmbed;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Illuminate\Support\Str;

class VcardInstagramembedTable extends LivewireTableComponent
{
    protected $model = InstagramEmbed::class;

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'vcards.instagram-embed.add-button';

    protected $listeners = ['refresh' => '$refresh', 'resetPageTable'];

    public $vcardId;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('vcard-instagram-embed-table');
        $this->setDefaultSort('created_at','desc');
        $this->setColumnSelectStatus(false);
        $this->setQueryStringDisabled();
        $this->resetPage('vcard-instagram-embed-table');

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
            Column::make(__('messages.common.type'), 'type')->view('vcards.instagram-embed.columns.type')->sortable()->searchable(function (Builder $query, $input) {
                if (Str::contains('post', Str::lower($input))) {
                    return $query->where('type', InstagramEmbed::TYPE_POST);
                } elseif(Str::contains('reel', Str::lower($input))){
                    return $query->where('type', InstagramEmbed::TYPE_REEL);
                }else{
                    return $query->where('type', null);
                }
            }),
            Column::make(__('messages.common.EmbedTag'), 'embedtag')->view('vcards.instagram-embed.columns.embedtag')->sortable(),
            Column::make(__('messages.common.action'), 'id')->view('vcards.instagram-embed.columns.action'),

        ];
    }
    public function builder(): Builder
    {
        $query = InstagramEmbed::whereVcardId($this->vcardId)->select('instagram_embeds.*');

        return $query;
    }

    public function resetPageTable($pageName = 'vcard-instagramembed-table')
    {
        $rowsPropertyData = $this->getRows()->toArray();
        $prevPageNum = $rowsPropertyData['current_page'] - 1;
        $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
        $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

        $this->setPage($pageNum, $pageName);
    }
    public function placeholder()
    {
        return view('lazy_loading.insta-embed');
    }
}
