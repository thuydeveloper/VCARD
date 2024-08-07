<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Mail\VerifyMail;
use App\Models\AffiliateUser;
use App\Models\MultiTenant;
use App\Models\Plan;
use App\Models\Role;
use App\Models\Setting;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class RegistrationAPIController extends AppBaseController
{
    public function register(Request $request)
    {
        $referral_code = $request->input('referral-code');
        $referral_user = '';

        if ($referral_code) {
            $referral_user = User::where('affiliate_code', $referral_code)->first();
        }
        
        try {
            DB::beginTransaction();
            // Check if the user already exists
            $existingUser = User::where('email', $request->email)->first();

            if ($existingUser) {
                // Handle case where email is already registered
                return $this->sendError("Email is already registered.");
            }

            $tenant = MultiTenant::create(['tenant_username' => $request->first_name]);
            $userDefaultLanguage = Setting::where('key', 'user_default_language')->first()->value ?? 'en';

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'language' => $userDefaultLanguage,
                'password' => Hash::make($request->password),
                'tenant_id' => $tenant->id,
                'affiliate_code' => generateUniqueAffiliateCode(),
            ])->assignRole(Role::ROLE_ADMIN);

            $plan = Plan::whereIsDefault(true)->first();

            Subscription::create([
                'plan_id' => $plan->id,
                'plan_amount' => $plan->price,
                'plan_frequency' => Plan::MONTHLY,
                'starts_at' => Carbon::now(),
                'ends_at' => Carbon::now()->addDays($plan->trial_days),
                'trial_ends_at' => Carbon::now()->addDays($plan->trial_days),
                'status' => Subscription::ACTIVE,
                'tenant_id' => $tenant->id,
                'no_of_vcards' => $plan->no_of_vcards,
            ]);

            if ($referral_user) {
                $affiliateUser = new AffiliateUser();
                $affiliateUser->affiliated_by = $referral_user->id;
                $affiliateUser->user_id = $user->id;
                $affiliateUser->amount = 0;
                $affiliateUser->save();
            }

            DB::commit();
            $token = Password::getRepository()->create($user);
            $data['url'] = config('app.url').'/verify-email/'.$user->id.'/'.$token;
            $data['user'] = $user;
            Mail::to($user->email)->send(new VerifyMail($data));

            return $this->sendSuccess("Registration successfully.");
        } catch (\Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
