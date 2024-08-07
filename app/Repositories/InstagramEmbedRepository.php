<?php

namespace App\Repositories;

use App\Models\InstagramEmbed;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Yajra\DataTables\Exceptions\Exception;

class InstagramEmbedRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
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
        return InstagramEmbed::class;
    }

    /**
     * @return mixed
     *
     */
    public function store($input)
    {
        try {
            DB::beginTransaction();

            $input['embedtag'] = str_replace(['data-instgrm-captioned'], '', $input['embedtag']);
            $url = explode('/', $input['embedtag']);

            if (isset($url[3]) && ($url[3] == 'reel'|| $url[3] == 'p')) {
                if ($input['type'] == 0 && $url[3] == 'reel') {
                    throw new UnprocessableEntityHttpException(__('messages.flash.post_type_content'));
                } elseif ($input['type'] == 1 && $url[3] == 'p') {
                    throw new UnprocessableEntityHttpException(__('messages.flash.reel_type_content'));
                }
            } else {
                throw new UnprocessableEntityHttpException(__('messages.flash.embedtag_content'));
            }

            $embed = InstagramEmbed::create($input);

            DB::commit();

            return $embed;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @return Builder|Builder[]|Collection|Model
     */
    public function update($input, $id)
    {
        try {
            DB::beginTransaction();

            $input['embedtag'] = str_replace(['data-instgrm-captioned'], '', $input['embedtag']);
            $url = explode('/', $input['embedtag']);

            if (isset($url[3]) && ($url[3] == 'reel'|| $url[3] == 'p')) {
                if ($input['type'] == 0 && $url[3] == 'reel') {
                    throw new UnprocessableEntityHttpException(__('messages.flash.post_type_content'));
                } elseif ($input['type'] == 1 && $url[3] == 'p') {
                    throw new UnprocessableEntityHttpException(__('messages.flash.reel_type_content'));
                }
            } else {
                throw new UnprocessableEntityHttpException(__('messages.flash.embedtag_content'));
            }

            $embed = InstagramEmbed::findOrFail($id);

            $embed->update($input);

            DB::commit();

            return $embed;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
