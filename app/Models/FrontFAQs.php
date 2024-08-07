<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrontFAQs extends Model
{
    use HasFactory;

    protected $table = 'front_faqs';

    protected $fillable = [
        'title',
        'description',
    ];

    protected $casts = [
        'title' => 'string',
        'description' => 'string',
    ];

    public static $rules = [
        'title' => 'required|string|min:3',
        'description' => 'required|string|min:3',
    ];
}
