<?php

namespace App\Repositories;

use App\Models\Banner;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Yajra\DataTables\Exceptions\Exception;


class BannerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'url',
        'title',
        'description',
    ];

    /**
     * Return searchable fields
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Banner::class;
    }

    /**
     * @return mixed
     */
    public function store($input)
    {
        try {
            DB::beginTransaction();

            $vcardId = $input['vcard_id'];

            $banner = Banner::updateOrCreate(
                ['vcard_id' => $vcardId],
                [
                    'banner_enable' => isset($input['banner_enable']) ? 1 : 0,
                    'url' => isset($input['url']) ? $input['url'] : null,
                    'title' => isset($input['title']) ? $input['title'] : null,
                    'banner_button' => isset($input['banner_button']) ? $input['banner_button'] : null,
                    'description' => isset($input['description']) ? $input['description'] : null,
                    'vcard_id' => $vcardId
                ]
            );

            DB::commit();

            return $banner;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}

