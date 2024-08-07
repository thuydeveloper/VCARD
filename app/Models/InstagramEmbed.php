<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InstagramEmbed extends Model
{
    use HasFactory;

    protected $table = 'instagram_embeds';

    protected $fillable = [
        'type',
        'embedtag',
        'vcard_id',
    ];

    protected $casts = [
        'type' => 'string',
        'embedtag' => 'string',
        'vcard_id' => 'integer',
    ];

    public static $rules = [
        'type' => 'required',
        'embedtag' => 'nullable|required',
    ];

    const TYPE_POST = 0;

    const TYPE_REEL = 1;

    const TYPE = [
        self::TYPE_POST => 'Post',
        self::TYPE_REEL => 'Reel',
    ];

    public function vcard(): BelongsTo
    {
        return $this->belongsTo(Vcard::class, 'vcard_id');
    }

    public function getTypeNameAttribute($value): string
    {
        return self::TYPE[$this->type];
    }
}
