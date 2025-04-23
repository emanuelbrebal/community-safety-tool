<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $table = 'communities';

    public $timestamps = false;

    protected $fillable = [
        'community',
        'active'
    ];

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class, 'community_id', 'id');
    }
}
