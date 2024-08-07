<?php

namespace App\Livewire;

use App\Models\Vcard;
use Illuminate\Database\Eloquent\Builder;
use Stancl\Tenancy\Database\Models\Tenant;
use App\Livewire\LivewireTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;



class VcardTable extends LivewireTableComponent
{
    protected $model = Vcard::class;

    public $verified;
    public $status;

    public bool $showButtonOnHeader = true;

    protected $listeners = ['verifiedFilter', 'statusFilter'];


    public string $buttonComponent = 'sadmin.vcards.columns.add-button';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('Vcard-table');
        $this->setDefaultSort('created_at', 'desc');
        $this->setColumnSelectStatus(false);
        $this->setQueryStringStatus(false);
        $this->resetPage('Vcard-table');
    }
    public function columns(): array
    {
        return [
            Column::make(__('messages.vcard.vcard_name'), 'name')->sortable()->searchable()
                ->view('sadmin.vcards.columns.name'),
            Column::make(__('messages.vcard.user_name'), 'tenant.tenant_username')->sortable(function (
                Builder $query,
                $direction
            ) {
                return $query->orderBy(
                    Tenant::select('tenant_username')->whereColumn('tenants.id', 'vcards.tenant_id'),
                    $direction
                );
            })
                ->searchable(),
            Column::make(__('messages.vcard.preview_url'), 'url_alias')
                ->hideIf('url_alias')
                ->searchable(),
            Column::make(__('messages.vcard.preview_url'), 'url_alias')->sortable()->view('sadmin.vcards.columns.preview'),
            Column::make(__('messages.vcard.verified'), 'is_verified')->view('sadmin.vcards.columns.verified'),
            Column::make(__('messages.vcard.stats'), 'id')
                ->view('sadmin.vcards.columns.stats'),
            Column::make(__('messages.vcard.created_at'), 'created_at')->sortable()
                ->view('sadmin.vcards.columns.created_at'),
            Column::make(__('messages.vcard.status'), 'status')->sortable()
                ->view('sadmin.vcards.columns.status'),

        ];
    }

    public function verifiedFilter($verified)
    {
        $this->verified = $verified;
        $this->setBuilder($this->builder());
    }

    public function statusFilter($status)
    {
        $this->status = $status;
        $this->setBuilder($this->builder());
    }

    public function builder(): Builder
    {
        $verified = $this->verified;
        $status = $this->status;
        $query =  Vcard::query();

        $query->when($verified != "" && $verified != '2', function ($q) use ($verified) {
            if ($verified == Vcard::VERIFIED) {
                $q->where('is_verified', Vcard::VERIFIED);
            }else {
                  $q->where('is_verified', Vcard::NOTVERIFIED);
            }
        });

        $query->when($status != "" && $status != '2', function ($q) use ($status) {
            if ($status == Vcard::ACTIVE) {
                $q->where('status', Vcard::ACTIVE);
            }else {
                  $q->where('status', Vcard::INACTIVE);
            }
        });

        return $query->select('vcards.*');
    }
    public function placeholder()
    {
        return view('lazy_loading.sadmin-vcards');
    }

}
