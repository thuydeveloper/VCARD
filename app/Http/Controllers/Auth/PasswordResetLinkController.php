<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ForgetPasswordMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        $registerImage = Setting::where('key', 'register_image')->value('value');

        return view('auth.forgot-password',['registerImage' => $registerImage]);
    }

    /**
     * Handle an incoming password reset link request.
     *
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->withErrors(__('messages.email_not_found'));
        }

        $token = Password::getRepository()->create($user);
        $data['url'] = config('app.url') . '/reset-password/' . $token . '?email=' . $request->email;
        $data['user'] = $user;
        $status =  Mail::to($user->email)
            ->send(new ForgetPasswordMail(
                'emails.forget_password', __('messages.email_password_reset_link'),
                $data
            ));

        $status = 'passwords.sent';

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
            ->withErrors(['email' => __($status)]);
    }
}
