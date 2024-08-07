<?php

namespace App\Repositories;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Yajra\DataTables\Exceptions\Exception;

class GalleryRepository extends BaseRepository
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
        return Gallery::class;
    }

    /**
     * @return mixed
     */
    public function store($input)
    {
        try {
            DB::beginTransaction();

            if ($input['type'] == Gallery::TYPE_IMAGE) {
                $input['link'] = null;
            }
            if ($input['type'] == Gallery::TYPE_YOUTUBE) {
                $input['image'] = null;
            }

            if ($input['type'] == Gallery::TYPE_FILE || $input['type'] == Gallery::TYPE_VIDEO || $input['type'] == Gallery::TYPE_AUDIO) {
                $input['image'] = null;
                $input['link'] = null;
            }

            $gallery = Gallery::create($input);

            if (($input['type'] == Gallery::TYPE_IMAGE) && isset($input['image']) && ! empty($input['image'])) {
                $gallery->newAddMedia($input['image'])->toMediaCollection(Gallery::GALLERY_PATH,
                    config('app.media_disc'));
            }
            if (($input['type'] == Gallery::TYPE_FILE) && isset($input['gallery_upload_file']) && ! empty($input['gallery_upload_file'])) {
                $gallery->newAddMedia($input['gallery_upload_file'])->toMediaCollection(Gallery::GALLERY_PATH,
                    config('app.media_disc'));
            }
            if (($input['type'] == Gallery::TYPE_VIDEO) && isset($input['video_file']) && ! empty($input['video_file'])) {
                $gallery->newAddMedia($input['video_file'])->toMediaCollection(Gallery::GALLERY_PATH,
                    config('app.media_disc'));
            }
            if (($input['type'] == Gallery::TYPE_AUDIO) && isset($input['audio_file']) && ! empty($input['audio_file'])) {
                $gallery->newAddMedia($input['audio_file'])->toMediaCollection(Gallery::GALLERY_PATH,
                    config('app.media_disc'));
            }

            DB::commit();

            return $gallery;
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

            if ($input['type'] == Gallery::TYPE_IMAGE) {
                $input['link'] = null;
            }
            if ($input['type'] == Gallery::TYPE_YOUTUBE) {
                $input['image'] = null;
            }
            if ($input['type'] == Gallery::TYPE_FILE || $input['type'] == Gallery::TYPE_VIDEO || $input['type'] == Gallery::TYPE_AUDIO) {
                $input['image'] = null;
                $input['link'] = null;
            }

            $gallery = Gallery::findOrFail($id);
            if (($input['type'] == Gallery::TYPE_IMAGE) && isset($input['image']) && ! empty($input['image'])) {
                $gallery->newClearMediaCollection($input['image'],Gallery::GALLERY_PATH);
                $gallery->newAddMedia($input['image'])->toMediaCollection(Gallery::GALLERY_PATH,
                    config('app.media_disc'));
            }
            if (($input['type'] == Gallery::TYPE_FILE) && isset($input['gallery_upload_file']) && ! empty($input['gallery_upload_file'])) {
                $gallery->newClearMediaCollection($input['gallery_upload_file'],Gallery::GALLERY_PATH);
                $gallery->newAddMedia($input['gallery_upload_file'])->toMediaCollection(Gallery::GALLERY_PATH,
                    config('app.media_disc'));
            }
            if (($input['type'] == Gallery::TYPE_VIDEO) && isset($input['video_file']) && ! empty($input['video_file'])) {
                $gallery->newClearMediaCollection($input['video_file'],Gallery::GALLERY_PATH);
                $gallery->newAddMedia($input['video_file'])->toMediaCollection(Gallery::GALLERY_PATH,
                    config('app.media_disc'));
            }
            if (($input['type'] == Gallery::TYPE_AUDIO) && isset($input['audio_file']) && ! empty($input['audio_file'])) {
                $gallery->newClearMediaCollection($input['video_file'],Gallery::GALLERY_PATH);
                $gallery->newAddMedia($input['audio_file'])->toMediaCollection(Gallery::GALLERY_PATH,
                    config('app.media_disc'));
            }
            $gallery->update($input);

            DB::commit();

            return $gallery;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
