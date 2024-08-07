<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateiframeRequest;
use App\Http\Requests\UpdateiframeRequest;
use App\Repositories\IframeRepository;
use App\Models\Iframe;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


class IframeController extends AppBaseController
{


    private $iframeRepo;

    public function __construct(IframeRepository $iframeRepo)
    {
        $this->iframeRepo = $iframeRepo;
    }

    public function store(CreateiframeRequest $request): JsonResponse
    {
        $input = $request->all();

        $iframe = $this->iframeRepo->store($input);

        return $this->sendResponse($iframe, __('messages.flash.iframe_create'));
    }

    public function edit(Iframe $iframe): JsonResponse
    {
        return $this->sendResponse($iframe, 'iframe successfully retrieved.');
    }


    public function update(UpdateiframeRequest $request, Iframe $iframe): JsonResponse
    {

        $input = $request->all();

        $iframe = $this->iframeRepo->update($input, $iframe->id);

        return $this->sendResponse($iframe, __('messages.flash.iframe_update'));
    }


    public function destroy(Iframe $iframe): JsonResponse
    {
        $iframe->delete();

        return $this->sendSuccess('messages.flash.iframe_delete');
    }

}
