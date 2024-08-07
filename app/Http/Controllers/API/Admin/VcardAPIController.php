<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Enquiry;
use App\Models\ScheduleAppointment;
use App\Models\Vcard;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VcardAPIController extends AppBaseController
{
    public function vcardData()
    {
        $loggedInTenantId = getLogInTenantId();

        $vcardIds = Vcard::whereTenantId($loggedInTenantId)->pluck('id')->toArray();

        $vcards = Vcard::whereIn('id', $vcardIds)->get();

        $data = [];

        foreach ($vcards as $vcard) {
            $data[] = [
                'id' => $vcard->id,
                'name' => $vcard->name,
                'url_alias' => route('vcard.show', ['alias' => $vcard->url_alias]),
                'occupation' => $vcard->occupation,
                'image' => !empty($vcard->template) ? $vcard->template->template_url : asset('assets/images/default_cover_image.jpg'),
            ];
        }

        return $this->sendResponse($data, 'Vcards Data Retrieve Successfully.');
    }

    public function vcard(Request $vcard)
    {
        $tenantId = getLogInTenantId();

        $userVcard = Vcard::where('id', $vcard->id)
                          ->where('tenant_id', $tenantId)
                          ->first();

        if (empty($userVcard)) {
            return $this->sendError('Vcard not found');
        }

        $data = [
            'id' => $userVcard->id,
            'name' => $userVcard->name,
            'occupation' => $userVcard->occupation,
            'image' => !empty($userVcard->template) ? $userVcard->template->template_url : asset('assets/images/default_cover_image.jpg'),
            'created_at' => $userVcard->created_at,
        ];

        return $this->sendResponse($data, 'Vcard Data Retrieved Successfully.');
    }



    public function deleteVcard($vcardId)
    {
        $tenantId = getLogInTenantId();

        $userVcard = Vcard::where('id', $vcardId)
                          ->where('tenant_id', $tenantId)
                          ->first();

        if (!$userVcard) {
            return $this->sendError('Vcard not found');
        }

        $userVcard->delete();

        return $this->sendSuccess('Vcard deleted successfully.');
    }

    public function appointmentVcard($vcard)
    {
        if (!is_array($vcard)) {
            $vcard = [$vcard];
        }

        $tenantId = getLogInTenantId();

        $scheduleAppointment = ScheduleAppointment::with('vcard')
            ->whereIn('vcard_id', $vcard)
            ->whereHas('vcard', function ($query) use ($tenantId) {
                $query->where('tenant_id', $tenantId);
            })
            ->get();

        $data = [];

        foreach ($scheduleAppointment as $scheduleAppointments) {
            $data[] = [
                'id' => $scheduleAppointments->id,
                'vcard_id' => $scheduleAppointments->vcard->id,
                'vcard_name' => $scheduleAppointments->vcard->name,
                'name' => $scheduleAppointments->name,
                'date' => $scheduleAppointments->date,
                'from_time' => $scheduleAppointments->from_time,
                'to_time' => $scheduleAppointments->to_time,
                'status' => $scheduleAppointments->status,
                'paid_amount' => $scheduleAppointments->paid_amount,
            ];
        }

        return $this->sendResponse($data, 'Vcard Appointment Data Retrieve Successfully.');
    }


    public function enquiresVcard($vcard)
    {
        $tenantId = getLogInTenantId();

        $enquiriesDatas = Enquiry::whereHas('vcard', function ($query) use ($vcard, $tenantId) {
                $query->where('id', $vcard)
                      ->where('tenant_id', $tenantId);
            })
            ->get();

        $data = [];

        foreach ($enquiriesDatas as $enquiriesData) {
            $data[] = [
                'id' => $enquiriesData->id,
                'vcard_name' => $enquiriesData->vcard->name,
                'name' => $enquiriesData->name,
                'email' => $enquiriesData->email,
                'phone' => $enquiriesData->phone,
                'message' => $enquiriesData->message,
                'created_at' => $enquiriesData->created_at,
            ];
        }

        return $this->sendResponse($data, 'Vcard Enquiries Data Retrieve Successfully.');
    }


}
