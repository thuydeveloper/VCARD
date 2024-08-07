<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanCustomField extends Model
{
    use HasFactory;

    protected $table = 'plan_custom_fields';
    protected $fillable = ['plan_id', 'custom_vcard_number', 'custom_vcard_price'];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
