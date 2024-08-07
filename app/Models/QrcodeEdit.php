<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\QrcodeEdit
 *
 * @property int $id
 * @property string $tenant_id
 * @property string $key
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|QrcodeEdit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QrcodeEdit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QrcodeEdit query()
 * @method static \Illuminate\Database\Eloquent\Builder|QrcodeEdit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QrcodeEdit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QrcodeEdit whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QrcodeEdit whereTenantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QrcodeEdit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QrcodeEdit whereValue($value)
 *
 * @mixin \Eloquent
 */
class QrcodeEdit extends Model
{
    use HasFactory;

    const SQUARE = 'square';

    const DOT = 'dot';

    const ROUND = 'round';

    const QRCODE_STYLE = [
        self::SQUARE => 'square',
        self::DOT => 'dot',
        self::ROUND => 'round',
    ];

    const EYE_SQUARE = 'square';

    const EYE_CIRCLE = 'circle';

    const QRCODE_EYE_STYLE = [
        self::EYE_SQUARE => 'square',
        self::EYE_CIRCLE => 'circle',
    ];

    protected $table = 'qr_code_customizations';

    protected $fillable = [
        'name',
        'tenant_id',
        'key',
        'value',
    ];
}
