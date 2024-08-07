<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\VcardEmailSubscription
 *
 * @property int $id
 * @property int $vcard_id
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Vcard $vcard
 * @method static \Illuminate\Database\Eloquent\Builder|VcardEmailSubscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VcardEmailSubscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VcardEmailSubscription query()
 * @method static \Illuminate\Database\Eloquent\Builder|VcardEmailSubscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VcardEmailSubscription whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VcardEmailSubscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VcardEmailSubscription whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VcardEmailSubscription whereVcardId($value)
 * @mixin \Eloquent
 */
class VcardEmailSubscription extends Model
{
    use HasFactory;

    protected $table = 'vcard_email_subscriptions';

    protected $fillable = [
        'vcard_id',
        'email',
    ];

    protected $casts = [
        'email' => 'string',
        'vcard_id' => 'integer',
    ];

    public static $rules = [
        'email' => 'required|email',
    ];

    public function vcard(): BelongsTo
    {
        return $this->belongsTo(Vcard::class, 'vcard_id');
    }
}
