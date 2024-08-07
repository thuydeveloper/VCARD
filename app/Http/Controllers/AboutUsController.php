<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAboutUsRequest;
use App\Models\AboutUs;
use App\Repositories\AboutUsRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;

class AboutUsController extends Controller
{
    private AboutUsRepository $aboutUsRepository;

    public function __construct(AboutUsRepository $aboutUsRepository)
    {
        $this->aboutUsRepository = $aboutUsRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): \Illuminate\View\View
    {
        $aboutUs = AboutUs::with('media')->get();

        return view('sadmin.aboutUs.index', compact('aboutUs'));
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateAboutUsRequest $request): RedirectResponse
    {
        $this->aboutUsRepository->store($request->all());

        Flash::success(__('messages.flash.about_us_create'));

        return redirect(route('aboutUs.index'));
    }
}
