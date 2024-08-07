<?php

namespace App\Http\Controllers\API\SuperAdmin;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Models\BusinessCards;
use App\Models\Group;
use App\Models\Vcard;
use Illuminate\Http\Request;

class BusinessAPIController extends AppBaseController
{
    public function createBusinessCard(Request $request)
    {
        $url = $request->url_alias;
        $urlAlias = null;
        $parsedUrl = parse_url($url);
        if (isset($parsedUrl['path'])) {
            $pathParts = explode('/', $parsedUrl['path']);
            $urlAlias = end($pathParts);
        }

        if (isset($urlAlias)) {
            $vcard = Vcard::where('url_alias', $urlAlias)->first();

            if ($vcard) {
                BusinessCards::create([
                    'tenant_id' => getLogInTenantId(),
                    'vcard_id' => $vcard->id,
                    'url' => route('vcard.show', ['alias' => $vcard->url_alias]),
                    'group_id' => $request->group_id,
                ]);
                return $this->sendSuccess('Business card created successfully.');
            }
        }
        BusinessCards::create([
            'tenant_id' => getLogInTenantId(),
            'vcard_id' => $request->id,
            'url' => $url,
            'group_id' => $request->group_id,
        ]);

        return $this->sendSuccess('Business card created successfully.');
    }

    public function businessCardData(Request $request)
    {
        $filter = $request->all();

        $businessCards = BusinessCards::with(['vcard','groups'])
            ->when(!empty($filter) ,function($q) use ($filter) {
                $q->whereIn('group_id', $filter['filter']);
            })
            ->get();

        $data = [];

        foreach ($businessCards as $businessCard) {
            $data[] = [
                'id' => $businessCard->id,
                'vcard_id' => $businessCard->vcard_id,
                'url' => $businessCard->url,
                'name' => $businessCard->vcard ? $businessCard->vcard->name : null,
                'occupation' => $businessCard->vcard ? $businessCard->vcard->occupation : null,
                'phone' => $businessCard->vcard ? $businessCard->vcard->phone : null,
                'created_at' => $businessCard->vcard ? $businessCard->vcard->created_at : null,
                'group_name' => $businessCard->groups->name,
                'vcard_image' => !empty($businessCard->vcard->template) ? $businessCard->vcard->template->template_url : null,
            ];
        }

        return $this->sendResponse($data, 'Business Data Retrieve Successfully.');
    }
}
