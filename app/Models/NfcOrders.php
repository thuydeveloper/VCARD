<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NfcOrders extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    const LOGO_PATH = 'nfc_order_logo';

    const STRIPE = 1;

    const PAYPAL = 2;

    const RAZOR_PAY = 3;

    const MANUALLY = 4;

    const PAYSTACK = 5;

    const PHONEPE = 6;

    const FLUTTERWAVE = 7;

    const PENDING = 0;

    const SUCCESS = 1;

    const FAIL = 2;

    const READY_TO_SHIP = 1;

    const SHIPPED = 2;

    const DELIVERED = 3;

    const CANCEL = 4;

    const PAYMENT_TYPE_ARR = [
        self::STRIPE => 'stripe',
        self::PAYPAL => 'paypal',
        self::RAZOR_PAY => 'razorpay',
        self::MANUALLY => 'manually',
        self::PHONEPE => 'phonepe',
        self::PAYSTACK => 'paystack',
        self::FLUTTERWAVE => 'flutterwave',
    ];

    const ORDER_STATUS_ARR = [
        self::PENDING => 'Pending',
        self::READY_TO_SHIP => 'Ready To Ship',
        self::SHIPPED => 'Shipped',
        self::DELIVERED => 'Delivered',
        self::CANCEL => 'Cancelled',
    ];

    const PAYMENT_STATUS_ARR = [
        self::PENDING => 'pending',
        self::SUCCESS => 'paid',
        self::FAIL => 'failed',
    ];

    protected $with = ['media'];

    public static $rules = [
        'card_type' => 'required|integer',
        'company_name' => 'required|string',
        'name' => 'required|string',
        'email' => 'required|email',
        'phone' => 'required|integer',
        'designation' => 'required|string',
        'address' => 'required|string',
        'logo' => 'required|mimes:jpg,jpeg,png',
        'vcard_id' => 'required|integer',
    ];

    protected $fillable = [
        'card_type',
        'name',
        'designation',
        'phone',
        'region_code',
        'email',
        'address',
        'order_status',
        'quantity',
        'user_id',
        'company_name',
        'vcard_id',
    ];

    public function nfcCard()
    {
        return $this->belongsTo(Nfc::class, 'card_type', 'id');
    }

    public function vcard()
    {
        return $this->belongsTo(Vcard::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function nfcTransaction()
    {
        return $this->hasOne(NfcOrderTransaction::class, 'nfc_order_id', 'id');
    }
    public function nfcPaymentType()
    {
        return $this->hasOne(NfcOrderTransaction::class, 'type', 'id');
    }
}
