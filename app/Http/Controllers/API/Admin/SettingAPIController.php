<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserSettingRequest;
use App\Models\Language;
use App\Models\ScheduleAppointment;
use App\Models\UserSetting;
use App\Models\Vcard;
use App\Repositories\UserSettingRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SettingAPIController extends AppBaseController
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

    public function editSettings()
    {
        $setting = UserSetting::where('user_id', getLogInUserId())->pluck('value', 'key')->toArray();
        $language = Language::where('iso_code', getCurrentLanguageName())->value('name');

        $data[] = [
            'language' => $language,
            'time_format' => $setting['time_format'],
        ];

        return $this->sendResponse($data, 'Setting data retrieved successfully.');
    }

    public function updateSettings(UpdateUserSettingRequest $request)
    {
        $input = $request->all();
        $id = Auth::id();
        $setting = UserSetting::where('user_id', getLogInUserId())->where('key', 'time_format')->first();
        $userVcards = Vcard::where('tenant_id', getLogInTenantId())->pluck('id')->toArray();
        $bookedAppointment = ScheduleAppointment::whereIn('vcard_id', $userVcards)->where('status',
            ScheduleAppointment::PENDING)->count();
        $timeFormat = $setting->value == UserSetting::HOUR_24 ? UserSetting::HOUR_24  : UserSetting::HOUR_12;
        $requestTimeFormat = isset($request->time_format) ? $request->time_format : $timeFormat;

        $this->userSettingRepository->updateAPI($input, $id);


        return $this->sendSuccess("Setting updated successfully");
    }

}
