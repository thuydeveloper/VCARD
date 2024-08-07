<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEcardRequest;
use App\Models\Vcard;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ECardsController extends Controller
{
    public function index(): View|Factory|Application
    {
        $tenantId = Auth::user()->tenant_id;
        $vCards = Vcard::whereTenantId($tenantId)->pluck('name', 'id');

        return view('virtual-backgrounds.index', compact('vCards'));
    }

    public function getVcardData(Request $request): JsonResponse
    {
        $input = $request->all();
        $vcard = Vcard::with('socialLink')->findOrFail($input['vcardId']);

        $data = [
            'id' => $vcard['id'],
            'first_name' => $vcard['first_name'],
            'last_name' => $vcard['last_name'],
            'email' => $vcard['email'],
            'occupation' => $vcard['occupation'],
            'location' => $vcard['location'],
            'region_code' => $vcard['region_code'],
            'phone' => $vcard['phone'],
            'website' => $vcard['socialLink']['website'],
        ];

        return response()->json(['data' => $data, 'success' => true]);
    }

    public function downloadEcard(CreateEcardRequest $request): RedirectResponse
    {
        $input = $request->all();

        $path = asset('uploads/ecard');

        if (! Storage::exists($path)) {
            Storage::disk('public')->makeDirectory('uploads/ecard');
        }

        $zipFile = public_path('virtual_backgrounds/virtual-backgrounds.zip');
        if (File::exists($zipFile)) {
            File::delete($zipFile);
        }

        if ($input['e-card-id'] == 1) {
            $data = retriveH1Card($input);
        }
        if ($input['e-card-id'] == 2) {
            $data = retriveH2Card($input);
        }
        if ($input['e-card-id'] == 3) {
            $data = retriveH3Card($input);
        }
        if ($input['e-card-id'] == 4) {
            $data = retriveH4Card($input);
        }
        if ($input['e-card-id'] == 5) {
            $data = retriveH5Card($input);
        }
        if ($input['e-card-id'] == 6) {
            $data = retriveH6Card($input);
        }
        if ($input['e-card-id'] == 7) {
            $data = retriveH7Card($input);
        }
        if ($input['e-card-id'] == 8) {
            $data = retriveH8Card($input);
        }
        if ($input['e-card-id'] == 9) {
            $data = retriveH9Card($input);
        }
        if ($input['e-card-id'] == 10) {
            $data = retriveH10Card($input);
        }
        if ($input['e-card-id'] == 11) {
            $data = retriveH11Card($input);
        }
        if ($input['e-card-id'] == 12) {
            $data = retriveH12Card($input);
        }
        if ($input['e-card-id'] == 13) {
            $data = retriveH13Card($input);
        }

        // delete images after generate zip file
        $vcardId = $input['vcard_id'];
        $qrCodeImage = public_path('ecard/'.$vcardId.'-qr.png');
        $frontImage = public_path('virtual_backgrounds/Front.jpg');
        $backImage = public_path('virtual_backgrounds/Back.jpg');
        $frontImage1 = public_path('uploads/ecard/'.$vcardId .'/Front.png');
        $backImage1 = public_path('uploads/ecard/'.$vcardId.'/Back.png');
        $directory = public_path('uploads/ecard/'.$vcardId);


        if (File::exists($qrCodeImage)) {
            File::delete($qrCodeImage);
        }
        if (File::exists($frontImage)) {
            File::delete($frontImage);
        }
        if (File::exists($backImage)) {
            File::delete($backImage);
        }
        if (File::exists($frontImage1)) {
            File::delete($frontImage1);
        }
        if (File::exists($backImage1)) {
            File::delete($backImage1);
            File::deleteDirectory($directory);
        }

        return redirect(asset($data[0]));
    }

    public function getEcard(Request $request): \Illuminate\View\View
    {
        return view();
    }

    public function create($ecard): \Illuminate\View\View
    {
        $vcards = Vcard::whereTenantId(getLogInTenantId())->where('status', Vcard::ACTIVE)->pluck('name', 'id')->toArray();

        return view('virtual-backgrounds.create', compact('vcards', 'ecard'));
    }

    public function store(Request $request, $cardImageId)
    {
    }
}
