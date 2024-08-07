<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTestimonialRequest;
use App\Http\Requests\UpdateTestimonialRequest;
use App\Models\Testimonial;
use App\Repositories\TestimonialRepository;
use Illuminate\Http\JsonResponse;

class TestimonialController extends AppBaseController
{
    /**
     * @var TestimonialRepository
     */
    private $testimonialRepo;

    /**
     * TestimonialController constructor.
     */
    public function __construct(TestimonialRepository $testimonialRepo)
    {
        $this->testimonialRepo = $testimonialRepo;
    }

    public function store(CreateTestimonialRequest $request): JsonResponse
    {
        $input = $request->all();

        $testimonial = $this->testimonialRepo->store($input);

        return $this->sendResponse($testimonial, __('messages.flash.create_testimonial'));
    }

    public function edit(Testimonial $testimonial): JsonResponse
    {
        return $this->sendResponse($testimonial, 'Testimonial successfully retrieved.');
    }

    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial): JsonResponse
    {
        $input = $request->all();

        $testimonial = $this->testimonialRepo->update($input, $testimonial->id);

        return $this->sendResponse($testimonial, __('messages.flash.update_testimonial'));
    }

    public function destroy(Testimonial $testimonial): JsonResponse
    {
        $testimonial->clearMediaCollection(Testimonial::TESTIMONIAL_PATH);
        $testimonial->delete();

        return $this->sendSuccess('Testimonial deleted successfully.');
    }
}
