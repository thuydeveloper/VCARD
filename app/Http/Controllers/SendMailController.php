<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendMailRequest;
use App\Mail\SendEmail as MailSendEmail;
use App\Models\EmailSubscription;
use App\Models\SendEmail;
use Illuminate\Support\Facades\Mail;
use Laracasts\Flash\Flash;

class SendMailController extends Controller
{
    public function index(): \Illuminate\View\View
    {
        $emails = EmailSubscription::pluck('email','email')->toArray();

       $newEmail = $emails;

        return view('sadmin.send_mail.index',compact('newEmail'));
    }

     public function store(SendMailRequest $request)
    {
        ini_set('max_execution_time', 1200);
        $input = $request->all();
        $enquiries = EmailSubscription::all();

        $sendEmailData = [
            'subject' => $input['subject'],
            'description' => $input['description'],
        ];

        $sendEmail = SendEmail::create($sendEmailData);

        if (isset($input['custom_email'])) {
            foreach ($input['custom_email'] as $enquiries) {
                $data = [
                    'subject' => $input['subject'],
                    'description' => $input['description'],
                    'email' => $enquiries,
                ];

                Mail::to($enquiries)->send(new MailSendEmail($data));
            }
        }
        Flash::success(__('messages.flash.mail_send'));

        return redirect()->back();
    }
}
