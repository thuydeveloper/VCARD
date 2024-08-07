<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VcardSubscribers extends Model
{
    use HasFactory;
    
    protected $fillable = ['vcard_id', 'player_id'];
}
