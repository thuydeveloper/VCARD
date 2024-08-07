<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFrontFaqRequest;
use App\Models\FrontFAQs;
use Illuminate\Http\Request;
use App\Repositories\FrontFaqsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class FrontFAQsController extends AppBaseController
{
    private $frontFaqsRepo;

    public function __construct(FrontFaqsRepository $frontFaqsRepo)
    {
        $this->frontFaqsRepo = $frontFaqsRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sadmin.faqs.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateFrontFaqRequest $request)
    {
        $input = $request->all();

        $faqs = $this->frontFaqsRepo->store($input);

        return $this->sendResponse($faqs, __('messages.faqs.create_front_faqs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): JsonResponse
    {
      $faq = FrontFAQs::where('id', $id)->first();
      return $this->sendResponse($faq, 'FAQs successfully retrieved.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateFrontFaqRequest $request, string $id): JsonResponse
    {
        $input = $request->all();

        $testimonial = $this->frontFaqsRepo->update($input, $request->faqs_id);

        return $this->sendResponse($testimonial, __('messages.faqs.update_front_faqs'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        FrontFAQs::where('id', $id)->delete();
        return $this->sendSuccess('FAQs deleted successfully.');
    }
}
