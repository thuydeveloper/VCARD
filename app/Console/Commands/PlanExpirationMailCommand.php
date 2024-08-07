<?php

namespace App\Console\Commands;

use Exception;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Mail\PlanExpirationReminder;
use Illuminate\Support\Facades\Mail;

class PlanExpirationMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:plan-expiration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Mail Before Plan Expiration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $users =  User::role('admin')->with(['subscriptions'])->get();
            foreach ($users as $user) {
                $expirationDate = Carbon::parse($user->subscription->ends_at);
                $data = [
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name
                ];
                if ($expirationDate->diffInDays(now()) == getSuperAdminSettingValue('plan_expire_notification')) {
                    Mail::to($user->email)->send(new PlanExpirationReminder($data));
                }
            }
            Log::info('Plan expiration reminder sent successfully');
        } catch (Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
