<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFrontTestimonialRequest;
use App\Http\Requests\UpdateFrontTestimonialRequest;
use App\Models\FrontTestimonial;
use App\Repositories\FrontTestimonialRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontTestimonialController extends AppBaseController
{
    private $frontTestimonialRepo;

    public function __construct(FrontTestimonialRepository $frontTestimonialRepo)
    {
        $this->frontTestimonialRepo = $frontTestimonialRepo;
    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     *
     * @throws \Exception
     */
    public function index(): View
    {
        return view('sadmin.testimonial.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateFrontTestimonialRequest $request): JsonResponse
    {
        $input = $request->all();

        $testimonial = $this->frontTestimonialRepo->store($input);

        return $this->sendResponse($testimonial, __('messages.flash.create_front_testimonial'));
    }

    public function edit(FrontTestimonial $frontTestimonial): JsonResponse
    {
        return $this->sendResponse($frontTestimonial, 'Testimonial successfully retrieved.');
    }

    public function update(UpdateFrontTestimonialRequest $request): JsonResponse
    {
        $input = $request->all();

        $testimonial = $this->frontTestimonialRepo->update($input, $request->testimonial_id);

        return $this->sendResponse($testimonial, __('messages.flash.update_front_testimonial'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy(FrontTestimonial $frontTestimonial): JsonResponse
    {
        $frontTestimonial->clearMediaCollection(FrontTestimonial::PATH);
        $frontTestimonial->delete();

        return $this->sendSuccess('Testimonial deleted successfully.');
    }
}
