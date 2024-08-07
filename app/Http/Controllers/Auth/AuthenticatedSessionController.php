<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Mail\PlanExpirationReminder;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Cookie;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return Application|Factory|View|\Illuminate\View\View
     */
    public function create(): \Illuminate\View\View
    {
        $registerImage = Setting::where('key', 'register_image')->value('value');

        return view('auth.login', ['registerImage' => $registerImage]);

    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        if (! isset($request->remember)) {
            Cookie::queue(Cookie::forget('email'));
            Cookie::queue(Cookie::forget('password'));
            Cookie::queue(Cookie::forget('remember'));
        } else {
            Cookie::queue('email', $request->email, 3600);
            Cookie::queue('password', $request->password, 3600);
            Cookie::queue('remember', 1, 3600);
        }
        $user = User::whereEmail($request->email)->first();

        if (! empty($user)) {
            if ($user['email_verified_at'] != null) {
                if ($user['is_active'] == User::IS_ACTIVE) {
                    $request->authenticate();

                    $request->session()->regenerate();

                    if ($user->hasRole('admin') && $request->redirect == "delete") {
                        return redirect()->route('delete-account');
                    }

                    return redirect()->intended(getDashboardURL());
                } else {
                    throw ValidationException::withMessages([
                        'email' => __('auth.account_deactivate'),
                    ]);
                }
            } else {
                throw ValidationException::withMessages([
                    'email' => __('auth.email_verify'),
                ]);
            }
        } else {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
