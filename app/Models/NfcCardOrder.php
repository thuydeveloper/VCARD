<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\NfcCardOrder
 *
 * @property int $id
 * @property int $user_id
 * @property int $nfc_card_type_id
 * @property int $vcard_id
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Nfc $nfc
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Vcard $vcard
 * @method static \Illuminate\Database\Eloquent\Builder|NfcCardOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NfcCardOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NfcCardOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|NfcCardOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NfcCardOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NfcCardOrder whereNfcCardTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NfcCardOrder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NfcCardOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NfcCardOrder whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NfcCardOrder whereVcardId($value)
 * @mixin \Eloquent
 */
class NfcCardOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'vcard_id',
        'nfc_card_type_id',
        'user_id',
    ];

    public function vcard(){
        return $this->belongsTo(Vcard::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function nfc(){
        return $this->belongsTo(Nfc::class, 'nfc_card_type_id', 'id');
    }
}
