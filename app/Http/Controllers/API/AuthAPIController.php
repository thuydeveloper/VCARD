<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Mail\ForgetPasswordMail;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthAPIController extends AppBaseController
{
    public UserRepository $userRepo;

    /**
     * UserController constructor.
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepo = $userRepository;
    }

    public function login(Request $request): JsonResponse
    {
        $email = $request->get('email');
        $password = $request->get('password');

        if (empty($email) or empty($password)) {
            return $this->sendError(__('Username and password required.'), 422);
        }
        $user = User::whereRaw('lower(email) = ?', [$email])->first();

        if (empty($user)) {
            return $this->sendError(__('Invalid username or password.'), 422);
        }

        if (!Hash::check($password, $user->password)) {
            return $this->sendError(__('Invalid username or password.'), 422);
        }

        if (!$user->email_verified_at) {
            return $this->sendError(__('Email not verified. Please verify your email before logging in.'), 422);
        }

        $token = $user->createToken('token')->plainTextToken;
        $user->last_name = $user->last_name ?? '';


        if ($user->hasRole(Role::ROLE_SUPER_ADMIN)) {
            $data = [
                'token' => $token,
                'user_id' => $user->id,
                'role' => 'Super Admin',
            ];
        }   elseif ($user->hasRole(Role::ROLE_ADMIN)) {
            $data = [
                'token' => $token,
                'user_id' => $user->id,
                'role' => 'Admin',
            ];
        } elseif ($user->hasRole(Role::ROLE_USER)){
            $data = [
                'token' => $token,
                'user_id' => $user->id,
                'role' => 'User',
            ];
        } else {
            return $this->sendError(__('Invalid username or password.'), 422);
        }

        return $this->sendResponse($data, __('Logged in successfully.'));
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->where('id', Auth::user()->currentAccessToken()->id)->delete();

        return $this->sendSuccess(__('Logout successfully.'));
    }

    public function sendPasswordResetLinkEmail(Request $request): JsonResponse
    {
        $request->validate(['email' => 'required|email', 'url_domain' => 'required']);

        $data['user'] = User::whereEmail($request->email)->first();

        if (! $data['user']) {
            return $this->sendError(__('We can\'t find user with this email address.'));
        }

        $data['token'] = encrypt($data['user']->email.' '.$data['user']->id);
        $data['url'] = $request->url_domain.'//nfcdemo.com/createNewPassword?token='.$data['token'].'&email='.$request->email.'&apn=com.example.infyvcards_flutter';

        Mail::to($data['user']->email)
            ->send(new ForgetPasswordMail('emails.forget_password',
                'Reset Password Notification',
                $data));

        $user = DB::table('password_reset_tokens')->where('email', $request->email)->first();

        if ($user) {
            DB::table('password_reset_tokens')->where('email', $user->email)->update([
                'email' => $request->email,
                'token' => $data['token'],
                'created_at' => Carbon::now(),
            ]);
        } else {
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $data['token'],
                'created_at' => Carbon::now(),
            ]);
        }

        return $this->sendSuccess(__('We have e-mailed your password reset link!'));
    }

    public function resetPassword(Request $request)
    {
        $passwordToken = DB::table('password_reset_tokens')->where('token', $request->token)->first();


        if (empty($passwordToken)) {
            return $this->sendError('Invalid or expired password reset token.');
        }

        $user = User::where('email', $passwordToken->email)->first();
        $user->update([
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
        ]);

        DB::table('password_reset_tokens')->where('token', $request->token)->delete();

        return $this->sendSuccess('Password updated successfully.');
    }

    public function changePassword(Request $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return $this->sendError(__('Email not found.'));
        }

        if ($request->has('old_password') && !Hash::check($request->old_password, $user->password)) {
            return $this->sendError(__('Please enter correct old password'));
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return $this->sendSuccess(__('Password updated successfully'));
    }

    public function userDelete(User $user)
    {
        $tenant_id = getLogInTenantId();
        $userData = User::where('tenant_id', $tenant_id)->where('id', $user->id)->first();

        if ($userData && !$userData->hasRole(Role::ROLE_SUPER_ADMIN)) {
            $result = $this->userRepo->userDataDelete($userData);

            if ($result) {
                return $this->sendSuccess(__('User deleted successfully'));
            }
        }

        return $this->sendError('Error deleting user.');
    }
}
