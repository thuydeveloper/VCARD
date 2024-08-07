<?php

namespace App\Repositories;

use App\Mail\VerifyMail;
use App\Models\EmailVerification;
use App\Models\MultiTenant;
use App\Models\Plan;
use App\Models\Role;
use App\Models\Setting;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Product;
use App\Models\VcardBlog;
use App\Models\Testimonial;
use App\Models\NfcOrders;
use App\Models\WithdrawalTransaction;
use App\Models\NfcOrderTransaction;
use App\Models\Withdrawal;
use App\Models\Vcard;
use App\Models\AffiliateUser;
use App\Models\VcardService;
use App\Models\Gallery;
use App\Models\UserSetting;
use Carbon\Carbon;
use Exception;
use Flash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;

/**
 * Class UserRepository
 */
class UserRepository extends BaseRepository
{
    public $fieldSearchable = [
        'first_name',
        'last_name',
        'email',
        'contact',
        'dob',
        'gender',
        'is_active',
        'password',
    ];

    /**
     * {@inheritDoc}
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * {@inheritDoc}
     */
    public function model()
    {
        return User::class;
    }

    /**
     * @return mixed
     */
    public function store($input)
    {
        try {
            DB::beginTransaction();

            $tenant = MultiTenant::create(['tenant_username' => $input['first_name']]);
            $userDefaultLanguage = Setting::where('key', 'user_default_language')->first()->value ?? 'en';

            $input['tenant_id'] = $tenant->id;
            $input['language'] = $userDefaultLanguage;
            $input['password'] = Hash::make($input['password']);
            if (isset($input['role'])) {
                $user = User::create($input)->assignRole(Role::ROLE_SUPER_ADMIN);
                $user->email_verified_at = Carbon::now();
                $user->is_active = true;
                $user->save();
            } else {
                $input['affiliate_code'] = generateUniqueAffiliateCode();
                $user = User::create($input)->assignRole(Role::ROLE_ADMIN);
                $user->email_verified_at = Carbon::now();
                $user->steps = 0;
                $user->save();
            }


            if (isset($input['profile']) && !empty($input['profile'])) {
                $user->addMedia($input['profile'])->toMediaCollection(User::PROFILE, config('app.media_disc'));
            }

            if (!isset($input['is_admin'])) {
                $user->sendEmailVerificationNotification();
            }
            if (isset($input['plan_id'])) {
                $plan = Plan::whereId($input['plan_id'])->first();
            } else {
                $plan = Plan::whereIsDefault(true)->first();
            }
            if (!isset($input['role'])) {
                  $vcardOfNo = $plan->no_of_vcards;
                  $planPrice = $plan->price;

                  if ($plan->custom_select == 1) {
                      $customFields = $plan->planCustomFields;
                      if ($customFields->isNotEmpty()) {
                          $vcardOfNo = $customFields->first()->custom_vcard_number;
                          $planPrice = $customFields->first()->custom_vcard_price;
                      }
                  }
         }

            if (!isset($input['role'])) {
                $subscription = new Subscription();
                $subscription->plan_id = $plan->id;
                $subscription->starts_at = Carbon::now();
                $subscription->ends_at = $plan->frequency == Plan::UNLIMITED ? Carbon::now()->addYears(100) : Carbon::now()->addDays($plan->trial_days);
                $subscription->plan_amount = $planPrice;
                $subscription->plan_frequency = $plan->frequency;
                $subscription->trial_ends_at = $plan->frequency == Plan::UNLIMITED ? Carbon::now()->addYears(100) : Carbon::now()->addDays($plan->trial_days);
                $subscription->no_of_vcards = $vcardOfNo;
                $subscription->tenant_id = $input['tenant_id'];
                $subscription->status = Subscription::ACTIVE;
                $subscription->saveQuietly();
            }
            DB::commit();

            return $user;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @return Builder|Builder[]|Collection|Model|int
     */
    public function update($input, $user)
    {
        if (isset($input['contact'])) {
            $input['contact'] = str_replace(' ', '', $input['contact']);
        }

        $currentPlan = Subscription::with(['plan'])
            ->whereTenantId($user->tenant_id)
            ->where('status', Subscription::ACTIVE)->latest()->first();
            if($currentPlan){
            $oldPlanLimit = $currentPlan->plan->no_of_vcards;
            if ($currentPlan->plan->custom_select == 1) {
                $customFields = $currentPlan->plan->planCustomFields;
                if ($customFields->isNotEmpty()) {
                    $oldPlanLimit = $customFields->first()->custom_vcard_number;
                }
            }
         }
        if (isset($input['plan_id']) && $input['plan_id'] != $currentPlan->plan_id) {
            $subscription = Subscription::whereTenantId($user->tenant_id)->where('status', Subscription::ACTIVE)->latest()->first();
            $plan = Plan::whereId($input['plan_id'])->first();
            $vcardOfNo = $plan->no_of_vcards;
            $planPrice = $plan->price;

                  if ($plan->custom_select == 1) {
                      $customFields = $plan->planCustomFields;
                      if ($customFields->isNotEmpty()) {
                          $vcardOfNo = $customFields->first()->custom_vcard_number;
                          $planPrice = $customFields->first()->custom_vcard_price;
                      }
                  }

            $subscription->update([
                'plan_id' => $plan->id,
                'starts_at' => Carbon::now(),
                'ends_at' => $plan->frequency == Plan::UNLIMITED ? Carbon::now()->addYears(100) : Carbon::now()->addDays($plan->trial_days),
                'plan_amount' => $planPrice,
                'plan_frequency' => $plan->frequency,
                'trial_ends_at' => $plan->frequency == Plan::UNLIMITED ? Carbon::now()->addYears(100) : Carbon::now()->addDays($plan->trial_days),
                'no_of_vcards' => $vcardOfNo,
                'status' => Subscription::ACTIVE,
            ]);
            $newPlanLimit = $vcardOfNo;
            $this->manageVcards($user, $oldPlanLimit, $newPlanLimit);
        }

        $user->update($input);

        if (isset($input['profile']) && !empty($input['profile'])) {
            $user->clearMediaCollection(User::PROFILE);
            $user->addMedia($input['profile'])->toMediaCollection(User::PROFILE, config('app.media_disc'));
        }

        return $user;
    }
    public function manageVcards($user, $oldPlanLimit, $newPlanLimit)
{
    $vCards = Vcard::where('tenant_id', $user->tenant_id)->get();

    if ($vCards->count() > $newPlanLimit) {
        $excessVcards = $vCards->sortByDesc('created_at')->skip($newPlanLimit);

        foreach ($excessVcards as $vCard) {
            $vCard->update(['status' => '0']);
        }
    }
}

    public function updateProfile($userInput): bool
    {
        try {
            DB::beginTransaction();

            $user = Auth::user();
            $userInput['contact'] = str_replace(' ', '', $userInput['contact']);

            if ($userInput['email'] != $user->email) {
                $token = Str::random(60);

                EmailVerification::create([
                    'user_id' => $user->id,
                    'email' => $userInput['email'],
                    'token' => $token,
                ]);

                $url = url(config('app_domain') . '/change-email-verification/' . $user->id . '/' . $token);
                $data = [
                    'user' => $user,
                    'url' => $url,
                ];

                Mail::to($userInput['email'])
                    ->send(new VerifyMail($data));
            }

            $userInput['email'] = $user->email;
            $user->update($userInput);

            if (isset($userInput['profile']) && !empty($userInput['profile'])) {
                if ($user->hasRole('admin')) {
                    $user->newClearMediaCollection($userInput['profile'],User::PROFILE);
                    $user->newAddMedia($userInput['profile'])->toMediaCollection(User::PROFILE, config('app.media_disc'));
                }else{
                    $user->clearMediaCollection(User::PROFILE);
                    $user->addMedia($userInput['profile'])->toMediaCollection(User::PROFILE, config('app.media_disc'));
                }
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    public function updateProfileAPI($userInput)
    {
        try {
            DB::beginTransaction();

            $user = Auth::user();

            // Check if 'contact' key exists before attempting to access it
            if (isset($userInput['contact'])) {
                $userInput['contact'] = str_replace(' ', '', $userInput['contact']);
            }

            if (isset($userInput['email']) && $userInput['email'] != $user->email) {
                $token = Str::random(60);

                EmailVerification::create([
                    'user_id' => $user->id,
                    'email' => $userInput['email'],
                    'token' => $token,
                ]);

                $url = url(config('app_domain') . '/change-email-verification/' . $user->id . '/' . $token);
                $data = [
                    'user' => $user,
                    'url' => $url,
                ];

                Mail::to($userInput['email'])
                    ->send(new VerifyMail($data));
            }

            // Update user data excluding 'email' and 'profile'
            $user->update($userInput, ['email', 'profile']);

            if (isset($userInput['profile']) && !empty($userInput['profile'])) {
                $user->clearMediaCollection(User::PROFILE);
                $user->addMedia($userInput['profile'])->toMediaCollection(User::PROFILE, config('app.media_disc'));
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function userDataDelete(User $user)
    {
        try {
            if ($user->getRoleNames()[0] == 'admin') {

                $withdrawals = Withdrawal::whereUserId($user->id)->get();
                foreach ($withdrawals as $withdrawal) {
                    $withdrawalTransactions = WithdrawalTransaction::where('withdrawal_id', $withdrawal->id)->get();
                    foreach ($withdrawalTransactions as $transaction) {
                        $transaction->delete();
                    }
                    $withdrawal->delete();
                }

                $affiliateUsers = AffiliateUser::whereUserId($user->id)->orWhere('affiliated_by', $user->id)->get();
                foreach ($affiliateUsers as $affiliateUser) {
                    $affiliateUser->delete();
                }

                NfcOrderTransaction::where('user_id', $user->id)->delete();

                $user = User::find($user->id);
                //product delete
                $products = Product::whereHas('vcard', function ($query) use ($user) {
                    $query->where('tenant_id', $user->tenant_id);
                })->get();

                foreach ($products as $product) {

                    $mediaFiles = $product->getMedia('image');

                    foreach ($mediaFiles as $mediaFile) {
                        $mediaFile->delete();
                    }

                    $product->delete();
                }

                //testimonial delete
                $user = User::find($user->id);

                $testimonials = Testimonial::whereHas('vcard', function ($query) use ($user) {
                    $query->where('tenant_id', $user->tenant_id);
                })->get();

                foreach ($testimonials as $testimonial) {

                    $mediaFiles = $testimonial->getMedia('image');

                    foreach ($mediaFiles as $mediaFile) {
                        $mediaFile->delete();
                    }

                    $testimonial->delete();
                }

                // blog delete
                $user = User::find($user->id);

                $blogs = VcardBlog::whereHas('vcard', function ($query) use ($user) {
                    $query->where('tenant_id', $user->tenant_id);
                })->get();

                foreach ($blogs as $blog) {

                    $mediaFiles = $blog->getMedia('image');

                    foreach ($mediaFiles as $mediaFile) {
                        $mediaFile->delete();
                    }

                    $blog->delete();
                }

                // service delete
                $user = User::find($user->id);

                $services = VcardService::whereHas('vcard', function ($query) use ($user) {
                    $query->where('tenant_id', $user->tenant_id);
                })->get();

                foreach ($services as $service) {

                    $mediaFiles = $service->getMedia('service_icon');

                    foreach ($mediaFiles as $mediaFile) {
                        $mediaFile->delete();
                    }

                    $service->delete();
                }

                // gallery delete
                $user = User::find($user->id);

                $gallaries = Gallery::whereHas('vcard', function ($query) use ($user) {
                    $query->where('tenant_id', $user->tenant_id);
                })->get();

                foreach ($gallaries as $gallery) {

                    $mediaFiles = $gallery->getMedia('image');

                    foreach ($mediaFiles as $mediaFile) {
                        $mediaFile->delete();
                    }

                    $gallery->delete();
                }

                //nfcOrder delete
                $nfcOrders = NfcOrders::where('user_id', $user->id)->get();

                foreach ($nfcOrders as $nfcOrder) {
                    $mediaFiles = $nfcOrder->getMedia('logo');
                    foreach ($mediaFiles as $mediaFile) {
                        $mediaFile->delete();
                    }
                    $nfcOrder->delete();
                }

                $vcards = Vcard::where('tenant_id', $user->tenant_id)->get();
                foreach ($vcards as $vcard) {
                    $mediaFiles = $vcard->getMedia('profile ');
                    foreach ($mediaFiles as $mediaFile) {
                        $mediaFile->delete();
                    }
                    $vcard->delete();
                }

                MultiTenant::where('id', $user->tenant_id)->delete();

                $user->delete();

                session()->flush();

                return Redirect::route('home');
            }

            return $this->sendError('Seems, you are not allowed to access this record.');
        } catch (\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());

            Flash::error(__('Error deleting user. Please try again.'));

            return Redirect::back();
        }
    }
}
