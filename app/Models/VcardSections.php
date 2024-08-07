<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VcardSections extends Model
{
    use HasFactory;

    protected $table = 'vcard_sections';

    /**
     * @var array
     */
    protected $fillable = [
        'vcard_id',
        'header',
        'contact_list',
        'services',
        'products',
        'galleries',
        'blogs',
        'map',
        'testimonials',
        'business_hours',
        'appointments',
        'insta_embed',
        'banner',
        'iframe',
        'news_latter_popup',
        'one_signal_notification',
    ];

    protected $casts = [
        'vcard_id' => 'integer',
        'header' => 'string',
        'contact_list' => 'string',
        'services' => 'string',
        'products' => 'string',
        'galleries' => 'string',
        'blogs' => 'string',
        'map' => 'string',
        'testimonials' => 'string',
        'business_hours' => 'string',
        'appointments' => 'string',
        'insta_embed' => 'string',
        'banner' => 'string',
        'iframes' => 'string',
        'news_latter_popup' => 'string',
        'one_signal_notification' => 'string',
    ];
}
