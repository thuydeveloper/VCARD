<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Iframe extends Model
{
    use HasFactory;

    protected $table = 'iframes';

    protected $fillable = [
        'url',
        'vcard_id',

    ];

    protected $casts = [
        'url' => 'string',
        'vcard_id' => 'integer',
    ];

    public static $rules = [
        'url' => 'required|url',
    ];

    public function vcard(): BelongsTo
    {
        return $this->belongsTo(Vcard::class, 'vcard_id');
    }
}
