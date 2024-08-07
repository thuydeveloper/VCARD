<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banners';
/**
     * @var array
     */

   protected $fillable = [
       'url',
       'title',
       'description',
       'vcard_id',
       'banner_button',
   ];

   protected $casts = [
       'url' => 'string',
       'title' => 'string',
       'description' => 'string',
       'banner_button' => 'string',
   ];

      /**
     * @var array
     */
    public static $rules = [
        'url' => 'url',
        'title' => 'required|string',
        'description' => 'required|string',
        'banner_button' => 'required|string',
    ];


    public function vcard(): BelongsTo
    {
        return $this->belongsTo(Vcard::class, 'vcard_id');
    }
}
