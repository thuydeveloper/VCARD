<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInstagramEmbedRequest;
use App\Http\Requests\UpdateInstagramEmbedRequest;
use App\Models\InstagramEmbed;
use App\Repositories\InstagramEmbedRepository;
use Illuminate\Http\Request;

class InstagramEmbedController extends AppBaseController
{
    /**
     * @var InstagramEmbedRepository
     */
    private $instagramembedRepo;

    public function __construct(InstagramEmbedRepository $instagramembedRepo)
    {
        $this->instagramembedRepo = $instagramembedRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateInstagramEmbedRequest $request)
    {
        $input = $request->all();

        $this->instagramembedRepo->store($input);

        return $this->sendSuccess(__('messages.placeholder.embedtag_created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(InstagramEmbed $instagramembed)
    {
        return $this->sendResponse($instagramembed, 'instagramembed successfully retrieved.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInstagramEmbedRequest $request, InstagramEmbed $instagramembed)
    {
        $input = $request->all();
        $this->instagramembedRepo->update($input, $instagramembed->id);

        return $this->sendSuccess(__('messages.placeholder.embedtag_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($instagramembed)
    {
        InstagramEmbed::destroy($instagramembed);

        return $this->sendSuccess('VCard service deleted successfully.');
    }
}
