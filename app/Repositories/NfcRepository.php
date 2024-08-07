<?php

namespace App\Repositories;

use App\Models\Nfc;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use Yajra\DataTables\Exceptions\Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class nfcRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
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
        return Nfc::class;
    }

    public function store($input)
    {
    try {
        DB::beginTransaction();

        $inputArray = Arr::only($input, ['name', 'description', 'price']);
        $nfc = Nfc::create($inputArray);

        if (isset($input['nfc_img']) && !empty($input['nfc_img'])) {
            $nfc->addMedia($input['nfc_img'])->toMediaCollection(Nfc::NFC_PATH);
        }
        if (isset($input['nfc_back_img']) && !empty($input['nfc_back_img'])) {
            $nfc->addMedia($input['nfc_back_img'])->toMediaCollection(Nfc::NFC_BACK_IMAGE);
        }

        DB::commit();

    } catch (Exception $e) {
        DB::rollBack();

        throw new UnprocessableEntityHttpException($e->getMessage());
    }

    return $nfc;

    }

    public function update($input,$id){

        try {
            DB::beginTransaction();

        $inputArray = Arr::only($input, ['name', 'description', 'price']);

        $nfc = Nfc::findOrFail($id);
        $nfc->update($inputArray);

        if (isset($input['nfc_img']) && ! empty($input['nfc_img'])) {
            $nfc->clearMediaCollection(Nfc::NFC_PATH);
            $nfc->addMedia($input['nfc_img'])->toMediaCollection(Nfc::NFC_PATH);
        }

        if (isset($input['nfc_back_img']) && ! empty($input['nfc_back_img'])) {
            $nfc->clearMediaCollection(Nfc::NFC_BACK_IMAGE);
            $nfc->addMedia($input['nfc_back_img'])->toMediaCollection(Nfc::NFC_BACK_IMAGE);
        }

        DB::commit();

    } catch (Exception $e) {

        DB::rollBack();

        throw new UnprocessableEntityHttpException($e->getMessage());
    }

        return $nfc;
    }

}
