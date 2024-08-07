<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupAPIController extends AppBaseController
{
    public function groupCreate(Request $request)
    {
        Group::create([
            'name' => $request->name,
            'tenant_id' => getLogInTenantId(),
        ]);

        return $this->sendSuccess('User Group created successfully.');
    }

    public function groupData()
    {
        $tenantId = getLogInTenantId();

        $groupsData = Group::where('tenant_id', $tenantId)->get();

        $data = [];

        foreach ($groupsData as $groupData)
        {
            $data[] = [
                'id' => $groupData->id,
                'name' => $groupData->name,
                'tenant_id' => $groupData->tenant_id,
                'created_at' => $groupData->created_at,
            ];
        }

        return $this->sendResponse($data, 'User groups data retrieved successfully.');
    }

    public function deleteGroup($groupId)
    {
        $tenantId = getLogInTenantId();

        $userVcard = Group::where('id', $groupId)
                          ->where('tenant_id', $tenantId)
                          ->first();

        if (!$userVcard) {
            return $this->sendError('User Groups not found');
        }

        $userVcard->delete();

        return $this->sendSuccess('User Groups deleted successfully.');
    }

}
