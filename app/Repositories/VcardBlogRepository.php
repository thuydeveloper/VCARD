<?php

namespace App\Repositories;

use App\Models\VcardBlog;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Yajra\DataTables\Exceptions\Exception;

class VcardBlogRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
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
        return VcardBlog::class;
    }

    /**
     * @return mixed
     */
    public function store($input)
    {
        try {
            DB::beginTransaction();

            $vcardBlog = VcardBlog::create($input);

            if (isset($input['blog_icon']) && ! empty($input['blog_icon'])) {
                $vcardBlog->newAddMedia($input['blog_icon'])->toMediaCollection(VcardBlog::BLOG_PATH,
                    config('app.media_disc'));
            }

            DB::commit();

            return $vcardBlog;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @return Builder|Builder[]|Collection|Model
     */
    public function update($input,$id)
    {
        try {
            DB::beginTransaction();

            $vcardBlog = VcardBlog::findOrFail($id);
            $vcardBlog->update($input);

            if (isset($input['blog_icon']) && ! empty($input['blog_icon'])) {
                $vcardBlog->newClearMediaCollection($input['blog_icon'],VcardBlog::BLOG_PATH);
                $vcardBlog->newAddMedia($input['blog_icon'])->toMediaCollection(VcardBlog::BLOG_PATH,
                    config('app.media_disc'));
            }

            DB::commit();

            return $vcardBlog;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
