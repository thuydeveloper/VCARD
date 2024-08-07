<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Group extends Model
{
    use HasFactory;

    protected $table = 'groups';

    protected $fillable = [
        'name',
        'tenant_id'
    ];

    protected $casts = [
        'name' => 'string',
        'name' => 'string',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'tenant_id', 'tenant_id');
    }

    public function businessCard(): HasOne
    {
        return $this->hasOne(BusinessCards::class, 'group_id');
    }
}
