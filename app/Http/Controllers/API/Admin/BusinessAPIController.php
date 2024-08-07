<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Models\BusinessCards;
use App\Models\Group;
use App\Models\Vcard;
use Illuminate\Http\Request;
use PHPUnit\TextUI\XmlConfiguration\Groups;

class BusinessAPIController extends AppBaseController
{
    public function creatBusinessCard(Request $request)
    {
        $url = $request->url_alias;
        $urlAlias = null;
        $parsedUrl = parse_url($url);
        if (isset($parsedUrl['path'])) {
            $pathParts = explode('/', $parsedUrl['path']);
            $urlAlias = end($pathParts);
        }

        $group = Group::where('tenant_id', getLogInTenantId())->first();

        if (!$group) {
            return $this->sendError('Not group found & Add group');
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

        $tenantId = getLogInTenantId();

        $businessCards = BusinessCards::with(['vcard', 'groups'])
            ->where('tenant_id', $tenantId)->when(!empty($request->filter), function ($query) use ($request) {
                $query->whereIn('group_id', $request->filter);
            })->get();

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

        return $this->sendResponse($data, 'Business Data Retrieved Successfully.');
    }
}
