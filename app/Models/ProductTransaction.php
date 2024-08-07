<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductTransaction
 *
 * @property int $id
 * @property int $product_id
 * @property string $name
 * @property string $email
 * @property float $amount
 * @property int $currency_id
 * @property string $phone
 * @property int $type
 * @property string $transaction_id
 * @property string $address
 * @property string $meta
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Currency $currency
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|ProductTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductTransaction whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductTransaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductTransaction whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductTransaction whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductTransaction whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductTransaction whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductTransaction wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductTransaction whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductTransaction whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductTransaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductTransaction whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'name',
        'email',
        'phone',
        'address',
        'currency_id',
        'meta',
        'type',
        'transaction_id',
        'amount',
        'status',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function currency(){
        return $this->belongsTo(Currency::class);
    }
}
