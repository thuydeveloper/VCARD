<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBannerRequest;
use App\Models\Banner;
use App\Models\Testimonial;
use App\Repositories\BannerRepository;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\JsonResponse;
use Laracasts\Flash\Flash;

use Illuminate\Http\Request;

class BannerController extends AppBaseController
{
   /**
     * @var TestimonialRepository
     */
    private $bannerRepo;

    public function __construct(BannerRepository $bannerRepo)
    {
        $this->bannerRepo = $bannerRepo;
    }

    public function store(CreateBannerRequest $request)
    {
        $input = $request->all();

        $this->bannerRepo->store($input );

        return redirect()->back()->with('success', ' '.__('messages.flash.vcard_update'));


    }
}
