<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NfcOrderTransaction extends Model
{
    use HasFactory;

    protected $table = 'nfc_order_transaction';

    protected $fillable = [
        'nfc_order_id',
        'type',
        'transaction_id',
        'amount',
        'user_id',
        'status'
    ];

}
