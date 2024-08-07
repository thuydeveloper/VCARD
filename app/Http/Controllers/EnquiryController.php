<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEnquiryRequest;
use App\Jobs\SendEmailJob;
use App\Models\Enquiry;
use App\Models\Vcard;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsMail;


class EnquiryController extends AppBaseController
{
    /**
     * @throws Exception
     */
    public function index(Request $request, $id): \Illuminate\View\View
    {
        return view('enquiry.index');
    }

    public function store(CreateEnquiryRequest $request, Vcard $vcard)
    {
        $input = $request->all();
        $input['vcard_id'] = $vcard->id;
        $input['vcard_name'] = $vcard->name;
        Enquiry::create($input);
        $email = empty($vcard->email) ? $vcard->user->email : $vcard->email;
       
        if (!empty($email)) {

            Mail::to($email)->send(new ContactUsMail($input, $email));
        }

        setLocalLang(getLocalLanguage());

        return $this->sendSuccess(__('messages.placeholder.enquiry_sent'));
    }

    public function show($id): JsonResponse
    {
        $enquiry = Enquiry::with('vcard')->where('id', '=', $id)->first();

        return $this->sendResponse($enquiry, 'Testimonial successfully retrieved.');
    }

    /**
     * @return Application|Factory|View
     *
     * @throws Exception
     */
    public function enquiryList(Request $request): \Illuminate\View\View
    {
        return view('enquiry.list');
    }

    public function destroy(Enquiry $enquiry): JsonResponse
    {
        $enquiry->delete();

        return $this->sendSuccess('Enquiry deleted successfully.');
    }
}
