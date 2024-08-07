<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserSettingRequest;
use App\Models\ScheduleAppointment;
use App\Models\UserSetting;
use App\Models\Vcard;
use App\Repositories\UserSettingRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;

class UserSettingController extends AppBaseController
{
    /**
     * @var UserSettingRepository
     */
    private $userSettingRepository;

    /**
     * SettingController constructor.
     */
    public function __construct(UserSettingRepository $userSettingRepository)
    {
        $this->userSettingRepository = $userSettingRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index(Request $request): \Illuminate\View\View
    {
        $sectionName = ($request->get('section') === null) ? 'general' : $request->get('section');
        $setting = UserSetting::where('user_id', getLogInUserId())->pluck('value', 'key')->toArray();
        return view("user-settings.$sectionName",compact('setting', 'sectionName'));
    }

    public function update(UpdateUserSettingRequest $request): RedirectResponse
    {
        $id = Auth::id();
        if(isset($request->time_format)){
            $setting = UserSetting::where('user_id', getLogInUserId())->where('key', 'time_format')->first();
        }

        $userVcards = Vcard::where('tenant_id', getLogInTenantId())->pluck('id')->toArray();
        $bookedAppointment = ScheduleAppointment::whereIn('vcard_id', $userVcards)->where('status',
            ScheduleAppointment::PENDING)->count();
        if (! empty($setting) && $bookedAppointment > 0 && $setting->value != $request->time_format) {
            Flash::error(__('messages.flash.can_not_change_time_format'));
            return Redirect::back();
        }

        $this->userSettingRepository->update($request->all(), $id);

        Flash::success(__('messages.flash.setting_update'));

        return Redirect::back();
    }
}
