<?php

namespace App\Http\Controllers;

use App\Models\Vcard;
use App\Models\VcardSubscribers;
use Illuminate\Http\Request;

class VcardSubscribersController extends Controller
{
    public function store(Request $request)
    {

        $input = $request->all();
        $input['vcard_id'] = Vcard::whereUrlAlias($input['vcard_alias'])->first()->id;
        if (isset($input['subscribe']) && $input['subscribe'] == "true") {
            VcardSubscribers::create($input);
            return $this->sendSuccess('User subscribed successfully.');
        }

        $playerExist = VcardSubscribers::where('player_id', $input['player_id'])->first();
        if ($playerExist) {
            $exist = VcardSubscribers::where('player_id', $input['player_id'])
                ->where('vcard_id', $input['vcard_id'])
                ->first();
            if (!$exist) {
                return $this->sendError("Error");
            }
        } else {
            VcardSubscribers::create($input);
        }

        return $this->sendSuccess('User subscribed successfully.');
    }
}
