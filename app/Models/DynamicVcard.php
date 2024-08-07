<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DynamicVcard extends Model
{
    use HasFactory;

    protected $fillable = [
        'vcard_id',
        'primary_color',
        'back_color',
        'back_seconds_color',
        'button_text_color',
        'text_label_color',
        'text_description_color',
        'sticky_bar',
        'cards_back',
        'button_style',
        'social_icon_color',
    ];


    public function vcard(): BelongsTo
    {
        return $this->belongsTo(Vcard::class, 'vcard_id');
    }
}
