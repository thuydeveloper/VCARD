<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BusinessCards extends Model
{
    use HasFactory;

    protected $table = 'business_cards';

    protected $fillable = [
        'tenant_id',
        'url',
        'group_id',
        'vcard_id',
    ];

    protected $casts = [
        'tenant_id' => 'string',
        'url' => 'string',
        'group_id' => 'integer',
        'vcard_id' => 'integer',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'tenant_id', 'tenant_id');
    }

    public function vcard(): BelongsTo
    {
        return $this->belongsTo(Vcard::class);
    }

    public function groups(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'group_id');
    }
}
