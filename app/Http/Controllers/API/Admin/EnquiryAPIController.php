<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use App\Models\Vcard;
use Illuminate\Http\Request;

class EnquiryAPIController extends AppBaseController
{
    public function enquiryData()
    {
        $vcardIds = Vcard::whereTenantId(getLogInTenantId())->pluck('id')->toArray();

        $enquirys = Enquiry::with('vcard')->whereIn('vcard_id', $vcardIds)->get();

        $data = [];

        foreach ($enquirys as $enquiry) {
            $data[] = [
                'id' => $enquiry->id,
                'vcard_name' => $enquiry->vcard->name,
                'name' => $enquiry->name,
                'created_at' => $enquiry->created_at,
            ];
        }
        return $this->sendResponse($data, 'Enquiry data retrieved successfully.');
    }

    public function enquiry($enquiry)
    {
        $enquirys = Enquiry::with('vcard')->whereId($enquiry)->first();

        if(empty($enquirys)){
            return $this->sendError('Enquiry not found', 404);
        }

        $data[] = [
            'id' => $enquirys->id,
            'vcard_name' => $enquirys->vcard->name,
            'name' => $enquirys->name,
            'email' => $enquirys->email,
            'phone' => $enquirys->phone,
            'message' => $enquirys->message,
            'created_at' => $enquirys->created_at,
        ];

        return $this->sendResponse($data, 'Enquiry data retrieved successfully.');
    }

    public function deleteEnquiry($enquiry)
    {
        $enquiry = Enquiry::find($enquiry);

        if (empty($enquiry)) {
            return $this->sendSuccess('Appointment not found');
        }

        $enquiry->delete();

        return $this->sendSuccess('Enquiry deleted successfully.');
    }
}
