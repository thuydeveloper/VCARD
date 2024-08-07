<?php

namespace App\Http\Controllers\API\BusinessCards;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupsAPIController extends AppBaseController
{
    public function groupCreate(Request $request)
    {
        Group::create([
            'name' => $request->name,
            'tenant_id' => getLogInTenantId(),
        ]);

        return $this->sendSuccess('Group created successfully.');
    }

    public function groupData()
    {
        $groupsData = Group::all();

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

        return $this->sendResponse($data, 'Groups data retrieved successfully.');
    }

    public function deleteGroup($group)
    {
        $enquiry = Group::find($group);

        if (empty($group)) {
            return $this->sendSuccess('Group not found');
        }
        $enquiry->delete();

        return $this->sendSuccess('Group deleted successfully.');
    }
}
