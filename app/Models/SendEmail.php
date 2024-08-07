<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendEmail extends Model
{
    use HasFactory;

    protected $table = 'send_email';

    /**
     * @var array
     */
    protected $fillable = [
        'subject',
        'description',
    ];

    protected $casts = [
        'subject' => 'string',
        'description' => 'string',
    ];

}
