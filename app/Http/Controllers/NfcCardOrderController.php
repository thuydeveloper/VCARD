<?php

namespace App\Http\Controllers;

use App\Models\NfcOrders;
use App\Models\NfcCardOrder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NfcCardOrderController extends Controller
{
    public function index()
    {
        return view('sadmin.nfc_card_order.index');
    }

    public function show($nfcOrder)
    {
        $nfcCardOrder = NfcOrders::with('nfcTransaction','vcard','nfcCard','nfcPaymentType')->select('*')->findOrFail($nfcOrder);

        return view('sadmin.nfc_card_order.show', compact('nfcCardOrder'));
    }

    public function downloadLogo($id)
    {
         $nfcCardOrder = NfcOrders::findOrFail($id);

         $mediaCollection = $nfcCardOrder->media;

        if (! empty($mediaCollection)) {
            $mediaItem = $mediaCollection->first();
            $mediaPath = $mediaItem->getPath();

            if (config('app.media_disc') === 'public') {
                $mediaPath = (Str::after($mediaItem->getUrl(), '/uploads'));
            }

            $file = Storage::disk(config('app.media_disc'))->get($mediaPath);

            $headers = [
                'Content-Type' => $mediaItem->mime_type,
                'Content-Description' => 'File Transfer',
                'Content-Disposition' => "attachment; filename={$mediaItem->file_name}",
                'filename' => $mediaItem->file_name,
            ];

            return response($file, 200, $headers);
        }

    }
}
